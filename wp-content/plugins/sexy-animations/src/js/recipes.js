$=jQuery;


/****** ANIMATION RECIPES *******
 *
 *  Create your animation recipes by using these HTML classes:
 *
 *  .wp-animation
 *  .wp-{animationName}
 *  .wp-delay-{numberOfSeconds}
 *
 *  Example -fadeIn animation with 1 second delay:
 *   $('.className').addClass('wp-animation').addClass('wp-fadeIn').addClass('wp-delay-1');
 *
 * */

$( document ).ready(function() {

  /******** HomePage Recipe ******/

  $('.home .home-page-2 h3').addClass('wp-animation').addClass('wp-fadeInUp');
  $('.home .home-page-4 h3').addClass('wp-animation').addClass('wp-fadeInUp');

  $('.home .video-slider').addClass('wp-animation').addClass('wp-fadeIn');

  $('.footer-widgets-1 h4').addClass('wp-animation').addClass('wp-fadeIn');
  $('.footer-widgets-1 #text-36 p').addClass('wp-animation').addClass('wp-tada');

  /******** Product Slider Recipe ******/

  // fadeIn
  $('.home .ge-slider-product-title').addClass('wp-animation').addClass('wp-fadeIn');
  $('.home .ge-slider-product-price').addClass('wp-animation').addClass('wp-fadeIn');
  $('.home .ge-slider-product-headline.desktop').addClass('wp-animation').addClass('wp-fadeIn');
  // fadeInUp
  $('.home .ge-slider-product').addClass('wp-animation').addClass('wp-fadeInUp');
  $('.home .ge-slider-product-headline.mobile').addClass('wp-animation').addClass('wp-fadeInUp');
  $('.home .ge-slider-add-to-cart').addClass('wp-animation').addClass('wp-fadeInUp');


  $('.product-background.record').addClass('wp-animation').addClass('wp-rotateIn').addClass('wp-delay-1');

  /******** Shop Category Page's Recipe ******/

  //fadeInUp
  $('.archive.woocommerce .product').addClass('wp-animation').addClass('wp-fadeInUp');
  $('.archive.woocommerce .woocommerce-ordering select').addClass('wp-animation').addClass('wp-fadeInUp');
  $('.archive .page-title').addClass('wp-animation').addClass('wp-fadeInUp');

  /******** Single Product Page's Recipe ******/

  //fadeIn
  $('.single-product div.product .bwpp_iframe_wrap').addClass('wp-animation').addClass('wp-fadeIn').addClass('wp-delay-2');
  $('.single-product .product_title').addClass('wp-animation').addClass('wp-fadeIn');
  $('.single-product .summary .price').addClass('wp-animation').addClass('wp-fadeIn').addClass('wp-delay-1');
  $('.single-product .woocommerce-product-details__short-description').addClass('wp-animation').addClass('wp-fadeIn').addClass('wp-delay-1');
  $('.single-product .ssp_video').addClass('wp-animation').addClass('wp-fadeIn').addClass('wp-delay-1');
  $('.single-product .lyrics_title').addClass('wp-animation').addClass('wp-fadeIn');
  //$('.single-product .lyrics').addClass('wp-animation').addClass('wp-fadeIn');
  $('.single-product .upsells .products .product').addClass('wp-animation').addClass('wp-fadeInUp');
  $('.single-product .upsells h2').addClass('wp-animation').addClass('wp-fadeIn');


  /******** New Music Release Marketing Page ******/
  // $('.sexy_song_link_container h2').addClass('wp-animation').addClass('wp-fadeIn').addClass('wp-delay-1');
  // $('.sexy_song_link_container h4').addClass('wp-animation').addClass('wp-fadeIn').addClass('wp-delay-1');
  // $('.sexy_song_link').addClass('wp-animation').addClass('wp-fadeIn').addClass('wp-delay-2');
  // $('.song_link_share').addClass('wp-animation').addClass('wp-fadeIn').addClass('wp-delay-3');


});