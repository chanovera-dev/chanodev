<?php
/**
 * The template for displaying a single Project Case Study (E-E-A-T Optimized)
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();
	$details = function_exists( 'chanodev_get_project_details' ) ? chanodev_get_project_details( get_the_ID() ) : array();
?>

<main id="main" class="site-main" role="main">
	<!-- Project Hero Header -->
	<section class="block project-single-hero">
		<div class="content">
			<header class="project-single-header">
				<div class="project-header-badges">
					<?php if ( ! empty( $details['types'] ) && ! is_wp_error( $details['types'] ) ) : ?>
						<?php foreach ( $details['types'] as $type ) : ?>
							<span class="sub-heading project-type-badge"><?php echo esc_html( $type->name ); ?></span>
						<?php endforeach; ?>
					<?php endif; ?>

					<?php if ( ! empty( $details['live_url'] ) ) : ?>
						<span class="sub-heading green project-live-status">
							<span class="status-pulse-dot" aria-hidden="true"></span>
							<?php esc_html_e( 'En Producción', 'chanodev' ); ?>
						</span>
					<?php endif; ?>

					<?php if ( ! empty( $details['year'] ) ) : ?>
						<span class="sub-heading project-year-pill"><?php echo esc_html( $details['year'] ); ?></span>
					<?php endif; ?>
				</div>

				<h1 class="project-single-title"><?php the_title(); ?></h1>

				<?php if ( has_excerpt() ) : ?>
					<div class="project-single-lead">
						<?php the_excerpt(); ?>
					</div>
				<?php endif; ?>

				<!-- Project Actions / Links -->
				<div class="project-actions-bar">
					<?php if ( ! empty( $details['live_url'] ) ) : ?>
						<a href="<?php echo esc_url( $details['live_url'] ); ?>" target="_blank" rel="noopener noreferrer" class="btn primary btn-project-live">
							<span><?php esc_html_e( 'Visitar Proyecto en Vivo', 'chanodev' ); ?></span>
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
						</a>
					<?php endif; ?>

					<?php if ( ! empty( $details['repo_url'] ) ) : ?>
						<a href="<?php echo esc_url( $details['repo_url'] ); ?>" target="_blank" rel="noopener noreferrer" class="btn hollow outline btn-project-repo">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>
							<span><?php esc_html_e( 'Ver Repositorio', 'chanodev' ); ?></span>
						</a>
					<?php endif; ?>

					<div class="project-single-like story-card">
						<div class="post-top-actions">
							<?php if ( function_exists( 'stories_like_button' ) ) { stories_like_button(); } ?>
						</div>
					</div>
				</div>
			</header>

			<!-- Project Meta Summary Bar (E-E-A-T Overview) -->
			<div class="project-meta-grid">
				<?php if ( ! empty( $details['client'] ) ) : ?>
					<div class="project-meta-item">
						<div class="meta-icon-wrapper" aria-hidden="true">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="16" height="20" x="4" y="2" rx="2" ry="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01"/><path d="M16 6h.01"/><path d="M8 10h.01"/><path d="M16 10h.01"/><path d="M8 14h.01"/><path d="M16 14h.01"/></svg>
						</div>
						<div class="meta-text-wrapper">
							<span class="meta-label"><?php esc_html_e( 'Cliente / Empresa', 'chanodev' ); ?></span>
							<strong class="meta-value"><?php echo esc_html( $details['client'] ); ?></strong>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $details['role'] ) ) : ?>
					<div class="project-meta-item">
						<div class="meta-icon-wrapper" aria-hidden="true">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
						</div>
						<div class="meta-text-wrapper">
							<span class="meta-label"><?php esc_html_e( 'Rol Técnico', 'chanodev' ); ?></span>
							<strong class="meta-value"><?php echo esc_html( $details['role'] ); ?></strong>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $details['year'] ) ) : ?>
					<div class="project-meta-item">
						<div class="meta-icon-wrapper" aria-hidden="true">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
						</div>
						<div class="meta-text-wrapper">
							<span class="meta-label"><?php esc_html_e( 'Año', 'chanodev' ); ?></span>
							<strong class="meta-value"><?php echo esc_html( $details['year'] ); ?></strong>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $details['metrics'] ) ) : ?>
					<div class="project-meta-item highlight">
						<div class="meta-icon-wrapper" aria-hidden="true">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
						</div>
						<div class="meta-text-wrapper">
							<span class="meta-label"><?php esc_html_e( 'Impacto / Métrica Clave', 'chanodev' ); ?></span>
							<strong class="meta-value"><?php echo esc_html( $details['metrics'] ); ?></strong>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- Project Media Featured Image -->
	<?php if ( has_post_thumbnail() ) : ?>
		<section class="block project-single-media">
			<div class="content">
				<div class="project-featured-image-wrapper">
					<?php the_post_thumbnail( 'full', array( 'class' => 'project-main-image', 'loading' => 'eager' ) ); ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<!-- Case Study Content: Challenge, Solution & Stack (E-E-A-T) -->
	<section class="block project-single-body">
		<div class="content">
			<div class="case-study-layout">
				<div class="case-study-main">
					<!-- Challenge Section -->
					<?php if ( ! empty( $details['challenge'] ) ) : ?>
						<div class="case-study-section challenge-box">
							<div class="section-icon-badge">⚠️</div>
							<div class="section-text">
								<h2><?php esc_html_e( 'El Desafío Técnico', 'chanodev' ); ?></h2>
								<p><?php echo nl2br( esc_html( $details['challenge'] ) ); ?></p>
							</div>
						</div>
					<?php endif; ?>

					<!-- Solution Section -->
					<?php if ( ! empty( $details['solution'] ) ) : ?>
						<div class="case-study-section solution-box">
							<div class="section-icon-badge">💡</div>
							<div class="section-text">
								<h2><?php esc_html_e( 'La Solución de Ingeniería', 'chanodev' ); ?></h2>
								<p><?php echo nl2br( esc_html( $details['solution'] ) ); ?></p>
							</div>
						</div>
					<?php endif; ?>

					<!-- Detailed Case Study Narrative -->
					<div class="project-full-content typography-block">
						<?php the_content(); ?>
					</div>
				</div>

				<!-- Sidebar: Tech Stack & Author Profile -->
				<aside class="case-study-sidebar">
					<!-- Tech Stack Badges -->
					<?php if ( ! empty( $details['technologies'] ) && ! is_wp_error( $details['technologies'] ) ) : ?>
						<div class="sidebar-card tech-stack-card">
							<h3 class="sidebar-card-title"><?php esc_html_e( 'Stack Tecnológico', 'chanodev' ); ?></h3>
							<div class="tech-stack-badges">
								<?php foreach ( $details['technologies'] as $tech ) : ?>
									<span class="tech-badge"><?php echo esc_html( $tech->name ); ?></span>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>

					<!-- Author / Developer Trust Card (E-E-A-T) -->
					<div class="sidebar-card author-trust-card">
						<h3 class="sidebar-card-title"><?php esc_html_e( 'Desarrollado por', 'chanodev' ); ?></h3>
						<div class="author-trust-info">
							<h4 class="author-name">Chano Vera</h4>
							<p class="author-role"><?php esc_html_e( 'Senior Full-Stack & WordPress Engineer', 'chanodev' ); ?></p>
							<p class="author-bio">
								<?php esc_html_e( 'Especialista en desarrollo web escalable, tiendas online WooCommerce, aplicaciones React y arquitecturas Node.js.', 'chanodev' ); ?>
							</p>
							<a href="<?php echo esc_url( home_url( '/sobre-mi/' ) ); ?>" class="author-link">
								<?php esc_html_e( 'Conocer trayectoria & expertise &rarr;', 'chanodev' ); ?>
							</a>
						</div>
					</div>
				</aside>
			</div>
		</div>
	</section>

	<!-- Project Timeline / Navigation Section -->
	<?php get_template_part( 'templates/single/project', 'navigation' ); ?>

	<!-- Conversion CTA Section -->
	<section class="block project-single-cta">
		<div class="content">
			<div class="portfolio-cta-box">
				<h2><?php esc_html_e( '¿Necesitas un desarrollo similar para tu negocio?', 'chanodev' ); ?></h2>
				<p><?php esc_html_e( 'Puedo ayudarte a diseñar, programar y optimizar una solución a la medida de tus requerimientos.', 'chanodev' ); ?></p>
				<a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>" class="btn primary">
					<?php esc_html_e( 'Hablemos de tu Proyecto', 'chanodev' ); ?>
				</a>
			</div>
		</div>
	</section>
</main>

<?php
endwhile;

get_footer();
