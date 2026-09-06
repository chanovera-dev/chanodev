<?php
/**
 * Template Name: Agregar Proyecto
 * Description: High-end project publishing dashboard for administrators with E-E-A-T metadata and modal preview.
 *
 * @package ChanoDev
 */

// 1. Access Control: Only logged-in administrators or users with publish privileges
if ( ! is_user_logged_in() || ! current_user_can( 'publish_posts' ) ) {
	get_header();
	?>
	<main id="main" class="site-main admin-restricted-page" role="main">
		<section class="block restricted-access-block">
			<div class="content">
				<div class="restricted-card" data-reveal="fade-up">
					<div class="restricted-icon" aria-hidden="true">
						<svg width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
							<path d="M7 11V7a5 5 0 0 1 10 0v4"/>
						</svg>
					</div>
					<h2><?php esc_html_e( 'Panel Exclusivo de Administración', 'chanodev' ); ?></h2>
					<p><?php esc_html_e( 'Esta área está reservada para la gestión y alta de proyectos en el portafolio profesional. Por favor inicia sesión con tu cuenta autorizada.', 'chanodev' ); ?></p>
					<div class="restricted-actions">
						<a href="<?php echo esc_url( wp_login_url( get_permalink() ) ); ?>" class="btn-builder-action btn-primary">
							<?php esc_html_e( 'Iniciar Sesión', 'chanodev' ); ?>
						</a>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-builder-action btn-secondary">
							<?php esc_html_e( 'Volver al Inicio', 'chanodev' ); ?>
						</a>
					</div>
				</div>
			</div>
		</section>
	</main>
	<?php
	get_footer();
	exit;
}

// 2. Form Processing Logic
$errors         = array();
$success_msg    = '';
$new_post_link  = '';
$edit_post_link = '';

if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['chanodev_add_project_nonce'] ) ) {
	if ( ! wp_verify_nonce( sanitize_key( $_POST['chanodev_add_project_nonce'] ), 'chanodev_add_project_action' ) ) {
		$errors[] = __( 'El token de seguridad ha caducado. Por favor, recarga la página e inténtalo nuevamente.', 'chanodev' );
	} else {
		$title       = isset( $_POST['project_title'] ) ? sanitize_text_field( wp_unslash( $_POST['project_title'] ) ) : '';
		$excerpt     = isset( $_POST['project_excerpt'] ) ? sanitize_textarea_field( wp_unslash( $_POST['project_excerpt'] ) ) : '';
		$content     = isset( $_POST['project_content'] ) ? wp_kses_post( wp_unslash( $_POST['project_content'] ) ) : '';
		$client      = isset( $_POST['project_client'] ) ? sanitize_text_field( wp_unslash( $_POST['project_client'] ) ) : '';
		$role        = isset( $_POST['project_role'] ) ? sanitize_text_field( wp_unslash( $_POST['project_role'] ) ) : '';
		$live_url    = isset( $_POST['project_live_url'] ) ? esc_url_raw( wp_unslash( $_POST['project_live_url'] ) ) : '';
		$repo_url    = isset( $_POST['project_repo_url'] ) ? esc_url_raw( wp_unslash( $_POST['project_repo_url'] ) ) : '';
		$year        = isset( $_POST['project_year'] ) ? sanitize_text_field( wp_unslash( $_POST['project_year'] ) ) : date( 'Y' );
		$metrics     = isset( $_POST['project_metrics'] ) ? sanitize_text_field( wp_unslash( $_POST['project_metrics'] ) ) : '';
		$challenge   = isset( $_POST['project_challenge'] ) ? wp_kses_post( wp_unslash( $_POST['project_challenge'] ) ) : '';
		$solution    = isset( $_POST['project_solution'] ) ? wp_kses_post( wp_unslash( $_POST['project_solution'] ) ) : '';
		$post_status = ( isset( $_POST['post_status'] ) && in_array( $_POST['post_status'], array( 'publish', 'draft' ), true ) ) ? sanitize_key( $_POST['post_status'] ) : 'publish';

		// Form Validation
		if ( empty( $title ) ) {
			$errors[] = __( 'El título del proyecto es un campo obligatorio.', 'chanodev' );
		}

		if ( empty( $errors ) ) {
			// Insert Project Post
			$post_data = array(
				'post_title'   => $title,
				'post_content' => $content,
				'post_excerpt' => $excerpt,
				'post_status'  => $post_status,
				'post_type'    => 'project',
				'post_author'  => get_current_user_id(),
			);

			$new_post_id = wp_insert_post( $post_data, true );

			if ( is_wp_error( $new_post_id ) ) {
				$errors[] = $new_post_id->get_error_message();
			} else {
				// Require WP Media Handling Libraries
				require_once ABSPATH . 'wp-admin/includes/image.php';
				require_once ABSPATH . 'wp-admin/includes/file.php';
				require_once ABSPATH . 'wp-admin/includes/media.php';

				// 1. Upload & Set Featured Image (Cover)
				if ( ! empty( $_FILES['project_cover']['name'] ) ) {
					$cover_id = media_handle_upload( 'project_cover', $new_post_id );
					if ( ! is_wp_error( $cover_id ) ) {
						set_post_thumbnail( $new_post_id, $cover_id );
					} else {
						$errors[] = __( 'Error al subir la imagen de portada: ', 'chanodev' ) . $cover_id->get_error_message();
					}
				}

				// 2. Upload Additional Gallery Screenshots
				if ( ! empty( $_FILES['project_gallery']['name'][0] ) ) {
					$files       = $_FILES['project_gallery'];
					$gallery_ids = array();

					foreach ( $files['name'] as $key => $val ) {
						if ( ! empty( $files['name'][ $key ] ) ) {
							$file_item = array(
								'name'     => $files['name'][ $key ],
								'type'     => $files['type'][ $key ],
								'tmp_name' => $files['tmp_name'][ $key ],
								'error'    => $files['error'][ $key ],
								'size'     => $files['size'][ $key ],
							);

							$_FILES['single_gallery_item'] = $file_item;
							$attach_id = media_handle_upload( 'single_gallery_item', $new_post_id );
							if ( ! is_wp_error( $attach_id ) ) {
								$gallery_ids[] = $attach_id;
							}
						}
					}

					if ( ! empty( $gallery_ids ) ) {
						update_post_meta( $new_post_id, '_chanodev_project_gallery', $gallery_ids );
					}
				}

				// 3. Save Custom Meta Fields (E-E-A-T Portfolio Data)
				update_post_meta( $new_post_id, '_chanodev_project_client', $client );
				update_post_meta( $new_post_id, '_chanodev_project_role', $role );
				update_post_meta( $new_post_id, '_chanodev_project_live_url', $live_url );
				update_post_meta( $new_post_id, '_chanodev_project_repo_url', $repo_url );
				update_post_meta( $new_post_id, '_chanodev_project_year', $year );
				update_post_meta( $new_post_id, '_chanodev_project_metrics', $metrics );
				update_post_meta( $new_post_id, '_chanodev_project_challenge', $challenge );
				update_post_meta( $new_post_id, '_chanodev_project_solution', $solution );

				// 4. Save Project Type Taxonomy
				if ( ! empty( $_POST['project_type_single'] ) ) {
					$single_type = intval( $_POST['project_type_single'] );
					if ( $single_type > 0 ) {
						wp_set_object_terms( $new_post_id, array( $single_type ), 'project_type' );
					}
				}

				// New Project Type inline creation
				if ( ! empty( $_POST['new_project_type'] ) ) {
					$new_type_name = sanitize_text_field( wp_unslash( $_POST['new_project_type'] ) );
					$term_info     = term_exists( $new_type_name, 'project_type' );
					if ( ! $term_info ) {
						$term_info = wp_insert_term( $new_type_name, 'project_type' );
					}
					if ( ! is_wp_error( $term_info ) && isset( $term_info['term_id'] ) ) {
						wp_set_object_terms( $new_post_id, (int) $term_info['term_id'], 'project_type', true );
					}
				}

				// 5. Save Technologies Taxonomy
				if ( ! empty( $_POST['project_technologies'] ) ) {
					$tech_list = explode( ',', sanitize_text_field( wp_unslash( $_POST['project_technologies'] ) ) );
					$tech_list = array_map( 'trim', $tech_list );
					$tech_list = array_filter( $tech_list );
					if ( ! empty( $tech_list ) ) {
						wp_set_object_terms( $new_post_id, $tech_list, 'project_technology' );
					}
				}

				$status_label   = ( 'draft' === $post_status ) ? __( 'guardado como borrador privado', 'chanodev' ) : __( 'publicado con éxito en el portafolio', 'chanodev' );
				$success_msg    = sprintf( __( '¡Proyecto "%1$s" %2$s!', 'chanodev' ), esc_html( $title ), esc_html( $status_label ) );
				$new_post_link  = get_permalink( $new_post_id );
				$edit_post_link = get_edit_post_link( $new_post_id );
			}
		}
	}
}

// Fetch existing taxonomy terms for the form
$all_project_types = get_terms( array(
	'taxonomy'   => 'project_type',
	'hide_empty' => false,
) );

// Curated tech stack chips for 1-click toggling
$stack_pills = array(
	'WordPress', 'WooCommerce', 'React', 'Next.js', 'Node.js',
	'PHP 8', 'TypeScript', 'Tailwind CSS', 'GraphQL', 'REST API',
	'WPO', 'Core Web Vitals', 'MySQL', 'Docker', 'Stripe', 'ACF Pro'
);

// High-converting impact metrics
$metric_pills = array(
	'+140% Conversión',
	'99 PageSpeed Móvil',
	'LCP 0.6s Ultrarrápido',
	'+250K Visitas/mes',
	'100% Core Web Vitals',
	'-60% TTFB Servidor'
);

get_header();
?>

<main id="main" class="site-main project-builder-page" role="main">

	<!-- Hero & Quick Controls Header -->
	<section class="block builder-hero-block">
		<div class="content">
			<div class="builder-hero-inner">
				<div class="builder-hero-header">
					<div class="builder-kicker">
						<span class="status-pulse-dot" aria-hidden="true"></span>
						<span><?php esc_html_e( 'Panel de Creación de Proyectos', 'chanodev' ); ?></span>
					</div>
					<h1 class="builder-main-title"><?php esc_html_e( 'Publicar Proyecto en Portafolio', 'chanodev' ); ?></h1>
					<p class="builder-subtitle">
						<?php esc_html_e( 'Rellena los datos clave, reto técnico e imágenes. Todo el contenido se optimiza automáticamente para SEO y credenciales E-E-A-T.', 'chanodev' ); ?>
					</p>
				</div>

				<!-- Quick Actions & Presets Toolbar -->
				<div class="builder-toolbar-card">
					<div class="toolbar-presets">
						<span class="toolbar-label">
							<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.9 5.8a2 2 0 0 1-1.3 1.3L3 12l5.8 1.9a2 2 0 0 1 1.3 1.3L12 21l1.9-5.8a2 2 0 0 1 1.3-1.3L21 12l-5.8-1.9a2 2 0 0 1-1.3-1.3L12 3z"/></svg>
							<?php esc_html_e( 'Cargar plantilla rápida:', 'chanodev' ); ?>
						</span>
						<div class="preset-pill-group">
							<button type="button" class="preset-pill" data-preset="xmeetings">
								📅 <?php esc_html_e( 'X-Meetings SaaS', 'chanodev' ); ?>
							</button>
							<button type="button" class="preset-pill" data-preset="stories">
								📖 <?php esc_html_e( 'Tema Stories', 'chanodev' ); ?>
							</button>
							<button type="button" class="preset-pill" data-preset="woocommerce">
								🛒 <?php esc_html_e( 'WooCommerce B2B', 'chanodev' ); ?>
							</button>
							<button type="button" class="preset-pill" data-preset="webapp">
								⚡ <?php esc_html_e( 'Web App React / Next.js', 'chanodev' ); ?>
							</button>
							<button type="button" class="preset-pill" data-preset="corporate">
								🏢 <?php esc_html_e( 'Corporativo & WPO', 'chanodev' ); ?>
							</button>
						</div>
					</div>

					<div class="toolbar-actions">
						<button type="button" class="btn-preview-trigger" id="btnOpenPreviewModal">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
							<span><?php esc_html_e( 'Ver Vista Previa', 'chanodev' ); ?></span>
						</button>
						<a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>" class="btn-toolbar-link" target="_blank" rel="noopener">
							<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
							<span><?php esc_html_e( 'Portafolio', 'chanodev' ); ?></span>
						</a>
						<button type="button" class="btn-toolbar-ghost" id="btnResetForm" title="<?php esc_attr_e( 'Limpiar formulario', 'chanodev' ); ?>">
							<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/></svg>
						</button>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Main Form Content Section -->
	<section class="block builder-form-block">
		<div class="content">

			<!-- Success Notification -->
			<?php if ( ! empty( $success_msg ) ) : ?>
				<div class="feedback-banner success" role="alert">
					<div class="feedback-icon">
						<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
					</div>
					<div class="feedback-body">
						<strong class="feedback-title"><?php echo esc_html( $success_msg ); ?></strong>
						<p class="feedback-desc"><?php esc_html_e( 'El proyecto ha sido procesado e indexado con todos sus metadatos y galerías asociadas.', 'chanodev' ); ?></p>
						<div class="feedback-links">
							<a href="<?php echo esc_url( $new_post_link ); ?>" class="btn-builder-action btn-primary btn-sm" target="_blank" rel="noopener">
								<?php esc_html_e( 'Ver Proyecto Publicado ↗', 'chanodev' ); ?>
							</a>
							<?php if ( ! empty( $edit_post_link ) ) : ?>
								<a href="<?php echo esc_url( $edit_post_link ); ?>" class="btn-builder-action btn-secondary btn-sm" target="_blank" rel="noopener">
									<?php esc_html_e( 'Editar en WordPress', 'chanodev' ); ?>
								</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<!-- Error Notification -->
			<?php if ( ! empty( $errors ) ) : ?>
				<div class="feedback-banner error" role="alert">
					<div class="feedback-icon">
						<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
					</div>
					<div class="feedback-body">
						<strong class="feedback-title"><?php esc_html_e( 'Por favor corrige los siguientes puntos:', 'chanodev' ); ?></strong>
						<ul class="feedback-list">
							<?php foreach ( $errors as $err ) : ?>
								<li><?php echo esc_html( $err ); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			<?php endif; ?>

			<!-- Draft Auto-restored Toast -->
			<div class="draft-saved-toast" id="draftSavedToast" style="display: none;">
				<div class="toast-content">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
					<span><?php esc_html_e( 'Borrador anterior recuperado automáticamente.', 'chanodev' ); ?></span>
				</div>
				<button type="button" class="toast-close" id="btnDismissToast">✕</button>
			</div>

			<!-- Main Clean Form Container (Focused Single-Stream Layout) -->
			<form method="post" action="<?php echo esc_url( get_permalink() ); ?>" enctype="multipart/form-data" class="builder-central-form" id="projectBuilderForm">
				<?php wp_nonce_field( 'chanodev_add_project_action', 'chanodev_add_project_nonce' ); ?>

				<!-- SECTION 1: Identity & Categorization -->
				<div class="form-surface-panel">
					<div class="panel-header">
						<div class="panel-step-badge">1</div>
						<div class="panel-header-text">
							<h2><?php esc_html_e( 'Identidad & Enfoque del Proyecto', 'chanodev' ); ?></h2>
							<p><?php esc_html_e( 'Título descriptivo, categoría principal y el extracto visible en los listados del portafolio.', 'chanodev' ); ?></p>
						</div>
					</div>

					<div class="panel-body">
						<!-- Project Title -->
						<div class="field-wrap">
							<div class="field-meta-row">
								<label for="project_title" class="input-label required"><?php esc_html_e( 'Título del Proyecto', 'chanodev' ); ?></label>
								<span class="input-char-counter" id="titleCounter">0 / 70</span>
							</div>
							<input
								type="text"
								id="project_title"
								name="project_title"
								class="clean-input input-headline"
								placeholder="<?php esc_attr_e( 'ej. Rediseño & Optimización Headless para Plataforma B2B', 'chanodev' ); ?>"
								required
								maxlength="120"
								value="<?php echo isset( $_POST['project_title'] ) ? esc_attr( wp_unslash( $_POST['project_title'] ) ) : ''; ?>"
								autocomplete="off"
							>
						</div>

						<!-- Project Type Pill Selector -->
						<div class="field-wrap">
							<label class="input-label"><?php esc_html_e( 'Tipo de Proyecto (Categoría)', 'chanodev' ); ?></label>
							<div class="type-pill-grid">
								<?php
								if ( ! empty( $all_project_types ) && ! is_wp_error( $all_project_types ) ) :
									$first = true;
									foreach ( $all_project_types as $type_term ) :
										?>
										<label class="type-pill-choice">
											<input
												type="radio"
												name="project_type_single"
												value="<?php echo esc_attr( $type_term->term_id ); ?>"
												data-name="<?php echo esc_attr( $type_term->name ); ?>"
												<?php echo $first ? 'checked' : ''; ?>
											>
											<span class="type-pill-card">
												<span class="type-pill-indicator"></span>
												<span class="type-pill-name"><?php echo esc_html( $type_term->name ); ?></span>
											</span>
										</label>
										<?php
										$first = false;
									endforeach;
								else :
									?>
									<label class="type-pill-choice">
										<input type="radio" name="project_type_single" value="0" data-name="Desarrollo Web" checked>
										<span class="type-pill-card">
											<span class="type-pill-indicator"></span>
											<span class="type-pill-name"><?php esc_html_e( 'Desarrollo Web', 'chanodev' ); ?></span>
										</span>
									</label>
								<?php endif; ?>
							</div>

							<div class="inline-type-input-wrap">
								<input
									type="text"
									name="new_project_type"
									id="new_project_type"
									class="clean-input input-sm"
									placeholder="<?php esc_attr_e( '+ ¿No está en la lista? Crea una nueva categoría aquí...', 'chanodev' ); ?>"
								>
							</div>
						</div>

						<!-- Project Excerpt -->
						<div class="field-wrap">
							<div class="field-meta-row">
								<label for="project_excerpt" class="input-label"><?php esc_html_e( 'Extracto / Resumen Ejecutivo (1-2 frases)', 'chanodev' ); ?></label>
								<span class="input-char-counter" id="excerptCounter">0 / 220</span>
							</div>
							<textarea
								id="project_excerpt"
								name="project_excerpt"
								class="clean-textarea"
								rows="3"
								placeholder="<?php esc_attr_e( 'Breve descripción que resume la arquitectura construida y el impacto directo para el negocio...', 'chanodev' ); ?>"
								maxlength="300"
							><?php echo isset( $_POST['project_excerpt'] ) ? esc_textarea( wp_unslash( $_POST['project_excerpt'] ) ) : ''; ?></textarea>
							<span class="field-footnote"><?php esc_html_e( 'Aparece en las tarjetas del portafolio, en la metaetiqueta SEO description y al compartir en redes sociales.', 'chanodev' ); ?></span>
						</div>
					</div>
				</div>

				<!-- SECTION 2: Technical Credentials & E-E-A-T Data -->
				<div class="form-surface-panel">
					<div class="panel-header">
						<div class="panel-step-badge">2</div>
						<div class="panel-header-text">
							<h2><?php esc_html_e( 'Ficha Técnica & Credenciales E-E-A-T', 'chanodev' ); ?></h2>
							<p><?php esc_html_e( 'Métricas comprobables, rol desempeñado y enlaces directos para validar la experiencia.', 'chanodev' ); ?></p>
						</div>
					</div>

					<div class="panel-body">
						<div class="grid-two-fields">
							<div class="field-wrap">
								<label for="project_client" class="input-label"><?php esc_html_e( 'Cliente / Organización', 'chanodev' ); ?></label>
								<div class="icon-input-container">
									<span class="field-leading-icon">
										<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"/><path d="M19 21v-4"/><path d="M19 17a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v4"/><rect width="10" height="12" x="7" y="3" rx="1"/></svg>
									</span>
									<input
										type="text"
										id="project_client"
										name="project_client"
										class="clean-input with-icon"
										placeholder="<?php esc_attr_e( 'ej. Acme Global Corp / Startup de Logística', 'chanodev' ); ?>"
										value="<?php echo isset( $_POST['project_client'] ) ? esc_attr( wp_unslash( $_POST['project_client'] ) ) : ''; ?>"
									>
								</div>
							</div>

							<div class="field-wrap">
								<label for="project_role" class="input-label"><?php esc_html_e( 'Rol Técnico Desempeñado', 'chanodev' ); ?></label>
								<div class="icon-input-container">
									<span class="field-leading-icon">
										<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
									</span>
									<input
										type="text"
										id="project_role"
										name="project_role"
										class="clean-input with-icon"
										placeholder="<?php esc_attr_e( 'ej. Lead Full-Stack Developer & WPO Architect', 'chanodev' ); ?>"
										value="<?php echo isset( $_POST['project_role'] ) ? esc_attr( wp_unslash( $_POST['project_role'] ) ) : ''; ?>"
									>
								</div>
							</div>
						</div>

						<div class="grid-two-fields">
							<div class="field-wrap">
								<label for="project_live_url" class="input-label"><?php esc_html_e( 'URL del Sitio Web en Vivo', 'chanodev' ); ?></label>
								<div class="icon-input-container">
									<span class="field-leading-icon">
										<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
									</span>
									<input
										type="url"
										id="project_live_url"
										name="project_live_url"
										class="clean-input with-icon"
										placeholder="https://ejemplo.com"
										value="<?php echo isset( $_POST['project_live_url'] ) ? esc_url( wp_unslash( $_POST['project_live_url'] ) ) : ''; ?>"
									>
								</div>
							</div>

							<div class="field-wrap">
								<label for="project_repo_url" class="input-label"><?php esc_html_e( 'Repositorio de Código (GitHub / GitLab)', 'chanodev' ); ?></label>
								<div class="icon-input-container">
									<span class="field-leading-icon">
										<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/></svg>
									</span>
									<input
										type="url"
										id="project_repo_url"
										name="project_repo_url"
										class="clean-input with-icon"
										placeholder="https://github.com/chanovera-dev/repo"
										value="<?php echo isset( $_POST['project_repo_url'] ) ? esc_url( wp_unslash( $_POST['project_repo_url'] ) ) : ''; ?>"
									>
								</div>
							</div>
						</div>

						<div class="grid-two-fields">
							<div class="field-wrap">
								<label for="project_year" class="input-label"><?php esc_html_e( 'Año de Finalización', 'chanodev' ); ?></label>
								<div class="icon-input-container">
									<span class="field-leading-icon">
										<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
									</span>
									<input
										type="text"
										id="project_year"
										name="project_year"
										class="clean-input with-icon"
										placeholder="<?php echo esc_attr( date( 'Y' ) ); ?>"
										value="<?php echo isset( $_POST['project_year'] ) ? esc_attr( wp_unslash( $_POST['project_year'] ) ) : date( 'Y' ); ?>"
									>
								</div>
							</div>

							<div class="field-wrap">
								<label for="project_metrics" class="input-label"><?php esc_html_e( 'Impacto / Métrica Clave Comprobable', 'chanodev' ); ?></label>
								<div class="icon-input-container">
									<span class="field-leading-icon">
										<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 14 4-4"/><path d="M3.34 19a10 10 0 1 1 17.32 0"/></svg>
									</span>
									<input
										type="text"
										id="project_metrics"
										name="project_metrics"
										class="clean-input with-icon"
										placeholder="<?php esc_attr_e( 'ej. +140% Conversión, 99 PageSpeed, LCP 0.6s', 'chanodev' ); ?>"
										value="<?php echo isset( $_POST['project_metrics'] ) ? esc_attr( wp_unslash( $_POST['project_metrics'] ) ) : ''; ?>"
									>
								</div>
							</div>
						</div>

						<!-- Suggested Metric Chips -->
						<div class="fast-pills-row">
							<span class="fast-pills-label"><?php esc_html_e( 'Insertar métrica rápida:', 'chanodev' ); ?></span>
							<div class="fast-pills-container">
								<?php foreach ( $metric_pills as $mpill ) : ?>
									<button type="button" class="metric-quick-pill" data-val="<?php echo esc_attr( $mpill ); ?>">
										+ <?php echo esc_html( $mpill ); ?>
									</button>
								<?php endforeach; ?>
							</div>
						</div>

						<!-- Technical Challenge & Solution Callout Boxes -->
						<div class="case-study-dual-grid">
							<div class="callout-entry-box warning-theme">
								<div class="callout-entry-header">
									<span class="callout-icon">⚠️</span>
									<label for="project_challenge" class="input-label-callout">
										<?php esc_html_e( 'El Reto Técnico / Problema Inicial', 'chanodev' ); ?>
									</label>
								</div>
								<textarea
									id="project_challenge"
									name="project_challenge"
									class="clean-textarea callout-textarea"
									rows="4"
									placeholder="<?php esc_attr_e( 'Describe la situación antes de tu intervención: lentitud, caídas bajo tráfico, código espagueti o cuellos de botella...', 'chanodev' ); ?>"
								><?php echo isset( $_POST['project_challenge'] ) ? esc_textarea( wp_unslash( $_POST['project_challenge'] ) ) : ''; ?></textarea>
							</div>

							<div class="callout-entry-box success-theme">
								<div class="callout-entry-header">
									<span class="callout-icon">💡</span>
									<label for="project_solution" class="input-label-callout">
										<?php esc_html_e( 'La Solución de Ingeniería Aplicada', 'chanodev' ); ?>
									</label>
								</div>
								<textarea
									id="project_solution"
									name="project_solution"
									class="clean-textarea callout-textarea"
									rows="4"
									placeholder="<?php esc_attr_e( 'Describe la arquitectura implementada: refactorización limpia, optimización de base de datos, APIs personalizadas...', 'chanodev' ); ?>"
								><?php echo isset( $_POST['project_solution'] ) ? esc_textarea( wp_unslash( $_POST['project_solution'] ) ) : ''; ?></textarea>
							</div>
						</div>
					</div>
				</div>

				<!-- SECTION 3: Deep Technical Narrative (Full Story) -->
				<div class="form-surface-panel">
					<div class="panel-header">
						<div class="panel-step-badge">3</div>
						<div class="panel-header-text">
							<h2><?php esc_html_e( 'Historia & Caso de Estudio Completo', 'chanodev' ); ?></h2>
							<p><?php esc_html_e( 'Desarrollo en profundidad de la arquitectura para el artículo individual del proyecto.', 'chanodev' ); ?></p>
						</div>
					</div>

					<div class="panel-body">
						<div class="field-wrap">
							<!-- Markdown Helper Toolbar -->
							<div class="clean-editor-toolbar" role="toolbar" aria-label="<?php esc_attr_e( 'Barra de formato', 'chanodev' ); ?>">
								<button type="button" class="fmt-btn" data-insert="**" data-wrap="true" title="Negrita"><strong>B</strong></button>
								<button type="button" class="fmt-btn" data-insert="*" data-wrap="true" title="Cursiva"><em>I</em></button>
								<button type="button" class="fmt-btn" data-prefix="### " title="Encabezado H3">H3</button>
								<button type="button" class="fmt-btn" data-prefix="- " title="Elemento de lista">• Lista</button>
								<button type="button" class="fmt-btn" data-prefix="> " title="Cita en bloque">❝ Cita</button>
								<button type="button" class="fmt-btn" data-insert="`" data-wrap="true" title="Código inline">&lt;/&gt;</button>
								<button type="button" class="fmt-btn" data-link="true" title="Enlace">🔗 Enlace</button>
							</div>
							<textarea
								id="project_content"
								name="project_content"
								class="clean-textarea editor-textarea"
								rows="8"
								placeholder="<?php esc_attr_e( 'Explica el alcance del proyecto, las fases de implementación, la seguridad y los aprendizajes técnicos...', 'chanodev' ); ?>"
							><?php echo isset( $_POST['project_content'] ) ? esc_textarea( wp_unslash( $_POST['project_content'] ) ) : ''; ?></textarea>
						</div>
					</div>
				</div>

				<!-- SECTION 4: Tech Stack Selection -->
				<div class="form-surface-panel">
					<div class="panel-header">
						<div class="panel-step-badge">4</div>
						<div class="panel-header-text">
							<h2><?php esc_html_e( 'Stack Tecnológico & Herramientas', 'chanodev' ); ?></h2>
							<p><?php esc_html_e( 'Haz clic en las tecnologías empleadas para agregarlas automáticamente a las etiquetas del portafolio.', 'chanodev' ); ?></p>
						</div>
					</div>

					<div class="panel-body">
						<div class="field-wrap">
							<label for="project_technologies" class="input-label"><?php esc_html_e( 'Tecnologías Seleccionadas (separadas por coma)', 'chanodev' ); ?></label>
							<input
								type="text"
								id="project_technologies"
								name="project_technologies"
								class="clean-input"
								placeholder="WordPress, React, TypeScript, Core Web Vitals..."
								value="<?php echo isset( $_POST['project_technologies'] ) ? esc_attr( wp_unslash( $_POST['project_technologies'] ) ) : 'WordPress, React'; ?>"
							>
						</div>

						<div class="interactive-stack-cloud">
							<?php foreach ( $stack_pills as $tech ) : ?>
								<button type="button" class="interactive-tech-pill" data-tech="<?php echo esc_attr( $tech ); ?>">
									<span class="pill-add-icon">+</span>
									<span class="pill-label-text"><?php echo esc_html( $tech ); ?></span>
								</button>
							<?php endforeach; ?>
						</div>
					</div>
				</div>

				<!-- SECTION 5: Media & Screenshots -->
				<div class="form-surface-panel">
					<div class="panel-header">
						<div class="panel-step-badge">5</div>
						<div class="panel-header-text">
							<h2><?php esc_html_e( 'Imágenes & Capturas de Pantalla', 'chanodev' ); ?></h2>
							<p><?php esc_html_e( 'Sube la imagen destacada principal y capturas adicionales del sitio o interfaz.', 'chanodev' ); ?></p>
						</div>
					</div>

					<div class="panel-body">
						<div class="grid-two-fields">
							<!-- Featured Image Upload Dropzone -->
							<div class="field-wrap">
								<label class="input-label required"><?php esc_html_e( 'Imagen de Portada (Cover Principal)', 'chanodev' ); ?></label>
								<div class="custom-dropzone" id="coverDropzone">
									<input
										type="file"
										name="project_cover"
										id="project_cover"
										accept="image/jpeg,image/png,image/webp,image/svg+xml"
										class="dropzone-hidden-input"
										required
									>
									<div class="dropzone-default-ui" id="coverDropzoneDefault">
										<div class="dropzone-icon-circle">
											<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
										</div>
										<strong class="dropzone-primary-text"><?php esc_html_e( 'Arrastra o haz clic para subir portada', 'chanodev' ); ?></strong>
										<span class="dropzone-sub-text"><?php esc_html_e( 'JPG, WebP, PNG (Recomendado 1600x1000px)', 'chanodev' ); ?></span>
									</div>
									<div class="dropzone-preview-ui" id="coverDropzonePreview" style="display: none;">
										<img src="" alt="Portada seleccionada" id="coverPreviewThumb">
										<div class="dropzone-preview-overlay">
											<span class="file-name-pill" id="coverNamePill"></span>
											<button type="button" class="btn-remove-thumb" id="btnRemoveCoverThumb">
												✕ <?php esc_html_e( 'Cambiar imagen', 'chanodev' ); ?>
											</button>
										</div>
									</div>
								</div>
							</div>

							<!-- Multiple Gallery Upload Dropzone -->
							<div class="field-wrap">
								<label class="input-label"><?php esc_html_e( 'Galería de Capturas Adicionales', 'chanodev' ); ?></label>
								<div class="custom-dropzone gallery-dropzone" id="galleryDropzone">
									<input
										type="file"
										name="project_gallery[]"
										id="project_gallery"
										accept="image/jpeg,image/png,image/webp,image/svg+xml"
										multiple
										class="dropzone-hidden-input"
									>
									<div class="dropzone-default-ui" id="galleryDropzoneDefault">
										<div class="dropzone-icon-circle">
											<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
										</div>
										<strong class="dropzone-primary-text"><?php esc_html_e( '+ Subir capturas de interfaz', 'chanodev' ); ?></strong>
										<span class="dropzone-sub-text"><?php esc_html_e( 'Puedes seleccionar múltiples archivos', 'chanodev' ); ?></span>
									</div>
									<div class="gallery-thumbs-row" id="galleryThumbsRow"></div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Floating Bottom Action Dock -->
				<div class="floating-submit-dock">
					<div class="dock-inner">
						<div class="dock-left">
							<div class="status-mode-selector">
								<label class="radio-tab-label">
									<input type="radio" name="post_status" value="publish" checked>
									<span class="radio-tab-pill">
										<span class="mode-dot green"></span>
										<?php esc_html_e( 'Publicar en Vivo', 'chanodev' ); ?>
									</span>
								</label>
								<label class="radio-tab-label">
									<input type="radio" name="post_status" value="draft">
									<span class="radio-tab-pill">
										<span class="mode-dot gray"></span>
										<?php esc_html_e( 'Guardar Borrador', 'chanodev' ); ?>
									</span>
								</label>
							</div>
						</div>

						<div class="dock-right">
							<button type="button" class="btn-dock-preview" id="btnDockOpenPreview">
								<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
								<span><?php esc_html_e( 'Vista Previa', 'chanodev' ); ?></span>
							</button>

							<button type="submit" class="btn-dock-submit" id="btnSubmitProject">
								<span class="submit-spinner" style="display: none;">⏳</span>
								<span class="submit-text">🚀 <?php esc_html_e( 'Guardar & Publicar Proyecto', 'chanodev' ); ?></span>
							</button>
						</div>
					</div>
				</div>

			</form>
		</div>
	</section>

	<!-- Preview Modal Dialog (Zero Clutter, Opens on Demand) -->
	<div class="preview-modal-backdrop" id="previewModalBackdrop" style="display: none;">
		<div class="preview-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="previewModalTitle">
			<div class="preview-modal-header">
				<div class="modal-title-wrap">
					<span class="modal-indicator"></span>
					<h3 id="previewModalTitle"><?php esc_html_e( 'Vista Previa en Tiempo Real', 'chanodev' ); ?></h3>
				</div>
				<button type="button" class="btn-close-modal" id="btnClosePreviewModal" aria-label="<?php esc_attr_e( 'Cerrar', 'chanodev' ); ?>">✕</button>
			</div>

			<div class="preview-modal-body">
				<div class="modal-preview-wrapper">
					<!-- Standard Loop Card Preview -->
					<article class="story-card format-standard-card chanodev-project-card has-no-thumbnail" id="simCard">
						<div class="stories-standard-container has-no-thumbnail" id="simContainer">
							<!-- Background / Pattern -->
							<div class="post-thumbnail-bg no-thumbnail-pattern" id="simThumbBg">
								<img src="" alt="Vista Previa de Portada" id="simMediaImg" style="display: none; width: 100%; height: 100%; object-fit: cover;">
							</div>

							<!-- Top Actions (Info Toggle & Like Button) -->
							<div class="post-top-actions">
								<div class="toggle-info-container inset-shadow-effect is-active" id="simToggleContainer">
									<button type="button" class="toggle-info-btn is-active" id="simToggleBtn" aria-label="<?php esc_attr_e( 'Toggle Post Info', 'stories' ); ?>" title="<?php esc_attr_e( 'Toggle Post Info', 'stories' ); ?>">
										<?php if ( function_exists( 'stories_svg' ) ) { stories_svg( 'info', array( 'size' => 18 ) ); } ?>
									</button>
								</div>
								<div class="inset-shadow-effect like-btn-container">
									<button type="button" class="button__like" aria-label="<?php esc_attr_e( 'Me gusta', 'chanodev' ); ?>" disabled>
										<?php echo ( function_exists( 'stories_get_svg' ) ? stories_get_svg( 'heart', array( 'size' => 16 ) ) : '❤' ); ?>
										<span class="like-count">12</span>
									</button>
								</div>
							</div>

							<!-- Information Overlay Card -->
							<div class="info-overlay quote-info-overlay standard-info-overlay is-visible" id="simOverlay">
								<header class="entry-header">
									<div class="entry-badge">
										<span class="project-type-badge" id="simCategoryBadge">Desarrollo Web</span>
									</div>
								</header>

								<div class="entry-body">
									<h2 class="entry-title"><a href="#" id="simTitleLink"><?php esc_html_e( 'Título de tu Nuevo Proyecto', 'chanodev' ); ?></a></h2>

									<div class="entry-meta">
										<span class="entry-date"><?php echo esc_html( date_i18n( get_option( 'date_format' ) ) ); ?></span>
										<span class="entry-client" id="simClient">🏢 Cliente: Confidencial</span>
									</div>

									<div class="entry-summary">
										<p id="simExcerpt"><?php esc_html_e( 'Aquí se visualizará el resumen ejecutivo del proyecto tal y como lo verán los visitantes en la galería pública.', 'chanodev' ); ?></p>
									</div>

									<div class="project-metric-pill" id="simMetricBadge" style="display: none;">
										<span class="metric-icon">🚀</span>
										<span class="metric-text" id="simMetricText"></span>
									</div>
								</div>

								<footer class="entry-footer">
									<div class="post--tags__wrapper">
										<div class="tags post--tags" id="simTagsList">
											<span class="post-tag small"><?php echo ( function_exists( 'stories_get_svg' ) ? stories_get_svg( 'tag', array( 'size' => 12 ) ) : '#' ); ?>WordPress</span>
										</div>
									</div>
								</footer>
							</div>

							<!-- Bottom Bar showing Title -->
							<div class="standard-bottom-bar" id="simBottomBar">
								<h2 class="entry-title"><a href="#" id="simBottomTitle"><?php esc_html_e( 'Título de tu Nuevo Proyecto', 'chanodev' ); ?></a></h2>
							</div>
						</div>
						<div class="post__overlay"></div>
					</article>
				</div>
			</div>

			<div class="preview-modal-footer">
				<button type="button" class="btn-modal-dismiss" id="btnDismissModal"><?php esc_html_e( 'Volver a Editar', 'chanodev' ); ?></button>
				<button type="button" class="btn-modal-primary" id="btnSubmitFromModal"><?php esc_html_e( 'Confirmar & Publicar', 'chanodev' ); ?></button>
			</div>
		</div>
	</div>

</main>

<script>
/**
 * Frontend Project Builder Controller
 * Features: On-demand preview modal, 1-click presets, interactive tech pills, local draft autosave.
 */
document.addEventListener("DOMContentLoaded", function () {
	const form = document.getElementById("projectBuilderForm");
	const inputTitle = document.getElementById("project_title");
	const inputExcerpt = document.getElementById("project_excerpt");
	const inputClient = document.getElementById("project_client");
	const inputRole = document.getElementById("project_role");
	const inputYear = document.getElementById("project_year");
	const inputMetrics = document.getElementById("project_metrics");
	const inputLiveUrl = document.getElementById("project_live_url");
	const inputRepoUrl = document.getElementById("project_repo_url");
	const inputChallenge = document.getElementById("project_challenge");
	const inputSolution = document.getElementById("project_solution");
	const inputContent = document.getElementById("project_content");
	const inputTechnologies = document.getElementById("project_technologies");

	// Counters
	const titleCounter = document.getElementById("titleCounter");
	const excerptCounter = document.getElementById("excerptCounter");

	// Modal Elements
	const previewModalBackdrop = document.getElementById("previewModalBackdrop");
	const btnOpenPreviewModal = document.getElementById("btnOpenPreviewModal");
	const btnDockOpenPreview = document.getElementById("btnDockOpenPreview");
	const btnClosePreviewModal = document.getElementById("btnClosePreviewModal");
	const btnDismissModal = document.getElementById("btnDismissModal");
	const btnSubmitFromModal = document.getElementById("btnSubmitFromModal");

	// Modal Simulation Elements
	const simCard = document.getElementById("simCard");
	const simContainer = document.getElementById("simContainer");
	const simThumbBg = document.getElementById("simThumbBg");
	const simMediaImg = document.getElementById("simMediaImg");
	const simTitleLink = document.getElementById("simTitleLink");
	const simBottomTitle = document.getElementById("simBottomTitle");
	const simExcerpt = document.getElementById("simExcerpt");
	const simCategoryBadge = document.getElementById("simCategoryBadge");
	const simTagsList = document.getElementById("simTagsList");
	const simMetricBadge = document.getElementById("simMetricBadge");
	const simMetricText = document.getElementById("simMetricText");
	const simClient = document.getElementById("simClient");

	// 1. Character Counters
	function updateCounters() {
		if (inputTitle && titleCounter) {
			const len = inputTitle.value.length;
			titleCounter.textContent = len + " / 70";
			titleCounter.classList.toggle("is-limit", len > 70);
		}
		if (inputExcerpt && excerptCounter) {
			const len = inputExcerpt.value.length;
			excerptCounter.textContent = len + " / 220";
			excerptCounter.classList.toggle("is-limit", len > 220);
		}
	}
	if (inputTitle) inputTitle.addEventListener("input", updateCounters);
	if (inputExcerpt) inputExcerpt.addEventListener("input", updateCounters);

	// 2. Sync Modal Preview Data
	function syncModalPreview() {
		// Title
		const titleVal = inputTitle ? inputTitle.value.trim() : "";
		const displayTitle = titleVal !== "" ? titleVal : "Título de tu Nuevo Proyecto";
		if (simTitleLink) simTitleLink.textContent = displayTitle;
		if (simBottomTitle) simBottomTitle.textContent = displayTitle;

		// Excerpt
		const excerptVal = inputExcerpt ? inputExcerpt.value.trim() : "";
		if (simExcerpt) simExcerpt.textContent = excerptVal !== "" ? excerptVal : "Aquí se visualizará el resumen ejecutivo del proyecto tal y como lo verán los visitantes en la galería pública.";

		// Category / Project Type Badge
		const selectedRadio = document.querySelector('input[name="project_type_single"]:checked');
		if (selectedRadio && simCategoryBadge) {
			simCategoryBadge.textContent = selectedRadio.dataset.name || "Desarrollo Web";
		}

		// Client
		const clientVal = inputClient ? inputClient.value.trim() : "";
		if (simClient) simClient.textContent = clientVal !== "" ? "🏢 " + clientVal : "🏢 Cliente: Confidencial";

		// Metrics
		const metricVal = inputMetrics ? inputMetrics.value.trim() : "";
		if (simMetricBadge && simMetricText) {
			if (metricVal !== "") {
				simMetricText.textContent = metricVal;
				simMetricBadge.style.display = "inline-flex";
			} else {
				simMetricBadge.style.display = "none";
			}
		}

		// Tech Stack Tags
		const techVal = inputTechnologies ? inputTechnologies.value.trim() : "";
		if (simTagsList) {
			simTagsList.innerHTML = "";
			const tagSvg = '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline-block;vertical-align:-1px;margin-right:4px;"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>';
			if (techVal !== "") {
				const tags = techVal.split(",").map(t => t.trim()).filter(t => t.length > 0);
				tags.slice(0, 4).forEach(tag => {
					const span = document.createElement("span");
					span.className = "post-tag small";
					span.innerHTML = tagSvg + tag;
					simTagsList.appendChild(span);
				});
			} else {
				const span = document.createElement("span");
				span.className = "post-tag small";
				span.innerHTML = tagSvg + "WordPress";
				simTagsList.appendChild(span);
			}
		}

		// Featured Image Thumbnail
		if (inputFeaturedImage && inputFeaturedImage.files && inputFeaturedImage.files[0]) {
			const reader = new FileReader();
			reader.onload = function (e) {
				if (simMediaImg) {
					simMediaImg.src = e.target.result;
					simMediaImg.style.display = "block";
				}
				if (simThumbBg) simThumbBg.classList.remove("no-thumbnail-pattern");
				if (simContainer) simContainer.classList.remove("has-no-thumbnail");
				if (simCard) simCard.classList.remove("has-no-thumbnail");
			};
			reader.readAsDataURL(inputFeaturedImage.files[0]);
		} else {
			if (simMediaImg) {
				simMediaImg.src = "";
				simMediaImg.style.display = "none";
			}
			if (simThumbBg) simThumbBg.classList.add("no-thumbnail-pattern");
			if (simContainer) simContainer.classList.add("has-no-thumbnail");
			if (simCard) simCard.classList.add("has-no-thumbnail");
		}
	}

	function openModal() {
		syncModalPreview();
		if (previewModalBackdrop) previewModalBackdrop.style.display = "flex";
		document.body.style.overflow = "hidden";
	}

	function closeModal() {
		if (previewModalBackdrop) previewModalBackdrop.style.display = "none";
		document.body.style.overflow = "";
	}

	if (btnOpenPreviewModal) btnOpenPreviewModal.addEventListener("click", openModal);
	if (btnDockOpenPreview) btnDockOpenPreview.addEventListener("click", openModal);
	if (btnClosePreviewModal) btnClosePreviewModal.addEventListener("click", closeModal);
	if (btnDismissModal) btnDismissModal.addEventListener("click", closeModal);
	if (btnSubmitFromModal) {
		btnSubmitFromModal.addEventListener("click", function () {
			closeModal();
			if (form) form.requestSubmit();
		});
	}

	if (previewModalBackdrop) {
		previewModalBackdrop.addEventListener("click", function (e) {
			if (e.target === previewModalBackdrop) {
				closeModal();
			}
		});
	}

	document.addEventListener("keydown", function (e) {
		if (e.key === "Escape" && previewModalBackdrop && previewModalBackdrop.style.display === "flex") {
			closeModal();
		}
	});

	// 3. Featured Image Handling
	const coverInput = document.getElementById("project_cover");
	const coverDropzoneDefault = document.getElementById("coverDropzoneDefault");
	const coverDropzonePreview = document.getElementById("coverDropzonePreview");
	const coverPreviewThumb = document.getElementById("coverPreviewThumb");
	const coverNamePill = document.getElementById("coverNamePill");
	const btnRemoveCoverThumb = document.getElementById("btnRemoveCoverThumb");

	function handleCover(file) {
		if (file && file.type.startsWith("image/")) {
			const reader = new FileReader();
			reader.onload = function (e) {
				const dataUrl = e.target.result;
				if (coverPreviewThumb) coverPreviewThumb.src = dataUrl;
				if (coverNamePill) coverNamePill.textContent = file.name;
				if (coverDropzoneDefault) coverDropzoneDefault.style.display = "none";
				if (coverDropzonePreview) coverDropzonePreview.style.display = "block";

				// Update simulated card
				if (simMediaImg) {
					simMediaImg.src = dataUrl;
					simMediaImg.style.display = "block";
				}
				if (simMediaPlaceholder) simMediaPlaceholder.style.display = "none";
			};
			reader.readAsDataURL(file);
		}
	}

	if (coverInput) {
		coverInput.addEventListener("change", function () {
			if (this.files && this.files[0]) {
				handleCover(this.files[0]);
			}
		});
	}

	if (btnRemoveCoverThumb) {
		btnRemoveCoverThumb.addEventListener("click", function (e) {
			e.preventDefault();
			e.stopPropagation();
			if (coverInput) coverInput.value = "";
			if (coverPreviewThumb) coverPreviewThumb.src = "";
			if (coverDropzonePreview) coverDropzonePreview.style.display = "none";
			if (coverDropzoneDefault) coverDropzoneDefault.style.display = "block";

			if (simMediaImg) {
				simMediaImg.src = "";
				simMediaImg.style.display = "none";
			}
			if (simMediaPlaceholder) simMediaPlaceholder.style.display = "flex";
		});
	}

	// 4. Gallery Screenshots
	const galleryInput = document.getElementById("project_gallery");
	const galleryThumbsRow = document.getElementById("galleryThumbsRow");

	if (galleryInput && galleryThumbsRow) {
		galleryInput.addEventListener("change", function () {
			galleryThumbsRow.innerHTML = "";
			if (this.files) {
				Array.from(this.files).forEach(file => {
					if (file.type.startsWith("image/")) {
						const reader = new FileReader();
						reader.onload = function (e) {
							const img = document.createElement("img");
							img.src = e.target.result;
							img.className = "gallery-thumb-preview";
							img.title = file.name;
							galleryThumbsRow.appendChild(img);
						};
						reader.readAsDataURL(file);
					}
				});
			}
		});
	}

	// 5. Interactive Tech Pills
	const techPills = document.querySelectorAll(".interactive-tech-pill");
	function syncTechPills() {
		if (!inputTechnologies) return;
		const current = inputTechnologies.value.split(",").map(t => t.trim().toLowerCase());
		techPills.forEach(pill => {
			const name = (pill.dataset.tech || "").trim().toLowerCase();
			pill.classList.toggle("is-selected", current.includes(name));
		});
	}

	techPills.forEach(pill => {
		pill.addEventListener("click", function () {
			const tech = this.dataset.tech;
			let list = inputTechnologies.value.split(",").map(t => t.trim()).filter(t => t.length > 0);
			const idx = list.findIndex(t => t.toLowerCase() === tech.toLowerCase());
			if (idx >= 0) {
				list.splice(idx, 1);
			} else {
				list.push(tech);
			}
			inputTechnologies.value = list.join(", ");
			syncTechPills();
		});
	});

	if (inputTechnologies) {
		inputTechnologies.addEventListener("input", syncTechPills);
	}

	// 6. Fast Metric Pills
	document.querySelectorAll(".metric-quick-pill").forEach(pill => {
		pill.addEventListener("click", function () {
			const val = this.dataset.val;
			if (inputMetrics) {
				inputMetrics.value = inputMetrics.value.trim() ? inputMetrics.value.trim() + ", " + val : val;
			}
		});
	});

	// 7. Markdown Formatting Toolbar
	document.querySelectorAll(".fmt-btn").forEach(btn => {
		btn.addEventListener("click", function () {
			if (!inputContent) return;
			const start = inputContent.selectionStart;
			const end = inputContent.selectionEnd;
			const text = inputContent.value;
			const selected = text.substring(start, end);

			if (this.dataset.wrap && this.dataset.insert) {
				const tag = this.dataset.insert;
				const rep = tag + (selected || "texto") + tag;
				inputContent.value = text.substring(0, start) + rep + text.substring(end);
				inputContent.focus();
				inputContent.setSelectionRange(start + tag.length, end + tag.length);
			} else if (this.dataset.prefix) {
				const prefix = this.dataset.prefix;
				inputContent.value = text.substring(0, start) + prefix + (selected || "Elemento") + text.substring(end);
				inputContent.focus();
			} else if (this.dataset.link) {
				const url = prompt("Introduce el enlace:", "https://");
				if (url) {
					const rep = "[" + (selected || "enlace") + "](" + url + ")";
					inputContent.value = text.substring(0, start) + rep + text.substring(end);
					inputContent.focus();
				}
			}
		});
	});

	// 8. 1-Click Realistic Presets
	const presetLibrary = {
		xmeetings: {
			title: "X-Meetings: Plataforma SaaS de Agendamiento Inteligente y Automatización de Notificaciones",
			excerpt: "Plataforma SaaS multi-tenant para agendamiento inteligente de citas, sincronización bidireccional con Google Calendar API, procesamiento asíncrono con Redis/BullMQ y recordatorios automatizados vía WhatsApp Cloud API.",
			client: "Startup SaaS / Proyecto Propio",
			role: "Lead Software Architect & Full-Stack Engineer",
			year: "2024",
			metrics: "+99.9% Uptime SLA · -75% No-Shows con WhatsApp · Sync Google Calendar <250ms",
			liveUrl: "https://atmeetly.com",
			repoUrl: "https://github.com/chanovera-dev/x-meetings",
			challenge: "Diseñar una arquitectura escalable y distribuida de alta disponibilidad capaz de gestionar agendas y reservas concurrentes en tiempo real, evitando colisiones de horarios (double-booking) y garantizando el despacho puntual de recordatorios diferidos (-24h y -1h) vía WhatsApp Cloud API sin sobrecargar los procesos de la aplicación.",
			solution: "Implementación de microservicios con Express y TypeScript desacoplados mediante colas de mensajes con Redis y BullMQ para procesamiento asíncrono. Sincronización bidireccional OAuth 2.0 con Google Calendar API con cifrado AES-256 de credenciales en PostgreSQL, webhooks con firma HMAC-SHA256 y frontend reactivo en Next.js (App Router) con widget embebible zero-conflict vía iframe dinámico y postMessage.",
			content: "### Arquitectura de Microservicios\nInfraestructura basada en microservicios desacoplados con API Gateway, colas de procesamiento asíncrono con BullMQ y Redis para aislamiento total de operaciones I/O intensivas.\n\n### Sincronización Bidireccional de Calendarios\nIntegración completa con Google Calendar API que resuelve disponibilidad en tiempo real con latencias sub-200ms y caché invalidada reactivamente.\n\n### Recordatorios Automatizados por WhatsApp\nWorker dedicado para despachos diferidos con WhatsApp Cloud API, reduciendo el ausentismo en un 75%.\n\n### Widget Embebible Zero-Conflict\nIntegración para sitios de terceros con iframe dinámico y comunicación segura mediante window.postMessage con auto-ajuste de altura.",
			tech: "Next.js, React, TypeScript, Node.js, Express, PostgreSQL, Redis, Tailwind CSS, WhatsApp Cloud API, Google Calendar API, REST API, Docker"
		},
		stories: {
			title: "Stories — Tema WordPress Modular de Alto Rendimiento & Experiencias Multimedia",
			excerpt: "Tema moderno, modular y ultraligero para WordPress diseñado para publicaciones editoriales y experiencias interactivas con soporte nativo para los 9 formatos de post y 100/100 en Core Web Vitals.",
			client: "Proyecto Propio / Open Source (chanoDEV)",
			role: "Creador, Diseñador & Arquitecto Full-Stack",
			year: "2026",
			metrics: "100/100 Core Web Vitals, 9 Formatos Nativos, 0 Plugins requeridos",
			liveUrl: "https://chano.dev/",
			repoUrl: "https://github.com/chanovera-dev/stories",
			challenge: "Los temas editoriales y de revistas en WordPress suelen depender de constructores visuales pesados y decenas de plugins que degradan la velocidad, bloquean el FCP con JavaScript innecesario y limitan la interactividad multimedia.",
			solution: "Diseñamos una arquitectura modular en PHP 8 y JavaScript ES6+ con precarga de CSS crítico, carga diferida de assets secundarios, inyección de variables CSS para 8 esquemas de color y reproductores personalizados (vinilo 3D, lightbox EXIF, scraper OpenGraph).",
			content: "### Arquitectura y Filosofía de Diseño\nStories nació para ofrecer una experiencia editorial moderna y rápida sin sacrificar diseño inmersivo. Cada uno de los 9 formatos de entrada de WordPress cuenta con su propia plantilla optimizada.\n\n### Aspectos Técnicos Destacados\n- **Reproductor de Vinilo 3D**: Formato de audio con disco giratorio interactivo, espectrograma de frecuencias animado y compatibilidad con shortcodes y embeds.\n- **Visor Fotográfico con EXIF**: Extracción automática de metadatos de cámara (ISO, apertura, velocidad, distancia focal) para posts de tipo imagen.\n- **Scraper OpenGraph**: Tarjetas de enlaces con previsualización remota cacheada en metadatos para cero latencia recurrente.\n- **Soporte Multilenguaje Integrado (ES/EN)**: Detección automática por URL, cookie o cabecera con diccionario nativo sin necesidad de plugins.\n- **WPO Extremo**: Eliminación de librerías de bloques y emojis de WordPress, versión de assets por filemtime y carga asíncrona de estilos secundarios.",
			tech: "WordPress, PHP 8, JavaScript ES6+, Vanilla CSS, Core Web Vitals, WPO, REST API, Schema.org, Clean Code"
		},
		woocommerce: {
			title: "Plataforma E-Commerce B2B con Catálogo Personalizado & WooCommerce",
			excerpt: "Tienda digital mayorista construida para soportar más de 50.000 referencias de productos con sincronización de inventario en tiempo real y tiempos de carga < 600ms.",
			client: "ModaGlobal B2B",
			role: "Lead Full-Stack Developer & WPO Architect",
			year: new Date().getFullYear().toString(),
			metrics: "+160% Ventas, 98 PageSpeed, LCP 0.6s",
			liveUrl: "https://ejemplo-tienda-b2b.com",
			challenge: "El cliente experimentaba caídas constantes en promociones de alto tráfico y un checkout lento (> 4.8s), lo que causaba un 65% de abandono de carritos.",
			solution: "Desarrollamos una arquitectura modular en WooCommerce con caché Redis persistente, consultas SQL optimizadas y un checkout en una sola pantalla sin JS bloqueante.",
			content: "### Arquitectura de Alto Rendimiento\nSe construyó una solución a medida eliminando dependencias de constructores visuales pesados. Integramos pasarela de pagos con Stripe y PayPal webhooks para aprobación en segundos.\n\n### Resultados Obtenidos\n- Reducción del tiempo de respuesta del servidor (TTFB) de 1.8s a 140ms.\n- Aumento de la tasa de conversión en móvil en un +42%.\n- Cero caídas durante los periodos de liquidación estacional.",
			tech: "WordPress, WooCommerce, PHP 8, MySQL, REST API, Core Web Vitals"
		},
		webapp: {
			title: "Dashboard de Gestión SaaS en React, Next.js & Node.js",
			excerpt: "Aplicación web integral para la gestión y visualización de analíticas operativas en tiempo real, diseñada con microservicios y arquitectura cloud.",
			client: "MetricsFlow Corp",
			role: "Senior Full-Stack & API Engineer",
			year: new Date().getFullYear().toString(),
			metrics: "+350K Eventos/día, 99 PageSpeed Móvil",
			liveUrl: "https://metricsflow-demo.app",
			challenge: "El sistema legado procesaba consultas analíticas con lentitud extrema, superando los 12 segundos para generar informes trimestrales de clientes.",
			solution: "Migración completa a Next.js con Server Components, backend Node.js en TypeScript, endpoints GraphQL cacheados y base de datos con índices geoespaciales.",
			content: "### Desarrollo Frontend & State Management\nSe implementó una interfaz de usuario reactiva con Tailwind CSS y componentes accesibles (WCAG AA). Los gráficos interactivos se procesan en el navegador mediante WebGL sin sobrecargar la CPU.\n\n### Seguridad & Escalabilidad\nAutenticación stateless basada en tokens JWT con rotación segura en cookies HTTPOnly, protegiendo todos los datos sensibles de los clientes corporativos.",
			tech: "React, Next.js, Node.js, TypeScript, GraphQL, Tailwind CSS, Docker"
		},
		corporate: {
			title: "Sitio Corporativo & WPO a Medida para Consultora Internacional",
			excerpt: "Portal corporativo multi-idioma con arquitectura limpia en WordPress nativo, cumpliendo con 100/100 en Core Web Vitals y diseño responsive premium.",
			client: "Vanguard Partners Consultoría",
			role: "WordPress Architect & Frontend Specialist",
			year: new Date().getFullYear().toString(),
			metrics: "100/100 Core Web Vitals, -70% TTFB",
			liveUrl: "https://vanguard-consultoria.com",
			challenge: "El sitio anterior utilizaba un tema multipropósito sobrecargado con más de 70 plugins activos, tardando más de 6 segundos en cargar en conexiones 4G.",
			solution: "Diseñamos un tema a medida desde cero utilizando CSS modular, carga diferida nativa de activos y estructuras de datos Schema.org E-E-A-T para posicionamiento SEO.",
			content: "### Enfoque de Rendimiento Crítico\nSe auditó cada byte transmitido. Todo el CSS crítico se entrega en línea y las fuentes se cargan localmente con subsets optimizados, logrando el puntaje máximo en Google Lighthouse.\n\n### SEO & Marcado Semántico\nEstructura HTML5 semántica impecable con metadatos JSON-LD para autoría experta, perfiles de equipo y casos de éxito auditables.",
			tech: "WordPress, PHP 8, JavaScript ES6+, Core Web Vitals, WPO, ACF Pro"
		}
	};

	document.querySelectorAll(".preset-pill").forEach(btn => {
		btn.addEventListener("click", function () {
			const config = presetLibrary[this.dataset.preset];
			if (!config) return;

			if (inputTitle) inputTitle.value = config.title;
			if (inputExcerpt) inputExcerpt.value = config.excerpt;
			if (inputClient) inputClient.value = config.client;
			if (inputRole) inputRole.value = config.role;
			if (inputYear) inputYear.value = config.year;
			if (inputMetrics) inputMetrics.value = config.metrics;
			if (inputLiveUrl) inputLiveUrl.value = config.liveUrl;
			if (inputRepoUrl) inputRepoUrl.value = config.repoUrl || "";
			if (inputChallenge) inputChallenge.value = config.challenge;
			if (inputSolution) inputSolution.value = config.solution;
			if (inputContent) inputContent.value = config.content;
			if (inputTechnologies) inputTechnologies.value = config.tech;

			syncTechPills();
			updateCounters();

			// Visual click feedback
			this.style.transform = "scale(0.96)";
			setTimeout(() => { this.style.transform = ""; }, 120);
		});
	});

	// Check if a preset is requested via URL (?preset=stories)
	const urlParams = new URLSearchParams(window.location.search);
	const requestedPreset = urlParams.get("preset");
	if (requestedPreset && presetLibrary[requestedPreset]) {
		const targetBtn = document.querySelector(`.preset-pill[data-preset="${requestedPreset}"]`);
		if (targetBtn) {
			targetBtn.click();
		}
	}

	// 9. Local Draft Auto-save
	const DRAFT_KEY = "chanodev_draft_v3";
	const draftSavedToast = document.getElementById("draftSavedToast");
	const btnDismissToast = document.getElementById("btnDismissToast");

	function autoSave() {
		if (!inputTitle || !inputTitle.value.trim()) return;
		const draft = {
			title: inputTitle.value,
			excerpt: inputExcerpt ? inputExcerpt.value : "",
			client: inputClient ? inputClient.value : "",
			role: inputRole ? inputRole.value : "",
			year: inputYear ? inputYear.value : "",
			metrics: inputMetrics ? inputMetrics.value : "",
			liveUrl: inputLiveUrl ? inputLiveUrl.value : "",
			repoUrl: inputRepoUrl ? inputRepoUrl.value : "",
			challenge: inputChallenge ? inputChallenge.value : "",
			solution: inputSolution ? inputSolution.value : "",
			content: inputContent ? inputContent.value : "",
			technologies: inputTechnologies ? inputTechnologies.value : ""
		};
		try {
			localStorage.setItem(DRAFT_KEY, JSON.stringify(draft));
		} catch (e) {}
	}

	function restoreDraft() {
		try {
			const raw = localStorage.getItem(DRAFT_KEY);
			if (!raw) return;
			const data = JSON.parse(raw);
			if (inputTitle && inputTitle.value.trim() === "" && data.title) {
				inputTitle.value = data.title || "";
				if (inputExcerpt) inputExcerpt.value = data.excerpt || "";
				if (inputClient) inputClient.value = data.client || "";
				if (inputRole) inputRole.value = data.role || "";
				if (inputYear) inputYear.value = data.year || "";
				if (inputMetrics) inputMetrics.value = data.metrics || "";
				if (inputLiveUrl) inputLiveUrl.value = data.liveUrl || "";
				if (inputRepoUrl) inputRepoUrl.value = data.repoUrl || "";
				if (inputChallenge) inputChallenge.value = data.challenge || "";
				if (inputSolution) inputSolution.value = data.solution || "";
				if (inputContent) inputContent.value = data.content || "";
				if (inputTechnologies) inputTechnologies.value = data.technologies || "";

				syncTechPills();
				updateCounters();
				if (draftSavedToast) draftSavedToast.style.display = "flex";
			}
		} catch (e) {}
	}

	if (btnDismissToast) {
		btnDismissToast.addEventListener("click", function () {
			if (draftSavedToast) draftSavedToast.style.display = "none";
		});
	}

	const btnResetForm = document.getElementById("btnResetForm");
	if (btnResetForm) {
		btnResetForm.addEventListener("click", function () {
			if (confirm("¿Deseas reiniciar todos los campos del formulario?")) {
				if (form) form.reset();
				try { localStorage.removeItem(DRAFT_KEY); } catch (e) {}
				if (btnRemoveCoverThumb) btnRemoveCoverThumb.click();
				syncTechPills();
				updateCounters();
			}
		});
	}

	if (form) {
		form.addEventListener("submit", function () {
			try { localStorage.removeItem(DRAFT_KEY); } catch (e) {}
			const btn = document.getElementById("btnSubmitProject");
			if (btn) {
				btn.disabled = true;
				btn.style.opacity = "0.75";
				btn.querySelector(".submit-text").textContent = "Subiendo imágenes & publicando...";
				const sp = btn.querySelector(".submit-spinner");
				if (sp) sp.style.display = "inline";
			}
		});
	}

	setInterval(autoSave, 4000);
	restoreDraft();
	syncTechPills();
	updateCounters();
});
</script>

<?php
get_footer();
