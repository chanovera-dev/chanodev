<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo esc_attr( get_dynamic_meta_description() ); ?>">
    <?php wp_head(); ?>
</head>
<body>
    <header id="main-header" class="block">
        <div class="content">
            <div class="site-brand">
                <?php if ( ! has_custom_logo() ) : ?>
                    <a href="<?= esc_url( home_url() ); ?>" aria-label="link to home page">
                        <?= esc_html( get_bloginfo( 'name' ) ); ?>
                    </a>
                <?php else : ?>
                    <?php the_custom_logo(); ?>
                <?php endif; ?>
            </div>
            <div id="main-nav" class="wrapper">
                <?php
                    $menu_id = get_nav_menu_locations()[ 'primary' ];
                    $items = wp_get_nav_menu_items( $menu_id );
                    if ( ! empty( $items ) ) {
                        wp_nav_menu(
                            array(
                                'container' => 'nav',
                                'container_id' => 'primary', 
                                'theme_location' => 'primary',
                            ) 
                        );
                    }
                ?>
                <form role="search" method="get" id="custom-searchform" action="<?php echo home_url( '/' ); ?>">
                    <label class="screen-reader-text" for="s"><?php esc_html__('Search', 'chanodev'); ?></label>
                    <input class="wp-block-search__input" type="text" value="" name="s" id="s" placeholder="<?php esc_html_e('Search', 'chanodev'); ?>">
                    <button type="submit" id="searchsubmit" value="Search" aria-label="Activate the search">
                        <div class="search-icon-circle"></div>
                        <span></span>
                    </button>
                    <div class="close-custom-searchform" onclick="closeCustomSearchform()">
                        <div class="close-icon-circle"></div>
                        <span></span>
                    </div>
                </form>
            </div>
            <button id="main-search__button" onclick="toggleMainSearch()">
                <div class="search-icon-circle"></div>
                <span></span>
            </button>
            <button id="main-nav__button" onclick="toggleMenuMobile()">
                <div class="bar"></div>
            </button>
        </div>
    </header>