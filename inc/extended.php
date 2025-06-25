<?php
/**
 * 
 */

/**
 * Remove someone class of wp blocks
 */
function remove_wp_block_classes_on_specific_pages($block_content, $block) {
    if (!is_page(['home', 7])) {
        return $block_content;
    }

    if (!empty($block_content) && preg_match('/class="([^"]+)"/', $block_content, $matches)) {
        $classes = explode(' ', $matches[1]);

        $filtered_classes = array_filter($classes, function($class) {
            return strpos($class, 'wp-block-') === false &&
                   $class !== 'is-layout-constrained' &&
                   $class !== 'has-global-padding';
        });

        if (!empty($filtered_classes)) {
            $new_class_attribute = 'class="' . implode(' ', $filtered_classes) . '"';
            $block_content = str_replace($matches[0], $new_class_attribute, $block_content);
        } else {
            $block_content = str_replace($matches[0], '', $block_content);
        }
    }

    return $block_content;
}

add_filter('render_block', 'remove_wp_block_classes_on_specific_pages', 10, 2);

/**
 * Before icons
 */
function attachments_icons() {
    ?>
        <style>          
            a[href*="tel"]:before {mask-image: url('<?= get_stylesheet_directory_uri(); ?>/assets/icons/tel.svg');}
            
            :is(#contact,.contact) .menu li a[href*="schedule"]:before {mask-image: url('<?= get_stylesheet_directory_uri(); ?>/assets/icons/schedule.svg');}
            :is(#contact,.contact) .menu li a[href*="address"]:before {mask-image: url('<?= get_stylesheet_directory_uri(); ?>/assets/icons/address.svg');}
        
            .social .menu li a[href*="facebook"]:before {mask-image: url('<?= get_stylesheet_directory_uri(); ?>/assets/icons/facebook.svg');}
            .social .menu li a[href*="twitter"]:before {mask-image: url('<?= get_stylesheet_directory_uri(); ?>/assets/icons/twitter.svg');}
            .social .menu li a[href*="x.com"]:before {mask-image: url('<?= get_stylesheet_directory_uri(); ?>/assets/icons/twitter.svg');}
            .social .menu li a[href*="instagram"]:before {mask-image: url('<?= get_stylesheet_directory_uri(); ?>/assets/icons/instagram.svg');}
            .social .menu li a[href*="threads"]:before {mask-image: url('<?= get_stylesheet_directory_uri(); ?>/assets/icons/threads.svg');}
            .social .menu li a[href*="youtube"]:before {mask-image: url('<?= get_stylesheet_directory_uri(); ?>/assets/icons/youtube.svg');}
            .social .menu li a[href*="telegram"]:before {mask-image: url('<?= get_stylesheet_directory_uri(); ?>/assets/icons/telegram.svg');}

            /* contact list */
            .whatsapp-button:has(a[href*="api.whatsapp"]):before,
            #contact .content .is-layout-flex ul li a[href*="api.whatsapp"]:before {mask-image: url('<?= get_stylesheet_directory_uri(); ?>/assets/icons/whatsapp.svg');}
            #contact .content .is-layout-flex ul li a[href*="mailto"]:before {mask-image: url('<?= get_stylesheet_directory_uri(); ?>/assets/icons/mailto.svg');}
            #contact .content .is-layout-flex ul li.address:before {mask-image: url('<?= get_stylesheet_directory_uri(); ?>/assets/icons/address.svg');}
        </style>
    <?php
}
add_action('wp_head', 'attachments_icons');

/**
 * Meta description
 */
function get_dynamic_meta_description() {
    if ( is_singular() ) {
        global $post;

        if ( has_excerpt( $post->ID ) ) {
            return get_the_excerpt( $post->ID );
        }

        $custom_meta = get_post_meta( $post->ID, 'meta_description', true );
        if ( $custom_meta ) {
            return $custom_meta;
        }
    }

    return get_bloginfo( 'description' );
}

/**
 * Support for svg files
 */
function mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'mime_types' );

/**
 * Shortcode for skills on frontpage
 */
function mostrar_skills_repeater_shortcode() {
    ob_start();
    global $post;
    if ( have_rows( 'skills_repeater', $post->ID ) ) :
        while ( have_rows( 'skills_repeater', $post->ID ) ) : the_row();
            $class = get_sub_field( 'skill_class' );
            echo '<div class="skill-card ' . $class . '">';
            if ( $icon_id = get_sub_field( 'skill_icon' ) ) {
                $icon_path = get_attached_file( $icon_id );
                if ( file_exists( $icon_path ) ) {
                    $svg = trim( file_get_contents( $icon_path ) );
                    echo $svg;
                }
            }
            if ( $text = get_sub_field( 'skill_label' ) ) {
                echo '<p>' . esc_html( $text ) . '</p>';
            }
            echo '</div>';
        endwhile;
    endif;
    return ob_get_clean();
}
add_shortcode( 'skills_list', 'mostrar_skills_repeater_shortcode' );