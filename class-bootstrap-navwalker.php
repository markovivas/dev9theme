<?php
/**
 * Classe WP Bootstrap Navwalker
 *
 * @package WP-Bootstrap-Navwalker
 */

if ( ! class_exists( 'Bootstrap_Nav_Walker' ) ) {
	/**
	 * Classe para gerar um menu de navegação do Bootstrap 5.
	 */
		class Bootstrap_Nav_Walker extends Walker_Nav_Menu {
			/**
			 * Define se o item possui filhos para uso nos métodos.
			 *
			 * @param mixed $element
			 * @param array $children_elements
			 * @param int   $max_depth
			 * @param int   $depth
			 * @param array $args
			 * @param string $output
			 */
			public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
				if ( ! $element ) {
					return;
				}
				$id_field = $this->db_fields['id'];
				// Sinaliza se o item possui filhos
				$has_children = ! empty( $children_elements[ $element->$id_field ] );
				if ( is_object( $args[0] ) ) {
					$args[0]->has_children = $has_children;
				}
				// Continua o fluxo padrão
				parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
			}
			/**
			 * Inicia a lista de itens.
			 *
		 * @see Walker::start_lvl()
		 * @param string   $output            Usado para adicionar conteúdo à saída.
		 * @param int      $depth             Profundidade do item de menu. Padrão 0.
		 * @param stdClass $args              Objeto de argumentos.
		 */
		public function start_lvl( &$output, $depth = 0, $args = null ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent  = str_repeat( $t, $depth );
			$classes = array( 'dropdown-menu' );
			$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
			$output .= "{$n}{$indent}<ul class=\"" . esc_attr( $class_names ) . "\">{$n}";
		}

		/**
		 * Inicia o elemento do item.
		 *
		 * @see Walker::start_el()
		 * @param string   $output            Usado para adicionar conteúdo à saída.
		 * @param WP_Post  $item              Item do menu.
		 * @param int      $depth             Profundidade do item de menu. Padrão 0.
		 * @param stdClass $args              Objeto de argumentos.
		 * @param int      $id                ID do item de menu atual.
		 */
			public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

			$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
			if ( 0 === $depth ) {
				$classes[] = 'nav-item';
			}
			$classes[] = 'menu-item-' . $item->ID;

			if ( ! empty( $args->has_children ) && 0 === $depth ) {
				$classes[] = 'dropdown';
			}

			if ( in_array( 'current-menu-item', $classes, true ) || in_array( 'current-menu-parent', $classes, true ) ) {
				$classes[] = 'active';
			}

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $class_names . '>';

			$atts           = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target ) ? $item->target : '';
			$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
			$atts['href']   = ! empty( $item->url ) ? $item->url : '';

			$nav_link_class = ( 0 === $depth ) ? 'nav-link' : 'dropdown-item';
			if ( ! empty( $args->has_children ) && 0 === $depth ) {
				$nav_link_class .= ' dropdown-toggle';
				$atts['data-bs-toggle'] = 'dropdown';
				$atts['role'] = 'button';
				$atts['aria-expanded'] = 'false';
			}

			$atts['class'] = $nav_link_class;

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output  = $args->before;
			$item_output .= '<a' . $attributes . '>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
}

?>
