    <footer id="main-footer" class="block">     
        <?php
            $menu_id = get_nav_menu_locations()[ 'footer' ];
            $items = wp_get_nav_menu_items( $menu_id );
            if ( ! empty( $items ) ) {

                echo '<div class="content top">';
                wp_nav_menu(
                    array(
                        'container' => 'nav',
                        'container_id' => 'footer-nav', 
                        'theme_location' => 'footer',
                    ) 
                );
                echo '</div>';
            }
        ?>
        <div class="content bottom">
            <p>
                &copy; <?php bloginfo( 'name' ); ?> <?php echo date('Y'); ?> • 
                <?= esc_html__( 'All Rights Reserved', 'chanodev' ); ?>
            </p>
        </div>
    </footer>
    <?php wp_footer(); ?>
</body>
</html>