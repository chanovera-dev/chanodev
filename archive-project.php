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
				<div class="posts-grid chanodev-projects-grid">
					<?php
					while ( have_posts() ) :
						the_post();
						$details   = function_exists( 'chanodev_get_project_details' ) ? chanodev_get_project_details( get_the_ID() ) : array();
						$has_thumb = has_post_thumbnail();
						$container_classes = 'stories-standard-container' . ( ! $has_thumb ? ' has-no-thumbnail' : '' );
					?>
						<article id="project-<?php the_ID(); ?>" <?php post_class( 'story-card format-standard-card chanodev-project-card' . ( ! $has_thumb ? ' has-no-thumbnail' : '' ) ); ?> data-id="<?php echo esc_attr( get_the_ID() ); ?>">
							<div class="<?php echo esc_attr( $container_classes ); ?>">
								<!-- Background / Pattern -->
								<div class="post-thumbnail-bg <?php echo ! $has_thumb ? 'no-thumbnail-pattern' : ''; ?>">
									<?php if ( $has_thumb ) : ?>
										<?php the_post_thumbnail( 'large' ); ?>
									<?php endif; ?>
								</div>

								<!-- Top Actions (Info Toggle & Like Button) -->
								<div class="post-top-actions">
									<div class="toggle-info-container inset-shadow-effect">
										<button type="button" class="toggle-info-btn" aria-label="<?php esc_attr_e( 'Toggle Post Info', 'stories' ); ?>" title="<?php esc_attr_e( 'Toggle Post Info', 'stories' ); ?>">
											<?php if ( function_exists( 'stories_svg' ) ) { stories_svg( 'info', array( 'size' => 18 ) ); } ?>
										</button>
									</div>
									<?php if ( function_exists( 'stories_like_button' ) ) { stories_like_button(); } ?>
								</div>

								<!-- Information Overlay Card -->
								<div class="info-overlay quote-info-overlay standard-info-overlay">
									<header class="entry-header">
										<div class="entry-badge">
											<?php if ( ! empty( $details['types'] ) && ! is_wp_error( $details['types'] ) ) : ?>
												<span class="project-type-badge"><?php echo esc_html( $details['types'][0]->name ); ?></span>
											<?php elseif ( function_exists( 'stories_post_type_badge' ) ) : ?>
												<?php stories_post_type_badge(); ?>
											<?php endif; ?>
										</div>
									</header>

									<div class="entry-body">
										<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

										<div class="entry-meta">
											<?php if ( function_exists( 'stories_posted_on' ) ) stories_posted_on(); ?>
											<?php if ( ! empty( $details['client'] ) ) : ?>
												<span class="entry-client">🏢 <?php echo esc_html( $details['client'] ); ?></span>
											<?php endif; ?>
										</div>

										<div class="entry-summary">
											<?php the_excerpt(); ?>
										</div>

										<?php if ( ! empty( $details['metrics'] ) ) : ?>
											<div class="project-metric-pill">
												<span class="metric-icon">🚀</span>
												<span class="metric-text"><?php echo esc_html( $details['metrics'] ); ?></span>
											</div>
										<?php endif; ?>
									</div>

									<footer class="entry-footer">
										<?php if ( ! empty( $details['technologies'] ) && ! is_wp_error( $details['technologies'] ) ) : ?>
											<div class="post--tags__wrapper">
												<div class="tags post--tags">
													<?php foreach ( $details['technologies'] as $tech ) : ?>
														<a class="post-tag small" href="<?php echo esc_url( get_term_link( $tech ) ); ?>">
															<?php echo ( function_exists( 'stories_get_svg' ) ? stories_get_svg( 'tag', array( 'size' => 12 ) ) : '#' ) . esc_html( $tech->name ); ?>
														</a>
													<?php endforeach; ?>
												</div>
											</div>
										<?php endif; ?>
									</footer>
								</div>

								<!-- Bottom Bar showing Title -->
								<div class="standard-bottom-bar">
									<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
								</div>
							</div>
							<div class="post__overlay"></div>
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
