<?php
/**
 * Template part para exibir a seção de "Últimas Notícias" na página inicial.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package small-apps
 */
?>

<section id="blog" class="blog-section py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col">
                <h2 class="display-6"><?php _e( 'Últimas Notícias', 'small-apps' ); ?></h2>
                <p class="lead"><?php _e( 'Fique por dentro das nossas novidades e artigos.', 'small-apps' ); ?></p>
            </div>
        </div>
        <div class="row">
            <?php
            $args = array(
                'post_type'           => 'post',
                'posts_per_page'      => 3,
                'ignore_sticky_posts' => 1, // Ignora posts fixos para não aparecerem duplicados.
            );

            $blog_query = new WP_Query( $args );

            if ( $blog_query->have_posts() ) :
                while ( $blog_query->have_posts() ) :
                    $blog_query->the_post();
            ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <a href="<?php the_permalink(); ?>" class="blog-card-link">
                        <div class="card h-100 blog-card">
                            <div class="card-body">
                                <h5 class="card-title blog-card-title"><?php the_title(); ?></h5>
                            </div>
                            <?php if ( has_post_thumbnail() ) :
                                $image_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                            ?>
                                <div class="blog-card-image" style="background-image: url('<?php echo esc_url( $image_url ); ?>');"></div>
                            <?php else : ?>
                                <div class="blog-card-image blog-card-image-fallback"></div>
                            <?php endif; ?>
                            <div class="card-body">
                                <div class="card-text"><?php the_excerpt(); ?></div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php
                endwhile;
                wp_reset_postdata(); // Restaura os dados do post original.
            endif;
            ?>
        </div>
    </div>
</section>