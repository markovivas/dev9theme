<?php
/**
 * The template for displaying all single posts
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

                <article id="post-<?php the_ID(); ?>" <?php post_class('single-post-article'); ?>>
                    <header class="entry-header">
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

                        <div class="entry-meta">
                            <span class="meta-author"><?php echo get_the_author(); ?></span>
                            <span class="meta-date"><?php echo get_the_date(); ?></span>
                            <span class="meta-category"><?php the_category(', '); ?></span>
                        </div>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail-single">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'techconsult'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>

                    <footer class="entry-footer">
                        <?php the_tags('<span class="tag-links">', ' ', '</span>'); ?>
                    </footer>
                </article>

                <?php
                // Se os comentários estiverem abertos, exibe o template de comentários.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>

        </main>
    </div>
    <?php get_sidebar(); ?>
</div>

<?php
get_footer();