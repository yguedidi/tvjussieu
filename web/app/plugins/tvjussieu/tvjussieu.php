<?php
/*
 * Plugin Name: TV Jussieu
 * Version: 1.0
 * Plugin URI: http://tvjussieu.com/
 * Description: La chaine qui fait bouger le campus
 * Author: Yassine Guedidi
 * Author URI: http://yassine.guedidi.com/
 * Requires at least: 3.9
 * Tested up to: 4.0
 *
 * @package TV Jussieu
 * @author Yassine Guedidi
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'TVJussieu' ) ) {

	class TVJussieu
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
			if ( !class_exists( 'TVJussieu_JT' ) ) {
				require_once dirname( __FILE__ ) . '/post-types/jt.php';
			}

			if ( !class_exists( 'TVJussieu_Staff' ) ) {
				require_once dirname( __FILE__ ) . '/post-types/staff.php';
			}

			if ( class_exists( 'TVJussieu_JT' ) ) {
				$tvj_jt = new TVJussieu_JT();
			}

			if ( class_exists( 'TVJussieu_Staff' ) ) {
				$tvj_staff = new TVJussieu_Staff();
			}

			add_filter( 'fb_meta_tags', array($this, 'facebook_og_metas') );
		}

		public function facebook_og_metas( $metas )
		{
			if ( is_front_page() ) {
				$metas['http://ogp.me/ns#type'] = 'video.tv_show';
			}

			return $metas;
		}

		/**
		 * Activate the plugin
		 */
		public static function activate()
		{
			//flush_rewrite_rules();
		}

		/**
		 * Deactivate the plugin
		 */
		public static function deactivate()
		{
			//flush_rewrite_rules();
		}

	}

}

if ( class_exists( 'TVJussieu' ) ) {
	register_activation_hook( __FILE__, array('TVJussieu', 'activate') );
	register_deactivation_hook( __FILE__, array('TVJussieu', 'deactivate') );

	$tvj = new TVJussieu();
}

add_filter('image_resize_dimensions', function ($default, $orig_w, $orig_h, $new_w, $new_h, $crop) {
	if(!$crop)
		return null; // let the wordpress default function handle this

	$aspect_ratio = $orig_w / $orig_h;
	$size_ratio = max($new_w / $orig_w, $new_h / $orig_h);

	$crop_w = round($new_w / $size_ratio);
	$crop_h = round($new_h / $size_ratio);

	$s_x = floor( ($orig_w - $crop_w) / 2 );
	$s_y = floor( ($orig_h - $crop_h) / 2 );

	return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
}, 10, 6);