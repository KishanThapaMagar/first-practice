document.addEventListener("DOMContentLoaded", function () {
  const slider = document.querySelector(".slider");
  const prevBtn = document.getElementById("prev");
  const nextBtn = document.getElementById("next");
  let currentIndex = 0;
  const slideWidth = document.querySelector(".slide").offsetWidth + 20; // Slide width + gap
  nextBtn.addEventListener("click", () => {
    if (currentIndex < slider.children.length - 1) {
      currentIndex++;
      slider.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
    }
  });
  prevBtn.addEventListener("click", () => {
    if (currentIndex > 0) {
      currentIndex--;
      slider.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
    }
  });
});
//testimonial
document.addEventListener("DOMContentLoaded", function () {
  const slides = document.querySelectorAll(".testimonial-slide");
  const prevBtn = document.getElementById("prevTestimonial");
  const nextBtn = document.getElementById("nextTestimonial");
  const prevImage = document.getElementById("prevImage");
  const nextImage = document.getElementById("nextImage");
  let currentIndex = 0;
  let autoScrollInterval;

  function updateSlider() {
    slides.forEach((slide, index) => {
      slide.style.transform = `translateX(-${currentIndex * 100}%)`;
    });

    const prevIndex = (currentIndex - 1 + slides.length) % slides.length;
    const nextIndex = (currentIndex + 1) % slides.length;

    prevImage.src = slides[prevIndex].querySelector(".testimonial-img img").src;
    nextImage.src = slides[nextIndex].querySelector(".testimonial-img img").src;
  }

  function nextSlide() {
    currentIndex = (currentIndex + 1) % slides.length;
    updateSlider();
  }

  function prevSlide() {
    currentIndex = (currentIndex + 1) % slides.length; // Keep moving forward, never backward
    updateSlider();
  }

  function startAutoScroll() {
    autoScrollInterval = setInterval(nextSlide, 3000); // Adjust timing as needed
  }

  function stopAutoScroll() {
    clearInterval(autoScrollInterval);
  }

  prevBtn.addEventListener("click", function () {
    stopAutoScroll();
    prevSlide();
    startAutoScroll();
  });

  nextBtn.addEventListener("click", function () {
    stopAutoScroll();
    nextSlide();
    startAutoScroll();
  });

  updateSlider();
  startAutoScroll();
});

// director
document.addEventListener("DOMContentLoaded", function () {
  let thumbnails = document.querySelectorAll(".thumbnail");
  let mainImage = document.getElementById("mainImage");
  let mainTitle = document.querySelector(".director-content-container h1");
  let mainDesc = document.querySelector(
    ".director-content-container p:first-of-type"
  ); // Excerpt
  let mainContent = document.querySelector(
    ".director-content-container p:last-of-type"
  ); // Full content
  let prevBtn = document.querySelector(".prev-btn");
  let nextBtn = document.querySelector(".next-btn");

  let data = [];

  // Collect data from thumbnails (WordPress posts)
  thumbnails.forEach((thumb, index) => {
    data.push({
      imgSrc: thumb.getAttribute("data-img"),
      title: thumb.getAttribute("data-title"),
      description: thumb.getAttribute("data-desc"),
      content: thumb.getAttribute("data-content"), // Get full content
    });

    // Click event for thumbnails
    thumb.addEventListener("click", function () {
      updateMainContent(index);
    });
  });

  let currentIndex = 0;

  function updateMainContent(index) {
    if (data[index]) {
      mainImage.src = data[index].imgSrc;
      mainTitle.textContent = data[index].title;
      mainDesc.textContent = data[index].description;
      mainContent.textContent = data[index].content; // Update full content

      // Update active thumbnail
      thumbnails.forEach((img) => img.classList.remove("active"));
      thumbnails[index].classList.add("active");

      currentIndex = index;
    }
  }

  // Navigation buttons
  prevBtn.addEventListener("click", function () {
    let newIndex = (currentIndex - 1 + data.length) % data.length;
    updateMainContent(newIndex);
  });

  nextBtn.addEventListener("click", function () {
    let newIndex = (currentIndex + 1) % data.length;
    updateMainContent(newIndex);
  });

  // Initialize with the first director as default
  updateMainContent(0);
});
function goBack() {
  window.history.back();
}

    document.addEventListener("DOMContentLoaded", function () {
        var backButton = document.querySelector(".archive-back-button");

        if (document.referrer) {
            backButton.setAttribute("href", document.referrer);
        }
    });
   


