<?php
if(!defined('ABSPATH')) exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
$path = ABSPATH . '../include/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

$page_title = '実績紹介｜赤ちゃん筆';
$page_description = '';
$page_keywords = '';
include_once "meta.html";
?>

</head>

<body>
<?php include_once "head.html"; ?>

<div id="pageTitle">
	<h1><img src="<?php echo home_url(); ?>/fude/results/images/page_title.png" width="136" height="40" alt="実績紹介" /></h1>
	<p><a href="<?php echo home_url(); ?>/">HOME</a> &gt; <a href="<?php echo home_url(); ?>/fude/">赤ちゃん筆</a> &gt; 実績紹介</p>
<!-- / #pageTitle --></div>

<div id="contentsContainer">
	<div id="contentsArea" class="results">

		<h2 id="fudeResultsTitle"><img src="<?php echo home_url(); ?>/fude/results/images/main.png" width="580" height="142" alt="これまでkeiで赤ちゃん筆を作らせていただいた方を紹介します" /></h2>

		<div id="fudeResultsContents">

<?php while(have_posts()) : the_post(); ?>

			<div class="box" id="results<?php echo $post->ID; ?>">
				<div class="ph">
<?php
$my_img = wp_get_attachment_image_src(get_field('fude_img'), 'medium');
if($my_img) {
	$my_img = $my_img[0];
} else {
	$my_img = home_url() . '/fude/results/images/no-ph.gif';
}
?>
					<div class="ph01"><p><img src="<?php echo $my_img; ?>" width="210" alt="<?php echo get_the_title(); ?>さま" /></p></div>
<?php
$fude_fude_img = wp_get_attachment_image_src(get_field('fude_fude_img'), 'medium');
?>
<?php if(get_field('fude_fude_name') || $fude_fude_img || get_field('fude_fude_siyo')) :?>
					<div class="fude">
<?php if(get_field('fude_fude_name')) :?>
						<p class="name"><?php echo get_field('fude_fude_name'); ?></p>
<?php endif; ?>
<?php if($fude_fude_img) :?>
						<div><p><img src="<?php echo $fude_fude_img[0]; ?>" width="100" height="100" alt="<?php echo get_field('fude_fude_name'); ?>" /></p></div>
<?php endif; ?>
<?php if(get_field('fude_fude_siyo')) :?>
						<dl<?php if(!$fude_fude_img) : ?> class="no-ph"<?php endif; ?>>
							<dt>仕様：</dt>
							<dd><?php echo get_field('fude_fude_siyo'); ?></dd>
						</dl>
<?php endif; ?>
					</div>
<?php endif; ?>
				<!-- / .ph --></div>
				<div class="message"><div>
					<p class="address"><?php echo get_field('fude_address'); ?></p>
					<h3><?php echo get_the_title(); ?><em>さま</em></h3>
					<p><?php echo get_field('fude_comment'); ?></p>
				<!-- / .message --></div></div>
			<!-- / .box --></div>

<?php endwhile; ?>

<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
?>
			<p class="pager"><?php if($paged >= 2) : ?>　<a href="<?php echo get_pagenum_link($paged-1); ?>">&lt;&lt; 戻る</a><?php endif; ?>　<a href="<?php echo home_url(); ?>/fude/results/"><img src="<?php echo home_url(); ?>/fude/results/images/btn_list_op.png" width="130" height="24" alt="一覧を見る" /></a>　<?php if($paged < $wp_query->max_num_pages) : ?><a href="<?php echo get_pagenum_link($paged+1); ?>">次へ &gt;&gt;</a>　<?php endif; ?></p>

		<!-- / #fudeResultsContents --></div>

	<!-- / #contentsArea --></div>

	<div id="sideArea">
		<div id="sideNavi">
			<dl>
				<dt><img src="<?php echo home_url(); ?>/fude/images/side_title.png" width="225" height="46" alt="赤ちゃん筆" /></dt>
				<dd><ul>
					<li><a href="<?php echo home_url(); ?>/">TOP</a></li>
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