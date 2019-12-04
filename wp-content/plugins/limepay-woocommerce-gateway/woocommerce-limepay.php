<?php
/* Limepay Payment Gateway Class */
class Limepay extends WC_Payment_Gateway {

	protected $_lpProdHost  = 'https://www.limepay.com.au';
	// protected $_lpDevHost  = 'http://localhost:8080';
	protected $_lpDevHost  = 'https://www.dev.limepay.com.au';

	// Setup our Gateway's id, description and other values
	function __construct() {

		// The global ID for this Payment method
		$this->id = "limepay";

		// The Title shown on the top of the Payment Gateways Page next to all the other Payment Gateways
		$this->method_title = __( "Limepay", 'limepay' );

		// The description for this Payment Gateway, shown on the actual Payment options page on the backend
		$this->method_description = __( "Let customer pay in full or with flexible instalments. No third-party branding.", 'limepay' );

		// The title to be used for the vertical tabs that can be ordered top to bottom
		$this->title = __( "Limepay", 'limepay' );

		// If you want to show an image next to the gateway's name on the frontend, enter a URL to an image.
		$this->icon = 'https://www.limepay.com.au/img/card-icons-list.svg';

		// Bool. Can be set to true if you want payment fields to show on the checkout
		// if doing a direct integration, which we are doing in this case
		$this->has_fields = true;

		// Supports the refunds
		$this->supports = array( 'refunds' );

		// This basically defines your settings which are then loaded with init_settings()
		$this->init_form_fields();

		// After init_settings() is called, you can get the settings and load them into variables, e.g:
		// $this->title = $this->get_option( 'title' );
		$this->init_settings();

		// Turn these settings into variables we can use
		foreach ( $this->settings as $setting_key => $value ) {
			$this->$setting_key = $value;
		}

		// Lets check for SSL
		add_action( 'admin_notices', array( $this,	'do_ssl_check' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'payment_scripts' ) );
		// Save settings
		if ( is_admin() ) {
			// Save our administration options. Since we are not going to be doing anything special
			// we have not defined 'process_admin_options' in this class so the method in the parent
			// class will be used instead
			add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
		}
	} // End __construct()

	// Build the administration fields for this specific Gateway
	public function init_form_fields() {
		$this->form_fields = array(
			'enabled' => array(
				'title'		=> __( 'Enable / Disable', 'limepay' ),
				'label'		=> __( 'Enable this payment gateway', 'limepay' ),
				'type'		=> 'checkbox',
				'default'	=> 'no',
			),
			'title' => array(
				'title'		=> __( 'Title', 'limepay' ),
				'type'		=> 'text',
				'desc_tip'	=> __( 'Payment title the customer will see during the checkout process.', 'limepay' ),
				'default'	=> __( 'Credit card', 'limepay' ),
			),
			'description' => array(
				'title'		=> __( 'Description', 'limepay' ),
				'type'		=> 'textarea',
				'desc_tip'	=> __( 'Payment description the customer will see during the checkout process.', 'limepay' ),
				'default'	=> __( '4 equal payments every 2 weeks.', 'limepay' ),
				'css'		=> 'max-width:350px;'
			),
			'publishable_key' => array(
				'title'		=> __( 'Publishable Key', 'limepay' ),
				'type'		=> 'text',
				'desc_tip'	=> __( 'This key is provided to you by Limepay.', 'limepay' ),
			),
			'secret_key' => array(
				'title'		=> __( 'Secret Key', 'limepay' ),
				'type'		=> 'text',
				'desc_tip'	=> __( 'This key is provided to you by Limepay.', 'limepay' ),
			),
			'hidepaylater'   => array(
				'title'		=> __( 'Hide Split Payment Option', 'limepay' ),
				'type'        => 'select',
				'description' => __( 'Selecting <strong>Yes</strong> will hide the split payment option from the payment form.', 'limepay' ),
				'default'     => '0',
				'desc_tip'    => true,
				'options'     => array(
					'0' => __( 'No', 'limepay' ),
					'1' => __( 'Yes', 'limepay' ),
				),
			),
		);
	}

	function payment_fields() {

		$publishableKey = $this->publishable_key;
		$hidePayLaterOption = $this->hidepaylater ? true : false;
		$current_user = wp_get_current_user();
		$email = $current_user->user_email;
		$total = intval($this->get_order_total() * 100);
		$currency = get_woocommerce_currency();
		$pkExp = explode('_', $publishableKey);
		$env = $pkExp[0];
		$src = ($env === 'live' ? $this->_lpProdHost : $this->_lpDevHost) . '/checkout/v1?';
		$loaderImgUrl = ($env === 'live' ? $this->_lpProdHost : $this->_lpDevHost) . '/checkout/v1.1/assets/loader/loader1.svg';

		$src .= 'email=' . $email;
		$src .= '&amount=' . $total;
		$src .= '&currency=' . $currency;
		$src .= '&publicKey=' . $publishableKey;
		$src .= '&paymentType=paycard';
		if ($hidePayLaterOption) {
			$src .= '&hidePayLaterOption=' . $hidePayLaterOption;
		}
		$src .= '&platform=woocommerce';

		echo '<div style="background: #fff url(\'' . $loaderImgUrl . '\')  no-repeat center"><iframe id="limepay-checkout-iframe" style="border: none; width: 100%; overflow: hidden;" height="400" src="' . $src . '"></iframe></div>';
		echo '<input id="limepay-payment-token" name="limepay-payment-token" type="hidden" value="0" />';

	}

	// Submit payment and handle response
	public function process_payment( $order_id ) {
		global $woocommerce;
		$payment_token = $_POST['limepay-payment-token'];

		if (!$payment_token)
			throw new Exception( __( 'Transaction incomplete. No payment token found.', 'limepay' ) );

		if (!$this->secret_key)
			throw new Exception( __( 'Limepay secret key is not provided.', 'limepay' ) );

		$customer_order = new WC_Order( $order_id );
		$currency = get_woocommerce_currency();
		$current_user = wp_get_current_user();
		$order_total = intval($this->get_order_total() * 100);
		$limepay_order_id = null;

		$order_items = $customer_order->get_items();
		$lp_items = array();

		foreach( $order_items as $product ) {
            $new_item = array(
				"description" => $product['name'],
				"quantity" => $product['qty'],
				"amount" => intval($product['total'] * 100),
				"currency" => $currency
			);
			array_push($lp_items, $new_item);
        }

		$order_data = array(
			"internalOrderId" => $order_id,
			"amount" => $order_total,
			"currency" => $currency,
			"items" => $lp_items,
			"shipping" => array(
				"address" => array(
					"city" => $customer_order->get_shipping_city(),
					"country" => $customer_order->get_shipping_country(),
					"line1" => $customer_order->get_shipping_address_1(),
					"line2" => $customer_order->get_shipping_address_2(),
					"postalCode" => $customer_order->get_shipping_postcode(),
					"state" => $customer_order->get_shipping_state()
				),
				"name" => $customer_order->get_shipping_first_name() . ' ' . $customer_order->get_shipping_last_name()
			),
			"billing" => array(
				"address" => array(
					"city" => $customer_order->get_billing_city(),
					"country" => $customer_order->get_billing_country(),
					"line1" => $customer_order->get_billing_address_1(),
					"line2" => $customer_order->get_billing_address_2(),
					"postalCode" => $customer_order->get_billing_postcode(),
					"state" => $customer_order->get_billing_state()
				),
				"name" => $customer_order->get_billing_first_name() . ' ' . $customer_order->get_billing_last_name()
			)
		);

		$response = $this->callApi($order_data, 'orders', 'POST');

		if (array_key_exists("id", $response)) {
			$limepay_order_id = $response['id'];
		}
		else {
			$error_message = 'Failed to create order with Limepay';
			if (array_key_exists("message", $response)) {
				$error_message = $response["message"];
			}
			throw new Exception( __( $error_message, 'limepay' ) );
		}

		$payload = array(
			"paymentToken" => $payment_token
		);

		$response = $this->callApi($payload, 'orders/' .$limepay_order_id . '/pay' , 'POST');

        if($response === false)
            throw new Exception( __( 'We are currently experiencing problems trying to connect to this payment gateway. Sorry for the inconvenience.', 'limepay' ) );

		if (array_key_exists("id", $response)) {
			$customer_order->set_transaction_id($response['id']);
			$customer_order->add_order_note( __( 'Limepay payment completed.', 'limepay' ) );
			$customer_order->payment_complete();
			$woocommerce->cart->empty_cart();
			return array(
				'result'   => 'success',
				'redirect' => $this->get_return_url( $customer_order ),
			);

		}
		else {
			$error_message = 'Failed to complete transaction with Limepay';
			if (array_key_exists("message", $response)) {
				$error_message = $response["message"];
			}
			// file_put_contents('php://stderr', print_r($response_data->error, TRUE));
			throw new Exception( __( $error_message, 'limepay' ) );
		}

	}

	public function process_refund( $order_id, $amount = null, $reason = '' ) {
		global $woocommerce;

		$customer_order = new WC_Order( $order_id );

		// if (intval($customer_order->get_total() * 100) !==  intval($amount * 100)) {
		// 	throw new Exception( __( 'Only full refunds are allowed', 'limepay' ) );
		// }

		$transaction_id = $customer_order->get_transaction_id();

		$payload = array(
			"transactionId" => $transaction_id,
			"amount" => intval($amount * 100),
			"currency" => get_woocommerce_currency()
		);

		$response = $this->callApi($payload, 'refunds', 'POST');

		if($response === false)
			throw new Exception( __( 'We are currently experiencing problems trying to connect to this payment gateway. Sorry for the inconvenience.', 'limepay' ) );

		if (array_key_exists("refundId", $response)) {
			return true;
		} else {
			throw new Exception( __(  $response_data->error->message, 'limepay' ) );
		}
	}

	// Validate fields
	public function validate_fields() {
		return true;
	}

	// Check if we are forcing SSL on checkout pages
	// Custom function not required by the Gateway
	public function do_ssl_check() {
		if( $this->enabled == "yes" ) {
			if( get_option( 'woocommerce_force_ssl_checkout' ) == "no" ) {
				echo "<div class=\"error\"><p>". sprintf( __( "<strong>%s</strong> is enabled and WooCommerce is not forcing the SSL certificate on your checkout page. Please ensure that you have a valid SSL certificate and that you are <a href=\"%s\">forcing the checkout pages to be secured.</a>" ), $this->method_title, admin_url( 'admin.php?page=wc-settings&tab=checkout' ) ) ."</p></div>";
			}
		}
	}

	public function payment_scripts() {
		wp_enqueue_script( 'limepay_js', '/wp-content/plugins/limepay-woocommerce-gateway/limepay-v1_1.js' );
		wp_register_script( 'woocommerce_limepay', plugins_url( 'limepay.js', __FILE__ ), array( 'jquery', 'limepay_js' ) );
		wp_enqueue_script( 'woocommerce_limepay' );
	}


    private function callApi($params, $resource, $method){

        $dataString = json_encode($params);

		$skExp = explode('_', $this->secret_key);
        $env = $skExp[0];
        $url = ($env === 'live' ? $this->_lpProdHost : $this->_lpDevHost) . '/api/v1/';
        $url .= $resource;

		// error_log($url);
        //open connection
        $ch = curl_init($url);
        //set the url, number of POST vars, POST data

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        curl_setopt($ch, CURLOPT_USERPWD, $this->secret_key . ":");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION ,1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120); // Timeout on connect (2 minutes)
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($dataString))
        );

        $result = curl_exec($ch);

        if (curl_error($ch)) {
            $errorMsg = curl_error($ch);
            curl_close($ch);
            return array('status'=> 0, 'error' => $errorMsg);
        }
		error_log($result);
        $resp = json_decode($result, true);
        curl_close($ch);

        return $resp;
    }

} // End of Limepay
