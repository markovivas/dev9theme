<?php
/**
 * Configurações iniciais do tema
 */
function dev9_modern_setup() {
    // Suporte a traduções
    load_theme_textdomain('dev9-modern', get_template_directory() . '/languages');
    
    // Suporte a thumbnails
    add_theme_support('post-thumbnails');
    
    // Tamanhos de imagem personalizados
    add_image_size('dev9-featured', 1200, 675, true); // Proporção 16:9
    add_image_size('dev9-card', 600, 400, true); // Para cards
    add_image_size('dev9-thumbnail', 150, 150, true); // Miniaturas
    
    // Suporte a WebP
    add_theme_support('webp-uploads');
    
    // Suporte a HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
        'navigation-widgets',
    ));
    
    // Suporte a menus de navegação
    register_nav_menus(array(
        'primary' => esc_html__('Menu Principal', 'dev9-modern'),
        'footer' => esc_html__('Menu Rodapé', 'dev9-modern'),
        'social' => esc_html__('Redes Sociais', 'dev9-modern')
    ));
    
    // Suporte a título dinâmico
    add_theme_support('title-tag');
    
    // Suporte a logo personalizada
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array('site-title', 'site-description'),
    ));
    
    // Suporte a widgets personalizados
    add_theme_support('customize-selective-refresh-widgets');
    
    // Suporte a alinhamento amplo e completo
    add_theme_support('align-wide');
    
    // Suporte a estilos de bloco do editor
    add_theme_support('wp-block-styles');
    
    // Suporte a gradientes personalizados
    add_theme_support('editor-gradient-presets', array());
    add_theme_support('disable-custom-gradients');
    
    // Suporte a paleta de cores personalizada
    add_theme_support('editor-color-palette', array(
        array(
            'name'  => esc_html__('Primária', 'dev9-modern'),
            'slug'  => 'primary',
            'color' => '#4361ee',
        ),
        array(
            'name'  => esc_html__('Secundária', 'dev9-modern'),
            'slug'  => 'secondary',
            'color' => '#3f37c9',
        ),
        array(
            'name'  => esc_html__('Destaque', 'dev9-modern'),
            'slug'  => 'accent',
            'color' => '#4895ef',
        ),
        array(
            'name'  => esc_html__('Escuro', 'dev9-modern'),
            'slug'  => 'dark',
            'color' => '#212529',
        ),
        array(
            'name'  => esc_html__('Claro', 'dev9-modern'),
            'slug'  => 'light',
            'color' => '#f8f9fa',
        ),
    ));
    
    // Desativa cores personalizadas
    add_theme_support('disable-custom-colors');
    
    // Suporte a tamanhos de fonte personalizados
    add_theme_support('editor-font-sizes', array(
        array(
            'name' => esc_html__('Pequeno', 'dev9-modern'),
            'size' => 14,
            'slug' => 'small'
        ),
        array(
            'name' => esc_html__('Normal', 'dev9-modern'),
            'size' => 16,
            'slug' => 'normal'
        ),
        array(
            'name' => esc_html__('Médio', 'dev9-modern'),
            'size' => 20,
            'slug' => 'medium'
        ),
        array(
            'name' => esc_html__('Grande', 'dev9-modern'),
            'size' => 24,
            'slug' => 'large'
        ),
        array(
            'name' => esc_html__('Extra Grande', 'dev9-modern'),
            'size' => 36,
            'slug' => 'x-large'
        ),
    ));
    
    // Desativa tamanhos de fonte personalizados
    add_theme_support('disable-custom-font-sizes');
    
    // Suporte a elementos embutidos
    add_theme_support('responsive-embeds');
    
    // Suporte a estilos de bloco padrão do WordPress
    add_theme_support('wp-block-styles');
}
add_action('after_setup_theme', 'dev9_modern_setup');
