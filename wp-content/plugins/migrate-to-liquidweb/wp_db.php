<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('LWWPDb')) :

class LWWPDb {
	public function dbprefix() {
		global $wpdb;
		$prefix = $wpdb->base_prefix ? $wpdb->base_prefix : $wpdb->prefix;
		return $prefix;
	}

	public function prepare($query, $args) {
		global $wpdb;
		return $wpdb->prepare($query, $args); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
	}

	public function getSiteId() {
		global $wpdb;
		return $wpdb->siteid;
	}

	public function getResult($query, $obj = ARRAY_A) {
		global $wpdb;
		return $wpdb->get_results($query, $obj); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
	}

	public function query($query) {
		global $wpdb;
		return $wpdb->query($query); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
	}

	public function getVar($query, $col = 0, $row = 0) {
		global $wpdb;
		return $wpdb->get_var($query, $col, $row); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
	}

	public function getCol($query, $col = 0) {
		global $wpdb;
		return $wpdb->get_col($query, $col); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
	}

	public function getAutoIncrement($table_name) {
		$query = "SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = '$table_name'";
		$results = $this->getResult($query, ARRAY_A);
		$auto_increment = null;
		if (empty($results)) {
			return $auto_increment;
		}
		$row = $results[0];
		if ($row && isset($row["AUTO_INCREMENT"]) && is_numeric($row["AUTO_INCREMENT"])) {
			$auto_increment = intval($row["AUTO_INCREMENT"]);
		}
		return $auto_increment;
	}

	public function tableName($table) {
		return $table[0];
	}

	public function showTables() {
		$tables = $this->getResult("SHOW TABLES", ARRAY_N);
		return array_map(array($this, 'tableName'), $tables);
	}


	public function showTableStatus() {
		return $this->getResult("SHOW TABLE STATUS");
	}

	public function tableKeys($table) {
		return $this->getResult("SHOW KEYS FROM $table;");
	}

	public function showDbVariables($variable) {
		$variables = $this->getResult("Show variables like '%$variable%' ;");
		$result = array();
		foreach ($variables as $variable) {
			$result[$variable["Variable_name"]] = $variable["Value"];
		}
		return $result;
	}

	public function describeTable($table) {
		return $this->getResult("DESCRIBE $table;");
	}

	public function showTableIndex($table) {
		return $this->getResult("SHOW INDEX FROM $table");
	}

	public function checkTable($table, $type) {
		return $this->getResult("CHECK TABLE $table $type;");
	}

	public function repairTable($table) {
		return $this->getResult("REPAIR TABLE $table;");
	}

	public function showTableCreate($table) {
		return $this->getVar("SHOW CREATE TABLE $table;", 1);
	}

	public function rowsCount($table) {
		$count = $this->getVar("SELECT COUNT(*) FROM $table;");
		return intval($count);
	}

	public function createTable($query, $name, $usedbdelta = false) {
		$table = $this->getBVTable($name);
		if (!$this->isTablePresent($table)) {
			if ($usedbdelta) {
				if (!function_exists('dbDelta'))
					require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				dbDelta($query);
			} else {
				$this->query($query);
			}
		}
		return $this->isTablePresent($table);
	}

	public function createTables($tables, $usedbdelta = false) {
		$result = array();
		foreach ($tables as $table => $query) {
			$result[$table] = $this->createTable($query, $table, $usedbdelta);
		}
		return $result;
	}

	public function alterBVTable($query, $name) {
		$resp = false;
		$table = $this->getBVTable($name);
		if ($this->isTablePresent($table)) {
			$resp = $this->query($query);
		}
		return $resp;
	}

	public function alterTables($tables) {
		$result = array();
		foreach ($tables as $table => $query) {
			$result[$table] = $this->alterBVTable($query, $table);
		}
		return $result;
	}

	public function getTableContent($table, $fields = '*', $filter = '', $limit = 0, $offset = 0) {
		$query = "SELECT $fields from $table $filter";
		if ($limit > 0)
			$query .= " LIMIT $limit";
		if ($offset > 0)
			$query .= " OFFSET $offset";
		$rows = $this->getResult($query);
		return $rows;
	}

	public function isTablePresent($table) {
		return ($this->getVar("SHOW TABLES LIKE '$table'") === $table);
	}

	public function getCharsetCollate() {
		global $wpdb;
		return $wpdb->get_charset_collate();
	}

	public function getWPTable($name) {
		return ($this->dbprefix() . $name);
	}

	public function getBVTable($name) {
		return ($this->getWPTable("bv_" . $name));
	}

	public function truncateBVTable($name) {
		$table = $this->getBVTable($name);
		if ($this->isTablePresent($table)) {
			return $this->query("TRUNCATE TABLE $table;");
		} else {
			return false;
		}
	}

	public function deleteBVTableContent($name, $filter = "") {
		$table = $this->getBVTable($name);
		if ($this->isTablePresent($table)) {
			return $this->query("DELETE FROM $table $filter;");
		} else {
			return false;
		}
	}

	public function dropBVTable($name) {
		$table = $this->getBVTable($name);
		if ($this->isTablePresent($table)) {
			$this->query("DROP TABLE IF EXISTS $table;");
		}
		return !$this->isTablePresent($table);
	}

	public function dropTables($tables) {
		$result = array();
		foreach ($tables as $table) {
			$result[$table] = $this->dropBVTable($table);
		}
		return $result;
	}

	public function truncateTables($tables) {
		$result = array();
		foreach ($tables as $table) {
			$result[$table] = $this->truncateBVTable($table);
		}
		return $result;
	}

	public function deleteRowsFromtable($name, $count = 1) {
		$table = $this->getBVTable($name);
		if ($this->isTablePresent($table)) {
			return $this->getResult("DELETE FROM $table LIMIT $count;");
		} else {
			return false;
		}
	}

	public function replaceIntoBVTable($name, $value) {
		global $wpdb;
		$table = $this->getBVTable($name);
		return $wpdb->replace($table, $value);
	}

	public function insertIntoBVTable($name, $value) {
		global $wpdb;
		$table = $this->getBVTable($name);
		return $wpdb->insert($table, $value);
	}

	public function tinfo($name) {
		$result = array();
		$table = $this->getBVTable($name);

		$result['name'] = $table;

		if ($this->isTablePresent($table)) {
			$result['exists'] = true;
			$result['createquery'] = $this->showTableCreate($table);
		}

		return $result;
	}

	public function getMysqlVersion() {
		return $this->showDbVariables('version')['version'];
	}
}
endif;