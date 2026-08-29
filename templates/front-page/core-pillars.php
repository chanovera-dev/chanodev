<?php
/**
 * Template part for displaying the Front Page Core Pillars section
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- 2. Core Pillars Section -->
<?php if ( ! empty( $pillars_items ) ) : ?>
    <section class="block home-pillars-block blue-background">
        <div class="content">
            <div class="section-heading-center white-text" data-reveal="fade-up">
                <?php if ( ! empty( $pillars_kicker ) ) : ?>
                    <span class="sub-heading"><?php echo esc_html( $pillars_kicker ); ?></span>
                <?php endif; ?>
                <h2><?php echo esc_html( $pillars_title ); ?></h2>
                <?php if ( ! empty( $pillars_desc ) ) : ?>
                    <p><?php echo esc_html( $pillars_desc ); ?></p>
                <?php endif; ?>
            </div>

            <div class="home-pillars-carousel" id="homePillarsCarousel" data-reveal="fade-up">
                <div class="home-pillars-track" id="homePillarsTrack">
                    <?php foreach ( $pillars_items as $index => $pillar ) : ?>
                        <?php
                        $pnum   = ! empty( $pillar['num'] ) ? $pillar['num'] : sprintf( '%02d', $index + 1 );
                        $pbdg   = ! empty( $pillar['badge'] ) ? $pillar['badge'] : '';
                        $pttl   = ! empty( $pillar['title'] ) ? $pillar['title'] : '';
                        $ptxt   = ! empty( $pillar['text'] ) ? $pillar['text'] : '';
                        $picon  = ! empty( $pillar['icon'] ) ? $pillar['icon'] : '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg>';
                        ?>
                        <div class="home-pillar-slide<?php echo 0 === $index ? ' active' : ''; ?>" data-slide="<?php echo esc_attr( $index ); ?>">
                            <article class="home-pillar-card hover-glow">
                                <div class="pillar-card-top">
                                    <div class="big-badge sub-heading" aria-hidden="true">
                                        <?php echo $picon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                    </div>
                                    <span class="transparent-tag full-size"><?php echo esc_html( $pnum ); ?></span>
                                </div>
                                <?php if ( ! empty( $pbdg ) ) : ?>
                                    <span class="sub-heading pillar-tag"><?php echo esc_html( $pbdg ); ?></span>
                                <?php endif; ?>
                                <h3><?php echo esc_html( $pttl ); ?></h3>
                                <p><?php echo esc_html( $ptxt ); ?></p>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Carousel Navigation Controls -->
                <div class="home-pillars-nav-bar" data-reveal="fade-up" style="--delay: 220ms;">
                    <button type="button" class="btn sub-heading timeline carousel-nav-btn prev" id="pillarsPrevBtn" aria-label="<?php esc_attr_e( 'Anterior principio', 'chanodev' ); ?>">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 18 9 12 15 6"></polyline></svg>
                        <span><?php esc_html_e( 'Anterior', 'chanodev' ); ?></span>
                    </button>

                    <div class="carousel-dots" id="pillarsDots">
                        <?php foreach ( $pillars_items as $index => $pillar ) : ?>
                            <button type="button" class="carousel-dot<?php echo 0 === $index ? ' active' : ''; ?>" data-slide="<?php echo esc_attr( $index ); ?>" aria-label="<?php printf( esc_attr__( 'Ir al principio %d', 'chanodev' ), $index + 1 ); ?>"></button>
                        <?php endforeach; ?>
                    </div>

                    <button type="button" class="btn sub-heading timeline carousel-nav-btn next" id="pillarsNextBtn" aria-label="<?php esc_attr_e( 'Siguiente principio', 'chanodev' ); ?>">
                        <span><?php esc_html_e( 'Siguiente', 'chanodev' ); ?></span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </button>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>