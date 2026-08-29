<?php
/**
 * Template Name: Sobre Mí / Perfil Profesional (E-E-A-T)
 *
 * @package ChanoDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

require locate_template( 'templates/about/fallbacks.php' );
?>

<main id="main" class="site-main" role="main">

<?php
    $directory = get_stylesheet_directory() . '/templates/about';

    $sections = [
        'hero',
        'metrics',
        'skills',
        'timeline',
        'philosophy',
        'cta'
    ];

    foreach ($sections as $section => $condition) {
        if (is_int($section)) {
            $section = $condition;
            $condition = true;
        }

        if ($condition && file_exists("$directory/$section.php")) {
            include "$directory/$section.php";
        }
    }
?>
</main>

<?php
get_footer();
