
  document.addEventListener("DOMContentLoaded", function () {
    // Toggle Sidebar
    const toggleBtn = document.getElementById("toggleSidebar");
    const sidebar = document.querySelector(".sidebar");
    const main = document.querySelector(".main");

    toggleBtn.addEventListener("click", function () {
      sidebar.classList.toggle("hide");
      main.classList.toggle("full");
    });

    // Initialize Chart
    const ctx = document.getElementById('ordersChart');
    if (ctx) {
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
          datasets: [{
            label: 'Orders',
            data: [12, 19, 8, 15, 10, 25],
            backgroundColor: '#ff6f00'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    }
  });

