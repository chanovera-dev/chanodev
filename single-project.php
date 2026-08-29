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
			<nav class="project-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumbs', 'chanodev' ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Inicio', 'chanodev' ); ?></a> &rsaquo;
				<a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>"><?php esc_html_e( 'Portafolio', 'chanodev' ); ?></a> &rsaquo;
				<span><?php the_title(); ?></span>
			</nav>

			<header class="project-single-header">
				<?php if ( ! empty( $details['types'] ) && ! is_wp_error( $details['types'] ) ) : ?>
					<span class="project-type-kicker"><?php echo esc_html( $details['types'][0]->name ); ?></span>
				<?php endif; ?>

				<h1 class="project-single-title"><?php the_title(); ?></h1>

				<?php if ( has_excerpt() ) : ?>
					<div class="project-single-lead">
						<?php the_excerpt(); ?>
					</div>
				<?php endif; ?>
			</header>

			<!-- Project Meta Summary Bar (E-E-A-T Overview) -->
			<div class="project-meta-grid">
				<?php if ( ! empty( $details['client'] ) ) : ?>
					<div class="project-meta-item">
						<span class="meta-label"><?php esc_html_e( 'Cliente / Empresa:', 'chanodev' ); ?></span>
						<strong class="meta-value"><?php echo esc_html( $details['client'] ); ?></strong>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $details['role'] ) ) : ?>
					<div class="project-meta-item">
						<span class="meta-label"><?php esc_html_e( 'Rol Técnico:', 'chanodev' ); ?></span>
						<strong class="meta-value"><?php echo esc_html( $details['role'] ); ?></strong>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $details['year'] ) ) : ?>
					<div class="project-meta-item">
						<span class="meta-label"><?php esc_html_e( 'Año:', 'chanodev' ); ?></span>
						<strong class="meta-value"><?php echo esc_html( $details['year'] ); ?></strong>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $details['metrics'] ) ) : ?>
					<div class="project-meta-item highlight">
						<span class="meta-label"><?php esc_html_e( 'Impacto / Métrica:', 'chanodev' ); ?></span>
						<strong class="meta-value"><?php echo esc_html( $details['metrics'] ); ?></strong>
					</div>
				<?php endif; ?>
			</div>

			<!-- Project Actions / Links -->
			<?php if ( ! empty( $details['live_url'] ) || ! empty( $details['repo_url'] ) ) : ?>
				<div class="project-actions-bar">
					<?php if ( ! empty( $details['live_url'] ) ) : ?>
						<a href="<?php echo esc_url( $details['live_url'] ); ?>" target="_blank" rel="noopener noreferrer" class="btn-project-live">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
							<?php esc_html_e( 'Visitar Sitio Web en Vivo', 'chanodev' ); ?>
						</a>
					<?php endif; ?>

					<?php if ( ! empty( $details['repo_url'] ) ) : ?>
						<a href="<?php echo esc_url( $details['repo_url'] ); ?>" target="_blank" rel="noopener noreferrer" class="btn-project-repo">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>
							<?php esc_html_e( 'Ver Repositorio (Código)', 'chanodev' ); ?>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
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

	<!-- Conversion CTA Section -->
	<section class="block project-single-cta">
		<div class="content">
			<div class="portfolio-cta-box">
				<h2><?php esc_html_e( '¿Necesitas un desarrollo similar para tu negocio?', 'chanodev' ); ?></h2>
				<p><?php esc_html_e( 'Puedo ayudarte a diseñar, programar y optimizar una solución a la medida de tus requerimientos.', 'chanodev' ); ?></p>
				<a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>" class="btn-cta-primary">
					<?php esc_html_e( 'Hablemos de tu Proyecto', 'chanodev' ); ?>
				</a>
			</div>
		</div>
	</section>
</main>

<?php
endwhile;

get_footer();
