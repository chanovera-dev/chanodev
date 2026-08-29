<?php
/**
 * Template Name: Contacto y Cotización de Proyectos (E-E-A-T)
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Inject widget script and preconnect hints into <head> for fast rendering
add_action( 'wp_head', function () {
	?>
	<link rel="preconnect" href="https://atmeetly.com" crossorigin>
	<link rel="dns-prefetch" href="https://atmeetly.com">
	<link rel="preload" href="https://atmeetly.com/widget.js" as="script">
	<script src="https://atmeetly.com/widget.js" data-user="chanovera" data-base-url="https://atmeetly.com" data-container-id="atmeetly" defer></script>
	<?php
}, 1 );

get_header();
?>

<main id="main" class="site-main" role="main">
	<section class="block contact-main-section">
		<div class="content" style="padding: 0;">
			<section id="atmeetly"></section>
		</div>
	</section>
</main>

<?php
get_footer();
