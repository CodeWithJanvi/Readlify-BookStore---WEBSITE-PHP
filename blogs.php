<?php
include 'connection.php';

// Fetch blog posts with file_name too
$sql = "SELECT id, title, content, image, file_name FROM blogs ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<?php include 'header.php'; ?>

<section class="blog-section">
  <div class="blog-container">
    <h2 class="blog-title">Latest From Our Blog</h2>
    <div class="blog-cards">
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <?php
            $excerpt_length = 150;
            $short_excerpt = substr($row['content'], 0, $excerpt_length);
            if (strlen($row['content']) > $excerpt_length) {
              $last_space = strrpos($short_excerpt, ' ');
              if ($last_space !== false) {
                $short_excerpt = substr($short_excerpt, 0, $last_space);
              }
              $short_excerpt .= "...";
            }
            $image_src = !empty($row['image']) ? $row['image'] : 'images/default-blog.jpg';
            $file_name = !empty($row['file_name']) ? $row['file_name'] : 'blog_detail.php?id=' . $row['id'];
          ?>
          <article class="blog-card">
            <img src="<?php echo htmlspecialchars($image_src); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" class="blog-img" />
            <div class="blog-content">
              <h3 class="blog-post-title"><?php echo htmlspecialchars($row['title']); ?></h3>
              <p class="blog-excerpt"><?php echo nl2br(htmlspecialchars($short_excerpt)); ?></p>
              <a href="<?php echo htmlspecialchars($file_name); ?>" class="blog-readmore-btn" aria-label="Read full article: <?php echo htmlspecialchars($row['title']); ?>">Read More</a>
            </div>
          </article>
        <?php endwhile; ?>
      <?php else: ?>
        <p>No blog posts found.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>
