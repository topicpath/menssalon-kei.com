<?php
if(!defined('ABSPATH')) exit;

/*
 * アイキャッチ使用
*/
function add_postthumbnails() {
	add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'add_postthumbnails');


/*
 * カスタムポスト・カスタム分類 追加
 * (アイコン https://developer.wordpress.org/resource/dashicons/)
*/

add_action('init', 'my_custom_init');
function my_custom_init()
{
	// カスタムポスト
	my_register_post_type('message', 'お知らせ', '', 'dashicons-welcome-write-blog', true);
	my_register_post_type('fude_results', '赤ちゃん筆 実績紹介', '', 'dashicons-admin-customizer', '', array('rewrite' => array('slug' => 'fude/results/detail')));
	my_register_post_type('fude_qa', '赤ちゃん筆 Q&A', '', 'dashicons-format-chat', true, array('rewrite' => array('slug' => 'fude/qa')));

	// カスタム分類
	my_register_taxonomy('fude_qa_category', 'カテゴリ', array('fude_qa'), array('rewrite' => array('slug' => 'fude/qa')));

	// 投稿者にカテゴリ編集権限
//	if (current_user_can('author') && !current_user_can('manage_categories')) {
//		get_role('author')->add_cap('manage_categories');
//	}

	// postからタグ削除
//	unregister_taxonomy_for_object_type('category', 'post');
//	unregister_taxonomy_for_object_type('post_tag', 'post');
}

/*
 * 通常の投稿（post）の変更
*/
/*
change_default_post();
function change_default_post()
{
	my_default_post('information', 'ニュース・ブログ', '', 'f119');
}
*/
/*
 * 通常の投稿（post）の削除（非表示）
*/
require_once dirname( __FILE__ ) . '/delete_default_post.php';


// メニューからカスタム分類削除
function remove_taxonomy_left_menus() {
	remove_submenu_page('edit.php?post_type=area', 'edit-tags.php?taxonomy=area_category&amp;post_type=area');
}
function remove_taxonomy_screen_metaboxes() {
	remove_meta_box('tagsdiv-blog_tag' , 'blog' , 'side');
}
// add_action('admin_menu', 'remove_taxonomy_left_menus');
// add_action('admin_menu', 'remove_taxonomy_screen_metaboxes');



/*
 * セパレータ追加
*/
function add_separator() {
	global $menu;

	$menu[1011] = array('','read','separator3','','wp-menu-separator');
	$menu[1022] = array('','read','separator3','','wp-menu-separator');

	$menu[1051] = array('','read','separator4','','wp-menu-separator');
	$menu[1062] = array('','read','separator4','','wp-menu-separator');
}
add_action('admin_menu', 'add_separator');


/*
 * メニュー並び順変更
*/
function custom_menu_order($menu_ord) {
	if (!$menu_ord) return true;
	return array(
		'index.php', // ダッシュボード

		'separator1', // 最初の区切り線

		'edit.php', // 投稿
		'edit.php?post_type=message',
		'edit.php?post_type=fude_results',
		'edit.php?post_type=fude_qa',

//		'separator4', // 追加区切り線

		'separator2', // 二つ目の区切り線

		'upload.php', // メディア
		'link-manager.php', // リンク
		'edit.php?post_type=page', // 固定ページ
		'edit-comments.php', // コメント

		'separator3', // 追加区切り線

		'themes.php', // 外観
		'plugins.php', // プラグイン
		'users.php', // ユーザー
		'tools.php', // ツール
		'options-general.php', // 設定
		'edit.php?post_type=acf', // カスタムフィールド
		'separator-last', // 最後の区切り線
	);
}
add_filter('custom_menu_order', 'custom_menu_order');
add_filter('menu_order', 'custom_menu_order');



/*
 * 左メニュー　新規追加に「+」追加
 * 左メニュー　タクソノミーに「-」追加
*/
function change_taxonomy_menu_label() {
	global $menu;
	global $submenu;
	foreach($submenu as $k => $v) {
		if(is_array($v)) {
			foreach($v as $i => $v2) {
				if(strpos($v2[2], 'post-new.php') === 0 || strpos($v2[2], 'media-new.php') === 0) {
					$submenu["$k"][$i][0] = '&nbsp;+ ' . $v2[0];
				}
				if(strpos($v2[2], 'edit-tags.php?taxonomy=') === 0) {
					$submenu["$k"][$i][0] = '&nbsp;- ' . $v2[0];
				}
			}
		}
	}
}
add_action('admin_menu','change_taxonomy_menu_label');


/* ============================================================================================================ */
function my_register_post_type($type, $name, $suffix, $icon = '', $add_support = '', $option = '') {
	if(!$type || !$name) return;

	$labels = array(
		'name' => $name . $suffix,
		'singular_name' => $name . $suffix,
		'name_admin_bar' => $name,
		'all_items' => $name . '一覧',
		'add_new_item' => $name . 'を追加',
		'edit_item' => $name . 'の編集',
		'search_items' => $name . 'を検索',
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
//		'supports' => array('title', 'author'),
		'supports' => array('title', 'author', 'revisions'),
		'has_archive'=>true
	);
	if(is_string($icon) &&  !empty($icon)) $args['menu_icon'] = $icon;

	if($add_support === true) $args['supports'][] = 'editor';
	elseif(is_array($add_support)) $args['supports'] = array_merge($args['supports'], $add_support);
	elseif(is_string($add_support) && !empty($add_support)) $args['supports'][] = $add_support;

	if(is_array($option)) $args = array_merge($args, $option);

	register_post_type($type, $args);
}


/* ============================================================================================================ */
function my_register_taxonomy($slug, $name, $posttype, $option = '') {
	$args = array(
		'label' => $name,
		'hierarchical' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'show_tagcloud' => false,
		'show_admin_column' => true,
		'capabilities' => array('edit_posts')
	);
	if(is_array($option)) $args = array_merge($args, $option);
	register_taxonomy($slug, $posttype, $args);
}

/* ============================================================================================================ */
function my_register_category_post_type($posttype) {
	if(is_array($posttype)) {
		foreach($posttype as $p) register_taxonomy_for_object_type('category', $p);
	} else {
		register_taxonomy_for_object_type('category', $posttype);
	}
}


/* ============================================================================================================ */
function my_default_post($slug = '', $name = '', $suffix = '', $icon = '') {
	global $my_default_post_name,$my_default_post_suffix,$my_default_post_slug,$my_default_post_icon;

	$my_default_post_name = $name;
	$my_default_post_suffix = $suffix;
	$my_default_post_slug = $slug;
	$my_default_post_icon = $icon;

	if(is_string($name) && !empty($name)) {
		add_action('admin_menu','change_post_menu_label');
	}
	function change_post_menu_label() {
		global $menu, $submenu,$wp_post_types, $my_default_post_name, $my_default_post_suffix;
		$menu[5][0] = $my_default_post_name . $my_default_post_suffix;
		$submenu['edit.php'][5][0] = $my_default_post_name .'一覧';

		$labels = &$wp_post_types['post']->labels;
		$labels->name = $my_default_post_name . $my_default_post_suffix;
		$labels->singular_name = $my_default_post_name . $my_default_post_suffix;
		$labels->name_admin_bar = $my_default_post_name;
		$labels->all_items = $my_default_post_name . '一覧';
		$labels->add_new_item = $my_default_post_name . 'を追加';
		$labels->edit_item = $my_default_post_name . 'の編集';
		$labels->search_items = $my_default_post_name . 'を検索';
	}

	if(is_string($slug) && !empty($slug)) {
		add_filter('pre_post_link', 'add_article_post_permalink' );
		add_filter('post_rewrite_rules', 'add_article_post_rewrite_rules' );
		add_filter('year_link', 'add_archive_post_permalink');
		add_filter('month_link', 'add_archive_post_permalink');
		add_filter('day_link', 'add_archive_post_permalink');
		add_filter('date_rewrite_rules', 'add_archive_post_rewrite_rules');
	}
	function add_article_post_permalink($permalink) {
		global $my_default_post_slug;
		$permalink = '/' . $my_default_post_slug . $permalink;
		return $permalink;
	}
	function add_article_post_rewrite_rules($post_rewrite) {
		global $my_default_post_slug;
		$return_rule = array();
		foreach ( $post_rewrite as $regex => $rewrite ) {
			$return_rule[$my_default_post_slug . '/' . $regex] = $rewrite;
		}
		return $return_rule;
	}
	function add_archive_post_permalink($permalink){
		global $my_default_post_slug;
		$permalink = str_replace(get_option('home'), get_option('home') . '/' . $my_default_post_slug, $permalink);
		return $permalink;
	}
	function add_archive_post_rewrite_rules($post_rewrite){
		global $my_default_post_slug;
		$return_rule = array();
		foreach ( $post_rewrite as $regex => $rewrite ) {
			$return_rule[$my_default_post_slug . '/' . $regex] = $rewrite;
		}
		return $return_rule;
	}

	if(is_string($icon) && !empty($icon)) {
		add_filter('admin_head', 'add_post_icon_css');
	}
	function add_post_icon_css(){
		global $my_default_post_icon;
		echo '<style>#menu-posts .wp-menu-image:before{content: "\\' . $my_default_post_icon . '";}</style>';
	}
}
