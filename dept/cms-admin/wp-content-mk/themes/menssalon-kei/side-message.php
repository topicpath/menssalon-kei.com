<?php
if(!defined('ABSPATH')) exit;
?>

<div id="messageSide">
<?php
$args = array(
	'post_type' => 'message',
	'posts_per_page' => 3,
);
$myposts = get_posts($args);
if($myposts) : ?>
<dl>
<dt><img src="<?php echo home_url(); ?>/images/message/recent_title.png" width="107" height="22" alt="最近の記事一覧" /></dt>
<dd><ul>
<?php foreach($myposts as $post) : setup_postdata($post); ?>
<li><em><?php echo get_the_time('Y年m月d日'); ?></em><br />
<a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
<?php endforeach; wp_reset_postdata(); ?>
</ul></dd>
</dl>
<?php endif; ?>
<?php
$archives = get_archives_array(array('post_type' => 'message'));
if($archives) : ?>
<dl>
<dt><img src="<?php echo home_url(); ?>/images/message/past_title.png" width="107" height="22" alt="過去の記事一覧" /></dt>
<dd><ul>
<?php foreach($archives as $a) : ?>
<li><a href="<?php echo get_post_type_archive_link('message'); ?><?php echo $a->year; ?>/<?php echo sprintf('%02d',$a->month); ?>/"><?php echo $a->year; ?>年<?php echo $a->month; ?>月(<?php echo $a->posts; ?>)</a></li>
<?php endforeach; ?>
</ul></dd>
</dl>
<?php endif; ?>

<!-- / #messageSide --></div>

