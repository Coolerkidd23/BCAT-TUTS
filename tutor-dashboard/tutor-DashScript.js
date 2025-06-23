// Logout logic
if (window.location.pathname.includes("tutor-dashboard.html")) {
  const logoutBtn = document.getElementById("logoutBtn");

  logoutBtn.addEventListener("click", () => {
    localStorage.removeItem("isLoggedIn");
    window.location.href = "index.html";
  });

  // Prevent direct access if not logged in
  if (localStorage.getItem("isLoggedIn") !== "true") {
    window.location.href = "index.html";
  }
}

// Menu Toggle
const menuToggle = document.getElementById('menuToggle');
const sidebar = document.getElementById('sidebar');

if (menuToggle && sidebar) {
  menuToggle.addEventListener('click', () => {
    sidebar.classList.toggle('active');
  });
}

/*  JS-Powered KPI Count-Up Animation */
function animateCountUp(element, endValue, duration = 1200) {
  let start = 0;
  const increment = endValue / (duration / 16); // ~60fps
  const counter = () => {
    start += increment;
    if (start < endValue) {
      element.textContent = Math.floor(start);
      requestAnimationFrame(counter);
    } else {
      element.textContent = endValue;
    }
  };
  counter();
}

// Run on page load
window.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".kpi-value").forEach(el => {
    const endVal = parseInt(el.textContent.trim(), 10);
    animateCountUp(el, endVal);
  });
});

function showToast(message) {
  const toast = document.getElementById("toast");
  toast.textContent = message;
  toast.classList.add("show");
  setTimeout(() => {
    toast.classList.remove("show");
  }, 3000);
}

// Example: Show toast after upload button click
const uploadBtn = document.querySelector(".upload-section button");
uploadBtn?.addEventListener("click", (e) => {
  e.preventDefault();
  // Simulate upload...
  showToast("Upload successful ✅");
});


// Toggle dark mode
const darkToggle = document.getElementById("darkToggle");
darkToggle?.addEventListener("click", () => {
  document.body.classList.toggle("dark-mode");
});

