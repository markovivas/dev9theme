<?php
/**
 * Configura os padrões do tema e registra o suporte para várias funcionalidades do WordPress.
 * 
 * Função principal de setup do tema, adiciona suporte a recursos e registra menus.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Evita acesso direto.
}

if ( ! function_exists( 'techconsult_setup' ) ) :
	function techconsult_setup() {
		// Suporte a tradução.
		load_theme_textdomain( 'techconsult', get_template_directory() . '/languages' );

		// Feed automático.
		add_theme_support( 'automatic-feed-links' );

		// Título via WordPress.
		add_theme_support( 'title-tag' );

		// Imagens destacadas.
		add_theme_support( 'post-thumbnails' );

		// Menus.
		register_nav_menus(
			array(
				'menu-principal' => esc_html__( 'Menu Principal', 'techconsult' ),
				'menu-rodape'    => esc_html__( 'Menu Rodapé', 'techconsult' ),
			)
		);

		// HTML5.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Custom Logo.
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 100,
				'width'       => 400,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);

		// Estilos do editor.
		add_theme_support( 'editor-styles' );
		add_editor_style( 'assets/css/editor-style.css' );

		// Wide/full align.
		add_theme_support( 'align-wide' );

		// Embeds responsivos.
		add_theme_support( 'responsive-embeds' );
	}
endif;

add_action( 'after_setup_theme', 'techconsult_setup' );