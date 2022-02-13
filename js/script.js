// my js
const btnMenu = document.querySelector(".btn-menu");
const navbar = document.querySelector(".navbar");

btnMenu.addEventListener("click", () => {
  btnMenu.classList.toggle("active");
  navbar.classList.toggle("active");
});

const btnSearch = document.getElementById("search-btn");
const searchForm = document.querySelector(".search-form");
const inputBox = document.querySelector(".input-box");

btnSearch.addEventListener("click", () => {
  searchForm.classList.toggle("active");
  navbar.classList.remove("active");
  btnMenu.classList.remove("active");
  inputBox.focus();
});

// initialize swiper
var swiper = new Swiper(".mySwiper", {
  effect: "cards",
  grabCursor: true,
});

const btnEyeOne = document.querySelector(".btn-eye-one");
const btnEyeTwo = document.querySelector(".btn-eye-two");
const btnEyeThree = document.querySelector(".btn-eye-three");
const passwordInputOne = document.querySelector(".password-input-one");
const passwordInputTwo = document.querySelector(".password-input-two");
const passwordInputThree = document.querySelector(".password-input-three");
btnEyeOne.addEventListener("click", function () {
  if (passwordInputOne.type === "password") {
    passwordInputOne.type = "text";
    btnEyeOne.innerHTML = '<i class="uil uil-eye"></i>';
  } else {
    passwordInputOne.type = "password";
    btnEyeOne.innerHTML = '<i class="uil uil-eye-slash"></i>';
  }
});
btnEyeTwo.addEventListener("click", function () {
  if (passwordInputTwo.type === "password") {
    passwordInputTwo.type = "text";
    btnEyeTwo.innerHTML = '<i class="uil uil-eye"></i>';
  } else {
    passwordInputTwo.type = "password";
    btnEyeTwo.innerHTML = '<i class="uil uil-eye-slash"></i>';
  }
});
btnEyeThree.addEventListener("click", function () {
  if (passwordInputThree.type === "password") {
    passwordInputThree.type = "text";
    btnEyeThree.innerHTML = '<i class="uil uil-eye"></i>';
  } else {
    passwordInputThree.type = "password";
    btnEyeThree.innerHTML = '<i class="uil uil-eye-slash"></i>';
  }
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

function previewPoto() {
  const poto = document.querySelector(".poto");
  const imgPreview = document.querySelector(".img-preview");

  const oFReader = new FileReader();
  oFReader.readAsDataURL(poto.files[0]);

  oFReader.onload = function (oFREvent) {
    imgPreview.src = oFREvent.target.result;
  };
}
