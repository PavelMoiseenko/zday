<?php
/*
Plugin Name: Emails Templates
Description: Change default registration emails notifications.
Version: 1.0
*/

define(  'EMAIL_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define('EMAIL_PLUGIN_URL', plugins_url( 'wp-emails' ) );

include EMAIL_PLUGIN_DIR . '/inc/send-email.php';

add_filter( 'wp_mail_from_name', 'vortal_wp_mail_from_name' );
function vortal_wp_mail_from_name( $email_from ) {
	return 'MyeSupport';
}

add_filter( 'wp_mail_content_type', 'set_html_content_type' );
function set_html_content_type() {
	return 'text/html';
}