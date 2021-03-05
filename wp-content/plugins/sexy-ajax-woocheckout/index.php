<?php
/*
Plugin Name: Sexy AJAX WooCheckout
Plugin URI:
Description: Dynamic slider that allows AJAX cart and checkout functionality to speed up customer conversion.
Version: 1.0
Author: Grayson Erhard
Author URI: https://graysonerhard.com
License: GPLv2 or later
Text Domain: sexy-ajax-woocheckout
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

define( 'SEXY_WOOCHECKOUT_URL', plugin_dir_url( __FILE__ ) );
define( 'SEXY_WOOCHECKOUT_PATH', plugin_dir_path( __FILE__ ) );

// ADMIN (NEEDS TO BE OUTSIDE OF IF STATEMENT TO MAKE 'ENABLED' CHANGES
require_once 'includes/admin/admin.php';

if ( get_option( 'wc_sexy_woocheckout_enabled' ) === 'yes' ) {

	// ADMIN
	include_once 'includes/admin/widget.php';

	// FRONTEND
	include_once 'includes/front-end/slider.php';
	// include_once('assets/css/sexy-woo-checkout.dcss.php');

	// WOOCOMMERCE
	include_once 'includes/woocommerce/form-fields.php';
	include_once 'includes/woocommerce/customizations.php';
//	include_once 'includes/woocommerce/ajax.php'; // changed this for name your price
 
	add_action( 'wp_enqueue_scripts', 'sexy_woocheckout_scripts' );
	function sexy_woocheckout_scripts() {

		global $woocommerce;
		wp_enqueue_style( 'default-woo-checkout', SEXY_WOOCHECKOUT_URL . 'assets/css/default-woo-checkout.css' );

		$cart_total = floatval( preg_replace( '#[^\d.]#', '', $woocommerce->cart->get_cart_total() ) );

		$data = array(
			'apply_coupon_nonce'                     => wp_create_nonce( 'apply-coupon' ),
			'remove_coupon_nonce'                    => wp_create_nonce( 'remove-coupon' ),
			'update_order_nonce'                     => wp_create_nonce( 'update-order-review' ),
			'remove_order_item'                      => wp_create_nonce( 'order-item' ),
			'update_total_price_nonce'               => wp_create_nonce( 'update_total_price' ),
			'update_shipping_method_nonce'           => wp_create_nonce( 'update-shipping-method' ),
			'update_order_review'                    => wp_create_nonce( 'update-order-review' ),
			'process_checkout'                       => wp_create_nonce( 'woocommerce-process_checkout' ),
			// SEXY WOOCHECKOUT LOCALIZATION
			'sexy_woocheckout_theme'                 => get_option( 'wc_sexy_woocheckout_theme' ),
			'sexy_woocheckout_link_color'            => get_option( 'wc_sexy_woocheckout_link_color' ),
			'sexy_woocheckout_text_color'            => get_option( 'wc_sexy_woocheckout_text_color' ),
			'sexy_woocheckout_button_color'          => get_option( 'wc_sexy_woocheckout_button_color' ),
			'sexy_woocheckout_cart_icon_class'       => get_option( 'wc_sexy_woocheckout_cart_icon_class' ),
			'sexy_woocheckout_show_related_products' => get_option( 'wc_sexy_woocheckout_show_related_products' ),
			'sexy_woocheckout_show_related_products' => get_option( 'wc_sexy_woocheckout_show_related_products' ),
			'sexy_woocheckout_show_form_labels'      => get_option( 'wc_sexy_woocheckout_show_form_labels' ),
			'sexy_woocheckout_show_additional_information' => get_option( 'wc_sexy_woocheckout_show_additional_information' ),
			'total'                                  => $cart_total,
		);

		wp_register_script( 'default-woo-checkout', SEXY_WOOCHECKOUT_URL . 'assets/js/default-woo-checkout.js', array( 'jquery' ), false, true );
		wp_localize_script( 'default-woo-checkout', 'localized_sexy_config', $data );
//		wp_enqueue_script( 'default-woo-checkout' ); // changed this for name your price

		if ( ( ! is_checkout() ) && ( ! is_cart() ) ) {

			wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
			wp_enqueue_style( 'slider-div-style', SEXY_WOOCHECKOUT_URL . 'assets/css/slider-div-style.css' );
			wp_enqueue_style( 'sexy-woo-checkout', SEXY_WOOCHECKOUT_URL . 'assets/css/sexy-woo-checkout.css' );

			wp_register_script( 'slider-div', SEXY_WOOCHECKOUT_URL . 'assets/js/slider-div.js', array( 'jquery' ), false, true );
			wp_register_script( 'sexy-woo-checkout', SEXY_WOOCHECKOUT_URL . 'assets/js/sexy-woo-checkout.js', array( 'jquery' ), false, true );
			wp_register_script( 'project-specific', SEXY_WOOCHECKOUT_URL . 'assets/js/project-specific/project-specific-functions.js', array( 'jquery' ), false, true );
			wp_register_script( 'dynamic-styles', SEXY_WOOCHECKOUT_URL . 'assets/js/dynamicStyles.js', array( 'jquery' ), false, true );

//			wp_localize_script( 'sexy-woo-checkout', 'localized_sexy_config', $data );
			wp_localize_script( 'slider-div', 'localized_sexy_config', $data ); // changed this for name your price

			wp_enqueue_script( 'slider-div' );
//			wp_enqueue_script( 'sexy-woo-checkout' ); // changed this for name your price
			wp_enqueue_script( 'project-specific' );
			wp_enqueue_script( 'dynamic-styles' );

		}

	}
}
