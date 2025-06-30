<?php
/**
 * 404 Page Template
 * 
 * @package chanodev
 * @since 1.0.0
 */
get_header(); ?>

<main id="main" class="site-main" role="main">
    <header class="block">
        <section class="content content-section">
            <h1><?php echo esc_html__('Oops! Error 404', 'chanodev'); ?></h1>
        </section>
    </header>
    <div class="block">
        <div class="content">
            <h2><?php echo esc_html__('Page Not Found', 'chanodev'); ?></h2>
            <p><?php echo esc_html__("We can't seem to find the page you're looking for.", 'chanodev'); ?></p>
            <p><?php echo esc_html__('Try to use the search.', 'chanodev'); ?></p>

            <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                <label>
                    <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ); ?></span>
                    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Query ...', 'placeholder' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ); ?>" />
                </label>
                <input type="submit" class="search-submit btn btn-primary" value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>" />
            </form>

            <p><?php esc_html_e('Or go to the home page to start over.', 'chanodev'); ?></p>
            <a class="btn btn-secondary btn-sm" href="<?php echo get_home_url(); ?>">
                <?php echo esc_html('Go To Home Page', 'chanodev'); ?>
            </a>
        </div>
    </div>
</main><!-- .site-main -->

<?php get_footer(); ?>