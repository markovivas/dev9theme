<?php
/**
 * Template part for displaying the hero section
 *
 * @package TechConsult
 */

$hero_title = get_theme_mod('hero_title', __('A tecnologia é o caminho para transformar ideias em resultados', 'techconsult'));
$hero_description = get_theme_mod('hero_description', __('Somos especialistas em soluções digitais que impulsionam o crescimento do seu negócio com inovação e excelência.', 'techconsult'));
$hero_image_url = get_theme_mod('hero_image', get_template_directory_uri() . '/assets/images/hero-image.jpg');
?>

<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <h1><?php echo wp_kses_post($hero_title); ?></h1>
                <p><?php echo wp_kses_post($hero_description); ?></p>
                <a href="#servicos" class="btn-primary"><?php esc_html_e('Saiba Mais', 'techconsult'); ?></a>
            </div>
            <?php if (!empty($hero_image_url)) : ?>
                <div class="hero-image">
                    <img src="<?php echo esc_url($hero_image_url); ?>" alt="<?php esc_attr_e('Soluções em Tecnologia', 'techconsult'); ?>">
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>