<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="masthead" class="site-header sticky-top">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <?php
            if ( has_custom_logo() ) {
                the_custom_logo();
            } else {
                ?>
                <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                <?php
            }
            ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#primary-menu" aria-controls="primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'small-apps' ); ?>">
                <span class="navbar-toggler-icon"></span>
            </button>

            <?php
            wp_nav_menu( array(
                'theme_location'  => 'primary',
                'depth'           => 2, // 1 = sem dropdowns, 2 = com dropdowns.
                'container'       => 'div',
                'container_class' => 'collapse navbar-collapse',
                'container_id'    => 'primary-menu',
                'menu_class'      => 'navbar-nav ms-auto mb-2 mb-lg-0',
                'fallback_cb'     => '__return_false',
                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s<li class="nav-item ms-lg-2">' . get_search_form( false ) . '</li></ul>',
                'walker'          => new Bootstrap_Nav_Walker(),
            ) );
            ?>
        </div>
    </nav>
</header>

<main id="main" class="site-main">