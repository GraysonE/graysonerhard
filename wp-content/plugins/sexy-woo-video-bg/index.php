<?php
/*
Plugin Name: Sexy Woo Video BG
Plugin URI:
Description: Make video background headers that are quick and easy!
Version: 1.0
Author: Sumner & Grayson Erhard | Sexy Studios
Author URI: https://graysonerhard.com
License: GPLv2 or later
Text Domain: sexy-woo-video-bg
*/

define('SWVB_URL', plugin_dir_url(__FILE__));
define('SWVB_PATH', plugin_dir_path(__FILE__));

add_action('wp_enqueue_scripts', 'swvb_scripts');
function swvb_scripts() {

  $videoID = get_post_meta( get_the_ID(), 'ge_video_bg', true );

  if ((is_product_category()) || (is_front_page()) || ($videoID !== '')) {
    wp_enqueue_style( 'swvb', SWVB_URL . 'assets/css/swvb-styles.css', false);
    wp_register_script('swvb', SWVB_URL . 'assets/js/swvb.js', array('jquery'), false, true);
    wp_enqueue_script('swvb');
  }

}

require_once('inc/category.php');
require_once('inc/admin.php');
require_once('inc/page.php');
