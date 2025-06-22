<main id="main" class="site-main" role="main">
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'block' ); ?>>
        <div class="content">
            <div class="post-wrapper">
                <header class="post-header"><?php the_title( '<h1 class="page-title">', '</h1>' ); ?></header>
                <main class="post-content is-layout-constrained"><?php the_content(); ?></main>
            </div>
            <?php 
                if ( is_sidebar_active( 'page-sidebar' ) ) {
                    echo '<aside class="wp-sidebar">';
                    dynamic_sidebar( 'page-sidebar' );
                    echo '</aside>';
                }
            ?>
        </div>
    </article>
</main>