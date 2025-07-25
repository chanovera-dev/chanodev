<?php
/**
 * The page template file for chanodev theme.
 */
get_header();

if ( have_posts() ) {
    while ( have_posts() ) : the_post();
        get_template_part( 'template-parts/content', 'page' );
    endwhile;
}

get_footer();