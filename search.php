<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package TechConsult
 */

get_header();
?>

<div class="container search-results-container">
	<header class="page-header">
		<h1 class="page-title">
			<?php
			/* translators: %s: search query. */
			printf(esc_html__('Resultados da busca por: %s', 'techconsult'), '<span>' . get_search_query() . '</span>');
			?>
		</h1>
	</header>

	<?php if (have_posts()) : ?>

		<div class="search-results-list">
			<?php
			/* Inicia o Loop */
			while (have_posts()) :
				the_post();
				/**
				 * Inclui o template part content-search.php.
				 * Se não existir, podemos criar um ou usar um padrão.
				 * Por agora, vamos replicar a estrutura do index.php para consistência.
				 */
				get_template_part('template-parts/content', get_post_type());
			endwhile;
			?>
		</div>

		<?php
		the_posts_pagination();
		?>

	<?php else :
		get_template_part('template-parts/content', 'none');
	endif;
	?>
</div>

<?php
get_footer();