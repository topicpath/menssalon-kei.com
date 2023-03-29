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
<h2>2012年3月</h2>
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

<li><em>2012年04月28日</em><br />
<a href="/message/2012/04/post-7.php">月下美人！</a></li><li><em>2012年04月15日</em><br />
<a href="/message/2012/04/post-6.php">命名　「祐也」くん</a></li><li><em>2012年04月09日</em><br />
<a href="/message/2012/04/post-5.php">ファイターズ観戦チケットプレゼント！</a></li>
</ul></dd>
</dl>
<dl>
<dt><img src="/message/images/past_title.png" width="107" height="22" alt="過去の記事一覧" /></dt>
<dd><ul>
<li><a href="/message/2012/04/">2012年4月(5)</a></li><li><a href="/message/2012/03/">2012年3月(4)</a></li>
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