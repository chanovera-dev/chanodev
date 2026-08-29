<?php
/**
 * Template part for displaying the Services Page Method section
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- 3. Method / Process Section -->
<section class="block services-method-section">
	<div class="content">
		<div class="section-heading-center" data-reveal="fade-up">
			<?php if ( ! empty( $method_kicker ) ) : ?>
				<span class="sub-heading"><?php echo esc_html( $method_kicker ); ?></span>
			<?php endif; ?>
			<h2><?php echo esc_html( $method_title ); ?></h2>
			<?php if ( ! empty( $method_desc ) ) : ?>
				<p><?php echo esc_html( $method_desc ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( ! empty( $method_steps ) ) : ?>
			<div class="process-carousel-wrapper" data-reveal="fade-up" style="--delay: 150ms;">
				<div class="process-steps-track" id="processStepsTrack">
					<?php foreach ( $method_steps as $index => $step ) : ?>
						<?php
						$step_num  = ! empty( $step['step_number'] ) ? $step['step_number'] : sprintf( '%02d', $index + 1 );
						$step_ttl  = ! empty( $step['step_title'] ) ? $step['step_title'] : '';
						$step_desc = ! empty( $step['step_description'] ) ? $step['step_description'] : '';
						$step_img  = ! empty( $step['image'] ) ? ( is_array( $step['image'] ) ? $step['image']['url'] : $step['image'] ) : '';
						if ( empty( $step_img ) ) {
							$step_img = CHANODEV_URI . '/assets/images/step-' . ( ( $index % 4 ) + 1 ) . '-' . ( 0 === $index % 4 ? 'understand' : ( 1 === $index % 4 ? 'design' : ( 2 === $index % 4 ? 'build' : 'improve' ) ) ) . '-realistic.svg?v=1';
						}
						?>
						<div class="process-step-item<?php echo 0 === $index ? ' active' : ''; ?>" data-index="<?php echo esc_attr( $index ); ?>">
							<div class="process-step-visual">
								<?php
								$svg_content = '';

								// 1. If attachment ID or ACF array
								$img_id = is_array( $step['image'] ?? null ) ? ( $step['image']['id'] ?? 0 ) : ( is_numeric( $step['image'] ?? null ) ? (int) $step['image'] : 0 );
								if ( $img_id ) {
									$attached_file = get_attached_file( $img_id );
									if ( $attached_file && file_exists( $attached_file ) && 'svg' === pathinfo( $attached_file, PATHINFO_EXTENSION ) ) {
										$svg_content = file_get_contents( $attached_file );
									}
								}

								// 2. If theme relative URL/path
								if ( empty( $svg_content ) && ! empty( $step_img ) ) {
									$theme_relative = str_replace( CHANODEV_URI, get_stylesheet_directory(), strtok( $step_img, '?' ) );
									if ( file_exists( $theme_relative ) && 'svg' === pathinfo( $theme_relative, PATHINFO_EXTENSION ) ) {
										$svg_content = file_get_contents( $theme_relative );
									}
								}

								// 3. Fallback direct to theme SVG files
								if ( empty( $svg_content ) ) {
									$step_slug     = 0 === $index % 4 ? 'understand' : ( 1 === $index % 4 ? 'design' : ( 2 === $index % 4 ? 'build' : 'improve' ) );
									$step_svg_path = get_stylesheet_directory() . '/assets/images/step-' . ( ( $index % 4 ) + 1 ) . '-' . $step_slug . '-realistic.svg';
									if ( file_exists( $step_svg_path ) ) {
										$svg_content = file_get_contents( $step_svg_path );
									}
								}

								if ( ! empty( $svg_content ) ) {
									echo $svg_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								}
								?>
							</div>
							<div class="process-step-content">
								<div class="process-step-header">
									<span class="sub-heading"><?php echo esc_html( $step_num ); ?></span>
									<h3><?php echo esc_html( $step_ttl ); ?></h3>
								</div>
								<p><?php echo esc_html( $step_desc ); ?></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="process-carousel-controls">
					<div class="slideshow-control-container inset-shadow-effect">
						<button type="button" class="slide-prev btn-pagination small-pagination slideshow-control carousel-nav-btn prev" id="processPrevBtn" aria-label="<?php esc_attr_e( 'Paso anterior', 'chanodev' ); ?>">
							<?php echo function_exists( 'stories_get_svg' ) ? stories_get_svg( 'arrow-left-circle', array( 'size' => 18 ) ) : '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>'; ?>
						</button>
					</div>
					<div class="carousel-dots" id="processDots">
						<?php foreach ( $method_steps as $index => $step ) : ?>
							<button type="button" class="carousel-dot<?php echo 0 === $index ? ' active' : ''; ?>" data-slide="<?php echo esc_attr( $index ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Ir al paso %d', 'chanodev' ), $index + 1 ) ); ?>"></button>
						<?php endforeach; ?>
					</div>
					<div class="slideshow-control-container inset-shadow-effect">
						<button type="button" class="slide-next btn-pagination small-pagination slideshow-control carousel-nav-btn next" id="processNextBtn" aria-label="<?php esc_attr_e( 'Paso siguiente', 'chanodev' ); ?>">
							<?php echo function_exists( 'stories_get_svg' ) ? stories_get_svg( 'arrow-right-circle', array( 'size' => 18 ) ) : '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>'; ?>
						</button>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>
