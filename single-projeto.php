<?php
/**
 * O template para exibir um único post do tipo "Projeto".
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package small-apps
 */

get_header();
?>

<div class="container py-5">
    <?php
    while ( have_posts() ) :
        the_post();
    ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="row">
                <div class="col-lg-7">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="mb-4">
                            <?php the_post_thumbnail( 'large', array( 'class' => 'img-fluid rounded shadow-sm' ) ); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-5">
                    <header class="entry-header">
                        <?php the_title( '<h1 class="entry-title display-5">', '</h1>' ); ?>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <?php
                        the_content();

                        // Pega a URL externa do custom field.
                        $external_url = get_post_meta( get_the_ID(), '_project_url_key', true );

                        if ( ! empty( $external_url ) ) :
                        ?>
                            <a href="<?php echo esc_url( $external_url ); ?>" class="btn btn-success btn-lg mt-4" target="_blank" rel="noopener noreferrer">
                                <i class="bi bi-box-arrow-up-right me-2"></i><?php _e( 'Visitar Projeto', 'small-apps' ); ?>
                            </a>
                        <?php endif; ?>
                    </div><!-- .entry-content -->
                </div>
            </div>
        </article><!-- #post-<?php the_ID(); ?> -->
    <?php
    endwhile; // Fim do loop.
    ?>
</div><!-- .container -->

<?php
get_footer();