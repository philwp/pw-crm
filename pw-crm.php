<?php
/*
  Plugin Name: Super Simple CRM
  Description: A simple CRM contact form.   Use shortcode [pw_form] to display the form on the front-end.
  Version: 0.0.1
  License: GPL V2
  Text Domain: pw-crm
  Domain Path: /languages
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PW_CRM_PATH', dirname( __FILE__ ) );
define( 'PW_CRM_URL', plugin_dir_url( __FILE__ ) );
define( 'PW_CRM_VER', '0.0.1' );

/**
 * Hook to setup plugin
 */
add_action( 'plugins_loaded', 'pw_crm_bootstrap', 25 );

/**
 * Load plugin or throw notice
 *
 * @uses plugins_loaded
 */
function pw_crm_bootstrap() {
	$php_check = version_compare( PHP_VERSION, '5.4.0', '>=' );

	if ( ! $php_check ) {
		function pw_crm_notice() {
			global $pagenow;
			if( 'plugins.php' !== $pagenow ) {
				return;
			}
			?>
			<div class="notice notice-error">
				<p><?php _e( 'PW Elegant CRM requires PHP 5.4 or later. Please update your PHP.', 'pw-crm' ); ?></p>
			</div>
			<?php
		}
		add_action( 'admin_notices', 'pw_crm_notice' );

	} else {
		//bootstrap plugin
		require_once( dirname( __FILE__ ) . '/bootstrap.php' );

	}

}
