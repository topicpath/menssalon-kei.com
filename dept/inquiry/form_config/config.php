<?php

// メール件名
// =========================================================
$subject_adm = 'お問い合わせフォームよりお問い合せ';	// 管理者宛
$subject_usr = 'お問い合わせありがとうございます[自動返信メール]';	// ユーザー宛

// メールテンプレート
// =========================================================
$tmp_adm = dirname( __FILE__ ) . '/admin.php';
$tmp_usr = dirname( __FILE__ ) . '/mail.php';

// テンプレートファイル
// =========================================================
$template_file = dirname( __FILE__ ) . '/../form_html/index.php';

// finファイル
// =========================================================
$fin_file = 'thanks.php';

// debug
// =========================================================
// $mail_debug_mode = true;

// フォーム項目
// =========================================================
$now_y = date("Y");
$time = array();
for($i = 9; $i <= 19; $i ++) $time[] = $i . '時ごろ';

$form_item = array(
	'namae'	=>	array('type'=>'text',	'class'=>'size01'),
	'kana'	=>	array('type'=>'text',	'class'=>'size01'),			// フリガナ
	'tel01'	=>	array('type'=>'text',	'class'=>'size02'),			// 電話番号
	'tel02'	=>	array('type'=>'text',	'class'=>'size02'),			// 電話番号
	'tel03'	=>	array('type'=>'text',	'class'=>'size02'),			// 電話番号
	'time'	=>	array('type'=>'select', 'default_text'=>'時間を選択して下さい',	'item'=>$time),		// 連絡可能な時間帯
	'comm'	=>	array('type'=>'textarea'),							// 内容
);


// 必須項目 'name' => array()
$check_hissu = array(
	'namae'	=>	array('error_name'=>'お名前'),
	'kana'	=>	array('error_name'=>'フリガナ'),
	'tel01,tel02,tel03'	=>	array('error_name'=>'電話番号', 'return_val'=>'tel'),
	'time'	=>	array('error_name'=>'連絡可能な時間帯'),
	'comm'	=>	array('error_name'=>'内容'),
);

// $use_privacy = true;

// 全角チェック
// $check_zenkaku = array('kana');

// アドレスチェック
// $check_mail = array('email');
// $check_same_mail = array('mail', 'mail2');


