<?php
/**
 * Template part for displaying the Front Page Core Services section
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- 4. Core Services Section -->
<?php if ( ! empty( $services_items ) ) : ?>
    <section class="block home-services-block whiteprint-background">
        <div class="content">
            <div class="section-heading-center" data-reveal="fade-up">
                <?php if ( ! empty( $services_kicker ) ) : ?>
                    <span class="sub-heading"><?php echo esc_html( $services_kicker ); ?></span>
                <?php endif; ?>
                <h2><?php echo esc_html( $services_title ); ?></h2>
                <?php if ( ! empty( $services_desc ) ) : ?>
                    <p><?php echo esc_html( $services_desc ); ?></p>
                <?php endif; ?>
            </div>

            <div class="process-carousel-wrapper" data-reveal="fade-up" style="--delay: 150ms;">
                <div class="process-steps-track" id="homeServicesTrack">
                    <?php foreach ( $services_items as $index => $svc ) : ?>
                        <?php
                        $sicon  = ! empty( $svc['icon'] ) ? $svc['icon'] : '⚡';
                        $sbdg   = ! empty( $svc['badge'] ) ? $svc['badge'] : '';
                        $sttl   = ! empty( $svc['title'] ) ? $svc['title'] : '';
                        $sdsc   = ! empty( $svc['desc'] ) ? $svc['desc'] : '';
                        $stags  = ! empty( $svc['tags'] ) ? ( is_array( $svc['tags'] ) ? $svc['tags'] : explode( ',', $svc['tags'] ) ) : array();
                        $slink  = ! empty( $svc['link'] ) ? $svc['link'] : home_url( '/servicios/' );
                        $step_num = sprintf( '%02d', $index + 1 );

                        $service_photos = array(
                            CHANODEV_URI . '/assets/images/service-1-wordpress.jpg',
                            CHANODEV_URI . '/assets/images/service-2-ecommerce.jpg',
                            CHANODEV_URI . '/assets/images/service-3-react-node.jpg',
                            CHANODEV_URI . '/assets/images/service-4-wpo-speed.jpg',
                        );
                        $photo_url = ! empty( $svc['image'] ) ? ( is_array( $svc['image'] ) ? $svc['image']['url'] : $svc['image'] ) : $service_photos[ $index % count( $service_photos ) ];
                        ?>
                        <div class="process-step-item about-metric-step<?php echo 0 === $index ? ' active' : ''; ?>" data-index="<?php echo esc_attr( $index ); ?>">
                            <div class="process-step-visual about-metric-visual">
                                <img src="<?php echo esc_url( $photo_url ); ?>" alt="<?php echo esc_attr( $sttl ); ?>" class="metric-bg-photo" loading="lazy" width="768" height="432" />
                                <div class="metric-slide-blueprint">
                                    <div class="metric-slide-top-bar">
                                        <?php if ( ! empty( $sbdg ) ) : ?>
                                            <span class="sub-heading"><?php echo esc_html( $sbdg ); ?></span>
                                        <?php endif; ?>
                                        <span class="transparent-tag full-size"><?php printf( esc_html__( 'SERVICIO %s', 'chanodev' ), esc_html( $step_num ) ); ?></span>
                                    </div>
                                    <div class="metric-slide-main-figure">
                                        <div class="metric-slide-icon-halo">
                                            <?php echo $sicon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                        </div>
                                        <div class="metric-slide-text-group">
                                            <strong class="metric-slide-big-value" style="font-size: clamp(1.4rem, 2.5vw, 1.9rem); line-height: 1.25;"><?php echo esc_html( $sttl ); ?></strong>
                                            <span class="metric-slide-sub-title" style="margin-top: 0.35rem; color: color-mix(in hsl, var(--footer-background), var(--color-white) 80%);"><?php echo esc_html( $sbdg ); ?></span>
                                        </div>
                                    </div>
                                    <div class="metric-slide-footer-bars" aria-hidden="true">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="process-step-content about-metric-content">
                                <div class="process-step-header">
                                    <span class="sub-heading"><?php echo esc_html( $step_num ); ?></span>
                                    <h3><?php echo esc_html( $sttl ); ?></h3>
                                </div>
                                <p><?php echo esc_html( $sdsc ); ?></p>

                                <?php if ( ! empty( $stags ) ) : ?>
                                    <div class="post--tags__wrapper">
                                        <div class="skill-tags-cloud tags post--tags">
                                            <?php foreach ( $stags as $tag_item ) : ?>
                                                <span class="transparent-tag text-black"><?php echo esc_html( is_array( $tag_item ) ? ( $tag_item['tag'] ?? '' ) : trim( $tag_item ) ); ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="process-carousel-controls" data-reveal="fade-up" style="--delay: 240ms;">
                    <div class="slideshow-control-container inset-shadow-effect">
                        <button type="button" class="slide-prev btn-pagination small-pagination slideshow-control carousel-nav-btn prev" aria-label="<?php esc_attr_e( 'Servicio anterior', 'chanodev' ); ?>">
                            <?php echo function_exists( 'stories_get_svg' ) ? stories_get_svg( 'arrow-left-circle', array( 'size' => 18 ) ) : '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>'; ?>
                        </button>
                    </div>
                    <div class="carousel-dots">
                        <?php foreach ( $services_items as $index => $svc ) : ?>
                            <button type="button" class="carousel-dot<?php echo 0 === $index ? ' active' : ''; ?>" data-slide="<?php echo esc_attr( $index ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Ir al servicio %d', 'chanodev' ), $index + 1 ) ); ?>"></button>
                        <?php endforeach; ?>
                    </div>
                    <div class="slideshow-control-container inset-shadow-effect">
                        <button type="button" class="slide-next btn-pagination small-pagination slideshow-control carousel-nav-btn next" aria-label="<?php esc_attr_e( 'Servicio siguiente', 'chanodev' ); ?>">
                            <?php echo function_exists( 'stories_get_svg' ) ? stories_get_svg( 'arrow-right-circle', array( 'size' => 18 ) ) : '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>'; ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>