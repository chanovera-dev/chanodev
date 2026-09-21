<?php
/**
 * Project Navigation Template Part (Timeline de Proyectos)
 *
 * Displays a timeline carousel of projects based on the post-navigation pattern.
 * Displays date/year on the left and the entry counter ("X de Y") on the right in nav-card-header.
 *
 * @package ChanoDev
 * @subpackage Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;
$original_post = $post;

// Get all published project IDs in chronological order (oldest to newest) to calculate positions
$all_project_ids = get_posts( array(
	'post_type'        => 'project',
	'posts_per_page'   => -1,
	'post_status'      => 'publish',
	'orderby'          => 'date',
	'order'            => 'ASC',
	'fields'           => 'ids',
	'suppress_filters' => false,
) );

$total_projects_count = count( $all_project_ids );

if ( empty( $all_project_ids ) ) {
	return;
}

// Build timeline: all projects in reverse chronological order (newest first), excluding the current project
$nav_project_ids = array_reverse( $all_project_ids );
$nav_project_ids = array_values( array_filter( $nav_project_ids, function( $id ) use ( $original_post ) {
	return (int) $id !== (int) $original_post->ID;
} ) );

if ( empty( $nav_project_ids ) ) {
	return;
}

$last_project_id = end( $nav_project_ids );
?>

<section class="block posts--body container--related-posts post-navigation-block project-navigation-block">
	<div class="post-nav-bg-decor" aria-hidden="true"></div>
	<div class="content related-posts--title">
		<h2 class="title-section"><?php esc_html_e( 'Timeline de proyectos', 'chanodev' ); ?></h2>
		<div class="navigation post-nav-title-controls">
			<div class="slideshow-control-container">
				<button class="slide-prev btn-pagination small-pagination slideshow-control" aria-label="<?php esc_attr_e( 'Anteriores', 'chanodev' ); ?>">
					<?php echo function_exists( 'stories_get_svg' ) ? stories_get_svg( 'arrow-left-circle', array( 'size' => 18 ) ) : '&larr;'; ?>
				</button>
			</div>
			<div class="slideshow-control-container">
				<button class="slide-next btn-pagination small-pagination slideshow-control" aria-label="<?php esc_attr_e( 'Siguientes', 'chanodev' ); ?>">
					<?php echo function_exists( 'stories_get_svg' ) ? stories_get_svg( 'arrow-right-circle', array( 'size' => 18 ) ) : '&rarr;'; ?>
				</button>
			</div>
		</div>
	</div>
	<div class="content slideshow-wrapper post-navigation-slideshow" data-last-post-id="<?php echo esc_attr( $last_project_id ); ?>" data-has-more="false">
		<div class="slideshow-mask-container">
			<div class="related-posts--list slideshow">
				<?php
				foreach ( $nav_project_ids as $nav_id ) :
					$post = get_post( $nav_id );
					if ( ! $post ) {
						continue;
					}
					setup_postdata( $post );
					$post_url      = get_permalink( $post->ID );
					$details       = function_exists( 'chanodev_get_project_details' ) ? chanodev_get_project_details( $post->ID ) : array();
					$time_label    = ! empty( $details['year'] ) ? $details['year'] : ( function_exists( 'stories_get_timeline_date_label' ) ? stories_get_timeline_date_label( $post->ID ) : get_the_date( '', $post->ID ) );
					$post_pos      = array_search( $post->ID, $all_project_ids, true );
					$entry_num     = ( false !== $post_pos ) ? ( $post_pos + 1 ) : 1;
					$counter_label = sprintf( __( '%1$d de %2$d', 'chanodev' ), $entry_num, $total_projects_count );
					$has_thumb     = has_post_thumbnail( $post->ID );
					$container_classes = 'stories-standard-container' . ( ! $has_thumb ? ' has-no-thumbnail' : '' );
					?>
					<div class="nav-card-item" data-id="<?php echo esc_attr( 'slide-' . $post->ID ); ?>">
						<div class="nav-card-header">
							<a href="<?php echo esc_url( $post_url ); ?>" class="nav-badge time-badge" title="<?php echo esc_attr( get_the_title( $post->ID ) ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
								<span><?php echo esc_html( $time_label ); ?></span>
							</a>
							<span class="nav-badge count-badge">
								<?php echo esc_html( $counter_label ); ?>
							</span>
						</div>
						<article id="project-<?php echo esc_attr( $post->ID ); ?>" <?php post_class( 'story-card format-standard-card chanodev-project-card' . ( ! $has_thumb ? ' has-no-thumbnail' : '' ), $post->ID ); ?> data-id="<?php echo esc_attr( $post->ID ); ?>">
							<div class="<?php echo esc_attr( $container_classes ); ?>">
								<!-- Background / Pattern -->
								<div class="post-thumbnail-bg <?php echo ! $has_thumb ? 'no-thumbnail-pattern' : ''; ?>">
									<?php if ( $has_thumb ) : ?>
										<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
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
										<h2 class="entry-title"><a href="<?php echo esc_url( $post_url ); ?>" rel="bookmark"><?php echo esc_html( get_the_title( $post->ID ) ); ?></a></h2>

										<div class="entry-meta">
											<?php if ( function_exists( 'stories_posted_on' ) ) { stories_posted_on(); } ?>
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
										<a href="<?php echo esc_url( $post_url ); ?>" class="btn-read-more">
											<span><?php esc_html_e( 'Ver Caso de Estudio', 'chanodev' ); ?></span>
											<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
										</a>
									</footer>
								</div>
							</div>
						</article>
					</div>
				<?php
				endforeach;
				$post = $original_post;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</div>
</section>
