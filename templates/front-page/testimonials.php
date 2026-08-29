<?php
/**
 * Template part for displaying the Front Page Testimonials section
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- 6. Testimonials Coverflow Section -->
<?php if ( ! empty( $home_testimonials ) ) : ?>
    <section id="testimonies" class="block home-testimonies-block">
        <div class="content">
            <div class="section-heading-center" data-reveal="fade-up">
                <?php if ( ! empty( $testimonies_kicker ) ) : ?>
                    <span class="sub-heading"><?php echo esc_html( $testimonies_kicker ); ?></span>
                <?php endif; ?>
                <h2><?php echo esc_html( $testimonies_title ); ?></h2>
                <?php if ( ! empty( $testimonies_desc ) ) : ?>
                    <p><?php echo esc_html( $testimonies_desc ); ?></p>
                <?php endif; ?>
            </div>

            <div class="testimonies-interactive-container" data-reveal="fade-up" style="--delay: 150ms;">
                <!-- 7 Avatars at the top -->
                <div class="testimonies-avatars-row" role="tablist" aria-label="<?php esc_attr_e( 'Lista de testimonios', 'chanodev' ); ?>" data-reveal="fade-up" style="--delay: 180ms;">
                    <?php foreach ( $home_testimonials as $index => $item ) : ?>
                        <?php
                        $init = ! empty( $item['initials'] ) ? $item['initials'] : ( ! empty( $item['author'] ) ? strtoupper( substr( $item['author'], 0, 2 ) ) : 'CD' );
                        $grad = ! empty( $item['gradient'] ) ? $item['gradient'] : 'linear-gradient(135deg, var(--color-primary), #0284c7)';
                        $auth = ! empty( $item['author'] ) ? $item['author'] : '';
                        ?>
                        <button type="button" class="avatar-item<?php echo 3 === $index ? ' active' : ''; ?>" data-index="<?php echo esc_attr( $index ); ?>" role="tab" aria-selected="<?php echo 3 === $index ? 'true' : 'false'; ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Ver testimonio de %s', 'chanodev' ), $auth ) ); ?>">
                            <div class="avatar-ring"></div>
                            <div class="avatar-img-wrapper" style="background: <?php echo esc_attr( $grad ); ?>">
                                <span><?php echo esc_html( $init ); ?></span>
                            </div>
                        </button>
                    <?php endforeach; ?>
                </div>

                <!-- 7 Testimonial Cards Stack -->
                <div class="testimonies-cards-stack" aria-live="polite" data-reveal="scale-up" style="--delay: 220ms;">
                    <?php foreach ( $home_testimonials as $index => $item ) : ?>
                        <?php
                        $auth = ! empty( $item['author'] ) ? $item['author'] : '';
                        $role = ! empty( $item['role'] ) ? $item['role'] : '';
                        $text = ! empty( $item['text'] ) ? $item['text'] : '';
                        ?>
                        <div class="testimony-card<?php echo 3 === $index ? ' active' : ''; ?>" data-index="<?php echo esc_attr( $index ); ?>">
                            <div class="quote-symbol" aria-hidden="true">“</div>
                            <p class="testimony-text"><?php echo esc_html( $text ); ?></p>
                            <div class="testimony-author">
                                <h3 class="testimony-author-name"><?php echo esc_html( $auth ); ?></h3>
                                <span><?php echo esc_html( $role ); ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Controls -->
                <div class="process-carousel-controls testimonies-controls" data-reveal="fade-up" style="--delay: 280ms;">
                    <div class="slideshow-control-container inset-shadow-effect">
                        <button type="button" class="slide-prev btn-pagination small-pagination slideshow-control carousel-nav-btn prev testi-prev" aria-label="<?php esc_attr_e( 'Testimonio anterior', 'chanodev' ); ?>">
                            <?php echo function_exists( 'stories_get_svg' ) ? stories_get_svg( 'arrow-left-circle', array( 'size' => 18 ) ) : '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>'; ?>
                        </button>
                    </div>
                    <div class="carousel-dots testi-bullets" role="tablist" aria-label="<?php esc_attr_e( 'Paginación de testimonios', 'chanodev' ); ?>">
                        <?php foreach ( $home_testimonials as $index => $item ) : ?>
                            <button type="button" class="carousel-dot bullet<?php echo 3 === $index ? ' active' : ''; ?>" data-slide="<?php echo esc_attr( $index ); ?>" data-index="<?php echo esc_attr( $index ); ?>" role="tab" aria-selected="<?php echo 3 === $index ? 'true' : 'false'; ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Ir al testimonio %d', 'chanodev' ), $index + 1 ) ); ?>"></button>
                        <?php endforeach; ?>
                    </div>
                    <div class="slideshow-control-container inset-shadow-effect">
                        <button type="button" class="slide-next btn-pagination small-pagination slideshow-control carousel-nav-btn next testi-next" aria-label="<?php esc_attr_e( 'Testimonio siguiente', 'chanodev' ); ?>">
                            <?php echo function_exists( 'stories_get_svg' ) ? stories_get_svg( 'arrow-right-circle', array( 'size' => 18 ) ) : '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>'; ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>