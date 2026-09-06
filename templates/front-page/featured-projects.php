<?php
/**
 * Template part for displaying the Front Page Featured Projects section
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- 3. Featured Projects Section -->
<section class="block home-projects-block">
    <div class="content">
        <div class="section-heading-center" data-reveal="fade-up">
            <div>
                <?php if ( ! empty( $projects_kicker ) ) : ?>
                    <span class="sub-heading"><?php echo esc_html( $projects_kicker ); ?></span>
                <?php endif; ?>
                <h2><?php echo esc_html( $projects_title ); ?></h2>
            </div>
            <?php if ( ! empty( $projects_btn_txt ) ) : ?>
                <a href="<?php echo esc_url( $projects_btn_url ); ?>" class="btn-link-all">
                    <span><?php echo esc_html( $projects_btn_txt ); ?></span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
            <?php endif; ?>
        </div>

        <?php
        $projects_query = new WP_Query( array(
            'post_type'      => 'project',
            'posts_per_page' => 4,
            'post_status'    => 'publish',
        ) );

        if ( $projects_query->have_posts() ) :
        ?>
            <div class="posts-grid chanodev-projects-grid" data-reveal-stagger>
                <?php
                while ( $projects_query->have_posts() ) :
                    $projects_query->the_post();
                    $details   = function_exists( 'chanodev_get_project_details' ) ? chanodev_get_project_details( get_the_ID() ) : array();
                    $has_thumb = has_post_thumbnail();
                    $container_classes = 'stories-standard-container' . ( ! $has_thumb ? ' has-no-thumbnail' : '' );
                ?>
                    <article id="project-<?php the_ID(); ?>" <?php post_class( 'story-card format-standard-card chanodev-project-card' . ( ! $has_thumb ? ' has-no-thumbnail' : '' ) ); ?> data-id="<?php echo esc_attr( get_the_ID() ); ?>" data-reveal="fade-up">
                        <div class="<?php echo esc_attr( $container_classes ); ?>">
                            <!-- Background / Pattern -->
                            <div class="post-thumbnail-bg <?php echo ! $has_thumb ? 'no-thumbnail-pattern' : ''; ?>">
                                <?php if ( $has_thumb ) : ?>
                                    <?php the_post_thumbnail( 'large' ); ?>
                                <?php endif; ?>
                            </div>

                            <!-- Top Actions (Info Toggle & Like Button) -->
                            <div class="post-top-actions">
                                <div class="toggle-info-container inset-shadow-effect">
                                    <button type="button" class="toggle-info-btn" aria-label="<?php esc_attr_e( 'Toggle Post Info', 'stories' ); ?>" title="<?php esc_attr_e( 'Toggle Post Info', 'stories' ); ?>">
                                        <?php if ( function_exists( 'stories_svg' ) ) { stories_svg( 'info', array( 'size' => 18 ) ); } ?>
                                    </button>
                                </div>
                                <?php if ( function_exists( 'stories_like_button' ) ) { stories_like_button(); } ?>
                            </div>

                            <!-- Information Overlay Card -->
                            <div class="info-overlay quote-info-overlay standard-info-overlay">
                                <header class="entry-header">
                                    <div class="entry-badge">
                                        <?php if ( ! empty( $details['types'] ) && ! is_wp_error( $details['types'] ) ) : ?>
                                            <span class="project-type-badge"><?php echo esc_html( $details['types'][0]->name ); ?></span>
                                        <?php elseif ( function_exists( 'stories_post_type_badge' ) ) : ?>
                                            <?php stories_post_type_badge(); ?>
                                        <?php endif; ?>
                                    </div>
                                </header>

                                <div class="entry-body">
                                    <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

                                    <div class="entry-meta">
                                        <?php if ( function_exists( 'stories_posted_on' ) ) stories_posted_on(); ?>
                                        <?php if ( ! empty( $details['client'] ) ) : ?>
                                            <span class="entry-client">🏢 <?php echo esc_html( $details['client'] ); ?></span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="entry-summary">
                                        <?php the_excerpt(); ?>
                                    </div>

                                    <?php if ( ! empty( $details['metrics'] ) ) : ?>
                                        <div class="project-metric-pill">
                                            <span class="metric-icon">🚀</span>
                                            <span class="metric-text"><?php echo esc_html( $details['metrics'] ); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <footer class="entry-footer">
                                    <?php if ( ! empty( $details['technologies'] ) && ! is_wp_error( $details['technologies'] ) ) : ?>
                                        <div class="post--tags__wrapper">
                                            <div class="tags post--tags">
                                                <?php foreach ( $details['technologies'] as $tech ) : ?>
                                                    <a class="post-tag small" href="<?php echo esc_url( get_term_link( $tech ) ); ?>">
                                                        <?php echo ( function_exists( 'stories_get_svg' ) ? stories_get_svg( 'tag', array( 'size' => 12 ) ) : '#' ) . esc_html( $tech->name ); ?>
                                                    </a>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </footer>
                            </div>

                            <!-- Bottom Bar showing Title -->
                            <div class="standard-bottom-bar">
                                <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
                            </div>
                        </div>
                        <div class="post__overlay"></div>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        <?php else : ?>
            <!-- Showcase Demo Cards when no projects are published yet -->
            <div class="posts-grid chanodev-projects-grid" data-reveal-stagger>
                <article class="story-card format-standard-card chanodev-project-card demo-card has-no-thumbnail" data-reveal="fade-up">
                    <div class="stories-standard-container has-no-thumbnail">
                        <div class="post-thumbnail-bg no-thumbnail-pattern"></div>
                        <div class="post-top-actions">
                            <div class="toggle-info-container inset-shadow-effect">
                                <button type="button" class="toggle-info-btn" aria-label="<?php esc_attr_e( 'Toggle Post Info', 'stories' ); ?>" title="<?php esc_attr_e( 'Toggle Post Info', 'stories' ); ?>">
                                    <?php if ( function_exists( 'stories_svg' ) ) { stories_svg( 'info', array( 'size' => 18 ) ); } ?>
                                </button>
                            </div>
                            <div class="inset-shadow-effect like-btn-container" data-post-id="demo-1">
                                <button type="button" class="button__like" data-post-id="demo-1" aria-label="<?php esc_attr_e( 'Me gusta', 'chanodev' ); ?>">
                                    <?php echo ( function_exists( 'stories_get_svg' ) ? stories_get_svg( 'heart', array( 'size' => 16 ) ) : '❤' ); ?>
                                    <span class="like-count">18</span>
                                </button>
                            </div>
                        </div>
                        <div class="info-overlay quote-info-overlay standard-info-overlay">
                            <header class="entry-header">
                                <div class="entry-badge">
                                    <span class="project-type-badge"><?php esc_html_e( 'Tienda Online', 'chanodev' ); ?></span>
                                </div>
                            </header>
                            <div class="entry-body">
                                <h2 class="entry-title">
                                    <a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>"><?php esc_html_e( 'E-Commerce de Alto Rendimiento', 'chanodev' ); ?></a>
                                </h2>
                                <div class="entry-meta">
                                    <span class="entry-client">🏢 Tienda Retail Pro</span>
                                </div>
                                <div class="entry-summary">
                                    <p><?php esc_html_e( 'Tienda virtual con checkout en 1 paso, catálogo optimizado y 98 en Google PageSpeed.', 'chanodev' ); ?></p>
                                </div>
                                <div class="project-metric-pill">
                                    <span class="metric-icon">🚀</span>
                                    <span class="metric-text">+240% Conversión</span>
                                </div>
                            </div>
                            <footer class="entry-footer">
                                <div class="post--tags__wrapper">
                                    <div class="tags post--tags">
                                        <span class="post-tag small"><?php echo ( function_exists( 'stories_get_svg' ) ? stories_get_svg( 'tag', array( 'size' => 12 ) ) : '#' ); ?>WordPress</span>
                                        <span class="post-tag small"><?php echo ( function_exists( 'stories_get_svg' ) ? stories_get_svg( 'tag', array( 'size' => 12 ) ) : '#' ); ?>WooCommerce</span>
                                        <span class="post-tag small"><?php echo ( function_exists( 'stories_get_svg' ) ? stories_get_svg( 'tag', array( 'size' => 12 ) ) : '#' ); ?>Stripe</span>
                                    </div>
                                </div>
                            </footer>
                        </div>
                        <div class="standard-bottom-bar">
                            <h2 class="entry-title"><a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>"><?php esc_html_e( 'E-Commerce de Alto Rendimiento', 'chanodev' ); ?></a></h2>
                        </div>
                    </div>
                    <div class="post__overlay"></div>
                </article>

                <article class="story-card format-standard-card chanodev-project-card demo-card has-no-thumbnail" data-reveal="fade-up">
                    <div class="stories-standard-container has-no-thumbnail">
                        <div class="post-thumbnail-bg no-thumbnail-pattern"></div>
                        <div class="post-top-actions">
                            <div class="toggle-info-container inset-shadow-effect">
                                <button type="button" class="toggle-info-btn" aria-label="<?php esc_attr_e( 'Toggle Post Info', 'stories' ); ?>" title="<?php esc_attr_e( 'Toggle Post Info', 'stories' ); ?>">
                                    <?php if ( function_exists( 'stories_svg' ) ) { stories_svg( 'info', array( 'size' => 18 ) ); } ?>
                                </button>
                            </div>
                            <div class="inset-shadow-effect like-btn-container" data-post-id="demo-2">
                                <button type="button" class="button__like" data-post-id="demo-2" aria-label="<?php esc_attr_e( 'Me gusta', 'chanodev' ); ?>">
                                    <?php echo ( function_exists( 'stories_get_svg' ) ? stories_get_svg( 'heart', array( 'size' => 16 ) ) : '❤' ); ?>
                                    <span class="like-count">24</span>
                                </button>
                            </div>
                        </div>
                        <div class="info-overlay quote-info-overlay standard-info-overlay">
                            <header class="entry-header">
                                <div class="entry-badge">
                                    <span class="project-type-badge"><?php esc_html_e( 'Aplicación Web', 'chanodev' ); ?></span>
                                </div>
                            </header>
                            <div class="entry-body">
                                <h2 class="entry-title">
                                    <a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>"><?php esc_html_e( 'Plataforma SaaS / Dashboard Corporativo', 'chanodev' ); ?></a>
                                </h2>
                                <div class="entry-meta">
                                    <span class="entry-client">🏢 FinTech Analytics</span>
                                </div>
                                <div class="entry-summary">
                                    <p><?php esc_html_e( 'Panel interactivo para gestión de clientes, métricas en tiempo real y autenticación segura.', 'chanodev' ); ?></p>
                                </div>
                                <div class="project-metric-pill">
                                    <span class="metric-icon">🚀</span>
                                    <span class="metric-text">+99.9% Uptime</span>
                                </div>
                            </div>
                            <footer class="entry-footer">
                                <div class="post--tags__wrapper">
                                    <div class="tags post--tags">
                                        <span class="post-tag small"><?php echo ( function_exists( 'stories_get_svg' ) ? stories_get_svg( 'tag', array( 'size' => 12 ) ) : '#' ); ?>React.js</span>
                                        <span class="post-tag small"><?php echo ( function_exists( 'stories_get_svg' ) ? stories_get_svg( 'tag', array( 'size' => 12 ) ) : '#' ); ?>Node.js</span>
                                        <span class="post-tag small"><?php echo ( function_exists( 'stories_get_svg' ) ? stories_get_svg( 'tag', array( 'size' => 12 ) ) : '#' ); ?>REST API</span>
                                    </div>
                                </div>
                            </footer>
                        </div>
                        <div class="standard-bottom-bar">
                            <h2 class="entry-title"><a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>"><?php esc_html_e( 'Plataforma SaaS / Dashboard Corporativo', 'chanodev' ); ?></a></h2>
                        </div>
                    </div>
                    <div class="post__overlay"></div>
                </article>
            </div>
        <?php endif; ?>
    </div>
</section>