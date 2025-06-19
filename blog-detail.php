<?php
include 'connection.php';  // Database connection file

if (!isset($_GET['id'])) {
    echo "No blog selected.";
    exit;
}

$blog_id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT title, content, image FROM blogs WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $blog_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Blog not found.";
    exit;
}

$blog = $result->fetch_assoc();

include 'header.php';
?>

<section class="blog-detail-section" style="max-width: 800px; margin: auto; padding: 20px;">
    <h2><?php echo htmlspecialchars($blog['title']); ?></h2>

    <?php
    $image_path = (!empty($blog['image']) && file_exists($blog['image'])) ? $blog['image'] : 'images/default-blog.jpg';
    ?>

    <img 
        src="<?php echo htmlspecialchars($image_path); ?>" 
        alt="<?php echo htmlspecialchars($blog['title']); ?>" 
        style="width:100%; height:auto; margin-bottom: 20px;"
    />

    <div>
        <p><?php echo nl2br(htmlspecialchars($blog['content'])); ?></p>
    </div>

    <a href="blogs.php" style="display:inline-block; margin-top: 20px;">← Back to Blogs</a>
</section>

<?php include 'footer.php'; ?>
