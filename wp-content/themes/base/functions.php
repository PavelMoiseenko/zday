<?php

/*
 * Added google-api-php-client library */
require_once(get_template_directory() . '/lib/google-api-php-client-2.2.0/vendor/autoload.php');


//define('STDIN',fopen("php://stdin","r"));

define('APPLICATION_NAME', 'Google Sheets API PHP Quickstart');
define('CREDENTIALS_PATH', '~/.credentials/sheets.googleapis.com-php-quickstart.json');
define('CLIENT_SECRET_PATH', __DIR__ . '/client_secret.json');
// If modifying these scopes, delete your previously saved credentials
// at ~/.credentials/sheets.googleapis.com-php-quickstart.json
define('SCOPES', implode(' ', array(
        Google_Service_Sheets::SPREADSHEETS_READONLY)
));

//if (php_sapi_name() != 'cli') {
//    throw new Exception('This application must be run on the command line.');
//}

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName(APPLICATION_NAME);
    $client->setScopes(SCOPES);
    $client->setAuthConfig(CLIENT_SECRET_PATH);
    $client->setAccessType('offline');

    // Load previously authorized credentials from a file.
    $credentialsPath = expandHomeDirectory(CREDENTIALS_PATH);
    if (file_exists($credentialsPath)) {
        $accessToken = json_decode(file_get_contents($credentialsPath), true);
    } else {
        // Request authorization from the user.
        $authUrl = $client->createAuthUrl();
        printf("Open the following link in your browser:\n%s\n", $authUrl);
        print 'Enter verification code: ';
        $authCode = trim(fgets(STDIN))/*'4/02yp9Msj0Sjt3et2pjphXcuribOhjZRDucrgvrIMab4'*/;

        // Exchange authorization code for an access token.
        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);

        // Store the credentials to disk.
        if (!file_exists(dirname($credentialsPath))) {
            mkdir(dirname($credentialsPath), 0700, true);
        }
        file_put_contents($credentialsPath, json_encode($accessToken));
        printf("Credentials saved to %s\n", $credentialsPath);
    }
    $client->setAccessToken($accessToken);

    // Refresh the token if it's expired.
    if ($client->isAccessTokenExpired()) {
        $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
    }
    return $client;
}

/**
 * Expands the home directory alias '~' to the full path.
 * @param string $path the path to expand.
 * @return string the expanded path.
 */
function expandHomeDirectory($path)
{
    $homeDirectory = getenv('HOME');
    if (empty($homeDirectory)) {
        $homeDirectory = getenv('HOMEDRIVE') . getenv('HOMEPATH');
    }
    return str_replace('~', realpath($homeDirectory), $path);
}






require_once(get_template_directory() . '/classes/CustomWalkerNavMenu.php');

define('TEMPLATE_DIRECTORY', get_template_directory());
define('TEMPLATE_DIRECTORY_URI', get_template_directory_uri());
define('STYLESHEET_URI', get_stylesheet_uri());

if (!function_exists('base_setup')) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    function base_setup()
    {

        load_theme_textdomain('base', get_template_directory() . '/languages');

        add_theme_support('automatic-feed-links');

        add_theme_support('title-tag');

        add_theme_support('post-thumbnails');
        /*
         * Images function
        set_post_thumbnail_size( 825, 510, true );
        add_image_size( 'default-items', 350, 350, true );
        */

        register_nav_menus(array(
            'primary' => __('Primary Menu', 'base'),
            'social' => __('Social Links Menu', 'base'),
        ));

        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ));

        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support('post-formats', array(
            'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
        ));

    }

    add_action('after_setup_theme', 'base_setup');
}

//Using SVGs
function svg_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'svg_mime_types');

//shortcodes activate
if (!function_exists('base_shortcodes_init')) {
    function base_shortcodes_init()
    {
        if (is_admin()) {
            include_once(TEMPLATE_DIRECTORY . '/inc/shortcodes/admin/tinymce-shortcodes.php');
        } else {
            include_once(TEMPLATE_DIRECTORY . '/inc/shortcodes/_init.php');
        }
        do_action('theme_shortcodes_init');
    }

    add_action('init', 'base_shortcodes_init', 0);
}

/**
 * Register widget area.
 */
function base_widgets_init()
{
    register_sidebar(array(
        'name' => __('Widget Area', 'base'),
        'id' => 'sidebar-default',
        'description' => __('Add widgets here to appear in your sidebar.', 'base'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'base_widgets_init');

/**
 * Enqueue scripts and styles.
 */
if (!function_exists('base_scripts')) {
    function base_scripts()
    {
        /* remove
        for removing scripts use this construction
         * 
            wp_deregister_style( 'some' );
            wp_dequeue_style( 'some' ); 
         */

        // Register Styles
        wp_register_style('main-stylesheet', STYLESHEET_URI);
        wp_register_style('all', TEMPLATE_DIRECTORY_URI . '/assets/css/all.css');

        if (is_child_theme()) {
            wp_register_style('child-stylesheet', STYLESHEET_URI . '/style.css');
        }


        // Enqueue Styles
        wp_enqueue_style('main-stylesheet');
        wp_enqueue_style('all');

        // Register Scripts

        wp_register_script('main', TEMPLATE_DIRECTORY_URI . '/assets/js/main.js', array('jquery'), false, true);

        // Enqueue Scripts
        wp_enqueue_script('jquery');
        wp_enqueue_script('main');
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        };

        //Localizate Scripts
        wp_localize_script('main', 'objectName', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ajax-nonce'),
            'someTextForTranslate' => '<span class="screen-reader-text">' . __('localization text', 'base') . '</span>',
        ));
    }

    add_action('wp_enqueue_scripts', 'base_scripts');
}

// Customithation Search form for comments form use same function
function base_search_form_modify($html)
{
    return str_replace('class="search-submit"', 'class="search-submit screen-reader-text"', $html);
}

add_filter('get_search_form', 'base_search_form_modify');

/*Register tag [template-url]*/
function filter_template_url($text)
{
    return str_replace('[template-url]', get_bloginfo('template_url'), $text);
}

add_filter('the_content', 'filter_template_url');
add_filter('get_the_content', 'filter_template_url');
add_filter('widget_text', 'filter_template_url');

/* Ajax handler
 * in js file, ajax call parametrs:
 *   action: loadmore (becouse name wp_ajax_[..loadmore..])
 *   url: ajaxurl)
 */
function right_ajax_call()
{
    exit;
}

add_action('wp_ajax_loadmore', 'right_ajax_call');
add_action('wp_ajax_nopriv_loadmore', 'right_ajax_call');

/* ACF functions */
//theme options tab in appearance
if (function_exists('acf_add_options_sub_page')) {
    acf_add_options_sub_page(array(
        'title' => 'Theme Options',
        'parent' => 'themes.php',
    ));
}

//acf theme functions placeholders
if (!class_exists('acf') && !is_admin()) {
    function get_field_reference($field_name, $post_id)
    {
        return '';
    }

    function get_field_objects($post_id = false, $options = array())
    {
        return false;
    }

    function get_fields($post_id = false)
    {
        return false;
    }

    function get_field($field_key, $post_id = false, $format_value = true)
    {
        return false;
    }

    function get_field_object($field_key, $post_id = false, $options = array())
    {
        return false;
    }

    function the_field($field_name, $post_id = false)
    {
    }

    function have_rows($field_name, $post_id = false)
    {
        return false;
    }

    function the_row()
    {
    }

    function reset_rows($hard_reset = false)
    {
    }

    function has_sub_field($field_name, $post_id = false)
    {
        return false;
    }

    function get_sub_field($field_name)
    {
        return false;
    }

    function the_sub_field($field_name)
    {
    }

    function get_sub_field_object($child_name)
    {
        return false;
    }

    function acf_get_child_field_from_parent_field($child_name, $parent)
    {
        return false;
    }

    function register_field_group($array)
    {
    }

    function get_row_layout()
    {
        return false;
    }

    function acf_form_head()
    {
    }

    function acf_form($options = array())
    {
    }

    function update_field($field_key, $value, $post_id = false)
    {
        return false;
    }

    function delete_field($field_name, $post_id)
    {
    }

    function create_field($field)
    {
    }

    function reset_the_repeater_field()
    {
    }

    function the_repeater_field($field_name, $post_id = false)
    {
        return false;
    }

    function the_flexible_field($field_name, $post_id = false)
    {
        return false;
    }

    function acf_filter_post_id($post_id)
    {
        return $post_id;
    }
}

/**
 * Register custom post-type EVENT
 */
function create_event_type()
{
    register_post_type('event', array(
            'labels' => array(
                'name' => esc_html__('Events', 'base'),
                'singular_name' => esc_html__('Event', 'base'),
                'add_new' => esc_html__('Add New Event', 'base'),
                'add_new_item' => esc_html__('Add Event', 'base'),
                'edit' => esc_html__('Edit', 'base'),
                'edit_item' => esc_html__('Edit Event', 'base'),
                'new_item' => esc_html__('New Event', 'base'),
                'view' => esc_html__('View', 'base'),
                'view_item' => esc_html__('View Event', 'base'),
                'search_items' => esc_html__('Search Event', 'base'),
                'not_found' => esc_html__('No Events found', 'base'),
                'not_found_in_trash' => esc_html__('No Events found in Trash', 'base')
            ),
            'public' => true,
            'has_archive' => true,
            //'rewrite' => array('slug' => 'events'),
            'supports' => array('title', 'editor', 'thumbnail', 'comments', 'excerpt'),
            'can_export' => true,
            'menu_icon' => 'dashicons-calendar-alt',
            'menu_position' => 5
        )
    );
}

add_action('init', 'create_event_type');


/**
 * Register custom post-type SPEAKER
 */
function create_speaker_type()
{
    register_post_type('speaker', array(
            'labels' => array(
                'name' => esc_html__('Speakers', 'base'),
                'singular_name' => esc_html__('Speaker', 'base'),
                'add_new' => esc_html__('Add New Speaker', 'base'),
                'add_new_item' => esc_html__('Add Speaker', 'base'),
                'edit' => esc_html__('Edit', 'base'),
                'edit_item' => esc_html__('Edit Speaker', 'base'),
                'new_item' => esc_html__('New Speaker', 'base'),
                'view' => esc_html__('View', 'base'),
                'view_item' => esc_html__('View Speaker', 'base'),
                'search_items' => esc_html__('Search Speaker', 'base'),
                'not_found' => esc_html__('No Speakers found', 'base'),
                'not_found_in_trash' => esc_html__('No Speakers found in Trash', 'base')
            ),
            'public' => true,
            'has_archive' => true,
            //'rewrite' => array('slug' => 'speakers'),
            'supports' => array('title', 'editor', 'thumbnail', 'comments', 'excerpt'),
            'can_export' => true,
            'menu_icon' => 'dashicons-businessman',
            'menu_position' => 6
        )
    );
}

add_action('init', 'create_speaker_type');

/**
 * AJAX Registration*/

add_action('wp_ajax_ajaxregister', 'my_action_callback');
add_action('wp_ajax_nopriv_ajaxregister', 'my_action_callback');

function my_action_callback()
{
    check_ajax_referer('ajax-nonce', 'nonce');
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $event_id = $_POST['event_id'];

    if (have_rows('participants', $event_id)):
        while (have_rows('participants', $event_id)) : the_row();
            $flag = false;
            $registered_email = get_sub_field('participant_email');
            $response = $registered_email;
            if ($email == $registered_email) :
                $flag = true;
                $response = array(
                    "message" => "Participant with email " . $email . " has been registered already."
                );
                break;
            endif;
        endwhile;

        if (!$flag) :
            $participant_row = array(
                'participant_name' => $name,
                'participant_surname' => $surname,
                'participant_email' => $email
            );
            add_row('participants', $participant_row, $event_id);
            $event_plan = get_field("event_plan", $event_id);
            wp_mail($email, "Event plan", "We have sent you event plan " . $event_plan['url']);
            $response = array(
                "message" => $name . " " . $surname . " " . " ,you are succesfully registered.",
                "email" => $email
            );

        endif;
    endif;


    wp_send_json($response);
}
