<?php
if ( !function_exists( 'send_email_template' ) ) {
	function send_email_template( $type, $email, $data ) {
		$template = get_email_template($type);
		if ( !empty( $email ) && !empty( $template ) ) {
			if ( file_exists( $template['content'] ) ) {
				$message = get_email_message($data, file_get_contents( $template['content'] ) );
				return wp_mail( $email, $template['subject'], $message );
			}
		}
		return false;
	}
}

function get_shortcodes_list(){
	return array(
		'activation_link',
		'site_link',
		'user_email',
		'pdf_link'
	);
}

function get_email_message($data, $message = ''){
	foreach ($data as $key => $value){
		if(in_array($key, get_shortcodes_list())){
			$message = str_replace('['.$key.']', $value, $message);
		}
	}
	$message  = str_replace('[image_path]', get_image_path(), $message);
	return $message;
}

function get_email_template($type){
	$templates = get_emails_templates();
	if(isset( $templates[ $type ] )){
		return $templates[ $type ];
	}
	return false;
}

function get_emails_templates(){
	return array(
		'confirm_account'    => array(
			'subject' => 'Confirm your Account',
			'content' => EMAIL_PLUGIN_DIR . 'email-templates/confirm-account.html'
		),
		'welcome'   => array(
			'subject' => 'Welcome to Arthritis Australia',
			'content' => EMAIL_PLUGIN_DIR . 'email-templates/welcome.html'
		),
		'reset_pass' => array(
			'subject' => 'Your password was changed',
			'content' => EMAIL_PLUGIN_DIR . 'email-templates/.html'
		),
		'profile'    => array(
			'subject' => 'Your profile updated',
			'content' => EMAIL_PLUGIN_DIR . 'email-templates/.html'
		),
		'register'    => array(
			'subject' => 'Thank you for registering for myeSupport',
			'content' => EMAIL_PLUGIN_DIR . 'email-templates/.html'
		),
		'list'    => array(
			'subject' => 'Autoresponder',
			'content' => EMAIL_PLUGIN_DIR . 'email-templates/.html'
		),
	);
}

function get_image_path(){
	return get_site_url().'/wp-content/plugins/wp-emails/email-templates/images/';
}