<?php include 'header.php'; ?>
<?php include 'connection.php'; // your DB connection file ?>

<section class="flashsale-wrapper">
  <div class="flashsale-container">
    <div class="flashsale-header">
      <h2>🔥 Flash Sale</h2>
      <p>Get your next read at a steal – limited time only!</p>
      <div class="flashsale-timer" id="flashsale-timer">
        <span id="flash-hours">00</span>:
        <span id="flash-minutes">00</span>:
        <span id="flash-seconds">00</span>
      </div>
    </div>

    <div class="flashsale-books">
      <?php
      date_default_timezone_set('Asia/Kolkata');

      $current_time = date('Y-m-d H:i:s');
      $sql = "SELECT * FROM flash_sales 
              WHERE is_active = 1 
              AND '$current_time' BETWEEN start_time AND end_time 
              ORDER BY start_time DESC";

      $result = $conn->query($sql);

      if ($result && $result->num_rows > 0) {
       while ($row = $result->fetch_assoc()) {
  echo '<div class="flashsale-card">
          <img src="' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['book_title']) . '">
          <div class="flashsale-info">
              <h3>' . htmlspecialchars($row['book_title']) . '</h3>
              <p class="author">by ' . htmlspecialchars($row['book_author']) . '</p>
              <p class="original-price">₹' . number_format($row['original_price']) . '</p>
              <p class="sale-price">₹' . number_format($row['sale_price']) . '</p>
              <a href="order.php?book_id=' . urlencode($row['id']) . '" class="buy_btn">Buy Now</a>
          </div>
        </div>';
}

      } else {
        echo "<p style='padding:20px;'>No flash sales available at the moment.</p>";
      }
      ?>
    </div>
  </div>
</section>

<script>
let deadline = new Date().getTime() + 60 * 60 * 1000;
let x = setInterval(function () {
  let now = new Date().getTime();
  let distance = deadline - now;

  let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  let seconds = Math.floor((distance % (1000 * 60)) / 1000);

  document.getElementById("flash-hours").textContent = String(hours).padStart(2, "0");
  document.getElementById("flash-minutes").textContent = String(minutes).padStart(2, "0");
  document.getElementById("flash-seconds").textContent = String(seconds).padStart(2, "0");

  if (distance < 0) {
    clearInterval(x);
    document.getElementById("flashsale-timer").innerHTML = "Expired";
  }
}, 1000);
</script>

<?php include 'footer.php'; ?>
