<?php
/**
 * Template Name: Página Legal / Privacidad y Confianza (E-E-A-T)
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="main" class="site-main" role="main">
	<section class="block legal-hero-block">
		<div class="content">
			<header class="legal-page-header">
				<span class="legal-kicker"><?php esc_html_e( 'Transparencia & Seguridad', 'chanodev' ); ?></span>
				<h1 class="legal-page-title"><?php the_title(); ?></h1>
				<p class="legal-page-date">
					<?php esc_html_e( 'Última actualización: ', 'chanodev' ); ?><?php the_modified_date( 'd F Y' ); ?>
				</p>
			</header>
		</div>
	</section>

	<section class="block legal-content-block">
		<div class="content">
			<article class="legal-article-wrapper typography-block">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						the_content();
					endwhile;
				endif;
				?>
			</article>
		</div>
	</section>
</main>

<?php
get_footer();
