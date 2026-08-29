<?php
/**
 * Template Name: Agregar Proyecto
 * Description: Formulario exclusivo para administradores para crear y publicar proyectos con imágenes y metadatos E-E-A-T.
 *
 * @package ChanoDev
 */

// 1. Access Control: Only logged-in administrators / publishers
if ( ! is_user_logged_in() || ! current_user_can( 'publish_posts' ) ) {
	get_header();
	?>
	<main id="main" class="site-main admin-restricted-page" role="main">
		<section class="block restricted-access-block">
			<div class="content">
				<div class="restricted-card" data-reveal="fade-up">
					<div class="restricted-icon">
						<svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
							<path d="M7 11V7a5 5 0 0 1 10 0v4"/>
						</svg>
					</div>
					<h2><?php esc_html_e( 'Acceso Exclusivo para Administradores', 'chanodev' ); ?></h2>
					<p><?php esc_html_e( 'Esta página contiene el formulario interno para dar de alta nuevos proyectos en el portafolio. Inicia sesión con tu cuenta de administrador para continuar.', 'chanodev' ); ?></p>
					<div class="restricted-actions">
						<a href="<?php echo esc_url( wp_login_url( get_permalink() ) ); ?>" class="btn-primary">
							<?php esc_html_e( 'Iniciar Sesión', 'chanodev' ); ?>
						</a>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-secondary">
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
$errors        = array();
$success_msg   = '';
$new_post_link = '';
$edit_post_link = '';

if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['chanodev_add_project_nonce'] ) ) {
	if ( ! wp_verify_nonce( $_POST['chanodev_add_project_nonce'], 'chanodev_add_project_action' ) ) {
		$errors[] = __( 'Error de seguridad nonce. Por favor recarga la página e intenta de nuevo.', 'chanodev' );
	} else {
		$title     = isset( $_POST['project_title'] ) ? sanitize_text_field( wp_unslash( $_POST['project_title'] ) ) : '';
		$excerpt   = isset( $_POST['project_excerpt'] ) ? sanitize_textarea_field( wp_unslash( $_POST['project_excerpt'] ) ) : '';
		$content   = isset( $_POST['project_content'] ) ? wp_kses_post( wp_unslash( $_POST['project_content'] ) ) : '';
		$client    = isset( $_POST['project_client'] ) ? sanitize_text_field( wp_unslash( $_POST['project_client'] ) ) : '';
		$role      = isset( $_POST['project_role'] ) ? sanitize_text_field( wp_unslash( $_POST['project_role'] ) ) : '';
		$live_url  = isset( $_POST['project_live_url'] ) ? esc_url_raw( wp_unslash( $_POST['project_live_url'] ) ) : '';
		$repo_url  = isset( $_POST['project_repo_url'] ) ? esc_url_raw( wp_unslash( $_POST['project_repo_url'] ) ) : '';
		$year      = isset( $_POST['project_year'] ) ? sanitize_text_field( wp_unslash( $_POST['project_year'] ) ) : '';
		$metrics   = isset( $_POST['project_metrics'] ) ? sanitize_text_field( wp_unslash( $_POST['project_metrics'] ) ) : '';
		$challenge = isset( $_POST['project_challenge'] ) ? wp_kses_post( wp_unslash( $_POST['project_challenge'] ) ) : '';
		$solution  = isset( $_POST['project_solution'] ) ? wp_kses_post( wp_unslash( $_POST['project_solution'] ) ) : '';

		// Validation
		if ( empty( $title ) ) {
			$errors[] = __( 'El título del proyecto es obligatorio.', 'chanodev' );
		}

		if ( empty( $errors ) ) {
			// Insert Project Post
			$post_data = array(
				'post_title'   => $title,
				'post_content' => $content,
				'post_excerpt' => $excerpt,
				'post_status'  => 'publish',
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
						$errors[] = __( 'Error al subir la imagen destacada: ', 'chanodev' ) . $cover_id->get_error_message();
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

				// 3. Save Custom Meta Fields (E-E-A-T)
				update_post_meta( $new_post_id, '_chanodev_project_client', $client );
				update_post_meta( $new_post_id, '_chanodev_project_role', $role );
				update_post_meta( $new_post_id, '_chanodev_project_live_url', $live_url );
				update_post_meta( $new_post_id, '_chanodev_project_repo_url', $repo_url );
				update_post_meta( $new_post_id, '_chanodev_project_year', $year );
				update_post_meta( $new_post_id, '_chanodev_project_metrics', $metrics );
				update_post_meta( $new_post_id, '_chanodev_project_challenge', $challenge );
				update_post_meta( $new_post_id, '_chanodev_project_solution', $solution );

				// 4. Save Taxonomies
				// Project Types (array of term IDs or names)
				if ( ! empty( $_POST['project_types'] ) && is_array( $_POST['project_types'] ) ) {
					$types = array_map( 'intval', $_POST['project_types'] );
					wp_set_object_terms( $new_post_id, $types, 'project_type' );
				}

				// New Project Type if typed in
				if ( ! empty( $_POST['new_project_type'] ) ) {
					$new_type_name = sanitize_text_field( wp_unslash( $_POST['new_project_type'] ) );
					$term_info = term_exists( $new_type_name, 'project_type' );
					if ( ! $term_info ) {
						$term_info = wp_insert_term( $new_type_name, 'project_type' );
					}
					if ( ! is_wp_error( $term_info ) && isset( $term_info['term_id'] ) ) {
						wp_set_object_terms( $new_post_id, (int) $term_info['term_id'], 'project_type', true );
					}
				}

				// Technologies (comma separated)
				if ( ! empty( $_POST['project_technologies'] ) ) {
					$tech_list = explode( ',', sanitize_text_field( wp_unslash( $_POST['project_technologies'] ) ) );
					$tech_list = array_map( 'trim', $tech_list );
					$tech_list = array_filter( $tech_list );
					if ( ! empty( $tech_list ) ) {
						wp_set_object_terms( $new_post_id, $tech_list, 'project_technology' );
					}
				}

				$success_msg    = sprintf( __( '¡Proyecto "%s" publicado con éxito!', 'chanodev' ), esc_html( $title ) );
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

$common_technologies = array(
	'WordPress', 'WooCommerce', 'React', 'Node.js', 'Next.js', 'PHP 8', 'JavaScript ES6+',
	'TypeScript', 'GraphQL', 'REST API', 'Core Web Vitals', 'WPO', 'Tailwind CSS', 'Docker',
);

get_header();
?>

<main id="main" class="site-main project-builder-page" role="main">
	<!-- Top Bar / Breadcrumb -->
	<section class="block project-builder-header whiteprint-background">
		<div class="content">
			<div class="builder-header-flex">
				<div>
					<span class="sub-heading green">
						<span class="status-pulse-dot"></span>
						<?php esc_html_e( 'Panel de Administración', 'chanodev' ); ?>
					</span>
					<h1 class="builder-page-title"><?php esc_html_e( 'Crear Nuevo Proyecto', 'chanodev' ); ?></h1>
					<p class="builder-page-desc"><?php esc_html_e( 'Rellena los datos, imágenes y ficha técnica para publicar un nuevo caso de estudio en el portafolio.', 'chanodev' ); ?></p>
				</div>
				<div class="builder-quick-actions">
					<a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>" class="btn btn-secondary" target="_blank">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
						<?php esc_html_e( 'Ver Portafolio', 'chanodev' ); ?>
					</a>
				</div>
			</div>
		</div>
	</section>

	<!-- Main Form Section -->
	<section class="block project-builder-form-section">
		<div class="content">
			<?php if ( ! empty( $errors ) ) : ?>
				<div class="builder-alert error" role="alert">
					<div class="alert-icon">⚠️</div>
					<div>
						<strong><?php esc_html_e( 'Por favor corrige los siguientes errores:', 'chanodev' ); ?></strong>
						<ul>
							<?php foreach ( $errors as $err ) : ?>
								<li><?php echo esc_html( $err ); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $success_msg ) ) : ?>
				<div class="builder-alert success" role="alert">
					<div class="alert-icon">✅</div>
					<div>
						<strong><?php echo esc_html( $success_msg ); ?></strong>
						<div class="alert-links" style="margin-top: 8px;">
							<a href="<?php echo esc_url( $new_post_link ); ?>" class="btn-sm btn-primary" target="_blank">
								<?php esc_html_e( 'Ver Proyecto Publicado →', 'chanodev' ); ?>
							</a>
							<?php if ( ! empty( $edit_post_link ) ) : ?>
								<a href="<?php echo esc_url( $edit_post_link ); ?>" class="btn-sm btn-secondary" target="_blank" style="margin-left: 10px;">
									<?php esc_html_e( 'Editar en WP Admin', 'chanodev' ); ?>
								</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<form method="post" action="<?php echo esc_url( get_permalink() ); ?>" enctype="multipart/form-data" class="project-builder-form" id="projectBuilderForm">
				<?php wp_nonce_field( 'chanodev_add_project_action', 'chanodev_add_project_nonce' ); ?>

				<div class="builder-grid-layout">
					<!-- LEFT COLUMN: Main Information & Case Study -->
					<div class="builder-main-col">
						<!-- Card 1: Basic Info -->
						<div class="builder-card">
							<div class="builder-card-header">
								<span class="step-badge">01</span>
								<h3><?php esc_html_e( 'Información del Proyecto', 'chanodev' ); ?></h3>
							</div>
							<div class="builder-card-body">
								<div class="form-group">
									<label for="project_title" class="required"><?php esc_html_e( 'Título del Proyecto', 'chanodev' ); ?></label>
									<input type="text" id="project_title" name="project_title" class="form-control text-lg" placeholder="<?php esc_attr_e( 'ej. Plataforma E-Commerce B2B para Moda Sostenible', 'chanodev' ); ?>" required value="<?php echo isset( $_POST['project_title'] ) ? esc_attr( wp_unslash( $_POST['project_title'] ) ) : ''; ?>">
								</div>

								<div class="form-group">
									<label for="project_excerpt"><?php esc_html_e( 'Extracto / Resumen Ejecutivo (1-2 párrafos)', 'chanodev' ); ?></label>
									<textarea id="project_excerpt" name="project_excerpt" class="form-control" rows="3" placeholder="<?php esc_attr_e( 'Breve descripción que aparecerá en las tarjetas de portafolio y redes sociales...', 'chanodev' ); ?>"><?php echo isset( $_POST['project_excerpt'] ) ? esc_textarea( wp_unslash( $_POST['project_excerpt'] ) ) : ''; ?></textarea>
								</div>

								<div class="form-group">
									<label for="project_content"><?php esc_html_e( 'Historia y Detalles Completos del Proyecto', 'chanodev' ); ?></label>
									<textarea id="project_content" name="project_content" class="form-control" rows="8" placeholder="<?php esc_attr_e( 'Describe el alcance, la arquitectura construida, las integraciones de API y el impacto para el cliente...', 'chanodev' ); ?>"><?php echo isset( $_POST['project_content'] ) ? esc_textarea( wp_unslash( $_POST['project_content'] ) ) : ''; ?></textarea>
								</div>
							</div>
						</div>

						<!-- Card 2: E-E-A-T Technical Case Study Data -->
						<div class="builder-card">
							<div class="builder-card-header">
								<span class="step-badge">02</span>
								<h3><?php esc_html_e( 'Ficha Técnica & Estudio de Caso (E-E-A-T)', 'chanodev' ); ?></h3>
							</div>
							<div class="builder-card-body">
								<div class="form-row-2col">
									<div class="form-group">
										<label for="project_client"><?php esc_html_e( 'Cliente / Empresa', 'chanodev' ); ?></label>
										<input type="text" id="project_client" name="project_client" class="form-control" placeholder="<?php esc_attr_e( 'ej. Acme Global Corp', 'chanodev' ); ?>" value="<?php echo isset( $_POST['project_client'] ) ? esc_attr( wp_unslash( $_POST['project_client'] ) ) : ''; ?>">
									</div>

									<div class="form-group">
										<label for="project_role"><?php esc_html_e( 'Mi Rol en el Proyecto', 'chanodev' ); ?></label>
										<input type="text" id="project_role" name="project_role" class="form-control" placeholder="<?php esc_attr_e( 'ej. Lead Full-Stack Developer & WPO Architect', 'chanodev' ); ?>" value="<?php echo isset( $_POST['project_role'] ) ? esc_attr( wp_unslash( $_POST['project_role'] ) ) : ''; ?>">
									</div>
								</div>

								<div class="form-row-2col">
									<div class="form-group">
										<label for="project_live_url"><?php esc_html_e( 'URL del Sitio Web en Vivo', 'chanodev' ); ?></label>
										<input type="url" id="project_live_url" name="project_live_url" class="form-control" placeholder="https://cliente.com" value="<?php echo isset( $_POST['project_live_url'] ) ? esc_url( wp_unslash( $_POST['project_live_url'] ) ) : ''; ?>">
									</div>

									<div class="form-group">
										<label for="project_repo_url"><?php esc_html_e( 'URL del Repositorio (GitHub / GitLab)', 'chanodev' ); ?></label>
										<input type="url" id="project_repo_url" name="project_repo_url" class="form-control" placeholder="https://github.com/usuario/repo" value="<?php echo isset( $_POST['project_repo_url'] ) ? esc_url( wp_unslash( $_POST['project_repo_url'] ) ) : ''; ?>">
									</div>
								</div>

								<div class="form-row-2col">
									<div class="form-group">
										<label for="project_year"><?php esc_html_e( 'Año de Finalización', 'chanodev' ); ?></label>
										<input type="text" id="project_year" name="project_year" class="form-control" placeholder="<?php echo esc_attr( date( 'Y' ) ); ?>" value="<?php echo isset( $_POST['project_year'] ) ? esc_attr( wp_unslash( $_POST['project_year'] ) ) : date( 'Y' ); ?>">
									</div>

									<div class="form-group">
										<label for="project_metrics"><?php esc_html_e( 'Métrica / Impacto Clave', 'chanodev' ); ?></label>
										<input type="text" id="project_metrics" name="project_metrics" class="form-control" placeholder="<?php esc_attr_e( 'ej. +140% Conversión, 99 PageSpeed, LCP 0.8s', 'chanodev' ); ?>" value="<?php echo isset( $_POST['project_metrics'] ) ? esc_attr( wp_unslash( $_POST['project_metrics'] ) ) : ''; ?>">
									</div>
								</div>

								<div class="form-group">
									<label for="project_challenge"><?php esc_html_e( 'El Reto Técnico / Problema Inicial', 'chanodev' ); ?></label>
									<textarea id="project_challenge" name="project_challenge" class="form-control" rows="3" placeholder="<?php esc_attr_e( 'Explica los obstáculos de arquitectura, lentitud o deuda técnica que tenía el cliente...', 'chanodev' ); ?>"><?php echo isset( $_POST['project_challenge'] ) ? esc_textarea( wp_unslash( $_POST['project_challenge'] ) ) : ''; ?></textarea>
								</div>

								<div class="form-group">
									<label for="project_solution"><?php esc_html_e( 'La Solución de Ingeniería Implementada', 'chanodev' ); ?></label>
									<textarea id="project_solution" name="project_solution" class="form-control" rows="3" placeholder="<?php esc_attr_e( 'Describe cómo la arquitectura personalizada, APIs o buenas prácticas resolvieron el problema...', 'chanodev' ); ?>"><?php echo isset( $_POST['project_solution'] ) ? esc_textarea( wp_unslash( $_POST['project_solution'] ) ) : ''; ?></textarea>
								</div>
							</div>
						</div>
					</div>

					<!-- RIGHT COLUMN: Images, Taxonomies & Actions -->
					<div class="builder-side-col">
						<!-- Card 3: Cover & Gallery Uploads -->
						<div class="builder-card">
							<div class="builder-card-header">
								<span class="step-badge">03</span>
								<h3><?php esc_html_e( 'Imágenes del Proyecto', 'chanodev' ); ?></h3>
							</div>
							<div class="builder-card-body">
								<!-- Featured Image -->
								<div class="form-group">
									<label class="required"><?php esc_html_e( 'Imagen de Portada (Cover)', 'chanodev' ); ?></label>
									<div class="upload-dropzone" id="coverDropzone">
										<input type="file" name="project_cover" id="project_cover" accept="image/jpeg,image/png,image/webp,image/svg+xml" class="file-input-hidden" required>
										<div class="dropzone-placeholder" id="coverPlaceholder">
											<svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
											<span><?php esc_html_e( 'Arrastra o haz clic para subir portada', 'chanodev' ); ?></span>
											<small>JPG, PNG, WebP o SVG (Recomendado 1600x900px)</small>
										</div>
										<div class="dropzone-preview" id="coverPreview" style="display: none;">
											<img src="" alt="<?php esc_attr_e( 'Vista previa portada', 'chanodev' ); ?>" id="coverPreviewImg">
											<button type="button" class="btn-remove-preview" id="btnRemoveCover">✕</button>
										</div>
									</div>
								</div>

								<!-- Additional Gallery -->
								<div class="form-group" style="margin-top: 20px;">
									<label><?php esc_html_e( 'Galería de Capturas Adicionales', 'chanodev' ); ?></label>
									<div class="upload-dropzone-multiple" id="galleryDropzone">
										<input type="file" name="project_gallery[]" id="project_gallery" accept="image/jpeg,image/png,image/webp,image/svg+xml" multiple class="file-input-hidden">
										<div class="dropzone-placeholder">
											<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242"/><path d="M12 12v9"/><path d="m16 16-4-4-4 4"/></svg>
											<span><?php esc_html_e( 'Subir múltiples capturas de pantalla', 'chanodev' ); ?></span>
										</div>
										<div class="gallery-previews-container" id="galleryPreviews"></div>
									</div>
								</div>
							</div>
						</div>

						<!-- Card 4: Categories & Technologies -->
						<div class="builder-card">
							<div class="builder-card-header">
								<span class="step-badge">04</span>
								<h3><?php esc_html_e( 'Clasificación & Stack', 'chanodev' ); ?></h3>
							</div>
							<div class="builder-card-body">
								<!-- Project Type Taxonomy -->
								<div class="form-group">
									<label><?php esc_html_e( 'Tipo de Proyecto', 'chanodev' ); ?></label>
									<?php if ( ! empty( $all_project_types ) && ! is_wp_error( $all_project_types ) ) : ?>
										<div class="checkbox-options-grid">
											<?php foreach ( $all_project_types as $term ) : ?>
												<label class="custom-checkbox-label">
													<input type="checkbox" name="project_types[]" value="<?php echo esc_attr( $term->term_id ); ?>">
													<span><?php echo esc_html( $term->name ); ?></span>
												</label>
											<?php endforeach; ?>
										</div>
									<?php endif; ?>
									<div class="add-inline-term" style="margin-top: 10px;">
										<input type="text" name="new_project_type" class="form-control form-control-sm" placeholder="<?php esc_attr_e( '+ Agregar nuevo tipo...', 'chanodev' ); ?>">
									</div>
								</div>

								<!-- Technologies Taxonomy -->
								<div class="form-group" style="margin-top: 20px;">
									<label for="project_technologies"><?php esc_html_e( 'Tecnologías Aplicadas (separadas por coma)', 'chanodev' ); ?></label>
									<input type="text" id="project_technologies" name="project_technologies" class="form-control" placeholder="<?php esc_attr_e( 'ej. WordPress, React, Node.js, WooCommerce, WPO', 'chanodev' ); ?>" value="<?php echo isset( $_POST['project_technologies'] ) ? esc_attr( wp_unslash( $_POST['project_technologies'] ) ) : ''; ?>">
									
									<!-- Quick Add Pills -->
									<div class="quick-tech-pills">
										<small><?php esc_html_e( 'Sugerencias rápidas (clic para añadir):', 'chanodev' ); ?></small>
										<div class="tech-pills-list">
											<?php foreach ( $common_technologies as $tech ) : ?>
												<button type="button" class="tech-pill-btn" data-tech="<?php echo esc_attr( $tech ); ?>">+ <?php echo esc_html( $tech ); ?></button>
											<?php endforeach; ?>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Card 5: Submit Action -->
						<div class="builder-card publish-card">
							<div class="publish-actions">
								<button type="submit" class="btn btn-primary btn-block btn-lg" id="btnPublishProject">
									<span>🚀 <?php esc_html_e( 'Publicar Proyecto Ahora', 'chanodev' ); ?></span>
								</button>
								<p class="publish-note"><?php esc_html_e( 'El proyecto se publicará instantáneamente en el portafolio público con todos sus metadatos.', 'chanodev' ); ?></p>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</section>
</main>

<style>
/* ═══════════════════════════════════════════════════════════
   Project Builder Frontend Dashboard Styles
   ═══════════════════════════════════════════════════════════ */
.project-builder-page {
	background-color: var(--bg-body, #f8fafc);
	min-height: 100vh;
	padding-bottom: 5rem;
}

.project-builder-header {
	padding: 3.5rem 0 2.5rem 0;
	border-bottom: 1px solid var(--chanodev-border);
}

.builder-header-flex {
	display: flex;
	justify-content: space-between;
	align-items: flex-start;
	gap: 2rem;
	flex-wrap: wrap;
}

.builder-page-title {
	font-size: clamp(2rem, 3.5vw, 2.8rem);
	font-weight: 800;
	color: var(--color-text-heading, #0f172a);
	margin: 0.5rem 0 0.25rem 0;
}

.builder-page-desc {
	color: var(--color-text-body, #475569);
	font-size: 1rem;
	margin: 0;
}

.project-builder-form-section {
	padding: 2.5rem 0;
}

.builder-grid-layout {
	display: grid;
	grid-template-columns: 1.4fr 1fr;
	gap: 2rem;
}

@media (max-width: 1024px) {
	.builder-grid-layout {
		grid-template-columns: 1fr;
	}
}

.builder-card {
	background: var(--bg-card, #ffffff);
	border: 1px solid var(--chanodev-border);
	border-radius: var(--card-border-radius, 1rem);
	box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
	margin-bottom: 2rem;
	overflow: hidden;
}

.builder-card-header {
	display: flex;
	align-items: center;
	gap: 1rem;
	padding: 1.25rem 1.75rem;
	border-bottom: 1px solid var(--chanodev-border);
	background: color-mix(in hsl, var(--footer-background), var(--color-white) 4%);
}

.builder-card-header h3 {
	margin: 0;
	font-size: 1.15rem;
	font-weight: 700;
	color: var(--color-text-heading, #0f172a);
}

.step-badge {
	display: inline-grid;
	place-items: center;
	width: 30px;
	height: 30px;
	border-radius: 50%;
	background: var(--color-primary);
	color: #ffffff;
	font-weight: 700;
	font-size: 0.82rem;
}

.builder-card-body {
	padding: 1.75rem;
}

.form-group {
	margin-bottom: 1.3rem;
}

.form-group label {
	display: block;
	font-size: 0.88rem;
	font-weight: 600;
	color: var(--color-text-heading, #0f172a);
	margin-bottom: 0.4rem;
}

.form-group label.required::after {
	content: ' *';
	color: #ef4444;
}

.form-control {
	width: 100%;
	padding: 0.75rem 1rem;
	font-size: 0.95rem;
	color: var(--color-text-heading, #0f172a);
	background: var(--bg-card, #ffffff);
	border: 1px solid color-mix(in hsl, var(--footer-background), var(--color-white) 15%);
	border-radius: var(--badge-border-radius, 0.5rem);
	box-sizing: border-box;
	transition: all 0.2s ease;
}

.form-control:focus {
	outline: none;
	border-color: var(--color-primary);
	box-shadow: 0 0 0 3px color-mix(in srgb, var(--color-primary) 18%, transparent);
}

.form-control.text-lg {
	font-size: 1.15rem;
	font-weight: 600;
	padding: 0.9rem 1.1rem;
}

.form-control-sm {
	padding: 0.45rem 0.75rem;
	font-size: 0.85rem;
}

.form-row-2col {
	display: grid;
	grid-template-columns: 1fr 1fr;
	gap: 1.2rem;
}

@media (max-width: 640px) {
	.form-row-2col {
		grid-template-columns: 1fr;
	}
}

/* Upload Dropzones */
.upload-dropzone,
.upload-dropzone-multiple {
	border: 2px dashed color-mix(in srgb, var(--color-primary) 40%, #cbd5e1);
	border-radius: var(--card-border-radius, 1rem);
	padding: 1.75rem;
	text-align: center;
	cursor: pointer;
	position: relative;
	background: color-mix(in srgb, var(--color-primary) 3%, transparent);
	transition: all 0.25s ease;
}

.upload-dropzone:hover,
.upload-dropzone-multiple:hover {
	border-color: var(--color-primary);
	background: color-mix(in srgb, var(--color-primary) 6%, transparent);
}

.file-input-hidden {
	position: absolute;
	inset: 0;
	width: 100%;
	height: 100%;
	opacity: 0;
	cursor: pointer;
	z-index: 10;
}

.dropzone-placeholder svg {
	color: var(--color-primary);
	margin-bottom: 0.5rem;
}

.dropzone-placeholder span {
	display: block;
	font-weight: 600;
	font-size: 0.95rem;
	color: var(--color-text-heading, #0f172a);
}

.dropzone-placeholder small {
	display: block;
	font-size: 0.78rem;
	color: var(--color-text-body, #64748b);
	margin-top: 0.25rem;
}

.dropzone-preview {
	position: relative;
	width: 100%;
	max-height: 240px;
	border-radius: var(--badge-border-radius, 0.5rem);
	overflow: hidden;
}

.dropzone-preview img {
	width: 100%;
	height: 200px;
	object-fit: cover;
	display: block;
}

.btn-remove-preview {
	position: absolute;
	top: 8px;
	right: 8px;
	background: rgba(0, 0, 0, 0.7);
	color: #ffffff;
	border: none;
	border-radius: 50%;
	width: 28px;
	height: 28px;
	cursor: pointer;
	display: grid;
	place-items: center;
	z-index: 20;
}

.gallery-previews-container {
	display: grid;
	grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
	gap: 10px;
	margin-top: 15px;
}

.gallery-thumb-preview {
	width: 100%;
	height: 70px;
	border-radius: 6px;
	object-fit: cover;
	border: 1px solid var(--chanodev-border);
}

/* Checkboxes */
.checkbox-options-grid {
	display: grid;
	grid-template-columns: 1fr 1fr;
	gap: 0.5rem;
}

.custom-checkbox-label {
	display: flex;
	align-items: center;
	gap: 0.5rem;
	font-size: 0.85rem;
	color: var(--color-text-heading, #0f172a);
	cursor: pointer;
}

.custom-checkbox-label input {
	accent-color: var(--color-primary);
	width: 16px;
	height: 16px;
}

/* Quick Tech Pills */
.quick-tech-pills {
	margin-top: 0.75rem;
}

.tech-pills-list {
	display: flex;
	flex-wrap: wrap;
	gap: 0.4rem;
	margin-top: 0.4rem;
}

.tech-pill-btn {
	background: color-mix(in srgb, var(--color-primary) 10%, transparent);
	border: 1px solid color-mix(in srgb, var(--color-primary) 25%, transparent);
	color: var(--color-primary);
	font-size: 0.78rem;
	font-weight: 600;
	padding: 0.2rem 0.6rem;
	border-radius: 999px;
	cursor: pointer;
	transition: all 0.2s ease;
}

.tech-pill-btn:hover {
	background: var(--color-primary);
	color: #ffffff;
}

/* Publish Card */
.publish-card {
	background: linear-gradient(145deg, color-mix(in hsl, var(--footer-background), var(--color-white) 4%) 0%, var(--bg-card, #ffffff) 100%);
	border-color: color-mix(in srgb, var(--color-primary) 30%, transparent);
}

.publish-actions {
	padding: 1.75rem;
	text-align: center;
}

.btn-block {
	width: 100%;
	display: block;
}

.publish-note {
	font-size: 0.8rem;
	color: var(--color-text-body, #64748b);
	margin: 0.75rem 0 0 0;
}

/* Alerts */
.builder-alert {
	display: flex;
	align-items: flex-start;
	gap: 1rem;
	padding: 1.25rem 1.5rem;
	border-radius: var(--card-border-radius, 1rem);
	margin-bottom: 2rem;
}

.builder-alert.error {
	background: #fef2f2;
	border: 1px solid #fecaca;
	color: #991b1b;
}

.builder-alert.success {
	background: #f0fdf4;
	border: 1px solid #bbf7d0;
	color: #166534;
}

.builder-alert ul {
	margin: 0.4rem 0 0 1.2rem;
	padding: 0;
}

/* Restricted Card */
.restricted-access-block {
	padding: 6rem 0;
	min-height: 70vh;
	display: grid;
	place-items: center;
}

.restricted-card {
	max-width: 540px;
	margin: 0 auto;
	text-align: center;
	background: var(--bg-card, #ffffff);
	padding: 3rem 2.5rem;
	border-radius: var(--card-border-radius, 1rem);
	border: 1px solid var(--chanodev-border);
	box-shadow: 0 12px 36px rgba(0, 0, 0, 0.08);
}

.restricted-icon {
	width: 80px;
	height: 80px;
	border-radius: 50%;
	background: color-mix(in srgb, var(--color-primary) 12%, transparent);
	color: var(--color-primary);
	display: grid;
	place-items: center;
	margin: 0 auto 1.5rem auto;
}

.restricted-card h2 {
	margin: 0 0 0.75rem 0;
	color: var(--color-text-heading, #0f172a);
}

.restricted-card p {
	color: var(--color-text-body, #64748b);
	margin: 0 0 2rem 0;
	line-height: 1.6;
}

.restricted-actions {
	display: flex;
	justify-content: center;
	gap: 1rem;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
	// Cover preview
	const coverInput = document.getElementById("project_cover");
	const coverPlaceholder = document.getElementById("coverPlaceholder");
	const coverPreview = document.getElementById("coverPreview");
	const coverPreviewImg = document.getElementById("coverPreviewImg");
	const btnRemoveCover = document.getElementById("btnRemoveCover");

	if (coverInput) {
		coverInput.addEventListener("change", function () {
			if (this.files && this.files[0]) {
				const reader = new FileReader();
				reader.onload = function (e) {
					coverPreviewImg.src = e.target.result;
					coverPlaceholder.style.display = "none";
					coverPreview.style.display = "block";
				};
				reader.readAsDataURL(this.files[0]);
			}
		});
	}

	if (btnRemoveCover) {
		btnRemoveCover.addEventListener("click", function (e) {
			e.preventDefault();
			coverInput.value = "";
			coverPreviewImg.src = "";
			coverPreview.style.display = "none";
			coverPlaceholder.style.display = "block";
		});
	}

	// Multiple gallery previews
	const galleryInput = document.getElementById("project_gallery");
	const galleryPreviews = document.getElementById("galleryPreviews");

	if (galleryInput && galleryPreviews) {
		galleryInput.addEventListener("change", function () {
			galleryPreviews.innerHTML = "";
			if (this.files) {
				Array.from(this.files).forEach(file => {
					const reader = new FileReader();
					reader.onload = function (e) {
						const img = document.createElement("img");
						img.src = e.target.result;
						img.classList.add("gallery-thumb-preview");
						galleryPreviews.appendChild(img);
					};
					reader.readAsDataURL(file);
				});
			}
		});
	}

	// Quick tech pill click handler
	const techInput = document.getElementById("project_technologies");
	const techPills = document.querySelectorAll(".tech-pill-btn");

	if (techInput && techPills.length > 0) {
		techPills.forEach(pill => {
			pill.addEventListener("click", function () {
				const val = this.dataset.tech;
				let current = techInput.value.trim();
				if (current === "") {
					techInput.value = val;
				} else {
					const list = current.split(",").map(s => s.trim());
					if (!list.includes(val)) {
						list.push(val);
						techInput.value = list.join(", ");
					}
				}
				this.style.opacity = "0.5";
				this.style.pointerEvents = "none";
			});
		});
	}
});
</script>

<?php
get_footer();
