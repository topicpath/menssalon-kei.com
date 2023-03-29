<?php
if(!defined('ABSPATH')) {
	$wp_file = dirname(__FILE__) . '/../../cms-admin/wp-blog-header.php';
	if(!file_exists($wp_file)) $wp_file = dirname(__FILE__) . '/../../../cms-admin/wp-blog-header.php';
	require($wp_file);
	header("HTTP/1.1 200 OK");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
$path = ABSPATH . '../include/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

$page_title = '実績紹介｜赤ちゃん筆の実績。赤ちゃんの髪の毛で筆をつくろう！産毛を使って製作する「胎毛筆」は記念にちゃん筆';
$page_description = 'ピッタリ。100人以上の実績で安心！光文堂・赤ちゃん筆センターの加盟店、札幌市中央区のメンズサロンkei。';
$page_keywords = '赤ちゃん筆,札幌';
include_once "meta.html";

$page_view = 15;
$detail_page_view = 10;
?>

</head>

<body>
<?php include_once "head.html"; ?>

<div id="pageTitle">
	<h1><img src="<?php echo home_url(); ?>/fude/results/images/page_title.png" width="136" height="40" alt="実績紹介" /></h1>
	<p><a href="<?php echo home_url(); ?>">HOME</a> &gt; <a href="<?php echo home_url(); ?>/fude/">赤ちゃん筆</a> &gt; 実績紹介</p>
<!-- / #pageTitle --></div>

<div id="contentsContainer">
	<div id="contentsArea" class="results">

		<h2 id="fudeResultsTitle"><img src="<?php echo home_url(); ?>/fude/results/images/main.png" width="580" height="142" alt="これまでkeiで赤ちゃん筆を作らせていただいた方を紹介します" /></h2>

		<div id="fudeResultsList">
<?php
$args = array(
	'post_type' => 'fude_results',
	'posts_per_page' => $page_view,
);
$myposts = get_posts($args);
foreach($myposts as $i => $post) : setup_postdata($post); ?>
<?php if(($i%3) == 0) : ?>
			<div class="line">
<?php endif; ?>

				<div<?php if(($i%3) == 2) : ?> class="right"<?php endif; ?>>
<?php
$my_link = get_post_type_archive_link('fude_results');
if($i >= $detail_page_view) {
	$my_link .= 'page/2/';
}
$my_link .= '#results' . $post->ID;
$my_img = wp_get_attachment_image_src(get_field('fude_img'), 'medium');
if($my_img) {
	$my_img = $my_img[0];
} else {
	$my_img = home_url() . '/fude/results/images/no-ph.gif';
}
?>
					<div class="ph"><p><a href="<?php echo $my_link; ?>"><img src="<?php echo $my_img; ?>" alt="<?php echo get_the_title(); ?>さま" /></a></p></div>
					<dl>
						<dt><?php echo get_field('fude_address'); ?></dt>
						<dd><a href="<?php echo $my_link; ?>"><?php echo get_the_title(); ?><em>さま</em></a></dd>
					</dl>
				</div>

<?php if(($i%3) == 2 || $i == count($myposts) - 1) : ?>
			<!-- / .line --></div>
<?php endif; ?>

<?php endforeach; wp_reset_postdata(); ?>
		<!-- / #fudeResultsContents --></div>

	<!-- / #contentsArea --></div>

	<div id="sideArea">
		<div id="sideNavi">
			<dl>
				<dt><img src="<?php echo home_url(); ?>/fude/images/side_title.png" width="225" height="46" alt="赤ちゃん筆" /></dt>
				<dd><ul>
					<li><a href="<?php echo home_url(); ?>">TOP</a></li>
					<li><a href="<?php echo home_url(); ?>/fude/about/">赤ちゃん筆について</a></li>
					<li><a href="<?php echo home_url(); ?>/fude/flow/">筆ができるまで</a></li>
					<li><strong><a href="<?php echo home_url(); ?>/fude/results/">実績紹介</a></strong></li>
					<li><a href="<?php echo home_url(); ?>/fude/qa/">Q&amp;A</a></li>
				</ul></dd>
			</dl>
		<!-- / #sideNavi --></div>

<?php include_once "side.html"; ?>
	<!-- / #sideArea --></div>
<!-- / #contentsContainer --></div>

<?php include_once "foot.html"; ?>

</body>
</html>