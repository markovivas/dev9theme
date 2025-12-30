<?php
/**
 * O template para exibir páginas de erro 404 (não encontrada).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package small-apps
 */

get_header();
?>

<div class="container text-center py-5">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<h1 class="display-1 fw-bold text-primary">404</h1>
			<h2 class="display-4"><?php esc_html_e( 'Oops! Página não encontrada.', 'small-apps' ); ?></h2>
			<p class="lead">
				<?php esc_html_e( 'A página que você está procurando pode ter sido removida, seu nome alterado ou está temporariamente indisponível.', 'small-apps' ); ?>
			</p>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary btn-lg mt-3">
				<?php esc_html_e( 'Voltar para a Página Inicial', 'small-apps' ); ?>
			</a>

			<div class="mt-5">
				<p><?php esc_html_e( 'Ou tente uma nova busca:', 'small-apps' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>
</div><!-- .container -->

<?php
get_footer();