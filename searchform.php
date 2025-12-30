<?php
/**
 * Template para exibir o formulário de busca personalizado com Bootstrap 5.
 *
 * @package small-apps
 */
?>

<form role="search" method="get" class="d-flex" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="visually-hidden" for="s"><?php _e( 'Buscar por:', 'small-apps' ); ?></label>
	<input type="search" id="s" class="form-control me-2" placeholder="<?php esc_attr_e( 'Pesquisar...', 'small-apps' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="btn btn-outline-primary btn-search-nav"><?php _e( 'Buscar', 'small-apps' ); ?></button>
</form>