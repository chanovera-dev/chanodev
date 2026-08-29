<?php
/**
 * Front Page ACF Fields and Fallbacks
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ==========================================
// 1. HERO SECTION ACF FIELDS & FALLBACKS
// ==========================================
$hero_kicker        = ( function_exists( 'get_field' ) && get_field( 'home_hero_kicker' ) ) ? get_field( 'home_hero_kicker' ) : __( 'Senior Full-Stack Web & WordPress', 'chanodev' );
$hero_status_txt    = ( function_exists( 'get_field' ) && get_field( 'home_hero_status_text' ) ) ? get_field( 'home_hero_status_text' ) : __( 'Disponible para nuevos proyectos y consultoría', 'chanodev' );
$hero_headline      = ( function_exists( 'get_field' ) && get_field( 'home_hero_title' ) ) ? get_field( 'home_hero_title' ) : __( 'Desarrollo web a medida que impulsa tu negocio.', 'chanodev' );
$hero_subheadline   = ( function_exists( 'get_field' ) && get_field( 'home_hero_description' ) ) ? get_field( 'home_hero_description' ) : __( 'Soy Chano Vera, desarrollador web full-stack con más de 9 años creando plataformas a medida. Me enfoco en rendimiento crítico, arquitectura escalable y soluciones que generan impacto real en el negocio sin dependencia de plantillas genéricas.', 'chanodev' );
$hero_primary_txt   = ( function_exists( 'get_field' ) && get_field( 'home_hero_primary_btn_text' ) ) ? get_field( 'home_hero_primary_btn_text' ) : __( 'Explorar Proyectos', 'chanodev' );
$hero_primary_url   = ( function_exists( 'get_field' ) && get_field( 'home_hero_primary_btn_url' ) ) ? get_field( 'home_hero_primary_btn_url' ) : home_url( '/proyectos/' );
$hero_secondary_txt = ( function_exists( 'get_field' ) && get_field( 'home_hero_secondary_btn_text' ) ) ? get_field( 'home_hero_secondary_btn_text' ) : __( 'Hablemos de tu proyecto', 'chanodev' );
$hero_secondary_url = ( function_exists( 'get_field' ) && get_field( 'home_hero_secondary_btn_url' ) ) ? get_field( 'home_hero_secondary_btn_url' ) : home_url( '/contacto/' );

$hero_metrics = function_exists( 'get_field' ) ? get_field( 'home_hero_metrics' ) : null;
if ( empty( $hero_metrics ) ) {
	$hero_metrics = array(
		array(
			'num'    => '100%',
			'desc'   => __( 'Código a Medida', 'chanodev' ),
			'kicker' => __( 'Arquitectura Limpia', 'chanodev' ),
			'text'   => __( 'Desarrollo artesanal sin plantillas genéricas ni constructores que ralenticen tu web.', 'chanodev' ),
			'icon'   => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83Z"/><path d="m22 17.65-9.17 4.16a2 2 0 0 1-1.66 0L2 17.65"/><path d="m22 12.65-9.17 4.16a2 2 0 0 1-1.66 0L2 12.65"/></svg>',
		),
		array(
			'num'    => '< 1.2s',
			'desc'   => __( 'Tiempos de Carga LCP', 'chanodev' ),
			'kicker' => __( 'Rendimiento Crítico', 'chanodev' ),
			'text'   => __( 'Optimización profunda de Core Web Vitals (LCP, INP, CLS) con arquitectura técnica y zero bloatware.', 'chanodev' ),
			'icon'   => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>',
		),
		array(
			'num'    => '+38%',
			'desc'   => __( 'Conversión WooCommerce', 'chanodev' ),
			'kicker' => __( 'E-Commerce de Alto Tráfico', 'chanodev' ),
			'text'   => __( 'Tiendas online ultrarrápidas con checkout en 1 paso, pasarelas optimizadas y caché distribuida.', 'chanodev' ),
			'icon'   => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>',
		),
		array(
			'num'    => '42ms',
			'desc'   => __( 'React & APIs en Tiempo Real', 'chanodev' ),
			'kicker' => __( 'SaaS & Modern Web', 'chanodev' ),
			'text'   => __( 'Dashboards interactivos y servicios backend de baja latencia con WebSockets y GraphQL.', 'chanodev' ),
			'icon'   => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="12" rx="10" ry="4"/><ellipse cx="12" cy="12" rx="10" ry="4" transform="rotate(60 12 12)"/><ellipse cx="12" cy="12" rx="10" ry="4" transform="rotate(120 12 12)"/></svg>',
		),
	);
}

// Hero Visual 4-Card Deck ACF fields
// Card 2: Performance & Speed Window (PageSpeed / Core Web Vitals)
$perf_window_url    = ( function_exists( 'get_field' ) && get_field( 'home_perf_window_url' ) ) ? get_field( 'home_perf_window_url' ) : 'pagespeed.web.dev/report';
$perf_badge_txt     = ( function_exists( 'get_field' ) && get_field( 'home_perf_badge_text' ) ) ? get_field( 'home_perf_badge_text' ) : 'Core Web Vitals';
$perf_score_val     = ( function_exists( 'get_field' ) && ( false !== get_field( 'home_perf_score_val' ) && '' !== get_field( 'home_perf_score_val' ) ) ) ? get_field( 'home_perf_score_val' ) : '100';
$perf_heading       = ( function_exists( 'get_field' ) && get_field( 'home_perf_heading' ) ) ? get_field( 'home_perf_heading' ) : __( 'Core Web Vitals: Aprobado', 'chanodev' );
$perf_subheading    = ( function_exists( 'get_field' ) && get_field( 'home_perf_subheading' ) ) ? get_field( 'home_perf_subheading' ) : __( 'Métricas en verde en móvil y escritorio', 'chanodev' );
$perf_lcp_val       = ( function_exists( 'get_field' ) && get_field( 'home_perf_lcp_val' ) ) ? get_field( 'home_perf_lcp_val' ) : '< 0.8s';
$perf_inp_val       = ( function_exists( 'get_field' ) && get_field( 'home_perf_inp_val' ) ) ? get_field( 'home_perf_inp_val' ) : '< 28ms';
$perf_cls_val       = ( function_exists( 'get_field' ) && ( false !== get_field( 'home_perf_cls_val' ) && '' !== get_field( 'home_perf_cls_val' ) ) ) ? get_field( 'home_perf_cls_val' ) : '0.00';
$perf_ttfb_val      = ( function_exists( 'get_field' ) && get_field( 'home_perf_ttfb_val' ) ) ? get_field( 'home_perf_ttfb_val' ) : '45ms';

// Card 1: Architecture & Clean Code Window
$arch_window_url    = ( function_exists( 'get_field' ) && get_field( 'home_arch_window_url' ) ) ? get_field( 'home_arch_window_url' ) : 'chano.dev/build';
$arch_badge_txt     = ( function_exists( 'get_field' ) && get_field( 'home_arch_badge_text' ) ) ? get_field( 'home_arch_badge_text' ) : 'Clean Architecture';
$arch_heading       = ( function_exists( 'get_field' ) && get_field( 'home_arch_heading' ) ) ? get_field( 'home_arch_heading' ) : __( 'Arquitectura Limpia & Modular', 'chanodev' );
$arch_subheading    = ( function_exists( 'get_field' ) && get_field( 'home_arch_subheading' ) ) ? get_field( 'home_arch_subheading' ) : __( 'Desarrollo artesanal sin plantillas infladas', 'chanodev' );
$arch_metric_1_val  = ( function_exists( 'get_field' ) && get_field( 'home_arch_metric_1_val' ) ) ? get_field( 'home_arch_metric_1_val' ) : '100%';
$arch_metric_1_lbl  = ( function_exists( 'get_field' ) && get_field( 'home_arch_metric_1_lbl' ) ) ? get_field( 'home_arch_metric_1_lbl' ) : __( 'Código a Medida', 'chanodev' );
$arch_metric_2_val  = ( function_exists( 'get_field' ) && get_field( 'home_arch_metric_2_val' ) ) ? get_field( 'home_arch_metric_2_val' ) : '0';
$arch_metric_2_lbl  = ( function_exists( 'get_field' ) && get_field( 'home_arch_metric_2_lbl' ) ) ? get_field( 'home_arch_metric_2_lbl' ) : __( 'Constructores Pesados', 'chanodev' );

// Card 3: E-Commerce WooCommerce Mockup
$ecom_window_url    = ( function_exists( 'get_field' ) && get_field( 'home_ecom_window_url' ) ) ? get_field( 'home_ecom_window_url' ) : 'store.chano.dev/shop';
$ecom_badge_txt     = ( function_exists( 'get_field' ) && get_field( 'home_ecom_badge_text' ) ) ? get_field( 'home_ecom_badge_text' ) : 'WooCommerce';
$ecom_store_name    = ( function_exists( 'get_field' ) && get_field( 'home_ecom_store_name' ) ) ? get_field( 'home_ecom_store_name' ) : 'CHANO STORE';
$ecom_prod_name     = ( function_exists( 'get_field' ) && get_field( 'home_ecom_prod_name' ) ) ? get_field( 'home_ecom_prod_name' ) : __( 'WordPress FSE Core Theme Pro', 'chanodev' );
$ecom_prod_price    = ( function_exists( 'get_field' ) && get_field( 'home_ecom_prod_price' ) ) ? get_field( 'home_ecom_prod_price' ) : '$89.00';
$ecom_prod_oldprice = ( function_exists( 'get_field' ) && get_field( 'home_ecom_prod_oldprice' ) ) ? get_field( 'home_ecom_prod_oldprice' ) : '$129.00';
$ecom_lcp_val       = ( function_exists( 'get_field' ) && get_field( 'home_ecom_lcp_val' ) ) ? get_field( 'home_ecom_lcp_val' ) : '< 0.8s';
$ecom_growth_val    = ( function_exists( 'get_field' ) && get_field( 'home_ecom_growth_val' ) ) ? get_field( 'home_ecom_growth_val' ) : '+38%';

// Card 4: React & Node.js Analytics Dashboard Mockup
$app_window_url     = ( function_exists( 'get_field' ) && get_field( 'home_app_window_url' ) ) ? get_field( 'home_app_window_url' ) : 'app.chano.dev/analytics';
$app_badge_txt      = ( function_exists( 'get_field' ) && get_field( 'home_app_badge_text' ) ) ? get_field( 'home_app_badge_text' ) : 'Analytics';
$app_heading        = ( function_exists( 'get_field' ) && get_field( 'home_app_heading' ) ) ? get_field( 'home_app_heading' ) : __( 'Dashboard de Métricas & Tráfico', 'chanodev' );
$app_visitors_val   = ( function_exists( 'get_field' ) && get_field( 'home_app_visitors_val' ) ) ? get_field( 'home_app_visitors_val' ) : '148.5K';
$app_views_val      = ( function_exists( 'get_field' ) && get_field( 'home_app_views_val' ) ) ? get_field( 'home_app_views_val' ) : '412.0K';
$app_bounce_val     = ( function_exists( 'get_field' ) && get_field( 'home_app_bounce_val' ) ) ? get_field( 'home_app_bounce_val' ) : '24.6%';
$app_latency_val    = ( function_exists( 'get_field' ) && get_field( 'home_app_latency_val' ) ) ? get_field( 'home_app_latency_val' ) : '42ms';

// ==========================================
// 2. PILLARS / ENGINEERING STANDARDS ACF FIELDS
// ==========================================
$pillars_kicker = ( function_exists( 'get_field' ) && get_field( 'home_pillars_kicker' ) ) ? get_field( 'home_pillars_kicker' ) : __( 'Criterio de Ingeniería', 'chanodev' );
$pillars_title  = ( function_exists( 'get_field' ) && get_field( 'home_pillars_title' ) ) ? get_field( 'home_pillars_title' ) : __( 'Desarrollo web enfocado en resultados.', 'chanodev' );
$pillars_desc   = ( function_exists( 'get_field' ) && get_field( 'home_pillars_description' ) ) ? get_field( 'home_pillars_description' ) : __( 'Principios que aseguran que cada proyecto funcione con velocidad extrema, seguridad y total autonomía para tu equipo.', 'chanodev' );

$pillars_items = function_exists( 'get_field' ) ? get_field( 'home_pillars_items' ) : null;
if ( empty( $pillars_items ) ) {
	$pillars_items = array(
		array(
			'num'   => '01',
			'badge' => __( 'Pureza', 'chanodev' ),
			'title' => __( 'Zero Bloatware', 'chanodev' ),
			'text'  => __( 'Sin constructores pesados ni plugins innecesarios. Cada línea de código está optimizada para maximizar rendimiento y estabilidad.', 'chanodev' ),
			'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>',
		),
		array(
			'num'   => '02',
			'badge' => __( 'Conversión', 'chanodev' ),
			'title' => __( 'Velocidad Extrema', 'chanodev' ),
			'text'  => __( 'Tiempos de carga ultrarrápidos (LCP < 1.2s). Sitios diseñados para superar las exigencias de Core Web Vitals y posicionar mejor en Google.', 'chanodev' ),
			'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>',
		),
		array(
			'num'   => '03',
			'badge' => __( 'Escalabilidad', 'chanodev' ),
			'title' => __( 'Arquitectura Sólida', 'chanodev' ),
			'text'  => __( 'Estructura modular limpia en PHP 8+ y JavaScript moderno para que tu plataforma crezca sin deuda técnica ni ataduras.', 'chanodev' ),
			'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83Z"/><path d="m22 17.65-9.17 4.16a2 2 0 0 1-1.66 0L2 17.65"/><path d="m22 12.65-9.17 4.16a2 2 0 0 1-1.66 0L2 12.65"/></svg>',
		),
		array(
			'num'   => '04',
			'badge' => __( 'Transparencia', 'chanodev' ),
			'title' => __( 'Trato Directo 1:1', 'chanodev' ),
			'text'  => __( 'Hablas y decides directamente con el programador de la web, sin intermediarios, retrasos de comunicación ni costes inflados.', 'chanodev' ),
			'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>',
		),
	);
}

// ==========================================
// 3. FEATURED PROJECTS ACF FIELDS & FALLBACKS
// ==========================================
$projects_kicker  = ( function_exists( 'get_field' ) && get_field( 'home_projects_kicker' ) ) ? get_field( 'home_projects_kicker' ) : __( 'Portafolio Destacado', 'chanodev' );
$projects_title   = ( function_exists( 'get_field' ) && get_field( 'home_projects_title' ) ) ? get_field( 'home_projects_title' ) : __( 'Casos Reales y Desarrollos en Producción', 'chanodev' );
$projects_btn_txt = ( function_exists( 'get_field' ) && get_field( 'home_projects_btn_text' ) ) ? get_field( 'home_projects_btn_text' ) : __( 'Ver todos los proyectos', 'chanodev' );
$projects_btn_url = ( function_exists( 'get_field' ) && get_field( 'home_projects_btn_url' ) ) ? get_field( 'home_projects_btn_url' ) : home_url( '/proyectos/' );

// ==========================================
// 4. CORE SERVICES ACF FIELDS & FALLBACKS
// ==========================================
$services_kicker = ( function_exists( 'get_field' ) && get_field( 'home_services_kicker' ) ) ? get_field( 'home_services_kicker' ) : __( 'Especialidades', 'chanodev' );
$services_title  = ( function_exists( 'get_field' ) && get_field( 'home_services_title' ) ) ? get_field( 'home_services_title' ) : __( 'Servicios de Desarrollo Web a Medida', 'chanodev' );
$services_desc   = ( function_exists( 'get_field' ) && get_field( 'home_services_description' ) ) ? get_field( 'home_services_description' ) : __( 'Soluciones de programación limpias y optimizadas para cada necesidad empresarial.', 'chanodev' );

$services_items = function_exists( 'get_field' ) ? get_field( 'home_services_items' ) : null;
if ( empty( $services_items ) ) {
	$services_items = array(
		array(
			'icon'   => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m16 18 6-6-6-6"/><path d="m8 6-6 6 6 6"/></svg>',
			'badge'  => 'Core WordPress',
			'title'  => __( 'WordPress & Backend PHP', 'chanodev' ),
			'desc'   => __( 'Temas FSE y bloques Gutenberg a medida, plugins personalizados y arquitecturas REST API sin constructores pesados.', 'chanodev' ),
			'tags'   => array( 'Temas a Medida', 'Gutenberg Blocks', 'PHP 8+', 'REST API' ),
			'link'   => home_url( '/servicios/' ),
			'image'  => CHANODEV_URI . '/assets/images/service-1-wordpress.jpg',
		),
		array(
			'icon'   => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>',
			'badge'  => 'E-Commerce',
			'title'  => __( 'Tiendas Online WooCommerce', 'chanodev' ),
			'desc'   => __( 'Comercio electrónico de alto tráfico con checkout en 1 paso, pasarelas de pago seguras y sincronización de inventario.', 'chanodev' ),
			'tags'   => array( 'WooCommerce', 'Stripe / Redsys', 'Checkout Rápido', 'WPO E-Commerce' ),
			'link'   => home_url( '/servicios/' ),
			'image'  => CHANODEV_URI . '/assets/images/service-2-ecommerce.jpg',
		),
		array(
			'icon'   => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="12" rx="10" ry="4"/><ellipse cx="12" cy="12" rx="10" ry="4" transform="rotate(60 12 12)"/><ellipse cx="12" cy="12" rx="10" ry="4" transform="rotate(120 12 12)"/></svg>',
			'badge'  => 'Modern Frontend',
			'title'  => __( 'React, Next.js & APIs Node.js', 'chanodev' ),
			'desc'   => __( 'Aplicaciones dinámicas, Single Page Applications reactivas, microservicios backend y paneles de control interactivos.', 'chanodev' ),
			'tags'   => array( 'React.js', 'Next.js', 'Node.js', 'Microservicios' ),
			'link'   => home_url( '/servicios/' ),
			'image'  => CHANODEV_URI . '/assets/images/service-3-react-node.jpg',
		),
		array(
			'icon'   => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"/></svg>',
			'badge'  => 'Speed & SEO',
			'title'  => __( 'WPO & Core Web Vitals', 'chanodev' ),
			'desc'   => __( 'Diagnóstico técnico exhaustivo, aceleración de carga LCP < 1.2s, datos estructurados Schema.org y accesibilidad WCAG.', 'chanodev' ),
			'tags'   => array( 'PageSpeed 95+', 'Core Web Vitals', 'Schema JSON-LD', 'Accesibilidad' ),
			'link'   => home_url( '/servicios/' ),
			'image'  => CHANODEV_URI . '/assets/images/service-4-wpo-speed.jpg',
		),
	);
}

// ==========================================
// 5. TECH STACK STRIP ACF FIELDS & FALLBACKS
// ==========================================
$tech_kicker = ( function_exists( 'get_field' ) && get_field( 'home_tech_kicker' ) ) ? get_field( 'home_tech_kicker' ) : __( 'Stack Tecnológico', 'chanodev' );
$tech_title  = ( function_exists( 'get_field' ) && get_field( 'home_tech_title' ) ) ? get_field( 'home_tech_title' ) : __( 'Tecnologías y herramientas dominadas en producción', 'chanodev' );
$tech_badges = function_exists( 'get_field' ) ? get_field( 'home_tech_badges' ) : null;
if ( empty( $tech_badges ) ) {
	$tech_badges = array( 'WordPress Custom', 'WooCommerce', 'PHP 8+', 'React.js', 'Next.js', 'Node.js', 'REST API', 'MySQL', 'Vanilla ES6+', 'CSS Grid / WAAPI', 'Git & CI/CD', 'TypeScript', 'Docker', 'Redis Cache', 'Schema JSON-LD' );
} elseif ( is_string( $tech_badges ) ) {
	$tech_badges = array_map( 'trim', explode( ',', $tech_badges ) );
}

$tech_categories = function_exists( 'get_field' ) ? get_field( 'home_tech_categories' ) : null;
if ( empty( $tech_categories ) ) {
	$tech_categories = array(
		array(
			'cat_num'   => '01',
			'cat_name'  => __( 'WordPress & Backend PHP', 'chanodev' ),
			'cat_badge' => __( 'Especialidad Core', 'chanodev' ),
			'cat_desc'  => __( 'Desarrollo artesanal a medida sin constructores pesados ni deuda técnica.', 'chanodev' ),
			'cat_icon'  => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m16 18 6-6-6-6"/><path d="m8 6-6 6 6 6"/></svg>',
			'skills'    => array(
				array( 'name' => 'WordPress Custom', 'level' => 'Avanzado', 'status' => '9+ Años' ),
				array( 'name' => 'PHP 8+ Backend', 'level' => 'Nativo OOP', 'status' => 'Strict Types' ),
				array( 'name' => 'Gutenberg & FSE', 'level' => 'Custom Blocks', 'status' => 'React / JSX' ),
				array( 'name' => 'REST API & Webhooks', 'level' => 'Integración', 'status' => 'JSON / Auth' ),
				array( 'name' => 'WooCommerce API', 'level' => 'E-Commerce', 'status' => 'High-Traffic' ),
				array( 'name' => 'MySQL / Database', 'level' => 'Optimización', 'status' => 'Indexed' ),
			),
		),
		array(
			'cat_num'   => '02',
			'cat_name'  => __( 'Modern Frontend & React', 'chanodev' ),
			'cat_badge' => __( 'Interfaces Reactivas', 'chanodev' ),
			'cat_desc'  => __( 'UIs interactivas, animaciones de alto rendimiento a 60fps y componentes modulares.', 'chanodev' ),
			'cat_icon'  => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="12" rx="10" ry="4"/><ellipse cx="12" cy="12" rx="10" ry="4" transform="rotate(60 12 12)"/><ellipse cx="12" cy="12" rx="10" ry="4" transform="rotate(120 12 12)"/></svg>',
			'skills'    => array(
				array( 'name' => 'React.js', 'level' => 'SPA & Hooks', 'status' => 'State Mgmt' ),
				array( 'name' => 'Next.js', 'level' => 'SSR / SSG', 'status' => 'App Router' ),
				array( 'name' => 'Vanilla ES6+ JS', 'level' => 'Zero Bloat', 'status' => 'Nativo' ),
				array( 'name' => 'CSS Grid & Flexbox', 'level' => 'Arquitectura CSS', 'status' => 'Modular' ),
				array( 'name' => 'WAAPI Animations', 'level' => 'Interacciones', 'status' => '60 FPS' ),
				array( 'name' => 'TypeScript', 'level' => 'Tipado Estricto', 'status' => 'Clean Code' ),
			),
		),
		array(
			'cat_num'   => '03',
			'cat_name'  => __( 'WPO, SEO & Estándares', 'chanodev' ),
			'cat_badge' => __( 'Rendimiento Crítico', 'chanodev' ),
			'cat_desc'  => __( 'Optimización de Core Web Vitals, tiempos de carga mínimos y posicionamiento técnico.', 'chanodev' ),
			'cat_icon'  => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 14 4-4"/><path d="M3.34 19a10 10 0 1 1 17.32 0"/><circle cx="12" cy="14" r="1.5"/></svg>',
			'skills'    => array(
				array( 'name' => 'Core Web Vitals', 'level' => 'LCP / INP / CLS', 'status' => '< 1.2s' ),
				array( 'name' => 'Google PageSpeed', 'level' => 'Móvil / Desktop', 'status' => '95+' ),
				array( 'name' => 'Schema JSON-LD', 'level' => 'Rich Snippets', 'status' => 'SEO Técnico' ),
				array( 'name' => 'Accesibilidad WCAG', 'level' => 'Estándar AA', 'status' => 'Semántica' ),
				array( 'name' => 'Redis Object Cache', 'level' => 'Memoria Caché', 'status' => 'Ultra Rápido' ),
				array( 'name' => 'Asset Optimization', 'level' => 'WebP / Critical', 'status' => 'Minificado' ),
			),
		),
		array(
			'cat_num'   => '04',
			'cat_name'  => __( 'DevOps, Node.js & Tooling', 'chanodev' ),
			'cat_badge' => __( 'Infraestructura Sólida', 'chanodev' ),
			'cat_desc'  => __( 'Entornos de despliegue continuo, control de versiones y servidores Linux de alta velocidad.', 'chanodev' ),
			'cat_icon'  => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="8" x="2" y="2" rx="2" ry="2"/><rect width="20" height="8" x="2" y="14" rx="2" ry="2"/><line x1="6" x2="6.01" y1="6" y2="6"/><line x1="6" x2="6.01" y1="18" y2="18"/></svg>',
			'skills'    => array(
				array( 'name' => 'Node.js & Express', 'level' => 'Backend Services', 'status' => 'Async I/O' ),
				array( 'name' => 'Git & GitHub Actions', 'level' => 'CI/CD Pipeline', 'status' => 'Automated' ),
				array( 'name' => 'Vite & Webpack', 'level' => 'Bundling', 'status' => 'HMR' ),
				array( 'name' => 'Linux / Nginx / Apache', 'level' => 'Servidores Web', 'status' => 'HTTP/3' ),
				array( 'name' => 'Docker Containers', 'level' => 'Contenedores', 'status' => 'DevOps' ),
				array( 'name' => 'Postman / REST Tools', 'level' => 'Testing de APIs', 'status' => '200 OK' ),
			),
		),
	);
}

// ==========================================
// 6. TESTIMONIALS ACF FIELDS & FALLBACKS
// ==========================================
$testimonies_kicker = ( function_exists( 'get_field' ) && get_field( 'home_testimonies_kicker' ) ) ? get_field( 'home_testimonies_kicker' ) : __( 'Testimonios', 'chanodev' );
$testimonies_title  = ( function_exists( 'get_field' ) && get_field( 'home_testimonies_title' ) ) ? get_field( 'home_testimonies_title' ) : __( 'Lo que dicen quienes han trabajado conmigo', 'chanodev' );
$testimonies_desc   = ( function_exists( 'get_field' ) && get_field( 'home_testimonies_description' ) ) ? get_field( 'home_testimonies_description' ) : __( 'Clientes y empresas que confiaron en un desarrollo web profesional, puntual y sin complicaciones.', 'chanodev' );

$home_testimonials = function_exists( 'get_field' ) ? get_field( 'home_testimonials_items' ) : null;
if ( empty( $home_testimonials ) ) {
	$home_testimonials = array(
		array(
			'initials' => 'AR',
			'gradient' => 'linear-gradient(135deg, #0284c7, #38bdf8)',
			'author'   => 'Alejandro Rivas',
			'role'     => __( 'Fundador de Startup', 'chanodev' ),
			'text'     => __( 'Teníamos una web lenta y llena de errores que nos hacía perder clientes. Chano la rehizo por completo: ahora carga al instante, se ve impecable en celulares y las ventas empezaron a subir desde la primera semana.', 'chanodev' ),
		),
		array(
			'initials' => 'SM',
			'gradient' => 'linear-gradient(135deg, #8b5cf6, #ec4899)',
			'author'   => 'Sofía Morales',
			'role'     => __( 'Directora de Tienda Online', 'chanodev' ),
			'text'     => __( 'Lo mejor de trabajar con Chano es la tranquilidad. Entendió exactamente lo que necesitábamos, cumplió cada fecha de entrega y nos dejó un sitio súper fácil de administrar para todo el equipo.', 'chanodev' ),
		),
		array(
			'initials' => 'CV',
			'gradient' => 'linear-gradient(135deg, #10b981, #0284c7)',
			'author'   => 'Carlos Varela',
			'role'     => __( 'Gerente de Marketing', 'chanodev' ),
			'text'     => __( 'Antes dependíamos de una agencia que tardaba semanas en responder cualquier cambio. Con Chano el trato es directo, rápido y transparente. En pocos días solucionó problemas que llevaban meses estancados.', 'chanodev' ),
		),
		array(
			'initials' => 'DT',
			'gradient' => 'linear-gradient(135deg, #f59e0b, #ef4444)',
			'author'   => 'Daniela Torres',
			'role'     => __( 'Directora de Agencia', 'chanodev' ),
			'text'     => __( 'Es muy difícil encontrar a un profesional con tanta seriedad y buen gusto. Le confío los proyectos más importantes de nuestros clientes porque sé que el resultado siempre supera las expectativas.', 'chanodev' ),
		),
		array(
			'initials' => 'MS',
			'gradient' => 'linear-gradient(135deg, #6366f1, #a855f7)',
			'author'   => 'Mariano de Silva',
			'role'     => __( 'CEO & Co-Founder', 'chanodev' ),
			'text'     => __( 'No solo entrega un trabajo impecable, sino que se involucra y te propone ideas que realmente tienen sentido para el negocio. Nos ahorró muchísimo tiempo y dolores de cabeza en el lanzamiento.', 'chanodev' ),
		),
		array(
			'initials' => 'GE',
			'gradient' => 'linear-gradient(135deg, #14b8a6, #059669)',
			'author'   => 'Gabriela Esparza',
			'role'     => __( 'Consultora de Negocios', 'chanodev' ),
			'text'     => __( 'Buscábamos a alguien que no nos hablara con tecnicismos difíciles y que simplemente hiciera que la web funcionara rápido y bien. Chano logró en dos semanas lo que otros no pudieron en meses.', 'chanodev' ),
		),
		array(
			'initials' => 'RL',
			'gradient' => 'linear-gradient(135deg, #3b82f6, #6366f1)',
			'author'   => 'Roberto Luján',
			'role'     => __( 'Director Comercial', 'chanodev' ),
			'text'     => __( 'Desde que lanzamos el nuevo sitio web, las solicitudes de contacto y presupuestos aumentaron notablemente. Es súper puntual, honesto y siempre está disponible cuando lo necesitas.', 'chanodev' ),
		),
	);
}

// ==========================================
// 7. CTA BANNER ACF FIELDS & FALLBACKS
// ==========================================
$cta_kicker          = ( function_exists( 'get_field' ) && get_field( 'home_cta_kicker' ) ) ? get_field( 'home_cta_kicker' ) : __( 'Siguiente Paso', 'chanodev' );
$cta_title           = ( function_exists( 'get_field' ) && get_field( 'home_cta_title' ) ) ? get_field( 'home_cta_title' ) : __( '¿Comenzamos tu próximo proyecto digital?', 'chanodev' );
$cta_desc            = ( function_exists( 'get_field' ) && get_field( 'home_cta_description' ) ) ? get_field( 'home_cta_description' ) : __( 'Agenda una consulta técnica directa para evaluar tus requerimientos y diseñar la mejor solución.', 'chanodev' );
$cta_btn_txt         = ( function_exists( 'get_field' ) && get_field( 'home_cta_btn_text' ) ) ? get_field( 'home_cta_btn_text' ) : __( 'Contactar y Cotizar', 'chanodev' );
$cta_btn_url         = ( function_exists( 'get_field' ) && get_field( 'home_cta_btn_url' ) ) ? get_field( 'home_cta_btn_url' ) : home_url( '/contacto/' );
$cta_reassurance_txt = ( function_exists( 'get_field' ) && get_field( 'home_cta_reassurance_text' ) ) ? get_field( 'home_cta_reassurance_text' ) : __( 'Respuesta en menos de 24h · Trato directo', 'chanodev' );
