<?php
if(!defined('ABSPATH')) exit;


// カスタム投稿タイプの記事数をダッシュボードに表示
function add_dashboard_glance_items($elements) {
	$dashboard_post_type = array('message', 'fude_results', 'fude_qa');

	foreach ($dashboard_post_type as $post_type) {
		$name_posts = get_post_type_object($post_type) -> labels -> name;
		$num_posts = wp_count_posts($post_type);
		if ( $num_posts && $num_posts -> publish ) {
			$text = '【' .$name_posts. '】 ' .number_format_i18n( $num_posts -> publish ). '件の投稿';
			$elements[] = sprintf( '<a href="edit.php?post_type=%1$s" class="%1$s-count">%2$s</a>', $post_type, $text );
		}
	}
	return $elements;
}
add_filter('dashboard_glance_items', 'add_dashboard_glance_items');



// カスタム投稿タイプをアクティビティに表示（まるっと変更）
function add_dashboard_activity() {
	wp_add_dashboard_widget( 'dashboard_new_activity', 'アクティビティ', 'dashboard_new_activities');
}
add_action('wp_dashboard_setup', 'add_dashboard_activity');

function dashboard_new_activities() {
	$dashboard_post_type = array('message', 'fude_results', 'fude_qa');

	$view_types = array(
		'future' => '公開予約',
		'publish' => '最近公開',
	);

	foreach ($view_types as $post_status => $title) {
		$args = array(
			'post_type' => $dashboard_post_type,
			'orderby' => 'date',
			'posts_per_page' => 20,
			'post_status' => $post_status,
		);
		$posts = new WP_Query($args);
		if ($posts->have_posts()) {
			echo '<strong>' . $title . '</strong>';
			echo '<ul>';
			while ($posts->have_posts()) {
				$posts->the_post();
				$posttype = get_post_type_object(get_post_type());
				echo '<li><span class="time">' . get_the_time('Y-m-d H:i') . '</span><span class="title"><a href="edit.php?post_type=' . $posttype->name . '" class="posttype">[' . $posttype->labels->name . ']</a> ';
				echo '<br>';
				if(get_edit_post_link()) {
					echo '<a href="' . get_edit_post_link() . '">' . get_the_title() . '</a>';
				} else {
					echo get_the_title();
				}
				echo '</span>';
			}
			echo '</ul>';
		}
	}
}



// ダッシュボードウィジェット削除
function remove_dashboard_meta() {
//	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' ); // ??
//	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' ); // ??
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );// WordPress ニュース
//	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' ); // ??
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // クイックドラフト
//	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' ); // ??
//	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );// ??
//	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); // 概要
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal'); // アクティビティ
}
add_action( 'admin_init', 'remove_dashboard_meta' );

