<?php
if(!isset($fin_file)) {
	exit;
}

date_default_timezone_set('Asia/Tokyo');

// CSRFチェック
if (!CsrfValidator::validate(filter_input(INPUT_POST, 'token'))) {
	header('Content-Type: text/plain; charset=UTF-8', true, 400);
	die('CSRF validation failed.');
}
session_regenerate_id();

// メールテンプレート
ob_start();
include($tmp_adm);
$mail_adm = ob_get_contents();
ob_end_clean();

ob_start();
include($tmp_usr);
$mail_usr = ob_get_contents();
ob_end_clean();

if(!isset($adm_email)) {
	require(dirname( __FILE__ ) . '/mailaddress.php');
}

// 管理者宛てメール送信
if($_POST['email']){
	$admin_mail_head = "From: ".$_POST['email'];
	$returnpath = '-f ' . $_POST['email'];
} else {
	$admin_mail_head = "From: ".mb_encode_mimeheader($admin_name)."<".$adm_from_email.">";
	$returnpath = '-f ' . $adm_from_email;
}

if($adm_cc_email != "") $admin_mail_head .= "\nCc: " . $adm_cc_email;
if($adm_bcc_email != "") $admin_mail_head .= "\nBcc: " . $adm_bcc_email;


// メールデバッグ
if(isset($mail_debug_mode)) {
	echo '<pre>';
	echo '----------' . "\n";
	var_dump($admin_mail_head);
	echo '----------' . "\n";
	var_dump($subject_adm);
	echo '----------' . "\n";
	echo '----------' . "\n";
	var_dump($mail_adm);
	echo '----------' . "\n";
	echo '----------' . "\n";
	var_dump($form['email']);
	echo '----------' . "\n";
	echo '----------' . "\n";
	var_dump($subject_usr);
	echo '----------' . "\n";
	echo '----------' . "\n";
	var_dump($mail_usr);
	echo '</pre>';
	exit;
}

$mail_adm = mb_convert_encoding($mail_adm, 'ISO-2022-JP-ms', 'UTF-8');
$mail_usr = mb_convert_encoding($mail_usr, 'ISO-2022-JP-ms', 'UTF-8');


if(mb_send_mail($adm_email,$subject_adm,$mail_adm,$admin_mail_head,$returnpath)){
	if($_POST['email']){
		// ユーザ宛てメール送信
		if(isset($admin_name)) {
			$send_mail_head = "From: ".mb_encode_mimeheader($admin_name)."<".$adm_from_email.">";
		} else {
			$send_mail_head = "From: " . $adm_from_email;
		}
		mb_send_mail(
			$_POST['email'],
			$subject_usr,
			$mail_usr,
			$send_mail_head,
			'-f ' . $adm_from_email
		);
	};
}

if (!headers_sent($filename, $linenum)) {
	header('Location: ' . $fin_file);
} else {
	echo '送信が完了いたしました。<a href="/">トップページへ</a>' . "\n";
}

exit;
