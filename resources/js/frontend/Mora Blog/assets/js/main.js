// Slider functionality
let currentSlide = 0;
const slides = document.querySelectorAll("#slider-track > div");
const indicators = document.querySelectorAll(".indicator");

function showSlide(index) {
  const track = document.getElementById("slider-track");
  track.style.transform = `translateX(-${index * 100}%)`;

  // Update indicators
  indicators.forEach((indicator, i) => {
    indicator.classList.toggle("active", i === index);
  });

  currentSlide = index;
}

function goToSlide(index) {
  showSlide(index);
}

// Auto-play slider every 4 seconds
setInterval(() => {
  currentSlide = (currentSlide + 1) % slides.length;
  showSlide(currentSlide);
}, 4000);

// Initialize first slide
document.addEventListener("DOMContentLoaded", () => {
  showSlide(0);
});
