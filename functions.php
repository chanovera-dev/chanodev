<?php
/**
 * ChanoDEV Theme Engine Loader
 *
 * Loads and initializes all core components required by the chanodev theme,
 * including widgets, template helpers and customizer options.
 *
 * @package chanodev
 * @since 1.0.0
 */

 // Get theme version
$theme = wp_get_theme( 'chanodev' );
$chanodev_version = $theme instanceof WP_Theme ? $theme->get( 'Version' ) : '1.0.0';

// Define base include path
$inc_dir = get_template_directory() . '/inc';

// Initialize theme object
$chanodev = (object) [
    'version' => $chanodev_version,
];

// Core files to include
$core_files = [
    'core' => $inc_dir . '/core.php',
];

// Include each file if it exists
foreach ( $core_files as $key => $file_path ) {
    if ( file_exists( $file_path ) ) {
        $chanodev->{$key} = require_once $file_path;
    } else {
        error_log( "Missing required file: $file_path" );
    }
}