<?php
if(!defined('ABSPATH')) exit;

function change_query($query) {
	if(is_admin() || ! $query->is_main_query()) return;
	if(is_post_type_archive('message')) {
		$query->set('posts_per_page', 30);
	}
	if(is_post_type_archive('fude_qa') || is_tax('fude_qa_category')) {
		$query->set('posts_per_page', -1);
	}
	if(is_post_type_archive('fude_qa')) {
		$query->set('tax_query', array(
			array(
				'taxonomy' => 'fude_qa_category',
				'field' => 'slug',
				'terms' => 'center',
			)
		));
	}
}
add_action('pre_get_posts', 'change_query');
