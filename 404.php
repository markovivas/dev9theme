<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package TechConsult
 */

get_header();
?>

<main id="primary" class="site-main">
    <section class="error-404 not-found">
        <header class="page-header">
            <h1 class="page-title"><?php esc_html_e('Página não encontrada', 'techconsult'); ?></h1>
        </header>

        <div class="page-content">
            <p><?php esc_html_e('A página que você está procurando não foi encontrada. Talvez você possa realizar uma busca?', 'techconsult'); ?></p>
            
            <?php get_search_form(); ?>
            
            <div class="back-home">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary">
                    <?php esc_html_e('Voltar para a página inicial', 'techconsult'); ?>
                </a>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();