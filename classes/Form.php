<?php


namespace pw\crm;

use pw\crm\Start;
use pw\crm\Meta;

class Form {


	public function run() {

		add_shortcode( 'pw_form', [ $this, 'shortcode' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'pw_enqueue_scripts' ], 999 );
		add_action( 'wp_ajax_crm_send', [ $this, 'crm_send' ] );
		add_action( 'wp_ajax_nopriv_crm_send', [ $this, 'crm_send'] );

	}

	public function pw_enqueue_scripts() {

		global $post;
		if ( has_shortcode( $post->post_content, 'pw_form' ) ) {
			wp_enqueue_script( 'pw-crm-script', PW_CRM_URL . 'assets/js/pw-crm.js', [ 'jquery' ], null, true );
    		wp_enqueue_style( 'pw-crm-style', PW_CRM_URL . 'assets/css/pw-crm.css'  );
    		wp_localize_script( 'pw-crm-script', 'pw_crm_ajax',  [
    			'ajax_url' => admin_url( 'admin-ajax.php' ),
    			'nonce' => wp_create_nonce( 'pw-crm-nonce' )
    		 ] );
    	}
	}


	public function shortcode( $atts ) {

		$atts = shortcode_atts(
			[
			'name' 				=> 'Name',
			'phone_number' 		=> 'Phone',
			'email' 			=> 'Email',
			'budget'			=> 'Budget',
			'message' 			=> 'Message',
			'name_max_length' 	=> 30,
			'phone_max_length' 	=> 14,
			'email_max_length' 	=> 40,
			'budget_max_length'	=> 4,
			'message_height' 	=> 6,
			'message_width' 	=> 40,
			], $atts );

		$name = $atts[ 'name' ];
		$phone_number = $atts[ 'phone_number' ];
		$email = $atts[ 'email' ];
		$budget = $atts[ 'budget' ];
		$message = $atts[ 'message' ];
		$name_max_length = $atts[ 'name_max_length' ];
		$phone_max_length = $atts[ 'phone_max_length' ];
		$email_max_length = $atts[ 'email_max_length' ];
		$budget_max = $this->max_length_to_max( $atts[ 'budget_max_length' ] );
		$message_height = $atts[ 'message_height' ];
		$message_width = $atts[ 'message_width' ];

		ob_start();
        include  PW_CRM_PATH . '/assets/templates/submission-form.php';
        $form = ob_get_clean();

        return $form;

	}

    public function crm_send() {
    	check_ajax_referer( 'pw-crm-nonce', 'security' );
    	$name = sanitize_text_field( $_POST[ 'name' ] );
    	$phone = filter_var( $_POST[ 'phone' ], FILTER_SANITIZE_NUMBER_INT );
    	$email = sanitize_email( $_POST[ 'email' ] );
    	$budget = absint( $_POST[ 'budget' ] );
    	$message = sanitize_text_field( $_POST[ 'message' ] );
    	$time = $_POST[ 'time' ];

    	$postarr = [
    		'post_title' => $name,
    		'post_status' => 'publish',
    		'post_type' => Start::POST_TYPE,
    		'meta_input' => [
    			Meta::PHONE => $phone,
    			Meta::EMAIL => $email,
    			Meta::BUDGET => $budget,
    			Meta::TIME => $time,
    			Meta::MESSAGE => $message
    		]
    	];

    	wp_insert_post( $postarr );
    }

    protected function max_length_to_max( $length ) {
    	$max = '';
    	for( $i = 0; $i <= $length; $i++ ){
    		$max .= "9";
    	}

    	return  $max;
    }
}

