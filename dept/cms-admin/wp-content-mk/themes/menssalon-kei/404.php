<?php
if(!defined('ABSPATH')) exit;

// global $template;
// var_dump(basename($template, '.php'));

// var_dump($wp_query->query_vars);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
$path = ABSPATH . '../include/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

$page_title = '404｜kei\'s Message';
$page_description = '';
$page_keywords = '';
include_once "meta.html";
?>
<link rel="stylesheet" href="<?php echo home_url(); ?>/common/css/404.css" type="text/css" media="all" />

</head>

<body>
<?php include_once "head.html"; ?>

<div id="pageTitle">
<h1>404 PAGE NOT FOUND</h1>
<p><a href="<?php echo home_url(); ?>/">HOME</a> &gt; 404 PAGE NOT FOUND</p>
<!-- / #pageTitle --></div>

<div id="contentsContainer">
<div id="contentsArea">

	<div class="contents404">
		<p class="lead">ページが見つかりません</p>

		<div>
			<p>誠に申し訳ありませんが、該当ページがございません。</p>
			<p>入力されたURL、ファイル名にタイプミスがないかご確認ください。</p>
			<p>指定されたページは削除されたか、移動した可能性があります。</p>
		</div>

		<p class="back_link"><a href="<?php echo home_url(); ?>" class="a_reverse">Topへ戻る</a></p>
	<!-- /.contents404 --></div>
<!-- / #contentsArea --></div>

<div id="sideArea">
<?php include_once "side.html"; ?>
<!-- / #sideArea --></div>
<!-- / #contentsContainer --></div>

<?php include_once "foot.html"; ?>

</body>
</html>
