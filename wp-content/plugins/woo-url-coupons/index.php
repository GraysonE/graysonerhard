<?php
/*
Plugin Name: Woo URL Coupons
Plugin URI:
Description: Adds a product and applys a coupon to cart from a URL via GET variables.
Version: 1.0
Author: Grayson Erhard
Author URI: https://graysonerhard.com
License: GPLv2 or later
Text Domain: woo-url-coupons
*/
// EXAMPLE URL: https://graysonerhard.com/promo/?pid=1346&code=ge-test-coupon

wp_enqueue_script('subscribe', plugin_dir_url(__FILE__) . '/subscribe.js', array('jquery'), false, true);


function ged_woo_url_coupons()
{

    global $woocommerce;

    // RUN PIXEL CAFFEINE FOR FB PIXEL PROCESSING
    (function_exists('PixelCaffeine')) ? PixelCaffeine() : false;


    $productID  = (isset($_GET['pid'])) ? $_GET['pid'] : false;
    $couponCode = (isset($_GET['code'])) ? $_GET['code'] : false;

    if ($productID) {

        // REMOVE ALL COUPONS BEFORE ADDING PRODUCT TO REMOVE ANY POSSIBLE ERRORS
        WC()->cart->remove_coupons();

        $woocommerce->cart->empty_cart();

        ged_add_product_to_cart($productID);

        if ($couponCode) {

            ged_apply_matched_coupons($couponCode);

        }

    }

//   echo do_shortcode('[woocommerce_checkout]');

}
add_shortcode('woo_url_coupons', 'ged_woo_url_coupons');


function ged_add_product_to_cart($productID)
{
    if ( ! is_admin()) {
        $found = false;
        //check if product already in cart
        if (sizeof(WC()->cart->get_cart()) > 0) {
            foreach (WC()->cart->get_cart() as $cart_item_key => $values) {
                $_product = $values['data'];
                if ($_product->id == $productID) {
                    $found = true;
                }
            }
            // if product not found, add it
            if ( ! $found) {
                WC()->cart->add_to_cart($productID);
            }
        } else {
            // if no products in cart, add it
            WC()->cart->add_to_cart($productID);
        }
    }
}


function ged_apply_matched_coupons($couponCode)
{

    global $woocommerce;

    if ($woocommerce->cart->cart_contents_count > 0) {
        $woocommerce->cart->add_discount($couponCode);
    }

}

// hide coupon field on checkout page
function ged_hide_coupon_field_on_checkout($enabled)
{

    global $woocommerce;

    $isCheckout = false;

    if (is_checkout()) {
        $isCheckout = true;
    } elseif (strtolower(get_the_title()) === 'promo') {
        $isCheckout = true;
    }

    if (( ! empty($woocommerce->cart->applied_coupons)) && ($isCheckout)) {

        ged_hide_coupon_field();

    } elseif (floatval(WC()->cart->total) === 0.00) {

    	if (is_checkout() ) {
            ged_hide_coupon_field();
	    }

    } elseif (is_cart()) {

        ged_hide_coupon_field();

    } else {
        return true;
    }

}
add_filter('woocommerce_coupons_enabled', 'ged_hide_coupon_field_on_checkout');


function ged_hide_coupon_field()
{
    /* Change woocommerce "place order" text */
    add_filter('woocommerce_order_button_text', 'ged_woo_custom_order_button_text', 10);
    //Change the Billing Details checkout label to Your Details
    add_filter('gettext', 'ged_wc_billing_field_strings', 20, 3);

    // DISABLE AJAX FROM UPDATING 'PLACE ORDER' TEXT
    ?>
	<script type='text/javascript'>
		jQuery( document.body ).on( 'update_checkout', function( e ) {
			e.stopImmediatePropagation();
		} );
	</script>
    <?php

    return false;
}


function ged_woo_custom_order_button_text()
{

    return __('Claim your free item', 'woocommerce');
}


//Change the Billing Details checkout label to Your Details
function ged_wc_billing_field_strings($translated_text, $text, $domain)
{

// 	echo $translated_text;

    switch (strtolower($translated_text)) {
        case 'billing details' :

            $referrerHost = parse_url($_SERVER['HTTP_REFERER'])['host'];

            if ($referrerHost === 'show.co') {
                $translated_text = __('STEP 2/2: Please fill out your info below to receive your free items!',
                    'woocommerce');
            } else {
                $translated_text = __('Please fill out your info below to receive your free items!', 'woocommerce');
            }

            break;
    }

    return $translated_text;
}

//add_action( 'woocommerce_review_order_after_submit', 'woo_url_coupons_subscribe_modal' );

function woo_url_coupons_subscribe_modal()
{
    ?>
	<div id='modal_dialog'>
		<div class='title'>Please subscribe to my mailing list</div>
		<span>Staying connected with you helps me continue to give away free music! Please click OK to accept!</span>
		<input type='button' value='Sign me up!' id='btnYes'/>
		<input type='button' value="Don't sign me up" id='btnNo'/>
	</div>
    <?php
}