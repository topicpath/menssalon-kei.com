<?php
if(!defined('ABSPATH')) exit;

if(is_preview()) {
	include(TEMPLATEPATH . '/taxonomy-fude_qa_category.php');
} else {
	$cats = get_the_terms($post->ID, 'fude_qa_category');
	if(is_array($cats)) {
		foreach ($cats as $t) {
			header('location:' . get_term_link($t));
			exit;
		}
	}
	header('location:' . get_post_type_archive_link($post_type));
}

