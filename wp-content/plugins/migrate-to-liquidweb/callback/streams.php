<?php
// phpcs:disable WordPress.WP.AlternativeFunctions.file_system_operations_fread
// phpcs:disable WordPress.WP.AlternativeFunctions.file_system_operations_fwrite
// phpcs:disable WordPress.WP.AlternativeFunctions.file_system_operations_fsockopen
// We use php method like fread, fwrite to read only a portion of a file, we don't have a direct method for partial reads since WP_Filesystem doesn't support a direct equivalent to fread, fwrite.
// The entire file deals with custom stream handling
// We need direct socket/file operations for this functionality
// WordPress filesystem alternatives wouldn't work for this use case
// It's better to disable these specific rules at file level than adding individual ignore comments
if (!defined('ABSPATH')) exit;
if (!class_exists('BVRespStream')) :

	class BVStream extends BVCallbackBase {
		public $bvb64stream;
		public $bvb64cksize;
		public $checksum;
		
		function __construct($request) {
			$this->bvb64stream = $request->bvb64stream;
			$this->bvb64cksize = $request->bvb64cksize;
			$this->checksum = $request->checksum;
		}

		public function writeChunk($chunk) {
		}

		public static function startStream($account, $request) {
			$result = array();
			$params = $request->params;
			$stream = new BVRespStream($request);
			if ($request->isAPICall()) {
				$stream = new BVHttpStream($request);
				if (!$stream->connect()) {
					$apicallstatus = array(
						"httperror" => "Cannot Open Connection to Host",
						"streamerrno" => $stream->errno,
						"streamerrstr" => $stream->errstr
					);
					return array("apicallstatus" => $apicallstatus);
				}
				if (array_key_exists('acbmthd', $params)) {
					$qstr = http_build_query(array('bvapicheck' => $params['bvapicheck']));
					$url = '/bvapi/'.$params['acbmthd']."?".$qstr;
					if (array_key_exists('acbqry', $params)) {
						$url .= "&".$params['acbqry'];
					}
					$stream->multipartChunkedPost($url);
				} else {
					return array("apicallstatus" => array("httperror" => "ApiCall method not present"));
				}
			}
			return array('stream' => $stream);
		}

		public function writeStream($chunk) {
			if (strlen($chunk) > 0) {
				$bvb64_prefix = "";
				if ($this->bvb64stream) {
					$chunk_size = $this->bvb64cksize;
					$chunk = $this->base64Encode($chunk, $chunk_size);
					$bvb64_prefix .= "BVB64" . ":";
				}

				$hash_prefix = "";
				if ($this->checksum == 'crc32') {
					$hash_prefix .= "CRC32" . ":" . crc32($chunk) . ":";
				} else if ($this->checksum == 'md5') {
					$hash_prefix .= "MD5" . ":" . md5($chunk) . ":";
				}

				$chunk = $hash_prefix . $bvb64_prefix . strlen($chunk) . ":" . $chunk;

				$this->writeChunk($chunk);
			}
		}
	}

class BVRespStream extends BVStream {
	public $bvboundry;

	function __construct($request) {
		parent::__construct($request);
		$this->bvboundry = $request->bvboundry;
	}

	public function writeChunk($chunk) {
		echo $this->bvboundry . "ckckckckck" . $chunk . $this->bvboundry . "ckckckckck";
	}
	public function endStream() {
		echo $this->bvboundry . "rerererere";

		return array();
	}
}

class BVHttpStream extends BVStream {
	var $user_agent = 'BVHttpStream';
	var $host;
	var $port;
	var $timeout = 20;
	var $conn;
	var $errno;
	var $errstr;
	var $boundary;
	var $apissl;

	function __construct($request) {
		parent::__construct($request);
		$this->host = $request->params['apihost'];
		$this->port = intval($request->params['apiport']);
		$this->apissl = array_key_exists('apissl', $request->params);
	}

	public function connect() {
		if ($this->apissl && function_exists('stream_socket_client')) {
			$this->conn = stream_socket_client("ssl://".$this->host.":".$this->port, $errno, $errstr, $this->timeout);
		} else {
			$this->conn = @fsockopen($this->host, $this->port, $errno, $errstr, $this->timeout);
		}
		if (!$this->conn) {
			$this->errno = $errno;
			$this->errstr = $errstr;
			return false;
		}
		socket_set_timeout($this->conn, $this->timeout);
		return true;
	}

	public function write($data) {
		fwrite($this->conn, $data);
	}

	public function sendChunk($data) {
		$this->write(sprintf("%x\r\n", strlen($data)));
		$this->write($data);
		$this->write("\r\n");
	}

	public function sendRequest($method, $url, $headers = array(), $body = null) {
		$def_hdrs = array("Connection" => "keep-alive",
			"Host" => $this->host);
		$headers = array_merge($def_hdrs, $headers);
		$request = strtoupper($method)." ".$url." HTTP/1.1\r\n";
		if (null != $body) {
			$headers["Content-length"] = strlen($body);
		}
		foreach($headers as $key=>$val) {
			$request .= $key.":".$val."\r\n";
		}
		$request .= "\r\n";
		if (null != $body) {
			$request .= $body;
		}
		$this->write($request);
		return $request;
	}

	public function post($url, $headers = array(), $body = "") {
		if(is_array($body)) {
			$b = "";
			foreach($body as $key=>$val) {
				$b .= $key."=".urlencode($val)."&";
			}
			$body = substr($b, 0, strlen($b) - 1);
		}
		$this->sendRequest("POST", $url, $headers, $body);
	}

	public function streamedPost($url, $headers = array()) {
		$headers['Transfer-Encoding'] = "chunked";
		$this->sendRequest("POST", $url, $headers);
	}

	public function multipartChunkedPost($url) {
		$mph = array(
			"Content-Disposition" => "form-data; name=bvinfile; filename=data",
			"Content-Type" => "application/octet-stream"
		);
		$rnd = rand(100000, 999999); // phpcs:ignore WordPress.WP.AlternativeFunctions.rand_rand
		$this->boundary = "----".$rnd;
		$prologue = "--".$this->boundary."\r\n";
		foreach($mph as $key=>$val) {
			$prologue .= $key.":".$val."\r\n";
		}
		$prologue .= "\r\n";
		$headers = array('Content-Type' => "multipart/form-data; boundary=".$this->boundary);
		$this->streamedPost($url, $headers);
		$this->sendChunk($prologue);
	}

	public function writeChunk($data) {
		$this->sendChunk($data);
	}

	public function closeChunk() {
		$this->sendChunk("");
	}

	public function endStream() {
		$epilogue = "\r\n\r\n--".$this->boundary."--\r\n";
		$this->sendChunk($epilogue);
		$this->closeChunk();

		$result = array();
		$resp = $this->getResponse();
		if (array_key_exists('httperror', $resp)) {
			$result["httperror"] = $resp['httperror'];
		} else {
			$result["respstatus"] = $resp['status'];
			$result["respstatus_string"] = $resp['status_string'];
		}
		return array("apicallstatus" => $result);
	}

	public function getResponse() {
		$response = array();
		$response['headers'] = array();
		$state = 1;
		$conlen = 0;
		stream_set_timeout($this->conn, 300);
		while (!feof($this->conn)) {
			$line = fgets($this->conn, 4096);
			if (1 == $state) {
				if (!LWHelper::safePregMatch('/HTTP\/(\\d\\.\\d)\\s*(\\d+)\\s*(.*)/', $line, $m)) {
					$response['httperror'] = "Status code line invalid: ".htmlentities($line);
					return $response;
				}
				$response['http_version'] = $m[1];
				$response['status'] = $m[2];
				$response['status_string'] = $m[3];
				$state = 2;
			} else if (2 == $state) {
				# End of headers
				if (2 == strlen($line)) {
					if ($conlen > 0)
						$response['body'] = fread($this->conn, $conlen);
					return $response;
				}
				if (!LWHelper::safePregMatch('/([^:]+):\\s*(.*)/', $line, $m)) {
					// Skip to the next header
					continue;
				}
				$key = strtolower(trim($m[1]));
				$val = trim($m[2]);
				$response['headers'][$key] = $val;
				if ($key == "content-length") {
					$conlen = intval($val);
				}
			}
		}
		return $response;
	}
}
// phpcs:enable
endif;