<?php
/**
 * Template part for displaying the Services Page Hero section
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- 1. Hero Section -->
<section class="block services-hero-block">
	<div class="content">
		<div class="hero-grid">
			<div class="hero-text">
				<?php if ( ! empty( $hero_kicker ) ) : ?>
					<span class="sub-heading"><?php echo esc_html( $hero_kicker ); ?></span>
				<?php endif; ?>

				<?php if ( ! empty( $hero_title ) ) : ?>
					<h1 class="headline"><?php echo esc_html( $hero_title ); ?></h1>
				<?php endif; ?>

				<?php if ( ! empty( $hero_desc ) ) : ?>
					<p class="subheadline"><?php echo esc_html( $hero_desc ); ?></p>
				<?php endif; ?>

				<div class="services-hero-actions btn-actions">
					<?php if ( ! empty( $primary_btn_txt ) ) : ?>
						<a href="<?php echo esc_url( $primary_btn_url ); ?>" class="btn primary">
							<?php echo esc_html( $primary_btn_txt ); ?>
							<?php stories_svg( 'arrow-right-circle' ); ?>
						</a>
					<?php endif; ?>

					<?php if ( ! empty( $secondary_btn_txt ) ) : ?>
						<a href="<?php echo esc_url( $secondary_btn_url ); ?>" class="btn hollow outline">
							<?php echo esc_html( $secondary_btn_txt ); ?>
						</a>
					<?php endif; ?>
				</div>

				<!-- Dynamic Slideshow Proof Strip -->
				<?php if ( ! empty( $proof_slides ) ) : ?>
					<div class="services-proof-strip" style="--total-slides: <?php echo esc_attr( $total_slides ); ?>; --slideshow-duration: <?php echo esc_attr( $total_duration ); ?>s;">
						<?php foreach ( $proof_slides as $index => $slide ) : ?>
							<?php
							$number     = ! empty( $slide['number'] ) ? $slide['number'] : sprintf( '%02d', $index + 1 );
							$slide_text = ! empty( $slide['text'] ) ? $slide['text'] : '';
							$delay      = $index * $seconds_per_slide;
							?>
							<span style="animation-delay: <?php echo esc_attr( $delay ); ?>s; animation-duration: <?php echo esc_attr( $total_duration ); ?>s;">
								<strong><?php echo esc_html( $number ); ?></strong>
								<?php echo esc_html( $slide_text ); ?>
							</span>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="home-hero-visual">
				<div class="home-deck-wrapper">
					<div class="home-deck-stack">
						<div class="home-deck-card is-active" role="region" aria-label="<?php esc_attr_e( 'Panel visual de una arquitectura web', 'chanodev' ); ?>">
							<div class="mockup-browser-header">
								<div class="terminal-dots">
									<span class="term-btn red"></span>
									<span class="term-btn yellow"></span>
									<span class="term-btn green"></span>
								</div>
								<strong class="mockup-url-bar"><?php echo esc_html( $window_title ); ?></strong>
							</div>

							<div class="mockup-body architecture-body">
								<div class="architecture-sidebar">
									<b><?php echo esc_html( $window_badge ); ?></b>
									<i></i><i></i><i></i>
								</div>
								<div class="architecture-content">
									<small><?php echo esc_html( $window_tag ); ?></small>
									<h2>
										<?php echo esc_html( $window_h2 ); ?><br>
										<em><?php echo esc_html( $window_h2_em ); ?></em>
									</h2>
									<div class="architecture-bars">
										<span></span><span></span><span></span>
									</div>
									<div class="architecture-status">
										<b><?php echo esc_html( $metric_1_val ); ?></b>
										<span><?php echo esc_html( $metric_1_lbl ); ?></span>
										<b><?php echo esc_html( $metric_2_val ); ?></b>
										<span><?php echo esc_html( $metric_2_lbl ); ?></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
