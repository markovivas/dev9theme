<?php

// Define a versão do tema para facilitar o versionamento de assets.
define('SMALL_APPS_VERSION', '1.0.0');

function small_apps_setup() {
    // Suporte a thumbnails
    add_theme_support('post-thumbnails');
    
    // Menus de navegação
    register_nav_menus(array(
        'primary' => __('Menu Principal', 'small-apps'),
        'footer' => __('Menu Rodapé', 'small-apps')
    ));
    
    // Suporte a título dinâmico
    add_theme_support('title-tag');
    
    // Suporte a logo personalizada
    add_theme_support('custom-logo', array(
        'height' => 60,
        'width' => 200,
        'flex-height' => true,
    ));
}
add_action('after_setup_theme', 'small_apps_setup');

// Enfileira os scripts e estilos do tema.
function small_apps_scripts() {
    // Bootstrap CSS
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css', array(), '5.3.0');

    // Google Fonts (Inter)
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap', array(), null);

    // Bootstrap Icons CSS
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css', array('bootstrap'), '1.10.5');
    
    // Tema principal CSS (style.css)
    wp_enqueue_style('small-apps-style', get_stylesheet_uri(), array('bootstrap'), SMALL_APPS_VERSION);
    
    // Bootstrap JS + Popper (Bootstrap 5 não depende de jQuery)
    wp_enqueue_script('bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array(), '5.3.0', true);
    
    // JS personalizado
    wp_enqueue_script('small-apps-script', get_template_directory_uri() . '/assets/js/main.js', array('bootstrap-bundle'), SMALL_APPS_VERSION, true);
}
add_action('wp_enqueue_scripts', 'small_apps_scripts');

// Registrar áreas de widgets
function small_apps_widgets_init() {
    register_sidebar(array(
        'name' => __('Rodapé - Coluna 1', 'small-apps'),
        'id' => 'footer-1',
        'description' => __('Widgets da primeira coluna do rodapé', 'small-apps'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
    
    register_sidebar(array(
        'name' => __('Rodapé - Coluna 2', 'small-apps'),
        'id' => 'footer-2',
        'description' => __('Widgets da segunda coluna do rodapé', 'small-apps'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => __('Rodapé - Coluna 3', 'small-apps'),
        'id' => 'footer-3',
        'description' => __('Widgets da terceira coluna do rodapé', 'small-apps'),
        'before_widget' => '<div id="%1$s" class="widget %2$s footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => __('Rodapé - Coluna 4', 'small-apps'),
        'id' => 'footer-4',
        'description' => __('Widgets da quarta coluna do rodapé', 'small-apps'),
        'before_widget' => '<div id="%1$s" class="widget %2$s footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
}
add_action('widgets_init', 'small_apps_widgets_init');

// Incluir o Navwalker para o menu Bootstrap
// O padrão a seguir permite que um tema-filho (child theme) sobrescreva este arquivo.
// Ele primeiro procura o arquivo no diretório do tema-filho (get_stylesheet_directory)
// e, se não encontrar, carrega o arquivo do diretório do tema-pai (get_template_directory).
$navwalker_path = get_stylesheet_directory() . '/class-bootstrap-navwalker.php';
if ( file_exists( $navwalker_path ) ) {
    require_once $navwalker_path;
} else {
    require_once get_template_directory() . '/class-bootstrap-navwalker.php';
}

/**
 * Adiciona seções e controles ao Personalizador do WordPress.
 *
 * @param WP_Customize_Manager $wp_customize Gerenciador do Personalizador.
 */
function small_apps_customize_register( $wp_customize ) {
    // Adiciona a seção "Seção Hero"
    $wp_customize->add_section( 'hero_section', array(
        'title'    => __( 'Seção Hero', 'small-apps' ),
        'priority' => 30,
    ) );

    // Controle para o Título
    $wp_customize->add_setting( 'hero_title', array( 'default' => '' ) );
    $wp_customize->add_control( 'hero_title_control', array(
        'label'    => __( 'Título da Seção Hero', 'small-apps' ),
        'section'  => 'hero_section',
        'settings' => 'hero_title',
        'type'     => 'text',
    ) );

    // Controle para o Subtítulo
    $wp_customize->add_setting( 'hero_subtitle', array( 'default' => '' ) );
    $wp_customize->add_control( 'hero_subtitle_control', array(
        'label'    => __( 'Subtítulo da Seção Hero', 'small-apps' ),
        'section'  => 'hero_section',
        'settings' => 'hero_subtitle',
        'type'     => 'textarea',
    ) );

    // Controle para o Texto do Botão
    $wp_customize->add_setting( 'hero_button_text', array( 'default' => __( 'Explore Nossas Soluções', 'small-apps' ) ) );
    $wp_customize->add_control( 'hero_button_text_control', array(
        'label'    => __( 'Texto do Botão', 'small-apps' ),
        'section'  => 'hero_section',
        'settings' => 'hero_button_text',
        'type'     => 'text',
    ) );

    // Controle para o Link do Botão
    $wp_customize->add_setting( 'hero_button_url', array(
        'default'           => '#features',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'hero_button_url_control', array(
        'label'    => __( 'Link do Botão', 'small-apps' ),
        'section'  => 'hero_section',
        'settings' => 'hero_button_url',
        'type'     => 'url',
    ) );

    // Controle para a Imagem de Fundo
    $wp_customize->add_setting( 'hero_background_image', array(
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_background_image_control', array(
        'label'    => __( 'Imagem de Fundo da Seção Hero', 'small-apps' ),
        'section'  => 'hero_section',
        'settings' => 'hero_background_image',
    ) ) );

    // Controle para a Imagem do Elemento Visual (coluna da direita)
    $wp_customize->add_setting( 'hero_visual_image', array(
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_visual_image_control', array(
        'label'       => __( 'Imagem do Elemento Visual (Opcional)', 'small-apps' ),
        'description' => __( 'Substitui os círculos animados por uma imagem. Ideal para ilustrações ou screenshots.', 'small-apps' ),
        'section'     => 'hero_section',
        'settings'    => 'hero_visual_image',
    ) ) );

    // --- Controles de Cor da Seção Hero ---

    // Cor do Título
    $wp_customize->add_setting( 'hero_title_color', array(
        'default'           => '#FFFFFF',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hero_title_color_control', array(
        'label'    => __( 'Cor do Título', 'small-apps' ),
        'section'  => 'hero_section',
        'settings' => 'hero_title_color',
    ) ) );

    // Cor do Subtítulo
    $wp_customize->add_setting( 'hero_subtitle_color', array(
        'default'           => '#F8F9FA',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hero_subtitle_color_control', array(
        'label'    => __( 'Cor do Subtítulo', 'small-apps' ),
        'section'  => 'hero_section',
        'settings' => 'hero_subtitle_color',
    ) ) );
    
    $wp_customize->add_setting( 'hero_title_font', array(
        'default'           => 'system',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hero_title_font_control', array(
        'label'    => __( 'Fonte do Título', 'small-apps' ),
        'section'  => 'hero_section',
        'settings' => 'hero_title_font',
        'type'     => 'select',
        'choices'  => array(
            'system'             => 'System UI',
            'inter'              => 'Inter',
            'plus-jakarta-sans'  => 'Plus Jakarta Sans',
            'poppins'            => 'Poppins',
            'roboto'             => 'Roboto',
        ),
    ) );
    $wp_customize->add_setting( 'hero_title_bold', array(
        'default'           => 1,
        'sanitize_callback' => 'small_apps_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'hero_title_bold_control', array(
        'label'    => __( 'Negrito no Título', 'small-apps' ),
        'section'  => 'hero_section',
        'settings' => 'hero_title_bold',
        'type'     => 'checkbox',
    ) );
    $wp_customize->add_setting( 'hero_title_italic', array(
        'default'           => 0,
        'sanitize_callback' => 'small_apps_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'hero_title_italic_control', array(
        'label'    => __( 'Itálico no Título', 'small-apps' ),
        'section'  => 'hero_section',
        'settings' => 'hero_title_italic',
        'type'     => 'checkbox',
    ) );
    
    $wp_customize->add_setting( 'hero_subtitle_font', array(
        'default'           => 'system',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hero_subtitle_font_control', array(
        'label'    => __( 'Fonte do Subtítulo', 'small-apps' ),
        'section'  => 'hero_section',
        'settings' => 'hero_subtitle_font',
        'type'     => 'select',
        'choices'  => array(
            'system'             => 'System UI',
            'inter'              => 'Inter',
            'plus-jakarta-sans'  => 'Plus Jakarta Sans',
            'poppins'            => 'Poppins',
            'roboto'             => 'Roboto',
        ),
    ) );
    $wp_customize->add_setting( 'hero_subtitle_bold', array(
        'default'           => 0,
        'sanitize_callback' => 'small_apps_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'hero_subtitle_bold_control', array(
        'label'    => __( 'Negrito no Subtítulo', 'small-apps' ),
        'section'  => 'hero_section',
        'settings' => 'hero_subtitle_bold',
        'type'     => 'checkbox',
    ) );
    $wp_customize->add_setting( 'hero_subtitle_italic', array(
        'default'           => 0,
        'sanitize_callback' => 'small_apps_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'hero_subtitle_italic_control', array(
        'label'    => __( 'Itálico no Subtítulo', 'small-apps' ),
        'section'  => 'hero_section',
        'settings' => 'hero_subtitle_italic',
        'type'     => 'checkbox',
    ) );

    // Cor de Fundo do Botão
    $wp_customize->add_setting( 'hero_button_bg_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hero_button_bg_color_control', array(
        'label'    => __( 'Cor de Fundo do Botão', 'small-apps' ),
        'section'  => 'hero_section',
        'settings' => 'hero_button_bg_color',
    ) ) );

    // Cor do Texto do Botão
    $wp_customize->add_setting( 'hero_button_text_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hero_button_text_color_control', array(
        'label'    => __( 'Cor do Texto do Botão', 'small-apps' ),
        'section'  => 'hero_section',
        'settings' => 'hero_button_text_color',
    ) ) );

    // --- Seção de Recursos ---
    $wp_customize->add_section( 'features_section', array(
        'title'    => __( 'Seção de Recursos', 'small-apps' ),
        'priority' => 35, // Posiciona após a Seção Hero
    ) );

    // Loop para criar controles para 3 recursos
    for ( $i = 1; $i <= 3; $i++ ) {
        // Adiciona um separador para cada recurso para melhor organização
        $wp_customize->add_setting( "feature_{$i}_separator", array( 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "feature_{$i}_separator_control", array(
            'label'    => sprintf( __( 'Recurso %d', 'small-apps' ), $i ),
            'section'  => 'features_section',
            'settings' => "feature_{$i}_separator",
            'type'     => 'hidden', // Usado como um título de grupo
        ) ) );

        // Controle para o Ícone do Recurso
        $wp_customize->add_setting( "feature_{$i}_icon", array( 'default' => 'bi-speedometer2', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "feature_{$i}_icon_control", array(
            'label'       => sprintf( __( 'Ícone do Recurso %d', 'small-apps' ), $i ),
            'description' => __( 'Use uma classe de ícone do Bootstrap (ex: bi-speedometer2).', 'small-apps' ),
            'section'     => 'features_section',
            'settings'    => "feature_{$i}_icon",
            'type'        => 'text',
        ) );

        // Controle para o Título do Recurso
        $wp_customize->add_setting( "feature_{$i}_title", array( 'default' => sprintf( __( 'Recurso %d', 'small-apps' ), $i ), 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "feature_{$i}_title_control", array(
            'label'    => sprintf( __( 'Título do Recurso %d', 'small-apps' ), $i ),
            'section'  => 'features_section',
            'settings' => "feature_{$i}_title",
            'type'     => 'text',
        ) );

        // Controle para a Descrição do Recurso
        $wp_customize->add_setting( "feature_{$i}_description", array( 'default' => __( 'Descrição breve sobre a funcionalidade e os benefícios deste incrível recurso.', 'small-apps' ), 'sanitize_callback' => 'wp_kses_post' ) );
        $wp_customize->add_control( "feature_{$i}_description_control", array(
            'label'    => sprintf( __( 'Descrição do Recurso %d', 'small-apps' ), $i ),
            'section'  => 'features_section',
            'settings' => "feature_{$i}_description",
            'type'     => 'textarea',
        ) );

        // Controle para o Link do Recurso
        $wp_customize->add_setting( "feature_{$i}_url", array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
        $wp_customize->add_control( "feature_{$i}_url_control", array(
            'label'    => sprintf( __( 'Link do Recurso %d (opcional)', 'small-apps' ), $i ),
            'section'  => 'features_section',
            'settings' => "feature_{$i}_url",
            'type'     => 'url',
        ) );
    }

    // --- Seção Sobre Nós ---
    $wp_customize->add_section( 'about_section', array(
        'title'    => __( 'Seção Sobre Nós', 'small-apps' ),
        'priority' => 40,
    ) );

    // Controle para a Imagem
    $wp_customize->add_setting( 'about_section_image', array( 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'about_section_image_control', array(
        'label'    => __( 'Imagem da Seção', 'small-apps' ),
        'section'  => 'about_section',
        'settings' => 'about_section_image',
    ) ) );

    // Controle para o Título
    $wp_customize->add_setting( 'about_section_title', array( 'default' => __( 'Nossa Missão', 'small-apps' ), 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'about_section_title_control', array(
        'label'    => __( 'Título da Seção', 'small-apps' ),
        'section'  => 'about_section',
        'settings' => 'about_section_title',
        'type'     => 'text',
    ) );

    // Controle para o Parágrafo Principal (Lead)
    $wp_customize->add_setting( 'about_section_lead', array( 'default' => __( 'Somos uma equipe apaixonada por tecnologia, dedicada a criar soluções inovadoras que impulsionam o futuro.', 'small-apps' ), 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'about_section_lead_control', array(
        'label'    => __( 'Parágrafo Principal (Lead)', 'small-apps' ),
        'section'  => 'about_section',
        'settings' => 'about_section_lead',
        'type'     => 'textarea',
    ) );

    // Controle para o Texto Secundário
    $wp_customize->add_setting( 'about_section_text', array( 'default' => __( 'Nosso foco é transformar ideias complexas em realidade digital, utilizando as mais recentes ferramentas e metodologias do mercado.', 'small-apps' ), 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'about_section_text_control', array(
        'label'    => __( 'Texto Secundário', 'small-apps' ),
        'section'  => 'about_section',
        'settings' => 'about_section_text',
        'type'     => 'textarea',
    ) );

    // Controle para os Itens da Lista (usando um campo de texto simples para cada)
    for ( $i = 1; $i <= 3; $i++ ) {
        $wp_customize->add_setting( "about_section_item_{$i}", array( 'default' => sprintf( __( 'Item de lista %d', 'small-apps' ), $i ), 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "about_section_item_{$i}_control", array(
            'label' => sprintf( __( 'Item da Lista %d', 'small-apps' ), $i ), 'section' => 'about_section', 'settings' => "about_section_item_{$i}", 'type' => 'text',
        ) );
    }

    // --- Seção Galeria de Projetos (Títulos) ---
    $wp_customize->add_section( 'portfolio_section', array(
        'title'    => __( 'Galeria de Projetos', 'small-apps' ),
        'priority' => 45,
    ) );

    // Controle para o Título Principal da Galeria
    $wp_customize->add_setting( 'portfolio_main_title', array( 'default' => __( 'Portfólio de Inovações', 'small-apps' ), 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'portfolio_main_title_control', array(
        'label'    => __( 'Título Principal da Galeria', 'small-apps' ),
        'section'  => 'portfolio_section',
        'settings' => 'portfolio_main_title',
        'type'     => 'text',
    ) );

    // Controle para o Subtítulo da Galeria
    $wp_customize->add_setting( 'portfolio_main_subtitle', array( 'default' => __( 'Explore alguns dos nossos projetos e soluções tecnológicas.', 'small-apps' ), 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'portfolio_main_subtitle_control', array(
        'label'    => __( 'Subtítulo da Galeria', 'small-apps' ),
        'section'  => 'portfolio_section',
        'settings' => 'portfolio_main_subtitle',
        'type'     => 'textarea',
    ) );
}
add_action( 'customize_register', 'small_apps_customize_register' );

/**
 * Gera e injeta CSS customizado do Personalizador no <head>.
 */
function small_apps_customizer_css() {
    ?>
    <style type="text/css">
        <?php
        // Cor do Título da Seção Hero
        $hero_title_color = get_theme_mod( 'hero_title_color', '#FFFFFF' );
        if ( $hero_title_color !== '#FFFFFF' ) { // Aplica somente se for diferente do padrão
            echo '.hero-section h1 { color: ' . esc_attr( $hero_title_color ) . ' !important; }';
        }

        // Cor do Subtítulo da Seção Hero
        $hero_subtitle_color = get_theme_mod( 'hero_subtitle_color', '#F8F9FA' );
        if ( $hero_subtitle_color !== '#F8F9FA' ) {
            echo '.hero-section .lead { color: ' . esc_attr( $hero_subtitle_color ) . ' !important; }';
        }

        // Cores do Botão da Seção Hero
        $hero_button_bg_color = get_theme_mod( 'hero_button_bg_color' );
        if ( ! empty( $hero_button_bg_color ) ) {
            echo '.hero-section .btn-primary { background-color: ' . esc_attr( $hero_button_bg_color ) . ' !important; border-color: ' . esc_attr( $hero_button_bg_color ) . ' !important; }';
        }

        $hero_button_text_color = get_theme_mod( 'hero_button_text_color' );
        if ( ! empty( $hero_button_text_color ) ) {
            echo '.hero-section .btn-primary { color: ' . esc_attr( $hero_button_text_color ) . ' !important; }';
        }
        
        $font_map = array(
            'system'            => "system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif",
            'inter'             => "'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif",
            'plus-jakarta-sans' => "'Plus Jakarta Sans', 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif",
            'poppins'           => "'Poppins', 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif",
            'roboto'            => "Roboto, 'Helvetica Neue', Arial, 'Inter', sans-serif",
        );
        $title_font_key = get_theme_mod( 'hero_title_font', 'system' );
        if ( isset( $font_map[ $title_font_key ] ) ) {
            echo '.hero-section h1 { font-family: ' . $font_map[ $title_font_key ] . ' !important; }';
        }
        $subtitle_font_key = get_theme_mod( 'hero_subtitle_font', 'system' );
        if ( isset( $font_map[ $subtitle_font_key ] ) ) {
            echo '.hero-section .lead { font-family: ' . $font_map[ $subtitle_font_key ] . ' !important; }';
        }
        $title_bold = get_theme_mod( 'hero_title_bold', 1 ) ? '700' : '400';
        echo '.hero-section h1 { font-weight: ' . $title_bold . ' !important; }';
        $title_italic = get_theme_mod( 'hero_title_italic', 0 ) ? 'italic' : 'normal';
        echo '.hero-section h1 { font-style: ' . $title_italic . ' !important; }';
        $subtitle_bold = get_theme_mod( 'hero_subtitle_bold', 0 ) ? '700' : '400';
        echo '.hero-section .lead { font-weight: ' . $subtitle_bold . ' !important; }';
        $subtitle_italic = get_theme_mod( 'hero_subtitle_italic', 0 ) ? 'italic' : 'normal';
        echo '.hero-section .lead { font-style: ' . $subtitle_italic . ' !important; }';
        ?>
    </style>
    <?php
}
add_action( 'wp_head', 'small_apps_customizer_css' );

function small_apps_sanitize_checkbox( $checked ) {
    return ( isset( $checked ) && (bool) $checked ) ? 1 : 0;
}

/**
 * Registra o Custom Post Type "Projeto".
 */
function small_apps_register_project_cpt() {
    $labels = array(
        'name'                  => _x( 'Projetos', 'Post type general name', 'small-apps' ),
        'singular_name'         => _x( 'Projeto', 'Post type singular name', 'small-apps' ),
        'menu_name'             => _x( 'Projetos', 'Admin Menu text', 'small-apps' ),
        'name_admin_bar'        => _x( 'Projeto', 'Add New on Toolbar', 'small-apps' ),
        'add_new'               => __( 'Adicionar Novo', 'small-apps' ),
        'add_new_item'          => __( 'Adicionar Novo Projeto', 'small-apps' ),
        'new_item'              => __( 'Novo Projeto', 'small-apps' ),
        'edit_item'             => __( 'Editar Projeto', 'small-apps' ),
        'view_item'             => __( 'Ver Projeto', 'small-apps' ),
        'all_items'             => __( 'Todos os Projetos', 'small-apps' ),
        'search_items'          => __( 'Procurar Projetos', 'small-apps' ),
        'not_found'             => __( 'Nenhum projeto encontrado.', 'small-apps' ),
        'not_found_in_trash'    => __( 'Nenhum projeto encontrado na lixeira.', 'small-apps' ),
        'featured_image'        => _x( 'Imagem do Projeto', 'Overrides the “Featured Image” phrase for this post type.', 'small-apps' ),
        'set_featured_image'    => _x( 'Definir imagem do projeto', 'Overrides the “Set featured image” phrase for this post type.', 'small-apps' ),
        'remove_featured_image' => _x( 'Remover imagem do projeto', 'Overrides the “Remove featured image” phrase for this post type.', 'small-apps' ),
        'use_featured_image'    => _x( 'Usar como imagem do projeto', 'Overrides the “Use as featured image” phrase for this post type.', 'small-apps' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'projeto' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20, // Abaixo de "Páginas"
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
    );

    register_post_type( 'projeto', $args );
}
add_action( 'init', 'small_apps_register_project_cpt' );

/**
 * Adiciona a meta box para a URL do Projeto na tela de edição.
 */
function small_apps_add_project_url_meta_box() {
    add_meta_box(
        'small_apps_project_url',                   // ID da meta box
        __( 'Opções do Projeto', 'small-apps' ), // Título da meta box
        'small_apps_project_url_meta_box_html',     // Função de callback para renderizar o HTML
        'projeto',                                  // Post Type
        'side',                                     // Contexto (side, normal, advanced)
        'default'                                   // Prioridade
    );
}
add_action( 'add_meta_boxes', 'small_apps_add_project_url_meta_box' );

/**
 * Renderiza o HTML da meta box para a URL do projeto.
 *
 * @param WP_Post $post O objeto do post atual.
 */
function small_apps_project_url_meta_box_html( $post ) {
    $url_value = get_post_meta( $post->ID, '_project_url_key', true );
    $button_text_value = get_post_meta( $post->ID, '_project_button_text_key', true );
    // Adiciona um campo nonce para verificação de segurança
    wp_nonce_field( 'small_apps_save_project_url_data', 'small_apps_project_url_nonce' );
    ?>
    <p>
        <label for="small_apps_project_url_field"><?php _e( 'URL externa (opcional):', 'small-apps' ); ?></label>
        <input type="url" id="small_apps_project_url_field" name="small_apps_project_url_field" value="<?php echo esc_url( $url_value ); ?>" class="widefat">
    </p>
    <p>
        <label for="small_apps_project_button_text_field"><?php _e( 'Texto do botão (opcional):', 'small-apps' ); ?></label>
        <input type="text" id="small_apps_project_button_text_field" name="small_apps_project_button_text_field" value="<?php echo esc_attr( $button_text_value ); ?>" class="widefat" placeholder="<?php esc_attr_e( 'Ver Detalhes', 'small-apps' ); ?>">
    </p>
    <?php
}

/**
 * Salva os dados da meta box quando o post é salvo.
 *
 * @param int $post_id O ID do post que está sendo salvo.
 */
function small_apps_save_project_url_data( $post_id ) {
    // Verifica o nonce
    if ( ! isset( $_POST['small_apps_project_url_nonce'] ) || ! wp_verify_nonce( $_POST['small_apps_project_url_nonce'], 'small_apps_save_project_url_data' ) ) {
        return;
    }
    // Verifica se o usuário tem permissão para editar o post
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    // Não salva em autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Sanitiza e salva o valor do campo
    if ( isset( $_POST['small_apps_project_url_field'] ) ) {
        update_post_meta( $post_id, '_project_url_key', esc_url_raw( $_POST['small_apps_project_url_field'] ) );
    }

    // Sanitiza e salva o valor do campo de texto do botão
    if ( isset( $_POST['small_apps_project_button_text_field'] ) ) {
        update_post_meta( $post_id, '_project_button_text_key', sanitize_text_field( $_POST['small_apps_project_button_text_field'] ) );
    }
}
add_action( 'save_post', 'small_apps_save_project_url_data' );
 
/**
 * Registra o Custom Post Type "Depoimento".
 */
function small_apps_register_testimonial_cpt() {
    $labels = array(
        'name'                  => _x( 'Depoimentos', 'Post type general name', 'small-apps' ),
        'singular_name'         => _x( 'Depoimento', 'Post type singular name', 'small-apps' ),
        'menu_name'             => _x( 'Depoimentos', 'Admin Menu text', 'small-apps' ),
        'name_admin_bar'        => _x( 'Depoimento', 'Add New on Toolbar', 'small-apps' ),
        'add_new'               => __( 'Adicionar Novo', 'small-apps' ),
        'add_new_item'          => __( 'Adicionar Novo Depoimento', 'small-apps' ),
        'featured_image'        => _x( 'Foto do Autor', 'Overrides the “Featured Image” phrase for this post type.', 'small-apps' ),
        'set_featured_image'    => _x( 'Definir foto do autor', 'Overrides the “Set featured image” phrase for this post type.', 'small-apps' ),
        'remove_featured_image' => _x( 'Remover foto do autor', 'Overrides the “Remove featured image” phrase for this post type.', 'small-apps' ),
    );
    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => false,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 21,
        'menu_icon'          => 'dashicons-format-quote',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
    );
    register_post_type( 'depoimento', $args );
}
add_action( 'init', 'small_apps_register_testimonial_cpt' );

/**
 * Adiciona a meta box para o Cargo do Autor.
 */
function small_apps_add_testimonial_role_meta_box() {
    add_meta_box(
        'small_apps_testimonial_role',
        __( 'Informações do Autor', 'small-apps' ),
        'small_apps_testimonial_role_meta_box_html',
        'depoimento',
        'side'
    );
}
add_action( 'add_meta_boxes', 'small_apps_add_testimonial_role_meta_box' );

function small_apps_testimonial_role_meta_box_html( $post ) {
    $value = get_post_meta( $post->ID, '_testimonial_role_key', true );
    wp_nonce_field( 'small_apps_save_testimonial_role_data', 'small_apps_testimonial_role_nonce' );
    ?>
    <label for="small_apps_testimonial_role_field"><?php _e( 'Cargo ou Empresa:', 'small-apps' ); ?></label>
    <input type="text" id="small_apps_testimonial_role_field" name="small_apps_testimonial_role_field" value="<?php echo esc_attr( $value ); ?>" class="widefat">
    <?php
}

function small_apps_save_testimonial_role_data( $post_id ) {
    if ( ! isset( $_POST['small_apps_testimonial_role_nonce'] ) || ! wp_verify_nonce( $_POST['small_apps_testimonial_role_nonce'], 'small_apps_save_testimonial_role_data' ) ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( isset( $_POST['small_apps_testimonial_role_field'] ) ) {
        update_post_meta( $post_id, '_testimonial_role_key', sanitize_text_field( $_POST['small_apps_testimonial_role_field'] ) );
    }
}
add_action( 'save_post_depoimento', 'small_apps_save_testimonial_role_data' );

/**
 * Adiciona classes do Bootstrap 5 à paginação de posts.
 *
 * @param string $links HTML da paginação.
 * @return string HTML da paginação modificado.
 */
function small_apps_bootstrap_pagination( $links ) {
    // Envolve os links em uma <ul> com a classe 'pagination'.
    $links = str_replace( '<div class="nav-links">', '<ul class="pagination">', $links );
    $links = str_replace( '</div>', '</ul>', $links );

    // Adiciona a classe 'page-item' aos <li> implícitos.
    $links = str_replace( "<a", "<li class='page-item'><a", $links );
    $links = str_replace( "</a>", "</a></li>", $links );
    $links = str_replace( "<span aria-current='page'", "<li class='page-item active' aria-current='page'><span", $links );
    $links = str_replace( "<span class='dots'", "<li class='page-item disabled'><span class='page-link dots'", $links );
    $links = str_replace( "</span>", "</span></li>", $links );

    // Adiciona a classe 'page-link' aos links e spans.
    $links = str_replace( "class='page-numbers", "class='page-link", $links );

    return $links;
}
add_filter( 'the_posts_pagination', 'small_apps_bootstrap_pagination' );

// Carrega CSS personalizado na tela de login
function custom_login_styles() {
    wp_enqueue_style(
        'custom-login',
        get_stylesheet_directory_uri() . '/login.css'
    );
}
add_action('login_enqueue_scripts', 'custom_login_styles');

// Altera link do logo
add_filter('login_headerurl', function () {
    return home_url();
});

// Altera título do logo
add_filter('login_headertext', function () {
    return get_bloginfo('name');
});
