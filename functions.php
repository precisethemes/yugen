<?php
/**
 * Yugen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package yugen
 */

/**
 * Yugen only works on PHP v5.4.0 or later.
 */
if ( version_compare( PHP_VERSION, '5.4.0', '<' ) ) {
    require get_template_directory() . '/inc/libraries/back-compat.php';
    return;
}

/**
 * Define constants
 */
$yugen_theme_options  = wp_get_theme();
$yugen_theme_name     = $yugen_theme_options->get( 'Name' );
$yugen_theme_author   = $yugen_theme_options->get( 'Author' );
$yugen_theme_desc     = $yugen_theme_options->get( 'Description' );
$yugen_theme_version  = $yugen_theme_options->get( 'Version' );

define( 'YUGEN_THEME_NAME', $yugen_theme_name );
define( 'YUGEN_THEME_AUTHOR', $yugen_theme_author );
define( 'YUGEN_THEME_DESC', $yugen_theme_desc );
define( 'YUGEN_THEME_VERSION', $yugen_theme_version );
define( 'YUGEN_THEME_URI', get_template_directory_uri() );
define( 'YUGEN_THEME_DIR', get_template_directory() );

if ( ! function_exists( 'yugen_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function yugen_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Yugen, use a find and replace
         * to change 'yugen' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'yugen', YUGEN_THEME_DIR . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        /* Image Ratio - 3:4 */
        add_image_size( 'yugen-768-3x4', 768, 1024, true );
        add_image_size( 'yugen-1200-3x4', 1200, 1600, true );
        add_image_size( 'yugen-1800-3x4', 1800, 2400, true );

        /* Image Ratio - 4:3 */
        add_image_size( 'yugen-768-4x3', 768, 576, true );
        add_image_size( 'yugen-1200-4x3', 1200, 900, true );
        add_image_size( 'yugen-1800-4x3', 1800, 1350, true );

        /* Image Ratio - 16:9 */
        add_image_size( 'yugen-768-16x9', 768, 432, true );
        add_image_size( 'yugen-1200-16x9', 1200, 675, true );
        add_image_size( 'yugen-1800-16x9', 1800, 1012, true );

        /* Image Ratio - 21:9 */
        add_image_size( 'yugen-768-21x9', 768, 330, true );
        add_image_size( 'yugen-1200-21x9', 1200, 515, true );
        add_image_size( 'yugen-1800-21x9', 1800, 772, true );

        /* Image Ratio - Auto Height */
        add_image_size( 'yugen-768-auto-height', 768, '9999', false );
        add_image_size( 'yugen-1200-auto-height', 1200, '9999', false );
        add_image_size( 'yugen-1800-auto-height', 1800, '9999', false );


        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary-menu' => esc_html__( 'Primary', 'yugen' ),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'yugen_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        // Set up the WordPress core custom header image feature.
        add_theme_support( 'custom-header', apply_filters( 'yugen_custom_header_args', array(
            'default-image'          => '',
            'width'                  => 1280,
            'height'                 => 300,
            'flex-height'            => true,
        ) ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ) );
    }
endif;
add_action( 'after_setup_theme', 'yugen_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function yugen_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'yugen_content_width', 640 );
}
add_action( 'after_setup_theme', 'yugen_content_width', 0 );

/**
 * function for google fonts
 */
if ( ! function_exists('yugen_google_fonts_url') ) :

    /**
     * Return fonts URL.
     *
     * @return string Fonts URL.
     */
    function yugen_google_fonts_url(){

        $fonts_url = '';
        $fonts     = array();
        $subsets   = 'latin,latin-ext';

        /* translators: If there are characters in your language that are not supported by Barlow Semi Condensed, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'yugen' ) ) {
            $fonts[] = 'Roboto:400italic,700italic,300,400,500,600,700';
        }

        /* translators: If there are characters in your language that are not supported by Barlow, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== _x( 'on', 'Cormorant Garamond font: on or off', 'yugen' ) ) {
            $fonts[] = 'Cormorant Garamond:400italic,700italic,300,400,500,600,700';
        }

        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => rawurlencode( implode( '|', $fonts ) ),
                'subset' => rawurlencode( $subsets ),
            ), 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;

/**
 * Enqueue scripts and styles.
 */
function yugen_scripts() {

    $min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

    // CSS Lib
    wp_enqueue_style( 'lib-css', YUGEN_THEME_URI .'/assets/front-end/css/lib.css', false, YUGEN_THEME_VERSION, 'all' );

    wp_enqueue_style( 'yugen-style', get_stylesheet_uri() );

    $fonts_url = yugen_google_fonts_url();
    if ( ! empty($fonts_url) ) {
        wp_enqueue_style('yugen-google-fonts', $fonts_url, array(), null);
    }

    // Custom JS
    wp_enqueue_script( 'custom-js', YUGEN_THEME_URI . '/assets/front-end/js/custom' . $min . '.js', array( 'jquery' ), YUGEN_THEME_VERSION, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'yugen_scripts' );

/*--------------------------------------------------------------
# Back-End Enqueue scripts and styles.
--------------------------------------------------------------*/
if ( !function_exists( 'yugen_admin_scripts' ) ) {
    function yugen_admin_scripts() {

        $min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

        // Get Current Screen Name
        $current_screen = get_current_screen();

        // Run some code, only on the customizer and widgets page
        if ( $current_screen->id == "customize" || $current_screen->id == "widgets" ) {

            wp_enqueue_style( 'yugen-customizer-style', YUGEN_THEME_URI .'/assets/back-end/css/customizer-style' . $min . '.css', false, YUGEN_THEME_VERSION, 'all' );

        }
        else {
            // Enqueue Style
            wp_enqueue_style( 'yugen-admin-style', YUGEN_THEME_URI .'/assets/back-end/css/admin-style' . $min . '.css', false, YUGEN_THEME_VERSION, 'all' );

            // Image Uploader
            wp_enqueue_media();

            // Enqueue Script
            wp_enqueue_script( 'yugen-admin-script', YUGEN_THEME_URI . '/assets/back-end/js/admin-script' . $min . '.js', array( 'jquery','jquery-ui-sortable','wp-color-picker' ), YUGEN_THEME_VERSION, true );

        }

    }
}
add_action( 'admin_enqueue_scripts', 'yugen_admin_scripts' );

/**
 * Load template functions.
 */
require YUGEN_THEME_DIR . '/inc/helpers/template-functions.php';

/**
 * Load themes custom hooks.
 */
require YUGEN_THEME_DIR . '/inc/helpers/theme-hooks.php';

/**
 * Load custom functions to return array value.
 */
require YUGEN_THEME_DIR . '/inc/helpers/template-array.php';

/**
 * Load theme meta box
 */
require YUGEN_THEME_DIR . '/inc/framework/meta-boxes/class-meta-box.php';

/**
 * Include theme widgets.
 */
require YUGEN_THEME_DIR . '/inc/framework/widgets/widget-functions.php';

/**
 * Load kirki library in theme
 */
require YUGEN_THEME_DIR . '/inc/libraries/kirki/kirki.php';

/**
 * Customizer options.
 */
require YUGEN_THEME_DIR . '/inc/framework/customizer/customizer.php';

/**
 * Load plugin recommendations.
 */
require YUGEN_THEME_DIR . '/inc/libraries/tgm/tgm.php';

/**
 * Include admin files.
 */
if ( is_admin() ) {

    // Welcome Page.
    require YUGEN_THEME_DIR . '/inc/framework/welcome-screen/class-welcome-screen.php';
    require YUGEN_THEME_DIR . '/inc/framework/welcome-screen/persist-admin-notices-dismissal.php';

    // Demo.
    require YUGEN_THEME_DIR . '/inc/framework/demo-importer/class-demo.php';
}

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require YUGEN_THEME_DIR . '/inc/libraries/jetpack.php';
}

