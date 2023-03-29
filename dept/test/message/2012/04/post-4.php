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
<p class="date">2012年04月04日</p>
<div class="title"><h2>札幌ドーム</h2></div>

<div class="body">今シーズン初のファイターズ観戦をしてきました。今日はプレーヤースペシャル小谷野デーの為、入場者にナイロンバックがプレゼントされてました。小谷野本人は、気合いが入り過ぎた為か良いところ無しだったのはご愛嬌ですね（笑）<br /><br />試合は最後に追い上げたものの、惜しくも負け(&gt;_&lt;)残念ながら初観戦で初勝利とは成らなかったが追いつ追われつの面白いゲームだったので楽しくビールも飲めたし満足、満足！<br /><br />次回は５月のソフトバンク戦に行くつもりです。<br /><br />野球解説者の評価は毎度毎度低いですが、ダルビッシュいなくても良いところに行くんじゃないですかね～<br /> </div>


<p class="text_c"><a href="/message/2012/04/telco.php">&lt;&lt; 前へ</a>　<a href="/message/">一覧を見る</a>｜<a href="/message/2012/03/post-3.php">次へ &gt;&gt;</a></p>

<!-- / #messageDetail --></div>


<div id="messageSide">
<dl>
<dt><img src="/message/images/recent_title.png" width="107" height="22" alt="最近の記事一覧" /></dt>
<dd><ul>

<li><em>2012年04月06日</em><br />
<a href="/message/2012/04/telco.php">telcoのオーダー帽子</a></li><li><em>2012年04月04日</em><br />
<a href="/message/2012/04/post-4.php">札幌ドーム</a></li><li><em>2012年03月31日</em><br />
<a href="/message/2012/03/post-3.php">勝った！</a></li>
</ul></dd>
</dl>
<dl>
<dt><img src="/message/images/past_title.png" width="107" height="22" alt="過去の記事一覧" /></dt>
<dd><ul>
<li><a href="/message/2012/04/">2012年4月(2)</a></li><li><a href="/message/2012/03/">2012年3月(4)</a></li>
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