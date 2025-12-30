<?php
/**
 * Funções personalizadas do tema
 */

/**
 * Registra áreas de widgets
 */
function dev9_modern_widgets_init() {
    // Barra lateral principal
    register_sidebar(array(
        'name'          => esc_html__('Barra Lateral', 'dev9-modern'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Adicione widgets aqui para aparecerem na barra lateral.', 'dev9-modern'),
        'before_widget' => '<section id="%1$s" class="widget %2$s card mb-4">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title card-header">',
        'after_title'   => '</h3><div class="card-body">',
        'after_sidebar' => '</div>',
    ));
    
    // Rodapé - Coluna 1
    register_sidebar(array(
        'name'          => esc_html__('Rodapé - Coluna 1', 'dev9-modern'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Adicione widgets para a primeira coluna do rodapé.', 'dev9-modern'),
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-4">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
    
    // Rodapé - Coluna 2
    register_sidebar(array(
        'name'          => esc_html__('Rodapé - Coluna 2', 'dev9-modern'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Adicione widgets para a segunda coluna do rodapé.', 'dev9-modern'),
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-4">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
    
    // Rodapé - Coluna 3
    register_sidebar(array(
        'name'          => esc_html__('Rodapé - Coluna 3', 'dev9-modern'),
        'id'            => 'footer-3',
        'description'   => esc_html__('Adicione widgets para a terceira coluna do rodapé.', 'dev9-modern'),
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-4">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
    
    // Widget de newsletter
    register_sidebar(array(
        'name'          => esc_html__('Newsletter', 'dev9-modern'),
        'id'            => 'newsletter',
        'description'   => esc_html__('Área para formulário de newsletter.', 'dev9-modern'),
        'before_widget' => '<div id="%1$s" class="widget %2$s newsletter-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="newsletter-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'dev9_modern_widgets_init');

/**
 * Adiciona classes ao body
 */
function dev9_body_classes($classes) {
    // Adiciona classe se for a página inicial
    if (is_front_page()) {
        $classes[] = 'home-page';
    }
    
    // Adiciona classe se for um post ou página individual
    if (is_singular()) {
        $classes[] = 'singular';
    }
    
    // Adiciona classe se tiver barra lateral ativa
    if (is_active_sidebar('sidebar-1')) {
        $classes[] = 'has-sidebar';
    } else {
        $classes[] = 'no-sidebar';
    }
    
    // Adiciona classe para dispositivos móveis
    if (wp_is_mobile()) {
        $classes[] = 'is-mobile';
    }
    
    return $classes;
}
add_filter('body_class', 'dev9_body_classes');

/**
 * Adiciona classe ao link 'Leia mais' em resumos
 */
function dev9_excerpt_more($more) {
    if (!is_admin()) {
        return '...';
    }
    return $more;
}
add_filter('excerpt_more', 'dev9_excerpt_more');

/**
 * Filtra o comprimento do resumo
 */
function dev9_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'dev9_excerpt_length', 999);


/**
 * Adiciona estilos para o editor Gutenberg
 */
function dev9_block_editor_styles() {
    // Estilos do editor
    wp_enqueue_style('dev9-modern-editor-style', get_template_directory_uri() . '/assets/css/editor-style.css', array(), DEV9_MODERN_VERSION);
    
    // Google Fonts no editor
    wp_enqueue_style('dev9-modern-editor-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Fira+Code:wght@400;500&display=swap', array(), null);
    
    // Adiciona variáveis CSS ao editor
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');
}
add_action('enqueue_block_editor_assets', 'dev9_block_editor_styles');

/**
 * Adiciona suporte a blocos personalizados
 */
function dev9_register_block_patterns() {
    // Verifica se o tema suporta padrões de bloco
    if (function_exists('register_block_pattern')) {
        // Padrão de cabeçalho herói
        register_block_pattern(
            'dev9-modern/hero',
            array(
                'title'       => esc_html__('Cabeçalho Herói', 'dev9-modern'),
                'description' => esc_html__('Um cabeçalho herói com título, texto e botão de chamada para ação.', 'dev9-modern'),
                'content'     => '<!-- wp:cover {"overlayColor":"primary","align":"full","className":"hero-section"} -->
                <div class="wp-block-cover alignfull hero-section">
                    <span aria-hidden="true" class="wp-block-cover__background has-primary-background-color has-background-dim-100 has-background-dim"></span>
                    <div class="wp-block-cover__inner-container">
                        <!-- wp:heading {"level":1,"textColor":"white","className":"has-text-align-center"} -->
                        <h1 class="has-text-align-center has-white-color has-text-color">' . esc_html__('Bem-vindo ao Nosso Site', 'dev9-modern') . '</h1>
                        <!-- /wp:heading -->
                        
                        <!-- wp:paragraph {"align":"center","textColor":"white"} -->
                        <p class="has-text-align-center has-white-color has-text-color">' . esc_html__('Uma solução incrível para suas necessidades digitais.', 'dev9-modern') . '</p>
                        <!-- /wp:paragraph -->
                        
                        <!-- wp:buttons {"align":"center"} -->
                        <div class="wp-block-buttons aligncenter">
                            <!-- wp:button {"backgroundColor":"white","textColor":"primary","className":"is-style-outline"} -->
                            <div class="wp-block-button is-style-outline">
                                <a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background" href="#">' . esc_html__('Saiba Mais', 'dev9-modern') . '</a>
                            </div>
                            <!-- /wp:button -->
                        </div>
                        <!-- /wp:buttons -->
                    </div>
                </div>
                <!-- /wp:cover -->',
            )
        );
    }
}
add_action('init', 'dev9_register_block_patterns');

/**
 * Força o uso do editor de imagens GD para evitar erros de recorte
 */
add_filter('wp_image_editors', function ($editors) {
    return array('WP_Image_Editor_GD');
});
