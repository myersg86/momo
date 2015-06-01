<?php
/**
 * momo functions and definitions
 *
 * @package momo
 * @since momo 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since momo 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 654; /* pixels */

if ( ! function_exists( 'momo_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since momo 1.0
 */
function momo_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on momo, use a find and replace
	 * to change 'momo' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'momo', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'momo' ),
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', ) );
	
	/**
	 * Add support for post thumbnails
	 */
	add_theme_support('post-thumbnails');
	add_image_size(100, 300, true);
	add_image_size( 'featured', 670, 300, true );
	add_image_size( 'recent', 700, 400, true );

}
endif; // momo_setup
add_action( 'after_setup_theme', 'momo_setup' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * Hooks into the after_setup_theme action.
 *
 * @since momo 1.0
 */
function momo_register_custom_background() {
	$args = array(
		'default-color' => 'FFF',
	);

	$args = apply_filters( 'momo_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_theme_support( 'custom-background', $args );
	}
}
add_action( 'after_setup_theme', 'momo_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since momo 1.0
 */
function momo_widgets_init() {
		register_sidebar( array(
			'name' => __( 'Primary Sidebar', 'momo' ),
			'id' => 'sidebar-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		) );
	
		register_sidebar(array(
			'name' => __( 'Left Column', 'momo' ), 
			'id'   => 'left_column',
			'description'   => 'Widget area for home page left column',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));
		register_sidebar(array(
			'name' => __( 'Center Column', 'momo' ),
			'id'   => 'center_column',
			'description'   => 'Widget area for home page center column',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));
		register_sidebar(array(
			'name' => __( 'Right Column', 'momo' ),
			'id'   => 'right_column',
			'description'   => 'Widget area for home page right column',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));

}
add_action( 'widgets_init', 'momo_widgets_init' );


/**
	 * Customizer additions
	 */
	require( get_template_directory() . '/inc/customizer.php' );



/**
 * Enqueue scripts and styles
 */
function momo_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
		wp_enqueue_script( 'smoothup', get_template_directory_uri() . '/js/smoothscroll.js', array( 'jquery' ), '',  true );
}
add_action( 'wp_enqueue_scripts', 'momo_scripts' );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );


/**
 * sanitize customizer text input
 */
function momo_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
function momo_sanitize_url( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
function momo_sanitize_upload($input){
	return esc_url_raw($input);	
}
/**
 * Filters the page title appropriately depending on the current page
 *
 * This function is attached to the 'wp_title' fiilter hook.
 *
 * @uses	get_bloginfo()
 * @uses	is_home()
 * @uses	is_front_page()
 */
function momo_wp_title( $title ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	$site_description = get_bloginfo( 'description' );

	$filtered_title = $title . get_bloginfo( 'name' );
	$filtered_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? ' | ' . $site_description: '';
	$filtered_title .= ( 2 <= $paged || 2 <= $page ) ? ' | ' . sprintf( __( 'Page %s', 'momo' ), max( $paged, $page ) ) : '';

	return $filtered_title;
}