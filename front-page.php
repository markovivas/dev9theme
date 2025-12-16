<?php get_header(); ?>

<?php
// Usar valores do Customizer com fallback.
$default_hero_title = __('A tecnologia é o caminho para transformar ideias em resultados', 'techconsult');
$default_hero_description = __('Somos especialistas em soluções digitais que impulsionam o crescimento do seu negócio com inovação e excelência.', 'techconsult');

$hero_title = get_theme_mod('hero_title', $default_hero_title);
$hero_description = get_theme_mod('hero_description', $default_hero_description);
$hero_image_url = get_theme_mod('hero_image', ''); // Pega a URL da imagem do Customizer.
?>
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <h1><?php echo esc_html($hero_title); ?></h1>
                <p><?php echo esc_html($hero_description); ?></p>
                <a href="#servicos" class="btn-primary"><?php esc_html_e('Saiba Mais', 'techconsult'); ?></a>
            </div>
            <?php 
            if (!empty($hero_image_url)) :
                $hero_image_id = attachment_url_to_postid($hero_image_url);
            ?>
                <div class="hero-image">
                    <?php // Exibe a imagem no tamanho 'hero-image' (1920x700) que definimos. ?>
                    <?php echo wp_get_attachment_image($hero_image_id, 'hero-image', false, ['alt' => esc_attr__('Soluções em Tecnologia', 'techconsult')]); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Serviços -->
<section id="servicos" class="services-section">
    <div class="container">
        <div class="section-title">
            <h2><?php esc_html_e('Nossos Serviços', 'techconsult'); ?></h2>
            <p><?php esc_html_e('Soluções completas para o seu negócio digital', 'techconsult'); ?></p>
        </div>
        
        <div class="services-grid">
            <?php
            for ($i = 1; $i <= 4; $i++) :
                $title = get_theme_mod("service_title_{$i}");
                $description = get_theme_mod("service_description_{$i}");
                $icon = get_theme_mod("service_icon_{$i}", 'fa-solid fa-star');
                $link = get_theme_mod("service_link_{$i}", '#');

                // Só exibe o card se o título estiver preenchido
                if (!empty($title)) :
            ?>
                    <a href="<?php echo esc_url($link); ?>" class="service-card-link">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="<?php echo esc_attr($icon); ?>"></i>
                            </div>
                            <h3><?php echo esc_html($title); ?></h3>
                            <p><?php echo esc_html($description); ?></p>
                        </div>
                    </a>
            <?php
                endif;
            endfor;
            ?>
        </div>
    </div>
</section>

<!-- Sobre -->
<section class="about-section">
    <div class="container">
        <div class="about-content">
            <div class="about-image">
                <?php
                $about_image_url = get_theme_mod('about_image', get_template_directory_uri() . '/assets/images/about-image.jpg');
                if (!empty($about_image_url)) : ?>
                    <img src="<?php echo esc_url($about_image_url); ?>" alt="<?php esc_attr_e('Sobre nós', 'techconsult'); ?>">
                <?php endif; ?>
            </div>
            <div class="about-text">
                <h2><?php echo esc_html(get_theme_mod('about_title', __('Empresa confiável e profissional em soluções de TI', 'techconsult'))); ?></h2>
                <p><?php echo esc_html(get_theme_mod('about_description', __('Com mais de 10 anos de experiência no mercado, entregamos soluções tecnológicas inovadoras que transformam negócios e geram resultados tangíveis.', 'techconsult'))); ?></p>
                
                <?php
                $features_string = get_theme_mod('about_features', "Garantia de satisfação\nSuporte especializado 24/7\nMetodologias ágeis\nEquipe certificada");
                $features = explode("\n", $features_string);
                if (!empty($features)) : ?>
                    <ul class="diferenciais-list">
                        <?php foreach ($features as $feature) :
                            $feature = trim($feature);
                            if (!empty($feature)) : ?>
                                <li><?php echo esc_html($feature); ?></li>
                            <?php endif;
                        endforeach; ?>
                    </ul>
                <?php endif; ?>
                
                <a href="<?php echo esc_url(home_url('/sobre')); ?>" class="btn-primary">
                    <?php esc_html_e('Leia Mais', 'techconsult'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Estatísticas -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <?php
            for ($i = 1; $i <= 4; $i++) :
                $value = get_theme_mod("stat_{$i}_value");
                $label = get_theme_mod("stat_{$i}_label");

                // Só exibe o item se o valor estiver preenchido
                if (!empty($value)) :
            ?>
                    <div class="stat-item">
                        <h3><?php echo esc_html($value); ?></h3>
                        <p><?php echo esc_html($label); ?></p>
                    </div>
            <?php
                endif;
            endfor;
            ?>
        </div>
    </div>
</section>

<!-- Portfólio -->
<section class="portfolio-section">
    <div class="container">
        <div class="section-title">
            <h2><?php esc_html_e('Projetos Recentes', 'techconsult'); ?></h2>
            <p><?php esc_html_e('Conheça alguns dos nossos trabalhos', 'techconsult'); ?></p>
        </div>
        
        <div class="portfolio-grid">
            <?php
            $portfolio_items = array(
                array(
                    'title' => __('Conhecimento Empresarial', 'techconsult'),
                    'desc'  => __('Sistema de gestão do conhecimento', 'techconsult'),
                ),
                array(
                    'title' => __('Relacionamento com Clientes', 'techconsult'),
                    'desc'  => __('Plataforma de CRM personalizada', 'techconsult'),
                ),
                array(
                    'title' => __('Soluções Digitais', 'techconsult'),
                    'desc'  => __('E-commerce com integração completa', 'techconsult'),
                ),
                array(
                    'title' => __('Pesquisa de Mercado', 'techconsult'),
                    'desc'  => __('Ferramenta de análise de dados', 'techconsult'),
                ),
                array(
                    'title' => __('Investimentos Financeiros', 'techconsult'),
                    'desc'  => __('Dashboard para gestão financeira', 'techconsult'),
                ),
                array(
                    'title' => __('Processos de UI/UX', 'techconsult'),
                    'desc'  => __('Redesign de experiência do usuário', 'techconsult'),
                ),
            );
            
            foreach ($portfolio_items as $item) :
            ?>
            <div class="portfolio-item">
                <div class="portfolio-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/project-placeholder.jpg" alt="<?php echo esc_attr($item['title']); ?>">
                </div>
                <div class="portfolio-content">
                    <h3><?php echo esc_html($item['title']); ?></h3>
                    <p><?php echo esc_html($item['desc']); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Últimas Notícias -->
<section class="latest-news-section">
    <div class="container">
        <div class="section-title">
            <h2><?php esc_html_e('Últimas Notícias', 'techconsult'); ?></h2>
            <p><?php esc_html_e('Conheça alguns dos nossos trabalhos', 'techconsult'); ?></p>
        </div>

        <div class="news-grid">
            <?php
            $latest_posts_args = array(
                'post_type'           => 'post',
                'posts_per_page'      => 6,
                'ignore_sticky_posts' => 1,
            );

            $latest_posts_query = new WP_Query($latest_posts_args);

            if ($latest_posts_query->have_posts()) :
                while ($latest_posts_query->have_posts()) : $latest_posts_query->the_post();
            ?>
                    <article class="news-item">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="news-image">
                                <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
                                    <?php the_post_thumbnail('medium_large'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="news-content">
                            <h3 class="news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="news-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    </article>
            <?php
                endwhile;
                wp_reset_postdata(); // Restaura os dados do post original
            endif;
            ?>
        </div>

        <div class="section-cta" style="text-align: center; margin-top: 40px;">
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn-primary"><?php esc_html_e('Ver mais notícias', 'techconsult'); ?></a>
        </div>
    </div>
</section>

<!-- Contato -->
<section class="contact-section">
    <div class="container">
        <div class="section-title">
            <h2><?php esc_html_e('Solicite uma consultoria gratuita', 'techconsult'); ?></h2>
            <p><?php esc_html_e('Entre em contato e descubra como podemos ajudar seu negócio', 'techconsult'); ?></p>
        </div>
        
        <div class="contact-form">
            <?php if (shortcode_exists('contact-form-7')) : ?>
                <?php echo do_shortcode('[contact-form-7 id="123" title="Formulário de Contato"]'); // O ID do formulário pode precisar ser ajustado ?>
            <?php else : ?>
                <?php if (current_user_can('manage_options')) : // Mostra a mensagem apenas para administradores ?>
                    <p style="text-align: center; border: 1px solid #ff0000; padding: 10px; color: #ff0000;">
                        <?php esc_html_e('Para exibir o formulário, por favor, instale e ative o plugin Contact Form 7.', 'techconsult'); ?>
                    </p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>