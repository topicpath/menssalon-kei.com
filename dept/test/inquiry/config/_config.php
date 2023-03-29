<?php

// 管理者メールアドレス
$adm_email = 'info@menssalon-kei.com';

// 管理者CCメールアドレス(複数入力する場合はカンマで区切る)
$adm_cc_email = 't-tone1963@ezweb.ne.jp';

$admin_name = 'メンズサロン kei';


// メール件名
$subject_adm = 'お問い合わせフォームよりお問い合せ';	// 管理者宛
$subject_usr = 'お問い合わせありがとうございます[自動返信メール]';	// ユーザ宛


// メールテンプレート
$tmp_adm = 'config/_adm_mail_tpl.txt';	// 管理者宛
$tmp_usr = 'config/_usr_mail_tpl.txt';	// ユーザ宛


// htmlテンプレート
$template = '_index_tpl.html';


// 表示項目 'name' => array('type'=>(text,textarea,radio,checkbox,select), 'class'=>'class名', 'item'=>'チェックボックス・ラジオボタン・セレクトの時の項目の配列')
// nameがid名になります

$now_y = date("Y");
$time = array();
for($i = 9; $i <= 19; $i ++) $time[] = $i . '時ごろ';

$form_item = array(
	'name'	=>	array('type'=>'text',	'class'=>'size01'),			// お名前
	'kana'	=>	array('type'=>'text',	'class'=>'size01'),			// フリガナ
	'tel01'	=>	array('type'=>'text',	'class'=>'size02'),			// 電話番号
	'tel02'	=>	array('type'=>'text',	'class'=>'size02'),			// 電話番号
	'tel03'	=>	array('type'=>'text',	'class'=>'size02'),			// 電話番号

	'time'	=>	array('type'=>'select', 'default'=>'時間を選択して下さい',	'item'=>$time),		// 連絡可能な時間帯

	'comm'	=>	array('type'=>'textarea'),							// 内容
);


// 必須項目 'name' => array()
//		グループ化 'name1,name2' => ''
//
//		項目	'error_name'	=>	'エラー時に表示するテキスト'
//				'change_name'	=>	'分岐するname'			// 他の項目で必須が変わる場合
//				'change_value'	=>	'分岐する値'			// 他の項目で必須が変わる場合
//				'change_flg'	=>	'必須にする(false) or 必須にしない(true)'	// 他の項目で必須が変わる場合　デフォルトtrue
//				'return_val'	=>	'リターン名'			// グループ化してる場合のリターン変数

$check_hissu = array(
	'name'	=>	array('error_name'=>'お名前'),
	'kana'	=>	array('error_name'=>'フリガナ'),
	'tel01,tel02,tel03'	=>	array('error_name'=>'電話番号', return_val=>'tel'),
	'time'	=>	array('error_name'=>'連絡可能な時間帯'),
	'comm'	=>	array('error_name'=>'内容'),
);


// アドレスチェック
// $check_mail = array('email');


// アドレス確認チェック
// $check_same_mail = array('email', 'email2');


// ラジオボタン初期値 （ 'name' => '表示名'）
$default_checked = array(
	'kind' => 'ご予約'
);

?>
