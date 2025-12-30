<?php
/**
 * O template para exibir todas as páginas estáticas.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-page
 *
 * @package small-apps
 */

get_header();
?>

<div class="container py-5">
	<div class="row">
		<div class="col">
			<?php
			while ( have_posts() ) :
				the_post();
			?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header mb-4">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php
						the_content();

						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Páginas:', 'small-apps' ),
							'after'  => '</div>',
						) );
						?>
					</div><!-- .entry-content -->
				</article><!-- #post-<?php the_ID(); ?> -->
			<?php endwhile; // Fim do loop. ?>
		</div><!-- .col -->
	</div><!-- .row -->
</div><!-- .container -->

<?php
get_footer();