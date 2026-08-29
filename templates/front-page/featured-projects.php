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
        <div class="section-heading-between" data-reveal="fade-up">
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
            <div class="chanodev-projects-grid" data-reveal-stagger>
                <?php
                while ( $projects_query->have_posts() ) :
                    $projects_query->the_post();
                    $details = function_exists( 'chanodev_get_project_details' ) ? chanodev_get_project_details( get_the_ID() ) : array();
                ?>
                    <article id="project-<?php the_ID(); ?>" <?php post_class( 'chanodev-project-card' ); ?> data-reveal="fade-up">
                        <div class="project-card-media">
                            <a href="<?php the_permalink(); ?>" class="project-card-thumbnail-link" tabindex="-1" aria-hidden="true">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'large', array( 'class' => 'project-card-img', 'loading' => 'lazy' ) ); ?>
                                <?php else : ?>
                                    <div class="project-card-placeholder">
                                        <span><?php esc_html_e( 'Proyecto Destacado', 'chanodev' ); ?></span>
                                    </div>
                                <?php endif; ?>
                            </a>
                            <?php if ( ! empty( $details['types'] ) && ! is_wp_error( $details['types'] ) ) : ?>
                                <span class="project-type-badge">
                                    <?php echo esc_html( $details['types'][0]->name ); ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="project-card-body">
                            <?php if ( ! empty( $details['technologies'] ) && ! is_wp_error( $details['technologies'] ) ) : ?>
                                <div class="post--tags__wrapper">
                                    <div class="skill-tags-cloud tags post--tags">
                                        <?php foreach ( array_slice( $details['technologies'], 0, 3 ) as $tech ) : ?>
                                            <span class="transparent-tag"><?php echo esc_html( $tech->name ); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <h3 class="project-card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>

                            <div class="project-card-excerpt">
                                <?php the_excerpt(); ?>
                            </div>

                            <footer class="project-card-footer">
                                <a href="<?php the_permalink(); ?>" class="btn-read-case-study">
                                    <span><?php esc_html_e( 'Ver Caso de Estudio', 'chanodev' ); ?></span>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                </a>
                            </footer>
                        </div>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        <?php else : ?>
            <!-- Showcase Demo Cards when no projects are published yet -->
            <div class="chanodev-projects-grid" data-reveal-stagger>
                <article class="chanodev-project-card demo-card" data-reveal="fade-up">
                    <div class="project-card-media">
                        <div class="project-card-placeholder tech-wp">
                            <span>WordPress & WooCommerce</span>
                        </div>
                        <span class="project-type-badge"><?php esc_html_e( 'Tienda Online', 'chanodev' ); ?></span>
                    </div>
                    <div class="project-card-body">
                        <div class="post--tags__wrapper">
                            <div class="skill-tags-cloud tags post--tags">
                                <span class="transparent-tag text-black">WordPress</span>
                                <span class="transparent-tag text-black">WooCommerce</span>
                                <span class="transparent-tag text-black">Stripe</span>
                            </div>
                        </div>
                        <h3 class="project-card-title">
                            <a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>"><?php esc_html_e( 'E-Commerce de Alto Rendimiento', 'chanodev' ); ?></a>
                        </h3>
                        <p class="project-card-excerpt"><?php esc_html_e( 'Tienda virtual con checkout en 1 paso, catálogo optimizado y 98 en Google PageSpeed.', 'chanodev' ); ?></p>
                        <footer class="project-card-footer">
                            <a href="<?php echo esc_url( home_url( '/servicios/' ) ); ?>" class="btn-read-case-study">
                                <span><?php esc_html_e( 'Ver Servicios', 'chanodev' ); ?></span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </a>
                        </footer>
                    </div>
                </article>

                <article class="chanodev-project-card demo-card" data-reveal="fade-up">
                    <div class="project-card-media">
                        <div class="project-card-placeholder tech-react">
                            <span>React & Node.js</span>
                        </div>
                        <span class="project-type-badge"><?php esc_html_e( 'Aplicación Web', 'chanodev' ); ?></span>
                    </div>
                    <div class="project-card-body">
                        <div class="post--tags__wrapper">
                            <div class="skill-tags-cloud tags post--tags">
                                <span class="transparent-tag text-black">React.js</span>
                                <span class="transparent-tag text-black">Node.js</span>
                                <span class="transparent-tag text-black">REST API</span>
                            </div>
                        </div>
                        <h3 class="project-card-title">
                            <a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>"><?php esc_html_e( 'Plataforma SaaS / Dashboard Corporativo', 'chanodev' ); ?></a>
                        </h3>
                        <p class="project-card-excerpt"><?php esc_html_e( 'Panel interactivo para gestión de clientes, métricas en tiempo real y autenticación segura.', 'chanodev' ); ?></p>
                        <footer class="project-card-footer">
                            <a href="<?php echo esc_url( home_url( '/servicios/' ) ); ?>" class="btn-read-case-study">
                                <span><?php esc_html_e( 'Ver Servicios', 'chanodev' ); ?></span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </a>
                        </footer>
                    </div>
                </article>
            </div>
        <?php endif; ?>
    </div>
</section>