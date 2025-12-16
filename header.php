<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#primary">
    <?php esc_html_e('Pular para o conteúdo', 'techconsult'); ?>
</a>

<header id="masthead" class="site-header">
    <div class="container header-container">
        <div class="site-logo">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <h1><?php bloginfo('name'); ?></h1>
                </a>
            <?php endif; ?>
        </div>

        <nav id="site-navigation" class="main-navigation">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                <span class="screen-reader-text"><?php esc_html_e('Menu Principal', 'techconsult'); ?></span>
                <span class="hamburger"></span>
            </button>
            
            <?php
            wp_nav_menu(array(
                'theme_location' => 'menu-principal',
                'menu_id'        => 'primary-menu',
                'container'      => false,
                'fallback_cb'    => false,
            ));
            ?>
        </nav>

        <div class="header-actions">
            <a href="<?php echo esc_url(home_url('/contato')); ?>" class="btn-contato">
                <?php esc_html_e('Fale Conosco', 'techconsult'); ?>
            </a>
        </div>
    </div>
</header>