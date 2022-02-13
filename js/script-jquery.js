// slick
// jquery
$(document).ready(function () {
  $(".slider").slick({
    // dots: true,
    infinite: false,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 4,
    responsive: [
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        },
      },
      {
        breakpoint: 450,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          centerMode: true,
        },
      },
    ],
  });

  const signinForm = document.querySelector(".signin-form");
  const signupForm = document.querySelector(".signup-form");
  $(".btn-signup").on("click", function () {
    signinForm.classList.add("hide");
    signupForm.classList.add("show");
    signinForm.classList.remove("show");
  });

  $(".btn-signin").on("click", function () {
    signinForm.classList.remove("hide");
    signupForm.classList.remove("show");
    signinForm.classList.add("show");
  });

  // password show / hide
  const passwordInput = document.querySelector(".password-input");
  const passwordInput1 = document.querySelector(".password-input-signup");
  const passwordInput2 = document.querySelector(".password-input-conf");
  const btnEye = document.querySelector(".btn-eye");
  const btnEye1 = document.querySelector(".btn-eye-signup");
  const btnEye2 = document.querySelector(".btn-eye-conf");

  btnEye.addEventListener("click", () => {
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      btnEye.innerHTML = '<i class="uil uil-eye"></i>';
    } else {
      passwordInput.type = "password";
      btnEye.innerHTML = '<i class="uil uil-eye-slash"></i>';
    }
  });
  btnEye1.addEventListener("click", () => {
    if (passwordInput1.type === "password") {
      passwordInput1.type = "text";
      btnEye1.innerHTML = '<i class="uil uil-eye"></i>';
    } else {
      passwordInput1.type = "password";
      btnEye1.innerHTML = '<i class="uil uil-eye-slash"></i>';
    }
  });
  btnEye2.addEventListener("click", () => {
    if (passwordInput2.type === "password") {
      passwordInput2.type = "text";
      btnEye2.innerHTML = '<i class="uil uil-eye"></i>';
    } else {
      passwordInput2.type = "password";
      btnEye2.innerHTML = '<i class="uil uil-eye-slash"></i>';
    }
  });
});
