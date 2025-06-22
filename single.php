<?php
/**
 * The single template file for chanodev theme.
 */
get_header();

if ( have_posts() ) {
    while ( have_posts() ) : the_post();
        get_template_part( 'template-parts/content', 'single' );
    endwhile;
}

get_footer();