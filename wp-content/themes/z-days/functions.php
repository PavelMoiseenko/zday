<?php
define( 'TEMPLATE_DIRECTORY', get_template_directory() );
define( 'TEMPLATE_DIRECTORY_URI', get_template_directory_uri() );
define( 'STYLESHEET_URI', get_stylesheet_uri() );

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
		wp_register_style( 'all', TEMPLATE_DIRECTORY_URI . '/assets/css/all.css' );

		// Enqueue Styles
		wp_enqueue_style( 'main-stylesheet' );
		wp_enqueue_style( 'all' );

		// Register Scripts
		wp_register_script( 'scripts', TEMPLATE_DIRECTORY_URI . '/assets/js/scripts.js', array( 'jquery' ), false, true );
		wp_register_script( 'main', TEMPLATE_DIRECTORY_URI . '/assets/js/main.js', array( 'jquery' ), false, true );

		// Enqueue Scripts
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'scripts' );
		wp_enqueue_script( 'main' );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		};

		//Localizate Scripts
		wp_localize_script( 'main', 'objectName', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'ajax-nonce' ),
		) );
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
	$regexPattern = '/^([а-яА-ЯЁёa-zA-Z0-9_ ]+)$/u';
	if ( empty( $_POST['name'] ) ) {
		$nameErr = "Необходимо имя";
	} else {
		$name = test_input( $_POST['name'] );
		if ( ! preg_match( $regexPattern, $name ) || strlen( $name ) > 30 ) {
			$nameErr = "Только буквы и пробел";
		}
	}

	if ( empty( $_POST['surname'] ) ) {
		$surnameErr = "Необходима фамилия";
	} else {
		$surname = test_input( $_POST['surname'] );
		if ( ! preg_match( $regexPattern, $surname ) || strlen( $surname ) > 30 ) {
			$surnameErr = "Только буквы и пробел";
		}
	}


	if ( empty( $_POST['email'] ) ) {
		$emailErr = "Необходим email";
	} else {
		$email = test_input( $_POST['email'] );
		if ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) || strlen( $email ) > 20 ) {
			$emailErr = "Неверный формат";
		}
	}

	if ( empty( $_POST['specialization'] ) ) {
		$specializationErr = "Необходима специализация";
	} else {
		$specialization = test_input( $_POST['specialization'] );
		if ( ! preg_match( $regexPattern, $specialization ) || strlen( $specialization ) > 30 ) {
			$specializationErr = "Только буквы и пробел";
		}
	}

	$telephone = test_input( $_POST['telephone'] );
	if ( ! empty( $telephone ) ) {
		if ( ! preg_match( "/^[\d -]+$/", $telephone ) || strlen( $telephone ) > 20 ) {
			$telephoneErr = "Неверный формат";
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
				"messageErr" => "Sorry, participant with this email has been registered already."
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
		$event_plan   = get_field( "event_plan", $event_id );
		$event_object = get_post( $event_id );
		$event_title  = $event_object->post_title;
		$address      = get_field( "address", $event_id );

		$date       = get_field( 'start_date', $event_id, false );
		$date       = new DateTime( $date );
		$event_date = $date->format( 'j.m' );
		$event_time = $date->format( 'G:i' );
		$event_plan = get_field( "event_plan", $event_id );
		$filedir    = get_attached_file( $event_plan['ID'] );


		$subject = "Регистрация прошла успешно";
		$message = "<p>Вы только что зарегистрировались на событие <a href='http://www.zday.zfort.com.ua' target='_blank'>\"ZDay\"</a>. Подтверждаем, что Ваша регистрация прошла успешно.</p>
                    <p>Информация о событии:<br>
                    Название: " . $event_title . "<br>
                    Дата: " . $event_date . "<br>
                    Время: " . $event_time . "<br>
                    Место: " . $address . "<br>
                    План мероприятия можно найти в attachment</p>";

		$headers     = array(
			'content-type: text/html'
		);
		$attachments = $filedir;

		wp_mail( $email, $subject, $message, $headers, $attachments );

		$response = array(
			'nameErr'           => $nameErr,
			'surnameErr'        => $surnameErr,
			'emailErr'          => $emailErr,
			'specializationErr' => $specializationErr,
			'telephoneErr'      => $telephoneErr,
			"message"           => "You are succesfully registered."
		);

	endif;

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
