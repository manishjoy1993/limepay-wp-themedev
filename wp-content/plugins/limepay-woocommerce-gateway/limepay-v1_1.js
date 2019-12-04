var successCallback = function(data) {

	var checkout_form = jQuery( 'form.woocommerce-checkout' );

	// deactivate the tokenRequest function event
	checkout_form.off( 'checkout_place_order', tokenRequest );

	// submit the form now
	checkout_form.submit();
	checkout_form.on( 'checkout_place_order', tokenRequest );
};

var errorCallback = function(data) {
    console.log(data);
};

var limepayPaymentTokenExpired = true;

var tokenRequest = function() {
	var limepayInput = jQuery('input#payment_method_limepay');
	if (limepayInput.attr('checked')) {
		// Fires successCallback() on success and errorCallback on failure
		var paymentToken = document.getElementById("limepay-payment-token").value;
		if (paymentToken && paymentToken != '0' && paymentToken.length > 20 && !limepayPaymentTokenExpired) {
			limepayPaymentTokenExpired = true;
			successCallback();
			return false;
		}
		var iframeEl = document.getElementById('limepay-checkout-iframe');
		iframeEl.contentWindow.postMessage('limepay_checkout_submit_event', '*');

		return false;
	}
};

jQuery(function($){
    window.addEventListener("message", function (e) {
		var data = {};
		try {
			data = JSON.parse(e.data);
		} catch (err) {
			console.log(err);
		}
		//console.log(data);
		if (data.service == 'Limepay') {
			if (data.paymentToken) {
				document.getElementById("limepay-payment-token").value = data.paymentToken;
				limepayPaymentTokenExpired = false;
			}
			if (data.windowHeight) {
				console.log(data.windowHeight);
				var iframe = document.getElementById('limepay-checkout-iframe');
				iframe.height = data.windowHeight;
			}
			if (data.submit) {
				tokenRequest();
			}
		}

    });
	var checkout_form = $( 'form.woocommerce-checkout' );
	checkout_form.on( 'checkout_place_order', tokenRequest );

});
