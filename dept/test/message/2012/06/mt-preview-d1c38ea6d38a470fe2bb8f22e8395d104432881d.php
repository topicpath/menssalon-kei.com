<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/include/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

$page_title = 'kei\'s Message';
$page_description = '';
$page_keywords = '';
include_once "meta.html";
?>

</head>

<body>
<?php include_once "head.html"; ?>

<div id="pageTitle">
<h1><img src="/message/images/page_title.png" width="227" height="40" alt="kei's Message" /></h1>
<p><a href="<?php echo $abs_root;?>">HOME</a> &gt; kei's Message</p>
<!-- / #pageTitle --></div>

<div id="contentsContainer">
<div id="contentsArea">

<div id="messageBox">


<div id="messageDetail">
<p class="date">2012年06月14日</p>
<div class="title"><h2></h2></div>

<div class="body"> </div>


<p class="text_c"><a href="/message/">一覧を見る</a>｜<a href="/message/2012/06/post-9.php">次へ &gt;&gt;</a></p>

<!-- / #messageDetail --></div>


<div id="messageSide">
<dl>
<dt><img src="/message/images/recent_title.png" width="107" height="22" alt="最近の記事一覧" /></dt>
<dd><ul>

<li><em>2012年06月14日</em><br />
<a href="/message/2012/06/post-9.php">★日本ハムファイターズ、チケットプレゼント第３弾！ </a></li><li><em>2012年05月26日</em><br />
<a href="/message/2012/05/2000.php">稲葉選手の2000本安打！ </a></li><li><em>2012年05月16日</em><br />
<a href="/message/2012/05/post-8.php">月下美人ではなかった(￣○￣;) </a></li>
</ul></dd>
</dl>
<dl>
<dt><img src="/message/images/past_title.png" width="107" height="22" alt="過去の記事一覧" /></dt>
<dd><ul>
<li><a href="/message/2012/06/">2012年6月(1)</a></li><li><a href="/message/2012/05/">2012年5月(3)</a></li><li><a href="/message/2012/04/">2012年4月(5)</a></li><li><a href="/message/2012/03/">2012年3月(4)</a></li>
</ul></dd>
</dl>
<!-- / #messageSide --></div>

<!-- / #messageBox --></div>

<!-- / #contentsArea --></div>

<div id="sideArea">
<?php include_once "side.html"; ?>
<!-- / #sideArea --></div>
<!-- / #contentsContainer --></div>

<?php include_once "foot.html"; ?>

</body>
</html>