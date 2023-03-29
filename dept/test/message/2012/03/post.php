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
<p class="date">2012年03月09日</p>
<div class="title"><h2>ホームページを公開しました</h2></div>

<div class="body"><div><img alt="master_ph.jpg" src="http://www.menssalon-kei.com/message/img/master_ph.jpg" width="146" height="197" class="mt-image-none" /><a href="http://www.menssalon-kei.com/message/img/tennai.jpg"><img alt="tennai.jpg" src="http://www.menssalon-kei.com/message/assets_c/2012/03/tennai-thumb-300x225-30.jpg" width="300" height="225" class="mt-image-none" /></a></div>当店のお得情報やマスターの日々の徒然な戯言を呟いていきたいと思いますので宜しくお願いします！<div><br /></div><div>当店についての情報は<a href="http://menssalon-kei.com/about/">コチラ</a></div></div>


<p class="text_c"><a href="/message/2012/03/post-1.php">&lt;&lt; 前へ</a>　<a href="/message/">一覧を見る</a></p>

<!-- / #messageDetail --></div>


<div id="messageSide">
<dl>
<dt><img src="/message/images/recent_title.png" width="107" height="22" alt="最近の記事一覧" /></dt>
<dd><ul>

<li><em>2012年03月22日</em><br />
<a href="/message/2012/03/post-1.php">女満別高校</a></li><li><em>2012年03月09日</em><br />
<a href="/message/2012/03/post.php">ホームページを公開しました</a></li>
</ul></dd>
</dl>
<dl>
<dt><img src="/message/images/past_title.png" width="107" height="22" alt="過去の記事一覧" /></dt>
<dd><ul>
<li><a href="/message/2012/03/">2012年3月(2)</a></li>
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