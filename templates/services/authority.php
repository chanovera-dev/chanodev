<?php
/**
 * Template part for displaying the Services Page Authority section
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- 4. Authority / Experience Section -->
<section class="block services-authority-section whiteprint-background">
	<div class="content">
		<div class="authority-panel" data-reveal="fade-up">
			<div class="authority-content" data-reveal="fade-right" style="--delay: 100ms;">
				<div class="authority-badge-row">
					<?php if ( ! empty( $auth_kicker ) ) : ?>
						<span class="sub-heading"><?php echo esc_html( $auth_kicker ); ?></span>
					<?php endif; ?>
					<span class="sub-heading green">
						<span class="status-pulse-dot"></span>
						<?php esc_html_e( 'Disponible para nuevos proyectos', 'chanodev' ); ?>
					</span>
				</div>

				<h2><?php echo esc_html( $auth_title ); ?></h2>
				<p class="authority-lead"><?php echo esc_html( $auth_text ); ?></p>
				<?php
				$tech_chips = array(
					array(
						'title' => 'WordPress Full-Stack',
						'desc'  => __( 'Temas FSE, bloques Gutenberg y plugins a medida', 'chanodev' ),
						'icon'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m16 18 6-6-6-6"/><path d="m8 6-6 6 6 6"/></svg>',
					),
					array(
						'title' => 'WooCommerce Avanzado',
						'desc'  => __( 'Flujos de checkout optimizados y pasarelas de pago', 'chanodev' ),
						'icon'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>',
					),
					array(
						'title' => 'React & Node.js',
						'desc'  => __( 'Headless CMS, APIs REST/GraphQL e interfaces reactivas', 'chanodev' ),
						'icon'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="12" rx="10" ry="4"/><ellipse cx="12" cy="12" rx="10" ry="4" transform="rotate(60 12 12)"/><ellipse cx="12" cy="12" rx="10" ry="4" transform="rotate(120 12 12)"/></svg>',
					),
					array(
						'title' => 'Core Web Vitals 100',
						'desc'  => __( 'LCP < 1.2s, INP excelente y cero Cumulative Layout Shift', 'chanodev' ),
						'icon'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"/></svg>',
					),
					array(
						'title' => 'Arquitectura Escalable',
						'desc'  => __( 'Código modular, buenas prácticas y mantenibilidad a largo plazo', 'chanodev' ),
						'icon'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>',
					),
				);
				$total_tech_chips   = count( $tech_chips );
				$tech_chip_duration = $total_tech_chips * 3;
				?>
				<div class="authority-tech-chips" style="--total-chips: <?php echo esc_attr( $total_tech_chips ); ?>; --chips-duration: <?php echo esc_attr( $tech_chip_duration ); ?>s;">
					<?php foreach ( $tech_chips as $index => $chip ) : ?>
						<?php $delay = $index * 3; ?>
						<span class="tech-chip-slide" style="animation-delay: <?php echo esc_attr( $delay ); ?>s; animation-duration: <?php echo esc_attr( $tech_chip_duration ); ?>s;">
							<span class="tech-chip-icon"><?php echo $chip['icon']; ?></span>
							<strong class="tech-chip-title"><?php echo esc_html( $chip['title'] ); ?></strong>
							<span class="tech-chip-separator">·</span>
							<span class="tech-chip-desc"><?php echo esc_html( $chip['desc'] ); ?></span>
						</span>
					<?php endforeach; ?>
				</div>

				<?php if ( ! empty( $auth_btn_txt ) ) : ?>
					<div class="authority-actions">
						<a class="btn hollow outline" href="<?php echo esc_url( $auth_btn_url ); ?>">
							<span><?php echo esc_html( $auth_btn_txt ); ?></span>
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
						</a>
					</div>
				<?php endif; ?>
			</div>

			<?php if ( ! empty( $auth_metrics ) ) : ?>
				<div class="authority-metrics-wrapper" data-reveal="fade-left" style="--delay: 200ms;">
					<div class="authority-metrics-carousel">
						<div class="authority-metrics-track hover-glow" id="authorityMetricsTrack">
							<?php
							$metric_svgs = array(
								'<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.9 5.8a2 2 0 0 1-1.3 1.3L3 12l5.8 1.9a2 2 0 0 1 1.3 1.3L12 21l1.9-5.8a2 2 0 0 1 1.3-1.3L21 12l-5.8-1.9a2 2 0 0 1-1.3-1.3L12 3Z"/></svg>',
								'<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"/></svg>',
								'<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
							);
							?>
							<?php foreach ( $auth_metrics as $index => $metric ) : ?>
								<?php
								$val      = ! empty( $metric['value'] ) ? $metric['value'] : '';
								$lbl      = ! empty( $metric['label'] ) ? $metric['label'] : '';
								$curr_svg = isset( $metric_svgs[ $index % count( $metric_svgs ) ] ) ? $metric_svgs[ $index % count( $metric_svgs ) ] : $metric_svgs[0];
								?>
								<div class="authority-metric-card<?php echo 0 === $index ? ' active' : ''; ?>" data-slide="<?php echo esc_attr( $index ); ?>">
									<div class="metric-top-bar">
										<span class="metric-badge"><?php printf( esc_html__( 'Métrica %02d', 'chanodev' ), $index + 1 ); ?></span>
										<span class="sub-heading"><?php echo $curr_svg; ?></span>
									</div>
									<strong><?php echo esc_html( $val ); ?></strong>
									<span><?php echo esc_html( $lbl ); ?></span>
								</div>
							<?php endforeach; ?>
						</div>

						<div class="authority-metrics-controls">
							<div class="carousel-dots" id="authDots">
								<?php foreach ( $auth_metrics as $index => $metric ) : ?>
									<button type="button" class="carousel-dot<?php echo 0 === $index ? ' active' : ''; ?>" data-slide="<?php echo esc_attr( $index ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Ir a métrica %d', 'chanodev' ), $index + 1 ) ); ?>"></button>
								<?php endforeach; ?>
							</div>
						</div>
					</div>

					<div class="authority-guarantee-card">
						<div class="guarantee-icon">
							<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
						</div>
						<div>
							<strong><?php esc_html_e( 'Compromiso de Calidad', 'chanodev' ); ?></strong>
							<p><?php esc_html_e( 'Código documentado, escalable y sin dependencias innecesarias.', 'chanodev' ); ?></p>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
