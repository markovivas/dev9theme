<?php
/**
 * Funções de configuração do tema.
 *
 * @package TechConsult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'techconsult_setup' ) ) :
	/**
	 * Configura os padrões do tema e registra o suporte para várias funcionalidades do WordPress.
	 */
	function techconsult_setup() {
		// Suporte a tradução.
		load_theme_textdomain( 'techconsult', get_template_directory() . '/languages' );

		// Adiciona links de feed RSS de posts e comentários no head.
		add_theme_support( 'automatic-feed-links' );

		// Permite que o WordPress gerencie o título do documento.
		add_theme_support( 'title-tag' );

		// Habilita o suporte para Imagens Destacadas (Post Thumbnails) em posts e páginas.
		add_theme_support( 'post-thumbnails' );

		// Registra os locais dos menus de navegação.
		register_nav_menus(
			array(
				'menu-principal' => esc_html__( 'Menu Principal', 'techconsult' ),
				'menu-rodape'    => esc_html__( 'Menu Rodapé', 'techconsult' ),
			)
		);

		// Habilita o suporte para HTML5 em formulários, comentários, etc.
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

		// Configura o suporte para o Custom Logo.
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 100,
				'width'       => 400,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);

		// Adiciona suporte para estilos do editor Gutenberg.
		add_theme_support( 'editor-styles' );
		add_editor_style( 'assets/css/editor-style.css' );

		// Adiciona suporte para alinhamento amplo (wide) e completo (full) no Gutenberg.
		add_theme_support( 'align-wide' );

		// Adiciona suporte para embeds responsivos.
		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'techconsult_setup' );