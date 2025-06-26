<?php
/**
 * 
 */

function frontpage_styles() {
    if ( is_front_page() or is_page_template( 'front-page.php' ) ) {
        wp_dequeue_style( 'wp-block-library' );
        wp_enqueue_style( 'background-light', get_template_directory_uri() . '/assets/css/frontpage.css', [], get_asset_version( '/assets/css/frontpage.css' ), 'all' );
        wp_enqueue_script( 'light-animation', get_template_directory_uri() . '/assets/js/light-animation.js', [], get_asset_version( '/assets/js/light-animation.js' ), true );
        wp_enqueue_style( 'hero', get_template_directory_uri() . '/assets/css/frontpage/hero.css', [], get_asset_version( '/assets/css/frontpage/hero.css' ), 'all' );
        wp_enqueue_script( 'blur-typing', get_template_directory_uri() . '/assets/js/blur-typing.js', [], get_asset_version( '/assets/js/blur-typing.js' ), true );
        wp_enqueue_style( 'about-frontpage', get_template_directory_uri() . '/assets/css/frontpage/about.css', [], get_asset_version( '/assets/css/frontpage/about.css' ), 'all' );
        wp_enqueue_script( 'animate-in', get_template_directory_uri() . '/assets/js/animate-in.js', [], get_asset_version( '/assets/js/animate-in.js' ), true );
        wp_enqueue_style( 'skills', get_template_directory_uri() . '/assets/css/frontpage/skills.css', [], get_asset_version( '/assets/css/frontpage/skills.css' ), 'all' );
        wp_enqueue_script( 'skills-animation', get_template_directory_uri() . '/assets/js/skills-animation.js', [], get_asset_version( '/assets/js/skills-animation.js' ), true );
        wp_enqueue_style( 'works-frontpage', get_template_directory_uri() . '/assets/css/frontpage/works.css', [], get_asset_version( '/assets/css/frontpage/works.css' ), 'all' );
        wp_enqueue_script( 'works-animation', get_template_directory_uri() . '/assets/js/works-animation.js', [], get_asset_version( '/assets/js/works-animation.js' ), true );
        wp_enqueue_script( 'custom-contact', get_template_directory_uri() . '/assets/js/send-email.js', [], get_asset_version( '/assets/js/send-email.js' ), true );
        wp_enqueue_style( 'contact-frontpage', get_template_directory_uri() . '/assets/css/frontpage/contact.css', [], get_asset_version( '/assets/css/frontpage/contact.css' ), 'all' );
    }
}
add_action( 'wp_enqueue_scripts', 'frontpage_styles' );