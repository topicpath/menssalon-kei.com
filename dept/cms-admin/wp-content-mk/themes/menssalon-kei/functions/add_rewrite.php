<?php
if(!defined('ABSPATH')) exit;

/*
 * リライトルール追加
*/
function custom_add_rewrite_rules( $wp_rewrite ) {
	$new_rules = array(
		// tag
		'column/tag/([^/]+)/page/([0-9]+)/?$' => 'index.php?column_tag=$matches[1]&paged=$matches[2]',
		'column/tag/([^/]+)/?$' => 'index.php?column_tag=$matches[1]',
	);
	$wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}
// add_action('generate_rewrite_rules', 'custom_add_rewrite_rules');

function custom_queryvars($qvars) {
	$qvars[] = 'cdate';
	$qvars[] = 'fair_y';
	$qvars[] = 'fair_m';
	$qvars[] = 'fair_d';
	return $qvars;
}
// add_filter('query_vars', 'custom_queryvars');
