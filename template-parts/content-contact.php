<?php
/**
 * Template part para exibir a seção de Contato na página inicial.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package small-apps
 */
?>

<section id="contact" class="contact-section py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col">
                <h2 class="display-6"><?php _e( 'Fale Conosco Pelo WhatsApp', 'small-apps' ); ?></h2>
                <p class="lead"><?php _e( 'Clique no botão abaixo para iniciar uma conversa. Estamos prontos para ajudar!', 'small-apps' ); ?></p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <a href="https://wa.me/5535991687008" class="btn btn-whatsapp btn-lg" target="_blank" rel="noopener noreferrer">
                    <i class="bi bi-whatsapp me-2"></i>
                    <?php _e( 'Iniciar Conversa no WhatsApp', 'small-apps' ); ?>
                </a>
            </div>
        </div>
    </div>
</section>