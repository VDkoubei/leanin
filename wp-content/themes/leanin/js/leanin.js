jQuery(document).ready(function($) {
    $('.main-navigation .nav-menu > li').on('click.leanin', function(event) {
        var $self = $(this);
        if ($(window).width() < 960) {
            if($self.children('.sub-menu').length) {
                $self.toggleClass('active').siblings().removeClass('active');
                $self.children('.sub-menu').slideToggle()
                        .end().siblings().children('.sub-menu').slideUp();
            }
        }
    });

    $(document).on('click.leanin', '.site-header .menu-toggle', function(event) {
        var $self = $(this);
        $self.toggleClass('toggled-on');
        var navMenu = $('.main-navigation .nav-menu');
        navMenu.slideToggle();
    });


})

