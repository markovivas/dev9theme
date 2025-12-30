<?php
/**
 * Template part para exibir a seção de Chamada para Ação (CTA).
 *
 * @package small-apps
 */
?>

<section class="cta-section text-center py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="display-5 mb-4"><?php esc_html_e( 'Pronto para começar?', 'small-apps' ); ?></h2>
                <p class="lead mb-4"><?php esc_html_e( 'Leve seus projetos para o próximo nível. Entre em contato ou explore nossas soluções.', 'small-apps' ); ?></p>
                <a href="#contact" class="btn btn-primary btn-lg">
                    <?php esc_html_e( 'Fale Conosco', 'small-apps' ); ?>
                </a>
            </div>
        </div>
    </div>
</section>