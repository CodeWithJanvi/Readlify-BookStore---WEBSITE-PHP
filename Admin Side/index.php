<?php include 'header.php'; ?>
<div class="wrapper">
  <?php include 'sidebar.php'; ?>

  <div class="main" id="mainContent">
    <header>
      <h1>Admin Dashboard</h1>
      <button id="toggleSidebar">☰</button>
    </header>

    <div class="content">
      <div class="card">
        <h3>Total Books</h3>
        <p>120</p>
      </div>
      <div class="card">
        <h3>Total Orders</h3>
        <p>35</p>
      </div>
      <div class="card">
        <h3>Customers</h3>
        <p>50</p>
      </div>
      <div class="card">
        <h3>Revenue</h3>
        <p>₹45,000</p>
      </div>
    </div>
    <div class="extra-section">
  <!-- Chart Container -->
  <div class="chart-card">
  <h3>Monthly Orders</h3>
  <div class="chart-container">
    <canvas id="ordersChart"></canvas>
  </div>
</div>


  <!-- Message/Chat Preview -->
  <div class="chat-card">
    <h3>Recent Messages</h3>
    <ul class="chat-list">
      <li><strong>Priya:</strong> Please update my order status.</li>
      <li><strong>Ravi:</strong> Book delivery is delayed.</li>
      <li><strong>Meena:</strong> How can I return a book?</li>
    </ul>
  </div>
</div>


    <?php include 'footer.php'; ?>
  </div>
</div>
