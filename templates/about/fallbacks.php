<?php
/**
 * About Page ACF Fields and Fallbacks
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ==========================================
// 1. HERO SECTION & PROFILE TERMINAL ACF FIELDS
// ==========================================
$about_kicker       = ( function_exists( 'get_field' ) && get_field( 'about_hero_kicker' ) ) ? get_field( 'about_hero_kicker' ) : __( 'Ingeniero de Software · Full-Stack Web', 'chanodev' );
$about_title        = ( function_exists( 'get_field' ) && get_field( 'about_hero_title' ) ) ? get_field( 'about_hero_title' ) : __( 'Código limpio, criterio técnico y resultados medibles.', 'chanodev' );
$about_lead         = ( function_exists( 'get_field' ) && get_field( 'about_hero_description' ) ) ? get_field( 'about_hero_description' ) : __( 'Soy Chano Vera, desarrollador web full-stack con más de 9 años creando plataformas a medida. Me enfoco en rendimiento crítico, arquitectura escalable y soluciones que generan impacto real en el negocio sin dependencia de plantillas genéricas.', 'chanodev' );
$primary_btn_txt    = ( function_exists( 'get_field' ) && get_field( 'about_hero_primary_btn_text' ) ) ? get_field( 'about_hero_primary_btn_text' ) : __( 'Ver casos de estudio', 'chanodev' );
$primary_btn_url    = ( function_exists( 'get_field' ) && get_field( 'about_hero_primary_btn_url' ) ) ? get_field( 'about_hero_primary_btn_url' ) : home_url( '/proyectos/' );
$secondary_btn_txt  = ( function_exists( 'get_field' ) && get_field( 'about_hero_secondary_btn_text' ) ) ? get_field( 'about_hero_secondary_btn_text' ) : __( 'Hablemos de tu proyecto', 'chanodev' );
$secondary_btn_url  = ( function_exists( 'get_field' ) && get_field( 'about_hero_secondary_btn_url' ) ) ? get_field( 'about_hero_secondary_btn_url' ) : home_url( '/contacto/' );
$trust_badge_txt    = ( function_exists( 'get_field' ) && get_field( 'about_hero_trust_text' ) ) ? get_field( 'about_hero_trust_text' ) : __( 'Disponible para proyectos a medida y consultoría técnica', 'chanodev' );

// Terminal Window Profile Fields
$profile_file_title = ( function_exists( 'get_field' ) && get_field( 'about_profile_file_title' ) ) ? get_field( 'about_profile_file_title' ) : 'chano.dev / profile.json';
$profile_badge_live = ( function_exists( 'get_field' ) && get_field( 'about_profile_badge_live' ) ) ? get_field( 'about_profile_badge_live' ) : __( 'Live', 'chanodev' );
$profile_initials   = ( function_exists( 'get_field' ) && get_field( 'about_profile_initials' ) ) ? get_field( 'about_profile_initials' ) : 'CV';
$profile_avatar_img = ( function_exists( 'get_field' ) && get_field( 'about_profile_avatar_image' ) ) ? get_field( 'about_profile_avatar_image' ) : '';
$profile_name       = ( function_exists( 'get_field' ) && get_field( 'about_profile_name' ) ) ? get_field( 'about_profile_name' ) : 'Chano Vera';
$profile_role       = ( function_exists( 'get_field' ) && get_field( 'about_profile_role' ) ) ? get_field( 'about_profile_role' ) : __( 'Senior Full-Stack Engineer', 'chanodev' );
$profile_location   = ( function_exists( 'get_field' ) && get_field( 'about_profile_location' ) ) ? get_field( 'about_profile_location' ) : __( 'Remoto · Global', 'chanodev' );
$profile_focus_arr  = function_exists( 'get_field' ) ? get_field( 'about_profile_focus_tags' ) : null;
if ( empty( $profile_focus_arr ) ) {
	$profile_focus_arr = array( 'WordPress', 'React', 'Node.js' );
} elseif ( is_string( $profile_focus_arr ) ) {
	$profile_focus_arr = array_map( 'trim', explode( ',', $profile_focus_arr ) );
}
$profile_metric_cwv = ( function_exists( 'get_field' ) && ( false !== get_field( 'about_profile_metric_cwv' ) && '' !== get_field( 'about_profile_metric_cwv' ) ) ) ? get_field( 'about_profile_metric_cwv' ) : '100';
$profile_metric_lcp = ( function_exists( 'get_field' ) && get_field( 'about_profile_metric_lcp' ) ) ? get_field( 'about_profile_metric_lcp' ) : '< 1.2s';
$profile_metric_cls = ( function_exists( 'get_field' ) && ( false !== get_field( 'about_profile_metric_cls' ) && '' !== get_field( 'about_profile_metric_cls' ) ) ) ? get_field( 'about_profile_metric_cls' ) : '0';
$profile_standard   = ( function_exists( 'get_field' ) && get_field( 'about_profile_standard_text' ) ) ? get_field( 'about_profile_standard_text' ) : '100% custom & zero bloatware';
$profile_github_url = ( function_exists( 'get_field' ) && get_field( 'about_profile_github_url' ) ) ? get_field( 'about_profile_github_url' ) : 'https://github.com/chanovera-dev';
$profile_github_txt = ( function_exists( 'get_field' ) && get_field( 'about_profile_github_text' ) ) ? get_field( 'about_profile_github_text' ) : 'GitHub @chanovera-dev';
$profile_verified   = ( function_exists( 'get_field' ) && get_field( 'about_profile_verified_text' ) ) ? get_field( 'about_profile_verified_text' ) : __( 'Verificado', 'chanodev' );

// ==========================================
// 2. METRICS SECTION ACF FIELDS & FALLBACKS
// ==========================================
$metrics_kicker = ( function_exists( 'get_field' ) && get_field( 'about_metrics_kicker' ) ) ? get_field( 'about_metrics_kicker' ) : __( 'Impacto & Estándares', 'chanodev' );
$metrics_title  = ( function_exists( 'get_field' ) && get_field( 'about_metrics_title' ) ) ? get_field( 'about_metrics_title' ) : __( 'Métricas y Compromiso Técnico', 'chanodev' );
$metrics_desc   = ( function_exists( 'get_field' ) && get_field( 'about_metrics_description' ) ) ? get_field( 'about_metrics_description' ) : __( 'Criterios técnicos y metodológicos que garantizan velocidad, solidez y resultados en cada desarrollo.', 'chanodev' );

$about_metrics = function_exists( 'get_field' ) ? get_field( 'about_metrics_slides' ) : null;
if ( empty( $about_metrics ) ) {
	$about_metrics = array(
		array(
			'number'     => '01',
			'value'      => '100%',
			'label'      => __( 'Código a Medida', 'chanodev' ),
			'kicker'     => __( 'Arquitectura Limpia', 'chanodev' ),
			'desc'       => __( 'Desarrollo artesanal y optimizado desde cero, sin constructores visuales pesados ni dependencias superfluas. Cada línea de código tiene un propósito claro, documentado y fácil de mantener.', 'chanodev' ),
			'image'      => CHANODEV_URI . '/assets/images/metric-1-custom-code.jpg',
			'highlights' => array(
				__( 'Temas FSE y bloques Gutenberg personalizados', 'chanodev' ),
				__( 'Plugins a medida sin sobrecarga de librerías', 'chanodev' ),
				__( 'Control total y cero deuda técnica para tu negocio', 'chanodev' ),
			),
		),
		array(
			'number'     => '02',
			'value'      => '< 1.2s',
			'label'      => __( 'Velocidad & Core Web Vitals', 'chanodev' ),
			'kicker'     => __( 'Rendimiento Crítico', 'chanodev' ),
			'desc'       => __( 'El rendimiento web no es un extra: determina la tasa de rebote, la conversión y el posicionamiento en Google. El sitio se concibe desde el primer día para cargar de forma instantánea.', 'chanodev' ),
			'image'      => CHANODEV_URI . '/assets/images/metric-2-speed.jpg',
			'highlights' => array(
				__( 'Puntuaciones PageSpeed 95+ en móvil y escritorio', 'chanodev' ),
				__( 'LCP menor a 1.2s y cero Cumulative Layout Shift (CLS)', 'chanodev' ),
				__( 'Optimización de assets, caché avanzada y aceleración GPU', 'chanodev' ),
			),
		),
		array(
			'number'     => '03',
			'value'      => '9+',
			'label'      => __( 'Años de Experiencia Técnica', 'chanodev' ),
			'kicker'     => __( 'Trayectoria Probada', 'chanodev' ),
			'desc'       => __( 'Más de una década transformando requerimientos complejos en plataformas web estables, seguras y escalables con WordPress, React, Node.js y arquitecturas modernas.', 'chanodev' ),
			'image'      => CHANODEV_URI . '/assets/images/metric-3-experience.jpg',
			'highlights' => array(
				__( 'Experiencia en comercio electrónico y plataformas de alto tráfico', 'chanodev' ),
				__( 'Integración de pasarelas de pago, APIs REST y Webhooks', 'chanodev' ),
				__( 'Criterio de ingeniería de software y visión de producto', 'chanodev' ),
			),
		),
		array(
			'number'     => '04',
			'value'      => '1:1',
			'label'      => __( 'Comunicación Directa', 'chanodev' ),
			'kicker'     => __( 'Sin Intermediarios', 'chanodev' ),
			'desc'       => __( 'Trabajas y tomas decisiones directamente con el ingeniero que programa tu sitio web. Sin capas de comerciales, sin pérdida de contexto y con entregas transparentes.', 'chanodev' ),
			'image'      => CHANODEV_URI . '/assets/images/metric-4-collaboration.jpg',
			'highlights' => array(
				__( 'Respuestas y asesoría técnica en menos de 24 horas', 'chanodev' ),
				__( 'Entregables documentados y sesiones de entrega guiadas', 'chanodev' ),
				__( 'Acompañamiento técnico y soporte continuo post-lanzamiento', 'chanodev' ),
			),
		),
	);
}

// ==========================================
// 3. SKILLS / TECH STACK ACF FIELDS & FALLBACKS
// ==========================================
$skills_kicker = ( function_exists( 'get_field' ) && get_field( 'about_skills_kicker' ) ) ? get_field( 'about_skills_kicker' ) : __( 'Competencias y Tecnologías', 'chanodev' );
$skills_title  = ( function_exists( 'get_field' ) && get_field( 'about_skills_title' ) ) ? get_field( 'about_skills_title' ) : __( 'Stack Tecnológico & Especialización', 'chanodev' );
$skills_desc   = ( function_exists( 'get_field' ) && get_field( 'about_skills_description' ) ) ? get_field( 'about_skills_description' ) : __( 'Herramientas y lenguajes aplicados con criterio de ingeniería para construir soluciones robustas, rápidas y sostenibles.', 'chanodev' );

$skill_cards = function_exists( 'get_field' ) ? get_field( 'about_skills_cards' ) : null;
if ( empty( $skill_cards ) ) {
	$skill_cards = array(
		array(
			'icon'        => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m16 18 6-6-6-6"/><path d="m8 6-6 6 6 6"/></svg>',
			'badge'       => 'Core Specialist',
			'title'       => __( 'WordPress & Backend PHP', 'chanodev' ),
			'description' => __( 'Desarrollo de temas y plugins a medida desde cero. Integración con REST API, WP-CLI, bloques Gutenberg personalizados y bases de datos MySQL optimizadas.', 'chanodev' ),
			'tags'        => array( 'WordPress Custom', 'WooCommerce', 'PHP 8+', 'REST API', 'FSE & Blocks', 'MySQL' ),
		),
		array(
			'icon'        => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="12" rx="10" ry="4"/><ellipse cx="12" cy="12" rx="10" ry="4" transform="rotate(60 12 12)"/><ellipse cx="12" cy="12" rx="10" ry="4" transform="rotate(120 12 12)"/></svg>',
			'badge'       => 'Modern Frontend',
			'title'       => __( 'React & JavaScript Moderno', 'chanodev' ),
			'description' => __( 'Interfaces dinámicas, interactivas y altamente reactivas. Arquitectura modular de componentes, gestión de estado y Single Page Applications con Next.js y Vanilla ES6+.', 'chanodev' ),
			'tags'        => array( 'React.js', 'Next.js', 'Vanilla ES6+', 'HTML5 Semántico', 'CSS Grid / Flex', 'WAAPI' ),
		),
		array(
			'icon'        => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2 2 7l10 5 10-5-10-5Z"/><path d="m2 17 10 5 10-5"/><path d="m2 12 10 5 10-5"/></svg>',
			'badge'       => 'Scalable Services',
			'title'       => __( 'Node.js & Arquitectura de APIs', 'chanodev' ),
			'description' => __( 'Construcción de microservicios, APIs RESTful con Node.js y Express, pasarelas de pago (Stripe, PayPal), webhooks automatizados y autenticación segura con JWT.', 'chanodev' ),
			'tags'        => array( 'Node.js', 'Express', 'REST & GraphQL', 'JWT Auth', 'Stripe / PayPal', 'Webhooks' ),
		),
		array(
			'icon'        => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"/></svg>',
			'badge'       => 'Speed & SEO',
			'title'       => __( 'Web Performance & SEO Técnico', 'chanodev' ),
			'description' => __( 'Optimización exhaustiva de Core Web Vitals (LCP, INP, CLS), Schema.org estructurado para Rich Snippets, accesibilidad WCAG AAA y tiempos de carga inferiores a 1.2s.', 'chanodev' ),
			'tags'        => array( 'Core Web Vitals', 'Schema.org JSON-LD', 'WPO & Caching', 'Accesibilidad (a11y)', 'LCP < 1.2s' ),
		),
	);
}

// ==========================================
// 4. TIMELINE / JOURNEY ACF FIELDS & FALLBACKS
// ==========================================
$timeline_kicker = ( function_exists( 'get_field' ) && get_field( 'about_timeline_kicker' ) ) ? get_field( 'about_timeline_kicker' ) : __( 'Trayectoria & Experiencia', 'chanodev' );
$timeline_title  = ( function_exists( 'get_field' ) && get_field( 'about_timeline_title' ) ) ? get_field( 'about_timeline_title' ) : __( 'Un camino de especialización continua.', 'chanodev' );
$timeline_desc   = ( function_exists( 'get_field' ) && get_field( 'about_timeline_description' ) ) ? get_field( 'about_timeline_description' ) : __( 'Cada etapa ha fortalecido mi criterio de producto y mi capacidad técnica para resolver problemas complejos.', 'chanodev' );

$timeline_milestones = function_exists( 'get_field' ) ? get_field( 'about_timeline_milestones' ) : null;
if ( empty( $timeline_milestones ) ) {
	$timeline_milestones = array(
		array(
			'period' => '2017 – 2019',
			'title'  => __( 'Fundamentos del Desarrollo Web', 'chanodev' ),
			'text'   => __( 'Formación en desarrollo web, arquitectura de software, bases de datos relacionales y primeros proyectos con PHP, JavaScript y estándares web.', 'chanodev' ),
			'tag'    => 'Foundations',
		),
		array(
			'period' => '2019 – 2022',
			'title'  => __( 'Especialización en WordPress & E-Commerce', 'chanodev' ),
			'text'   => __( 'Desarrollo de tiendas online WooCommerce de alto tráfico, pasarelas de pago y temas a medida para marcas en crecimiento y agencias digitales.', 'chanodev' ),
			'tag'    => 'E-Commerce & WP',
		),
		array(
			'period' => '2022 – 2024',
			'title'  => __( 'Consultoría Senior & Rendimiento Web Crítico', 'chanodev' ),
			'text'   => __( 'Desarrollo independiente de alto nivel: plataformas a medida, optimización extrema de Core Web Vitals, SEO técnico avanzado y relación 1:1 con empresas.', 'chanodev' ),
			'tag'    => 'Senior Engineering',
		),
		array(
			'period' => '2024 – Actualidad',
			'title'  => __( 'Expansión Full-Stack & APIs Modernas', 'chanodev' ),
			'text'   => __( 'Construcción de aplicaciones web interactivas con React, Next.js, servicios backend con Node.js y arquitecturas desacopladas (Headless CMS).', 'chanodev' ),
			'tag'    => 'Full-Stack & React',
		),
	);
}

// ==========================================
// 5. PHILOSOPHY SECTION ACF FIELDS & FALLBACKS
// ==========================================
$philosophy_kicker = ( function_exists( 'get_field' ) && get_field( 'about_philosophy_kicker' ) ) ? get_field( 'about_philosophy_kicker' ) : __( 'Filosofía de Trabajo', 'chanodev' );
$philosophy_title  = ( function_exists( 'get_field' ) && get_field( 'about_philosophy_title' ) ) ? get_field( 'about_philosophy_title' ) : __( 'Criterio técnico antes que atajos.', 'chanodev' );
$philosophy_desc   = ( function_exists( 'get_field' ) && get_field( 'about_philosophy_description' ) ) ? get_field( 'about_philosophy_description' ) : __( 'Principios que guían cada línea de código, cada arquitectura y cada decisión técnica.', 'chanodev' );

$philosophy_items = function_exists( 'get_field' ) ? get_field( 'about_philosophy_items' ) : null;
if ( empty( $philosophy_items ) ) {
	$philosophy_items = array(
		array(
			'number' => '01',
			'tag'    => __( 'Pureza & Eficiencia', 'chanodev' ),
			'title'  => __( 'Zero Bloatware', 'chanodev' ),
			'text'   => __( 'Código limpio, semántico y ligero. Desarrollo a medida sin constructores pesados ni plugins innecesarios que ralenticen la web o generen vulnerabilidades de seguridad.', 'chanodev' ),
			'points' => array(
				__( 'Arquitectura nativa en PHP 8+ y Vanilla JavaScript ES6+', 'chanodev' ),
				__( 'Cero dependencia de page builders pesados y plugins superfluos', 'chanodev' ),
				__( 'Optimización exhaustiva del árbol DOM y depuración de assets no utilizados', 'chanodev' ),
			),
			'quote'  => __( 'La simplicidad estructural es la máxima expresión de sofisticación técnica.', 'chanodev' ),
			'icon'   => '<svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>',
		),
		array(
			'number' => '02',
			'tag'    => __( 'Rendimiento Extremo', 'chanodev' ),
			'title'  => __( 'Velocidad como Estándar', 'chanodev' ),
			'text'   => __( 'Un sitio web ultra rápido no es un añadido estético: maximiza la tasa de conversión, fideliza a los usuarios y asegura un posicionamiento preferente en Google.', 'chanodev' ),
			'points' => array(
				__( 'Tiempos de carga LCP inferiores a 1.2 segundos y 100/100 en Google PageSpeed', 'chanodev' ),
				__( 'Optimización integral de Core Web Vitals (LCP, INP, CLS)', 'chanodev' ),
				__( 'Imágenes en formatos modernos de última generación (AVIF / WebP) y carga diferida inteligente', 'chanodev' ),
			),
			'quote'  => __( 'Cada 100ms de latencia resta conversiones; la velocidad genera autoridad inmediata.', 'chanodev' ),
			'icon'   => '<svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>',
		),
		array(
			'number' => '03',
			'tag'    => __( 'Arquitectura Sólida', 'chanodev' ),
			'title'  => __( 'Mantenibilidad & Escalabilidad', 'chanodev' ),
			'text'   => __( 'Estructura modular, código limpio y estándares estrictos para que cualquier proyecto evolucione con facilidad sin generar deuda técnica ni ataduras.', 'chanodev' ),
			'points' => array(
				__( 'Patrones de desarrollo limpios y desacoplamiento de componentes', 'chanodev' ),
				__( 'Código documentado conforme a los estándares de WordPress VIP y PHP CS', 'chanodev' ),
				__( 'Control de versiones con Git y flujos de despliegue automatizados y seguros', 'chanodev' ),
			),
			'quote'  => __( 'Desarrollar pensando en el futuro ahorra incontables horas de refactorización.', 'chanodev' ),
			'icon'   => '<svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83Z"/><path d="m22 17.65-9.17 4.16a2 2 0 0 1-1.66 0L2 17.65"/><path d="m22 12.65-9.17 4.16a2 2 0 0 1-1.66 0L2 12.65"/></svg>',
		),
		array(
			'number' => '04',
			'tag'    => __( 'Cercanía & Claridad', 'chanodev' ),
			'title'  => __( 'Comunicación Directa 1:1', 'chanodev' ),
			'text'   => __( 'Trato directo y sin intermediarios con quien programa la solución. Transparencia técnica total, feedback ágil y decisiones fundamentadas en valor de negocio.', 'chanodev' ),
			'points' => array(
				__( 'Contacto directo con el desarrollador responsable del proyecto', 'chanodev' ),
				__( 'Entregas iterativas con demostraciones funcionales periódicas', 'chanodev' ),
				__( 'Asesoramiento honesto orientado al retorno de inversión y la viabilidad técnica', 'chanodev' ),
			),
			'quote'  => __( 'Sin capas intermedias: máxima agilidad, claridad absoluta y resultados precisos.', 'chanodev' ),
			'icon'   => '<svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>',
		),
	);
}

// ==========================================
// 6. CTA BLOCK ACF FIELDS & FALLBACKS
// ==========================================
$cta_kicker          = ( function_exists( 'get_field' ) && get_field( 'about_cta_kicker' ) ) ? get_field( 'about_cta_kicker' ) : __( 'Siguiente Paso', 'chanodev' );
$cta_title           = ( function_exists( 'get_field' ) && get_field( 'about_cta_title' ) ) ? get_field( 'about_cta_title' ) : __( '¿Hablamos sobre tu próximo proyecto?', 'chanodev' );
$cta_desc            = ( function_exists( 'get_field' ) && get_field( 'about_cta_description' ) ) ? get_field( 'about_cta_description' ) : __( 'Cuéntame tus objetivos o el desafío técnico que necesitas resolver y tracemos el camino más sensato.', 'chanodev' );
$cta_btn_txt         = ( function_exists( 'get_field' ) && get_field( 'about_cta_btn_text' ) ) ? get_field( 'about_cta_btn_text' ) : __( 'Iniciar una conversación', 'chanodev' );
$cta_btn_url         = ( function_exists( 'get_field' ) && get_field( 'about_cta_btn_url' ) ) ? get_field( 'about_cta_btn_url' ) : home_url( '/contacto/' );
$cta_reassurance_txt = ( function_exists( 'get_field' ) && get_field( 'about_cta_reassurance_text' ) ) ? get_field( 'about_cta_reassurance_text' ) : __( 'Respuesta en menos de 24h · Trato directo', 'chanodev' );
