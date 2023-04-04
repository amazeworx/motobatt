jQuery(function($){

	// Mobile Menu
	$('.menu-toggle').click(function() {
		//$('.search-toggle, .header-search').removeClass('active');
        $('.nav-menu').toggleClass('active');
        $('body').css('overflow', 'hidden');
    });
    $('.nav-menu .close').click(function() {
        //console.log('clicked');
        $('.nav-menu').removeClass('active');
        $('body').css('overflow', 'auto');
    });
	$('.menu-item-has-children > .submenu-expand').click(function(e){
		$(this).toggleClass('expanded');
		e.preventDefault();
	});

    // Product Image Slider
    $('.slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: true,
        fade: false,
        //asNavFor: '.slider-nav-thumbnails',
    });

    // FAQ Accordion
    var panelContents = $('.accordion > dd').hide();
    var panelTitles = $('.accordion > dt > a');
    $('.accordion > dt > a').click(function() {
        $this = $(this);
        $target =  $this.parent().next();

        if(!$target.hasClass('active')) {
            panelContents.removeClass('active').slideUp();
            $target.addClass('active').slideDown();
            panelTitles.removeClass('active');
            $this.addClass('active');
        }

        return false;
    });

});
