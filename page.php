<?php
/**
 * The template for displaying all pages
 *
 * @package TechConsult
 */

get_header();
?>

<div class="container main-content-container">
    <div class="content-area">
        <main id="main" class="site-main">

            <?php
            while (have_posts()) :
                the_post();
            ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('page-article'); ?>>
                    <header class="entry-header">
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                    </header>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>

            <?php endwhile; // End of the loop. ?>

        </main>
    </div>
    <?php get_sidebar(); ?>
</div>

<?php
get_footer();