<?php
/**
 * 
 */

 /**
 * Styles ans scripts for the Front Page
 */
function frontpage_styles() {
    if ( is_front_page() || is_page_template( 'front-page.php' ) ) {

        function unload_parts_header() {
            wp_dequeue_style( 'wp-block-library' );
        }
        add_action( 'wp_enqueue_scripts', 'unload_parts_header', 100 );

        $base_uri = get_template_directory_uri();

        $assets = [
            'background-light'   => [ 'style', '/assets/css/frontpage.css' ],
            'hero'               => [ 'style', '/assets/css/frontpage/hero.css' ],
            'about-frontpage'    => [ 'style', '/assets/css/frontpage/about.css' ],
            'skills'             => [ 'style', '/assets/css/frontpage/skills.css' ],
            'works-frontpage'    => [ 'style', '/assets/css/frontpage/works.css' ],
            'contact-frontpage'  => [ 'style', '/assets/css/frontpage/contact.css' ],
            'light-animation'    => [ 'script', '/assets/js/light-animation.js', true ],
            'blur-typing'        => [ 'script', '/assets/js/blur-typing.js', true ],
            'animate-in'         => [ 'script', '/assets/js/animate-in.js', true ],
            'skills-animation'   => [ 'script', '/assets/js/skills-animation.js', true ],
            'works-animation'    => [ 'script', '/assets/js/works-animation.js', true ],
            'custom-contact'     => [ 'script', '/assets/js/send-email.js', true ],
        ];

        foreach ( $assets as $handle => $asset ) {
            $type = $asset[0];
            $path = $asset[1];
            $version = get_asset_version( $path );

            if ( $type === 'style' ) {
                wp_enqueue_style( $handle, $base_uri . $path, [], $version, 'all' );
            } elseif ( $type === 'script' ) {
                $in_footer = $asset[2] ?? true;
                wp_enqueue_script( $handle, $base_uri . $path, [], $version, $in_footer );
            }
        }
    }
}
add_action( 'wp_enqueue_scripts', 'frontpage_styles' );

/**
 * Styles for error 404 page
 */
function error404_templates() {
    if ( is_404() ) {
        wp_enqueue_style( 'error404-styles', get_template_directory_uri() . '/assets/css/error404.css', array(), get_asset_version('/assets/css/error404.css'), 'all' );
    }
}
add_action( 'wp_enqueue_scripts', 'error404_templates' );