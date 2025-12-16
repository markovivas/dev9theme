/**
 * File for Customizer live preview
 *
 * @package TechConsult
 */

(function($) {
    'use strict';

    // Atualiza o título do Hero em tempo real
    wp.customize('hero_title', function(value) {
        value.bind(function(to) {
            $('.hero-text h1').html(to);
        });
    });

    // Atualiza a descrição do Hero em tempo real
    wp.customize('hero_description', function(value) {
        value.bind(function(to) {
            $('.hero-text p').html(to);
        });
    });

    // Você pode adicionar mais listeners para outras configurações aqui...

})(jQuery);