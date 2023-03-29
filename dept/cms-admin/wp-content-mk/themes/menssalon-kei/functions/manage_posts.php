<?php
if(!defined('ABSPATH')) exit;

/*
 * 管理画面一覧ページ追加・削除
*/
function manage_posts_columns($columns) {
	global $post;

	unset($columns['author']);
	unset($columns['tags']);
	unset($columns['comments']);
//	unset($columns['categories']);

	if ($post->post_type == 'news') {
		$columns['thumbs'] = 'アイキャッチ';
	}
	elseif ($post->post_type == 'fude_results') {
		$columns['fude_address'] = '住所';
		$columns['thumbs--fude_img'] = '写真';
	}

	$escape_col = $columns['date'];
	unset($columns['date']); // 一度消して
	$columns['date'] = $escape_col; // 最後に追加

	return $columns;
}
add_filter('manage_posts_columns', 'manage_posts_columns');

function add_column($column_name, $post_id) {
	global $post;

	if ($column_name == 'thumbs') {
		if(get_thumbs($post_id)) {
			echo '<img src="' . get_thumbs($post_id) . '" width="80">';
		}
	}
	elseif (strpos($column_name, 'thumbs--') === 0) {
		$my_width = 80;
		$column_name_arr = explode('--', $column_name);
		if(count($column_name_arr) >= 3 && is_numeric($column_name_arr[1])) $my_width = $column_name_arr[1];
		$field_name = array_pop($column_name_arr);
//		$img = wp_get_attachment_image_src(get_field($field_name, $post_id), 'medium');
		$img = wp_get_attachment_image_src(get_field($field_name, $post_id));
		if($img) {
			echo '<img src="' . $img[0] . '" width="' . $my_width . '">';
		}
	}
	elseif ($column_name == 'area_ph') {
		$ph = get_field($column_name, $post_id);
		if($ph && $ph[0]) {
			$img = wp_get_attachment_image_src($ph[0]);
			if($img) {
				echo '<img src="' . $img[0] . '" width="80">';
			}
		}
	}
	else {
		echo get_field($column_name, $post_id);
	}
}
add_action('manage_posts_custom_column', 'add_column', 10, 2);

/* ソートカラム */
function column_orderby_myfield($vars) {
	if (isset($vars['orderby']) && 'oc_date' == $vars['orderby'] ) {
		$vars = array_merge( $vars, array(
			'meta_key' => $vars['orderby'],
			'orderby' => 'meta_value'
		));
	}
	return $vars;
}
// add_filter('request', 'column_orderby_myfield');

function posts_register_sortable($sortable_column) {
	$sortable_column['oc_date'] = 'oc_date';
	return $sortable_column;
}
// add_filter('manage_edit-opencampus_sortable_columns', 'posts_register_sortable');

/* 初期値ソート変更 */
function column_orderby_def($query) {
	if(is_admin() && $query->is_main_query() && is_post_type_archive('')) {
		$query->set('meta_key', 'oc_date');
		$query->set('orderby', 'meta_value');
	}
}
// add_action('pre_get_posts', 'column_orderby_def');



/*
 * 管理画面絞り込み追加
*/
// カスタムタクソノミーでフィルター （絞り込み機能）
add_action('restrict_manage_posts', 'add_post_taxonomy_restrict_filter');
function add_post_taxonomy_restrict_filter() {
	global $post_type;

	function getmyCate($term_name, $has_child = false) {
		$terms = get_all_category_all($term_name, 0);
		if(!is_array($terms[0]) || count($terms[0]) == 0) return;
?>
<select name="<?php echo $term_name; ?>">
<option value="">すべての<?php echo get_taxonomy($term_name)->labels->name; ?></option>
<?php
		foreach ($terms[0] as $term) {
			$selected = $term->slug === $_REQUEST[$term_name] ? ' selected' : '';
?>
<option value="<?php echo $term->slug; ?>"<?php echo $selected; ?>><?php echo $term->name; ?></option>
<?php
			if($terms[1][$term->term_id]) {
				foreach ($terms[1][$term->term_id] as $term_s) {
					$selected = $term_s->slug === $_REQUEST[$term_name] ? ' selected' : '';
?>
<option value="<?php echo $term_s->slug; ?>"<?php echo $selected; ?>><?php echo $term->name; ?> <?php echo $term_s->name; ?></option>
<?php
				}
			}
		}
?>
</select>
<?php
	}

	if ($post_type == 'fude_qa') {
		getmyCate('fude_qa_category');
	}
}

