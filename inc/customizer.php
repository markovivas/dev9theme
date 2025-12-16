<?php
/**
 * Customizer additions
 *
 * @package TechConsult
 */

function techconsult_customize_register($wp_customize) {
    // Seção de Configurações do Tema
    $wp_customize->add_section('techconsult_theme_options', array(
        'title'    => __('Configurações do Tema', 'techconsult'),
        'priority' => 30,
    ));

    // Hero Text
    $wp_customize->add_setting('hero_title', array(
        'default'           => __('A tecnologia é o caminho para transformar ideias em resultados', 'techconsult'),
        'sanitize_callback' => 'techconsult_sanitize_html',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('hero_title', array(
        'label'    => __('Título do Hero', 'techconsult'),
        'section'  => 'techconsult_theme_options',
        'type'     => 'textarea',
    ));

    // Hero Description
    $wp_customize->add_setting('hero_description', array(
        'default'           => __('Somos especialistas em soluções digitais que impulsionam o crescimento do seu negócio com inovação e excelência.', 'techconsult'),
        'sanitize_callback' => 'techconsult_sanitize_html',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('hero_description', array(
        'label'    => __('Descrição do Hero', 'techconsult'),
        'section'  => 'techconsult_theme_options',
        'type'     => 'textarea',
    ));

    // Hero Image
    $wp_customize->add_setting('hero_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_image', array(
        'label'    => __('Imagem do Hero', 'techconsult'),
        'section'  => 'techconsult_theme_options',
        'settings' => 'hero_image',
    )));

    // --- Seção Nossos Serviços ---
    $wp_customize->add_section('services_section', array(
        'title'    => __('Nossos Serviços', 'techconsult'),
        'priority' => 32,
    ));

    $services_defaults = array(
        1 => array('title' => __('Consultoria em TI', 'techconsult'), 'description' => __('Otimizamos sua infraestrutura tecnológica para maximizar resultados.', 'techconsult'), 'icon' => 'fa-solid fa-desktop'),
        2 => array('title' => __('Design UI/UX', 'techconsult'), 'description' => __('Criamos experiências digitais intuitivas e engajadoras para seus usuários.', 'techconsult'), 'icon' => 'fa-solid fa-palette'),
        3 => array('title' => __('Desenvolvimento Web', 'techconsult'), 'description' => __('Sites e sistemas web robustos, seguros e de alta performance.', 'techconsult'), 'icon' => 'fa-solid fa-code'),
        4 => array('title' => __('Segurança Cibernética', 'techconsult'), 'description' => __('Protegemos seus dados e sistemas contra as mais recentes ameaças digitais.', 'techconsult'), 'icon' => 'fa-solid fa-shield-halved'),
    );

    foreach ($services_defaults as $i => $defaults) {
        // Título do Serviço
        $wp_customize->add_setting("service_title_{$i}", array(
            'default'           => $defaults['title'],
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("service_title_{$i}", array(
            'label'    => sprintf(__('Título do Serviço %d', 'techconsult'), $i),
            'section'  => 'services_section',
            'type'     => 'text',
        ));

        // Descrição do Serviço
        $wp_customize->add_setting("service_description_{$i}", array(
            'default'           => $defaults['description'],
            'sanitize_callback' => 'sanitize_textarea_field',
        ));
        $wp_customize->add_control("service_description_{$i}", array(
            'label'    => sprintf(__('Descrição do Serviço %d', 'techconsult'), $i),
            'section'  => 'services_section',
            'type'     => 'textarea',
        ));

        // Ícone do Serviço (Font Awesome)
        $wp_customize->add_setting("service_icon_{$i}", array(
            'default'           => $defaults['icon'],
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("service_icon_{$i}", array(
            'label'       => sprintf(__('Ícone do Serviço %d', 'techconsult'), $i),
            'description' => __('Ex: fa-solid fa-desktop. Veja os ícones em fontawesome.com', 'techconsult'),
            'section'     => 'services_section',
            'type'        => 'text',
        ));

        // Link do Serviço
        $wp_customize->add_setting("service_link_{$i}", array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control("service_link_{$i}", array(
            'label'    => sprintf(__('Link do Serviço %d', 'techconsult'), $i),
            'section'  => 'services_section',
            'type'     => 'url',
        ));
    }


    // --- Seção Sobre ---
    $wp_customize->add_section('about_section', array(
        'title'    => __('Seção Sobre', 'techconsult'),
        'priority' => 35,
    ));

    // Título da Seção Sobre
    $wp_customize->add_setting('about_title', array(
        'default'           => __('Empresa confiável e profissional em soluções de TI', 'techconsult'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('about_title', array(
        'label'    => __('Título da Seção Sobre', 'techconsult'),
        'section'  => 'about_section',
        'type'     => 'text',
    ));

    // Descrição da Seção Sobre
    $wp_customize->add_setting('about_description', array(
        'default'           => __('Com mais de 10 anos de experiência no mercado, entregamos soluções tecnológicas inovadoras que transformam negócios e geram resultados tangíveis.', 'techconsult'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('about_description', array(
        'label'    => __('Descrição da Seção Sobre', 'techconsult'),
        'section'  => 'about_section',
        'type'     => 'textarea',
    ));

    // Lista de Diferenciais
    $wp_customize->add_setting('about_features', array(
        'default'           => "Garantia de satisfação\nSuporte especializado 24/7\nMetodologias ágeis\nEquipe certificada",
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('about_features', array(
        'label'       => __('Diferenciais (um por linha)', 'techconsult'),
        'section'     => 'about_section',
        'type'        => 'textarea',
    ));

    // Imagem da Seção Sobre
    $wp_customize->add_setting('about_image', array(
        'default'           => get_template_directory_uri() . '/assets/images/about-image.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_image', array(
        'label'    => __('Imagem da Seção Sobre', 'techconsult'),
        'section'  => 'about_section',
        'settings' => 'about_image',
    )));

    // --- Seção Estatísticas ---
    $wp_customize->add_section('stats_section', array(
        'title'    => __('Seção de Estatísticas', 'techconsult'),
        'priority' => 38,
    ));

    $stats_defaults = array(
        1 => array('value' => '+2.000', 'label' => __('Projetos Realizados', 'techconsult')),
        2 => array('value' => '+1.600', 'label' => __('Clientes Atendidos', 'techconsult')),
        3 => array('value' => '12', 'label' => __('Países Atendidos', 'techconsult')),
        4 => array('value' => '4.8', 'label' => __('Avaliação Média', 'techconsult')),
    );

    foreach ($stats_defaults as $i => $defaults) {
        // Valor da Estatística
        $wp_customize->add_setting("stat_{$i}_value", array(
            'default'           => $defaults['value'],
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("stat_{$i}_value", array(
            'label'    => sprintf(__('Valor da Estatística %d', 'techconsult'), $i),
            'section'  => 'stats_section',
            'type'     => 'text',
        ));

        // Rótulo da Estatística
        $wp_customize->add_setting("stat_{$i}_label", array(
            'default'           => $defaults['label'],
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("stat_{$i}_label", array(
            'label'    => sprintf(__('Rótulo da Estatística %d', 'techconsult'), $i),
            'section'  => 'stats_section',
            'type'     => 'text',
        ));
    }


    // Cores Principais
    $wp_customize->add_setting('primary_color', array(
        'default'           => '#F2B705',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label'    => __('Cor de Destaque (Botões)', 'techconsult'),
        'section'  => 'colors',
        'settings' => 'primary_color',
    )));

    // Cor de Fundo do Header
    $wp_customize->add_setting('header_bg_color', array(
        'default'           => '#132B4A',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_bg_color', array(
        'label'    => __('Cor do Header', 'techconsult'),
        'section'  => 'colors',
        'settings' => 'header_bg_color',
    )));

    // Informações de Contato
    $wp_customize->add_section('contact_info', array(
        'title'    => __('Informações de Contato', 'techconsult'),
        'priority' => 40,
    ));

    $wp_customize->add_setting('contact_phone', array(
        'default'           => '(11) 9999-9999',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('contact_phone', array(
        'label'    => __('Telefone', 'techconsult'),
        'section'  => 'contact_info',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('contact_email', array(
        'default'           => 'contato@techconsult.com.br',
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('contact_email', array(
        'label'    => __('E-mail', 'techconsult'),
        'section'  => 'contact_info',
        'type'     => 'email',
    ));

    $wp_customize->add_setting('contact_address', array(
        'default'           => __('Av. Paulista, 1000 - São Paulo/SP', 'techconsult'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('contact_address', array(
        'label'    => __('Endereço', 'techconsult'),
        'section'  => 'contact_info',
        'type'     => 'textarea',
    ));

    // Redes Sociais
    $wp_customize->add_section('social_media', array(
        'title'    => __('Redes Sociais', 'techconsult'),
        'priority' => 45,
    ));

    $social_platforms = array(
        'facebook'  => __('Facebook', 'techconsult'),
        'instagram' => __('Instagram', 'techconsult'),
        'linkedin'  => __('LinkedIn', 'techconsult'),
        'twitter'   => __('Twitter / X', 'techconsult'),
        'youtube'   => __('YouTube', 'techconsult'),
        'tiktok'    => __('TikTok', 'techconsult'),
    );

    foreach ($social_platforms as $platform => $label) {
        $wp_customize->add_setting("social_{$platform}", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control("social_{$platform}", array(
            'label'    => $label,
            'section'  => 'social_media',
            'type'     => 'url',
        ));
    }
}
add_action('customize_register', 'techconsult_customize_register');

/**
 * Output customizer CSS
 */
function techconsult_customizer_css() {
    ?>
    <style type="text/css">
        :root {
            --cor-destaque: <?php echo esc_attr(get_theme_mod('primary_color', '#F2B705')); ?>;
            --cor-principal: <?php echo esc_attr(get_theme_mod('header_bg_color', '#132B4A')); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'techconsult_customizer_css');