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

$page_title = 'kei\'s Message';
if(is_date()) {
	$my_page_name = get_query_var('year') . '年';
	if(get_query_var('monthnum')) {
		$my_page_name .= get_query_var('monthnum') . '月';
	}
	if(get_query_var('day')) {
		$my_page_name .= get_query_var('day') . '日';
	}
	$page_title = $my_page_name . '｜' . $page_title;
}
$page_description = '';
$page_keywords = '';
include_once "meta.html";
?>

</head>

<body>
<?php include_once "head.html"; ?>

<div id="pageTitle">
<h1><img src="<?php echo home_url(); ?>/images/message/page_title.png" width="227" height="40" alt="kei's Message" /></h1>
<?php if(is_date()) : ?>
<p><a href="<?php echo home_url(); ?>/">HOME</a> &gt; <a href="<?php echo get_post_type_archive_link('message'); ?>">kei's Message</a> &gt; <?php echo $my_page_name; ?></p>
<?php else : ?>
<p><a href="<?php echo home_url(); ?>/">HOME</a> &gt; kei's Message</p>
<?php endif; ?>
<!-- / #pageTitle --></div>

<div id="contentsContainer">
<div id="contentsArea">

<div id="messageBox">
<div id="messageList">
<?php $i = 0; while(have_posts()) : the_post(); ?>
<?php if(($i%2) == 0) : ?>
	<div class="line">
<?php endif; ?>
		<div class="entry <?php if(($i%2) == 0) : ?>fl<?php else : ?>fr<?php endif; ?>">
			<p class="date"><?php echo get_the_time('Y年m月d日'); ?></p>
			<p class="title"><a href="<?php echo get_the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 18, '...'); ?></a></p>
		</div>
<?php if(($i%2) == 1 || $i == $wp_query->post_count - 1) : ?>
	<!-- / .line --></div>
<?php endif; ?>
<?php $i ++; endwhile; ?>


<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
?>

<p class="margin_t20 text_c"><?php if($paged >= 2) : ?>　<a href="<?php echo get_pagenum_link($paged-1); ?>">&lt;&lt; 戻る</a><?php endif; ?>　<?php if($paged < $wp_query->max_num_pages) : ?><a href="<?php echo get_pagenum_link($paged+1); ?>">次へ &gt;&gt;</a>　<?php endif; ?></p>



<!-- / #messageList --></div>

<?php include(TEMPLATEPATH . '/side-message.php'); ?>

<!-- / #messageBox --></div>

<!-- / #contentsArea --></div>

<div id="sideArea">
<?php include_once "side.html"; ?>
<!-- / #sideArea --></div>
<!-- / #contentsContainer --></div>

<?php include_once "foot.html"; ?>

</body>
</html>