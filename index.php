<?php
include ('header.php');
include ('connection.php');

?>

  <!-- Modal Placeholder -->
  <div id="modalContainer"></div>
  

<!-- Hero Section start Here -->

<section class="hero-section">
  <div class="hero-container">
    <div class="slider" id="slider">
      <div class="slide"><img src="images/banner_1.jpg" alt="Banner 1"></div>
      <div class="slide"><img src="images/banner_2.jpg" alt="Banner 2"></div>
      <div class="slide"><img src="images/banner_3.jpg" alt="Banner 3"></div>
      <div class="slide"><img src="images/banner_4.jpg" alt="Banner 4"></div>
      <div class="slide"><img src="images/banner_5.jpg" alt="Banner 5"></div>
    </div>
  </div>
</section>

 
        <!--Hero Section End Here-->
        <section class="feature_section">
            <!-- Section Title -->
            <div class="section_title">
                <h2>Our Features</h2>
            </div>
        
            <div class="feature_container">
        
                <div class="col" tabindex="0">
                    <div class="content">
                        <div class="icon_container">
                            <i class="fa-solid fa-bolt"></i>
                        </div>
                        <div class="text_content_container">
                            <h3>Quick Delivery</h3>
                            <p>Enjoy fast and reliable book delivery with our quick shipping service. 
                                Whether you're ordering a bestseller or a rare find, we ensure your books reach your doorstep promptly 
                                and in perfect condition. Shop now and experience hassle-free reading delivered to you!</p>
                        </div>
                    </div>
                </div>
        
                <div class="col" tabindex="0">
                    <div class="content">
                        <div class="icon_container">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <div class="text_content_container">
                            <h3>Security Payment</h3>
                            <p>Your security is our top priority. 
                                Our book store uses advanced encryption and trusted payment gateways to ensure every transaction is safe and secure. 
                                Shop with confidence knowing that your personal and payment information is fully protected at every step of the checkout process.</p>
                        </div>
                    </div>
                </div>
        
                <div class="col" tabindex="0">
                    <div class="content">
                        <div class="icon_container">
                            <i class="fa-solid fa-thumbs-up"></i>
                        </div>
                        <div class="text_content_container">
                            <h3>Best Quality</h3>
                            <p>We are committed to providing the best quality books to our customers. 
                                From crisp, well-bound pages to vibrant covers, each book is carefully inspected to 
                                meet high standards. Whether new or pre-owned, our collection ensures a premium 
                                reading experience with every purchase.</p>
                        </div>
                    </div>
                </div>
        
                <div class="col" tabindex="0">
                    <div class="content">
                        <div class="icon_container">
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div class="text_content_container">
                            <h3>Return Guarantee</h3>
                            <p>We offer a hassle-free return guarantee to ensure your complete satisfaction.
                                If you receive a damaged, incorrect, or unsatisfactory book, simply return it within the specified period and we’ll gladly offer a replacement or full refund. 
                                Your reading experience matters to us, and we’re here to make it right.</p>
                        </div>
                    </div>
                </div>
        
            </div>
        </section>
<!--Feature Section End-->

<!-- Trending Section Start -->
<!-- Trending Section Start -->
<section class="treading_section">
    <div class="treading_container">
        <div class="col">
            <div class="title_container">
                <h1>Recommended For You</h1>
                <p>Whether you're looking for the latest bestsellers, timeless classics, or personalized recommendations, 
                    our user-friendly interface ensures a smooth and enjoyable book shopping experience.
                    Happy reading!</p>
            </div>
            <div class="content_container">
                <div class="recommendedSwiper swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="img_container">
                                <img src="images/book1.jpg" alt="book1">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="img_container">
                                <img src="images/book2.jpg" alt="book2">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="img_container">
                                <img src="images/book3.jpg" alt="book3">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="img_container">
                                <img src="images/book4.jpg" alt="book4">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="img_container">
                                <img src="images/book5.jpg" alt="book5">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="img_container">
                                <img src="images/book6.jpg" alt="book6">
                            </div>
                        </div>
                    </div>
               </div>
            </div>
        </div>
    </div>
</section>
<!-- Trending Section End -->
 <!-- Special Offer Section Start -->

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
              <a href="order.php" class="buy_btn">Buy Now</a>
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
<!--Special Offer Section End-->
<!-- Flash Sale Section Start -->
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
            <!-- Flash Sale Book 1 -->
            <div class="flashsale-card">
                <img src="images/book7.jpg" alt="Book 1">
                <div class="flashsale-info">
                    <h3>The Enlightened Mind</h3>
                    <p class="author">by Gita Press</p>
                    <p class="original-price">₹499</p>
                    <p class="sale-price">₹299</p>
                    <a href="order.php" class="flashsale-btn">Buy Now</a>
                </div>
            </div>

            <!-- Flash Sale Book 2 -->
            <div class="flashsale-card">
                <img src="images/book8.jpg" alt="Book 2">
                <div class="flashsale-info">
                    <h3>Wisdom of India</h3>
                    <p class="author">by Aurobindo</p>
                    <p class="original-price">₹450</p>
                    <p class="sale-price">₹260</p>
                    <a href="order.php" class="flashsale-btn">Buy Now</a>
                </div>
            </div>
               <!-- Flash Sale Book 3 -->
            <div class="flashsale-card">
                <img src="images/book9.jpg" alt="Book 3">
                <div class="flashsale-info">
                    <h3>Wisdom of India</h3>
                    <p class="author">by Aurobindo</p>
                    <p class="original-price">₹450</p>
                    <p class="sale-price">₹260</p>
                    <a href="order.php" class="flashsale-btn">Buy Now</a>
                </div>
            </div>

        </div>
    </div>
</section>
<!---Flash Section End-->

<!--Testimonial Section Start-->
<section class="testimonial-section">
  <div class="testimonial-container">
    <h2 class="testimonial-title">What Readers Are Saying Behind the Pages</h2>
    <div class="testimonial-slider">
      <!-- Testimonial Card -->
      <div class="testimonial-card">
        <p class="testimonial-text">"Their collection is so diverse and carefully curated that I always find books that inspire and delight me I love how easy it is to find the books I want."</p>
        <div class="testimonial-author">
          <img src="images/user1.jpg" alt="User Name" class="testimonial-avatar" />
          <div>
            <h4 class="author-name">Priya Singh</h4>
            <p class="author-role">Freelance Writer</p>
          </div>
        </div>
      </div>
     <!-- Testimonial Card  2-->
      <div class="testimonial-card">
        <p class="testimonial-text">"This place is a dream for readers like me! No matter what I’m in the mood for, I can always find an amazing book that grabs my attention and keeps me hooked."
</p>
        <div class="testimonial-author">
          <img src="images/user4.jpg" alt="User Name" class="testimonial-avatar" />
          <div>
            <h4 class="author-name">Rajesh Kumar</h4>
            <p class="author-role">Professor</p>
          </div>
        </div>
      </div>
      <!-- Testimonial Card 3 -->
      <div class="testimonial-card">
        <p class="testimonial-text">"I love how this bookstore has something for everyone—every visit feels like a new adventure. It’s the perfect place to discover hidden gems and expand my reading horizons."


</p>
        <div class="testimonial-author">
          <img src="images/user3.jpg" alt="User Name" class="testimonial-avatar" />
          <div>
            <h4 class="author-name">Ananya Sharma</h4>
            <p class="author-role">Student</p>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</section>
<!--Testimonial Section End-->
<!--Blogs Section Start-->
<section class="blog-section">
  <div class="blog-container">
    <h2 class="blog-title">Latest From Our Blog</h2>
    <div class="blog-cards">
      <!-- Blog Card -->
      <article class="blog-card">
        <img src="images/blog1.jpg" alt="Blog Post" class="blog-img" />
        <div class="blog-content">
          <h3 class="blog-post-title">5 Tips to Choose the Perfect Book</h3>
          <p class="blog-excerpt">Choosing the perfect book involves understanding your interests, reading reviews, and exploring different genres. 
            Start by asking yourself what mood you're in...
         </p>
          <a href="blog.php" class="blog-readmore-btn">Read More</a>
        </div>
      </article>
       <!-- Blog Card 2 -->
      <article class="blog-card">
        <img src="images/blog2.jpg" alt="Blog Post" class="blog-img" />
        <div class="blog-content">
          <h3 class="blog-post-title">Unlock Growth Through Reading</h3>
          <p class="blog-excerpt">Reading a book is more than just a pastime — it’s a gateway to personal growth and lifelong learning. On our platform, you’ll find a curated selection of books...
         </p>
          <a href="blog1.php" class="blog-readmore-btn">Read More</a>
        </div>
      </article>
       <!-- Blog Card 3-->
      <article class="blog-card">
        <img src="images/blog3.jpg" alt="Blog Post" class="blog-img" />
        <div class="blog-content">
          <h3 class="blog-post-title">10 Smuttiest Books You Will Ever Read</h3>
          <p class="blog-excerpt">If you love a little spice in your reading list, then these 10 smuttiest books are guaranteed to turn up the heat! Whether you're into steamy romances, tantalizing tales, or bold explorations of desire...
         </p>
          <a href="blog2.php" class="blog-readmore-btn">Read More</a>
        </div>
      </article>
    </div>
  </div>
</section>
<!--blog Section End-->
  
          <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js" integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
       <?php include('footer.php'); ?>
    <script src="javascript.js" defer></script>
    
    </body>
</html>
