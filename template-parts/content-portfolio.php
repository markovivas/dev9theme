<?php
/**
 * Template part para exibir a seção "Galeria de Projetos" na página inicial.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package small-apps
 */
?>

<section id="portfolio" class="portfolio-section py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col">
                <h2 class="display-6"><?php echo esc_html( get_theme_mod( 'portfolio_main_title', __( 'Nossos Projetos', 'small-apps' ) ) ); ?></h2>
                <p class="lead"><?php echo wp_kses_post( get_theme_mod( 'portfolio_main_subtitle', __( 'Confira alguns dos aplicativos que desenvolvemos.', 'small-apps' ) ) ); ?></p>
            </div>
        </div>
        <div class="row">
            <?php
            $args = array(
                'post_type'      => 'projeto',
                'posts_per_page' => 3, // Exibe os 3 projetos mais recentes. Mude para -1 para exibir todos.
                'orderby'        => 'date',
                'order'          => 'DESC',
            );

            $project_query = new WP_Query( $args );

            if ( $project_query->have_posts() ) :
                while ( $project_query->have_posts() ) :
                    $project_query->the_post();

                    // Pega a URL externa do custom field.
                    $external_url = get_post_meta( get_the_ID(), '_project_url_key', true );
                    // Se a URL externa não estiver vazia, usa-a. Caso contrário, usa o permalink.
                    $card_url = ! empty( $external_url ) ? $external_url : get_permalink();
            ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <a href="<?php echo esc_url( $card_url ); ?>" class="project-card-link">
                        <div class="project-card-v2">
                            <?php if ( has_post_thumbnail() ) :
                                $image_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                            ?>
                                <div class="project-card-v2-image" style="background-image: url('<?php echo esc_url( $image_url ); ?>');"></div>
                            <?php else : // Fallback se não houver imagem ?>
                                <div class="project-card-v2-image project-card-v2-image-fallback"></div>
                            <?php endif; ?>
                            <div class="project-card-v2-content">
                                <h5 class="project-card-v2-title"><?php the_title(); ?></h5>
                                <div class="project-card-v2-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
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