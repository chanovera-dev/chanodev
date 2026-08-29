<?php
/**
 * Custom Post Type: Project (Portfolio) and Taxonomies
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Project Custom Post Type.
 */
function chanodev_register_project_cpt() {
	$labels = array(
		'name'                  => _x( 'Projects', 'Post type general name', 'chanodev' ),
		'singular_name'         => _x( 'Project', 'Post type singular name', 'chanodev' ),
		'menu_name'             => _x( 'Portfolio', 'Admin Menu text', 'chanodev' ),
		'name_admin_bar'        => _x( 'Project', 'Add New on Toolbar', 'chanodev' ),
		'add_new'               => __( 'Add New', 'chanodev' ),
		'add_new_item'          => __( 'Add New Project', 'chanodev' ),
		'new_item'              => __( 'New Project', 'chanodev' ),
		'edit_item'             => __( 'Edit Project', 'chanodev' ),
		'view_item'             => __( 'View Project', 'chanodev' ),
		'all_items'             => __( 'All Projects', 'chanodev' ),
		'search_items'          => __( 'Search Projects', 'chanodev' ),
		'parent_item_colon'     => __( 'Parent Projects:', 'chanodev' ),
		'not_found'             => __( 'No projects found.', 'chanodev' ),
		'not_found_in_trash'    => __( 'No projects found in Trash.', 'chanodev' ),
		'featured_image'        => _x( 'Project Cover Image', 'Overrides the "Featured Image" phrase for this post type.', 'chanodev' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the "Set featured image" phrase for this post type.', 'chanodev' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the "Remove featured image" phrase for this post type.', 'chanodev' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the "Use as featured image" phrase for this post type.', 'chanodev' ),
		'archives'              => _x( 'Project archives', 'The post type archive label used in nav menus.', 'chanodev' ),
		'insert_into_item'      => _x( 'Insert into project', 'Overrides the "Insert into post"/"Insert into page" phrase.', 'chanodev' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this project', 'Overrides the "Uploaded to this post"/"Uploaded to this page" phrase.', 'chanodev' ),
		'filter_items_list'     => _x( 'Filter projects list', 'Screen reader text for the filter links.', 'chanodev' ),
		'items_list_navigation' => _x( 'Projects list navigation', 'Screen reader text for the pagination.', 'chanodev' ),
		'items_list'            => _x( 'Projects list', 'Screen reader text for the items list.', 'chanodev' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'proyectos', 'with_front' => false ),
		'capability_type'    => 'post',
		'has_archive'        => 'proyectos',
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-portfolio',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'project', $args );
}
add_action( 'init', 'chanodev_register_project_cpt' );

/**
 * Register Technologies and Project Types Taxonomies.
 */
function chanodev_register_project_taxonomies() {
	// Technology Taxonomy (e.g. WordPress, React, Node.js, WooCommerce).
	$tech_labels = array(
		'name'              => _x( 'Technologies', 'taxonomy general name', 'chanodev' ),
		'singular_name'     => _x( 'Technology', 'taxonomy singular name', 'chanodev' ),
		'search_items'      => __( 'Search Technologies', 'chanodev' ),
		'all_items'         => __( 'All Technologies', 'chanodev' ),
		'parent_item'       => __( 'Parent Technology', 'chanodev' ),
		'parent_item_colon' => __( 'Parent Technology:', 'chanodev' ),
		'edit_item'         => __( 'Edit Technology', 'chanodev' ),
		'update_item'       => __( 'Update Technology', 'chanodev' ),
		'add_new_item'      => __( 'Add New Technology', 'chanodev' ),
		'new_item_name'     => __( 'New Technology Name', 'chanodev' ),
		'menu_name'         => __( 'Technologies', 'chanodev' ),
	);

	register_taxonomy(
		'project_technology',
		array( 'project' ),
		array(
			'hierarchical'      => false,
			'labels'            => $tech_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'tecnologia' ),
			'show_in_rest'      => true,
		)
	);

	// Project Type Taxonomy (e.g. Tienda Online, Sitio Corporativo, Prestador de Servicios, Web App).
	$type_labels = array(
		'name'              => _x( 'Project Types', 'taxonomy general name', 'chanodev' ),
		'singular_name'     => _x( 'Project Type', 'taxonomy singular name', 'chanodev' ),
		'search_items'      => __( 'Search Project Types', 'chanodev' ),
		'all_items'         => __( 'All Project Types', 'chanodev' ),
		'parent_item'       => __( 'Parent Project Type', 'chanodev' ),
		'parent_item_colon' => __( 'Parent Project Type:', 'chanodev' ),
		'edit_item'         => __( 'Edit Project Type', 'chanodev' ),
		'update_item'       => __( 'Update Project Type', 'chanodev' ),
		'add_new_item'      => __( 'Add New Project Type', 'chanodev' ),
		'new_item_name'     => __( 'New Project Type Name', 'chanodev' ),
		'menu_name'         => __( 'Project Types', 'chanodev' ),
	);

	register_taxonomy(
		'project_type',
		array( 'project' ),
		array(
			'hierarchical'      => true,
			'labels'            => $type_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'tipo-proyecto' ),
			'show_in_rest'      => true,
		)
	);
}
add_action( 'init', 'chanodev_register_project_taxonomies' );

/**
 * Register Custom Meta Boxes for Projects (E-E-A-T Case Study Data).
 */
function chanodev_add_project_metaboxes() {
	add_meta_box(
		'chanodev_project_details',
		__( 'Project Details & Case Study (E-E-A-T)', 'chanodev' ),
		'chanodev_render_project_details_metabox',
		'project',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'chanodev_add_project_metaboxes' );

/**
 * Render Project Details Meta Box.
 *
 * @param WP_Post $post Current post object.
 */
function chanodev_render_project_details_metabox( $post ) {
	wp_nonce_field( 'chanodev_save_project_meta', 'chanodev_project_meta_nonce' );

	$client       = get_post_meta( $post->ID, '_chanodev_project_client', true );
	$role         = get_post_meta( $post->ID, '_chanodev_project_role', true );
	$live_url     = get_post_meta( $post->ID, '_chanodev_project_live_url', true );
	$repo_url     = get_post_meta( $post->ID, '_chanodev_project_repo_url', true );
	$year         = get_post_meta( $post->ID, '_chanodev_project_year', true );
	$metrics      = get_post_meta( $post->ID, '_chanodev_project_metrics', true );
	$challenge    = get_post_meta( $post->ID, '_chanodev_project_challenge', true );
	$solution     = get_post_meta( $post->ID, '_chanodev_project_solution', true );
	?>
	<div class="chanodev-metabox-wrapper" style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 10px;">
		<div>
			<label for="chanodev_project_client" style="display: block; font-weight: 600; margin-bottom: 5px;"><?php esc_html_e( 'Client / Company Name', 'chanodev' ); ?></label>
			<input type="text" id="chanodev_project_client" name="chanodev_project_client" value="<?php echo esc_attr( $client ); ?>" style="width: 100%;" placeholder="e.g. Acme Corp">
		</div>
		<div>
			<label for="chanodev_project_role" style="display: block; font-weight: 600; margin-bottom: 5px;"><?php esc_html_e( 'My Role', 'chanodev' ); ?></label>
			<input type="text" id="chanodev_project_role" name="chanodev_project_role" value="<?php echo esc_attr( $role ); ?>" style="width: 100%;" placeholder="e.g. Full-Stack Developer & Tech Lead">
		</div>
		<div>
			<label for="chanodev_project_live_url" style="display: block; font-weight: 600; margin-bottom: 5px;"><?php esc_html_e( 'Live Website URL', 'chanodev' ); ?></label>
			<input type="url" id="chanodev_project_live_url" name="chanodev_project_live_url" value="<?php echo esc_url( $live_url ); ?>" style="width: 100%;" placeholder="https://example.com">
		</div>
		<div>
			<label for="chanodev_project_repo_url" style="display: block; font-weight: 600; margin-bottom: 5px;"><?php esc_html_e( 'Repository URL (GitHub/GitLab)', 'chanodev' ); ?></label>
			<input type="url" id="chanodev_project_repo_url" name="chanodev_project_repo_url" value="<?php echo esc_url( $repo_url ); ?>" style="width: 100%;" placeholder="https://github.com/username/project">
		</div>
		<div>
			<label for="chanodev_project_year" style="display: block; font-weight: 600; margin-bottom: 5px;"><?php esc_html_e( 'Year Completed', 'chanodev' ); ?></label>
			<input type="text" id="chanodev_project_year" name="chanodev_project_year" value="<?php echo esc_attr( $year ); ?>" style="width: 100%;" placeholder="e.g. 2026">
		</div>
		<div>
			<label for="chanodev_project_metrics" style="display: block; font-weight: 600; margin-bottom: 5px;"><?php esc_html_e( 'Key Metric / Impact', 'chanodev' ); ?></label>
			<input type="text" id="chanodev_project_metrics" name="chanodev_project_metrics" value="<?php echo esc_attr( $metrics ); ?>" style="width: 100%;" placeholder="e.g. +140% Conversión, 99 Google PageSpeed">
		</div>
	</div>

	<div style="margin-top: 15px;">
		<label for="chanodev_project_challenge" style="display: block; font-weight: 600; margin-bottom: 5px;"><?php esc_html_e( 'The Technical Challenge / Problem (E-E-A-T)', 'chanodev' ); ?></label>
		<textarea id="chanodev_project_challenge" name="chanodev_project_challenge" rows="3" style="width: 100%;"><?php echo esc_textarea( $challenge ); ?></textarea>
		<p class="description"><?php esc_html_e( 'Explain the initial obstacles, performance issues, or architectural complexity.', 'chanodev' ); ?></p>
	</div>

	<div style="margin-top: 15px;">
		<label for="chanodev_project_solution" style="display: block; font-weight: 600; margin-bottom: 5px;"><?php esc_html_e( 'The Engineering Solution & Stack Implementation (E-E-A-T)', 'chanodev' ); ?></label>
		<textarea id="chanodev_project_solution" name="chanodev_project_solution" rows="3" style="width: 100%;"><?php echo esc_textarea( $solution ); ?></textarea>
		<p class="description"><?php esc_html_e( 'Describe how WordPress, React, NodeJS, custom APIs, or database optimizations solved the problem.', 'chanodev' ); ?></p>
	</div>
	<?php
}

/**
 * Save Project Meta Box Data.
 *
 * @param int $post_id Post ID.
 */
function chanodev_save_project_meta( $post_id ) {
	if ( ! isset( $_POST['chanodev_project_meta_nonce'] ) || ! wp_verify_nonce( $_POST['chanodev_project_meta_nonce'], 'chanodev_save_project_meta' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$fields = array(
		'_chanodev_project_client'    => 'sanitize_text_field',
		'_chanodev_project_role'      => 'sanitize_text_field',
		'_chanodev_project_live_url'  => 'esc_url_raw',
		'_chanodev_project_repo_url'  => 'esc_url_raw',
		'_chanodev_project_year'      => 'sanitize_text_field',
		'_chanodev_project_metrics'   => 'sanitize_text_field',
		'_chanodev_project_challenge' => 'wp_kses_post',
		'_chanodev_project_solution'  => 'wp_kses_post',
	);

	foreach ( $fields as $meta_key => $sanitizer ) {
		$post_key = substr( $meta_key, 1 ); // Remove leading underscore
		if ( isset( $_POST[ $post_key ] ) ) {
			$value = call_user_func( $sanitizer, $_POST[ $post_key ] );
			update_post_meta( $post_id, $meta_key, $value );
		}
	}
}
add_action( 'save_post_project', 'chanodev_save_project_meta' );

/**
 * Helper function to retrieve project metadata cleanly.
 *
 * @param int $post_id Project post ID.
 * @return array Project details.
 */
function chanodev_get_project_details( $post_id = 0 ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	return array(
		'client'       => get_post_meta( $post_id, '_chanodev_project_client', true ),
		'role'         => get_post_meta( $post_id, '_chanodev_project_role', true ),
		'live_url'     => get_post_meta( $post_id, '_chanodev_project_live_url', true ),
		'repo_url'     => get_post_meta( $post_id, '_chanodev_project_repo_url', true ),
		'year'         => get_post_meta( $post_id, '_chanodev_project_year', true ),
		'metrics'      => get_post_meta( $post_id, '_chanodev_project_metrics', true ),
		'challenge'    => get_post_meta( $post_id, '_chanodev_project_challenge', true ),
		'solution'     => get_post_meta( $post_id, '_chanodev_project_solution', true ),
		'technologies' => get_the_terms( $post_id, 'project_technology' ),
		'types'        => get_the_terms( $post_id, 'project_type' ),
	);
}
