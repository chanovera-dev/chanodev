<?php
/**
 * ChanoDev Child Theme functions and definitions
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Define Child Theme Constants
 */
define( 'CHANODEV_VERSION', '1.0.0' );
define( 'CHANODEV_DIR', get_stylesheet_directory() );
define( 'CHANODEV_URI', get_stylesheet_directory_uri() );

/**
 * Require child theme modules
 */
require_once CHANODEV_DIR . '/inc/portfolio-cpt.php';
require_once CHANODEV_DIR . '/inc/schema-eeat.php';
require_once CHANODEV_DIR . '/inc/acf-fields.php';

/**
 * Enqueue parent and child theme styles and scripts.
 */
function chanodev_enqueue_styles() {
	// 1. Load base parent theme styles (Stories)
	wp_enqueue_style(
		'stories-parent-style',
		get_template_directory_uri() . '/style.css',
		array(),
		wp_get_theme( 'stories' )->get( 'Version' )
	);

	// 2. Load child theme stylesheet with priority after parent main styles
	wp_enqueue_style(
		'chanodev-style',
		CHANODEV_URI . '/style.css',
		array( 'stories-parent-style', 'stories-main' ),
		CHANODEV_VERSION
	);

	// 3. Load dedicated portfolio styles and scripts on portfolio views or front-page
	if ( is_post_type_archive( 'project' ) || is_singular( 'project' ) || is_page_template( 'templates/template-about.php' ) || is_page_template( 'templates/template-services.php' ) || is_page_template( 'templates/template-contact.php' ) || is_page_template( 'templates/template-add-project.php' ) || is_front_page() ) {
		$css_ver = file_exists( CHANODEV_DIR . '/assets/css/portfolio.css' ) ? filemtime( CHANODEV_DIR . '/assets/css/portfolio.css' ) : CHANODEV_VERSION;
		$js_ver  = file_exists( CHANODEV_DIR . '/assets/js/portfolio.js' ) ? filemtime( CHANODEV_DIR . '/assets/js/portfolio.js' ) : CHANODEV_VERSION;

		wp_enqueue_style(
			'chanodev-portfolio-style',
			CHANODEV_URI . '/assets/css/portfolio.css',
			array( 'chanodev-style' ),
			$css_ver
		);

		wp_enqueue_script(
			'chanodev-portfolio-script',
			CHANODEV_URI . '/assets/js/portfolio.js',
			array(),
			$js_ver,
			true
		);
	}
}
add_action( 'wp_enqueue_scripts', 'chanodev_enqueue_styles', 15 );

/**
 * Auto-create required pages with their templates on theme activation.
 */
function chanodev_auto_create_default_pages() {
	$default_pages = array(
		'crear-proyecto' => array(
			'title'    => __( 'Crear Proyecto', 'chanodev' ),
			'template' => 'templates/template-add-project.php',
		),
		'sobre-mi' => array(
			'title'    => __( 'Sobre Mí', 'chanodev' ),
			'template' => 'templates/template-about.php',
		),
		'servicios' => array(
			'title'    => __( 'Servicios', 'chanodev' ),
			'template' => 'templates/template-services.php',
		),
		'contacto' => array(
			'title'    => __( 'Contacto', 'chanodev' ),
			'template' => 'templates/template-contact.php',
		),
	);

	foreach ( $default_pages as $slug => $page_meta ) {
		$existing_page = get_page_by_path( $slug );
		if ( ! $existing_page ) {
			$page_id = wp_insert_post( array(
				'post_title'     => $page_meta['title'],
				'post_name'      => $slug,
				'post_status'    => 'publish',
				'post_type'      => 'page',
				'comment_status' => 'closed',
				'ping_status'    => 'closed',
			) );

			if ( $page_id && ! is_wp_error( $page_id ) && ! empty( $page_meta['template'] ) ) {
				update_post_meta( $page_id, '_wp_page_template', $page_meta['template'] );
			}
		} elseif ( ! empty( $page_meta['template'] ) ) {
			$current_tpl = get_post_meta( $existing_page->ID, '_wp_page_template', true );
			if ( empty( $current_tpl ) || 'default' === $current_tpl ) {
				update_post_meta( $existing_page->ID, '_wp_page_template', $page_meta['template'] );
			}
		}
	}
}
add_action( 'after_switch_theme', 'chanodev_auto_create_default_pages' );

/**
 * Output SEO Meta Description, Open Graph and Twitter Card tags.
 */
function chanodev_seo_meta_tags() {
	if ( is_admin() ) {
		return;
	}

	// Remove parent theme fallback meta description to prevent duplicates
	remove_action( 'wp_head', 'stories_meta_description', 2 );

	$title       = '';
	$description = '';
	$type        = 'website';
	$url         = esc_url( home_url( add_query_arg( array(), $GLOBALS['wp']->request ?? '' ) ) );
	$image       = '';

	if ( is_front_page() || is_home() ) {
		$hero_desc   = function_exists( 'get_field' ) ? get_field( 'home_hero_subheadline' ) : '';
		$description = ! empty( $hero_desc ) ? $hero_desc : __( 'Desarrollador Web especializado en WordPress a medida, arquitecturas React, WooCommerce y optimización de rendimiento (Core Web Vitals). Creación de soluciones digitales rápidas, seguras y escalables.', 'chanodev' );
		$title       = get_bloginfo( 'name' ) . ' · ' . ( get_bloginfo( 'description' ) ? get_bloginfo( 'description' ) : __( 'Desarrollo Web & WordPress a Medida', 'chanodev' ) );
	} elseif ( is_page_template( 'templates/template-about.php' ) || is_page( 'sobre-mi' ) ) {
		$about_desc  = function_exists( 'get_field' ) ? get_field( 'about_hero_lead' ) : '';
		$description = ! empty( $about_desc ) ? $about_desc : __( 'Conoce a Chano Vera, desarrollador web Full-Stack con más de 8 años de experiencia en desarrollo WordPress a medida, arquitecturas limpias y optimización Web Performance.', 'chanodev' );
		$title       = __( 'Sobre Mí · Chano Vera Developer', 'chanodev' );
	} elseif ( is_page_template( 'templates/template-services.php' ) || is_page( 'servicios' ) ) {
		$serv_desc   = function_exists( 'get_field' ) ? get_field( 'services_hero_lead' ) : '';
		$description = ! empty( $serv_desc ) ? $serv_desc : __( 'Servicios de desarrollo web profesional: temas y plugins WordPress a medida, tiendas WooCommerce de alto rendimiento, aplicaciones React y optimización Core Web Vitals.', 'chanodev' );
		$title       = __( 'Servicios de Ingeniería Web · ChanoDev', 'chanodev' );
	} elseif ( is_page_template( 'templates/template-contact.php' ) || is_page( 'contacto' ) ) {
		$description = __( 'Agenda una consulta técnica directa con Chano Vera para evaluar tus requerimientos y diseñar la solución web ideal para tu plataforma digital.', 'chanodev' );
		$title       = __( 'Contacto & Presupuestos · ChanoDev', 'chanodev' );
	} elseif ( is_post_type_archive( 'project' ) || is_page( 'proyectos' ) ) {
		$description = __( 'Portafolio de proyectos de ingeniería web y desarrollo WordPress a medida por ChanoDev. Casos de estudio con métricas de rendimiento reales y arquitecturas modernas.', 'chanodev' );
		$title       = __( 'Portafolio de Proyectos · ChanoDev', 'chanodev' );
	} elseif ( is_singular( 'project' ) ) {
		$type        = 'article';
		$title       = get_the_title() . ' · ' . __( 'Caso de Estudio ChanoDev', 'chanodev' );
		$excerpt     = has_excerpt() ? get_the_excerpt() : wp_strip_all_tags( get_the_content() );
		$description = ! empty( $excerpt ) ? $excerpt : __( 'Estudio de caso y desarrollo a medida en WordPress y tecnologías web modernas por ChanoDev.', 'chanodev' );
		if ( has_post_thumbnail() ) {
			$image = get_the_post_thumbnail_url( get_the_ID(), 'large' );
		}
	} elseif ( is_singular() ) {
		$type        = 'article';
		$title       = get_the_title() . ' · ' . get_bloginfo( 'name' );
		$excerpt     = has_excerpt() ? get_the_excerpt() : wp_strip_all_tags( get_the_content() );
		$description = ! empty( $excerpt ) ? $excerpt : get_bloginfo( 'description' );
		if ( has_post_thumbnail() ) {
			$image = get_the_post_thumbnail_url( get_the_ID(), 'large' );
		}
	} elseif ( is_search() ) {
		$description = sprintf( __( 'Resultados de búsqueda técnica en ChanoDev para: %s', 'chanodev' ), get_search_query() );
		$title       = sprintf( __( 'Búsqueda: %s · ChanoDev', 'chanodev' ), get_search_query() );
	} else {
		$description = get_bloginfo( 'description' );
		if ( empty( $description ) ) {
			$description = __( 'Desarrollo web a medida, arquitectura de software limpia y soluciones WordPress de alto rendimiento por ChanoDev.', 'chanodev' );
		}
		$title = wp_get_document_title();
	}

	// Clean up description
	$description = wp_strip_all_tags( $description );
	$description = preg_replace( '/\s+/', ' ', $description );
	$description = wp_trim_words( $description, 32, '...' );

	// Output SEO meta tags
	echo "\n<!-- SEO & Social Meta Tags -->\n";
	echo '<meta name="description" content="' . esc_attr( trim( $description ) ) . '">' . "\n";
	echo '<meta property="og:type" content="' . esc_attr( $type ) . '">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( trim( $description ) ) . '">' . "\n";
	echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
	echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . "\n";
	if ( ! empty( $image ) ) {
		echo '<meta property="og:image" content="' . esc_url( $image ) . '">' . "\n";
	}
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
	echo '<meta name="twitter:description" content="' . esc_attr( trim( $description ) ) . '">' . "\n";
	if ( ! empty( $image ) ) {
		echo '<meta name="twitter:image" content="' . esc_url( $image ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'chanodev_seo_meta_tags', 1 );