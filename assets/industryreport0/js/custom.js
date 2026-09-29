// JavaScript Document
jQuery('.carousel-inner').each(function () {
if (jQuery(this).children('div').length === 1)
jQuery(this).siblings('.carousel-control-prev, .carousel-control-next, .carousel-indicators').hide();
});

//Equal Height
jQuery('.coleql_height').matchHeight();

//Custom Accrodion
jQuery(".custom-accordion").accordionjs();

//Navigation
jQuery(document).ready(function ($) {
jQuery('.stellarnav').stellarNav({
theme: 'light',
breakpoint: 991,
position: 'right',
});
});

//Add class onscroll in heaer
jQuery(window).scroll(function () {
if (jQuery(".header").offset().top > 0) {
jQuery(".header").addClass("fixed-header");
} else {
jQuery(".header").removeClass("fixed-header");
}
})


//Slick Carousel
jQuery('.SlickSlider').slick({
dots: true,
infinite: true,
autoplay: true,
arrows: false,
speed: 300,
slidesToShow: 6,
slidesToScroll: 6,
responsive: [
{
breakpoint: 992,
settings: {
slidesToShow: 6,
slidesToScroll: 6,
}
},
{
breakpoint: 991,
settings: {
slidesToShow: 4,
slidesToScroll: 4
}
},
{
breakpoint: 575,
settings: {
slidesToShow: 2,
slidesToScroll: 2
}
}
]
});



(function ($){
$.fn.responsiveTabs = function() {
this.addClass('responsive-tabs'),
this.append($('<span class="dropdown-arrow"></span>')),
this.on("click", "li > button.active, span.dropdown-arrow", function (){
this.toggleClass('open');
}.bind(this)), this.on("click", "li > button:not(.active)", function() {
this.removeClass("open")
}.bind(this)); 
}
})(jQuery);

(function ($) {
$('.nav-tabs').responsiveTabs();
})(jQuery);