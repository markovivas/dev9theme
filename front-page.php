<?php
/**
 * O template para exibir a página inicial.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package small-apps
 */

get_header();
?>

    <?php
    $hero_bg_image_url = get_theme_mod( 'hero_background_image' );
    $hero_style        = '';
    $hero_classes      = 'hero-section py-5 d-flex align-items-center'; // Removido text-center e outras classes de alinhamento

    if ( ! empty( $hero_bg_image_url ) ) { // Se houver imagem
        $hero_style = 'style="background-image: url(' . esc_url( $hero_bg_image_url ) . '); background-size: cover; background-position: center;"';
        $hero_classes .= ' text-white'; // Adiciona texto branco para melhor contraste
    } else { // Se NÃO houver imagem
        $hero_classes .= ' hero-default-background'; // Adiciona a classe do fundo azul
    }
    ?>

    <section class="<?php echo esc_attr( $hero_classes ); ?>" <?php echo $hero_style; ?> style="min-height: 80vh; position: relative;">
        <?php if ( ! empty( $hero_bg_image_url ) ) : ?>
            <div class="hero-overlay"></div>
        <?php endif; ?>
        <div class="container">
            <div class="row align-items-center">
                <!-- Coluna de Texto -->
                <div class="col-lg-6 text-center text-lg-start">
                    <div class="hero-content">
                        <h1 class="display-3"><?php echo esc_html( get_theme_mod( 'hero_title', 'Small Apps' ) ); ?></h1>
                        <p class="lead mb-4"><?php echo esc_html( get_theme_mod( 'hero_subtitle', 'Uma coleção de pequenos aplicativos para praticar suas habilidades.' ) ); ?></p>
                        <?php
                        $hero_button_text = get_theme_mod( 'hero_button_text', 'Começar' );
                        $hero_button_url  = get_theme_mod( 'hero_button_url', '#features' );

                        if ( ! empty( $hero_button_text ) ) :
                        ?>
                            <div class="hero-cta">
                                <a href="<?php echo esc_url( $hero_button_url ); ?>" class="btn btn-primary btn-lg"><?php echo esc_html( $hero_button_text ); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Coluna do Elemento Visual -->
                <div class="col-lg-6 d-none d-lg-flex justify-content-center">
                    <?php
                    $hero_visual_image_url = get_theme_mod( 'hero_visual_image' );
                    if ( ! empty( $hero_visual_image_url ) ) :
                    ?>
                        <img src="<?php echo esc_url( $hero_visual_image_url ); ?>" alt="<?php echo esc_attr( get_theme_mod( 'hero_title' ) ); ?>" class="img-fluid">
                    <?php else : ?>
                        <div class="hero-visual"></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php get_template_part( 'template-parts/content', 'features' ); ?>
<?php get_template_part( 'template-parts/content', 'about' ); ?>
<?php get_template_part( 'template-parts/content', 'portfolio' ); ?>
<?php get_template_part( 'template-parts/content', 'testimonials' ); ?>
<?php get_template_part( 'template-parts/content', 'contact' ); ?>
<?php get_template_part( 'template-parts/content', 'blog' ); ?>
<?php get_template_part( 'template-parts/content', 'cta' ); ?>

<?php
get_footer();
