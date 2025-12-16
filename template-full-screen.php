<?php
/**
 * Template Name: Layout Tela Cheia
 * Template Post Type: page
 *
 * @package TechConsult
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container-fluid main-content-container">
        <div class="content-area-full">

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

        </div>
    </div>
</main>

<?php
get_footer();