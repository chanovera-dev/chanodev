<?php
/**
 * Register ACF / Secure Custom Fields Field Groups for ChanoDev Theme Templates
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'acf/init', 'chanodev_register_acf_field_groups' );

function chanodev_register_acf_field_groups() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	// =========================================================================
	// 1. FRONT PAGE FIELD GROUP
	// =========================================================================
	acf_add_local_field_group( array(
		'key'                   => 'group_chanodev_home',
		'title'                 => __( 'Página de Inicio — Contenido & Secciones', 'chanodev' ),
		'fields'                => array(
			// TAB: HERO
			array(
				'key'   => 'field_home_tab_hero',
				'label' => __( 'Hero Principal', 'chanodev' ),
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_home_hero_kicker',
				'label' => __( 'Kicker / Badge Superior', 'chanodev' ),
				'name'  => 'home_hero_kicker',
				'type'  => 'text',
				'default_value' => 'Senior Full-Stack Web & WordPress',
			),
			array(
				'key'   => 'field_home_hero_status_text',
				'label' => __( 'Texto de Disponibilidad (Status)', 'chanodev' ),
				'name'  => 'home_hero_status_text',
				'type'  => 'text',
				'default_value' => 'Disponible para nuevos proyectos y consultoría',
			),
			array(
				'key'   => 'field_home_hero_title',
				'label' => __( 'Título Principal (H1)', 'chanodev' ),
				'name'  => 'home_hero_title',
				'type'  => 'textarea',
				'rows'  => 2,
				'default_value' => 'Desarrollo web a medida que impulsa tu negocio.',
			),
			array(
				'key'   => 'field_home_hero_description',
				'label' => __( 'Descripción del Hero', 'chanodev' ),
				'name'  => 'home_hero_description',
				'type'  => 'textarea',
				'rows'  => 4,
				'default_value' => 'Soy Chano Vera, desarrollador web full-stack con más de 9 años creando plataformas a medida. Me enfoco en rendimiento crítico, arquitectura escalable y soluciones que generan impacto real en el negocio sin dependencia de plantillas genéricas.',
			),
			array(
				'key'   => 'field_home_hero_primary_btn_text',
				'label' => __( 'Texto Botón Primario', 'chanodev' ),
				'name'  => 'home_hero_primary_btn_text',
				'type'  => 'text',
				'default_value' => 'Explorar Proyectos',
			),
			array(
				'key'   => 'field_home_hero_primary_btn_url',
				'label' => __( 'URL Botón Primario', 'chanodev' ),
				'name'  => 'home_hero_primary_btn_url',
				'type'  => 'url',
			),
			array(
				'key'   => 'field_home_hero_secondary_btn_text',
				'label' => __( 'Texto Botón Secundario', 'chanodev' ),
				'name'  => 'home_hero_secondary_btn_text',
				'type'  => 'text',
				'default_value' => 'Hablemos de tu proyecto',
			),
			array(
				'key'   => 'field_home_hero_secondary_btn_url',
				'label' => __( 'URL Botón Secundario', 'chanodev' ),
				'name'  => 'home_hero_secondary_btn_url',
				'type'  => 'url',
			),

			// TAB: TERMINAL & MOCKUPS
			array(
				'key'   => 'field_home_tab_terminal',
				'label' => __( 'Terminal & Deck 3D', 'chanodev' ),
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_home_terminal_file',
				'label' => __( 'Nombre de Archivo Terminal', 'chanodev' ),
				'name'  => 'home_terminal_file',
				'type'  => 'text',
				'default_value' => 'chano-stack.json',
			),
			array(
				'key'   => 'field_home_terminal_dev',
				'label' => __( 'Nombre Desarrollador', 'chanodev' ),
				'name'  => 'home_terminal_dev',
				'type'  => 'text',
				'default_value' => 'Chano Vera',
			),
			array(
				'key'   => 'field_home_terminal_role',
				'label' => __( 'Rol Profesional', 'chanodev' ),
				'name'  => 'home_terminal_role',
				'type'  => 'text',
				'default_value' => 'Senior Full-Stack Engineer',
			),
			array(
				'key'   => 'field_home_terminal_location',
				'label' => __( 'Ubicación', 'chanodev' ),
				'name'  => 'home_terminal_location',
				'type'  => 'text',
				'default_value' => 'Remoto · Global',
			),
			array(
				'key'   => 'field_home_terminal_focus',
				'label' => __( 'Focos Técnicos (Separados por coma)', 'chanodev' ),
				'name'  => 'home_terminal_focus',
				'type'  => 'text',
				'default_value' => 'WordPress Custom, WooCommerce, React, Node.js',
			),

			// TAB: PILARES
			array(
				'key'   => 'field_home_tab_pillars',
				'label' => __( 'Pilares de Ingeniería', 'chanodev' ),
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_home_pillars_kicker',
				'label' => __( 'Kicker de Pilares', 'chanodev' ),
				'name'  => 'home_pillars_kicker',
				'type'  => 'text',
				'default_value' => 'Criterio de Ingeniería',
			),
			array(
				'key'   => 'field_home_pillars_title',
				'label' => __( 'Título de Pilares', 'chanodev' ),
				'name'  => 'home_pillars_title',
				'type'  => 'text',
				'default_value' => 'Desarrollo web enfocado en resultados.',
			),
			array(
				'key'   => 'field_home_pillars_description',
				'label' => __( 'Descripción de Pilares', 'chanodev' ),
				'name'  => 'home_pillars_description',
				'type'  => 'textarea',
				'rows'  => 3,
			),
			array(
				'key'          => 'field_home_pillars_items',
				'label'        => __( 'Tarjetas de Pilares', 'chanodev' ),
				'name'         => 'home_pillars_items',
				'type'         => 'repeater',
				'button_label' => __( 'Agregar Pilar', 'chanodev' ),
				'sub_fields'   => array(
					array(
						'key'   => 'field_pillar_num',
						'label' => __( 'Número (ej. 01)', 'chanodev' ),
						'name'  => 'num',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_pillar_badge',
						'label' => __( 'Badge', 'chanodev' ),
						'name'  => 'badge',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_pillar_title',
						'label' => __( 'Título', 'chanodev' ),
						'name'  => 'title',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_pillar_text',
						'label' => __( 'Descripción', 'chanodev' ),
						'name'  => 'text',
						'type'  => 'textarea',
						'rows'  => 3,
					),
				),
			),

			// TAB: SERVICIOS
			array(
				'key'   => 'field_home_tab_services',
				'label' => __( 'Carrusel de Servicios', 'chanodev' ),
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_home_services_kicker',
				'label' => __( 'Kicker de Servicios', 'chanodev' ),
				'name'  => 'home_services_kicker',
				'type'  => 'text',
				'default_value' => 'Especialidades',
			),
			array(
				'key'   => 'field_home_services_title',
				'label' => __( 'Título de Servicios', 'chanodev' ),
				'name'  => 'home_services_title',
				'type'  => 'text',
				'default_value' => 'Servicios de Desarrollo Web a Medida',
			),
			array(
				'key'   => 'field_home_services_description',
				'label' => __( 'Descripción de Servicios', 'chanodev' ),
				'name'  => 'home_services_description',
				'type'  => 'textarea',
				'rows'  => 3,
			),
			array(
				'key'          => 'field_home_services_items',
				'label'        => __( 'Diapositivas de Servicios', 'chanodev' ),
				'name'         => 'home_services_items',
				'type'         => 'repeater',
				'button_label' => __( 'Agregar Servicio', 'chanodev' ),
				'sub_fields'   => array(
					array(
						'key'   => 'field_svc_badge',
						'label' => __( 'Badge', 'chanodev' ),
						'name'  => 'badge',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_svc_title',
						'label' => __( 'Título', 'chanodev' ),
						'name'  => 'title',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_svc_desc',
						'label' => __( 'Descripción', 'chanodev' ),
						'name'  => 'desc',
						'type'  => 'textarea',
						'rows'  => 3,
					),
					array(
						'key'   => 'field_svc_tags',
						'label' => __( 'Etiquetas (Separadas por coma)', 'chanodev' ),
						'name'  => 'tags',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_svc_link',
						'label' => __( 'Enlace', 'chanodev' ),
						'name'  => 'link',
						'type'  => 'url',
					),
					array(
						'key'           => 'field_svc_image',
						'label'         => __( 'Imagen de Fondo del Servicio', 'chanodev' ),
						'name'          => 'image',
						'type'          => 'image',
						'return_format' => 'url',
					),
				),
			),

			// TAB: TESTIMONIOS
			array(
				'key'   => 'field_home_tab_testimonies',
				'label' => __( 'Testimonios', 'chanodev' ),
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_home_testimonies_kicker',
				'label' => __( 'Kicker de Testimonios', 'chanodev' ),
				'name'  => 'home_testimonies_kicker',
				'type'  => 'text',
				'default_value' => 'Testimonios y Confianza',
			),
			array(
				'key'   => 'field_home_testimonies_title',
				'label' => __( 'Título de Testimonios', 'chanodev' ),
				'name'  => 'home_testimonies_title',
				'type'  => 'text',
				'default_value' => 'Lo que dicen quienes han trabajado conmigo',
			),
			array(
				'key'   => 'field_home_testimonies_description',
				'label' => __( 'Descripción de Testimonios', 'chanodev' ),
				'name'  => 'home_testimonies_description',
				'type'  => 'textarea',
				'rows'  => 3,
			),
			array(
				'key'          => 'field_home_testimonials_items',
				'label'        => __( 'Lista de Testimonios', 'chanodev' ),
				'name'         => 'home_testimonials_items',
				'type'         => 'repeater',
				'button_label' => __( 'Agregar Testimonio', 'chanodev' ),
				'sub_fields'   => array(
					array(
						'key'   => 'field_testi_initials',
						'label' => __( 'Iniciales Avatar (ej. AR)', 'chanodev' ),
						'name'  => 'initials',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_testi_gradient',
						'label' => __( 'Gradiente CSS (Opcional)', 'chanodev' ),
						'name'  => 'gradient',
						'type'  => 'text',
						'default_value' => 'linear-gradient(135deg, #0284c7, #38bdf8)',
					),
					array(
						'key'   => 'field_testi_author',
						'label' => __( 'Nombre del Autor', 'chanodev' ),
						'name'  => 'author',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_testi_role',
						'label' => __( 'Cargo / Empresa', 'chanodev' ),
						'name'  => 'role',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_testi_text',
						'label' => __( 'Testimonio', 'chanodev' ),
						'name'  => 'text',
						'type'  => 'textarea',
						'rows'  => 3,
					),
				),
			),

			// TAB: CTA
			array(
				'key'   => 'field_home_tab_cta',
				'label' => __( 'Banner de Llamado a la Acción', 'chanodev' ),
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_home_cta_kicker',
				'label' => __( 'Kicker CTA', 'chanodev' ),
				'name'  => 'home_cta_kicker',
				'type'  => 'text',
				'default_value' => 'Siguiente Paso',
			),
			array(
				'key'   => 'field_home_cta_title',
				'label' => __( 'Título CTA', 'chanodev' ),
				'name'  => 'home_cta_title',
				'type'  => 'text',
				'default_value' => '¿Comenzamos tu próximo proyecto digital?',
			),
			array(
				'key'   => 'field_home_cta_description',
				'label' => __( 'Descripción CTA', 'chanodev' ),
				'name'  => 'home_cta_description',
				'type'  => 'textarea',
				'rows'  => 3,
			),
			array(
				'key'   => 'field_home_cta_btn_text',
				'label' => __( 'Texto Botón CTA', 'chanodev' ),
				'name'  => 'home_cta_btn_text',
				'type'  => 'text',
				'default_value' => 'Contactar y Cotizar',
			),
			array(
				'key'   => 'field_home_cta_btn_url',
				'label' => __( 'URL Botón CTA', 'chanodev' ),
				'name'  => 'home_cta_btn_url',
				'type'  => 'url',
			),
			array(
				'key'   => 'field_home_cta_reassurance_text',
				'label' => __( 'Texto de Confianza / Garantía', 'chanodev' ),
				'name'  => 'home_cta_reassurance_text',
				'type'  => 'text',
				'default_value' => 'Respuesta en menos de 24h · Trato directo',
			),
		),
		'location'              => array(
			array(
				array(
					'param'    => 'page_type',
					'operator' => '==',
					'value'    => 'front_page',
				),
			),
			array(
				array(
					'param'    => 'page_template',
					'operator' => '==',
					'value'    => 'front-page.php',
				),
			),
		),
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
	) );

	// =========================================================================
	// 2. ABOUT PAGE FIELD GROUP
	// =========================================================================
	acf_add_local_field_group( array(
		'key'                   => 'group_chanodev_about',
		'title'                 => __( 'Página Sobre Mí — Contenido & Secciones', 'chanodev' ),
		'fields'                => array(
			// TAB: HERO
			array(
				'key'   => 'field_about_tab_hero',
				'label' => __( 'Hero Principal', 'chanodev' ),
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_about_hero_kicker',
				'label' => __( 'Kicker / Badge', 'chanodev' ),
				'name'  => 'about_hero_kicker',
				'type'  => 'text',
				'default_value' => 'Desarrollador Web Senior & Ingeniero de Software',
			),
			array(
				'key'   => 'field_about_hero_title',
				'label' => __( 'Título Principal (H1)', 'chanodev' ),
				'name'  => 'about_hero_title',
				'type'  => 'textarea',
				'rows'  => 2,
				'default_value' => 'Creando tecnología web que resiste el paso del tiempo.',
			),
			array(
				'key'   => 'field_about_hero_description',
				'label' => __( 'Descripción del Hero', 'chanodev' ),
				'name'  => 'about_hero_description',
				'type'  => 'textarea',
				'rows'  => 4,
			),
			array(
				'key'   => 'field_about_hero_btn_text',
				'label' => __( 'Texto Botón Hero', 'chanodev' ),
				'name'  => 'about_hero_btn_text',
				'type'  => 'text',
				'default_value' => 'Conocer Servicios',
			),
			array(
				'key'   => 'field_about_hero_btn_url',
				'label' => __( 'URL Botón Hero', 'chanodev' ),
				'name'  => 'about_hero_btn_url',
				'type'  => 'url',
			),

			// TAB: METRICS
			array(
				'key'   => 'field_about_tab_metrics',
				'label' => __( 'Métricas Clave', 'chanodev' ),
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_about_metrics_kicker',
				'label' => __( 'Kicker Métricas', 'chanodev' ),
				'name'  => 'about_metrics_kicker',
				'type'  => 'text',
				'default_value' => 'Estándares de Trabajo',
			),
			array(
				'key'   => 'field_about_metrics_title',
				'label' => __( 'Título Métricas', 'chanodev' ),
				'name'  => 'about_metrics_title',
				'type'  => 'text',
				'default_value' => 'Cifras y Principios de Ingeniería',
			),
			array(
				'key'   => 'field_about_metrics_description',
				'label' => __( 'Descripción Métricas', 'chanodev' ),
				'name'  => 'about_metrics_description',
				'type'  => 'textarea',
				'rows'  => 3,
			),
			array(
				'key'          => 'field_about_metrics_items',
				'label'        => __( 'Tarjetas de Métricas', 'chanodev' ),
				'name'         => 'about_metrics_items',
				'type'         => 'repeater',
				'button_label' => __( 'Agregar Métrica', 'chanodev' ),
				'sub_fields'   => array(
					array(
						'key'   => 'field_metric_num',
						'label' => __( 'Número (ej. 01)', 'chanodev' ),
						'name'  => 'number',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_metric_val',
						'label' => __( 'Valor Destacado (ej. 100%, < 1.2s)', 'chanodev' ),
						'name'  => 'value',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_metric_lbl',
						'label' => __( 'Etiqueta', 'chanodev' ),
						'name'  => 'label',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_metric_kck',
						'label' => __( 'Kicker', 'chanodev' ),
						'name'  => 'kicker',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_metric_dsc',
						'label' => __( 'Descripción', 'chanodev' ),
						'name'  => 'desc',
						'type'  => 'textarea',
						'rows'  => 3,
					),
					array(
						'key'           => 'field_metric_img',
						'label'         => __( 'Imagen de Fondo', 'chanodev' ),
						'name'          => 'image',
						'type'          => 'image',
						'return_format' => 'url',
					),
					array(
						'key'   => 'field_metric_hl',
						'label' => __( 'Puntos Clave (1 por línea)', 'chanodev' ),
						'name'  => 'highlights',
						'type'  => 'textarea',
						'rows'  => 3,
					),
				),
			),

			// TAB: SKILLS
			array(
				'key'   => 'field_about_tab_skills',
				'label' => __( 'Habilidades y Stack', 'chanodev' ),
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_about_skills_kicker',
				'label' => __( 'Kicker Habilidades', 'chanodev' ),
				'name'  => 'about_skills_kicker',
				'type'  => 'text',
				'default_value' => 'Competencias y Tecnologías',
			),
			array(
				'key'   => 'field_about_skills_title',
				'label' => __( 'Título Habilidades', 'chanodev' ),
				'name'  => 'about_skills_title',
				'type'  => 'text',
				'default_value' => 'Stack Tecnológico & Especialización',
			),
			array(
				'key'   => 'field_about_skills_description',
				'label' => __( 'Descripción Habilidades', 'chanodev' ),
				'name'  => 'about_skills_description',
				'type'  => 'textarea',
				'rows'  => 3,
			),
			array(
				'key'          => 'field_about_skills_items',
				'label'        => __( 'Tarjetas de Habilidades', 'chanodev' ),
				'name'         => 'about_skills_items',
				'type'         => 'repeater',
				'button_label' => __( 'Agregar Categoría', 'chanodev' ),
				'sub_fields'   => array(
					array(
						'key'   => 'field_skill_cat',
						'label' => __( 'Categoría', 'chanodev' ),
						'name'  => 'category',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_skill_badge',
						'label' => __( 'Badge', 'chanodev' ),
						'name'  => 'badge',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_skill_desc',
						'label' => __( 'Descripción', 'chanodev' ),
						'name'  => 'desc',
						'type'  => 'textarea',
						'rows'  => 3,
					),
					array(
						'key'   => 'field_skill_tags',
						'label' => __( 'Etiquetas (Separadas por coma)', 'chanodev' ),
						'name'  => 'tags',
						'type'  => 'text',
					),
				),
			),

			// TAB: TIMELINE
			array(
				'key'   => 'field_about_tab_timeline',
				'label' => __( 'Trayectoria / Timeline', 'chanodev' ),
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_about_timeline_kicker',
				'label' => __( 'Kicker Trayectoria', 'chanodev' ),
				'name'  => 'about_timeline_kicker',
				'type'  => 'text',
				'default_value' => 'Recorrido Profesional',
			),
			array(
				'key'   => 'field_about_timeline_title',
				'label' => __( 'Título Trayectoria', 'chanodev' ),
				'name'  => 'about_timeline_title',
				'type'  => 'text',
				'default_value' => 'Hitos y Evolución Técnica',
			),
			array(
				'key'   => 'field_about_timeline_description',
				'label' => __( 'Descripción Trayectoria', 'chanodev' ),
				'name'  => 'about_timeline_description',
				'type'  => 'textarea',
				'rows'  => 3,
			),
			array(
				'key'          => 'field_about_timeline_items',
				'label'        => __( 'Hitos de la Trayectoria', 'chanodev' ),
				'name'         => 'about_timeline_items',
				'type'         => 'repeater',
				'button_label' => __( 'Agregar Hito', 'chanodev' ),
				'sub_fields'   => array(
					array(
						'key'   => 'field_time_year',
						'label' => __( 'Año / Período', 'chanodev' ),
						'name'  => 'year',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_time_tag',
						'label' => __( 'Etiqueta / Badge', 'chanodev' ),
						'name'  => 'tag',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_time_role',
						'label' => __( 'Rol / Título', 'chanodev' ),
						'name'  => 'role',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_time_comp',
						'label' => __( 'Empresa / Contexto', 'chanodev' ),
						'name'  => 'company',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_time_desc',
						'label' => __( 'Descripción', 'chanodev' ),
						'name'  => 'desc',
						'type'  => 'textarea',
						'rows'  => 3,
					),
					array(
						'key'   => 'field_time_ach',
						'label' => __( 'Logros Clave (1 por línea)', 'chanodev' ),
						'name'  => 'achievements',
						'type'  => 'textarea',
						'rows'  => 3,
					),
				),
			),

			// TAB: CTA
			array(
				'key'   => 'field_about_tab_cta',
				'label' => __( 'Banner de Llamado a la Acción', 'chanodev' ),
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_about_cta_kicker',
				'label' => __( 'Kicker CTA', 'chanodev' ),
				'name'  => 'about_cta_kicker',
				'type'  => 'text',
				'default_value' => 'Contacto Directo',
			),
			array(
				'key'   => 'field_about_cta_title',
				'label' => __( 'Título CTA', 'chanodev' ),
				'name'  => 'about_cta_title',
				'type'  => 'text',
				'default_value' => '¿Listo para colaborar en tu próximo desarrollo?',
			),
			array(
				'key'   => 'field_about_cta_description',
				'label' => __( 'Descripción CTA', 'chanodev' ),
				'name'  => 'about_cta_description',
				'type'  => 'textarea',
				'rows'  => 3,
			),
			array(
				'key'   => 'field_about_cta_btn_text',
				'label' => __( 'Texto Botón CTA', 'chanodev' ),
				'name'  => 'about_cta_btn_text',
				'type'  => 'text',
				'default_value' => 'Agendar Consulta Técnica',
			),
			array(
				'key'   => 'field_about_cta_btn_url',
				'label' => __( 'URL Botón CTA', 'chanodev' ),
				'name'  => 'about_cta_btn_url',
				'type'  => 'url',
			),
		),
		'location'              => array(
			array(
				array(
					'param'    => 'page_template',
					'operator' => '==',
					'value'    => 'templates/template-about.php',
				),
			),
		),
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
	) );

	// =========================================================================
	// 3. SERVICES PAGE FIELD GROUP
	// =========================================================================
	acf_add_local_field_group( array(
		'key'                   => 'group_chanodev_services',
		'title'                 => __( 'Página de Servicios — Contenido & Secciones', 'chanodev' ),
		'fields'                => array(
			// TAB: HERO
			array(
				'key'   => 'field_serv_tab_hero',
				'label' => __( 'Hero Principal', 'chanodev' ),
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_services_hero_kicker',
				'label' => __( 'Kicker / Badge', 'chanodev' ),
				'name'  => 'services_hero_kicker',
				'type'  => 'text',
				'default_value' => 'Estrategia, código y crecimiento',
			),
			array(
				'key'   => 'field_services_hero_title',
				'label' => __( 'Título Principal (H1)', 'chanodev' ),
				'name'  => 'services_hero_title',
				'type'  => 'textarea',
				'rows'  => 2,
				'default_value' => 'Desarrollo web que convierte complejidad en resultados.',
			),
			array(
				'key'   => 'field_services_hero_description',
				'label' => __( 'Descripción del Hero', 'chanodev' ),
				'name'  => 'services_hero_description',
				'type'  => 'textarea',
				'rows'  => 4,
			),
			array(
				'key'   => 'field_services_hero_primary_btn_text',
				'label' => __( 'Texto Botón Primario', 'chanodev' ),
				'name'  => 'services_hero_primary_btn_text',
				'type'  => 'text',
				'default_value' => 'Hablemos de tu proyecto',
			),
			array(
				'key'   => 'field_services_hero_primary_btn_url',
				'label' => __( 'URL Botón Primario', 'chanodev' ),
				'name'  => 'services_hero_primary_btn_url',
				'type'  => 'url',
			),
			array(
				'key'   => 'field_services_hero_secondary_btn_text',
				'label' => __( 'Texto Botón Secundario', 'chanodev' ),
				'name'  => 'services_hero_secondary_btn_text',
				'type'  => 'text',
				'default_value' => 'Ver casos reales',
			),
			array(
				'key'   => 'field_services_hero_secondary_btn_url',
				'label' => __( 'URL Botón Secundario', 'chanodev' ),
				'name'  => 'services_hero_secondary_btn_url',
				'type'  => 'url',
			),

			// TAB: OFERTA DE SERVICIOS
			array(
				'key'   => 'field_serv_tab_offer',
				'label' => __( 'Oferta de Servicios', 'chanodev' ),
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_services_offer_kicker',
				'label' => __( 'Kicker de Oferta', 'chanodev' ),
				'name'  => 'services_offer_kicker',
				'type'  => 'text',
				'default_value' => 'Lo que puedo construir contigo',
			),
			array(
				'key'   => 'field_services_offer_title',
				'label' => __( 'Título de Oferta', 'chanodev' ),
				'name'  => 'services_offer_title',
				'type'  => 'text',
				'default_value' => 'Una solución adecuada a tu etapa.',
			),
			array(
				'key'   => 'field_services_offer_description',
				'label' => __( 'Descripción de Oferta', 'chanodev' ),
				'name'  => 'services_offer_description',
				'type'  => 'textarea',
				'rows'  => 3,
			),
			array(
				'key'          => 'field_services_offer_items',
				'label'        => __( 'Lista de Servicios Ofrecidos', 'chanodev' ),
				'name'         => 'services_offer_items',
				'type'         => 'repeater',
				'button_label' => __( 'Agregar Servicio', 'chanodev' ),
				'sub_fields'   => array(
					array(
						'key'   => 'field_offer_badge',
						'label' => __( 'Badge', 'chanodev' ),
						'name'  => 'badge',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_offer_title',
						'label' => __( 'Título del Servicio', 'chanodev' ),
						'name'  => 'title',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_offer_desc',
						'label' => __( 'Descripción', 'chanodev' ),
						'name'  => 'description',
						'type'  => 'textarea',
						'rows'  => 3,
					),
					array(
						'key'   => 'field_offer_features',
						'label' => __( 'Características (1 por línea)', 'chanodev' ),
						'name'  => 'features',
						'type'  => 'textarea',
						'rows'  => 3,
					),
					array(
						'key'   => 'field_offer_btn_txt',
						'label' => __( 'Texto Botón', 'chanodev' ),
						'name'  => 'btn_text',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_offer_btn_url',
						'label' => __( 'URL Botón', 'chanodev' ),
						'name'  => 'btn_url',
						'type'  => 'url',
					),
					array(
						'key'   => 'field_offer_featured',
						'label' => __( '¿Destacado?', 'chanodev' ),
						'name'  => 'is_featured',
						'type'  => 'true_false',
					),
				),
			),

			// TAB: MÉTODO Y PROCESO
			array(
				'key'   => 'field_serv_tab_method',
				'label' => __( 'Método y Proceso', 'chanodev' ),
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_services_method_kicker',
				'label' => __( 'Kicker de Método', 'chanodev' ),
				'name'  => 'services_method_kicker',
				'type'  => 'text',
				'default_value' => 'Cómo trabajamos',
			),
			array(
				'key'   => 'field_services_method_title',
				'label' => __( 'Título de Método', 'chanodev' ),
				'name'  => 'services_method_title',
				'type'  => 'text',
				'default_value' => 'Del primer mapa al producto vivo.',
			),
			array(
				'key'   => 'field_services_method_description',
				'label' => __( 'Descripción de Método', 'chanodev' ),
				'name'  => 'services_method_description',
				'type'  => 'textarea',
				'rows'  => 3,
			),
			array(
				'key'          => 'field_services_method_steps',
				'label'        => __( 'Pasos del Método', 'chanodev' ),
				'name'         => 'services_method_steps',
				'type'         => 'repeater',
				'button_label' => __( 'Agregar Paso', 'chanodev' ),
				'sub_fields'   => array(
					array(
						'key'   => 'field_step_num',
						'label' => __( 'Número (ej. 01)', 'chanodev' ),
						'name'  => 'step_number',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_step_ttl',
						'label' => __( 'Título del Paso', 'chanodev' ),
						'name'  => 'step_title',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_step_dsc',
						'label' => __( 'Descripción', 'chanodev' ),
						'name'  => 'step_description',
						'type'  => 'textarea',
						'rows'  => 3,
					),
					array(
						'key'           => 'field_step_img',
						'label'         => __( 'Imagen / SVG del Paso', 'chanodev' ),
						'name'          => 'image',
						'type'          => 'image',
						'return_format' => 'url',
					),
				),
			),

			// TAB: FAQS
			array(
				'key'   => 'field_serv_tab_faqs',
				'label' => __( 'Preguntas Frecuentes', 'chanodev' ),
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_services_faq_kicker',
				'label' => __( 'Kicker FAQs', 'chanodev' ),
				'name'  => 'services_faq_kicker',
				'type'  => 'text',
				'default_value' => 'Preguntas frecuentes',
			),
			array(
				'key'   => 'field_services_faq_title',
				'label' => __( 'Título FAQs', 'chanodev' ),
				'name'  => 'services_faq_title',
				'type'  => 'text',
				'default_value' => 'Antes de dar el siguiente paso.',
			),
			array(
				'key'          => 'field_services_faqs',
				'label'        => __( 'Listado de Preguntas', 'chanodev' ),
				'name'         => 'services_faqs',
				'type'         => 'repeater',
				'button_label' => __( 'Agregar Pregunta', 'chanodev' ),
				'sub_fields'   => array(
					array(
						'key'   => 'field_faq_q',
						'label' => __( 'Pregunta', 'chanodev' ),
						'name'  => 'question',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_faq_a',
						'label' => __( 'Respuesta', 'chanodev' ),
						'name'  => 'answer',
						'type'  => 'textarea',
						'rows'  => 3,
					),
				),
			),

			// TAB: CTA
			array(
				'key'   => 'field_serv_tab_cta',
				'label' => __( 'Banner de Llamado a la Acción', 'chanodev' ),
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_services_cta_kicker',
				'label' => __( 'Kicker CTA', 'chanodev' ),
				'name'  => 'services_cta_kicker',
				'type'  => 'text',
				'default_value' => 'Tu siguiente movimiento',
			),
			array(
				'key'   => 'field_services_cta_title',
				'label' => __( 'Título CTA', 'chanodev' ),
				'name'  => 'services_cta_title',
				'type'  => 'text',
				'default_value' => 'Cuéntame qué quieres hacer posible.',
			),
			array(
				'key'   => 'field_services_cta_description',
				'label' => __( 'Descripción CTA', 'chanodev' ),
				'name'  => 'services_cta_description',
				'type'  => 'textarea',
				'rows'  => 3,
			),
			array(
				'key'   => 'field_services_cta_btn_text',
				'label' => __( 'Texto Botón CTA', 'chanodev' ),
				'name'  => 'services_cta_btn_text',
				'type'  => 'text',
				'default_value' => 'Solicitar una consulta',
			),
			array(
				'key'   => 'field_services_cta_btn_url',
				'label' => __( 'URL Botón CTA', 'chanodev' ),
				'name'  => 'services_cta_btn_url',
				'type'  => 'url',
			),
		),
		'location'              => array(
			array(
				array(
					'param'    => 'page_template',
					'operator' => '==',
					'value'    => 'templates/template-services.php',
				),
			),
		),
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
	) );
}
