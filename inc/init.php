<?php
/**
 * Inicialização do tema
 * 
 * @package DEV9_Modern
 */

// Definição de constantes
if (!defined('DEV9_MODERN_VERSION')) {
    define('DEV9_MODERN_VERSION', '2.0.0');
}

if (!defined('DEV9_MODERN_DIR')) {
    define('DEV9_MODERN_DIR', get_template_directory());
}

if (!defined('DEV9_MODERN_URI')) {
    define('DEV9_MODERN_URI', get_template_directory_uri());
}

// Carrega os arquivos de funções
$inc_files = array(
    'setup',           // Configurações iniciais do tema
    'enqueue-scripts', // Carregamento de scripts e estilos
    'custom-functions' // Funções personalizadas
);

foreach ($inc_files as $file) {
    $file_path = DEV9_MODERN_DIR . "/inc/{$file}.php";
    if (file_exists($file_path)) {
        require_once $file_path;
    }
}

// Limpa o cabeçalho
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Remove a versão do WordPress dos arquivos CSS e JS
add_filter('script_loader_src', 'dev9_remove_wp_version', 15, 1);
add_filter('style_loader_src', 'dev9_remove_wp_version', 15, 1);

function dev9_remove_wp_version($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}

// Otimiza o carregamento de scripts
add_filter('script_loader_tag', 'dev9_optimize_scripts', 10, 3);

function dev9_optimize_scripts($tag, $handle, $src) {
    // Adiciona atributos de desempenho
    $defer_scripts = array('jquery-core', 'jquery-migrate');
    
    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src', ' defer src', $tag);
    }
    
    return $tag;
}

// Permite o upload de arquivos WebP
function dev9_webp_upload($mimes) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter('upload_mimes', 'dev9_webp_upload');

// Adiciona suporte a SVG
function dev9_svg_upload_mimes($mimes = array()) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'dev9_svg_upload_mimes');

// Corrige a exibição de SVGs no gerenciador de mídia
function dev9_svg_thumb_display() {
    echo '<style>
        .attachment-266x266, .thumbnail img {
            width: 100% !important;
            height: auto !important;
        }
    </style>';
}
add_action('admin_head', 'dev9_svg_thumb_display');

// Adiciona suporte a lazy loading para imagens
function dev9_add_lazy_loading($content) {
    if (is_feed() || is_preview() || (function_exists('is_amp_endpoint') && is_amp_endpoint())) {
        return $content;
    }
    
    $content = mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8');
    $dom = new DOMDocument();
    
    @$dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    
    $imgs = $dom->getElementsByTagName('img');
    
    foreach ($imgs as $img) {
        $existing_class = $img->getAttribute('class');
        $img->setAttribute('class', $existing_class . ' lazyload');
        
        $src = $img->getAttribute('src');
        $srcset = $img->getAttribute('srcset');
        
        if (!empty($src)) {
            $img->setAttribute('data-src', $src);
            $img->setAttribute('src', 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxIiBoZWlnaHQ9IjEiIHZpZXdCb3g9IjAgMCAxIDEiPjwvc3ZnPg==');
        }
        
        if (!empty($srcset)) {
            $img->setAttribute('data-srcset', $srcset);
            $img->removeAttribute('srcset');
        }
        
        $img->setAttribute('loading', 'lazy');
    }
    
    return $dom->saveHTML();
}
add_filter('the_content', 'dev9_add_lazy_loading', 99);
add_filter('post_thumbnail_html', 'dev9_add_lazy_loading', 10);
add_filter('woocommerce_product_get_image', 'dev9_add_lazy_loading', 10);

// Adiciona suporte a WebP para o editor de mídia
function dev9_webp_is_displayable($result, $path) {
    if ($result === false) {
        $displayable_image_types = array(IMAGETYPE_WEBP);
        $info = @getimagesize($path);

        if (empty($info)) {
            $result = false;
        } elseif (!in_array($info[2], $displayable_image_types)) {
            $result = false;
        } else {
            $result = true;
        }
    }

    return $result;
}
add_filter('file_is_displayable_image', 'dev9_webp_is_displayable', 10, 2);

// Adiciona suporte a SVG no personalizador
function dev9_customize_register($wp_customize) {
    // Seção de configurações do tema
    $wp_customize->add_section('dev9_theme_options', array(
        'title'    => esc_html__('Opções do Tema', 'dev9-modern'),
        'priority' => 30,
    ));
    
    // Configuração do rodapé
    $wp_customize->add_setting('footer_text', array(
        'default'           => '© ' . date('Y') . ' ' . get_bloginfo('name') . '. Todos os direitos reservados.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('footer_text', array(
        'label'    => esc_html__('Texto do Rodapé', 'dev9-modern'),
        'section'  => 'dev9_theme_options',
        'type'     => 'textarea',
    ));
    
    // Suporte a atualização em tempo real
    $wp_customize->selective_refresh->add_partial('footer_text', array(
        'selector'        => '.site-footer .footer-text',
        'render_callback' => function() {
            return get_theme_mod('footer_text');
        },
    ));
}
add_action('customize_register', 'dev9_customize_register');

// Adiciona suporte a WebP para o editor de mídia
function dev9_webp_upload_check($file) {
    if ($file['type'] == 'image/webp') {
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        if ($ext != 'webp') {
            $file['error'] = 'O arquivo deve ter a extensão .webp';
        }
    }
    return $file;
}
add_filter('wp_handle_upload_prefilter', 'dev9_webp_upload_check');
