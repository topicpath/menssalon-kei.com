<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
$path = '../../include/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

$page_title = '実績紹介｜赤ちゃん筆の実績。赤ちゃんの髪の毛で筆をつくろう！産毛を使って製作する「胎毛筆」は記念にちゃん筆';
$page_description = 'ピッタリ。100人以上の実績で安心！光文堂・赤ちゃん筆センターの加盟店、札幌市中央区のメンズサロンkei。';
$page_keywords = '赤ちゃん筆,札幌';
include_once "meta.html";

include('xml.php');
if(file_exists('data/data.xml')) {
	$xml =  file_get_contents('data/data.xml');
}
$xml = XML_unserialize($xml);
$all_data = $xml['datas']['data'];
$my_data = array();

$page_view = 15;
$detail_page_view = 10;

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

</head>

<body>
<?php include_once "head.html"; ?>

<div id="pageTitle">
	<h1><img src="images/page_title.png" width="136" height="40" alt="実績紹介" /></h1>
	<p><a href="<?php echo $abs_root;?>">HOME</a> &gt; <a href="../">赤ちゃん筆</a> &gt; 実績紹介</p>
<!-- / #pageTitle --></div>

<div id="contentsContainer">
	<div id="contentsArea" class="results">

		<h2 id="fudeResultsTitle"><img src="images/main.png" width="580" height="142" alt="これまでkeiで赤ちゃん筆を作らせていただいた方を紹介します" /></h2>

		<div id="fudeResultsList">
<?php
$i = 0;
$line = 0;
foreach($my_data as $k => $v) {
	$link = 'detail/';
	if(floor($k/$detail_page_view) > 0) $link .= 'page' . (floor($k/$detail_page_view) + 1);
	$link .= '#results' . $v['id'];
	if(($i%3) == 0) : $line ++; ?>
			<div class="line<?php if(ceil(count($my_data)/3) == $line) : ?> last"<?php endif; ?>">
<?php endif; ?>
				<div<?php if(($i%3) == 2) : ?> class="right"<?php endif; ?>>
					<div class="ph"><p><a href="<?php echo $link; ?>"><img src="<?php if($v['mainimage'] != '') echo $v['mainimage']; else echo 'images/no-ph.gif'; ?>" width="140px" height="100" alt="<?php echo $v['title'] . 'さま'; ?>" /></a></p></div>
					<dl>
						<dt><?php echo $v['address']; ?></dt>
						<dd><a href="<?php echo $link; ?>"><?php echo $v['title'] . '<em>さま</em>'; ?></a></dd>
					</dl>
				</div>
<?php if(($i%3) == 2 || $i == count($my_data) - 1) : ?>
			<!-- / .line --></div>
<?php endif;
	$i ++;
}
?>
		<!-- / #fudeResultsContents --></div>

	<!-- / #contentsArea --></div>

	<div id="sideArea">
		<div id="sideNavi">
			<dl>
				<dt><img src="../images/side_title.png" width="225" height="46" alt="赤ちゃん筆" /></dt>
				<dd><ul>
					<li><a href="http://menssalon-kei.com/">TOP</a></li>
					<li><a href="../about/">赤ちゃん筆について</a></li>
					<li><a href="../flow/">筆ができるまで</a></li>
					<li><strong><a href="../results/">実績紹介</a></strong></li>
					<li><a href="../qa/">Q&amp;A</a></li>
				</ul></dd>
			</dl>
		<!-- / #sideNavi --></div>

<?php include_once "side.html"; ?>
	<!-- / #sideArea --></div>
<!-- / #contentsContainer --></div>

<?php include_once "foot.html"; ?>

</body>
</html>