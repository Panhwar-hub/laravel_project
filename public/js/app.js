// Initialize Wow
new WOW().init();

// Banner Slider
$(".bannerContentSlider").slick({
  autoplay: true,
  autoplaySpeed: 2000,
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  dots: false,
});
// Reviews Slider
$(".reviewsSlider").slick({
  autoplay: true,
  autoplaySpeed: 2000,
  slidesToShow: 3,
  slidesToScroll: 1,
  arrows: true,
  dots: false,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 500,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});


// Article Cards Slider
$(".articleCardSlider").slick({
  autoplay: true,
  autoplaySpeed: 2000,
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  dots: false,
  nextArrow: ".prevSlider",
  prevArrow: ".nextSlider",
});
$(".remaining-service-btn").click(function () {
  $(this).hide();
  $(".remaining-sevices").slideToggle();
});
function openSideBar() {
  document.getElementById("sideBar").classList.add("show")
}
function closeSideBar() {
  document.getElementById("sideBar").classList.remove("show")
}