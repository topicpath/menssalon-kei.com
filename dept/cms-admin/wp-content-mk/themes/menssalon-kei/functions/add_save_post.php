<?php
if(!defined('ABSPATH')) exit;

function auto_assign_value($post_id, $post, $update) {
	if (!$post_id || !$update || wp_is_post_revision($post_id)){
		return;
	}
	remove_action('save_post', 'auto_assign_value');

	$post_type = $post->post_type;

	// ニュース投稿者時に画像をアイキャッチに登録
//	if ($post_type == 'news') {
//		$thumbnail = get_post_thumbnail_id($post_id);
//		if(!$thumbnail) {
//			$img_id = get_field('column_img', $post_id);
//			if($img_id) {
//				set_post_thumbnail($post_id, $img_id);
//			}
//		}
//	}


	add_action('save_post', 'auto_assign_value', 10, 3);
}
// add_action('save_post', 'auto_assign_value', 10, 3);


