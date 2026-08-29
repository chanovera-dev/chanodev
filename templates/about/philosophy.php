<?php
/**
 * Template part for displaying the About Page Philosophy section
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- 5. Philosophy / Engineering Principles Section -->
<?php if ( ! empty( $philosophy_items ) ) : ?>
	<?php
	$default_philosophy_icons = array(
		'<svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>',
		'<svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>',
		'<svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83Z"/><path d="m22 17.65-9.17 4.16a2 2 0 0 1-1.66 0L2 17.65"/><path d="m22 12.65-9.17 4.16a2 2 0 0 1-1.66 0L2 12.65"/></svg>',
		'<svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>',
	);
	?>
	<section class="block about-philosophy-section">
		<div class="content">
			<div class="section-heading-center" data-reveal="fade-up">
				<?php if ( ! empty( $philosophy_kicker ) ) : ?>
					<span class="sub-heading"><?php echo esc_html( $philosophy_kicker ); ?></span>
				<?php endif; ?>
				<h2><?php echo esc_html( $philosophy_title ); ?></h2>
				<?php if ( ! empty( $philosophy_desc ) ) : ?>
					<p><?php echo esc_html( $philosophy_desc ); ?></p>
				<?php endif; ?>
			</div>

			<div class="philosophy-carousel-wrapper" data-reveal="fade-up" style="--delay: 150ms;">
				<!-- Slideshow Track -->
				<div class="philosophy-slideshow-track" id="philosophySlidesTrack" role="region" aria-roledescription="carousel" aria-label="<?php esc_attr_e( 'Principios y Filosofía Técnica', 'chanodev' ); ?>">
					<?php foreach ( $philosophy_items as $index => $item ) : ?>
						<?php
						$num       = ! empty( $item['number'] ) ? $item['number'] : sprintf( '%02d', $index + 1 );
						$pttl      = ! empty( $item['title'] ) ? $item['title'] : '';
						$ptxt      = ! empty( $item['text'] ) ? $item['text'] : '';
						$tag       = ! empty( $item['tag'] ) ? $item['tag'] : '';
						$quote     = ! empty( $item['quote'] ) ? $item['quote'] : '';
						$points    = ! empty( $item['points'] ) ? ( is_array( $item['points'] ) ? $item['points'] : explode( "\n", $item['points'] ) ) : array();
						$icon_code = ! empty( $item['icon'] ) ? $item['icon'] : $default_philosophy_icons[ $index % count( $default_philosophy_icons ) ];
						?>
						<article class="philosophy-slide-item<?php echo 0 === $index ? ' active' : ''; ?>" data-index="<?php echo esc_attr( $index ); ?>" role="group" aria-roledescription="slide" aria-label="<?php echo esc_attr( sprintf( __( 'Principio %s: %s', 'chanodev' ), $num, $pttl ) ); ?>">
							<div class="philosophy-slide-card">
								<!-- Visual / Identity Panel -->
								<div class="philosophy-visual-panel">
									<div class="philosophy-visual-ambient-orb" aria-hidden="true"></div>
									<span class="philosophy-watermark-num" aria-hidden="true"><?php echo esc_html( $num ); ?></span>

									<div class="philosophy-icon-container">
										<div class="philosophy-icon-ring"></div>
										<div class="philosophy-icon-svg-wrap">
											<?php echo $icon_code; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</div>
									</div>

									<div class="philosophy-badge-group">
										<span class="philosophy-step-pill"><?php printf( esc_html__( 'PRINCIPIO %s', 'chanodev' ), esc_html( $num ) ); ?></span>
										<?php if ( ! empty( $tag ) ) : ?>
											<span class="philosophy-tag-chip"><?php echo esc_html( $tag ); ?></span>
										<?php endif; ?>
									</div>
								</div>

								<!-- Content / Description Panel -->
								<div class="philosophy-content-panel">
									<div class="philosophy-content-header">
										<div class="philosophy-counter-row">
											<span class="sub-heading"><?php printf( esc_html__( '%02d / %02d', 'chanodev' ), $index + 1, count( $philosophy_items ) ); ?></span>
											<?php if ( ! empty( $tag ) ) : ?>
												<span class="philosophy-header-kicker"><?php echo esc_html( $tag ); ?></span>
											<?php endif; ?>
										</div>
										<h3 class="philosophy-card-title"><?php echo esc_html( $pttl ); ?></h3>
									</div>

									<p class="philosophy-card-desc"><?php echo esc_html( $ptxt ); ?></p>

									<?php if ( ! empty( $points ) ) : ?>
										<ul class="philosophy-key-points">
											<?php foreach ( $points as $point ) : ?>
												<?php $point_text = is_array( $point ) ? ( $point['text'] ?? '' ) : trim( $point ); ?>
												<?php if ( ! empty( $point_text ) ) : ?>
													<li>
														<span class="philosophy-check-badge" aria-hidden="true">
															<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
														</span>
														<span><?php echo esc_html( $point_text ); ?></span>
													</li>
												<?php endif; ?>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>

									<?php if ( ! empty( $quote ) ) : ?>
										<blockquote class="philosophy-quote-box">
											<div class="philosophy-quote-icon" aria-hidden="true">
												<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
											</div>
											<cite><?php echo esc_html( $quote ); ?></cite>
										</blockquote>
									<?php endif; ?>
								</div>
							</div>
						</article>
					<?php endforeach; ?>
				</div>

				<!-- Slideshow Controls -->
				<div class="philosophy-carousel-controls">
					<div class="slideshow-control-container inset-shadow-effect">
						<button type="button" class="slide-prev btn-pagination small-pagination slideshow-control carousel-nav-btn prev" id="philosophyPrevBtn" aria-label="<?php esc_attr_e( 'Principio anterior', 'chanodev' ); ?>">
							<?php echo function_exists( 'stories_get_svg' ) ? stories_get_svg( 'arrow-left-circle', array( 'size' => 18 ) ) : '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>'; ?>
						</button>
					</div>
					<div class="carousel-dots" id="philosophyDots">
						<?php foreach ( $philosophy_items as $index => $item ) : ?>
							<button type="button" class="carousel-dot<?php echo 0 === $index ? ' active' : ''; ?>" data-slide="<?php echo esc_attr( $index ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Ir a principio %d', 'chanodev' ), $index + 1 ) ); ?>"></button>
						<?php endforeach; ?>
					</div>
					<div class="slideshow-control-container inset-shadow-effect">
						<button type="button" class="slide-next btn-pagination small-pagination slideshow-control carousel-nav-btn next" id="philosophyNextBtn" aria-label="<?php esc_attr_e( 'Principio siguiente', 'chanodev' ); ?>">
							<?php echo function_exists( 'stories_get_svg' ) ? stories_get_svg( 'arrow-right-circle', array( 'size' => 18 ) ) : '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>'; ?>
						</button>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
