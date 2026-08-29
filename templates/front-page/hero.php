<?php
/**
 * Template part for displaying the Front Page Hero section
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<!-- 1. Hero Section -->
	<section class="block home-hero-block">
		<div class="content">
			<div class="home-hero-grid">
				<div class="home-hero-text">
					<div class="home-hero-badge-row">
						<?php if ( ! empty( $hero_status_txt ) ) : ?>
							<div class="sub-heading">
								<span class="status-pulse-dot" aria-hidden="true"></span>
								<span><?php echo esc_html( $hero_status_txt ); ?></span>
							</div>
						<?php endif; ?>
					</div>

					<h1 class="hero-headline">
						<?php echo esc_html( $hero_headline ); ?>
					</h1>

					<p class="hero-subheadline">
						<?php echo esc_html( $hero_subheadline ); ?>
					</p>

					<div class="hero-actions">
						<?php if ( ! empty( $hero_primary_txt ) ) : ?>
							<a href="<?php echo esc_url( $hero_primary_url ); ?>" class="btn primary">
								<span><?php echo esc_html( $hero_primary_txt ); ?></span>
								<?php if ( function_exists( 'stories_svg' ) ) : ?>
									<?php stories_svg( 'arrow-right-circle' ); ?>
								<?php endif; ?>
							</a>
						<?php endif; ?>

						<?php if ( ! empty( $hero_secondary_txt ) ) : ?>
							<a href="<?php echo esc_url( $hero_secondary_url ); ?>" class="btn hollow outline">
								<span><?php echo esc_html( $hero_secondary_txt ); ?></span>
							</a>
						<?php endif; ?>
					</div>

					<!-- Key Metrics Slideshow -->
					<?php if ( ! empty( $hero_metrics ) ) : ?>
						<div class="home-hero-metrics-carousel" id="homeMetricsCarousel" role="region" aria-roledescription="carousel" aria-label="<?php esc_attr_e( 'Métricas clave de ingeniería', 'chanodev' ); ?>">
							<div class="home-hero-metrics-track" id="homeMetricsTrack" role="tablist" aria-label="<?php esc_attr_e( 'Métricas clave de ingeniería', 'chanodev' ); ?>">
								<?php foreach ( $hero_metrics as $index => $metric ) : ?>
									<?php
									$mnum   = is_array( $metric ) ? ( $metric['num'] ?? ( $metric['value'] ?? '' ) ) : '';
									$mdsc   = is_array( $metric ) ? ( $metric['desc'] ?? ( $metric['label'] ?? '' ) ) : '';
									$mkck   = is_array( $metric ) ? ( $metric['kicker'] ?? '' ) : '';
									$mtxt   = is_array( $metric ) ? ( $metric['text'] ?? '' ) : '';
									$micon  = is_array( $metric ) ? ( $metric['icon'] ?? '' ) : '';
									?>
									<?php if ( ! empty( $mnum ) ) : ?>
										<div class="home-metric-slide<?php echo 0 === $index ? ' active' : ''; ?>" data-slide="<?php echo esc_attr( $index ); ?>" role="tab" tabindex="<?php echo 0 === $index ? '0' : '-1'; ?>" aria-selected="<?php echo 0 === $index ? 'true' : 'false'; ?>" aria-label="<?php printf( esc_attr__( 'Ver métrica %d: %s %s', 'chanodev' ), $index + 1, esc_attr( $mnum ), esc_attr( $mdsc ) ); ?>">
											<div class="home-metric-slide-card">
												<div class="home-metric-slide-top">
													<?php if ( ! empty( $mkck ) ) : ?>
														<span class="sub-heading"><?php echo esc_html( $mkck ); ?></span>
													<?php else : ?>
														<span class="sub-heading"><?php printf( esc_html__( 'MÉTRICA %02d', 'chanodev' ), $index + 1 ); ?></span>
													<?php endif; ?>
													<?php if ( ! empty( $micon ) ) : ?>
														<div class="sub-heading" aria-hidden="true">
															<?php echo $micon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
														</div>
													<?php endif; ?>
												</div>
												<div class="home-metric-slide-body">
													<strong class="home-metric-slide-num"><?php echo esc_html( $mnum ); ?></strong>
													<div class="home-metric-slide-info">
														<span class="home-metric-slide-desc"><?php echo esc_html( $mdsc ); ?></span>
														<?php if ( ! empty( $mtxt ) ) : ?>
															<p><?php echo esc_html( $mtxt ); ?></p>
														<?php endif; ?>
													</div>
												</div>
											</div>
										</div>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>
				</div>

				<div class="home-hero-visual">
					<!-- 3D Card Stack Container -->
					<div class="home-deck-wrapper" id="homeHeroDeck">
						<div class="home-deck-stack" id="homeDeckStack" aria-label="<?php esc_attr_e( 'Mazo de demostración interactivo', 'chanodev' ); ?>">
							<!-- Card 1: Architecture & Clean Code Window -->
							<div class="home-deck-card home-mockup-window home-arch-window is-active" data-deck-index="0" role="tabpanel" aria-label="<?php esc_attr_e( 'Ventana interactiva de Arquitectura Limpia y Código Modular', 'chanodev' ); ?>">
								<div class="mockup-browser-header">
									<div class="terminal-dots">
										<span class="term-btn red"></span>
										<span class="term-btn yellow"></span>
										<span class="term-btn green"></span>
									</div>
									<div class="mockup-url-bar">
										<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83Z"/><path d="m22 17.65-9.17 4.16a2 2 0 0 1-1.66 0L2 17.65"/><path d="m22 12.65-9.17 4.16a2 2 0 0 1-1.66 0L2 12.65"/></svg>
										<span>https://<?php echo esc_html( $arch_window_url ); ?></span>
									</div>
									<span class="mockup-pill-badge arch-badge">
										<span class="status-pulse-dot green" aria-hidden="true"></span>
										<?php echo esc_html( $arch_badge_txt ); ?>
									</span>
								</div>

								<div class="mockup-body mockup-arch-body">
									<!-- Architecture Title Header -->
									<div class="arch-header-row">
										<div class="arch-brand-title">
											<div class="arch-icon-cube" aria-hidden="true">
												<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect width="8" height="8" x="3" y="3" rx="2"/><rect width="8" height="8" x="13" y="3" rx="2"/><rect width="8" height="8" x="3" y="13" rx="2"/><rect width="8" height="8" x="13" y="13" rx="2"/></svg>
											</div>
											<div>
												<span class="arch-brand-heading"><?php echo esc_html( $arch_heading ); ?></span>
												<span class="arch-sub-tag">🟢 <?php echo esc_html( $arch_subheading ); ?></span>
											</div>
										</div>
										<span class="arch-version-chip">v3.0 Strict</span>
									</div>

									<!-- Architecture Layer Stack (3 Modular Layers) -->
									<div class="arch-layers-stack">
										<!-- Layer 1: Presentation / UI Layer -->
										<div class="arch-layer-item">
											<div class="layer-header">
												<div class="layer-meta">
													<span class="layer-num">01</span>
													<strong class="layer-name"><?php esc_html_e( 'Capa Frontend & Componentes UI', 'chanodev' ); ?></strong>
												</div>
												<span class="layer-tag cyan">60 FPS</span>
											</div>
											<div class="layer-chips">
												<span>Vanilla ES6+</span>
												<span>CSS Grid & Tokens</span>
												<span>Zero Dependencias</span>
											</div>
										</div>

										<!-- Layer 2: Core Domain & Backend -->
										<div class="arch-layer-item highlight">
											<div class="layer-header">
												<div class="layer-meta">
													<span class="layer-num">02</span>
													<strong class="layer-name"><?php esc_html_e( 'Capa de Dominio & Backend PHP', 'chanodev' ); ?></strong>
												</div>
												<span class="layer-tag green"><?php esc_html_e( 'Zero Bloat', 'chanodev' ); ?></span>
											</div>
											<div class="layer-chips">
												<span>PHP 8 Strict Types</span>
												<span>REST API & Hooks</span>
												<span>Gutenberg FSE</span>
											</div>
										</div>

										<!-- Layer 3: Performance & Infrastructure -->
										<div class="arch-layer-item">
											<div class="layer-header">
												<div class="layer-meta">
													<span class="layer-num">03</span>
													<strong class="layer-name"><?php esc_html_e( 'Infraestructura & Optimización', 'chanodev' ); ?></strong>
												</div>
												<span class="layer-tag purple">Edge</span>
											</div>
											<div class="layer-chips">
												<span>Redis Object Cache</span>
												<span>Schema JSON-LD</span>
												<span>HTTP/3 Native</span>
											</div>
										</div>
									</div>

									<!-- Bottom Architecture Quality Indicators -->
									<div class="arch-footer-strip">
										<div class="arch-kpi-pill highlight">
											<strong><?php echo esc_html( $arch_metric_1_val ); ?></strong>
											<span><?php echo esc_html( $arch_metric_1_lbl ); ?></span>
										</div>
										<div class="arch-kpi-pill">
											<strong><?php echo esc_html( $arch_metric_2_val ); ?></strong>
											<span><?php echo esc_html( $arch_metric_2_lbl ); ?></span>
										</div>
										<div class="arch-kpi-pill">
											<strong>0%</strong>
											<span><?php esc_html_e( 'Deuda Técnica', 'chanodev' ); ?></span>
										</div>
									</div>
								</div>
							</div>

							<!-- Card 2: Performance & Core Web Vitals Window -->
							<div class="home-deck-card home-mockup-window home-perf-window is-next" data-deck-index="1" role="tabpanel" aria-label="<?php esc_attr_e( 'Ventana interactiva de Rendimiento PageSpeed y Core Web Vitals', 'chanodev' ); ?>">
								<div class="mockup-browser-header">
									<div class="terminal-dots">
										<span class="term-btn red"></span>
										<span class="term-btn yellow"></span>
										<span class="term-btn green"></span>
									</div>
									<div class="mockup-url-bar">
										<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 14 4-4"/><path d="M3.34 19a10 10 0 1 1 17.32 0"/><circle cx="12" cy="14" r="1.5"/></svg>
										<span>https://<?php echo esc_html( $perf_window_url ); ?></span>
									</div>
									<span class="mockup-pill-badge perf-badge">
										<span class="status-pulse-dot" aria-hidden="true"></span>
										<?php echo esc_html( $perf_badge_txt ); ?>
									</span>
								</div>

								<div class="mockup-body mockup-perf-body">
									<div class="mockup-perf-banner">
										<div class="perf-score-meter">
											<svg class="perf-ring-svg" viewBox="0 0 36 36" aria-hidden="true">
												<path class="perf-ring-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
												<path class="perf-ring-val" stroke-dasharray="100, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
											</svg>
											<strong class="perf-score-num"><?php echo esc_html( $perf_score_val ); ?></strong>
										</div>
										<div class="perf-banner-info">
											<div class="perf-kicker-tag"><?php esc_html_e( 'Google PageSpeed Insights', 'chanodev' ); ?></div>
											<span class="perf-banner-heading"><?php echo esc_html( $perf_heading ); ?></span>
											<p><?php echo esc_html( $perf_subheading ); ?></p>
										</div>
									</div>

									<div class="mockup-perf-metrics-grid">
										<div class="perf-metric-box highlight">
											<div class="perf-metric-top">
												<span class="metric-dot green" aria-hidden="true"></span>
												<span class="metric-lbl">LCP (Carga)</span>
											</div>
											<strong class="metric-val"><?php echo esc_html( $perf_lcp_val ); ?></strong>
											<small class="metric-sub"><?php esc_html_e( 'Instantáneo · Bueno', 'chanodev' ); ?></small>
										</div>
										<div class="perf-metric-box">
											<div class="perf-metric-top">
												<span class="metric-dot green" aria-hidden="true"></span>
												<span class="metric-lbl">INP (Respuesta)</span>
											</div>
											<strong class="metric-val"><?php echo esc_html( $perf_inp_val ); ?></strong>
											<small class="metric-sub"><?php esc_html_e( 'Sin retraso · Bueno', 'chanodev' ); ?></small>
										</div>
										<div class="perf-metric-box">
											<div class="perf-metric-top">
												<span class="metric-dot green" aria-hidden="true"></span>
												<span class="metric-lbl">CLS (Estabilidad)</span>
											</div>
											<strong class="metric-val"><?php echo esc_html( $perf_cls_val ); ?></strong>
											<small class="metric-sub"><?php esc_html_e( 'Zero Desplazamiento', 'chanodev' ); ?></small>
										</div>
										<div class="perf-metric-box">
											<div class="perf-metric-top">
												<span class="metric-dot green" aria-hidden="true"></span>
												<span class="metric-lbl">TTFB (Servidor)</span>
											</div>
											<strong class="metric-val"><?php echo esc_html( $perf_ttfb_val ); ?></strong>
											<small class="metric-sub"><?php esc_html_e( 'Edge Cache · Rápido', 'chanodev' ); ?></small>
										</div>
									</div>

									<div class="perf-footer-strip">
										<span class="perf-feature-pill">
											<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5" aria-hidden="true"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
											<?php esc_html_e( 'HTTP/3 + Brotli', 'chanodev' ); ?>
										</span>
										<span class="perf-feature-pill">
											<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
											<?php esc_html_e( 'Zero Bloatware', 'chanodev' ); ?>
										</span>
										<span class="perf-feature-pill">
											<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5" aria-hidden="true"><rect width="18" height="18" x="3" y="3" rx="2"/><line x1="3" x2="21" y1="9" y2="9"/><line x1="9" x2="9" y1="21" y2="9"/></svg>
											<?php esc_html_e( 'Redis Cache L1/L2', 'chanodev' ); ?>
										</span>
									</div>
								</div>
							</div>

							<!-- Card 3: E-Commerce WooCommerce Mockup Window -->
							<div class="home-deck-card home-mockup-window is-prev" data-deck-index="2" role="tabpanel" aria-label="<?php esc_attr_e( 'Ventana interactiva de Tienda Digital WooCommerce', 'chanodev' ); ?>">
								<div class="mockup-browser-header">
									<div class="terminal-dots">
										<span class="term-btn red"></span>
										<span class="term-btn yellow"></span>
										<span class="term-btn green"></span>
									</div>
									<div class="mockup-url-bar">
										<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
										<span>https://<?php echo esc_html( $ecom_window_url ); ?></span>
									</div>
									<span class="mockup-pill-badge ecom-badge"><?php echo esc_html( $ecom_badge_txt ); ?></span>
								</div>
								<div class="mockup-body mockup-ecommerce-body">
									<!-- Mini Store Navigation Bar -->
									<div class="ecom-store-nav">
										<div class="ecom-store-brand">
											<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2 2 7l10 5 10-5-10-5Z"/><path d="m2 17 10 5 10-5"/><path d="m2 12 10 5 10-5"/></svg>
											<strong><?php echo esc_html( $ecom_store_name ); ?></strong>
										</div>
										<div class="ecom-store-categories">
											<span class="active"><?php esc_html_e( 'Temas FSE', 'chanodev' ); ?></span>
											<span><?php esc_html_e( 'Plugins', 'chanodev' ); ?></span>
											<span><?php esc_html_e( 'Starter Kits', 'chanodev' ); ?></span>
										</div>
										<div class="ecom-mini-cart">
											<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><line x1="3" x2="21" y1="6" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
											<span class="ecom-cart-count">1</span>
										</div>
									</div>

									<!-- Product Showcase Card -->
									<div class="ecom-product-showcase">
										<div class="ecom-product-visual">
											<span class="ecom-sale-chip">-30%</span>
											<div class="ecom-prod-icon-box" aria-hidden="true">
												<svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M7 8h10M7 12h4m-4 4h7"/></svg>
											</div>
											<div class="ecom-stock-badge">🟢 <?php esc_html_e( 'Descarga Inmediata', 'chanodev' ); ?></div>
										</div>
										<div class="ecom-product-details">
											<div class="ecom-rating-row">
												<span class="ecom-stars">★★★★★</span>
												<small>5.0 (68 devs)</small>
											</div>
											<span class="ecom-prod-heading"><?php echo esc_html( $ecom_prod_name ); ?></span>
											<div class="ecom-price-row">
												<strong class="ecom-price"><?php echo esc_html( $ecom_prod_price ); ?></strong>
												<span class="ecom-old-price"><?php echo esc_html( $ecom_prod_oldprice ); ?></span>
											</div>
											<button type="button" class="ecom-quick-buy-btn" aria-label="<?php echo esc_attr( sprintf( __( 'Comprar licencia de %s por %s', 'chanodev' ), $ecom_prod_name, $ecom_prod_price ) ); ?>">
												<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
												<span><?php esc_html_e( 'Comprar Licencia', 'chanodev' ); ?></span>
											</button>
										</div>
									</div>

									<!-- Bottom Store Performance & Conversion Strip -->
									<div class="ecom-store-stats-strip">
										<div class="ecom-stat-item">
											<strong><?php echo esc_html( $ecom_lcp_val ); ?></strong>
											<span><?php esc_html_e( 'LCP Checkout', 'chanodev' ); ?></span>
										</div>
										<div class="ecom-stat-item highlight">
											<strong><?php echo esc_html( $ecom_growth_val ); ?></strong>
											<span><?php esc_html_e( 'Conversión Móvil', 'chanodev' ); ?></span>
										</div>
										<div class="ecom-stat-item">
											<strong>Stripe / Apple Pay</strong>
											<span><?php esc_html_e( 'Nativo en 1 Paso', 'chanodev' ); ?></span>
										</div>
									</div>
								</div>
							</div>

							<!-- Card 4: React & Node.js Analytics Dashboard Mockup Window -->
							<div class="home-deck-card home-mockup-window is-stacked" data-deck-index="3" role="tabpanel" aria-label="<?php esc_attr_e( 'Ventana interactiva de Dashboard de Analítica Web en Tiempo Real', 'chanodev' ); ?>">
								<div class="mockup-browser-header">
									<div class="terminal-dots">
										<span class="term-btn red"></span>
										<span class="term-btn yellow"></span>
										<span class="term-btn green"></span>
									</div>
									<div class="mockup-url-bar">
										<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>
										<span>https://<?php echo esc_html( $app_window_url ); ?></span>
									</div>
									<span class="mockup-pill-badge react-badge">
										<span class="status-pulse-dot cyan" aria-hidden="true"></span>
										<?php echo esc_html( $app_badge_txt ); ?>
									</span>
								</div>
								<div class="mockup-body mockup-analytics-body">
									<!-- Analytics Top Nav & Live Counter -->
									<div class="analytics-header-row">
										<div class="analytics-brand-box">
											<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 20V10M18 20V4M6 20v-4"/></svg>
											<strong>CHANO ANALYTICS</strong>
											<span class="analytics-live-chip">
												<span class="status-pulse-dot green"></span>
												<b>342</b> <?php esc_html_e( 'en vivo', 'chanodev' ); ?>
											</span>
										</div>
										<div class="analytics-range-picker">
											<span class="active">7d</span>
											<span>30d</span>
											<span>12m</span>
										</div>
									</div>

									<!-- 3-KPI Overview Cards -->
									<div class="analytics-kpi-grid">
										<div class="analytics-kpi-card highlight">
											<div class="kpi-label-row">
												<span><?php esc_html_e( 'Visitantes Únicos', 'chanodev' ); ?></span>
												<span class="kpi-trend up">▲ +24.8%</span>
											</div>
											<strong class="kpi-val"><?php echo esc_html( $app_visitors_val ); ?></strong>
										</div>
										<div class="analytics-kpi-card">
											<div class="kpi-label-row">
												<span><?php esc_html_e( 'Páginas Vistas', 'chanodev' ); ?></span>
												<span class="kpi-trend up">▲ +18.2%</span>
											</div>
											<strong class="kpi-val"><?php echo esc_html( $app_views_val ); ?></strong>
										</div>
										<div class="analytics-kpi-card">
											<div class="kpi-label-row">
												<span><?php esc_html_e( 'Tasa de Rebote', 'chanodev' ); ?></span>
												<span class="kpi-trend down">▼ -8.4%</span>
											</div>
											<strong class="kpi-val"><?php echo esc_html( $app_bounce_val ); ?></strong>
										</div>
									</div>

									<!-- Analytics Main Visual: Trend Bars + Top Referrers -->
									<div class="analytics-main-grid">
										<!-- Left: Weekly Traffic Bar Chart -->
										<div class="analytics-chart-panel">
											<div class="chart-panel-header">
												<small><?php esc_html_e( 'Tráfico Diario (7d)', 'chanodev' ); ?></small>
											</div>
											<div class="analytics-bars-wrap">
												<div class="analytics-col"><div class="bar-fill" style="--h: 42%;"></div><span>L</span></div>
												<div class="analytics-col"><div class="bar-fill" style="--h: 60%;"></div><span>M</span></div>
												<div class="analytics-col"><div class="bar-fill" style="--h: 78%;"></div><span>X</span></div>
												<div class="analytics-col"><div class="bar-fill" style="--h: 55%;"></div><span>J</span></div>
												<div class="analytics-col"><div class="bar-fill" style="--h: 88%;"></div><span>V</span></div>
												<div class="analytics-col active"><div class="bar-fill" style="--h: 96%;"><small class="bar-tooltip">34K</small></div><span>S</span></div>
												<div class="analytics-col"><div class="bar-fill" style="--h: 68%;"></div><span>D</span></div>
											</div>
										</div>

										<!-- Right: Top Sources List -->
										<div class="analytics-sources-panel">
											<div class="chart-panel-header">
												<small><?php esc_html_e( 'Top Canales de Tráfico', 'chanodev' ); ?></small>
											</div>
											<div class="analytics-sources-list">
												<div class="source-row">
													<div class="source-info">
														<span>Google Orgánico</span>
														<b>58%</b>
													</div>
													<div class="source-progress"><div class="progress-bar cyan" style="width: 58%;"></div></div>
												</div>
												<div class="source-row">
													<div class="source-info">
														<span>Directo / Referral</span>
														<b>27%</b>
													</div>
													<div class="source-progress"><div class="progress-bar green" style="width: 27%;"></div></div>
												</div>
												<div class="source-row">
													<div class="source-info">
														<span>GitHub / Devs</span>
														<b>15%</b>
													</div>
													<div class="source-progress"><div class="progress-bar purple" style="width: 15%;"></div></div>
												</div>
											</div>
										</div>
									</div>

									<!-- Bottom Telemetry & Privacy Strip -->
									<div class="analytics-footer-strip">
										<span class="analytics-tag-pill">
											<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2.5" aria-hidden="true"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
											<?php printf( esc_html__( 'Latencia %s', 'chanodev' ), esc_html( $app_latency_val ) ); ?>
										</span>
										<span class="analytics-tag-pill">
											<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
											<?php esc_html_e( 'Sin Cookies Invasivas', 'chanodev' ); ?>
										</span>
										<span class="analytics-tag-pill">
											<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#a855f7" stroke-width="2.5" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
											<?php esc_html_e( 'Tiempo Real 60fps', 'chanodev' ); ?>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>