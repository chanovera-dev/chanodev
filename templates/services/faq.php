<?php
/**
 * Template part for displaying the Services Page FAQ section
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- 6. FAQ Section -->
<section class="block services-faq-section">
	<div class="content">
		<div class="section-heading-center" data-reveal="fade-up">
			<?php if ( ! empty( $faq_kicker ) ) : ?>
				<span class="sub-heading"><?php echo esc_html( $faq_kicker ); ?></span>
			<?php endif; ?>
			<h2><?php echo esc_html( $faq_title ); ?></h2>
			<p class="faq-subtitle"><?php esc_html_e( 'Claridad y transparencia antes de iniciar cualquier colaboración.', 'chanodev' ); ?></p>
		</div>

		<?php if ( ! empty( $faqs ) ) : ?>
			<div class="faq-accordion-wrapper" data-reveal-stagger>
				<?php foreach ( $faqs as $i => $faq ) : ?>
					<?php
					$question = ! empty( $faq['question'] ) ? $faq['question'] : '';
					$answer   = ! empty( $faq['answer'] ) ? $faq['answer'] : '';
					$is_open  = ( 0 === $i );
					?>
					<details class="faq-item" data-reveal="fade-up" <?php echo $is_open ? 'open' : ''; ?>>
						<summary class="faq-question">
							<span class="faq-question-text">
								<span class="faq-number"><?php printf( '%02d', $i + 1 ); ?></span>
								<?php echo esc_html( $question ); ?>
							</span>
							<span class="faq-toggle-icon" aria-hidden="true">
								<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
							</span>
						</summary>
						<div class="faq-answer-wrapper">
							<div class="faq-answer-inner">
								<div class="faq-answer-content">
									<p><?php echo esc_html( $answer ); ?></p>
								</div>
							</div>
						</div>
					</details>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
