<?php
/**
 * Template part para exibir a seção de recursos na página inicial.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package small-apps
 */
?>

<section id="features" class="features-section py-5" style="background-color: #E8F1F2;">
    <div class="container">
        <div class="row text-center mb-4">
            <div class="col">
                <h2><?php echo esc_html( get_theme_mod( 'features_main_title', 'Recursos Principais' ) ); ?></h2>
                <p class="lead"><?php echo esc_html( get_theme_mod( 'features_main_subtitle', 'Descubra o que nossas soluções podem fazer por você.' ) ); ?></p>
            </div>
        </div>
        <div class="row">
            <?php for ( $i = 1; $i <= 3; $i++ ) : ?>
                <?php
                    // Pega os valores do personalizador com valores padrão
                    $icon        = get_theme_mod( "feature_{$i}_icon", 'bi-speedometer2' );
                    $title       = get_theme_mod( "feature_{$i}_title", sprintf( __( 'Recurso %d', 'small-apps' ), $i ) );
                    $description = get_theme_mod( "feature_{$i}_description", __( 'Descrição breve sobre a funcionalidade e os benefícios deste incrível recurso.', 'small-apps' ) );
                    $url         = get_theme_mod( "feature_{$i}_url" );
                ?>
                <!-- Recurso <?php echo $i; ?> -->
                <div class="col-md-4 mb-4">
                    <div class="card feature-card h-100 text-center">
                        <div class="card-body">
                            <div class="feature-icon-wrapper mb-4">
                                <i class="bi <?php echo esc_attr( $icon ); ?> fs-2"></i>
                            </div>
                            <h5 class="card-title h4">
                                <?php if ( ! empty( $url ) ) : ?>
                                    <a href="<?php echo esc_url( $url ); ?>" class="stretched-link text-decoration-none"><?php echo esc_html( $title ); ?></a>
                                <?php else : ?>
                                    <?php echo esc_html( $title ); ?>
                                <?php endif; ?>
                            </h5>
                            <p class="card-text"><?php echo wp_kses_post( $description ); ?></p>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section>