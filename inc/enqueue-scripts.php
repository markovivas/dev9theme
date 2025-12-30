<?php
/**
 * Enfileira scripts e estilos
 */
function dev9_modern_scripts() {
    // Desregistra o jQuery padrão do WordPress
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), '3.6.0', true);
    }

    // Google Fonts (Inter + Fira Code)
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Fira+Code:wght@400;500&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap', array(), null);
    
    // Bootstrap Icons
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css', array(), '1.10.5');
    
    // Tema principal CSS
    wp_enqueue_style('dev9-modern-style', get_stylesheet_uri(), array('google-fonts', 'bootstrap-icons'), DEV9_MODERN_VERSION);
    
    // CSS adicional para personalizações
    wp_enqueue_style('dev9-modern-main', get_template_directory_uri() . '/assets/css/main.css', array('dev9-modern-style'), DEV9_MODERN_VERSION);
    wp_enqueue_style('dev9-modern-exemplo', get_template_directory_uri() . '/imagens/style(exemplo).css', array('dev9-modern-main'), DEV9_MODERN_VERSION);
    
    // Modernizr (para detecção de recursos)
    wp_enqueue_script('modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array(), '2.8.3', false);
    
    // jQuery (carregado no footer)
    wp_enqueue_script('jquery');
    
    // Bootstrap JS Bundle (inclui Popper)
    wp_enqueue_script('bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.0', true);
    
    // Lazy Loading para imagens
    wp_enqueue_script('lazysizes', 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js', array(), '5.3.2', true);
    
    // JS principal do tema
    wp_enqueue_script('dev9-modern-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery', 'bootstrap-bundle'), DEV9_MODERN_VERSION, true);
    
    // Adiciona variáveis JavaScript
    wp_localize_script('dev9-modern-script', 'dev9ModernVars', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('dev9-modern-nonce'),
        'isHome' => is_front_page(),
        'isMobile' => wp_is_mobile(),
    ));
    
    // Comentários em páginas únicas
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'dev9_modern_scripts');

/**
 * Adiciona atributos de carregamento lento para imagens
 */
function dev9_add_lazy_loading_attr($content) {
    if (!is_admin()) {
        $content = preg_replace('/<img(.*?)\s+src="(.*?)"(.*?)>/i', '<img$1 src="data:image/svg+xml,%3Csvg%20xmlns=\'http://www.w3.org/2000/svg\'%20viewBox=\'0%200%201%201\'%3E%3C/svg%3E" data-src="$2"$3 loading="lazy" class="lazyload">', $content);
        $content = str_replace('srcset=', 'data-srcset=', $content);
        $content = str_replace('sizes=', 'data-sizes=', $content);
    }
    return $content;
}
add_filter('the_content', 'dev9_add_lazy_loading_attr');
add_filter('post_thumbnail_html', 'dev9_add_lazy_loading_attr');

/**
 * Adiciona atributo defer/async para scripts
 */
function dev9_add_script_attributes($tag, $handle) {
    // Adiciona defer para scripts específicos
    $scripts_to_defer = array('dev9-modern-script');
    
    foreach($scripts_to_defer as $defer_script) {
        if ($defer_script === $handle) {
            return str_replace(' src', ' defer src', $tag);
        }
    }
    
    // Adiciona async para scripts específicos
    $scripts_to_async = array('lazysizes');
    
    foreach($scripts_to_async as $async_script) {
        if ($async_script === $handle) {
            return str_replace(' src', ' async src', $tag);
        }
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'dev9_add_script_attributes', 10, 2);

/**
 * Remove query strings de recursos estáticos
 */
function dev9_remove_script_version($src) {
    if (strpos($src, '?ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('script_loader_src', 'dev9_remove_script_version', 15, 1);
add_filter('style_loader_src', 'dev9_remove_script_version', 15, 1);
