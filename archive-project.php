<?php
/**
 * The template for displaying the Projects archive (Portfolio)
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="main" class="site-main" role="main">
	<!-- Portfolio Header Hero Section -->
	<section class="block portfolio-hero-block">
		<div class="content">
			<header class="portfolio-page-header">
				<span class="portfolio-kicker"><?php esc_html_e( 'Casos de Estudio y Proyectos', 'chanodev' ); ?></span>
				<h1 class="portfolio-page-title"><?php esc_html_e( 'Portafolio de Desarrollo Web', 'chanodev' ); ?></h1>
				<p class="portfolio-page-description">
					<?php esc_html_e( 'Proyectos reales en WordPress a medida, tiendas online WooCommerce, aplicaciones full-stack en React y Node.js, y plataformas corporativas de alto rendimiento.', 'chanodev' ); ?>
				</p>
			</header>

			<!-- Filter Bar for Technologies & Project Types -->
			<?php
			$technologies = get_terms( array(
				'taxonomy'   => 'project_technology',
				'hide_empty' => true,
			) );

			if ( ! empty( $technologies ) && ! is_wp_error( $technologies ) ) :
			?>
				<nav class="portfolio-filter-nav" aria-label="<?php esc_attr_e( 'Filtros de tecnología', 'chanodev' ); ?>">
					<span class="filter-label"><?php esc_html_e( 'Filtrar por tecnología:', 'chanodev' ); ?></span>
					<ul class="filter-list">
						<li class="filter-item">
							<a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>" class="filter-link <?php echo ! is_tax() ? 'is-active' : ''; ?>">
								<?php esc_html_e( 'Todos', 'chanodev' ); ?>
							</a>
						</li>
						<?php foreach ( $technologies as $tech ) : ?>
							<li class="filter-item">
								<a href="<?php echo esc_url( get_term_link( $tech ) ); ?>" class="filter-link <?php echo is_tax( 'project_technology', $tech->slug ) ? 'is-active' : ''; ?>">
									<?php echo esc_html( $tech->name ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</nav>
			<?php endif; ?>
		</div>
	</section>

	<!-- Projects Grid Section -->
	<section class="block portfolio-grid-block">
		<div class="content">
			<?php if ( have_posts() ) : ?>
				<div class="chanodev-projects-grid">
					<?php
					while ( have_posts() ) :
						the_post();
						$details = function_exists( 'chanodev_get_project_details' ) ? chanodev_get_project_details( get_the_ID() ) : array();
					?>
						<article id="project-<?php the_ID(); ?>" <?php post_class( 'chanodev-project-card' ); ?>>
							<div class="project-card-media">
								<a href="<?php the_permalink(); ?>" class="project-card-thumbnail-link" tabindex="-1" aria-hidden="true">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'large', array( 'class' => 'project-card-img', 'loading' => 'lazy' ) ); ?>
									<?php else : ?>
										<div class="project-card-placeholder"></div>
									<?php endif; ?>
								</a>
								<?php if ( ! empty( $details['types'] ) && ! is_wp_error( $details['types'] ) ) : ?>
									<span class="project-type-badge">
										<?php echo esc_html( $details['types'][0]->name ); ?>
									</span>
								<?php endif; ?>
							</div>

							<div class="project-card-body">
								<?php if ( ! empty( $details['technologies'] ) && ! is_wp_error( $details['technologies'] ) ) : ?>
									<div class="post--tags__wrapper">
										<div class="skill-tags-cloud tags post--tags">
											<?php foreach ( array_slice( $details['technologies'], 0, 3 ) as $tech ) : ?>
												<span class="transparent-tag"><?php echo esc_html( $tech->name ); ?></span>
											<?php endforeach; ?>
										</div>
									</div>
								<?php endif; ?>

								<h2 class="project-card-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h2>

								<div class="project-card-excerpt">
									<?php the_excerpt(); ?>
								</div>

								<?php if ( ! empty( $details['metrics'] ) ) : ?>
									<div class="project-metric-pill">
										<span class="metric-icon">🚀</span>
										<span class="metric-text"><?php echo esc_html( $details['metrics'] ); ?></span>
									</div>
								<?php endif; ?>

								<footer class="project-card-footer">
									<a href="<?php the_permalink(); ?>" class="btn-read-case-study">
										<?php esc_html_e( 'Ver Caso de Estudio', 'chanodev' ); ?>
										<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
									</a>
								</footer>
							</div>
						</article>
					<?php endwhile; ?>
				</div>

				<!-- Pagination -->
				<div class="portfolio-pagination">
					<?php
					the_posts_pagination( array(
						'mid_size'  => 2,
						'prev_text' => __( '&larr; Anteriores', 'chanodev' ),
						'next_text' => __( 'Siguientes &rarr;', 'chanodev' ),
					) );
					?>
				</div>

			<?php else : ?>
				<div class="chanodev-no-projects">
					<h3><?php esc_html_e( 'No se encontraron proyectos', 'chanodev' ); ?></h3>
					<p><?php esc_html_e( 'Pronto estaremos publicando nuevos casos de estudio y desarrollos.', 'chanodev' ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<!-- Call to Action Section (E-E-A-T Conversion) -->
	<section class="block portfolio-cta-block">
		<div class="content">
			<div class="portfolio-cta-box">
				<h2><?php esc_html_e( '¿Tienes un proyecto en mente?', 'chanodev' ); ?></h2>
				<p><?php esc_html_e( 'Ya sea una tienda en línea, un sitio web para tu empresa o una plataforma a medida en React y Node.js, hablemos de cómo llevarlo al siguiente nivel.', 'chanodev' ); ?></p>
				<a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>" class="btn-cta-primary">
					<?php esc_html_e( 'Solicitar Cotización / Consulta Gratuita', 'chanodev' ); ?>
				</a>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
