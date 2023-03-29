<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
$path = '../include/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

$page_title = '赤ちゃん筆';
$page_description = '赤ちゃんの髪の毛で筆をつくろう！産毛を使って製作する「赤ちゃん筆」「胎毛筆」は記念にピッタリ。100人以上の実績で安心！光文堂・赤ちゃん筆センターの加盟店、札幌市中央区のメンズサロンkei。';
$page_keywords = '赤ちゃん筆,札幌';
include_once "meta.html";
?>

</head>

<body>
<?php include_once "head.html"; ?>

<div id="pageTitle">
	<h1><img src="images/page_title.png" width="162" height="40" alt="赤ちゃん筆" /></h1>
	<p><a href="<?php echo $abs_root;?>">HOME</a> &gt; 赤ちゃん筆</p>
<!-- / #pageTitle --></div>

<div id="contentsContainer">
	<div id="contentsArea">

		<div id="fudeIndexContents">
			<h2><img src="images/main.png" width="700" height="640" alt="これまで100人以上の赤ちゃんとご父母の方に喜ばれています。" /></h2>
			<div class="section01">
				<p>産毛を使って製作する「赤ちゃん筆」「胎毛筆」は一生の記念となる思い出の品です。<br />
					乳児のカットを断られたことのある親御さんもいらっしゃると思いますが、赤ちゃんが泣いたり、暴れたりするのは当たり前のことです。<br />
					当店では100人以上の実績がありますので安心してご相談してください。</p>
			<!-- / .section01 --></div>

			<div class="section02">
				<p>赤ちゃんの時に作れなかった方でも「成人の記念」「還暦のお祝い」など大人になってからでも製作できます。<br />
					ご家族の一生の思い出になる様に、一生懸命お手伝いさせていただきます。</p>
				<p>初めての調髪となる場合も多いのでご両親の他、お祖父様やお祖母様方々とご一緒に来店していただくことも歓迎いたします。カット中の撮影もご自由にしていただいてOKですので是非カメラやビデオをご持参してください。</p>
			<!-- / .section02 --></div>

		<!-- / #fudeIndexContents --></div>

		<ul id="fudeBottomNavi">
			<li><a href="about/"><img src="images/bottom_navi_about_op.png" width="134" height="145" alt="赤ちゃん筆について" /></a></li>
			<li><a href="flow/"><img src="images/bottom_navi_flow_op.png" width="134" height="145" alt="筆ができるまで" /></a></li>
			<li><a href="results/"><img src="images/bottom_navi_results_op.png" width="134" height="145" alt="実績紹介" /></a></li>
			<li><a href="qa/"><img src="images/bottom_navi_qa_op.png" width="134" height="145" alt="Q&amp;A" /></a></li>
		<!-- / #fudeBottomNavi --></ul>

	<!-- / #contentsArea --></div>

	<div id="sideArea">
		<div id="sideNavi">
			<dl>
				<dt><img src="images/side_title.png" width="225" height="46" alt="赤ちゃん筆" /></dt>
				<dd><ul>
					<li><strong><a href="./">TOP</a></strong></li>
					<li><a href="about/">赤ちゃん筆について</a></li>
					<li><a href="flow/">筆ができるまで</a></li>
					<li><a href="results/">実績紹介</a></li>
					<li><a href="qa/">Q&amp;A</a></li>
				</ul></dd>
			</dl>
		<!-- / #sideNavi --></div>

<?php include_once "side.html"; ?>
	<!-- / #sideArea --></div>
<!-- / #contentsContainer --></div>

<?php include_once "foot.html"; ?>

</body>
</html>