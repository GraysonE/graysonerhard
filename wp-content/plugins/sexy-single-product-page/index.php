<?php

/*
Plugin Name: Sexy Single Product Page
Plugin URI:
Description: Sexier single-product page
Version: 1.0
Author: Sumner Erhard
Author URI: https://sumnererhard.com
License: GPLv2 or later
Text Domain: sexy-single-product-page
*/

define('SSP_URL', plugin_dir_url(__FILE__));
define('SSP_PATH', plugin_dir_path(__FILE__));

add_action('wp_enqueue_scripts', 'ssp_scripts_styles');
function ssp_scripts_styles() {

	wp_enqueue_style('sexy-single-product-css', SSP_URL .'assets/css/sexy-single-product.css');
	wp_register_script('sexy-single-product-js', SSP_URL .'assets/js/sexy-single-product.js', 'woocommerce', 1, true);

	wp_localize_script('sexy-single-product-js', 'SSP_LOCAL_PHP', array(
		'siteUrl' => get_bloginfo( 'url' )
	) );

	wp_enqueue_script('sexy-single-product-js');

}

// Create Custom Fields
add_action( 'woocommerce_product_options_general_product_data', 'ssp_add_custom_fields' );

function ssp_add_custom_fields() {

	global $woocommerce, $post;

	echo '<div class="options_group">';

	woocommerce_wp_textarea_input(
		array(
			'id'          => '_youtube_text_area',
			'label'       => __( 'YouTube Videos', 'woocommerce' ),
			'placeholder' => __( 'Separate each YouTube Video url with a comma', 'woocommerce' ),
			'desc_tip'    => 'true',
			'description' => __( 'Separate each YouTube Video url with a comma', 'woocommerce' )
		)
	);

	echo '</div>';

}

// Save Custom Fields
add_action( 'woocommerce_process_product_meta', 'ssp_save_custom_fields' );

function ssp_save_custom_fields($post_id) {

	$youtube_text_area = $_POST['_youtube_text_area'];

	if( !empty( $youtube_text_area  ) )
		update_post_meta( $post_id, '_youtube_text_area', esc_attr( $youtube_text_area ) );

}

add_action( 'woocommerce_before_single_product_summary', 'ssp_get_product_image', 10 );

function ssp_get_product_image() {
	global $product;
	$id = $product->get_id();
	$terms = wp_get_post_terms( $id, 'product_cat' );
	foreach ( $terms as $term ) $categories[] = $term->slug;
	
	if ( has_post_thumbnail( $id ) ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $id), 'thumbnail' );
//    echo '<div class="ssp_background"></div>';
		echo '<div class="blur_background_image" style="background-image: url(' . esc_url( $image[0] ) . ');"></div>';
	}
}

add_action( 'woocommerce_after_single_product_summary', 'ssp_video', 15 );

function ssp_video() {
	include_once( SSP_PATH . 'includes/product-video.php' );
}

add_action( 'woocommerce_after_single_product', 'ssp_lyrics', 10 );

function ssp_lyrics() {
	echo do_shortcode( '[sexy_slider lyrics=true]' );
	//include_once( SSP_PATH . 'includes/product-lyrics.php' );
}


add_action( 'woocommerce_after_single_product', 'ssp_output_upsells', 15 );

function ssp_output_upsells() {
	woocommerce_upsell_display( 4,3 );
}