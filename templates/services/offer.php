<?php
/**
 * Template part for displaying the Services Page Offer section
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- 2. Offer / Services Section -->
<section class="block services-offer-section blue-background">
	<div class="content">
		<div class="section-heading-center white-text" data-reveal="fade-up">
			<div>
				<?php if ( ! empty( $offer_kicker ) ) : ?>
					<span class="sub-heading"><?php echo esc_html( $offer_kicker ); ?></span>
				<?php endif; ?>
				<h2><?php echo esc_html( $offer_title ); ?></h2>
			</div>
			<?php if ( ! empty( $offer_desc ) ) : ?>
				<p><?php echo esc_html( $offer_desc ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( ! empty( $offer_items ) ) : ?>
			<div class="services-detailed-grid" data-reveal-stagger>
				<?php foreach ( $offer_items as $item ) : ?>
					<?php
					$is_featured = ! empty( $item['is_featured'] );
					$card_class  = 'service-detail-card hover-glow' . ( $is_featured ? ' service-detail-featured' : '' );
					$icon        = ! empty( $item['icon'] ) ? $item['icon'] : '⚡';
					$badge       = ! empty( $item['badge'] ) ? $item['badge'] : '';
					$title       = ! empty( $item['title'] ) ? $item['title'] : '';
					$desc        = ! empty( $item['description'] ) ? $item['description'] : '';
					$btn_text    = ! empty( $item['btn_text'] ) ? $item['btn_text'] : __( 'Diseñar mi sitio', 'chanodev' );
					$btn_url     = ! empty( $item['btn_url'] ) ? $item['btn_url'] : home_url( '/contacto/' );
					$features    = ! empty( $item['features'] ) ? ( is_array( $item['features'] ) ? $item['features'] : explode( "\n", $item['features'] ) ) : array();
					?>
					<article class="<?php echo esc_attr( $card_class ); ?>" data-reveal="fade-up">
						<div class="service-card-header">
							<div class="big-badge sub-heading" aria-hidden="true">
								<?php
								if ( ! empty( $icon ) && strpos( $icon, '<svg' ) !== false ) {
									echo $icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								} elseif ( ! empty( $icon ) && function_exists( 'stories_get_svg' ) && stories_get_svg( $icon ) ) {
									stories_svg( $icon );
								} else {
									echo esc_html( $icon );
								}
								?>
							</div>
							<div>
								<?php if ( ! empty( $badge ) ) : ?>
									<small><?php echo esc_html( $badge ); ?></small>
								<?php endif; ?>
								<h3><?php echo esc_html( $title ); ?></h3>
							</div>
						</div>
						<p><?php echo esc_html( $desc ); ?></p>

						<?php if ( ! empty( $features ) ) : ?>
							<ul class="service-features-list">
								<?php foreach ( $features as $feat ) : ?>
									<?php
									$feat_text = is_array( $feat ) ? ( $feat['feature_text'] ?? '' ) : trim( $feat );
									if ( empty( $feat_text ) ) {
										continue;
									}
									?>
									<li>✓ <?php echo esc_html( $feat_text ); ?></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>

						<a class="btn-service-action" href="<?php echo esc_url( $btn_url ); ?>">
							<?php echo esc_html( $btn_text ); ?><?php stories_svg( 'arrow-right-circle' ); ?>
						</a>
					</article>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
