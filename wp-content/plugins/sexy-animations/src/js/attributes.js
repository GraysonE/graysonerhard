$=jQuery;

// Add data attributes to each elements with wp classes

$( document ).ready(function() {

  // All of the animation classes from animate.css
  var animations = [
    "bounce",
    "flash",
    "pulse",
    "rubberBand",
    "shake",
    "swing",
    "tada",
    "wobble",
    "jello",

    "bounceIn",
    "bounceInDown",
    "bounceInLeft",
    "bounceInRight",
    "bounceInUp",

    "bounceOut",
    "bounceOutDown",
    "bounceOutLeft",
    "bounceOutRight",
    "bounceOutUp",

    "fadeIn",
    "fadeInDown",
    "fadeInDownBig",
    "fadeInLeft",
    "fadeInLeftBig",
    "fadeInRight",
    "fadeInRightBig",
    "fadeInUp",
    "fadeInUpBig",

    "fadeOut",
    "fadeOutDown",
    "fadeOutDownBig",
    "fadeOutLeft",
    "fadeOutLeftBig",
    "fadeOutRight",
    "fadeOutRightBig",
    "fadeOutUp",
    "fadeOutUpBig",

    "flip",
    "flipInX",
    "flipInY",
    "flipOutX",
    "flipOutY",

    "lightSpeedIn",
    "lightSpeedOut",

    "rotateIn",
    "rotateInDownLeft",
    "rotateInDownRight",
    "rotateInUpLeft",
    "rotateInUpRight",

    "rotateOut",
    "rotateOutDownLeft",
    "rotateOutDownRight",
    "rotateOutUpLeft",
    "rotateOutUpRight",

    "slideInUp",
    "slideInDown",
    "slideInLeft",
    "slideInRight",

    "slideOutUp",
    "slideOutDown",
    "slideOutLeft",
    "slideOutRight",

    "zoomIn",
    "zoomInDown",
    "zoomInLeft",
    "zoomInRight",
    "zoomInUp",

    "zoomOut",
    "zoomOutDown",
    "zoomOutLeft",
    "zoomOutRight",
    "zoomOutUp",

    "hinge",
    "jackInTheBox",
    "rollIn",
    "rollOut"
  ];

  // Append the data attribute
  $.each( animations, function( index, animation ) {
    $('.wp-' + animation).attr('data-wp-animation', animation);
  });
  
  // Search for delay classes
  for (var x = 1; x <= 5; x++) {
    if ( $('.wp-animation').hasClass('wp-delay-' + x) || $('.animated').hasClass('wp-delay-' + x) ) {
      $('.wp-delay-' + x).attr('data-wp-animation-delay', x + 's');
    }
  }

});