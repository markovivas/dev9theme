<?php
/**
 * Funções de segurança e limpeza do WordPress
 */

// Remove a versão do WordPress
function dev9_remove_version() {
    return '';
}
add_filter('the_generator', 'dev9_remove_version');

// Remove links RSD (Really Simple Discovery)
remove_action('wp_head', 'rsd_link');

// Remove o link do Windows Live Writer
remove_action('wp_head', 'wlwmanifest_link');

// Remove os shortlinks dos posts
remove_action('wp_head', 'wp_shortlink_wp_head');

// Remove a API REST do cabeçalho
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

// Remove os emojis
function dev9_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    
    // Remove o suporte a emojis no TinyMCE
    add_filter('tiny_mce_plugins', 'dev9_disable_emojis_tinymce');
    
    // Remove o suporte a emojis no DNS prefetch
    add_filter('emoji_svg_url', '__return_false');
}
add_action('init', 'dev9_disable_emojis');

// Remove o suporte a emojis no editor TinyMCE
function dev9_disable_emojis_tinymce($plugins) {
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}

// Remove a tag meta do WordPress
remove_action('wp_head', 'wp_generator');

// Remove o link de feed dos posts
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);

// Remove o link de comentários
add_filter('feed_links_show_comments_feed', '__return_false');

// Desabilita o editor de arquivos no painel administrativo
define('DISALLOW_FILE_EDIT', true);

// Remove a barra de administração para usuários não administradores
function dev9_remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'dev9_remove_admin_bar');

// Remove a versão do WordPress dos arquivos CSS e JS
function dev9_remove_wp_version_strings($src) {
    global $wp_version;
    
    if (strpos($src, 'ver=' . $wp_version) !== false) {
        $src = remove_query_arg('ver', $src);
    }
    
    return $src;
}
add_filter('script_loader_src', 'dev9_remove_wp_version_strings', 15, 1);
add_filter('style_loader_src', 'dev9_remove_wp_version_strings', 15, 1);

// Remove a versão do WordPress do rodapé do painel administrativo
function dev9_remove_footer_version() {
    remove_filter('update_footer', 'core_update_footer');
}
add_action('admin_menu', 'dev9_remove_footer_version');

// Desativa a atualização automática de plugins e temas
add_filter('auto_update_plugin', '__return_false');
add_filter('auto_update_theme', '__return_false');

// Desativa as atualizações automáticas de traduções
add_filter('auto_update_translation', '__return_false');

// Remove a mensagem de atualização do WordPress
function dev9_remove_update_notice() {
    remove_action('admin_notices', 'update_nag', 3);
}
add_action('admin_head', 'dev9_remove_update_notice', 1);

// Remove a versão do WordPress do cabeçalho HTML
function dev9_remove_version() {
    return '';
}
add_filter('the_generator', 'dev9_remove_version');

// Remove os estilos do bloco do Gutenberg do frontend
function dev9_disable_gutenberg_styles() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style');
    wp_dequeue_style('global-styles');
}
add_action('wp_enqueue_scripts', 'dev9_disable_gutenberg_styles', 100);

// Remove os estilos do Gutenberg do editor
function dev9_disable_gutenberg_editor_styles() {
    wp_dequeue_style('wp-edit-blocks');
    wp_dequeue_style('wp-edit-post');
    wp_dequeue_style('wp-format-library');
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wp-components');
    wp_dequeue_style('wp-block-editor');
    wp_dequeue_style('wp-format-library');
}
add_action('enqueue_block_editor_assets', 'dev9_disable_gutenberg_editor_styles', 100);

// Remove os scripts do Gutenberg
function dev9_disable_gutenberg_scripts() {
    wp_dequeue_script('wp-embed');
    wp_deregister_script('wp-embed');
}
add_action('wp_footer', 'dev9_disable_gutenberg_scripts');

// Remove os estilos do WooCommerce
function dev9_disable_woocommerce_styles($styles) {
    if (class_exists('WooCommerce')) {
        unset($styles['woocommerce-general']);
        unset($styles['woocommerce-layout']);
        unset($styles['woocommerce-smallscreen']);
    }
    return $styles;
}
add_filter('woocommerce_enqueue_styles', 'dev9_disable_woocommerce_styles');

// Remove a barra de ferramentas do WordPress (admin bar) para usuários não logados
add_filter('show_admin_bar', '__return_false');

// Remove a tag meta do WordPress
remove_action('wp_head', 'wp_generator');

// Remove os links de feed
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);

// Remove o link de comentários
add_filter('feed_links_show_comments_feed', '__return_false');

// Remove a tag meta do WordPress
remove_action('wp_head', 'wp_generator');

// Remove os links de feed
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);

// Remove o link de comentários
add_filter('feed_links_show_comments_feed', '__return_false');

// Remove a tag meta do WordPress
remove_action('wp_head', 'wp_generator');

// Remove os links de feed
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);

// Remove o link de comentários
add_filter('feed_links_show_comments_feed', '__return_false');

// Remove a tag meta do WordPress
remove_action('wp_head', 'wp_generator');

// Remove os links de feed
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);

// Remove o link de comentários
add_filter('feed_links_show_comments_feed', '__return_false');

// Remove a tag meta do WordPress
remove_action('wp_head', 'wp_generator');

// Remove os links de feed
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);

// Remove o link de comentários
add_filter('feed_links_show_comments_feed', '__return_false');
