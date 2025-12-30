<?php
/**
 * O template para exibir os resultados da busca.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package small-apps
 */

get_header();
?>

<div class="container py-5">
	<header class="page-header mb-5">
		<h1 class="page-title display-5">
			<?php
			/* translators: %s: search query. */
			printf( esc_html__( 'Resultados da busca por: %s', 'small-apps' ), '<span class="text-primary">' . get_search_query() . '</span>' );
			?>
		</h1>
	</header><!-- .page-header -->

	<?php if ( have_posts() ) : ?>

		<?php
		// Inicia o Loop.
		while ( have_posts() ) :
			the_post();
		?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'mb-5' ); ?>>
				<div class="row g-4 align-items-center">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="col-md-4">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'large', array( 'class' => 'img-fluid rounded' ) ); ?>
							</a>
						</div>
					<?php endif; ?>

					<div class="col-md-<?php echo has_post_thumbnail() ? '8' : '12'; ?>">
						<header class="entry-header">
							<?php the_title( sprintf( '<h2 class="entry-title h4"><a href="%s" rel="bookmark" class="text-decoration-none">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
						</header>
						<div class="entry-meta mb-2">
							<small class="text-muted"><?php echo get_the_date(); ?> &bull; <?php the_author(); ?></small>
						</div>
						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div>
					</div>
				</div>
			</article>
		<?php endwhile; ?>

		<nav class="d-flex justify-content-center">
			<?php
			the_posts_pagination(); // A função auxiliar em functions.php irá estilizar isso.
			?>
		</nav>

	<?php else : ?>
		<p><?php _e( 'Nenhum resultado encontrado para sua busca. Tente novamente com outros termos.', 'small-apps' ); ?></p>
		<?php get_search_form(); ?>
	<?php endif; ?>

</div><!-- .container -->

<?php
get_footer();