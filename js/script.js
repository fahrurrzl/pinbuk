// my js
const btnMenu = document.querySelector(".btn-menu");
const navbar = document.querySelector(".navbar");

btnMenu.addEventListener("click", () => {
  btnMenu.classList.toggle("active");
  navbar.classList.toggle("active");
});

// initialize swiper
var swiper = new Swiper(".mySwiper", {
  effect: "cards",
  grabCursor: true,
});

const inputs = document.querySelectorAll("input");

inputs.forEach((input) => {
  input.addEventListener("focus", () => {
    let parent = input.parentNode;
    parent.classList.add("active");
  });

  input.addEventListener("blur", () => {
    let parent = input.parentNode;
    parent.classList.remove("active");
  });
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

// slide sign in / sign up
const btnSiginup = document.querySelector(".btn-signup");
const btnSiginin = document.querySelector(".btn-signin");
const signinForm = document.querySelector(".signin-form");
const signupForm = document.querySelector(".signup-form");

btnSiginup.addEventListener("click", () => {
  signinForm.classList.add("hide");
  signupForm.classList.add("show");
  signinForm.classList.remove("show");
});

btnSiginin.addEventListener("click", () => {
  signinForm.classList.remove("hide");
  signupForm.classList.remove("show");
  signinForm.classList.add("show");
});
