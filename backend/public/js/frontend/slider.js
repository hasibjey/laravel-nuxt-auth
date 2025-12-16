var cardMd = new Swiper(".slider", {
  slidesPerView: 1,
  spaceBetween: 10,
  effect: "fade",
  loop: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

const slider_next = document.querySelector(".slider-next");
const slider_prev = document.querySelector(".slider-prev");
if (slider_next) {
  slider_next.addEventListener("click", () => {
    slider_next.previousElementSibling.previousElementSibling.click();
  });
  slider_prev.addEventListener("click", () => {
    slider_prev.previousElementSibling.previousElementSibling.previousElementSibling.click();
  });
}

const next_btns = document.querySelectorAll(".btn-next");
const prev_btns = document.querySelectorAll(".btn-prev");
if (next_btns) {
  next_btns.forEach((next_btn) => {
    next_btn.addEventListener("click", () => {
      next_btn.previousElementSibling.previousElementSibling.click();
    });
  });
  prev_btns.forEach((prev_btn) => {
    prev_btn.addEventListener("click", () => {
      prev_btn.previousElementSibling.previousElementSibling.click();
    });
  });
}

var swiper = new Swiper(".md-items", {
  slidesPerView: 2,
  spaceBetween: 10,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    320: {
      slidesPerView: 1,
    },
    375: {
      slidesPerView: 2,
      spaceBetween: 10,
    },
    640: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 4,
      spaceBetween: 20,
    },
    1024: {
      slidesPerView: 5,
      spaceBetween: 20,
    },
    1352: {
      slidesPerView: 6,
      spaceBetween: 20,
    },
  },
});

var swiper = new Swiper(".products", {
  slidesPerView: 2,
  spaceBetween: 10,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    320: {
      slidesPerView: 1,
    },
    375: {
      slidesPerView: 1,
      spaceBetween: 10,
    },
    640: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 20,
    },
    1024: {
      slidesPerView: 4,
      spaceBetween: 20,
    },
    1352: {
      slidesPerView: 4,
      spaceBetween: 20,
    },
  },
});

var swiper = new Swiper(".reviews", {
  slidesPerView: 2,
  spaceBetween: 10,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    320: {
      slidesPerView: 1,
    },
    375: {
      slidesPerView: 1,
      spaceBetween: 10,
    },
    640: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    1024: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    1352: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
  },
});

var swiper = new Swiper(".mySwiper", {
  spaceBetween: 10,
  slidesPerView: 4,
  freeMode: true,
  watchSlidesProgress: true,
});
var swiper2 = new Swiper(".product-slider", {
  spaceBetween: 5,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  thumbs: {
    swiper: swiper,
  },
});

$(document).ready(function () {
  $(".zoom-images").each(function () {
    $(this).imageZoom({ zoom: 200 });
  });
});
