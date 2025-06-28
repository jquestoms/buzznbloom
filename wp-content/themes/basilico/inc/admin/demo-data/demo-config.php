<?php

$uri = get_template_directory_uri() . '/inc/admin/demo-data/demo-imgs/';
$pxl_server_info = apply_filters( 'pxl_server_info', ['demo_url' => ''] ) ;
// Demos
$demos = array(
	// Elementor Demos
	'basilico-main' => array(
		'title'       => 'Main',
		'description' => '',
		'screenshot'  => $uri . 'main.jpg',
		'preview'     => $pxl_server_info['demo_url'] . 'main',
	),
	'basilico-luxury' => array(
		'title'       => 'Luxury',
		'description' => '',
		'screenshot'  => $uri . 'luxury.jpg',
		'preview'     => $pxl_server_info['demo_url'] . 'luxury',
	),
	'basilico-coffee' => array(
		'title'       => 'Coffee',
		'description' => '',
		'screenshot'  => $uri . 'coffee.jpg',
		'preview'     => $pxl_server_info['demo_url'] . 'coffee',
	),
	'basilico-pizza' => array(
		'title'       => 'Pizza',
		'description' => '',
		'screenshot'  => $uri . 'pizza.jpg',
		'preview'     => $pxl_server_info['demo_url'] . 'pizza',
	),
	'basilico-fastfood' => array(
		'title'       => 'Fastfood',
		'description' => '',
		'screenshot'  => $uri . 'fastfood.jpg',
		'preview'     => $pxl_server_info['demo_url'] . 'fastfood',
	),
	'basilico-sushi' => array(
		'title'       => 'Sushi',
		'description' => '',
		'screenshot'  => $uri . 'sushi.jpg',
		'preview'     => $pxl_server_info['demo_url'] . 'sushi',
	),
	'basilico-cream' => array(
		'title'       => 'Ice Cream',
		'description' => '',
		'screenshot'  => $uri . 'cream.jpg',
		'preview'     => $pxl_server_info['demo_url'] . 'icecream',
	),
	'basilico-seafood' => array(
		'title'       => 'Seafood',
		'description' => '',
		'screenshot'  => $uri . 'seafood.jpg',
		'preview'     => $pxl_server_info['demo_url'] . 'seafood',
	),
	'basilico-steak' => array(
		'title'       => 'Steak House',
		'description' => '',
		'screenshot'  => $uri . 'steak.jpg',
		'preview'     => $pxl_server_info['demo_url'] . 'steak',
	),
	'basilico-chocolate' => array(
		'title'       => 'Chocolate',
		'description' => '',
		'screenshot'  => $uri . 'chocolate.jpg',
		'preview'     => $pxl_server_info['demo_url'] . 'chocolate',
	),
	'basilico-chinafood' => array(
		'title'       => 'Chinafood',
		'description' => '',
		'screenshot'  => $uri . 'chinafood.jpg',
		'preview'     => $pxl_server_info['demo_url'] . 'chinafood',
	),
	'basilico-bakery' => array(
		'title'       => 'Bakery',
		'description' => '',
		'screenshot'  => $uri . 'bakery.jpg',
		'preview'     => $pxl_server_info['demo_url'] . 'bakery',
	),
);