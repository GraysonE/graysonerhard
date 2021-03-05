$ = jQuery;

$( document ).ready( function() {

	$( '#place_order' ).unbind().click( function( e ) {
		e.preventDefault();

		if ( ( $( '#billing_first_name' ).val() == '' ) || ( $( '#billing_last_name' ).val() == '' ) || ( $( '#billing_email' ).val() == '' ) ) {
			alert( 'Please make sure you have filled out first name, last name, and email to receive your order.' );
		} else if ( ( $( 'input[name="ss_wc_mailchimp_opt_in"]:checked' ).length < 1 ) && ( parseInt( localized_sexy_config.total ) === 0 ) ) {
			let result = confirm( 'Please consider subscribing to my new new music and show announcements. Staying connected with you helps me continue to give away free music! Click OK to accept!' );
			if ( result ) {
				$( 'input[name="ss_wc_mailchimp_opt_in"]' ).prop( 'checked', true );
				$( 'form[name="checkout"]' ).submit();
			} else {
				$( 'form[name="checkout"]' ).submit();
			}
		} else {
			$( 'form[name="checkout"]' ).submit();
		}
	} );

} );