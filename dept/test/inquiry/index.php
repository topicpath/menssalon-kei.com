<?php
mb_language('Japanese');
mb_internal_encoding('UTF-8');

require_once('../libs/Smarty.class.php');
$smarty = new Smarty;

$smarty->template_dir = getcwd();
$smarty->cache_dir = "cache";
$smarty->compile_dir = "templates_c";

//$smarty->caching = 1;
//$smarty->compile_check = true;
//$smarty->debugging = true;

include_once "config/_config.php";

if ( get_magic_quotes_gpc() ) {
	foreach($_POST as $key => $val){
		if(gettype($_POST[$key]) == 'string'){
			$_POST[$key] = stripslashes($val);
		}
	}
}




$mode = $_POST["mode"];

if($_POST["back_btn"] != '' || $_POST["back_btn_x"] != '') $mode = 'back';

$error = "";
$error_arr = array();

if($mode == "fin") {
	// <br />を改行に戻す
	foreach($_POST as $key => $val){
		if(gettype($_POST[$key]) == 'string'){
			$val = preg_replace("/<br \/>/","\n",$val);
			$_POST[$key] = $val;
		}
	}

	// メールテンプレート
	$mail_adm = file($tmp_adm);
	$mail_usr = file($tmp_usr);
	mb_convert_variables(mb_internal_encoding(), 'auto', $mail_adm, $mail_usr);


	// 送信日時
	$send_date = date('Y/m/d H:i:s');


	// 項目名リストの抽出＆入力値の設定
	foreach($_POST as $key => $val){
		// 入力値の設定
		if($key == 'mode'){ continue; }
		if($key == 'Submit'){ continue; }
		
		if(gettype($_POST[$key]) == 'string'){
			$replacements[$key] = $val;
		}
		
		// 項目名リスト
		$item_list[] = $key;
	}


	// 置換のための正規表現
	foreach($item_list as $value){
		$patterns[$value] = "(_%$value%_)";
	}

	// 置換→HTML書き出し（管理者宛て）
	$my_value = "";
	foreach($mail_adm as $values){
		$values = preg_replace($patterns, $replacements, $values);
		$values = preg_replace('/(_%send_date%_)/', $send_date, $values);
		$values = preg_replace('/(_%.+?%_)/', '', $values);
		$my_value .= "$values";
	}

	$mailbody_adm .= $my_value;

	// 管理者宛てメール送信
	$admin_mail_head = "From: ".mb_encode_mimeheader($admin_name)."<".$adm_email.">";
	if($adm_cc_email != "") $admin_mail_head .= "\nCc: " . $adm_cc_email;
	if( mb_send_mail($adm_email,$subject_adm,$mailbody_adm,$admin_mail_head)){
		// 置換→HTML書き出し（ユーザ宛て）
		$my_value = "";
		foreach($mail_usr as $values){
			$values = preg_replace($patterns, $replacements, $values);
			$values = preg_replace('/(_%send_date%_)/', $send_date, $values);
			$values = preg_replace('/(_%.+?%_)/', '', $values);
			$my_value .= "$values";
		}
		$mailbody_usr .= $my_value;
		
		// ユーザ宛てメール送信
/*		if($_POST['email']){
			mb_send_mail(
				$_POST['email'],
				$subject_usr,
				$mailbody_usr,
				"From: ".mb_encode_mimeheader($admin_name)."<".$adm_email.">"
			);
		};*/
	}
	if (!headers_sent($filename, $linenum)) {
		header('Location: thanks.php');
		exit;
	} else {
		echo "送信が送信完了いたしました。<a href="/">トップページへ</a>\n";
		exit;
	}

}elseif($mode == "confirm") {

	$error = "";
	// 必須チェック
	$hissu_comm = array('text' => '入力してください。', 'textarea' => '入力してください。', 'radio' => '選択してください。', 'select' => '選択してください。', 'checkbox' => '選択してください。');

	foreach($check_hissu as $key => $val){
		$error_flg = false;
		$return_val = $val['return_val'] ? $val['return_val'] : $key;
		$key_arr = explode(",", $key);
		$key = $key_arr[0];

		foreach($key_arr as $v){
			if($val['change_name'] && $val['change_value']){	// 分岐時
				if($_POST[$val['change_name']] == $val['change_value'] && $_POST[$v] == '') $error_flg = true;
			}elseif ($_POST[$v] == ''){
				$error_flg = true;
			}
		}

		if($error_flg){
			$error .= "<li>・「".$val['error_name']."」を".$hissu_comm[$form_item[$key]['type']]."</li>\n";
			$error_arr[$return_val] = $hissu_comm[$form_item[$key]['type']];
		}

		// メールアドレスチェック
		if(isset($check_mail) && in_array($key, $check_mail)) {
			if($_POST[$key] && !emailcheck($_POST[$key])){
				$error .= "<li>・「".$val['error_name']."」を正しく入力してください。</li>\n";
				$error_arr[$key] = "正しく入力してください。";
			}
		}

		// メールアドレス確認一致チェック
		if(isset($check_same_mail) && $check_same_mail[1] == $key && !isset($error_arr[$check_same_mail[0]]) && !isset($error_arr[$check_same_mail[1]]) && $_POST[$check_same_mail[0]] != $_POST[$check_same_mail[1]]) {
			$error .= "<li>・「メールアドレス」と「メールアドレス確認用」が一致しません。</li>\n";
			$error_arr[$key] = "メールアドレスが一致しません。";
		}
	}

	// HTMLエンティティに変換＆カナ変換
	foreach($_POST as $key => $val){
		if(gettype($_POST[$key]) == 'string'){
			$_POST[$key] = html_entity($val);
		}
	}

	if($error == ""){
		$hidden = "";
		foreach($_POST as $key => $val){
			if($key == 'mode'){ continue; }
			if($key == 'Submit'){ continue; }
			if($key == 'x'){ continue; }
			if($key == 'y'){ continue; }

			$smarty->assign("$key",$val ? $val : '&nbsp;');
			$hidden .= '<input type="hidden" name="'.$key.'" value="'.(is_array($val) ? implode("___", $val) : $val).'" />';
		}
	}else {
		$mode = "";
	}
}

if($mode == "" || $mode == "back"){
	foreach($form_item as $key => $val){
		$input = '';

		$class = $val['class'] ? ' class="' . $val['class'] . '"' : '';

		if($val['type'] == "text") {
			$input = '<input type="text" name="'.$key.'" id="'.$key.'" value="'.$_POST[$key].'"' . $class . ' />';
		}elseif($val['type'] == "textarea") {
			$input = '<textarea name="'.$key.'" id="'.$key.'" rows="4" cols="40"' . $class . '>'.br2nl($_POST[$key]).'</textarea>';
		}elseif($val['type'] == "checkbox") {
			$post_arr = is_array($_POST[$key]) ? $_POST[$key] : explode("___", $_POST[$key]);
			$i = 0;
			$input = '<ul>';
			foreach ($val['item'] as $v) {
				$checked = in_array($v, $post_arr) ? ' checked="checked"' : '';
				$input .= '<li><label for="'.$key.$i.'"><input type="checkbox" name="'.$key.'[]" value="'.$v.'" id="'.$key.$i.'"'.$checked.' /> '.$v.'</label></li>';
				$i ++;
			}
			$input .= '</ul>';
		}elseif($val['type'] == "radio") {
			$i = 0;
			$input = '<ul>';
			foreach ($val['item'] as $v) {
				$checked = $_POST[$key] ? (($v == $_POST[$key]) ? ' checked="checked"':'') : $v == $default_checked[$key] ? ' checked="checked"':'';
				$input .= '<li><label for="'.$key.'-'.$i.'"><input type="radio" name="'.$key.'" value="'.$v.'" id="'.$key.'-'.$i.'"'.$checked.' /> '.$v.'</label></li>';
				$i ++;
			}
			$input .= '</ul>';
		}elseif($val['type'] == "select") {
			$input = '<select name="'.$key.'">';
			if($val['default']) $input .= '<option value="" class="default">' . $val['default'] . '</option>';
			foreach ($val['item'] as $v) {
				$selected = ($v == $_POST[$key]) ? ' selected="selected"':'';
				$input .= '<option value="'.$v.'"'.$selected.'>'.$v.'</option>';
			}
			$input .= '</select>';
		}
		$smarty->assign($key, $input);
	}
}

if($mode == "back") $mode = "";

$smarty->assign("back",$_POST["back"]);
$smarty->assign("mode",$mode);

$smarty->assign("hidden",$hidden);
$smarty->assign("error",$error);
$smarty->assign("error_arr",$error_arr);


$smarty->display($template);


// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
// 関数
// ────────────────────────────────────────────────────


//────────────────────────
// メールアドレスチェック
//────────────────────────
function emailcheck ($email) {
	$error_flag = '0';
	if(preg_match('/[-._a-zA-Z0-9]+\@[-._a-zA-Z0-9]+\.[-._a-zA-Z0-9]+/', $email)){ $error_flag = '1'; }
	return ($error_flag);
}


//────────────────────────
// brを改行へ
//────────────────────────
function br2nl($string){
	return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
}


//────────────────────────
// HTMLエンティティに変換＆カナ変換
//────────────────────────
function html_entity ($val) {
	$val = mb_convert_kana($val, "KVa" , 'UTF-8');
	$val = htmlspecialchars($val, 1);

	$val = preg_replace("/(\")/", '”',$val);
	$val = nl2br($val);
	$val = preg_replace("/(\r|\n)/",'',$val);
	return ($val);
}


?>
