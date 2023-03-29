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


<?php
mb_language('Japanese');
mb_internal_encoding('UTF-8');

include($_SERVER['DOCUMENT_ROOT'] . '/fude/results/xml.php');
if(file_exists('data/data.xml')) {
$xml =  file_get_contents('data/data.xml');
}
$xml = XML_unserialize($xml);
$all_data = $xml['datas']['data'];
if(count($all_data['link']) > 0) $all_data = array($all_data);
$my_data = array();

$page_view = 12;

$page = $_GET['page'] ? $_GET['page'] : 1;
$page_start = $page_view * ($page - 1);
if(count($all_data) <= $page_start) {
$page = 1;
$page_start = 0;
}

$page_max = min(($page_start + $page_view), count($all_data));

for($i = $page_start; $i < $page_max; $i ++){
$my_data[$i] = $all_data[$i];
}
?>

<div id="messageList">
<h2>2014年3月</h2>
<?php
$i = 0;
$line = 0;
foreach($my_data as $k => $v) {
if(($i%2) == 0) : $line ++; ?>
<div class="line<?php if(ceil(count($my_data)/2) == $line) : ?> last<?php endif; ?>">
<?php endif; ?>
<div class="entry <?php if(($i%2) == 0) : ?>fl<?php else : ?>fr<?php endif; ?>">
<p class="date"><?php echo $v['date']; ?></p>
<p class="title"><a href="<?php echo $v['link']; ?>"><?php
$title =$v['title'];
if(mb_strlen($title ) > 18) $title = mb_substr($title ,"0","18") . '...';
echo $title;
?></a></p>
<?php if($v['mainimage'] != '') : ?>
<div class="ph"><p><a href="<?php echo $v['link']; ?>"><img src="<?php echo $v['mainimage']; ?>" alt="<?php echo $v['title']; ?>" /></a></p></div>
<?php endif; ?>
</div>
<?php if(($i%2) == 1 || $i == count($my_data) - 1) : ?>
<!-- / .line --></div>
<?php endif;
$i ++;
}
?>

<p class="margin_t20 text_c"><?php
if($page > 1) :
$back_num = $page - 1;
$back_str = $back_num > 1 ? 'page' . $back_num : '';
?>　<a href="./<?php echo $back_str; ?>#fudeResultsTitle">&lt;&lt; 戻る</a><?php endif; ?>　<?php if(count($all_data) > $page_max) : ?>　<a href="./page<?php echo $page + 1; ?>#fudeResultsTitle">次へ &gt;&gt;</a>　<?php endif; ?></p>

<!-- / #messageList --></div>



<div id="messageSide">
<dl>
<dt><img src="/message/images/recent_title.png" width="107" height="22" alt="最近の記事一覧" /></dt>
<dd><ul>

<li><em>2014年04月30日</em><br />
<a href="/message/2014/04/post-34.php">今年もプレゼント！</a></li><li><em>2014年04月09日</em><br />
<a href="/message/2014/04/post-33.php">今期の初ドーム</a></li><li><em>2014年04月01日</em><br />
<a href="/message/2014/04/post-32.php">調髪料金を改定させて頂きます！</a></li>
</ul></dd>
</dl>
<dl>
<dt><img src="/message/images/past_title.png" width="107" height="22" alt="過去の記事一覧" /></dt>
<dd><ul>
<li><a href="/message/2014/04/">2014年4月(3)</a></li><li><a href="/message/2014/03/">2014年3月(1)</a></li><li><a href="/message/2013/10/">2013年10月(2)</a></li><li><a href="/message/2013/09/">2013年9月(1)</a></li><li><a href="/message/2013/08/">2013年8月(1)</a></li><li><a href="/message/2013/07/">2013年7月(2)</a></li><li><a href="/message/2013/06/">2013年6月(2)</a></li><li><a href="/message/2013/05/">2013年5月(3)</a></li><li><a href="/message/2013/04/">2013年4月(1)</a></li><li><a href="/message/2013/03/">2013年3月(2)</a></li><li><a href="/message/2013/01/">2013年1月(1)</a></li><li><a href="/message/2012/12/">2012年12月(1)</a></li><li><a href="/message/2012/11/">2012年11月(1)</a></li><li><a href="/message/2012/10/">2012年10月(3)</a></li><li><a href="/message/2012/08/">2012年8月(1)</a></li><li><a href="/message/2012/07/">2012年7月(1)</a></li><li><a href="/message/2012/05/">2012年5月(2)</a></li><li><a href="/message/2012/04/">2012年4月(4)</a></li><li><a href="/message/2012/03/">2012年3月(4)</a></li>
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