<?php
/**
 * Template part for displaying the Front Page Technical Stack section
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- 5. Technical Stack Carousel Section -->
<?php if ( ! empty( $tech_badges ) ) : ?>
    <section class="block home-tech-strip-block blue-background">
        <div class="content">
            <div class="section-heading-center white-text" data-reveal="fade-up">
                <?php if ( ! empty( $tech_kicker ) ) : ?>
                    <span class="sub-heading"><?php echo esc_html( $tech_kicker ); ?></span>
                <?php endif; ?>
                <h2><?php echo esc_html( $tech_title ); ?></h2>
            </div>

            <div class="tech-carousel-showcase" data-reveal="fade-up">
                <!-- Running Track Row 1 -->
                <div class="tech-marquee-container" aria-hidden="true">
                    <div class="tech-marquee-track">
                        <?php for ( $loop = 0; $loop < 4; $loop++ ) : ?>
                            <div class="tech-marquee-group">
                                <?php foreach ( $tech_badges as $badge ) : ?>
                                    <?php $badge_text = is_array( $badge ) ? ( $badge['name'] ?? ( $badge['title'] ?? '' ) ) : trim( $badge ); ?>
                                    <?php if ( ! empty( $badge_text ) ) : ?>
                                        <span class="btn sub-heading timeline">
                                            <span class="status-pulse-dot"></span>
                                            <span><?php echo esc_html( $badge_text ); ?></span>
                                        </span>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>

                <!-- Running Track Row 2 (Reverse direction) -->
                <div class="tech-marquee-container is-reverse" aria-hidden="true">
                    <div class="tech-marquee-track reverse">
                        <?php for ( $loop = 0; $loop < 4; $loop++ ) : ?>
                            <div class="tech-marquee-group">
                                <?php foreach ( array_reverse( $tech_badges ) as $badge ) : ?>
                                    <?php $badge_text = is_array( $badge ) ? ( $badge['name'] ?? ( $badge['title'] ?? '' ) ) : trim( $badge ); ?>
                                    <?php if ( ! empty( $badge_text ) ) : ?>
                                        <span class="btn sub-heading timeline">
                                            <span class="status-pulse-dot"></span>
                                            <span><?php echo esc_html( $badge_text ); ?></span>
                                        </span>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>