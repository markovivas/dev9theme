<?php
/**
 * O template para exibir todos os posts individuais (blog).
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package small-apps
 */

get_header();
?>

<div class="container py-5">
	<div class="row justify-content-center">
		<div class="col-lg-8">
			<?php
			while ( have_posts() ) :
				the_post();
			?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header mb-4">
						<?php the_title( '<h1 class="entry-title display-5 mb-3">', '</h1>' ); ?>

						<div class="entry-meta text-muted">
							<span><?php echo get_the_date(); ?></span>
							<span class="mx-2">&bull;</span>
							<span><?php _e( 'Por', 'small-apps' ); ?> <?php the_author_posts_link(); ?></span>
						</div><!-- .entry-meta -->
					</header><!-- .entry-header -->

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="post-thumbnail my-4">
							<?php the_post_thumbnail( 'large', array( 'class' => 'img-fluid rounded' ) ); ?>
						</div><!-- .post-thumbnail -->
					<?php endif; ?>

					<div class="entry-content">
						<?php
						the_content();

						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Páginas:', 'small-apps' ),
							'after'  => '</div>',
						) );
						?>
					</div><!-- .entry-content -->

					<footer class="entry-footer mt-4 pt-4 border-top">
						<div class="post-tags">
							<?php the_tags( '<span class="badge bg-secondary me-1">', '</span><span class="badge bg-secondary me-1">', '</span>' ); ?>
						</div>
					</footer><!-- .entry-footer -->

				</article><!-- #post-<?php the_ID(); ?> -->

				<?php
				// Navegação para post anterior/seguinte.
				the_post_navigation();

				// Se os comentários estiverem abertos ou se tivermos pelo menos um comentário, carrega o template de comentários.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // Fim do loop.
			?>
		</div><!-- .col -->
	</div><!-- .row -->
</div><!-- .container -->

<?php
get_footer();