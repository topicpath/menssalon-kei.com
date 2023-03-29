<?php
if(!defined('ABSPATH')) exit;

function get_the_terms_has_parent($term, $post_id) {
	$my_term_all = array();
	$term_category_all = get_all_category_all($term);
	$my_term_obj = get_the_terms($post_id, $term);
	if(!$my_term_obj) return;
	if($term_category_all[0]) {
		foreach ($term_category_all[0] as $t) {
			$my_term = false;
			if(in_array($t, $my_term_obj)) {
				$my_term = $t;
			}
			$my_term_all[$t->term_id] = $my_term;

			if($term_category_all[1][$t->term_id]) {
				foreach ($term_category_all[1][$t->term_id] as $st) {
					$my_term = false;
					if(in_array($st, $my_term_obj)) {
						$my_term = $st;
						if($st->parent) {
							$my_term_all[$st->parent] = $term_category_all[0][$st->parent];
						}
					}
					$my_term_all[$st->term_id] = $my_term;
				}
			}
		}
	}
	return array_filter($my_term_all, function($result) {
		if ($result) {
			return true;
		} else {
			return false;
		}
	});
}


function get_text_only($str, $trim = null) {
	$str = str_replace(array(PHP_EOL, "\t"), '', strip_tags(trim($str)));
	if($trim && is_numeric($trim)) {
		$str = mb_strimwidth($str, 0, $trim, '...');
	}
	return $str;
}
