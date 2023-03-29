<?php
if(!defined('ABSPATH')) exit;

/*
 * 管理バー削除
*/
function remove_bar_default_post( $wp_admin_bar ) {
	$wp_admin_bar->remove_menu('new-post'); // 新規 -> 投稿
}
add_action('admin_bar_menu', 'remove_bar_default_post', 201);

/*
 * 左メニューから削除
*/
/*
function remove_left_default_post() {
	remove_menu_page('edit.php'); // 記事投稿
}
add_action('admin_menu', 'remove_left_default_post');
*/
function remove_left_default_post(){
	echo '<style>#adminmenu #menu-posts{display: none;}</style>';
}
add_action('admin_head', 'remove_left_default_post');

/*
 * 編集画面のタイトル変更
*/
my_default_post('', '投稿（未使用）', '', '');
