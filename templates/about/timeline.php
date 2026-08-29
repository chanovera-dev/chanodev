<?php
/**
 * Template part for displaying the About Page Timeline section
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- 4. Timeline / Journey Section -->
<?php if ( ! empty( $timeline_milestones ) ) : ?>
	<section class="block about-timeline-section">
		<div class="content">
			<div class="section-heading-center" data-reveal="fade-up">
				<div>
					<?php if ( ! empty( $timeline_kicker ) ) : ?>
						<span class="sub-heading"><?php echo esc_html( $timeline_kicker ); ?></span>
					<?php endif; ?>
					<h2><?php echo esc_html( $timeline_title ); ?></h2>
				</div>
				<?php if ( ! empty( $timeline_desc ) ) : ?>
					<p><?php echo esc_html( $timeline_desc ); ?></p>
				<?php endif; ?>
			</div>

			<!-- 3D Timeline Cascading Slideshow -->
			<div class="timeline-3d-showcase" data-reveal="fade-up">

				<!-- Left: Stepper Navigation & Timeline Tracker -->
				<div class="timeline-nav-stepper" role="tablist" aria-label="<?php esc_attr_e( 'Hitos de la trayectoria', 'chanodev' ); ?>">
					<div class="timeline-stepper-progress-rail">
						<div class="timeline-stepper-progress-bar"></div>
					</div>
					<?php foreach ( $timeline_milestones as $index => $item ) : ?>
						<?php
						$period     = ! empty( $item['period'] ) ? $item['period'] : '';
						$mtitle     = ! empty( $item['title'] ) ? $item['title'] : '';
						$mtag       = ! empty( $item['tag'] ) ? $item['tag'] : '';
						$is_current = ( false !== stripos( $period, 'actualidad' ) || false !== stripos( $period, 'present' ) );
						$step_num   = str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT );
						?>
						<button type="button"
								class="timeline-step-btn <?php echo ( 0 === $index ) ? 'is-active' : ''; ?> <?php echo $is_current ? 'is-current' : ''; ?>"
								data-timeline-index="<?php echo esc_attr( $index ); ?>"
								role="tab"
								aria-selected="<?php echo ( 0 === $index ) ? 'true' : 'false'; ?>">
							<span class="step-node-badge">
								<span class="step-node-num"><?php echo esc_html( $step_num ); ?></span>
								<?php if ( $is_current ) : ?>
									<span class="timeline-beacon-ring"></span>
								<?php endif; ?>
							</span>
							<span class="step-meta">
								<span class="step-period"><?php echo esc_html( $period ); ?></span>
								<span class="step-title"><?php echo esc_html( $mtitle ); ?></span>
							</span>
						</button>
					<?php endforeach; ?>
					
					<!-- Controls toolbar inside stepper column -->
					<div class="timeline-controls-bar">
						<button type="button" class="timeline-ctrl-btn timeline-prev-btn" aria-label="<?php esc_attr_e( 'Hito anterior', 'chanodev' ); ?>">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
						</button>

						<div class="timeline-autoplay-indicator" title="<?php esc_attr_e( 'Reproducción automática', 'chanodev' ); ?>">
							<button type="button" class="timeline-play-toggle" aria-label="<?php esc_attr_e( 'Pausar/Reanudar', 'chanodev' ); ?>">
								<span class="play-icon">▶</span>
								<span class="pause-icon">❚❚</span>
							</button>
							<div class="timeline-autoplay-bar">
								<div class="timeline-autoplay-fill"></div>
							</div>
						</div>

						<button type="button" class="timeline-ctrl-btn timeline-next-btn" aria-label="<?php esc_attr_e( 'Siguiente hito', 'chanodev' ); ?>">
							<span><?php esc_html_e( 'Siguiente', 'chanodev' ); ?></span>
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
						</button>
					</div>
				</div>

				<!-- Right/Center: 3D Stage with Falling Card Stack -->
				<div class="timeline-stage-wrapper">
					<div class="timeline-3d-stage">
						<?php foreach ( $timeline_milestones as $index => $item ) : ?>
							<?php
							$period      = ! empty( $item['period'] ) ? $item['period'] : '';
							$mtitle      = ! empty( $item['title'] ) ? $item['title'] : '';
							$mtext       = ! empty( $item['text'] ) ? $item['text'] : '';
							$mtag        = ! empty( $item['tag'] ) ? $item['tag'] : '';
							$is_current  = ( false !== stripos( $period, 'actualidad' ) || false !== stripos( $period, 'present' ) );
							$step_num    = str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT );
							$state_class = ( 0 === $index ) ? 'is-active' : 'is-stacked';
							?>
							<article class="timeline-3d-card <?php echo esc_attr( $state_class ); ?> <?php echo $is_current ? 'is-current' : ''; ?>"
									 data-card-index="<?php echo esc_attr( $index ); ?>"
									 style="--card-index: <?php echo esc_attr( $index ); ?>;">
								
								<!-- Front face (visible when upright in deck) -->
								<div class="timeline-card-front hover-glow">
									<span class="timeline-card-watermark" aria-hidden="true"><?php echo esc_html( $step_num ); ?></span>

									<div class="timeline-card-header">
										<div class="timeline-meta-row">
											<span class="sub-heading timeline">
												<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
												<?php echo esc_html( $period ); ?>
											</span>
											<?php if ( $is_current ) : ?>
												<span class="sub-heading green">
													<span class="status-pulse-dot"></span>
													<?php esc_html_e( 'En curso', 'chanodev' ); ?>
												</span>
											<?php endif; ?>
											<?php if ( ! empty( $mtag ) ) : ?>
												<span class="transparent-tag full-size"><?php echo esc_html( $mtag ); ?></span>
											<?php endif; ?>
										</div>
										<span class="transparent-tag full-size"><?php echo esc_html( $step_num ); ?> / <?php echo esc_html( str_pad( (string) count( $timeline_milestones ), 2, '0', STR_PAD_LEFT ) ); ?></span>
									</div>

									<div class="timeline-card-body">
										<h3><?php echo esc_html( $mtitle ); ?></h3>
										<p><?php echo esc_html( $mtext ); ?></p>
									</div>

									<div class="timeline-card-footer">
										<div class="sub-heading">
											<span class="status-pulse-dot"></span>
											<span><?php esc_html_e( 'Hito', 'chanodev' ); ?> <?php echo esc_html( $step_num ); ?></span>
										</div>
										<button type="button" class="btn sub-heading timeline" aria-label="<?php esc_attr_e( 'Pasar al siguiente hito', 'chanodev' ); ?>">
											<span><?php esc_html_e( 'Deslizar', 'chanodev' ); ?></span>
											<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><polyline points="19 12 12 19 5 12"></polyline></svg>
										</button>
									</div>
								</div>

								<!-- Back face (visible when fallen face-down onto the table) -->
								<div class="timeline-card-back" aria-hidden="true">
									<div class="card-back-pattern"></div>
									<div class="card-back-inner-frame">
										<div class="card-back-corner top-left">#<?php echo esc_html( $step_num ); ?></div>
										<div class="card-back-corner top-right">&lt;/&gt;</div>
										<div class="card-back-center-emblem">
											<span class="card-back-logo">&lt;chano.dev/&gt;</span>
											<span class="card-back-year"><?php echo esc_html( $period ); ?></span>
											<span class="card-back-title"><?php echo esc_html( $mtitle ); ?></span>
										</div>
										<div class="card-back-corner bottom-left">&lt;/&gt;</div>
										<div class="card-back-corner bottom-right">#<?php echo esc_html( $step_num ); ?></div>
									</div>
								</div>
							</article>
						<?php endforeach; ?>
					</div>
				</div>

			</div>
		</div>
	</section>
<?php endif; ?>
