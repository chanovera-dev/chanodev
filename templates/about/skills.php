<?php
/**
 * Template part for displaying the About Page Skills section
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- 3. Skills / Tech Stack Section -->
<section class="block about-skills-section blue-background">
	<div class="content">
		<div class="section-heading-center white-text" data-reveal="fade-up">
			<?php if ( ! empty( $skills_kicker ) ) : ?>
				<span class="sub-heading"><?php echo esc_html( $skills_kicker ); ?></span>
			<?php endif; ?>
			<h2><?php echo esc_html( $skills_title ); ?></h2>
			<?php if ( ! empty( $skills_desc ) ) : ?>
				<p><?php echo esc_html( $skills_desc ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( ! empty( $skill_cards ) ) : ?>
			<div class="about-skills-grid" data-reveal-stagger>
				<?php foreach ( $skill_cards as $card ) : ?>
					<?php
					$icon  = ! empty( $card['icon'] ) ? $card['icon'] : '⚡';
					$badge = ! empty( $card['badge'] ) ? $card['badge'] : '';
					$title = ! empty( $card['title'] ) ? $card['title'] : '';
					$desc  = ! empty( $card['description'] ) ? $card['description'] : '';
					$tags  = ! empty( $card['tags'] ) ? ( is_array( $card['tags'] ) ? $card['tags'] : explode( "\n", $card['tags'] ) ) : array();
					?>
					<article class="about-skill-card hover-glow" data-reveal="fade-up">
						<div class="skill-card-top">
							<div class="big-badge sub-heading" aria-hidden="true">
								<?php echo $icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div>
							<?php if ( ! empty( $badge ) ) : ?>
								<span class="sub-heading"><?php echo esc_html( $badge ); ?></span>
							<?php endif; ?>
						</div>

						<h3><?php echo esc_html( $title ); ?></h3>
						<p><?php echo esc_html( $desc ); ?></p>

						<?php if ( ! empty( $tags ) ) : ?>
							<div class="post--tags__wrapper">
								<div class="skill-tags-cloud tags post--tags">
									<?php foreach ( $tags as $tag ) : ?>
										<?php $tag_txt = is_array( $tag ) ? ( $tag['tag_name'] ?? '' ) : trim( $tag ); ?>
										<?php if ( ! empty( $tag_txt ) ) : ?>
											<span class="transparent-tag"><?php echo esc_html( $tag_txt ); ?></span>
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endif; ?>
					</article>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
