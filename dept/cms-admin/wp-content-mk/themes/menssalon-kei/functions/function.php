<?php
if(!defined('ABSPATH')) exit;

/*
 * カテゴリ一覧
*/
function get_all_category_all($taxonomy = 'category', $hide_empty = 1) {
	$group = is_array($taxonomy) ? implode('-', $taxonomy) : $taxonomy;
	$group .= '-' . $hide_empty;
	if ( ! $cat_all = wp_cache_get( 'all_category_all', $group) ) {
		$all = get_terms($taxonomy, 'hide_empty=' . $hide_empty);
		$cat_p = array();
		$cat_c = array();
		foreach($all as $v){
//			if($v->term_id == 1) continue;
			if($v->parent == 0) {
				$cat_p[$v->term_id] = $v;
			}else {
				$cat_c[$v->parent][$v->term_id] = $v;
			}
		}
		$cat_all = array($cat_p, $cat_c);
		wp_cache_add( 'all_category_all', $cat_all, $group);
	}
	return $cat_all;
}

/*
 * カテゴリ一覧(カスタム投稿)
*/
function df_terms_clauses($clauses, $taxonomy, $args) {
	if (!empty($args['post_type']))	{
		global $wpdb;

		$post_types = array();

		foreach($args['post_type'] as $cpt)	{
			$post_types[] = "'".$cpt."'";
		}

		if(!empty($post_types))	{
			$clauses['fields'] = 'DISTINCT '.str_replace('tt.*', 'tt.term_taxonomy_id, tt.term_id, tt.taxonomy, tt.description, tt.parent', $clauses['fields']).', COUNT(t.term_id) AS count';
			$clauses['join'] .= ' INNER JOIN '.$wpdb->term_relationships.' AS r ON r.term_taxonomy_id = tt.term_taxonomy_id INNER JOIN '.$wpdb->posts.' AS p ON p.ID = r.object_id';
			$clauses['where'] .= ' AND p.post_type IN ('.implode(',', $post_types).') AND p.post_status = "publish"';
			$clauses['orderby'] = 'GROUP BY t.term_id '.$clauses['orderby'];
		}
	}
	return $clauses;
}
add_filter('terms_clauses', 'df_terms_clauses', 10, 3);

/*
 * 記事画像取得
*/
function get_the_post_image($postid,$size,$order=0,$max=null) {
	$attachments = get_children(array('post_parent' => $postid, 'post_type' => 'attachment', 'post_mime_type' => 'image'));
	if ( is_array($attachments) ){
		$mo = array();
		$aid = array();
		foreach ($attachments as $key => $row) {
			$mo[$key] = $row->menu_order;
			$aid[$key] = $row->ID;
		}
		if(count($mo) < 1) return;
		array_multisort($mo, SORT_ASC,$aid,SORT_ASC,$attachments);
		$max = empty($max) ? $order+1 :$max;
		for($i=$order;$i<$max;$i++){
			return wp_get_attachment_image_src( $attachments[$i]->ID, $size );
		}
	}
}

function get_the_post_image_html($postid = null) {
	global $post, $posts;
	preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matche_img);
	if(is_array($matche_img[1])) {
		foreach ($matche_img[1] as $img) {
			if(strstr($img, 'emoticons') === FALSE && strstr($img, 'typepad-emoji-for-tinymce') === FALSE) return $img;
		}
	}
	return '';
}

/*
 * 月別アーカイブを配列で
*/
/**
* @function get_archives_array
* @param post_type(string) / period(string) / year(Y) / limit(int)
* @return array
*/
if(!function_exists('get_archives_array')){
	function get_archives_array($args = ''){
		global $wpdb, $wp_locale;

		$defaults = array(
			'post_type' => '',
			'period'  => 'monthly',
			'year' => '',
			'limit' => ''
		);
		$args = wp_parse_args($args, $defaults);
		extract($args, EXTR_SKIP);

		if($post_type == ''){
			$post_type = 'post';
		}elseif($post_type == 'any'){
			$post_types = get_post_types(array('public'=>true, '_builtin'=>false, 'show_ui'=>true));
			$post_type_ary = array();
			foreach($post_types as $post_type){
				$post_type_obj = get_post_type_object($post_type);
				if(!$post_type_obj){
					continue;
				}

				if($post_type_obj->has_archive === true){
					$slug = $post_type_obj->rewrite['slug'];
				}else{
					$slug = $post_type_obj->has_archive;
				}

				array_push($post_type_ary, $slug);
			}

			$post_type = join("', '", $post_type_ary);
		}else{
			if(!post_type_exists($post_type)){
				return false;
			}
		}
		if($period == ''){
			$period = 'monthly';
		}
		if($year != ''){
			$year = intval($year);
			$year = " AND DATE_FORMAT(post_date, '%Y') = ".$year;
		}
		if($limit != ''){
			$limit = absint($limit);
			$limit = ' LIMIT '.$limit;
		}

		$where  = "WHERE post_type IN ('".$post_type."') AND post_status = 'publish'{$year}";
		$join   = "";
		$where  = apply_filters('getarchivesary_where', $where, $args);
		$join   = apply_filters('getarchivesary_join' , $join , $args);

		if($period == 'monthly'){
				$query = "SELECT YEAR(post_date) AS 'year', MONTH(post_date) AS 'month', count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC $limit";
		}elseif($period == 'yearly'){
			$query = "SELECT YEAR(post_date) AS 'year', count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date) ORDER BY post_date DESC $limit";
		}

		$key = md5($query);
		$cache = wp_cache_get('get_archives_array', 'general');
		if(!isset($cache[$key])){
			$arcresults = $wpdb->get_results($query);
			$cache[$key] = $arcresults;
			wp_cache_set('get_archives_array', $cache, 'general');
		}else{
			$arcresults = $cache[$key];
		}
		if($arcresults){
			$output = (array)$arcresults;
		}

		if(empty($output)){
			return false;
		}

		return $output;
	}
}


/*
 * サムネイル取得
*/
function get_thumbs($post_id, $size='thumbnail', $return_array = false, $use_cassette = false) {
	$img = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $size);
	if(!$img) $img = get_the_post_image($post_id, $size);
	if($img) {
		if($return_array) {
			return $img;
		} else {
			return $img[0];
		}
	}
	if($use_cassette) {
		$img_excerpt = get_cassette_img_excerpt($post_id, $size);
		if($img_excerpt['ph']) {
			return $img_excerpt['ph'];
		}
	}
	else {
		$img = get_the_post_image_html();
		if($img) {
			return $img;
		}
	}
	return false;
}

/*
 * 一番上の親取得
*/
function get_toplevel_post_name() {
	global $post;
	if (!is_page()) return '';

	$p = $post;
	while ( $p->post_parent != 0 ) {
		$p = get_post( $p->post_parent );
	}
	return $p->post_name;
}


/*
 * カテゴリ取得
*/
function get_post_cate($post = null) {
	if(!$post) global $post;

	$term = get_the_terms($post->ID, 'post_cate');
	if(!$term) return;

	$term = array_pop($term);
	return $term;
}


/*
 * 一番上まで階層取得
*/
function get_parent_pages() {
	global $post;
	$p = $post;
//	if (!is_page()) return;
/*
	$p = $post;
	$pages = array(array('id' => $p->ID, 'dir' => $p->post_name, 'title' => $p->post_title));
	while($p) {
		$p = get_post($p->post_parent);
		if($p->post_title == $post->post_title) break;
		array_unshift($pages, array('id' => $p->ID, 'dir' => $p->post_name, 'href' => get_the_permalink($p->ID), 'title' => $p->post_title));
		if($p->post_parent == 0) break;
	}
	return $pages;*/

	$parents = get_post_ancestors($p->ID);
	$pages = array();
	foreach ($parents as $pid) {
		$p = get_post($pid);
		array_unshift($pages, array('id' => $p->ID, 'dir' => $p->post_name, 'href' => get_the_permalink($p->ID), 'title' => $p->post_title));
	}
	return $pages;
}




/*
 * 投稿ページスラッグ名からIDを取得
*/
function get_post_id_by_slug($post_slug, $post_type = 'post', $return_id = true){
	$args=array(
		'name' => $post_slug,
		'post_type' => $post_type,
		'post_status' => 'publish',
		'numberposts' => 1
	);
	$found_posts = get_posts($args);
	if( $found_posts ) {
		if($return_id) return $found_posts[0]->ID;
		else return $found_posts[0];
	}else{
		return NULL;
	}
}



/*
 * ページネーション
*/
function wp_pagination() {
	global $wp_query;
	$big = 99999999;
	$page_format = paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'prev_next' => false,
		'prev_next' => false,
		'format' => '?paged=%#%',
		'current' => max(1, get_query_var('paged')),
		'total' => $wp_query->max_num_pages,
		'mid_size' => 3,
		'type'  => 'array',
		'before_page_number' => '<span>',
		'after_page_number' => '</span>'
	) );

	if(is_array($page_format)) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
		echo '<div class="in">';
		if($paged == 1) {
			echo '<a class="prev"><span>前へ</span></a>';
		} else {
			echo '<a href="' . get_pagenum_link(1) . '" class="prev"><span>前へ</span></a>';
		}
		echo '<ul class="page">';
		foreach ( $page_format as $page ) {
			$page = str_replace(array("<span class='page-numbers current'><span>", "</span></span>"), array("<a><span>", "</span></a>"), $page);
			echo "<li>$page</li>";
		}
		echo '</ul>';
		if($paged == $wp_query->max_num_pages) {
			echo '<a class="next"><span>次へ</span></a>';
		} else {
			echo '<a href="' . get_pagenum_link($wp_query->max_num_pages) . '" class="next"><span>次へ</span></a>';
		}
		echo '</div>';
	}
	wp_reset_query();
}



/*
 * url自動リンク変換
*/
function escape_and_linkify($str) {
	//http,https,ついでにftpにマッチ
	$pattern_http = '/((?:https?):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
	$replace_http = '<a href="\1" target="_blank">\1</a>';
	//メールアドレスにマッチ
	$pattern_mail = '/([a-zA-Z0-9_\-\.]+@[a-zA-Z0-9\-\.]+\.[a-zA-Z]+)/';
	$replace_mail = '<a href="mailto:\1">\1</a>';
	//置換
	$str = preg_replace( $pattern_http, $replace_http, $str );
	$str = preg_replace( $pattern_mail, $replace_mail, $str );
	return $str;
}



function get_parent_meta_query() {
	return array(
		'relation' => 'OR',
		array(
			'key' => 'parent_post',
			'compare' => 'NOT EXISTS'
		),
		array(
			'key' => 'parent_post',
			'value' => '0',
			'type' => 'NUMERIC'
		)
	);
}


