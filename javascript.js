console.log("JavaScript loaded!");

document.addEventListener('DOMContentLoaded', () => {
  // ========================
  // Auto Slider
  // ========================
  let index = 0;
  const slider = document.getElementById('slider');
  if (slider) {
    const totalSlides = slider.children.length;

    function slide() {
      index = (index + 1) % totalSlides;
      slider.style.transform = `translateX(-${index * 100}%)`;
    }

    setInterval(slide, 4000); // Change every 4 seconds
  }

  // ========================
  // Recommended Swiper
  // ========================
  if (typeof Swiper !== 'undefined') {
    var recommendedSwiper = new Swiper('.recommendedSwiper', {
      spaceBetween: 10,
      slidesPerView: 5,
      centeredSlides: false,
      autoplay: {
        delay: 1500,
        disableOnInteraction: false,
      },
      loop: true
    });
  }

  // ========================
  // Flash Sale Countdown
  // ========================
  let flashDeadline = new Date().getTime() + 60 * 60 * 1000; // 1 hour from now

  let flashInterval = setInterval(function () {
    let now = new Date().getTime();
    let distance = flashDeadline - now;

    let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((distance % (1000 * 60)) / 1000);

    const hoursEl = document.getElementById("flash-hours");
    const minutesEl = document.getElementById("flash-minutes");
    const secondsEl = document.getElementById("flash-seconds");

    if (hoursEl && minutesEl && secondsEl) {
      hoursEl.textContent = String(hours).padStart(2, '0');
      minutesEl.textContent = String(minutes).padStart(2, '0');
      secondsEl.textContent = String(seconds).padStart(2, '0');
    }

    if (distance < 0) {
      clearInterval(flashInterval);
      const timerEl = document.getElementById("flashsale-timer");
      if (timerEl) {
        timerEl.textContent = "EXPIRED";
      }
    }
  }, 1000);


  // ========================
// Modal Loader for Login/Signup/Forgot
// ========================
function loadModal(file, modalId) {
  fetch(file)
    .then(response => response.text())
    .then(html => {
      const modalContainer = document.getElementById('modalContainer');
      if (!modalContainer) return;

      // Load modal content
      modalContainer.innerHTML = html;

      const modal = document.getElementById(modalId);
      if (modal) {
        modal.style.display = 'block';

        // Focus first input inside modal
        const firstInput = modal.querySelector('input');
        if (firstInput) firstInput.focus();

        // Close modal when clicking outside modal content
        modal.addEventListener('click', modalClickOutside);

        // Close modal on ESC key press
        window.addEventListener('keydown', escKeyListener);

        // Helper functions for event listeners
        function modalClickOutside(e) {
          if (e.target === modal) {
            closeForm(modalId);
          }
        }

        function escKeyListener(e) {
          if (e.key === 'Escape') {
            closeForm(modalId);
          }
        }
      }
    })
    .catch(err => {
      console.error(`Error loading modal from ${file}:`, err);
    });
}

const loginBtn = document.querySelector('.login_btn');
if (loginBtn) {
  loginBtn.addEventListener('click', function () {
    loadModal('login.php', 'loginModal');
  });
}

const signupBtn = document.querySelector('.signup_btn');
if (signupBtn) {
  signupBtn.addEventListener('click', function () {
    loadModal('signup.php', 'signupModal');
  });
}

// Expose openForgotModal to open forgot password modal
window.openForgotModal = function () {
  loadModal('forgot-password.php', 'forgotModal');
};

// Close modal and remove event listeners
window.closeForm = function (modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.style.display = 'none';

    // Remove event listeners to avoid duplicates or memory leaks
    modal.removeEventListener('click', modalClickOutside);
    window.removeEventListener('keydown', escKeyListener);
  }

  // These need to be in scope, so we can define them outside as well:
};

// To make sure modalClickOutside and escKeyListener can be removed,
// declare them outside loadModal and closeForm:

function modalClickOutside(e) {
  if (e.target.classList.contains('modal')) {
    e.target.style.display = 'none';
    cleanupEventListeners(e.target);
  }
}

function escKeyListener(e) {
  if (e.key === 'Escape') {
    const openModal = document.querySelector('.modal[style*="display: block"]');
    if (openModal) {
      openModal.style.display = 'none';
      cleanupEventListeners(openModal);
    }
  }
}

function cleanupEventListeners(modal) {
  if (!modal) return;
  modal.removeEventListener('click', modalClickOutside);
  window.removeEventListener('keydown', escKeyListener);
}


  // ========================
  // Close modal on Escape key
  // ========================
  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
      const modals = document.querySelectorAll('.form-modal');
      modals.forEach(modal => {
        modal.style.display = 'none';
      });
    }
  });

  // ========================
  // Close modal on outside click
  // ========================
  window.onclick = function (event) {
    const modals = document.querySelectorAll('.form-modal');
    modals.forEach(modal => {
      if (event.target === modal) {
        modal.style.display = 'none';
      }
    });
  };

  // ========================
  // Toggle password show/hide
  // ========================
  window.togglePassword = function (inputId, icon) {
    const input = document.getElementById(inputId);
    if (!input || !icon) return;

    if (input.type === 'password') {
      input.type = 'text';
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
    } else {
      input.type = 'password';
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
    }
  };

  // ========================
  // Header background color change on scroll (no shadow)
  // ========================
  const header = document.querySelector('header');

  window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  });

  // ========================
  // Mobile menu toggle
  // ========================
  const menuIcon = document.getElementById('menu-icon');
  const menuContainer = document.querySelector('.menu_container'); // your menu container class

  if (menuIcon && menuContainer) {
    menuIcon.addEventListener('click', () => {
      menuContainer.classList.toggle('active');
    });
  } else {
    console.log('Menu icon or menu container not found');
  }
});
