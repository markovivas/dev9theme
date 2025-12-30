<?php
/**
 * Template part para exibir a seção de Depoimentos na página inicial.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package small-apps
 */
?>

<section id="testimonials" class="testimonials-section py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col">
                <h2 class="display-6"><?php _e( 'O Que Nossos Clientes Dizem', 'small-apps' ); ?></h2>
                <p class="lead"><?php _e( 'A satisfação de quem usa nossas soluções é a nossa maior recompensa.', 'small-apps' ); ?></p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <?php
                $args = array(
                    'post_type'      => 'depoimento',
                    'posts_per_page' => -1, // Exibe todos os depoimentos.
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                );
                $testimonial_query = new WP_Query( $args );
                if ( $testimonial_query->have_posts() ) :
                ?>
                    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            $item_count = 0;
                            while ( $testimonial_query->have_posts() ) :
                                $testimonial_query->the_post();
                                $role = get_post_meta( get_the_ID(), '_testimonial_role_key', true );
                            ?>
                                <div class="carousel-item <?php echo ( 0 === $item_count ) ? 'active' : ''; ?>">
                                    <div class="testimonial-card text-center p-4">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <?php the_post_thumbnail( 'thumbnail', array( 'class' => 'rounded-circle mb-3', 'width' => 100, 'height' => 100 ) ); ?>
                                        <?php endif; ?>
                                        <blockquote class="blockquote">
                                            <?php the_content(); // Usamos the_content() para o texto do depoimento ?>
                                        </blockquote>
                                        <footer class="blockquote-footer mt-3"><?php the_title(); // Usamos o título para o nome do autor ?>
                                            <?php if ( ! empty( $role ) ) : ?>
                                                <cite title="<?php echo esc_attr( $role ); ?>"><?php echo esc_html( $role ); ?></cite>
                                            <?php endif; ?>
                                        </footer>
                                    </div>
                                </div>
                            <?php
                                $item_count++;
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Próximo</span>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>