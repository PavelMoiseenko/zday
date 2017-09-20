<?php
$path = $_SERVER['DOCUMENT_ROOT'];

include_once $path . '/wp-config.php';
include_once $path . '/wp-load.php';
include_once $path . '/wp-includes/wp-db.php';
include_once $path . '/wp-includes/pluggable.php';


$path_to_plugin = plugins_url('wp-emails/index.php');
if (is_plugin_active( $path_to_plugin)){


	// Check function exists
//if ( !function_exists( 'send_email_template' ) ) {
	// Wp query with current date + 1

	// Meta fields user data
	// foreach
	// send_email_template('remainder', 'email', array('user_name'=>'Jon', 'pdf_link' => ''))
	// foreach
//}

}
