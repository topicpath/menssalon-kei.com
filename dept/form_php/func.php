<?php

// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
// 関数
// ────────────────────────────────────────────────────


//────────────────────────
// メールアドレスチェック
//────────────────────────
function emailcheck ($email) {
	$error_flag = '0';
	if(preg_match('/^[-+.\\w]+@[-a-z0-9]+(\\.[-a-z0-9]+)*\\.[a-z]{2,10}$/i', $email)){ $error_flag = '1'; }
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
//	$val = mb_convert_kana($val, "KVa", 'UTF-8');
	$val = mb_convert_kana($val, "KV", 'UTF-8');

	$val = preg_replace("/(\")/", '”',$val);
	$val = preg_replace("/(\')/", '’',$val);
//	$val = preg_replace("/</", '＜',$val);
//	$val = preg_replace("/>/", '＞',$val);

	$val = htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
	$val = nl2br($val);
	$val = preg_replace("/(\r|\n)/",'',$val);
	return ($val);
}


//────────────────────────
// 配列か連想配列か
//────────────────────────
function is_vector(array $arr) {
	return array_values($arr) === $arr;
}

//────────────────────────
// 都道府県
//────────────────────────
function getPref(){
	return array('北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県','茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県','新潟県','富山県','石川県','福井県','山梨県','長野県','岐阜県','静岡県','愛知県','三重県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県','山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県');
}



//────────────────────────
// メール本文が一行1000バイトを超えると文字化ける問題
// https://qiita.com/saekis/items/7ef6b0d6a9a7180e3ebe
//────────────────────────
function _preventGarbledCharacters($bigText, $width=249) {
	// wordwrap()はマルチバイト未対応のため正規表現を使う。
	$pattern = "/(.{1,{$width}})(?:\\s|$)|(.{{$width}})/uS";
	$replace = '$1$2' . "\n";
	$wrappedText = preg_replace($pattern, $replace, $bigText);
	return $wrappedText;
}





