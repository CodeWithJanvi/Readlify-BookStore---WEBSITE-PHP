<?php
include 'connection.php';
include 'header.php';
?>

<section class="special_offer_section">
  <div class="special_offer_container">
    <div class="title_container">
      <h2>Special Offer</h2>
      <h1>Top Picks for You</h1>
    </div>
    <div class="content_container">
      <?php
      $sql = "SELECT id, title, author, price, image, rating_star FROM books ORDER BY id DESC LIMIT 4";
      $result = $conn->query($sql);

      if ($result && $result->num_rows > 0):
        while ($row = $result->fetch_assoc()):
          $image_src = !empty($row['image']) ? 'images/' . $row['image'] : 'images/default-book.jpg';
      ?>
          <div class="product_card">
            <div class="img_container">
              <img src="<?php echo htmlspecialchars($image_src); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" />
            </div>
            <div class="text_container">
              <h1><?php echo htmlspecialchars($row['title']); ?></h1>
              <h3>by <?php echo htmlspecialchars($row['author']); ?></h3>
              <div class="rating">
                <p><i class="fa-solid fa-star"></i> <?php echo htmlspecialchars($row['rating_star']); ?></p>
              </div>
              <div class="price">&#8377;<?php echo htmlspecialchars($row['price']); ?></div>
              <a href="order.php?book_id=<?php echo $row['id']; ?>" class="buy_btn">Buy Now</a>

            </div>
          </div>
      <?php
        endwhile;
      else:
        echo "<p>No books found.</p>";
      endif;
      $conn->close();
      ?>
    </div>

    <div class="view_more_container">
      <a href="all-book.php" class="view_more_btn">View More</a>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>
