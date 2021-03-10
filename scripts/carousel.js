const carouselTrack = document.querySelector(".carousel-items");
const carouselItems = Array.from(carouselTrack.children);
const carouselNav = document.querySelector(".carousel-navigation")
const carouselDetails = document.querySelectorAll(".carousel-item-details");
const prevButton = document.querySelector(".carousel-btn-left");
const nextButton = document.querySelector(".carousel-btn-right");
const dotsNav = document.querySelector(".carousel-indicators");
const carousel = document.querySelector(".carousel");
const slideWidth = carousel.getBoundingClientRect().width;
var currentSlideIndex = 0;

const initializeSlides = (slide, index) => {
  slide.style.left = slideWidth * index + "px";
  var dot = document.createElement("div");
  if (index == 0) {
    dot.setAttribute("class", "indicator selected");
  } else {
    dot.setAttribute("class", "indicator");
  }
  dotsNav.appendChild(dot);
};
carouselItems.forEach(initializeSlides);

const dots = Array.from(dotsNav.children);

const slideMoveTo = (index) => {
  if (index > -1 && index < carouselItems.length) {
    const currentSlide = carouselTrack.querySelector(".carousel-active");
    const targetSlide = carouselTrack.children[index];
    currentSlide.classList.remove("carousel-active");
    targetSlide.classList.add("carousel-active");
    const amtToMove = targetSlide.style.left;
    carouselTrack.style.transform = "translateX(-" + amtToMove + ")";
    currentSlideIndex = index;
    updateDots(index);
  }
};

const updateDots = (index) => {
  const currentDot = document.querySelector(".indicator.selected");
  const targetDot = dots[index];
  currentDot.classList.remove("selected");
  targetDot.classList.add("selected");
};

carousel.addEventListener("mouseenter", (e) => {
  carouselNav.classList.remove("transparent");
  carouselDetails.forEach((element) => {
    element.classList.remove("transparent");
  })
})

carousel.addEventListener("mouseleave", (e) => {
  carouselNav.classList.add("transparent");
  carouselDetails.forEach((element) => {
    element.classList.add("transparent");
  })
})

nextButton.addEventListener("click", (e) => {
  if (currentSlideIndex + 1 > carouselItems.length - 1) {
    currentSlideIndex = 0;
  } else {
    currentSlideIndex++;
  }
  slideMoveTo(currentSlideIndex);
});

prevButton.addEventListener("click", (e) => {
  if (currentSlideIndex - 1 < 0) {
    currentSlideIndex = carouselItems.length - 1;
  } else {
    currentSlideIndex--;
  }
  slideMoveTo(currentSlideIndex);
});

dotsNav.addEventListener("click", (e) => {
  const targetDot = e.target.closest("div.indicator");

  if (!targetDot) return;

  const targetIndex = dots.findIndex((dot) => dot === targetDot);

  slideMoveTo(targetIndex);
});

const carouselSpin = () => {
  if (currentSlideIndex + 1 > carouselItems.length - 1) {
    currentSlideIndex = 0;
  } else {
    currentSlideIndex++;
  }
  slideMoveTo(currentSlideIndex);

  setTimeout(carouselSpin, 8000);
};

setTimeout(carouselSpin, 8000);
