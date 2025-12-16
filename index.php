<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TechConsult
 */

get_header();
?>

<div class="container main-content-container">

	<?php if (have_posts()) : ?>

		<div class="posts-list">
			<?php
			/* Inicia o Loop */
			while (have_posts()) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
					<header class="entry-header">
						<?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
					</header>

					<?php if (has_post_thumbnail()) : ?>
						<div class="post-thumbnail">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('thumbnail'); ?>
							</a>
						</div>
					<?php endif; ?>

					<div class="entry-summary">
						<?php the_excerpt(); ?>
					</div>
				</article>
			<?php
			endwhile;
			?>
		</div>

		<?php the_posts_pagination(); ?>

	<?php else :
		get_template_part('template-parts/content', 'none');
	endif;
	?>
</div>

<?php
get_footer();