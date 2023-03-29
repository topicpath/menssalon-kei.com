<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
$path = '../include/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

$page_title = 'お問い合わせ';
$page_description = '';
$page_keywords = '';
include_once "meta.html";
?>

</head>

<body>
<?php include_once "head.html"; ?>

<div id="pageTitle">
	<h1><img src="images/page_title.png" width="192" height="40" alt="お問い合わせ" /></h1>
	<p><a href="{php} echo $abs_root;{/php}">HOME</a> &gt; お問い合わせ</p>
<!-- / #pageTitle --></div>

<div id="contentsContainer">
	<div id="contentsArea">

		<div id="inquiryArea">
			<h2 class="margin_b10"><img src="images/form_title.png" width="409" height="45" alt="メールでのお問い合わせ" /></h2>

			<div id="inquiryForm"><div class="inner">

				<div id="formFin">
					<p><strong>メールの送信が完了しました。</strong></p>
					<p>折り返し当店からご連絡させて頂きます。</p>
					<p>しばらく経っても連絡がない場合は、<br />
						正しくメールが送信されなかった可能性がございます。<br />
						その場合は大変お手数ですが、直接ご連絡いただければ幸いです。</p>
					<p>お問い合わせありがとうございました。</p>
					<p class="margin_t30 text_c"><a href="../">メンズサロン kei トップページへ</a></p>
				<!-- / #formFin --></div>

			<!-- / #inquiryForm --></div></div>
		<!-- / #inquiryArea --></div>

	<!-- / #contentsArea --></div>

	<div id="sideArea">
<?php include_once "side.html"; ?>
	<!-- / #sideArea --></div>
<!-- / #contentsContainer --></div>

<?php include_once "foot.html"; ?>

</body>
</html>