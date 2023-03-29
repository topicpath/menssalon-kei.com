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
<p class="date">2012年03月31日</p>
<div class="title"><h2>勝った！</h2></div>

<div class="body">斉藤、勝ちましたね！<div>涌井に投げ勝つとは、恐れ入りました。</div><div>本日は割引券配布dayです。勝も勝ってね。(笑）</div></div>


<p class="text_c"><a href="/message/2012/04/post-4.php">&lt;&lt; 前へ</a>　<a href="/message/">一覧を見る</a>｜<a href="/message/2012/03/post-2.php">次へ &gt;&gt;</a></p>

<!-- / #messageDetail --></div>


<div id="messageSide">
<dl>
<dt><img src="/message/images/recent_title.png" width="107" height="22" alt="最近の記事一覧" /></dt>
<dd><ul>

<li><em>2012年04月04日</em><br />
<a href="/message/2012/04/post-4.php">札幌ドーム</a></li><li><em>2012年03月31日</em><br />
<a href="/message/2012/03/post-3.php">勝った！</a></li><li><em>2012年03月29日</em><br />
<a href="/message/2012/03/post-2.php">ファイターズ開幕！</a></li>
</ul></dd>
</dl>
<dl>
<dt><img src="/message/images/past_title.png" width="107" height="22" alt="過去の記事一覧" /></dt>
<dd><ul>
<li><a href="/message/2012/04/">2012年4月(1)</a></li><li><a href="/message/2012/03/">2012年3月(4)</a></li>
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