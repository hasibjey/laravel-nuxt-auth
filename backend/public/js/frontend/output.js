$(document).ready(function () {
  /**
   * Search section
   * Open and close search section
   */
  $(".search").on("click", function () {
    $(".search-section").removeClass("-right-full");
    $(".search-section").addClass("right-0");
  });
  $(".close-search").on("click", function (e) {
    $(".search-section").removeClass("right-0");
    $(".search-section").addClass("-right-full");
  });
  $(document).on("click", function (e) {
    if ($(e.target).is(".search, .search-section *")) {
      return;
    }
    $(".search-section").removeClass("right-0");
    $(".search-section").addClass("-right-full");
  });

  /**
   * Cart section
   * Open and close cart section
   */
  $(".cart").on("click", function () {
    const count = $('.cart-section').data('count');
    if(count == 0) {
      return;
    }
    $(".cart-section").removeClass("-right-full").addClass("right-0");
  });
  $(".close-cart").on("click", function (e) {
    $(".cart-section").removeClass("right-0");
    $(".cart-section").addClass("-right-full");
  });
  $(document).on("click", function (e) {
    if ($(e.target).is(".cart, .cart-section *")) {
      return;
    }
    $(".cart-section").removeClass("right-0");
    $(".cart-section").addClass("-right-full");
  });

  /**
   * Login section
   * Open and close login section
   */
  $(".login").on("click", function () {
    $(".login-section").removeClass("-right-full");
    $(".login-section").addClass("right-0");
  });
  $(".close-login").on("click", function (e) {
    $(".login-section").removeClass("right-0");
    $(".login-section").addClass("-right-full");
  });
  $(document).on("click", function (e) {
    if ($(e.target).is(".login, .login-section *")) {
      return;
    }
    $(".login-section").removeClass("right-0");
    $(".login-section").addClass("-right-full");
  });

  /**
   * Toggle password visibility in login form field
   * Toggle the password visibility when the eye icon is clicked
   */
  $(".toggle-password").on("click", function () {
    let passwordField = $(this).prev().prev();
    $(this).toggleClass("opacity-100");
    $(this).next().toggleClass("opacity-0");
    if (passwordField.attr("type") === "password") {
      passwordField.attr("type", "text");
    } else {
      passwordField.attr("type", "password");
    }
  });
  
  /**
   * filter section
   * Toggle filter content
   */
  $(".filter-header").on("click", function () {
    $(this).next().slideToggle();
    $(this).children(".fa-solid").toggleClass("fa-plus fa-minus");
  });

  /**
   * checkbox section
   * Toggle checkbox content
   */
  $(".checkbox").on("click", function (e) {
    e.preventDefault();
    $(this)
      .find("input")
      .prop("checked", !$(this).find("input").prop("checked"));
    $(this).children(".checkbox-custom").toggleClass("bg-secondary");
    $(this).children(".checkbox-custom").find("span").toggleClass("scale-0");
  });

  /**
   * filter section
   * Open and close filter section
   */
  $(".filter-btn").on("click", function () {
    $(".filter-section").removeClass("-left-full");
    $(".filter-section").addClass("left-0");
  });
  $(".close-filter").on("click", function (e) {
    $(".filter-section").removeClass("left-0");
    $(".filter-section").addClass("-left-full");
  });
  $(document).on("click", function (e) {
    if ($(e.target).is(".filter-btn, .filter-section *")) {
      return;
    }
    $(".filter-section").removeClass("left-0");
    $(".filter-section").addClass("-left-full");
  });

  

  /**
   * size checkbox section
   * Toggle bg-black and text-white class
   */
  $(".size-checkbox-product").on("click", function (e) {
    e.preventDefault();
    $(".size-checkbox-product").find("input").prop("checked", false);
    $(".size-checkbox-product").removeClass("bg-black text-white");
    $(this)
      .find("input")
      .prop("checked", !$(this).find("input").prop("checked"));
    $(this).toggleClass("bg-black text-white");
  });

  $(".increase").on("click", function () {
    let value = parseInt($(this).prev().val());
    $(this)
      .prev()
      .val(value + 1);
  });
  $(".decrease").on("click", function () {
    let value = parseInt($(this).next().val());
    if (value > 1) {
      $(this)
        .next()
        .val(value - 1);
    }
  });

  $(".customer-btn").on("click", function () {
    $(".customer-popup-nav").slideToggle(200);
  });

  $(document).on("click", function (e) {
    // e.preventDefault();
    if ($(e.target).is(".customer-btn *, .customer-popup-nav *")) {
      return;
    }
    $(".customer-popup-nav").slideUp();
  });

  let header_pos = false;
  if ($(document).scrollTop() >= 130) {
    if (!header_pos) {
      $(".header").addClass("fixed left-0 w-full bg-white overflow-hidden");
      $(".header").css("top", "-100%");
      setTimeout(() => {
        $(".header").css("top", "0");
      }, 200);
      header_pos = true;
    }
  }
  $(document).on("scroll", function () {
    if ($(document).scrollTop() >= 130) {
      if (!header_pos) {
        $(".header").addClass("fixed left-0 w-full bg-white overflow-hidden");
        $(".header").css("top", "-100%");
        setTimeout(() => {
          $(".header").css("top", "0");
        }, 200);
        header_pos = true;
      }
    } else {
      $(".header").removeClass("fixed top-0 left-0 w-full bg-white");
      header_pos = false;
    }
  });
});

/**
 * Add to cart fly image for product without single product detail page
 */
const flyToCart = () => {
  const card_icons = document.querySelectorAll(".card-icons");
  let isAddToCartClicked = false;

  if (card_icons) {
    const card_hover_out = (card_icon) => {
      const card_lists = card_icon.querySelectorAll("li");
      card_lists.forEach((list) => {
        list.classList.remove("bottom-16");
        list.classList.add("bottom-0");
      });
    };

    card_icons.forEach((card_icon) => {
      card_icon.parentNode.addEventListener("mouseenter", (e) => {
        if (window.innerWidth > 768) {
          const card_lists = card_icon.querySelectorAll("li");
          card_lists.forEach((list) => {
            list.classList.remove("bottom-0");
            list.classList.add("bottom-16");
          });
        }
      });

      // hover out
      card_icon.parentNode.addEventListener("mouseleave", (e) => {
        if (!isAddToCartClicked) {
          card_hover_out(card_icon);
        }
      });
    });
  }
};
/**
 * Add to cart fly image for product detail page
 */
const flyToCartFromDetail = () => {
  console.log("flyToCartFromDetail");
  
  const p_cart_btn = document.querySelector(".p-cart-btn");
  const image_section = document.querySelector(".image-section");
  const p_image = document.querySelector(".swiper-slide-active");

  if (p_image && p_cart_btn & image_section) {
    p_cart_btn.addEventListener("click", function () {
      const cart =
        window.innerWidth < 768
          ? document.querySelector(".cart")
          : document.querySelector(".shopping-cart");
      const image_url = p_image.querySelector("img").src;
      const fly_image = document.createElement("img");

      fly_image.src = image_url;
      fly_image.className = "absolute w-20 h-20 border-2 border-secondary";
      fly_image.style.top = "100%";
      fly_image.style.left = "27%";
      fly_image.style.transform = "translate(-50%, 50%)";
      fly_image.style.zIndex = "999";
      image_section.append(fly_image);

      const fly_image_pos = fly_image.getBoundingClientRect();
      const cart_pos = cart.getBoundingClientRect();

      let translateX = 0;
      let translateY = 0;
      if (window.innerWidth > 768) {
        translateX = cart_pos.left - fly_image_pos.left - 50;
        translateY = cart_pos.top - fly_image_pos.top + 30;
      } else {
        translateX = cart_pos.left - fly_image_pos.left - 55;
        translateY = cart_pos.top - fly_image_pos.top;
      }

      fly_image.style.transition = "transform 1s ease-in-out";
      fly_image.style.transform = `translate(${translateX}px, ${translateY}px) scale(0.1)`;

      setTimeout(() => {
        const cart_count_ele = document.querySelectorAll(".cart-count");
        cart_count_ele.forEach((element) => {
          let cart_count = parseInt(element.textContent);
          cart_count++;
          element.textContent = cart_count;
        });
      }, 900);

      fly_image.addEventListener("transitionend", () => {
        fly_image.remove();
      });
    });
  }
};
flyToCart();
flyToCartFromDetail();


const loading_data = document.querySelector(".loading-data");

window.addEventListener("scroll", () => {
  const loading_content = document.querySelector(".loading-content");
  if (!loading_content) return; // Exit function if loading-content is null

  const loading_content_pos = loading_content.getBoundingClientRect();
  const loading_content_pos_width = parseInt(loading_content_pos.height - 550);

  if (loading_content_pos_width < window.scrollY) {
    loading_data?.classList.remove("opacity-0");
    loading_data?.classList.add("opacity-100");
  } else {
    loading_data?.classList.remove("opacity-100");
    loading_data?.classList.add("opacity-0");
  }
});

/**
 * Make strong password
 */
const checkPassword = (e) => {
  const password = e.target.value;
  let barBox = e.target.nextElementSibling;
  let strengthBar = e.target.nextElementSibling.children[0];

  if(password.length > 0) {
    let strength = checkPasswordStrength(password);
  
    barBox.classList.remove("opacity-0");
    strengthBar.style.width = strength.barWidth;
    strengthBar.className = "h-full rounded-full " + strength.barClass;
  }
  else {
    barBox.classList.add("opacity-0");
  }
}
function checkPasswordStrength(password) {
  let strength = {
    barWidth: "33%",
    barClass: "bg-red-500",
  };

  if (password.length >= 8) {
    let hasLower = /[a-z]/.test(password);
    let hasUpper = /[A-Z]/.test(password);
    let hasNumber = /\d/.test(password);
    let hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password);

    let score = hasLower + hasUpper + hasNumber + hasSpecial;

    if (score >= 3) {
      strength = {
        barWidth: "100%",
        barClass: "bg-green-500",
      };
    } else if (score == 2) {
      strength = {
        barWidth: "66%",
        barClass: "bg-gradient-to-r from-red-600 to-orange-400",
      };
    }
  }

  return strength;
}

