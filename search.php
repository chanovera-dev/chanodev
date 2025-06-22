<?php
/**
 * The search template file for chanodev theme.
 */
get_header(); ?>

<main id="main" class="site-main" role="main">
    <header class="block">
        <div class="content">
            <h1 class="page-title"><?php the_search_query(); ?></h1>
        </div>
    </header>
    <section class="block">
        <div class="content">
            <div class="posts-wrapper">
                <div class="posts">
                    <?php
                        if ( have_posts() ) :
                            while ( have_posts() ) : the_post();
                                get_template_part( 'template-parts/content', 'single' );    
                        endwhile; 
                        else :
                            echo 'No se han encontrado artículos.';
                        endif;
                    ?>
                </div>
                <?php
                    the_posts_pagination();
                ?>
            </div>
            <?php
                if ( is_active_sidebar( 'posts-sidebar' ) ) {
                    echo '<aside class="wp-sidebar">';
                    dynamic_sidebar( 'posts-sidebar' );
                    echo '</aside>';
                }
            ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>