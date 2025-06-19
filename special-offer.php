<?php include 'header.php'; ?>

<section class="special_offer_section">
    <div class="offer_container">
        <h2>🔥 Special Offers</h2>
        <p>Grab these limited-time deals before they're gone!</p>

        <div class="offer_items">
            <div class="offer_card">
                <img src="images/book12.jpg" alt="Cover of the book 'Lord City: Shree Krishna'">
                <h3>Lord City: Shree Krishna</h3>
                <p><del>$20.00</del> <strong>$10.00</strong></p>
                <button class="buy_now" onclick="location.href='order.php?book=krishna'">Buy Now</button>
            </div>

            <div class="offer_card">
                <img src="images/book11.jpg" alt="Cover of the book 'Why I Am Hindu'">
                <h3>Why I Am Hindu</h3>
                <p><del>$15.00</del> <strong>$7.50</strong></p>
                <button class="buy_now" onclick="location.href='order.php?book=hindu'">Buy Now</button>
            </div>
        </div>

        <div id="flashsale-timer" class="flashsale-timer">
            <span id="flash-hours">00</span> :
            <span id="flash-minutes">00</span> :
            <span id="flash-seconds">00</span>
        </div>
    </div>
</section>

<script>
let flashDeadline = new Date().getTime() + 60 * 60 * 1000;
let flashInterval = setInterval(function () {
    let now = new Date().getTime();
    let distance = flashDeadline - now;

    let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("flash-hours").textContent = String(hours).padStart(2, '0');
    document.getElementById("flash-minutes").textContent = String(minutes).padStart(2, '0');
    document.getElementById("flash-seconds").textContent = String(seconds).padStart(2, '0');

    if (distance < 0) {
        clearInterval(flashInterval);
        document.getElementById("flashsale-timer").textContent = "EXPIRED";
    }
}, 1000);
</script>

<?php include 'footer.php'; ?>
