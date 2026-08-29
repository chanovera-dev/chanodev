<?php
/**
 * Services Page ACF Fields and Fallbacks
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ==========================================
// 1. HERO SECTION ACF FIELDS & FALLBACKS
// ==========================================
$hero_kicker       = ( function_exists( 'get_field' ) && get_field( 'services_hero_kicker' ) ) ? get_field( 'services_hero_kicker' ) : __( 'Estrategia, código y crecimiento', 'chanodev' );
$hero_title        = ( function_exists( 'get_field' ) && get_field( 'services_hero_title' ) ) ? get_field( 'services_hero_title' ) : __( 'Desarrollo web que convierte complejidad en resultados.', 'chanodev' );
$hero_desc         = ( function_exists( 'get_field' ) && get_field( 'services_hero_description' ) ) ? get_field( 'services_hero_description' ) : __( 'Creo sitios, tiendas y aplicaciones web a medida para empresas que necesitan una base digital rápida, segura y preparada para crecer. Trabajo directamente contigo, desde el diagnóstico hasta la puesta en producción.', 'chanodev' );
$primary_btn_txt   = ( function_exists( 'get_field' ) && get_field( 'services_hero_primary_btn_text' ) ) ? get_field( 'services_hero_primary_btn_text' ) : __( 'Hablemos de tu proyecto', 'chanodev' );
$primary_btn_url   = ( function_exists( 'get_field' ) && get_field( 'services_hero_primary_btn_url' ) ) ? get_field( 'services_hero_primary_btn_url' ) : home_url( '/contacto/' );
$secondary_btn_txt = ( function_exists( 'get_field' ) && get_field( 'services_hero_secondary_btn_text' ) ) ? get_field( 'services_hero_secondary_btn_text' ) : __( 'Ver casos reales', 'chanodev' );
$secondary_btn_url = ( function_exists( 'get_field' ) && get_field( 'services_hero_secondary_btn_url' ) ) ? get_field( 'services_hero_secondary_btn_url' ) : home_url( '/proyectos/' );
$trust_text        = ( function_exists( 'get_field' ) && get_field( 'services_hero_trust_text' ) ) ? get_field( 'services_hero_trust_text' ) : __( 'Disponible para proyectos a medida y consultoría técnica', 'chanodev' );

// Visual window subfields
$window_title = ( function_exists( 'get_field' ) && get_field( 'services_window_file_name' ) ) ? get_field( 'services_window_file_name' ) : 'chano.dev / build';
$window_badge = ( function_exists( 'get_field' ) && get_field( 'services_window_badge' ) ) ? get_field( 'services_window_badge' ) : 'CD';
$window_tag   = ( function_exists( 'get_field' ) && get_field( 'services_window_tag' ) ) ? get_field( 'services_window_tag' ) : __( 'PROYECTO DIGITAL', 'chanodev' );
$window_h2    = ( function_exists( 'get_field' ) && get_field( 'services_window_heading' ) ) ? get_field( 'services_window_heading' ) : __( 'Rápido por dentro.', 'chanodev' );
$window_h2_em = ( function_exists( 'get_field' ) && get_field( 'services_window_heading_em' ) ) ? get_field( 'services_window_heading_em' ) : __( 'Claro por fuera.', 'chanodev' );
$metric_1_val = ( function_exists( 'get_field' ) && get_field( 'services_window_metric_1_val' ) ) ? get_field( 'services_window_metric_1_val' ) : '98';
$metric_1_lbl = ( function_exists( 'get_field' ) && get_field( 'services_window_metric_1_label' ) ) ? get_field( 'services_window_metric_1_label' ) : __( 'Rendimiento', 'chanodev' );
$metric_2_val = ( function_exists( 'get_field' ) && get_field( 'services_window_metric_2_val' ) ) ? get_field( 'services_window_metric_2_val' ) : 'AA';
$metric_2_lbl = ( function_exists( 'get_field' ) && get_field( 'services_window_metric_2_label' ) ) ? get_field( 'services_window_metric_2_label' ) : __( 'Accesibilidad', 'chanodev' );

// Slideshow proof strip repeater
$proof_slides = function_exists( 'get_field' ) ? get_field( 'services_proof_slides' ) : null;
if ( empty( $proof_slides ) ) {
	$proof_slides = array(
		array(
			'number' => '01',
			'text'   => __( 'Diagnóstico antes de desarrollar', 'chanodev' ),
		),
		array(
			'number' => '02',
			'text'   => __( 'Código mantenible y documentado', 'chanodev' ),
		),
		array(
			'number' => '03',
			'text'   => __( 'Medición después del lanzamiento', 'chanodev' ),
		),
	);
}
$total_slides      = count( $proof_slides );
$seconds_per_slide = 3;
$total_duration    = max( 1, $total_slides ) * $seconds_per_slide;

// ==========================================
// 2. OFFER / SERVICES ACF FIELDS & FALLBACKS
// ==========================================
$offer_kicker = ( function_exists( 'get_field' ) && get_field( 'services_offer_kicker' ) ) ? get_field( 'services_offer_kicker' ) : __( 'Lo que puedo construir contigo', 'chanodev' );
$offer_title  = ( function_exists( 'get_field' ) && get_field( 'services_offer_title' ) ) ? get_field( 'services_offer_title' ) : __( 'Una solución adecuada a tu etapa.', 'chanodev' );
$offer_desc   = ( function_exists( 'get_field' ) && get_field( 'services_offer_description' ) ) ? get_field( 'services_offer_description' ) : __( 'Sin recetas prefabricadas. Cada servicio parte de tus objetivos, tus usuarios y la realidad de tu operación.', 'chanodev' );
$offer_items  = function_exists( 'get_field' ) ? get_field( 'services_offer_items' ) : null;
if ( empty( $offer_items ) ) {
	$offer_items = array(
		array(
			'icon'        => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m16 18 6-6-6-6"/><path d="m8 6-6 6 6 6"/></svg>',
			'badge'       => __( 'Base sólida', 'chanodev' ),
			'title'       => __( 'WordPress a medida', 'chanodev' ),
			'description' => __( 'Temas, plugins y bloques personalizados que dan control a tu equipo sin sacrificar velocidad ni escalabilidad.', 'chanodev' ),
			'features'    => array(
				__( 'Arquitectura de contenido clara', 'chanodev' ),
				__( 'Integraciones y automatizaciones', 'chanodev' ),
				__( 'SEO técnico y Core Web Vitals', 'chanodev' ),
			),
			'btn_text'    => __( 'Diseñar mi sitio', 'chanodev' ),
			'btn_url'     => home_url( '/contacto/' ),
			'is_featured' => true,
		),
		array(
			'icon'        => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>',
			'badge'       => __( 'Vende mejor', 'chanodev' ),
			'title'       => __( 'E-commerce y WooCommerce', 'chanodev' ),
			'description' => __( 'Tiendas online pensadas para que comprar sea fácil, administrar sea sostenible y cada dato ayude a decidir.', 'chanodev' ),
			'features'    => array(
				__( 'Checkout y catálogo optimizados', 'chanodev' ),
				__( 'Pagos, envíos e inventario', 'chanodev' ),
				__( 'Analítica y embudos de conversión', 'chanodev' ),
			),
			'btn_text'    => __( 'Planear mi tienda', 'chanodev' ),
			'btn_url'     => home_url( '/contacto/' ),
			'is_featured' => false,
		),
		array(
			'icon'        => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 2 10 5-10 5L2 7l10-5Z"/><path d="m2 12 10 5 10-5"/><path d="m2 17 10 5 10-5"/></svg>',
			'badge'       => __( 'Escala sin fricción', 'chanodev' ),
			'title'       => __( 'Aplicaciones web', 'chanodev' ),
			'description' => __( 'Dashboards, portales y productos digitales con React, Node.js y APIs diseñadas para durar.', 'chanodev' ),
			'features'    => array(
				__( 'Interfaces rápidas y accesibles', 'chanodev' ),
				__( 'APIs REST e integraciones', 'chanodev' ),
				__( 'Autenticación y buenas prácticas', 'chanodev' ),
			),
			'btn_text'    => __( 'Validar mi idea', 'chanodev' ),
			'btn_url'     => home_url( '/contacto/' ),
			'is_featured' => false,
		),
	);
}

// ==========================================
// 3. METHOD / PROCESS ACF FIELDS & FALLBACKS
// ==========================================
$method_kicker = ( function_exists( 'get_field' ) && get_field( 'services_method_kicker' ) ) ? get_field( 'services_method_kicker' ) : __( 'Cómo trabajamos', 'chanodev' );
$method_title  = ( function_exists( 'get_field' ) && get_field( 'services_method_title' ) ) ? get_field( 'services_method_title' ) : __( 'Del primer mapa al producto vivo.', 'chanodev' );
$method_desc   = ( function_exists( 'get_field' ) && get_field( 'services_method_description' ) ) ? get_field( 'services_method_description' ) : __( 'Un proceso visible, con decisiones explicadas y entregables concretos en cada etapa.', 'chanodev' );
$method_steps  = function_exists( 'get_field' ) ? get_field( 'services_method_steps' ) : null;
if ( empty( $method_steps ) ) {
	$method_steps = array(
		array(
			'step_number'      => '01',
			'step_title'       => __( 'Entender', 'chanodev' ),
			'step_description' => __( 'Aterrizamos objetivos, usuarios, restricciones y la métrica que definirá el éxito.', 'chanodev' ),
			'image'            => CHANODEV_URI . '/assets/images/step-1-understand-realistic.svg?v=3',
		),
		array(
			'step_number'      => '02',
			'step_title'       => __( 'Diseñar', 'chanodev' ),
			'step_description' => __( 'Definimos arquitectura, experiencia y alcance. Lo complejo queda explicado antes de tocar código.', 'chanodev' ),
			'image'            => CHANODEV_URI . '/assets/images/step-2-design-realistic.svg?v=4',
		),
		array(
			'step_number'      => '03',
			'step_title'       => __( 'Construir', 'chanodev' ),
			'step_description' => __( 'Desarrollo iterativo con revisiones, pruebas y una base técnica que tu equipo pueda mantener.', 'chanodev' ),
			'image'            => CHANODEV_URI . '/assets/images/step-3-build-realistic.svg?v=3',
		),
		array(
			'step_number'      => '04',
			'step_title'       => __( 'Mejorar', 'chanodev' ),
			'step_description' => __( 'Lanzamos, medimos y priorizamos mejoras con datos reales, no con suposiciones.', 'chanodev' ),
			'image'            => CHANODEV_URI . '/assets/images/step-4-improve-realistic.svg?v=3',
		),
	);
}

// ==========================================
// 4. AUTHORITY SECTION ACF FIELDS & FALLBACKS
// ==========================================
$auth_kicker  = ( function_exists( 'get_field' ) && get_field( 'services_authority_kicker' ) ) ? get_field( 'services_authority_kicker' ) : __( 'Experiencia que se puede revisar', 'chanodev' );
$auth_title   = ( function_exists( 'get_field' ) && get_field( 'services_authority_title' ) ) ? get_field( 'services_authority_title' ) : __( 'Decisiones técnicas al servicio del negocio.', 'chanodev' );
$auth_text    = ( function_exists( 'get_field' ) && get_field( 'services_authority_text' ) ) ? get_field( 'services_authority_text' ) : __( 'Soy Chano Vera, ingeniero de software y desarrollador full-stack. Me especializo en WordPress a medida, WooCommerce, React, Node.js, rendimiento web y SEO técnico. Cada proyecto combina criterio de producto con ejecución técnica directa.', 'chanodev' );
$auth_btn_txt = ( function_exists( 'get_field' ) && get_field( 'services_authority_btn_text' ) ) ? get_field( 'services_authority_btn_text' ) : __( 'Conocer mi experiencia', 'chanodev' );
$auth_btn_url = ( function_exists( 'get_field' ) && get_field( 'services_authority_btn_url' ) ) ? get_field( 'services_authority_btn_url' ) : home_url( '/sobre-mi/' );
$auth_metrics = function_exists( 'get_field' ) ? get_field( 'services_authority_metrics' ) : null;
if ( empty( $auth_metrics ) ) {
	$auth_metrics = array(
		array(
			'value' => 'Custom',
			'label' => __( 'desarrollo sin plantillas rígidas', 'chanodev' ),
		),
		array(
			'value' => 'CWV',
			'label' => __( 'rendimiento como criterio técnico', 'chanodev' ),
		),
		array(
			'value' => '1:1',
			'label' => __( 'comunicación directa contigo', 'chanodev' ),
		),
	);
}

// ==========================================
// 5. FAQ SECTION ACF FIELDS & FALLBACKS
// ==========================================
$faq_kicker = ( function_exists( 'get_field' ) && get_field( 'services_faq_kicker' ) ) ? get_field( 'services_faq_kicker' ) : __( 'Preguntas frecuentes', 'chanodev' );
$faq_title  = ( function_exists( 'get_field' ) && get_field( 'services_faq_title' ) ) ? get_field( 'services_faq_title' ) : __( 'Antes de dar el siguiente paso.', 'chanodev' );
$faqs       = function_exists( 'get_field' ) ? get_field( 'services_faqs' ) : null;
if ( empty( $faqs ) ) {
	$faqs = array(
		array(
			'question' => __( '¿Trabajas con proyectos existentes o solo desde cero?', 'chanodev' ),
			'answer'   => __( 'Ambas opciones. Primero reviso el estado real del proyecto para recomendar si conviene optimizar, refactorizar o reconstruir una parte concreta.', 'chanodev' ),
		),
		array(
			'question' => __( '¿Qué recibo al terminar el desarrollo?', 'chanodev' ),
			'answer'   => __( 'Recibes el código y accesos acordados, documentación básica, una sesión de entrega y una lista clara de próximos pasos. El alcance se define por escrito antes de comenzar.', 'chanodev' ),
		),
		array(
			'question' => __( '¿Cómo se calcula el presupuesto?', 'chanodev' ),
			'answer'   => __( 'Después de una conversación inicial y una revisión del alcance, presento una propuesta con fases, entregables, tiempos estimados y supuestos. No hay presupuesto genérico sin entender el problema.', 'chanodev' ),
		),
		array(
			'question' => __( '¿Puedes ayudarme después del lanzamiento?', 'chanodev' ),
			'answer'   => __( 'Sí. Podemos continuar con mantenimiento, soporte y una bolsa de mejoras priorizadas según el comportamiento de usuarios y las necesidades del negocio.', 'chanodev' ),
		),
	);
}

// ==========================================
// 6. CTA BLOCK ACF FIELDS & FALLBACKS
// ==========================================
$cta_kicker  = ( function_exists( 'get_field' ) && get_field( 'services_cta_kicker' ) ) ? get_field( 'services_cta_kicker' ) : __( 'Tu siguiente movimiento', 'chanodev' );
$cta_title   = ( function_exists( 'get_field' ) && get_field( 'services_cta_title' ) ) ? get_field( 'services_cta_title' ) : __( 'Cuéntame qué quieres hacer posible.', 'chanodev' );
$cta_desc    = ( function_exists( 'get_field' ) && get_field( 'services_cta_description' ) ) ? get_field( 'services_cta_description' ) : __( 'Una consulta inicial para entender tu contexto, detectar oportunidades y decidir el camino más sensato.', 'chanodev' );
$cta_btn_txt = ( function_exists( 'get_field' ) && get_field( 'services_cta_btn_text' ) ) ? get_field( 'services_cta_btn_text' ) : __( 'Solicitar una consulta', 'chanodev' );
$cta_btn_url = ( function_exists( 'get_field' ) && get_field( 'services_cta_btn_url' ) ) ? get_field( 'services_cta_btn_url' ) : home_url( '/contacto/' );
