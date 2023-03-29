<?php
if(!defined('ABSPATH')) exit;
if(is_tax()) {
	$page_tax = get_queried_object();
	if($page_tax->slug == 'center') {
		header('location:' . get_post_type_archive_link('fude_qa'));
		exit;
	}
	$my_page_name = $page_tax->name;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
$path = ABSPATH . '../include/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

$page_title = '赤ちゃん筆Q&amp;A｜赤ちゃん筆';
if($my_page_name) {
	$page_title = $my_page_name . '｜' . $page_title ;
}
$page_description = '赤ちゃん筆Q＆A。赤ちゃんの髪の毛で筆をつくろう！産毛を使って製作する「胎毛筆」は記念にピッタリ。100人以上の実績で安心！光文堂・赤ちゃん筆センターの加盟店、札幌市中央区のメンズサロンkei。';
$page_keywords = '赤ちゃん筆,札幌';
include_once "meta.html";
?>

</head>

<body>
<?php include_once "head.html"; ?>

<div id="pageTitle">
<h1><img src="<?php echo home_url(); ?>/images/fude_qa/page_title.png" width="220" height="40" alt="赤ちゃん筆Q&amp;A" /></h1>
<p><a href="<?php echo home_url(); ?>/">HOME</a> &gt; <a href="<?php echo home_url(); ?>/fude/">赤ちゃん筆</a> &gt; 赤ちゃん筆Q&amp;A</p>
<!-- / #pageTitle --></div>

<div id="contentsContainer">
<div id="contentsArea">

<div id="qaTitle" class="fude">
<h2><img src="<?php echo home_url(); ?>/images/fude_qa/title.png" width="512" height="34" alt="赤ちゃん筆に関してのよくあるご質問" /></h2>



<ul class="tab">
<?php if(is_tax()) : ?>
<li><a href="<?php echo get_post_type_archive_link('fude_qa'); ?>"><img src="<?php echo home_url(); ?>/images/fude_qa/tab_center_off.png" width="174" height="30" alt="赤ちゃん筆センター" /></a></li>
<li><img src="<?php echo home_url(); ?>/images/fude_qa/tab_kobundo_on.png" width="174" height="30" alt="光文堂" /></li>
<?php else : ?>
<li><img src="<?php echo home_url(); ?>/images/fude_qa/tab_center_on.png" width="174" height="30" alt="赤ちゃん筆センター" /></li>
<li><a href="<?php echo get_post_type_archive_link('fude_qa'); ?>kobundo/"><img src="<?php echo home_url(); ?>/images/fude_qa/tab_kobundo_off.png" width="174" height="30" alt="光文堂" /></a></li>
<?php endif; ?>
</ul>

<ul class="list">
<?php while(have_posts()) : the_post(); ?>
<li><a href="#qa<?php echo $post->ID; ?>"><?php echo get_the_title(); ?></a></li>
<?php endwhile; ?>
</ul>
<p class="img"><img src="<?php echo home_url(); ?>/images/fude_qa/img.png" width="222" height="246" alt="赤ちゃん筆" /></p>
<!-- / #qaTitle --></div>

<div id="qaContents">
<?php while(have_posts()) : the_post(); ?>
<p class="pagetop" id="qa<?php echo $post->ID; ?>"><a href="#qaTitle">質問一覧に戻る↑</a></p>
<dl class="box">
<dt><?php echo get_the_title(); ?></dt>
<dd><?php the_content(); ?></dd>
</dl>
<?php endwhile; ?>

<!-- / #qaContents --></div>

<!-- / #contentsArea --></div>

<div id="sideArea">
<div id="sideNavi">
<dl>
<dt><img src="<?php echo home_url(); ?>/fude/images/side_title.png" width="225" height="46" alt="赤ちゃん筆" /></dt>
<dd><ul>
<li><a href="<?php echo home_url(); ?>/">TOP</a></li>
<li><a href="<?php echo home_url(); ?>/fude/about/">赤ちゃん筆について</a></li>
<li><a href="<?php echo home_url(); ?>/fude/flow/">筆ができるまで</a></li>
<li><a href="<?php echo home_url(); ?>/fude/results/">実績紹介</a></li>
<li><strong><a href="<?php echo home_url(); ?>/fude/qa/">Q&amp;A</a></strong></li>
</ul></dd>
</dl>
<!-- / #sideNavi --></div>

<?php include_once "side.html"; ?>
<!-- / #sideArea --></div>
<!-- / #contentsContainer --></div>

<?php include_once "foot.html"; ?>

</body>
</html>
