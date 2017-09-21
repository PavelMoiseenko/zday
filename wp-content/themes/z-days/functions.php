<?php
define( 'TEMPLATE_DIRECTORY', get_template_directory() );
define( 'TEMPLATE_DIRECTORY_URI', get_template_directory_uri() );
define( 'STYLESHEET_URI', get_stylesheet_uri() );
define( 'VERSION', '1.5' );
date_default_timezone_set( 'Etc/GMT-3' );

if ( ! function_exists( 'base_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function base_setup() {

		load_theme_textdomain( 'zdays', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );

	}

	add_action( 'after_setup_theme', 'base_setup' );
}

/** Using SVGs */
function svg_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}

add_filter( 'upload_mimes', 'svg_mime_types' );

/**
 * Enqueue scripts and styles.
 */
if ( ! function_exists( 'base_scripts' ) ) {
	function base_scripts() {

		wp_register_style( 'main-stylesheet', STYLESHEET_URI );
		wp_register_style( 'all', TEMPLATE_DIRECTORY_URI . '/assets/css/all.css', false, VERSION );

		// Enqueue Styles
		wp_enqueue_style( 'main-stylesheet' );
		wp_enqueue_style( 'all' );

		// Register Scripts

		wp_register_script( 'jquery-last', TEMPLATE_DIRECTORY_URI . '/assets/js/jQuery.min.js', false, false, true );
		wp_register_script( 'scripts', TEMPLATE_DIRECTORY_URI . '/assets/js/scripts.js', array( 'jquery-last' ), VERSION, true );

		wp_register_script( 'popup', TEMPLATE_DIRECTORY_URI . '/assets/js/popup.js', array( 'jquery-last' ), VERSION, true );
		wp_register_script( 'share', TEMPLATE_DIRECTORY_URI . '/assets/js/share.js', array( 'jquery-last' ), VERSION, true );

		//wp_deregister_script('jquery');
		// Enqueue Scripts
		if ( ! is_404() ) {
			wp_enqueue_script( 'jquery-last' );
			wp_enqueue_script( 'scripts' );
			wp_enqueue_script( 'popup' );
			wp_enqueue_script( 'share' );
			//Localizate Scripts
			wp_localize_script( 'scripts', 'objectName', array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'ajax-nonce' ),
			) );
		}
	}

	add_action( 'wp_enqueue_scripts', 'base_scripts' );
}


/* ACF functions */
//theme options tab in appearance
if ( function_exists( 'acf_add_options_sub_page' ) ) {
	acf_add_options_sub_page(
		array(
			'page_title' => __( 'Настройки темы', 'zdays' ),
			'menu_title' => __( 'Настройки темы', 'zdays' ),
			'menu_slug'  => 'acf-options-theme-settings',
			'parent'     => 'themes.php'
		)
	);


}

//acf theme functions placeholders
if ( ! class_exists( 'acf' ) && ! is_admin() ) {
	function get_field_reference( $field_name, $post_id ) {
		return '';
	}

	function get_field_objects( $post_id = false, $options = array() ) {
		return false;
	}

	function get_fields( $post_id = false ) {
		return false;
	}

	function get_field( $field_key, $post_id = false, $format_value = true ) {
		return false;
	}

	function get_field_object( $field_key, $post_id = false, $options = array() ) {
		return false;
	}

	function the_field( $field_name, $post_id = false ) {
	}

	function have_rows( $field_name, $post_id = false ) {
		return false;
	}

	function the_row() {
	}

	function reset_rows( $hard_reset = false ) {
	}

	function has_sub_field( $field_name, $post_id = false ) {
		return false;
	}

	function get_sub_field( $field_name ) {
		return false;
	}

	function the_sub_field( $field_name ) {
	}

	function get_sub_field_object( $child_name ) {
		return false;
	}

	function acf_get_child_field_from_parent_field( $child_name, $parent ) {
		return false;
	}

	function register_field_group( $array ) {
	}

	function get_row_layout() {
		return false;
	}

	function acf_form_head() {
	}

	function acf_form( $options = array() ) {
	}

	function update_field( $field_key, $value, $post_id = false ) {
		return false;
	}

	function delete_field( $field_name, $post_id ) {
	}

	function create_field( $field ) {
	}

	function reset_the_repeater_field() {
	}

	function the_repeater_field( $field_name, $post_id = false ) {
		return false;
	}

	function the_flexible_field( $field_name, $post_id = false ) {
		return false;
	}

	function acf_filter_post_id( $post_id ) {
		return $post_id;
	}
}

/**
 * Add image size for popup slider images
 */

add_image_size( 'popup-slide-size', 750, 600, true );
add_image_size( 'popup-thumb-size', 230, 200, true );

/**
 * Register custom post-type EVENT
 */
function create_event_type() {
	register_post_type( 'event', array(
			'labels'        => array(
				'name'               => esc_html__( 'События', 'zdays' ),
				'singular_name'      => esc_html__( 'Событие', 'zdays' ),
				'add_new'            => esc_html__( 'Добавить новое', 'zdays' ),
				'add_new_item'       => esc_html__( 'Добавить Событие', 'zdays' ),
				'edit'               => esc_html__( 'Редактировать', 'zdays' ),
				'edit_item'          => esc_html__( 'Редактировать Событие', 'zdays' ),
				'new_item'           => esc_html__( 'Новое Событие', 'zdays' ),
				'view'               => esc_html__( 'Просмотреть', 'zdays' ),
				'view_item'          => esc_html__( 'Просмотреть Событие', 'zdays' ),
				'search_items'       => esc_html__( 'Найти Событие', 'zdays' ),
				'not_found'          => esc_html__( 'Событий не найдено', 'zdays' ),
				'not_found_in_trash' => esc_html__( 'Событий в корзине не найдено', 'zdays' )
			),
			'public'        => true,
			'has_archive'   => true,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'can_export'    => true,
			'menu_icon'     => 'dashicons-calendar-alt',
			'menu_position' => 5
		)
	);
}

add_action( 'init', 'create_event_type' );


/**
 * Register custom post-type SPEAKER
 */
function create_speaker_type() {
	register_post_type( 'speaker', array(
			'labels'        => array(
				'name'               => esc_html__( 'Спикеры', 'zdays' ),
				'singular_name'      => esc_html__( 'Спикер', 'zdays' ),
				'add_new'            => esc_html__( 'Добавить нового', 'zdays' ),
				'add_new_item'       => esc_html__( 'Добавить Спикера', 'zdays' ),
				'edit'               => esc_html__( 'Редактировать', 'zdays' ),
				'edit_item'          => esc_html__( 'Редактировать Спикера', 'zdays' ),
				'new_item'           => esc_html__( 'Новый Спикер', 'zdays' ),
				'view'               => esc_html__( 'Просмотреть', 'zdays' ),
				'view_item'          => esc_html__( 'Просмотреть Спикера', 'zdays' ),
				'search_items'       => esc_html__( 'Найти Спикера', 'zdays' ),
				'not_found'          => esc_html__( 'Спикеры не найдены', 'zdays' ),
				'not_found_in_trash' => esc_html__( 'Не найдены спикеры в корзине', 'zdays' )
			),
			'public'        => true,
			'has_archive'   => true,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'can_export'    => true,
			'menu_icon'     => 'dashicons-businessman',
			'menu_position' => 6
		)
	);
}

add_action( 'init', 'create_speaker_type' );

/**
 * Function to test input data from form
 */
function test_input( $data ) {
	$data = trim( $data );
	$data = stripslashes( $data );
	$data = htmlspecialchars( $data );

	return $data;
}

/**
 * AJAX Registration
 */

add_action( 'wp_ajax_ajaxregister', 'registration_callback' );
add_action( 'wp_ajax_nopriv_ajaxregister', 'registration_callback' );

function registration_callback() {
	check_ajax_referer( 'ajax-nonce', 'nonce' );

	$nameErr           = '';
	$surnameErr        = '';
	$emailErr          = '';
	$specializationErr = '';
	$telephoneErr      = '';
	$message           = '';
	$telephone         = '';

	//$regexPattern = '/^[a-zA-Z ]*$/';
	//$regexPattern = '/^([а-яА-ЯЁёa-zA-Z0-9_ ]+)$/u';
	$regexPattern = '//u';
	if ( empty( $_POST['name'] ) ) {
		$nameErr = "Необходимо имя";
	} else {
		$name = test_input( $_POST['name'] );
		if ( ! preg_match( $regexPattern, $name ) /*|| strlen( $name ) > 30 */ ) {
			$nameErr = "Только буквы и пробел";
		}
	}

	if ( empty( $_POST['surname'] ) ) {
		$surnameErr = "Необходима фамилия";
	} else {
		$surname = test_input( $_POST['surname'] );
		if ( ! preg_match( $regexPattern, $surname ) /*|| strlen( $surname ) > 30*/ ) {
			$surnameErr = "Только буквы и пробел";
		}
	}


	if ( empty( $_POST['email'] ) ) {
		$emailErr = "Необходим email";
	} else {
		$email = test_input( $_POST['email'] );
		if ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
			$emailErr = "<p>Неверный формат email,<br> обновите страницу и попробуйте снова</p>";
		}
	}

	if ( empty( $_POST['specialization'] ) ) {
		$specializationErr = "Необходима специализация";
	} else {
		$specialization = test_input( $_POST['specialization'] );
		if ( ! preg_match( $regexPattern, $specialization ) /*|| strlen( $specialization ) > 30 */ ) {
			$specializationErr = "Только буквы и пробел";
		}
	}

	$telephone = test_input( $_POST['telephone'] );
	if ( ! empty( $telephone ) ) {
		if ( ! preg_match( "/^[\d -]+$/", $telephone )/* || strlen( $telephone ) > 20*/ ) {
			$telephoneErr = "Неверный формат</p>";
		}
	}

	if ( $nameErr || $surnameErr || $emailErr || $specializationErr || $telephoneErr ) {
		$response = array(
			'nameErr'           => $nameErr,
			'surnameErr'        => $surnameErr,
			'emailErr'          => $emailErr,
			'specializationErr' => $specializationErr,
			'telephoneErr'      => $telephoneErr,
			'message'           => $message
		);
		wp_send_json( $response );
	}

	$event_id = $_POST['event_id'];
	$flag     = false;

	while ( have_rows( 'participants', $event_id ) ) : the_row();

		$registered_email = get_sub_field( 'participant_email' );
		if ( $email == $registered_email ) :
			$flag     = true;
			$response = array(
				"messageErr" => "Извините, участник с таким email уже зарегистрирован."
			);
			break;
		endif;
	endwhile;

	if ( ! $flag ) :
		$participant_row = array(
			'participant_name'           => $name,
			'participant_surname'        => $surname,
			'participant_email'          => $email,
			'participant_specialization' => $specialization,
			'participant_telephone'      => $telephone
		);
		add_row( 'participants', $participant_row, $event_id );
		$event_plan    = get_field( "event_plan", $event_id );
		$event_object  = get_post( $event_id );
		$event_title   = $event_object->post_title;
		$event_content = $event_object->post_content;
		$address       = get_field( "address", $event_id );

		$date       = get_field( 'start_date', $event_id, false );
		$date       = new DateTime( $date );
		$event_date = $date->format( 'j.m' );
		$event_time = $date->format( 'G:i' );
		$event_plan = get_field( "event_plan", $event_id );
		$filedir    = get_attached_file( $event_plan['ID'] );


		$subject = "Регистрация прошла успешно";

		$path_to_emailregistr = TEMPLATE_DIRECTORY_URI . "/emailregistr.php";
		$message              = file_get_contents( $path_to_emailregistr );

		$shortcodes = array(
			'[title]'      => $event_title,
			'[content]'    => $event_content,
			'[start_date]' => $event_date,
			'[start_time]' => $event_time,
			'[image_path]' => TEMPLATE_DIRECTORY_URI . "/assets/images/"
		);
		foreach ( $shortcodes as $key => $value ) {
			$message = str_replace( $key, $value, $message );
		}

		$headers     = array(
			'content-type: text/html'
		);
		$attachments = $filedir;

		wp_mail( $email, $subject, $message, $headers, $attachments );
		$successMessage             = '';
		$registration_success_title = get_field( 'registration_success_title', get_option( 'page_on_front' ) );
		if ( $registration_success_title ) {
			$successMessage .= '<h2>' . $registration_success_title . '</h2>';
		}
		$registration_success_description = get_field( 'registration_success_description', get_option( 'page_on_front' ) );
		if ( $registration_success_title ) {
			$successMessage .= '<p>' . $registration_success_description . '</p>';
		}
		$event_plan = get_field( "event_plan", $event_id );
		if ( $event_plan['url'] ) {
			$successMessage .= '<div class="btn-holder">
				<a class="button" target="_blank" href="' . $event_plan['url'] . '">'
			                   . __( "Скачать план мероприятия", "zdays" ) .
			                   '</a></div>';
		}
		$response = array(
			'nameErr'           => $nameErr,
			'surnameErr'        => $surnameErr,
			'emailErr'          => $emailErr,
			'specializationErr' => $specializationErr,
			'telephoneErr'      => $telephoneErr,
			"message"           => $successMessage
		);

	endif;

	wp_send_json( $response );
}

/**
 * Handler AJAX for popup
 */
add_action( 'wp_ajax_popup', 'popup_callback' );
add_action( 'wp_ajax_nopriv_popup', 'popup_callback' );

function popup_callback() {
	check_ajax_referer( 'ajax-nonce', 'nonce' );

	$event_id = '';

	if ( ! empty( $_POST['event_id'] ) ) {
		$event_id = $_POST['event_id'];
	}

	$event_object    = get_post( $event_id );
	$event_title     = $event_object->post_title;
	$event_content   = $event_object->post_content;
	$event_image_url = get_the_post_thumbnail_url( $event_id );

	$images_gallery = get_field( 'event_gallery', $event_id );
	$images_slide   = [];
	$images_thumb   = [];

	if ( $images_gallery ) :
		foreach ( $images_gallery as $item ) :
			array_push( $images_slide, $item['sizes']['popup-slide-size'] );
			array_push( $images_thumb, $item['sizes']['popup-thumb-size'] );
		endforeach;
	else:
		array_push( $images_slide, get_the_post_thumbnail_url( $event_id, 'popup-slide-size' ) );
		array_push( $images_thumb, get_the_post_thumbnail_url( $event_id, 'popup-thumb-size' ) );
	endif;
	//var_dump($event_gallery);


	$speakers                = get_field( 'speaker', $event_id );
	$event_speakers_title    = [];
	$event_speakers_position = [];
	if ( $speakers ) :
		foreach ( $speakers as $speaker ):
			$speaker_ID       = $speaker->ID;
			$speaker_position = get_field( 'speaker_position', $speaker_ID );
			$speaker_title    = $speaker->post_title;
			array_push( $event_speakers_title, $speaker_title );
			array_push( $event_speakers_position, $speaker_position );
		endforeach;
	endif;


	$response = array(
		'event_title'             => $event_title,
		'event_content'           => $event_content,
		'event_image_url'         => $event_image_url,
		'event_speakers_title'    => $event_speakers_title,
		'event_speakers_position' => $event_speakers_position,
		'images_slide'            => $images_slide,
		'images_thumb'            => $images_thumb
	);

	wp_send_json( $response );

}


/**
 * Redirect to front-page
 */

add_action( 'template_redirect', 'all_redirect_to_home' );

function all_redirect_to_home() {
	if ( ! is_404() && ! is_front_page() ) {
		wp_redirect( home_url(), 301 );
		exit;
	}
}


/**
 * Function to change sender name*/

function wpb_sender_name( $original_email_from ) {
	return 'Zfort';
}

/**
 * Hooking up our functions to WordPress filters*/

add_filter( 'wp_mail_from_name', 'wpb_sender_name' );