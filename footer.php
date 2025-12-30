
    </main><!-- #main -->

    <footer id="colophon" class="site-footer bg-dark text-white pt-5 pb-3">
        <div class="container footer-widgets-container">
            <div class="row">
                <!-- Coluna 1 -->
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <?php if ( is_active_sidebar( 'footer-1' ) ) dynamic_sidebar( 'footer-1' ); ?>
                </div>
                <!-- Coluna 2 -->
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <?php if ( is_active_sidebar( 'footer-2' ) ) dynamic_sidebar( 'footer-2' ); ?>
                </div>
                <!-- Coluna 3 -->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <?php if ( is_active_sidebar( 'footer-3' ) ) dynamic_sidebar( 'footer-3' ); ?>
                </div>
                <!-- Coluna 4 -->
                <div class="col-lg-3 col-md-6">
                    <?php if ( is_active_sidebar( 'footer-4' ) ) dynamic_sidebar( 'footer-4' ); ?>
                </div>
            </div>
        </div>

        <div class="footer-bottom-bar mt-5 pt-3 border-top border-secondary">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                        <span>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('Todos os direitos reservados.', 'small-apps'); ?></span>
                    </div>
                    <div class="col-md-6">
                        <?php
                        wp_nav_menu( array(
                            'theme_location'  => 'footer',
                            'menu_class'      => 'nav justify-content-center justify-content-md-end',
                            'container'       => false,
                            'depth'           => 1,
                            'fallback_cb'     => false,
                            // Adiciona a classe 'nav-link' aos itens do menu
                            'walker'          => new class extends Walker_Nav_Menu {
                                function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
                                    $output .= "<li class='nav-item'><a href='" . esc_url($item->url) . "' class='nav-link px-2 text-white'>" . esc_html($item->title) . "</a></li>";
                                }
                            }
                        ) );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>