<?php

// session登録
if($mode != 'fin') {
	foreach($form_item as $key => $v){
		$val = $_POST[$key];
		if($v['type'] == 'select' || $v['type'] == 'radio' || $v['type'] == 'hidden') {
			$_SESSION['form'][$key] = trim($val);
		} elseif($v['type'] == 'checkbox') {
			$_SESSION['form'][$key] = $val;
		} else {
			$_SESSION['form'][$key] = mb_convert_kana(trim($val), "KVa", 'UTF-8');
		}
		if($v['has_other']) {
			$_SESSION['form'][$key.'_other'] = mb_convert_kana(trim($_POST[$key.'_other']), "KVa", 'UTF-8');
		}
	}
}


$form_error = "";
// 必須チェック
$hissu_comm = array('text' => '入力して下さい。', 'tel' => '入力して下さい。', 'number' => '入力して下さい。', 'email' => '入力して下さい。', 'textarea' => '入力して下さい。', 'radio' => '選択して下さい。', 'select' => '選択して下さい。', 'checkbox' => '選択して下さい。');

foreach($check_hissu as $key => $val){
	$error_flg = false;
	$return_val = $val['return_val'] ? $val['return_val'] : $key;
	$key_arr = explode(",", $key);
	$key = $key_arr[0];

	if($val['compare'] == 'or') {
		$error_flg = true;
	}

	foreach($key_arr as $v){
		if($val['change_name'] && $val['change_value']){	// 分岐時
			if((($_SESSION['form'][$val['change_name']] == $val['change_value']) || (is_array($val['change_value']) && in_array($_SESSION['form'][$val['change_name']], $val['change_value']))) && $_SESSION['form'][$v] == '') $error_flg = true;
		}elseif ($val['compare'] == 'or'){
			if ($_SESSION['form'][$v] != '') $error_flg = false;
		}elseif ($_SESSION['form'][$v] == ''){
			$error_flg = true;
		}
	}
	if($error_flg && !$val['non_hissu']){
		$hissu_comm_txt = $val['hissu_comm'] ? $val['hissu_comm'] : $hissu_comm[$form_item[$key]['type']];
		if($val['error_text']) {
			$form_error .= "<li><span>・</span>".$val['error_text']."</li>\n";
			$error_arr[$return_val] = $val['error_text'];
		} else {
			$form_error .= "<li><span>・</span>「".$val['error_name']."」を".$hissu_comm_txt."</li>\n";
			$error_arr[$return_val] = "「".$val['error_name']."」を".$hissu_comm_txt;
		}
//		$error_arr[$return_val] = is_string($error_flg) ? $error_flg : $hissu_comm_txt;
	}

	// メールアドレスチェック
	if(isset($check_mail) && in_array($key, $check_mail)) {
		if($_SESSION['form'][$key] && !emailcheck($_SESSION['form'][$key])){
			$form_error .= "<li><span>・</span>「".$val['error_name']."」を正しく入力して下さい。</li>\n";
			$error_arr[$return_val] = "".$val['error_name']."を正しく入力して下さい。";
		}
	}

	// メールアドレス確認一致チェック
	if(isset($check_same_mail) && $check_same_mail[1] == $key && !isset($error_arr[$check_same_mail[0]]) && !isset($error_arr[$check_same_mail[1]]) && $_SESSION['form'][$check_same_mail[0]] != $_SESSION['form'][$check_same_mail[1]]) {
		$form_error .= "<li><span>・</span>「E-mail」と「E-mail(確認用)」が一致しません。</li>\n";
		$error_arr[$return_val] = "メールアドレスが一致しません。";
	}

	// 半角数字チェック
	if(isset($check_han_num) && in_array($key, $check_han_num)) {
		$_SESSION['form'][$key] = html_entity($_SESSION['form'][$key]);
		$_SESSION['form'][$key] = str_replace('　', ' ', $_SESSION['form'][$key]);
		$_SESSION['form'][$key] = str_replace(' ', '', $_SESSION['form'][$key]);
		$_SESSION['form'][$key] = str_replace('-', '', $_SESSION['form'][$key]);
		$_SESSION['form'][$key] = mb_convert_kana($_SESSION['form'][$key], "a", "UTF-8");
		if($_SESSION['form'][$key] && !preg_match("/^[0-9]+$/",$_SESSION['form'][$key])){
			$form_error .= "<li><span>・</span>「".$val['error_name']."」は半角数字で入力して下さい。</li>\n";
			$error_arr[$return_val] = "半角数字で入力して下さい。";
		}
	}

	// 電話番号チェック
	if(isset($check_tel) && in_array($key, $check_tel)) {
		$_SESSION['form'][$key] = html_entity($_SESSION['form'][$key]);
		$_SESSION['form'][$key] = str_replace('　', ' ', $_SESSION['form'][$key]);
		$_SESSION['form'][$key] = str_replace(' ', '', $_SESSION['form'][$key]);
		$_SESSION['form'][$key] = mb_convert_kana($_SESSION['form'][$key], "a", "UTF-8");
		$_SESSION['form'][$key] = str_replace(array('ー', '―', '－', '～', '~', '‐'), '-', $_SESSION['form'][$key]);
		if($_SESSION['form'][$key] && !preg_match("/^[0-9-]+$/",$_SESSION['form'][$key])){
			$form_error .= "<li><span>・</span>「".$val['error_name']."」は半角数字(ハイフン可)で入力して下さい。</li>\n";
			$error_arr[$return_val] = "半角数字(ハイフン可)で入力して下さい。";
		}

		// 正当な番号チェック
		elseif($_SESSION['form'][$key]) {
			if(!preg_match("/^(090|080|070)-\d{4}-\d{4}$|^\d{2}-\d{4}-\d{4}$|^07[^0]-\d{3}-\d{4}$|^08[^0]-\d{3}-\d{4}$|^09[^0]-\d{3}-\d{4}$|^0[0-6]\d{1}-\d{3}-\d{4}$|^\d{4}-\d{2}-\d{4}$|^\d{5}-\d{1}-\d{4}$|^(090|080|070)\d{8}$|^07[^0]\d{7}$|^08[^0]\d{7}$|^09[^0]\d{7}$|^0[0-6]\d{8}$/",$_SESSION['form'][$key])){
				$form_error .= "<li><span>・</span>「".$val['error_name']."」が正しくありません。</li>\n";
				$error_arr[$return_val] = "電話番号が正しくありません。";
			}
		}
	}

	// 全角チェック
	if(isset($check_zenkaku) && in_array($key, $check_zenkaku)) {
		$_SESSION['form'][$key] = html_entity($_SESSION['form'][$key]);
		$_SESSION['form'][$key] = str_replace(' ', '　', $_SESSION['form'][$key]);
		$_SESSION['form'][$key] = mb_convert_kana($_SESSION['form'][$key], "A", "UTF-8");
		// if($_SESSION['form'][$key] && !preg_match("/^[ァ-ヶー 　\r\n\t]+$/u", $_SESSION['form'][$key])){
		// 	$form_error .= "<li>・「".$val['error_name']."」は全角カタカナで入力して下さい。</li>\n";
		// 	$error_arr[$return_val] = "全角カタカナで入力して下さい。";
		// }
	}

	// カナチェック
	if(isset($check_kana) && in_array($key, $check_kana)) {
		$_SESSION['form'][$key] = html_entity($_SESSION['form'][$key]);
		$_SESSION['form'][$key] = str_replace(' ', '　', $_SESSION['form'][$key]);
		$_SESSION['form'][$key] =  mb_convert_kana($_SESSION['form'][$key], "KVC", "UTF-8");
		if($_SESSION['form'][$key] && !preg_match("/^[ァ-ヶー 　\r\n\t]+$/u", $_SESSION['form'][$key])){
			$form_error .= "<li><span>・</span>「".$val['error_name']."」は全角カタカナで入力して下さい。</li>\n";
			$error_arr[$return_val] = "全角カタカナで入力して下さい。";
		}
	}

	// 日付チェック
	if(isset($check_date) && is_array($check_date[$key])) {
		if(!checkdate($_SESSION['form'][$check_date[$key][1]], $_SESSION['form'][$check_date[$key][2]], $_SESSION['form'][$check_date[$key][0]])) {
			$form_error .= "<li><span>・</span>「".$val['error_name']."」が正しくありません。</li>\n";
			$error_arr[$return_val] = "正しい日付を選択して下さい。";
		}
	}
}

// プライバシーポリシー
if(isset($use_privacy) && !isset($_SESSION['form']['privacy'])) {
	$form_error .= "<li><span>・</span>個人情報の取り扱いに同意をお願いします。</li>\n";
	$error_arr['privacy'] = "同意をお願いします";
}



// HTMLエンティティに変換＆カナ変換
/*
foreach($form_item as $key => $v){
	$val = $_SESSION['form'][$key];
	if(!($form_item[$key]['type'] == 'select' || $form_item[$key]['type'] == 'radio' || $form_item[$key]['type'] == 'checkbox' || $form_item[$key]['type'] == 'hidden')) {
		if(gettype($_SESSION['form'][$key]) == 'string'){
			$_SESSION['form'][$key] = html_entity($val);
		} elseif(gettype($_SESSION['form'][$key]) == 'array'){
			foreach ($_SESSION['form'][$key] as $i => $val) {
				if(gettype($val) == 'string'){
					$_SESSION['form'][$key][$i] = html_entity($val);
				}
			}
		}
	} elseif (gettype($_SESSION['form'][$key]) == 'string') {
		$_SESSION['form'][$key] = htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
	} elseif(gettype($_SESSION['form'][$key]) == 'array'){
		foreach ($_SESSION['form'][$key] as $i => $val) {
			if(gettype($val) == 'string'){
				$_SESSION['form'][$key][$i] = html_entity($val);
			}
		}
	}

	if($form_item[$key]['has_other']) {
		$val = $_SESSION['form'][$key.'_other'];
		if(gettype($_SESSION['form'][$key.'_other']) == 'string'){
			$_SESSION['form'][$key.'_other'] = html_entity($val);
		}
	}
}
*/

if($form_error == ""){
	if($mode == 'confirm' || $mode == 'fin') {
		$hidden = "";

		foreach($form_item as $key => $v){
			$val = $_SESSION['form'][$key];
			if(is_array($val)) {
				if($mode == 'confirm') {
					$prefix = isset($v['conf_prefix']) ? $v['conf_prefix'] : '';
					$suffix = isset($v['conf_suffix']) ? $v['conf_suffix'] : '　';
				} else {
					$prefix = isset($v['conf_prefix']) ? $v['conf_prefix'] : '';
					$suffix = isset($v['conf_suffix']) ? $v['conf_suffix'] : '　';
				}
				$form["$key"] = '';
				foreach($val as $i => $vv) {
					$view_v = $vv;
					if($v['has_other']) {
						$other_label = $v['other_label'] ? $v['other_label'] : 'その他';
						if($vv == $other_label && $_SESSION['form'][$key.'_other']) {
							$view_v .= '（' . $_SESSION['form'][$key.'_other'] . '）';
						}
					}
					$form["$key"] .= $prefix . $view_v;
					$form["$key"] .= $suffix;
				}
			} else {
				$view_v = $val;
				if($v['type'] == "radio" && !is_vector($v['item'])) {
					$view_v = $v['item'][$val];
				}
				if($v['has_other']) {
					$other_label = $v['other_label'] ? $v['other_label'] : 'その他';
					if($val == $other_label && $_SESSION['form'][$key.'_other']) {
						$view_v .= '（' . $_SESSION['form'][$key.'_other'] . '）';
					}
				}
				if($view_v != '' && $v['prefix']) {
					$view_v = $v['prefix'] . $view_v;
				}
				if($view_v != '' && $v['suffix']) {
					$view_v = $view_v . $v['suffix'];
				}

				$form["$key"] = $view_v;
			}

			if($mode == 'confirm' && $form["$key"]) {
				$form["$key"] = '<span class="confirm_text">' . nl2br(htmlspecialchars($form["$key"], ENT_QUOTES, 'UTF-8')) . '</span>';
			}
			if($mode == 'fin') {
				$_POST[$key] = $val;
			}
		}
	}
}else {
	$mode = "error";
}
