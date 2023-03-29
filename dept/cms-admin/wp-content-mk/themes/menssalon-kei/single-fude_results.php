<?php
if(!defined('ABSPATH')) exit;

if(is_preview()) {
	include(TEMPLATEPATH . '/archive-' . $post_type . '.php');
} else {
	header('location:' . get_post_type_archive_link($post_type));
}

