<?php
/**
 * Template Name: Página em Tela Cheia
 *
 * Este template remove o container principal, permitindo que o conteúdo
 * se estenda por toda a largura da tela. O cabeçalho e o rodapé são mantidos.
 *
 * @package small-apps
 */

get_header();
?>

<div class="content-full-width">
	<?php
	while ( have_posts() ) :
		the_post();

		// Exibe o conteúdo da página diretamente.
		// Blocos do editor podem agora controlar seu próprio alinhamento (padrão, largo, tela cheia).
		the_content();

	endwhile; // Fim do loop.
	?>
</div><!-- .content-full-width -->

<?php
get_footer();