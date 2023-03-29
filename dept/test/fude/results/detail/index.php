<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
$path = '../../../include/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

$page_title = '実績紹介｜赤ちゃん筆';
$page_description = '';
$page_keywords = '';
include_once "meta.html";

include('../xml.php');
if(file_exists('../data/data.xml')) {
	$xml =  file_get_contents('../data/data.xml');
}
$xml = XML_unserialize($xml);
$all_data = $xml['datas']['data'];
$my_data = array();

$page_view = 10;

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
	<h1><img src="../images/page_title.png" width="136" height="40" alt="実績紹介" /></h1>
	<p><a href="<?php echo $abs_root;?>">HOME</a> &gt; <a href="../">赤ちゃん筆</a> &gt; 実績紹介</p>
<!-- / #pageTitle --></div>

<div id="contentsContainer">
	<div id="contentsArea" class="results">

		<h2 id="fudeResultsTitle"><img src="../images/main.png" width="580" height="142" alt="これまでkeiで赤ちゃん筆を作らせていただいた方を紹介します" /></h2>

		<div id="fudeResultsContents">
<?php
foreach($my_data as $v) {
?>
			<div class="box" id="results<?php echo $v['id']; ?>">
				<div class="ph">
					<div class="ph01"><p><img src="<?php if($v['mainimage'] != '') echo $v['mainimage']; else echo '../images/no-ph.gif'; ?>" width="210" height="150" alt="<?php echo $v['title'] . 'さま'; ?>" /></p></div>
<?php if($v['fudename'] != '' || $v['fudeimage'] != '' || $v['fudetext'] != '') :?>
					<div class="fude">
<?php if($v['fudename'] != '') :?>
						<p class="name"><?php echo $v['fudename']; ?></p>
<?php endif; ?>
<?php if($v['fudeimage'] != '') :?>
						<div><p><img src="<?php echo $v['fudeimage']; ?>" width="100" height="100" alt="<?php echo $v['fudename']; ?>" /></p></div>
<?php endif; ?>
<?php if($v['fudetext'] != '') :?>
						<dl<?php if($v['fudeimage'] == '') :?> class="no-ph"<?php endif; ?>>
							<dt>仕様：</dt>
							<dd><?php echo nl2br($v['fudetext']); ?></dd>
						</dl>
<?php endif; ?>
					</div>
<?php endif; ?>
				<!-- / .ph --></div>
				<div class="message"><div>
					<p class="address"><?php echo $v['address']; ?></p>
					<h3><?php echo $v['title'] . '<em>さま</em>'; ?></h3>
					<p><?php echo nl2br($v['text']); ?></p>
				<!-- / .message --></div></div>
			<!-- / .box --></div>
<?php
}
?>


			<p class="pager"><?php
if($page > 1) :
	$back_num = $page - 1;
	$back_str = $back_num > 1 ? 'page' . $back_num : '';
?>　<a href="./<?php echo $back_str; ?>#fudeResultsTitle">&lt;&lt; 戻る</a><?php endif; ?>　<a href="../"><img src="../images/btn_list_op.png" width="130" height="24" alt="一覧を見る" /></a>　<?php if(count($all_data) > $page_max) : ?>　<a href="./page<?php echo $page + 1; ?>#fudeResultsTitle">次へ &gt;&gt;</a>　<?php endif; ?></p>

		<!-- / #fudeResultsContents --></div>

	<!-- / #contentsArea --></div>

	<div id="sideArea">
		<div id="sideNavi">
			<dl>
				<dt><img src="../../images/side_title.png" width="225" height="46" alt="赤ちゃん筆" /></dt>
				<dd><ul>
					<li><a href="../">TOP</a></li>
					<li><a href="../../about/">赤ちゃん筆について</a></li>
					<li><a href="../../flow/">筆ができるまで</a></li>
					<li><strong><a href="../../results/">実績紹介</a></strong></li>
					<li><a href="../../qa/">Q&amp;A</a></li>
				</ul></dd>
			</dl>
		<!-- / #sideNavi --></div>

<?php include_once "side.html"; ?>
	<!-- / #sideArea --></div>
<!-- / #contentsContainer --></div>

<?php include_once "foot.html"; ?>

</body>
</html>