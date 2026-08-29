<?php
/**
 * Template part for displaying the Services Page Call to Action section
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- 5. CTA Block -->
<section class="block services-cta-block blue-background">
	<div class="content">
		<div class="portfolio-cta-box" data-reveal="scale-up">
			<!-- Mouse Spotlight Glow Layer -->
			<div class="cta-spotlight-layer" aria-hidden="true"></div>

			<!-- Decorative Ambient Glow Orbs -->
			<div class="cta-glow-orb cta-glow-orb-1" aria-hidden="true"></div>
			<div class="cta-glow-orb cta-glow-orb-2" aria-hidden="true"></div>

			<div class="cta-inner-content" data-reveal="fade-up" style="--delay: 120ms;">
				<?php if ( ! empty( $cta_kicker ) ) : ?>
					<span class="sub-heading"><?php echo esc_html( $cta_kicker ); ?></span>
				<?php endif; ?>
				<h2><?php echo esc_html( $cta_title ); ?></h2>
				<?php if ( ! empty( $cta_desc ) ) : ?>
					<p><?php echo esc_html( $cta_desc ); ?></p>
				<?php endif; ?>
				<?php if ( ! empty( $cta_btn_txt ) ) : ?>
					<div class="cta-actions-group">
						<a href="<?php echo esc_url( $cta_btn_url ); ?>" class="btn primary">
							<span><?php echo esc_html( $cta_btn_txt ); ?></span>
							<?php stories_svg( 'arrow-right-circle' ); ?>
						</a>
						<span class="cta-reassurance">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
							<?php esc_html_e( 'Respuesta en menos de 24h · Sin compromiso', 'chanodev' ); ?>
						</span>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
