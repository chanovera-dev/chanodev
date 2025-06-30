<?php
/**
 * ChanoDEV Core Functions
 *
 * @package chanodev
 * @since 1.0.0
 */

/**
 * Theme setup function: registers menus, adds theme supports, and enables HTML5 support.
 */
function setup_chanodev() {

    // Register all theme navigation menus for different layout sections.
    register_nav_menus([
        'primary'       => __( 'Primary menu', 'chanodev' ),
        'footer'       => __( 'Footer menu', 'chanodev' ),
        'social'        => __( 'Social menu', 'chanodev' ),
    ]);

    // Enable core WordPress theme features like thumbnails and block support.
    add_theme_support( 'title-tag' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-thumbnails', [ 'post', 'page' ] );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );

    // Allow site logo upload with flexible dimensions.
    add_theme_support( 'custom-logo', [
        'height'      => 20,
        'width'       => 120,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    // Enable HTML5 markup support for various elements.
    add_theme_support( 'html5', apply_filters( 'chanodev_html5_args', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'widgets',
        'style',
        'script',
    ]));
}
add_action( 'after_setup_theme', 'setup_chanodev' );


/**
 * Return a version number for cache busting based on file modification time.
 */
function get_asset_version( string $file_path ): int {
    $full_path = get_template_directory() . $file_path;
    return file_exists( $full_path ) ? filemtime( $full_path ) : time();
}

/**
 * Load global CSS styles into the site header.
 */
function load_on_header() {
    wp_enqueue_style( 'main-styles', get_template_directory_uri() . '/style.css', [], get_asset_version( '/style.css' ), 'all' );
    wp_enqueue_style( 'wp-root', get_template_directory_uri() . '/assets/css/wp-root.css', [], get_asset_version( '/assets/css/wp-root.css' ), 'all' );
    wp_enqueue_style( 'custom-forms', get_template_directory_uri() . '/assets/css/forms.css', [], get_asset_version( '/assets/css/forms.css' ), 'all' );
}
add_action( 'wp_enqueue_scripts', 'load_on_header' );

/**
 * Enqueue JavaScript and CSS assets for the theme footer.
 */
function load_on_footer() {
    wp_enqueue_script('global', get_template_directory_uri() . '/assets/js/global.js', [], get_asset_version('/assets/js/global.js'), true);
    if (is_user_logged_in()) {
        wp_enqueue_style( 'has-login', get_template_directory_uri() . '/assets/css/has-login.css', [], get_asset_version('/assets/css/has-login.css'), 'all' );
    }   
}
add_action( 'wp_footer', 'load_on_footer' );

/**
 * Register custom widget areas for blog and post sidebars.
 */
function widgets_areas() {

    register_sidebar(
        array(
            'name'          => __( 'Sidebar Blog', 'chanodev' ),
            'id'            => 'posts-sidebar',
            'before_widget' => '',
            'after_widget'  => '',
        )
    );

    register_sidebar(
        array(
            'name'          => __( 'Sidebar Post', 'chanodev' ),
            'id'            => 'post-sidebar',
            'before_widget' => '',
            'after_widget'  => '',
        )
    );

        register_sidebar(
        array(
            'name'          => __( 'Sidebar Page', 'chanodev' ),
            'id'            => 'page-sidebar',
            'before_widget' => '',
            'after_widget'  => '',
        )
    );

}
add_action( 'widgets_init', 'widgets_areas' );