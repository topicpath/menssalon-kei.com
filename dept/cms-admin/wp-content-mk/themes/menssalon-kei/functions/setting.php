<?php
if(!defined('ABSPATH')) exit;

/*
 * 管理バー削除
*/
function remove_bar_menus( $wp_admin_bar ) {
//	$wp_admin_bar->remove_menu('wp-logo'); // W ロゴ
//	$wp_admin_bar->remove_menu('site-name'); // サイト名
//	$wp_admin_bar->remove_menu('view-site'); // サイト名 -> サイトを表示
	$wp_admin_bar->remove_menu('comments'); // コメント
//	$wp_admin_bar->remove_menu('new-content'); // 新規
//	$wp_admin_bar->remove_menu('new-post'); // 新規 -> 投稿
	$wp_admin_bar->remove_menu('new-media'); // 新規 -> メディア
	$wp_admin_bar->remove_menu('new-link'); // 新規 -> リンク
	$wp_admin_bar->remove_menu('new-page'); // 新規 -> 固定ページ
	$wp_admin_bar->remove_menu('new-user'); // 新規 -> ユーザー
//	$wp_admin_bar->remove_menu('updates'); // 更新
//	$wp_admin_bar->remove_menu('my-account'); // マイアカウント
//	$wp_admin_bar->remove_menu('user-info'); // マイアカウント -> プロフィール
//	$wp_admin_bar->remove_menu('edit-profile'); // マイアカウント -> プロフィール編集
//	$wp_admin_bar->remove_menu('logout'); // マイアカウント -> ログアウト
}
add_action('admin_bar_menu', 'remove_bar_menus', 201);



/*
 * 左メニューから削除
*/
function remove_left_menus() {
//	remove_menu_page('edit.php'); // 記事投稿
	remove_menu_page('edit-comments.php'); // コメント
//	remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category'); // カテゴリ
	remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag'); // タグ
}
add_action('admin_menu', 'remove_left_menus');


/*
 * 投稿画面から削除
*/
function remove_default_post_screen_metaboxes() {
	remove_meta_box( 'postcustom','post','normal' ); // カスタムフィールド
	remove_meta_box( 'postexcerpt','post','normal' ); // 抜粋
	remove_meta_box( 'commentstatusdiv','post','normal' ); // ディスカッション
	remove_meta_box( 'commentsdiv','post','normal' ); // コメント
	remove_meta_box( 'trackbacksdiv','post','normal' ); // トラックバック
//	remove_meta_box( 'authordiv','post','normal' ); // 作成者
//	remove_meta_box( 'slugdiv','post','normal' ); // スラッグ
	remove_meta_box( 'tagsdiv-post_tag' , 'post' , 'side' ); // 投稿のタグ
//	remove_meta_box( 'formatdiv' , 'post' , 'side' ); // フォーマット
//	remove_meta_box( 'categorydiv' , 'post' , 'side' ); // カテゴリー
}
add_action('admin_menu','remove_default_post_screen_metaboxes');

/*
 * wp_headから削除
*/
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'print_emoji_detection_script', 7 );
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_head','wp_resource_hints',2);
add_filter( 'show_admin_bar', '__return_false' );


function dequeue_plugins_style() {
	wp_dequeue_style('wp-block-library');
	remove_action('wp_head', 'se_global_head');
}
add_action( 'wp_enqueue_scripts', 'dequeue_plugins_style', 9999);


/*
 * 管理画面CSS・JS追加
*/
// CSSとJSをヘッダーに追加する関数
function add_admin_css_and_js() {
	$dir = get_template_directory();
	$uri = get_template_directory_uri();
	$css_file = '/user-file/user-admin-style.css';
	$js_file = '/user-file/user-admin-script.js';
	$css = '<link rel="stylesheet" type="text/css" href="' . $uri . $css_file . '?' . filemtime($dir . $css_file) . '" />' . "\n";
	$js = '<script type="text/javascript" src="' . $uri . $js_file . '?' . filemtime($dir . $js_file) . '"></script>' . "\n";
	$output = $css. $js;
	echo $output;
}
add_action('admin_head', 'add_admin_css_and_js');


/*
 * ユーザークラス追加
*/
function add_user_role_class($admin_body_class) {
	global $current_user;
	if (!$admin_body_class) {
		$admin_body_class .= ' ';
	}
	$admin_body_class .= 'role-' . urlencode($current_user->roles[0]);
	return $admin_body_class;
}
// add_filter('admin_body_class', 'add_user_role_class');



/*
 * ショートコード
*/
function shortcode_root() {
	return home_url('/');
}
add_shortcode('root', 'shortcode_root');


/*
 * アップロードディレクトリ変更
*/
function custom_upload_dir() {
	$up_dir_name = 'uploads';

	$upload_url_path = home_url() . '/' . $up_dir_name;
	$upload_path = ABSPATH . '../' . $up_dir_name;
	if(file_exists($upload_path)) {
		$upload_path = realpath($upload_path);
	}

	$op_upload_url_path = get_option('upload_url_path');
	$op_upload_path = get_option('upload_path');
	if($op_upload_path != $upload_path || $op_upload_url_path != $upload_url_path) {
		update_option('upload_path', $upload_path);
		update_option('upload_url_path', $upload_url_path);
	}
}
// add_filter('admin_init', 'custom_upload_dir');

/*
 * プラグインのjs/css URLにwordpressディレクトリが見えるのを変更
*/
function replace_loader_tag($tag) {
	return str_replace(site_url() . '/../', home_url('/'), $tag);
}
// add_filter('script_loader_tag', 'replace_loader_tag');
// add_filter('style_loader_tag', 'replace_loader_tag');


/*
 * 抜粋文字変更
*/
function new_excerpt_more($more) {
	return '…';
}
add_filter('excerpt_more', 'new_excerpt_more');


/*
 * 抜粋文字数
*/
function new_excerpt_mblength($length) {
	global $post;
	return 60;
}
add_filter('excerpt_mblength', 'new_excerpt_mblength');


/*
 * 自動整形無効
*/
/*
add_action('init', function() {
	remove_filter('the_excerpt', 'wpautop');
	remove_filter('the_content', 'wpautop');
});

add_filter('tiny_mce_before_init', function($init) {
	$init['wpautop'] = false;
	$init['apply_source_formatting'] = ture;
	$init['verify_html'] = false;
	return $init;
});
*/

/*
 * エディターcss追加
*/
add_editor_style('user-file/editor-style.css');


/*
 * Enter => 改行
 * Shift + Enter => P
*/
// add_filter( 'tiny_mce_before_init', 'my_switch_tinymce_p_br' );
function my_switch_tinymce_p_br( $settings ) {
	$settings['forced_root_block'] = false;
	return $settings;
}

/*
 * エディターボタン追加
*/
function myplugin_tinymce_buttons($buttons) {
	array_unshift($buttons, 'fontsizeselect');
	$return_btns = array();
	foreach ($buttons as $b) {
		$return_btns[] = $b;
		if($b == 'forecolor') {
			$return_btns[] = 'backcolor';
		}
	}
	return $return_btns;
}
add_filter('mce_buttons_2','myplugin_tinymce_buttons');

/*
 * ファビコン削除
*/
function wp_favicon_delete() {
	exit;
}
add_action("do_faviconico", "wp_favicon_delete");
