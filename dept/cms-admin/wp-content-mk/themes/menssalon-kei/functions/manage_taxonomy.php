<?php
if(!defined('ABSPATH')) exit;

/*
 * 管理画面一覧ページ追加・削除
*/
function my_custom_taxonomy_columns($columns) {
	global $taxonomy;

//	unset($columns['description']);	// 説明

	if ($taxonomy == 'gift_category') {
		unset($columns['description']);	// 説明
		$columns['description_new'] = '説明';
		$columns['cat_img'] = '画像';
	}
	if ($taxonomy == 'special_category') {
		unset($columns['description']);	// 説明
		$columns['special_cat_view'] = '表示';
		$columns['description_new'] = '説明';
		$columns['cat_img'] = '画像';
	}

//	$escape_col = $columns['slug'];
//	unset($columns['slug']); // 一度消して
//	$columns['slug'] = $escape_col; // 最後に追加

	$escape_col = $columns['posts'];
	unset($columns['posts']); // 一度消して
	$columns['posts'] = $escape_col; // 最後に追加

	return $columns;
}
// add_filter('manage_edit-gift_category_columns' , 'my_custom_taxonomy_columns');
// add_filter('manage_edit-special_category_columns' , 'my_custom_taxonomy_columns');


function my_custom_taxonomy_columns_content($content, $column_name, $term_id) {
	global $taxonomy;

	if ($column_name == 'description_new') {
		$term = get_term($term_id, $taxonomy);
		echo mb_strimwidth($term->description, 0, 100, '...');
	}
	elseif ($column_name == 'special_cat_view') {
		$term = get_term($term_id, $taxonomy);
		if($term->parent == 0) {
			$v = get_field($column_name, $taxonomy . '_' . $term_id);;
			if($v == 1) {
				echo '表示';
			}
		}
	}
	elseif ($column_name == 'cat_img' || $column_name == 'special_cat_img') {
		$term = get_term($term_id, $taxonomy);
		$cat_img = wp_get_attachment_image_src(get_field($column_name, $term));
		if($cat_img) {
			echo '<img src="' . $cat_img[0] . '" width="70">';
		}
	}
	else {
		echo get_field($column_name, $taxonomy . '_' . $term_id);
	}
}
// add_filter('manage_gift_category_custom_column', 'my_custom_taxonomy_columns_content', 10, 3);
// add_filter('manage_special_category_custom_column', 'my_custom_taxonomy_columns_content', 10, 3);
