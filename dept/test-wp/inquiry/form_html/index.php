<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
$path = dirname(__FILE__) . '/../../include/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

$page_title = 'お問い合わせ';
$page_description = '';
$page_keywords = '';
include_once "meta.html";
?>

<!-- local -->
<script type="text/javascript" src="js/inquiry.js"></script>
<!-- /local -->

</head>

<body>
<?php include_once "head.html"; ?>

<div id="pageTitle">
	<h1><img src="images/page_title.png" width="192" height="40" alt="お問い合わせ" /></h1>
	<p><a href="<?php echo $abs_root; ?>">HOME</a> &gt; お問い合わせ</p>
<!-- / #pageTitle --></div>

<div id="contentsContainer">
	<div id="contentsArea">

		<div id="inquiryArea">
<?php if($mode != "confirm" && $form_error == "") : ?>
			<h2><img src="images/tel_title.png" width="421" height="45" alt="お電話でのご予約・お問い合わせ" /></h2>
			<p id="inquiryTel"><img src="images/tel.png" width="550" height="50" alt="" /></p>
<?php endif; ?>

			<h2 class="margin_b10"><img src="images/form_title.png" width="409" height="45" alt="メールでのお問い合わせ" /></h2>

<?php if($mode != "confirm") : ?>
			<p class="red margin_b10">入力内容にミスがあります。下記内容をお確かめの上、再度ご記入ください。</p>
			<ul class="red">
<?php echo $form_error; ?>
			</ul>
<?php elseif($mode == "confirm") : ?>
			<p>入力内容をご確認のうえ、よろしければ「上記内容で送信する」ボタンを押してください。</p>
<?php else : ?>
			<p class="margin_b10"><img src="images/form_text.png" width="566" height="50" alt="頂いたお問い合わせ内容には、折り返し当店からご連絡させて頂きますので、ご連絡が可能なお電話番号とご都合の良い時間帯をお教えください。" /></p>
			<p><em class="red">※印は必須事項になります。</em></p>
<?php endif; ?>


			<div id="inquiryForm"><div class="inner">
				<form action="./" method="post">
					<dl>
						<dt><img src="images/form_text02.gif" width="64" height="28" alt="お名前※" /></dt>
						<dd><?php echo $form['namae']; ?></dd>
					</dl>
					<dl>
						<dt><img src="images/form_text03.gif" width="68" height="28" alt="フリガナ※" /></dt>
						<dd><?php echo $form['kana']; ?></dd>
					</dl>
					<dl>
						<dt><img src="images/form_text04.gif" width="79" height="28" alt="電話番号※" /></dt>
						<dd><?php echo $form['tel01']; ?> - <?php echo $form['tel02']; ?> - <?php echo $form['tel03']; ?><?php if($mode != "confirm") : ?><p>例）011-512-7472　<em>半角数字</em></p><?php endif; ?></dd>
					</dl>
					<dl>
						<dt><img src="images/form_text05.gif" width="134" height="28" alt="連絡可能な時間帯※" /></dt>
						<dd><?php echo $form['time']; ?></dd>
					</dl>
					<dl>
						<dt><img src="images/form_text06.gif" width="54" height="28" alt="内容※" /></dt>
						<dd><?php echo $form['comm']; ?></dd>
					</dl>

<?php if($mode == "confirm") : ?>
					<p class="btn"><input type="image" src="images/btn_back_op.gif" name="back_btn" alt="戻る" /> <input type="image" src="images/btn_send_op.gif" value="上記内容で送信する" alt="上記内容で送信する" /><input type="hidden" name="mode" value="fin" /><?php echo $hidden; ?><input type="hidden" name="token" value="<?php echo CsrfValidator::generate(); ?>"></p>
<?php else : ?>
					<p class="btn"><input type="image" src="images/btn_confirm_op.gif" alt="ご入力内容の確認" /><input type="hidden" name="mode" value="confirm" /></p>
<?php endif; ?>


				</form>
			<!-- / #inquiryForm --></div></div>
		<!-- / #inquiryArea --></div>





	<!-- / #contentsArea --></div>

	<div id="sideArea">
		<div id="sideNavi">
			<dl>
				<dt><img src="images/side_title.png" width="225" height="46" alt="お問い合わせ" /></dt>
				<dd><ul>
					<li><strong><a href="./">お問い合わせフォーム</a></strong></li>
				</ul></dd>
			</dl>
		<!-- / #sideNavi --></div>
<?php include_once "side.html"; ?>
	<!-- / #sideArea --></div>
<!-- / #contentsContainer --></div>

<?php  include_once "foot.html"; ?>

</body>
</html>