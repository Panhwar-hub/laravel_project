$(document).ready(function() {
    const openSearch = document.querySelector(".openSearch");
const closeSearch = document.querySelector(".closeSearch");
const headerSearch = document.querySelector(".header__search")

openSearch.addEventListener("click",()=>{
headerSearch.classList.add("active");
})
closeSearch.addEventListener("click",()=>{
headerSearch.classList.remove("active");
})
    $(function() {
        $(".date-picker").datepicker();
    });

    // MOBILE-NAVIGATION-LIST

    $('.navigation-list').clone().appendTo('.mobile-menu-body');

    $('.hamburger').on('click', function() {
        if (!$('.mobile-menu').hasClass('mobile-view')) {
            $('.mobile-menu').addClass('mobile-view');
        } else {
            $('.mobile-menu').removeClass('mobile-view');
        }
    });

    $('#menu-close').on('click', function() {
        $('.mobile-menu').removeClass('mobile-view');
    });

    // SCROLL JS

    // $('.scroller').mCustomScrollbar();

    // STICKY NAVBAR

    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('.bottom-row').addClass('sticky');
            $('.bottom-row').css('transition-duration', '0.5s');
        } else {
            $('.bottom-row').removeClass('sticky');
            $('.bottom-row').css('transition-duration', '0.5s');
        }
    });


    // Select Picker

    // $(function() {
    //     $('.selectpicker').selectpicker();
    // });


    // WOW JS

    new WOW().init();

    // VIDEO SLIDER CENTER

    $('.video-slider').slick({
        centerMode: true,
        centerPadding: '60px',
        slidesToShow: 3,
        responsive: [{
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            }
        ]
    });
    $('.today-offer-slider').slick({
        centerMode: true,
        centerPadding: '60px',
        slidesToShow: 4,
        slidesToScroll:1,
        arrows: false,
        autoplay:true,
        autoplaySpeed: 2000,
        responsive: [{
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            }
        ]
    });

// Initialize Slick
$(".featured-slider").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: true,
    autoplay: true,
    autoplaySpeed: 1000,
    prevArrow: $(".featured .slider-arrows .prev"),
    nextArrow: $(".featured .slider-arrows .next"),
  });
  
  $(".singleProduct__img").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    vertical: true,
    verticalSwiping: true,
    autoplay: true,
    asNavFor: ".singleProduct__pictures",
  });
  $(".singleProduct__pictures").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    asNavFor: ".singleProduct__img",
    dots: false,
    arrows: false,
    focusOnSelect: true,
    vertical: true,
  });
  
    // Product Slider JS

    $('.home-slider').slick({
        arrows: false,
        dots: true,
        infinite: false,
        slidesToShow: 3,
        responsive: [{
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: 2,
                    dots: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    slidesToShow: 1,
                    dots: true
                }
            }
        ]
    });
    $('.testimonial-slider').slick({
        arrows: false,
        dots: true,
        infinite: false,
        slidesToShow: 3,
        responsive: [{
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: 2,
                    dots: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    slidesToShow: 1,
                    dots: true
                }
            }
        ]
    });
    $('.follow-slider-1').slick({
        arrows: false,
        dots: false,
        infinite: false,
        slidesToShow: 5,
        infinite:true,
        responsive: [{
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: 2,
                    dots: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    slidesToShow: 1,
                    dots: true
                }
            }
        ]
    });

    $('#instafeed-container').slick({
        arrows: false,
        dots: false,
        infinite: false,
        slidesToShow: 5,
        infinite:true,
        responsive: [{
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: 2,
                    dots: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    slidesToShow: 1,
                    dots: true
                }
            }
        ]
    });

    // Product Slider JS

    $('.news-slider').slick({
        arrows: false,
        dots: false,
        infinite: false,
        slidesToShow: 3,
        responsive: [{
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: 2,
                    dots: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    slidesToShow: 1,
                    dots: true
                }
            }
        ]
    });
    $('.follow-slider-1').slick({
        arrows: false,
        dots: false,
        infinite: false,
        slidesToShow: 5,
        responsive: [{
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: 2,
                    dots: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    slidesToShow: 1,
                    dots: true
                }
            }
        ]
    });

    // PRODUCT-SHOP-DETAIL SLIDER JS


    // VIDEOS SLIDER END

    // NUMBER COUNTER

    $(document).ready(function() {
        $('.num-in span').click(function() {
            var $input = $(this).parents('.num-block').find('input.in-num');
            if ($(this).hasClass('minus')) {
                var count = parseFloat($input.val()) - 1;
                count = count < 1 ? 1 : count;
                if (count < 2) {
                    $(this).addClass('dis');
                } else {
                    $(this).removeClass('dis');
                }
                $input.val(count);
            } else {
                var count = parseFloat($input.val()) + 1
                $input.val(count);
                if (count > 1) {
                    $(this).parents('.num-block').find(('.minus')).removeClass('dis');
                }
            }
            $input.change();
            return false;
        });

    });

    //   PRICE RANGE START

    // var lowerSlider = document.querySelector('#lower');
    // var upperSlider = document.querySelector('#upper');

    // document.querySelector('#two').value = upperSlider.value;
    // document.querySelector('#one').value = lowerSlider.value;

    // var lowerVal = parseInt(lowerSlider.value);
    // var upperVal = parseInt(upperSlider.value);

    // upperSlider.oninput = function() {
    //     lowerVal = parseInt(lowerSlider.value);
    //     upperVal = parseInt(upperSlider.value);

    //     if (upperVal < lowerVal + 4) {
    //         lowerSlider.value = upperVal - 4;
    //         if (lowerVal == lowerSlider.min) {
    //             upperSlider.value = 4;
    //         }
    //     }
    //     document.querySelector('#two').value = this.value
    // };

    // lowerSlider.oninput = function() {
    //     lowerVal = parseInt(lowerSlider.value);
    //     upperVal = parseInt(upperSlider.value);
    //     if (lowerVal > upperVal - 4) {
    //         upperSlider.value = lowerVal + 4;
    //         if (upperVal == upperSlider.max) {
    //             lowerSlider.value = parseInt(upperSlider.max) - 4;
    //         }
    //     }
    //     document.querySelector('#one').value = this.value
    // };

    //   PRICE RANGE END



});


    // PRODUCT-SHOP-DETAIL SLIDER JS

    $('.for-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        asNavFor: '.nav-slider',
        arrows: false,
        dots: false,
    });
    $('.nav-slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.for-slider',
        focusOnSelect: true
    });

    