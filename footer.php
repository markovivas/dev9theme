    </main><!-- #primary -->

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-column">
                    <div class="footer-logo">
                        <?php if (has_custom_logo()) : ?>
                            <?php the_custom_logo(); ?>
                        <?php else : ?>
                            <h3><?php bloginfo('name'); ?></h3>
                        <?php endif; ?>
                    </div>
                    <p><?php echo esc_html(get_bloginfo('description')); ?></p>
                    <?php
                    // Mapeamento de plataformas para ícones Font Awesome
                    $social_icons = array(
                        'facebook'  => 'fa-brands fa-facebook-f',
                        'instagram' => 'fa-brands fa-instagram',
                        'linkedin'  => 'fa-brands fa-linkedin-in',
                        'twitter'   => 'fa-brands fa-x-twitter',
                        'youtube'   => 'fa-brands fa-youtube',
                        'tiktok'    => 'fa-brands fa-tiktok',
                    );
                    $social_platforms = array_keys($social_icons);
                    $has_social_links = false;
                    foreach ($social_platforms as $platform) {
                        if (get_theme_mod("social_{$platform}")) {
                            $has_social_links = true;
                            break;
                        }
                    }

                    if ($has_social_links) : ?>
                        <div class="social-links">
                            <?php foreach ($social_platforms as $platform) :
                                $url = get_theme_mod("social_{$platform}");
                                if ($url) : ?>
                                    <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr(ucfirst($platform)); ?>">
                                        <i class="<?php echo esc_attr($social_icons[$platform]); ?>" aria-hidden="true"></i>
                                    </a>
                                <?php endif;
                            endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="footer-column">
                    <h3><?php esc_html_e('Serviços', 'techconsult'); ?></h3>
                    <?php if (is_active_sidebar('footer-1')) : ?>
                        <?php dynamic_sidebar('footer-1'); ?>
                    <?php else : ?>
                        <ul>
                            <li><a href="#"><?php esc_html_e('Consultoria em TI', 'techconsult'); ?></a></li>
                            <li><a href="#"><?php esc_html_e('Desenvolvimento Web', 'techconsult'); ?></a></li>
                            <li><a href="#"><?php esc_html_e('Design UI/UX', 'techconsult'); ?></a></li>
                            <li><a href="#"><?php esc_html_e('Segurança Cibernética', 'techconsult'); ?></a></li>
                        </ul>
                    <?php endif; ?>
                </div>

                <div class="footer-column">
                    <h3><?php esc_html_e('Links Rápidos', 'techconsult'); ?></h3>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'menu-rodape',
                        'container'      => false,
                        'fallback_cb'    => 'techconsult_footer_menu_fallback',
                    ));
                    ?>
                </div>

                <div class="footer-column">
                    <h3><?php esc_html_e('Contato', 'techconsult'); ?></h3>
                    <address>
                        <?php
                        $address = get_theme_mod('contact_address');
                        $email = get_theme_mod('contact_email');
                        $phone = get_theme_mod('contact_phone');

                        if ($address) : ?>
                            <p><?php echo nl2br(esc_html($address)); ?></p>
                        <?php endif; ?>
                        
                        <?php if ($email) : ?>
                            <p>Email: <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a><br>
                        <?php endif; ?>
                        <?php if ($phone) : ?>
                            Tel: <?php echo esc_html($phone); ?></p>
                        <?php endif; ?>
                    </address>
                </div>
            </div>

            <div class="copyright">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> - 
                <?php esc_html_e('Todos os direitos reservados.', 'techconsult'); ?></p>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>