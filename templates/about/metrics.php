<?php
/**
 * Template part for displaying the About Page Metrics section
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- 2. Metrics / Impact Slideshow Section -->
<?php if ( ! empty( $about_metrics ) ) : ?>
	<section class="block about-metrics-section whiteprint-background">
		<div class="content">
			<div class="section-heading-center" data-reveal="fade-up">
				<?php if ( ! empty( $metrics_kicker ) ) : ?>
					<span class="sub-heading"><?php echo esc_html( $metrics_kicker ); ?></span>
				<?php endif; ?>
				<h2><?php echo esc_html( $metrics_title ); ?></h2>
				<?php if ( ! empty( $metrics_desc ) ) : ?>
					<p><?php echo esc_html( $metrics_desc ); ?></p>
				<?php endif; ?>
			</div>

			<div class="process-carousel-wrapper" data-reveal="fade-up" style="--delay: 150ms;">
				<div class="process-steps-track" id="aboutMetricsTrack">
					<?php foreach ( $about_metrics as $index => $metric ) : ?>
						<?php
						$step_num   = ! empty( $metric['number'] ) ? $metric['number'] : sprintf( '%02d', $index + 1 );
						$step_val   = ! empty( $metric['value'] ) ? $metric['value'] : '';
						$step_lbl   = ! empty( $metric['label'] ) ? $metric['label'] : '';
						$step_kck   = ! empty( $metric['kicker'] ) ? $metric['kicker'] : '';
						$step_desc  = ! empty( $metric['desc'] ) ? $metric['desc'] : '';
						$highlights = ! empty( $metric['highlights'] ) ? ( is_array( $metric['highlights'] ) ? $metric['highlights'] : explode( "\n", $metric['highlights'] ) ) : array();

						$metric_photos = array(
							CHANODEV_URI . '/assets/images/metric-1-custom-code.jpg',
							CHANODEV_URI . '/assets/images/metric-2-speed.jpg',
							CHANODEV_URI . '/assets/images/metric-3-experience.jpg',
							CHANODEV_URI . '/assets/images/metric-4-collaboration.jpg',
						);
						$photo_url = ! empty( $metric['image'] ) ? ( is_array( $metric['image'] ) ? $metric['image']['url'] : $metric['image'] ) : $metric_photos[ $index % count( $metric_photos ) ];

						$metric_icons = array(
							// 01: Code / Architecture
							'<svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>',
							// 02: Speedometer / CWV
							'<svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v4"/><path d="m4.93 4.93 2.83 2.83"/><path d="M2 12h4"/><path d="m4.93 19.07 2.83-2.83"/><path d="M12 22v-4"/><path d="m19.07 19.07-2.83-2.83"/><path d="M22 12h-4"/><path d="m19.07 4.93-2.83 2.83"/><circle cx="12" cy="12" r="4"/></svg>',
							// 03: Experience / Roadmap
							'<svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
							// 04: 1:1 Direct Bridge
							'<svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
						);
						$icon_svg = isset( $metric_icons[ $index % count( $metric_icons ) ] ) ? $metric_icons[ $index % count( $metric_icons ) ] : $metric_icons[0];
						?>
						<div class="process-step-item about-metric-step<?php echo 0 === $index ? ' active' : ''; ?>" data-index="<?php echo esc_attr( $index ); ?>">
							<div class="process-step-visual about-metric-visual">
								<img src="<?php echo esc_url( $photo_url ); ?>" alt="<?php echo esc_attr( $step_lbl ); ?>" class="metric-bg-photo" loading="lazy" width="768" height="432" />
								<div class="metric-slide-blueprint">
									<div class="metric-slide-top-bar">
										<span class="sub-heading"><?php echo esc_html( $step_kck ); ?></span>
										<span class="metric-slide-step-badge"><?php printf( esc_html__( 'MÉTRICA %s', 'chanodev' ), esc_html( $step_num ) ); ?></span>
									</div>
									<div class="metric-slide-main-figure">
										<div class="metric-slide-icon-halo">
											<?php echo $icon_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</div>
										<div class="metric-slide-text-group">
											<strong class="metric-slide-big-value"><?php echo esc_html( $step_val ); ?></strong>
											<span class="metric-slide-sub-title"><?php echo esc_html( $step_lbl ); ?></span>
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
									<h3><?php echo esc_html( $step_lbl ); ?></h3>
								</div>
								<p><?php echo esc_html( $step_desc ); ?></p>
								<?php if ( ! empty( $highlights ) ) : ?>
									<ul class="about-metric-highlights">
										<?php foreach ( $highlights as $hl ) : ?>
											<?php $hl_txt = is_array( $hl ) ? ( $hl['text'] ?? '' ) : trim( $hl ); ?>
											<?php if ( ! empty( $hl_txt ) ) : ?>
												<li>
													<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
													<span><?php echo esc_html( $hl_txt ); ?></span>
												</li>
											<?php endif; ?>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="process-carousel-controls">
					<div class="slideshow-control-container inset-shadow-effect">
						<button type="button" class="slide-prev btn-pagination small-pagination slideshow-control carousel-nav-btn prev" id="aboutMetricsPrevBtn" aria-label="<?php esc_attr_e( 'Métrica anterior', 'chanodev' ); ?>">
							<?php echo function_exists( 'stories_get_svg' ) ? stories_get_svg( 'arrow-left-circle', array( 'size' => 18 ) ) : '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>'; ?>
						</button>
					</div>
					<div class="carousel-dots" id="aboutMetricsDots">
						<?php foreach ( $about_metrics as $index => $metric ) : ?>
							<button type="button" class="carousel-dot<?php echo 0 === $index ? ' active' : ''; ?>" data-slide="<?php echo esc_attr( $index ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Ir a métrica %d', 'chanodev' ), $index + 1 ) ); ?>"></button>
						<?php endforeach; ?>
					</div>
					<div class="slideshow-control-container inset-shadow-effect">
						<button type="button" class="slide-next btn-pagination small-pagination slideshow-control carousel-nav-btn next" id="aboutMetricsNextBtn" aria-label="<?php esc_attr_e( 'Métrica siguiente', 'chanodev' ); ?>">
							<?php echo function_exists( 'stories_get_svg' ) ? stories_get_svg( 'arrow-right-circle', array( 'size' => 18 ) ) : '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>'; ?>
						</button>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
