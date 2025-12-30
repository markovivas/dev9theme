<?php
/**
 * Template part para exibir a seção "Sobre Nós" na página inicial.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package small-apps
 */
?>

<section id="about" class="about-section py-5 bg-light">
    <div class="container">
        <div class="row align-items-center g-lg-5">
            <!-- Coluna da Imagem -->
            <?php
            $about_image_url = get_theme_mod( 'about_section_image', 'https://placehold.co/600x400/EFEFEF/333?text=Nossa+Equipe' );
            if ( ! empty( $about_image_url ) ) :
            ?>
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="<?php echo esc_url( $about_image_url ); ?>" class="img-fluid rounded shadow" alt="<?php echo esc_attr( get_theme_mod( 'about_section_title', 'Sobre o Nosso Projeto' ) ); ?>">
                </div>
            <?php endif; ?>

            <!-- Coluna do Texto -->
            <div class="col-lg-6">
                <h2 class="display-6"><?php echo esc_html( get_theme_mod( 'about_section_title', __( 'Sobre o Nosso Projeto', 'small-apps' ) ) ); ?></h2>
                <p class="lead"><?php echo wp_kses_post( get_theme_mod( 'about_section_lead', __( 'Somos uma equipe apaixonada por desenvolvimento e design, dedicada a criar soluções digitais que fazem a diferença.', 'small-apps' ) ) ); ?></p>
                <p><?php echo wp_kses_post( get_theme_mod( 'about_section_text', __( 'Este projeto é uma coleção de pequenos aplicativos desenvolvidos para aprimorar e demonstrar nossas habilidades em diversas tecnologias web.', 'small-apps' ) ) ); ?></p>
                <ul class="list-unstyled mt-4">
                    <?php for ( $i = 1; $i <= 3; $i++ ) : ?>
                        <?php
                        $item_text = get_theme_mod( "about_section_item_{$i}" );
                        // Define valores padrão se estiverem vazios
                        if ( empty( $item_text ) ) {
                            $defaults = [ 'Código limpo e moderno', 'Design responsivo com Bootstrap 5', 'Integrado com as melhores práticas do WordPress' ];
                            $item_text = $defaults[ $i - 1 ];
                        }
                        ?>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-primary me-2"></i><?php echo esc_html( $item_text ); ?>
                        </li>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
    </div>
</section>