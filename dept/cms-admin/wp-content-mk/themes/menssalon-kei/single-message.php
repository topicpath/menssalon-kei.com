<?php
if(!defined('ABSPATH')) exit;

// メインループ開始
while(have_posts()) : the_post();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
$path = ABSPATH . '../include/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

$page_title = strip_tags(get_the_title()) . '｜kei\'s Message';
$page_description = htmlentities(wp_trim_words(get_the_content(), 200, '...'), ENT_COMPAT, 'UTF-8');
$page_keywords = '';
include_once "meta.html";
?>

</head>

<body>
<?php include_once "head.html"; ?>

<div id="pageTitle">
<h1><img src="<?php echo home_url(); ?>/images/message/page_title.png" width="227" height="40" alt="kei's Message" /></h1>
<p><a href="<?php echo home_url(); ?>/">HOME</a> &gt; <a href="<?php echo get_post_type_archive_link('message'); ?>">kei's Message</a> &gt; <?php echo strip_tags(get_the_title()); ?></p>
<!-- / #pageTitle --></div>

<div id="contentsContainer">
<div id="contentsArea">

<div id="messageBox">


<div id="messageDetail">
<p class="date"><?php echo get_the_time('Y年m月d日'); ?></p>
<div class="title"><h2><?php echo get_the_title(); ?></h2></div>

<div class="body"><?php the_content(); ?></div>

<?php
$prevpost = get_adjacent_post(false, '', true);
$nextpost = get_adjacent_post(false, '', false);
?>
<p class="text_c"><?php if($nextpost) : ?><a href="<?php echo get_permalink($nextpost->ID); ?>">&lt;&lt; 前へ</a>｜<?php endif; ?><a href="<?php echo get_post_type_archive_link('message'); ?>">一覧を見る</a><?php if($prevpost) : ?>｜<a href="<?php echo get_permalink($prevpost->ID); ?>">次へ &gt;&gt;</a><?php endif; ?></p>

<!-- / #messageDetail --></div>

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
<?php endwhile; ?>
