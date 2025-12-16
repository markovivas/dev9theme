/**
 * Main JavaScript file for TechConsult theme
 */

(function($) {
    'use strict';

    $(document).ready(function() {

        // Menu Mobile Toggle
        $('.menu-toggle').on('click', function() {
            var menu = $('#primary-menu');
            menu.slideToggle(300);
            $(this).attr('aria-expanded', $(this).attr('aria-expanded') === 'false' ? 'true' : 'false');
        });

        // Smooth scroll para âncoras
        $('a[href*="#"]:not([href="#"])').on('click', function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    // O valor '80' corresponde à altura do header fixo
                    $('html, body').animate({
                        scrollTop: target.offset().top - 80
                    }, 1000);
                    return false;
                }
            }
        });

        // Header fixo (sticky) ao rolar a página
        $(window).on('scroll', function() {
            if ($(window).scrollTop() > 100) {
                $('.site-header').addClass('sticky');
            } else {
                $('.site-header').removeClass('sticky');
            }
        });

        // Animação do contador na seção de estatísticas
        var statsAnimated = false;

        function animateCounter() {
            $('.stat-item h3').each(function() {
                var $this = $(this);
                var countTo = $this.attr('data-count');
                $({
                    countNum: $this.text()
                }).animate({
                    countNum: countTo
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function() {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function() {
                        $this.text(this.countNum);
                    }
                });
            });
        }

        function isElementInViewport(el) {
            if (el.length === 0) return false;
            var rect = el[0].getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight)
            );
        }

        $(window).on('scroll', function() {
            if (!statsAnimated && isElementInViewport($('.stats-section'))) {
                animateCounter();
                statsAnimated = true;
            }
        });

        // Botão "Voltar ao Topo"
        var backToTop = $('<a/>', {
            'class': 'back-to-top',
            'href': '#',
            'html': '<span>&uarr;</span>',
            'aria-label': 'Voltar ao topo'
        }).appendTo('body');

        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 300) {
                backToTop.fadeIn();
            } else {
                backToTop.fadeOut();
            }
        });

        backToTop.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, 800);
        });

    });

})(jQuery);