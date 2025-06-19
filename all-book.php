<?php 
include 'connection.php';
include 'header.php';
?>

<h1 style="text-align:center; margin: 20px 0;">All Available Books</h1>

<!-- Book Listing Section -->
<section class="special_offer_section">
  <div class="special_offer_container">
    <div class="content_container">
      <?php
      $sql = "SELECT id, title, author, price, image, rating_star FROM books ORDER BY id DESC";
      $result = $conn->query($sql);

      if ($result && $result->num_rows > 0):
        while ($row = $result->fetch_assoc()):
          $image_src = !empty($row['image']) ? 'images/' . $row['image'] : 'images/default-book.jpg';
      ?>
        <div class="product_card">
          <div class="img_container">
            <img src="<?php echo htmlspecialchars($image_src); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
          </div>
          <div class="text_container">
            <h1><?php echo htmlspecialchars($row['author']); ?></h1>
            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
            <div class="rating">
              <p><i class="fa-solid fa-star"></i> <?php echo htmlspecialchars($row['rating_star']); ?></p>
            </div>
            <h2 class="price">&#8377;<?php echo htmlspecialchars($row['price']); ?></h2>
            <a href="#" class="buy_btn">Buy Now</a>
          </div>
        </div>
      <?php
        endwhile;
      else:
        echo "<p>No books available right now.</p>";
      endif;

      $conn->close();
      ?>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>
