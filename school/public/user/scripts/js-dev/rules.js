$(document).ready(function () {
    $('.icon').on('click', function() {
        $('.search-region').toggleClass('show');
    });

    var swiper = new Swiper(".mySwiper", {
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
    });

    var swiper = new Swiper(".swiper-container-js", {
        slidesPerView: 3,
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });

    var swiper = new Swiper(".swiper-container-khoa", {
        slidesPerView: 4,
        spaceBetween: 30,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
    });

    var items = document.querySelectorAll(".timeline li");

    function isElementInViewport(el) {
      var rect = el.getBoundingClientRect();
      return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
      );
    }

    function callbackFunc() {
      for (var i = 0; i < items.length; i++) {
        if (isElementInViewport(items[i])) {
          if(!items[i].classList.contains("in-view")){
            items[i].classList.add("in-view");
          }
        } else if(items[i].classList.contains("in-view")) {
            items[i].classList.remove("in-view");
        }
      }
    }
     
    window.addEventListener("load", callbackFunc);
    window.addEventListener("scroll", callbackFunc);

});

