<?php
if(!isset($config_file) || !isset($php_path)) exit;

mb_language('Japanese');
mb_internal_encoding('UTF-8');

session_start();

// CsrfValidator 読み込み
require_once $php_path . 'CsrfValidator.class.php';
new CsrfValidator();


// php 読み込み
require_once $php_path . 'func.php';

foreach($_POST as $key => $val){
	if(gettype($_POST[$key]) == 'string'){
		$_POST[$key] = stripslashes($val);
	} elseif(gettype($_POST[$key]) == 'array'){
		foreach ($_POST[$key] as $i => $v) {
			if(gettype($v) == 'string'){
				$_POST[$key][$i] = html_entity($v);
			}
		}
	}
}


// config 読み込み
require_once $config_file;

if(!isset($mode)) {
	$mode = $_POST["mode"];
}


if(!$mode) {
	unset($_SESSION['form']);
}

if($_POST["back_btn"] != '' || $_POST["back_btn_x"] != '') {
	$mode = 'back';
}

$form = array();

if($mode == "fin") {
	require $php_path . 'confirm.php';
	if(!$form_error) {
		require $php_path . 'fin.php';
	}
} elseif($mode == "confirm") {
	require $php_path . 'confirm.php';
}

if($mode != "confirm"){
	require $php_path . 'input.php';
}
// if($mode == "confirm" && !isset($confirm_page)) {
// 	header('location:' . $form_base_url . 'confirm/');
// 	exit;
// }

// テンプレート 読み込み
include $template_file;

