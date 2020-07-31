let generateBtn = document.getElementById("generate");
let mealList = document.querySelector(".meal");
let resetBtn = document.querySelector(".btn-outline");

// Aos Js for Scroll Animation
AOS.init();

// Add button onclick event

generateBtn.addEventListener("click", (e) => {
  e.preventDefault();
  mealList.classList.toggle("active");
  resetBtn.classList.add("active");

  if (mealList.classList.contains("active")) {
    document.querySelector(".meal").scrollIntoView({ behavior: "smooth" });
  }
  if (!mealList.classList.contains("active")) {
    resetBtn.classList.remove("active");
  }

  generateBtn.textContent = "Toggle meal";
  // Using jQuery's animate() method to add smooth page scroll
  // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
});
