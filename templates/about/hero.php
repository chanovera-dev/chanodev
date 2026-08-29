<?php
/**
 * Template part for displaying the About Page Hero section
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- 1. Hero Section -->
<section class="block about-hero-block">
	<div class="content">
		<div class="about-hero-grid">
			<div class="about-hero-copy">
				<?php if ( ! empty( $about_kicker ) ) : ?>
					<span class="sub-heading"><?php echo esc_html( $about_kicker ); ?></span>
				<?php endif; ?>

				<?php if ( ! empty( $about_title ) ) : ?>
					<h1 class="about-main-title"><?php echo esc_html( $about_title ); ?></h1>
				<?php endif; ?>

				<?php if ( ! empty( $about_lead ) ) : ?>
					<p class="about-main-description"><?php echo esc_html( $about_lead ); ?></p>
				<?php endif; ?>

				<div class="about-hero-actions">
					<?php if ( ! empty( $primary_btn_txt ) ) : ?>
						<a href="<?php echo esc_url( $primary_btn_url ); ?>" class="btn primary">
							<?php echo esc_html( $primary_btn_txt ); ?>
							<?php stories_svg( 'arrow-right-circle' ); ?>
						</a>
					<?php endif; ?>

					<?php if ( ! empty( $secondary_btn_txt ) ) : ?>
						<a href="<?php echo esc_url( $secondary_btn_url ); ?>" class="btn hollow outline">
							<?php echo esc_html( $secondary_btn_txt ); ?>
						</a>
					<?php endif; ?>
				</div>

				<?php if ( ! empty( $trust_badge_txt ) ) : ?>
					<div class="about-trust-line">
						<span class="status-pulse-dot" aria-hidden="true"></span>
						<?php echo esc_html( $trust_badge_txt ); ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="about-hero-visual" aria-label="<?php esc_attr_e( 'Ficha técnica y perfil interactivo de Chano Vera', 'chanodev' ); ?>">
				<div class="profile-terminal-window">
					<div class="profile-terminal-header">
						<div class="terminal-dots">
							<span></span><span></span><span></span>
						</div>
						<strong class="terminal-file-title"><?php echo esc_html( $profile_file_title ); ?></strong>
						<?php if ( ! empty( $profile_badge_live ) ) : ?>
							<span class="terminal-badge-live">
								<span class="status-pulse-dot"></span>
								<?php echo esc_html( $profile_badge_live ); ?>
							</span>
						<?php endif; ?>
					</div>

					<div class="profile-terminal-body">
						<div class="profile-avatar-row">
							<div class="profile-avatar-badge">
								<?php if ( ! empty( $profile_avatar_img ) ) : ?>
									<img src="<?php echo esc_url( is_array( $profile_avatar_img ) ? $profile_avatar_img['url'] : $profile_avatar_img ); ?>" alt="<?php echo esc_attr( $profile_name ); ?>" width="44" height="44" />
								<?php else : ?>
									<span><?php echo esc_html( $profile_initials ); ?></span>
								<?php endif; ?>
							</div>
							<div class="profile-avatar-info">
								<strong class="profile-avatar-name"><?php echo esc_html( $profile_name ); ?></strong>
								<p><?php echo esc_html( $profile_role ); ?></p>
								<small><?php stories_svg( 'location' ); ?> <?php echo esc_html( $profile_location ); ?></small>
							</div>
						</div>

						<div class="profile-code-snippet">
							<pre><code><span class="code-key">"focus"</span>: [<?php echo implode( ', ', array_map( function( $t ) { return '<span class="code-str">"' . esc_html( trim( is_array( $t ) ? ( $t['tag'] ?? ( $t['name'] ?? '' ) ) : $t ) ) . '"</span>'; }, $profile_focus_arr ) ); ?>],
<span class="code-key">"metrics"</span>: { <span class="code-key">"cwv"</span>: <span class="code-num"><?php echo esc_html( $profile_metric_cwv ); ?></span>, <span class="code-key">"lcp"</span>: <span class="code-str">"<?php echo esc_html( $profile_metric_lcp ); ?>"</span>, <span class="code-key">"cls"</span>: <span class="code-num"><?php echo esc_html( $profile_metric_cls ); ?></span> },
<span class="code-key">"standard"</span>: <span class="code-str">"<?php echo esc_html( $profile_standard ); ?>"</span></code></pre>
						</div>

						<div class="profile-links-row">
							<?php if ( ! empty( $profile_github_url ) ) : ?>
								<a href="<?php echo esc_url( $profile_github_url ); ?>" target="_blank" rel="noopener noreferrer" class="profile-social-chip">
									<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
									<span><?php echo esc_html( $profile_github_txt ); ?></span>
								</a>
							<?php endif; ?>
							<?php if ( ! empty( $profile_verified ) ) : ?>
								<span class="profile-verified-badge">
									<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
									<?php echo esc_html( $profile_verified ); ?>
								</span>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
