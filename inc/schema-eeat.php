<?php
/**
 * Schema.org JSON-LD Structured Data for E-E-A-T Optimization
 *
 * Implements Person, ProfessionalService, CreativeWork, and FAQPage schemas.
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Output JSON-LD schema into the head tag.
 */
function chanodev_output_eeat_schema() {
	$schemas = array();

	$site_url  = home_url( '/' );
	$site_name = get_bloginfo( 'name' );
	$author_url = home_url( '/sobre-mi/' );

	// Base Person / Developer Authority Schema (E-E-A-T Foundation)
	$person_schema = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'Person',
		'@id'         => $site_url . '#chano-developer',
		'name'        => 'Chano Vera',
		'alternateName' => 'ChanoDev',
		'jobTitle'    => 'Senior Web Developer & Full-Stack Engineer',
		'description' => 'Desarrollador web especialista en WordPress a medida, arquitecturas React, NodeJS, WooCommerce y plataformas corporativas.',
		'url'         => $site_url,
		'sameAs'      => array(
			'https://github.com/chanovera-dev',
			'https://chano.dev/',
		),
		'knowsAbout'  => array(
			'WordPress Custom Theme & Plugin Development',
			'Full-Stack JavaScript (React, Node.js, Next.js)',
			'E-Commerce Solutions & WooCommerce Architecture',
			'REST API Design & Web Performance Optimization',
			'Core Web Vitals & Technical SEO for Web Applications',
		),
	);

	// Professional Service Schema
	$service_schema = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'ProfessionalService',
		'@id'         => $site_url . '#professional-service',
		'name'        => 'ChanoDev - Desarrollo Web Profesional',
		'url'         => $site_url,
		'founder'     => array(
			'@id' => $site_url . '#chano-developer',
		),
		'description' => 'Servicios de desarrollo web profesional en WordPress, React, Node.js, e-commerce y sitios corporativos de alto rendimiento.',
		'priceRange'  => '$$',
		'areaServed'  => 'Worldwide',
		'serviceType' => array(
			'Desarrollo WordPress a Medida',
			'Desarrollo de Tiendas Online y WooCommerce',
			'Desarrollo Full-Stack con React y Node.js',
			'Desarrollo Web para Empresas y Prestadores de Servicios',
		),
	);

	$schemas[] = $person_schema;
	$schemas[] = $service_schema;

	if ( is_page_template( 'templates/template-services.php' ) ) {
		// 1. Dynamic FAQ Schema with ACF support & fallbacks
		$acf_faqs = function_exists( 'get_field' ) ? get_field( 'services_faqs' ) : null;
		if ( empty( $acf_faqs ) ) {
			$acf_faqs = array(
				array(
					'question' => '¿Trabajas con proyectos existentes o solo desde cero?',
					'answer'   => 'Ambas opciones. Primero reviso el estado real del proyecto para recomendar si conviene optimizar, refactorizar o reconstruir una parte concreta.',
				),
				array(
					'question' => '¿Qué recibo al terminar el desarrollo?',
					'answer'   => 'Recibes el código y accesos acordados, documentación básica, una sesión de entrega y una lista clara de próximos pasos. El alcance se define por escrito antes de comenzar.',
				),
				array(
					'question' => '¿Cómo se calcula el presupuesto?',
					'answer'   => 'Después de una conversación inicial y una revisión del alcance, presento una propuesta con fases, entregables, tiempos estimados y supuestos.',
				),
				array(
					'question' => '¿Puedes ayudarme después del lanzamiento?',
					'answer'   => 'Sí. Podemos continuar con mantenimiento, soporte y una bolsa de mejoras priorizadas según el comportamiento de usuarios y las necesidades del negocio.',
				),
			);
		}

		$faq_schema = array(
			'@context'   => 'https://schema.org',
			'@type'      => 'FAQPage',
			'@id'        => get_permalink() . '#faq',
			'mainEntity' => array_values(
				array_filter(
					array_map(
						function ( $faq ) {
							$q = ! empty( $faq['question'] ) ? trim( $faq['question'] ) : '';
							$a = ! empty( $faq['answer'] ) ? trim( $faq['answer'] ) : '';
							if ( empty( $q ) || empty( $a ) ) {
								return null;
							}
							return array(
								'@type'          => 'Question',
								'name'           => $q,
								'acceptedAnswer' => array(
									'@type' => 'Answer',
									'text'  => $a,
								),
							);
						},
						$acf_faqs
					)
				)
			),
		);

		$schemas[] = $faq_schema;

		// 2. OfferCatalog & Services Structured Data
		$acf_services = function_exists( 'get_field' ) ? get_field( 'services_offer_items' ) : null;
		if ( empty( $acf_services ) ) {
			$acf_services = array(
				array(
					'title'       => 'WordPress a Medida',
					'description' => 'Temas, plugins y bloques personalizados que dan control a tu equipo sin sacrificar velocidad ni escalabilidad.',
				),
				array(
					'title'       => 'E-commerce y WooCommerce',
					'description' => 'Tiendas online pensadas para que comprar sea fácil, administrar sea sostenible y cada dato ayude a decidir.',
				),
				array(
					'title'       => 'Aplicaciones Web Full-Stack',
					'description' => 'Dashboards, portales y productos digitales con React, Node.js y APIs diseñadas para durar.',
				),
			);
		}

		$service_entities = array();
		foreach ( $acf_services as $srv ) {
			$title = ! empty( $srv['title'] ) ? trim( $srv['title'] ) : '';
			$desc  = ! empty( $srv['description'] ) ? trim( $srv['description'] ) : '';
			if ( empty( $title ) ) {
				continue;
			}
			$service_entities[] = array(
				'@type'       => 'Service',
				'name'        => $title,
				'description' => $desc,
				'provider'    => array(
					'@id' => $site_url . '#professional-service',
				),
				'areaServed'  => 'Worldwide',
			);
		}

		if ( ! empty( $service_entities ) ) {
			$catalog_schema = array(
				'@context'        => 'https://schema.org',
				'@type'           => 'OfferCatalog',
				'@id'             => get_permalink() . '#catalog',
				'name'            => 'Catálogo de Servicios de Desarrollo Web - ChanoDev',
				'itemListElement' => $service_entities,
			);
			$schemas[] = $catalog_schema;
		}
	}

	// About / Profile Page Schema (E-E-A-T ProfilePage)
	if ( is_page_template( 'templates/template-about.php' ) ) {
		$profile_page_schema = array(
			'@context'        => 'https://schema.org',
			'@type'           => 'ProfilePage',
			'@id'             => get_permalink() . '#profilepage',
			'url'             => get_permalink(),
			'name'            => 'Sobre Mí - Chano Vera | Ingeniero de Software & Full-Stack Developer',
			'headline'        => 'Perfil Profesional y Experiencia Técnica de Chano Vera',
			'description'     => 'Conoce la trayectoria, stack tecnológico, principios de desarrollo y especialización en WordPress, React, Node.js y rendimiento web de Chano Vera.',
			'mainEntity'      => array(
				'@id' => $site_url . '#chano-developer',
			),
			'about'           => array(
				'@id' => $site_url . '#chano-developer',
			),
		);
		$schemas[] = $profile_page_schema;
	}

	// Single Project Schema (CreativeWork / SoftwareApplication)
	if ( is_singular( 'project' ) ) {
		$post_id = get_the_ID();
		$details = function_exists( 'chanodev_get_project_details' ) ? chanodev_get_project_details( $post_id ) : array();

		$tech_names = array();
		if ( ! empty( $details['technologies'] ) && ! is_wp_error( $details['technologies'] ) ) {
			foreach ( $details['technologies'] as $term ) {
				$tech_names[] = $term->name;
			}
		}

		$project_schema = array(
			'@context'    => 'https://schema.org',
			'@type'       => 'CreativeWork',
			'@id'         => get_permalink( $post_id ) . '#project',
			'name'        => get_the_title( $post_id ),
			'headline'    => get_the_title( $post_id ),
			'description' => get_the_excerpt( $post_id ),
			'url'         => get_permalink( $post_id ),
			'author'      => array(
				'@id' => $site_url . '#chano-developer',
			),
			'creator'     => array(
				'@id' => $site_url . '#chano-developer',
			),
			'datePublished' => get_the_date( 'c', $post_id ),
			'dateModified'  => get_the_modified_date( 'c', $post_id ),
		);

		if ( has_post_thumbnail( $post_id ) ) {
			$project_schema['image'] = get_the_post_thumbnail_url( $post_id, 'full' );
		}

		if ( ! empty( $tech_names ) ) {
			$project_schema['keywords'] = implode( ', ', $tech_names );
		}

		if ( ! empty( $details['live_url'] ) ) {
			$project_schema['mainEntityOfPage'] = $details['live_url'];
		}

		$schemas[] = $project_schema;
	}

	// Output structured data in JSON-LD format
	echo "\n<!-- Schema.org E-E-A-T Structured Data -->\n";
	echo '<script type="application/ld+json">' . "\n";
	echo wp_json_encode( array(
		'@context' => 'https://schema.org',
		'@graph'   => $schemas,
	), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
	echo "\n</script>\n";
}
add_action( 'wp_head', 'chanodev_output_eeat_schema', 1 );
