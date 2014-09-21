<?php

function redirect_to_post(){
    global $wp_query;
    if( is_archive() && $wp_query->post_count == 1 ){
        the_post();
        $post_url = get_permalink();
        wp_redirect( $post_url );
    }
}
//add_action('template_redirect', 'redirect_to_post');

function tvjussieu_get_jt_youtube_code( $jt_id ) {
	$post = get_post($jt_id);
	$youtube = get_post_meta( $post->ID, TVJussieu_JT::POST_TYPE . '_youtube', true );
	if ($youtube) {
		preg_match('#^https?:\/\/www\.youtube\.com\/watch\?v\=(.*)#', $youtube, $matches);
		return $matches[1];
	}
}

function tvjussieu_get_jt_dailymotion_code( $jt_id ) {
	$post = get_post($jt_id);
	$dailymotion = get_post_meta( $post->ID, TVJussieu_JT::POST_TYPE . '_dailymotion', true );
	if ($dailymotion) {
		preg_match('#^https?:\/\/www\.dailymotion\.com\/video\/([^_]+).*#', $dailymotion, $matches);
		return $matches[1];
	}
}
