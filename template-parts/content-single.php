<main id="main" class="site-main" role="main">
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'block' ); ?>>
        <div class="content">
            <div class="post-wrapper">
                <header class="post-header"><?php the_title( '<h1 class="page-title">', '</h1>' ); ?></header>
                <main class="post-content is-layout-constrained"><?php the_content(); ?></main>
                <footer class="post-footer is-layout-constrained"><?php comments_template(); ?></footer>
            </div>
            <?php 
                if ( is_sidebar_active( 'post-sidebar' ) ) {
                    echo '<aside class="wp-sidebar">';
                    dynamic_sidebar( 'post-sidebar' );
                    echo '</aside>';
                }
            ?>
        </div>
    </article>
</main>