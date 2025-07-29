function toggleMobileMenu() {
  const menu = document.querySelector(".navbar-menu");
  const toggleBtn = document.querySelector(".mobile-menu-btn i");

  menu.classList.toggle("active");

  if (menu.classList.contains("active")) {
    toggleBtn.classList.remove("fa-bars");
    toggleBtn.classList.add("fa-times");
  } else {
    toggleBtn.classList.remove("fa-times");
    toggleBtn.classList.add("fa-bars");
  }
}

document.querySelectorAll(".has-flyout > .nav-link").forEach((link) => {
  link.addEventListener("click", function (e) {
    if (window.innerWidth <= 768) {
      e.preventDefault();
      const flyout = this.nextElementSibling;
      flyout.classList.toggle("open");
    }
  });
});

document.querySelectorAll(".has-flyout").forEach((item) => {
  const flyout = item.querySelector(".flyout-menu");
  if (!flyout) return;

  const showFlyout = () => flyout.classList.add("open");
  const hideFlyout = () => flyout.classList.remove("open");

  item.addEventListener("mouseenter", showFlyout);
  flyout.addEventListener("mouseenter", showFlyout);

  item.addEventListener("mouseleave", () => {
    setTimeout(() => {
      if (!item.matches(":hover") && !flyout.matches(":hover")) hideFlyout();
    }, 200);
  });

  flyout.addEventListener("mouseleave", () => {
    setTimeout(() => {
      if (!item.matches(":hover") && !flyout.matches(":hover")) hideFlyout();
    }, 200);
  });
});

// Set active link on page load
document.querySelectorAll(".nav-link").forEach((link) => {
  if (
    link.href === window.location.href ||
    link.href === window.location.origin + window.location.pathname
  ) {
    link.classList.add("active");
  }
});

document.addEventListener("DOMContentLoaded", function () {
  const slide = document.querySelector(".carousel-slide");
  const images = document.querySelectorAll(".carousel-slide img");
  const prevBtn = document.querySelector(".prev");
  const nextBtn = document.querySelector(".next");

  // Mini carousel elements (updated for text slides)
  const miniSlide = document.querySelector(".mini-carousel-slide");
  const miniSlides = document.querySelectorAll(".mini-slide");
  let miniHeight = miniSlides[0].clientHeight;

  // Create indicators
  const indicatorsContainer = document.createElement("div");
  indicatorsContainer.className = "carousel-indicators";
  document.querySelector(".carousel").appendChild(indicatorsContainer);

  images.forEach((_, index) => {
    const indicator = document.createElement("div");
    indicator.className = "indicator";
    if (index === 0) indicator.classList.add("active");
    indicator.addEventListener("click", () => goToSlide(index));
    indicatorsContainer.appendChild(indicator);
  });

  let counter = 0;
  const size = images[0].clientWidth;

  // Set initial position
  slide.style.transform = `translateX(${-size * counter}px)`;
  miniSlide.style.transform = `translateY(${-miniHeight * counter}px)`;

  // Update mini-carousel position (vertical)
  function updateMiniCarousel() {
    miniHeight = miniSlides[0].clientHeight; // In case resized
    miniSlide.style.transform = `translateY(${-miniHeight * counter}px)`;
  }

  // Next button
  nextBtn.addEventListener("click", () => {
    if (counter >= images.length - 1) return;
    counter++;
    updateCarousel();
  });

  // Previous button
  prevBtn.addEventListener("click", () => {
    if (counter <= 0) return;
    counter--;
    updateCarousel();
  });

  // Auto-slide
  let autoSlide = setInterval(nextAutoSlide, 5000);

  function nextAutoSlide() {
    if (counter >= images.length - 1) {
      counter = 0;
    } else {
      counter++;
    }
    updateCarousel();
  }

  // Pause on hover
  document.querySelector(".carousel").addEventListener("mouseenter", () => {
    clearInterval(autoSlide);
  });

  document.querySelector(".carousel").addEventListener("mouseleave", () => {
    autoSlide = setInterval(nextAutoSlide, 5000);
  });

  // Update indicator dots
  function updateIndicators() {
    const indicators = document.querySelectorAll(".indicator");
    indicators.forEach((indicator, index) => {
      if (index === counter) {
        indicator.classList.add("active");
      } else {
        indicator.classList.remove("active");
      }
    });
  }

  // Go to specific slide
  function goToSlide(index) {
    counter = index;
    updateCarousel();
  }

  // Update both main and mini carousels
  function updateCarousel() {
    slide.style.transform = `translateX(${-size * counter}px)`;
    updateMiniCarousel();
    updateIndicators();
  }

  // Handle window resize
  window.addEventListener("resize", () => {
    const newSize = images[0].clientWidth;
    miniHeight = miniSlides[0].clientHeight;

    slide.style.transition = "none";
    miniSlide.style.transition = "none";

    slide.style.transform = `translateX(${-newSize * counter}px)`;
    miniSlide.style.transform = `translateY(${-miniHeight * counter}px)`;

    setTimeout(() => {
      slide.style.transition = "transform 0.5s ease-in-out";
      miniSlide.style.transition = "transform 0.5s ease-in-out";
    }, 10);
  });
});

const words = ["Welcome", "Explore", "Discover", "Enjoy"];
let wordIndex = 0;
let letterIndex = 0;
let currentText = "";
let isDeleting = false;
let delay = 100;

function typeEffect() {
  const display = document.getElementById("typewriter-text");
  const word = words[wordIndex];

  if (!isDeleting) {
    // Typing letters
    currentText = word.substring(0, letterIndex + 1);
    letterIndex++;

    if (letterIndex === word.length) {
      isDeleting = true;
      delay = 1500; // pause before deleting
    } else {
      delay = 150; // typing speed
    }
  } else {
    // Deleting letters
    currentText = word.substring(0, letterIndex - 1);
    letterIndex--;

    if (letterIndex === 0) {
      isDeleting = false;
      wordIndex = (wordIndex + 1) % words.length; // go to next word
      delay = 500; // pause before typing next word
    } else {
      delay = 100; // deleting speed
    }
  }

  display.textContent = currentText;
  setTimeout(typeEffect, delay);
}

document.addEventListener("DOMContentLoaded", typeEffect);
