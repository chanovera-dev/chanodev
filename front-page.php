<?php
/**
 * The frontpage template file for chanodev theme.
 */
get_header(); ?>

<main id="main" class="id-<?php the_ID(); ?> site-main" role="main">
    <?php the_content(); ?>
</main>

<?php get_footer(); ?>