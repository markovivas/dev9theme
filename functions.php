<?php
/**
 * Functions and definitions
 *
 * @package TechConsult
 */

if (!defined('_S_VERSION')) {
    define('_S_VERSION', '1.0.0');
}

$theme_inc_path = get_template_directory() . '/inc/';

/**
 * Inclui as configurações principais do tema.
 */
require $theme_inc_path . 'setup.php';

/**
 * Adiciona tamanhos de imagem personalizados.
 */
function techconsult_add_image_sizes() {
    // Tamanho para a imagem do Hero na página inicial.
    // Largura de 1920px, altura de 700px, com corte rígido.
    add_image_size('hero-image', 1920, 700, true);
}
add_action('after_setup_theme', 'techconsult_add_image_sizes');

function techconsult_scripts() {
    // Estilos
    wp_enqueue_style('techconsult-style', get_stylesheet_uri(), array(), _S_VERSION);
    // Corrigido: arquivos estão na raiz do tema
    wp_enqueue_style('main-style', get_template_directory_uri() . '/main.css', array('techconsult-style'), _S_VERSION);
    wp_enqueue_style('responsive-style', get_template_directory_uri() . '/responsive.css', array('main-style'), _S_VERSION);
    
    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap', array(), null);

    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css', array(), '6.5.2');

    // Scripts
    // wp_enqueue_script('techconsult-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), _S_VERSION, true); // Arquivo ainda não criado
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), _S_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'techconsult_scripts');

/**
 * Registrar áreas de widgets
 */
function techconsult_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar Principal', 'techconsult'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Adicione widgets aqui.', 'techconsult'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    // Widgets do Footer
    register_sidebar(array(
        'name'          => esc_html__('Rodapé Coluna 1', 'techconsult'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Primeira coluna do rodapé.', 'techconsult'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Rodapé Coluna 2', 'techconsult'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Segunda coluna do rodapé.', 'techconsult'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Rodapé Coluna 3', 'techconsult'),
        'id'            => 'footer-3',
        'description'   => esc_html__('Terceira coluna do rodapé.', 'techconsult'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'techconsult_widgets_init');

/**
 * Customizer additions
 */
require $theme_inc_path . 'customizer.php';

/**
 * Enqueue scripts for Customizer live preview
 */
function techconsult_customize_preview_js() {
    wp_enqueue_script(
        'techconsult-customizer',
        get_template_directory_uri() . '/assets/js/customizer.js',
        array('jquery', 'customize-preview'),
        _S_VERSION,
        true
    );
}
add_action('customize_preview_init', 'techconsult_customize_preview_js');

/**
 * Sanitização de dados
 */
function techconsult_sanitize_html($input) {
    return wp_kses_post($input);
}

/**
 * Adicionar classes ao body
 */
function techconsult_body_classes($classes) {
    if (is_front_page()) {
        $classes[] = 'front-page';
    }
    
    if (is_page()) {
        $classes[] = 'page-template';
    }
    
    // Adiciona uma classe se o modelo de tela cheia estiver em uso
    if (is_page_template('template-full-screen.php')) {
        $classes[] = 'is-full-screen-template';
    }
    
    return $classes;
}
add_filter('body_class', 'techconsult_body_classes');

/**
 * Suporte a SVG
 */
function techconsult_svg_support($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'techconsult_svg_support');

/**
 * Fallback para o menu do rodapé quando nenhum menu estiver atribuído.
 */
function techconsult_footer_menu_fallback() {
    echo '<ul id="footer-fallback-menu" class="menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Início', 'techconsult') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/sobre')) . '">' . esc_html__('Sobre', 'techconsult') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contato')) . '">' . esc_html__('Contato', 'techconsult') . '</a></li>';
    echo '</ul>';
}

/**
 * Otimizações de Performance e Limpeza do Header
 */
function techconsult_cleanup_head() {
    // Remove links desnecessários
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator'); // Remove versão do WP
    remove_action('wp_head', 'start_post_rel_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'adjacent_posts_rel_link');
}
add_action('init', 'techconsult_cleanup_head');

/**
 * Remover emojis (Melhoria de Performance)
 */
function techconsult_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'techconsult_disable_emojis');

/**
 * Adicionar suporte a logotipo personalizado com flexibilidade
 */
function techconsult_custom_logo_setup() {
    $defaults = array(
        'height'               => 100,
        'width'                => 400,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => array('site-title', 'site-description'),
        'unlink-homepage-logo' => true, 
    );
    add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'techconsult_custom_logo_setup');
