<?php
/**
 * nightowlcafe functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package nightowlcafe
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function nightowlcafe_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on nightowlcafe, use a find and replace
		* to change 'nightowlcafe' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'nightowlcafe', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'nightowlcafe' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'nightowlcafe_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'nightowlcafe_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nightowlcafe_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'nightowlcafe_content_width', 640 );
}
add_action( 'after_setup_theme', 'nightowlcafe_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nightowlcafe_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'nightowlcafe' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'nightowlcafe' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'nightowlcafe_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function nightowlcafe_scripts() {
	wp_enqueue_style( 'nightowlcafe-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'nightowlcafe-style', 'rtl', 'replace' );

	wp_enqueue_script( 'nightowlcafe-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'menu-card', get_template_directory_uri() . '/js/menu-card.js', array(), _S_VERSION, true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_product() ) {
		wp_enqueue_script( 'menu-options-js', get_template_directory_uri() . '/js/menu-options.js', array(), '1.0.0', array('strategy' => 'defer') );
	}

	// copy text
	if ( is_page( 'info' ) ) {
		wp_enqueue_script( 'copy-text', get_template_directory_uri(). '/js/copytext.js', array(), _S_VERSION, true );
	}

	if (is_front_page()) {
		wp_enqueue_script( 'spin-on-scroll', get_template_directory_uri(). '/js/spin-on-scroll.js', array(), _S_VERSION, true );
	}

	// FAB    
	wp_enqueue_script('fab-script', get_template_directory_uri() . '/js/fab-script.js', array(), '1.0.0', array('strategy' => 'defer') );

}
add_action( 'wp_enqueue_scripts', 'nightowlcafe_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
	require get_template_directory() . '/inc/menu-functions.php';
	require get_template_directory() . '/inc/single-dish-functions.php';
}

/**
 * Custom Post Types and Taxonomies.
 */
require get_template_directory() . '/inc/cpt-taxonomy.php';


// test API key for ACF Google MAP

function my_acf_init() {
    
    acf_update_setting('google_api_key', 'ADD GOOGLE API KEY LATER');
}

add_action('acf/init', 'my_acf_init');

// Set timezone to Vancouver
function set_theme_timezone() {
    date_default_timezone_set('America/Vancouver');
}
add_action('init', 'set_theme_timezone');


// 
add_filter('woocommerce_get_image_size_thumbnail', function($size) {
    return array(
        'width'  => 300, 
        'height' => 300, 
        'crop'   => 0,   
    );
});

// Disable Block Editor
function disable_block_editor_except_pages($can_edit, $post_type) {

	$id = '';

	if ( get_the_ID() === $id ) {
		return true;
	} else {
		return false;
	}
}

add_filter('use_block_editor_for_post', 'disable_block_editor_except_pages', 10, 2);
add_filter('gutenberg_can_edit_post_type', 'disable_block_editor_except_pages', 10, 2);