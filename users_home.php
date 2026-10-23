<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') != 'user') {
    header("Location:login.php");
    exit;
}

$sql = "SELECT * FROM eproduct";
$result = mysqli_query($conn, $sql);

$userName = htmlspecialchars(
    $_SESSION['user_name'] ?? $_SESSION['name'] ?? 'User',
    ENT_QUOTES,
    'UTF-8'
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Shop Vibe | Durga Puja Sale</title>

<style>

/* ========================================
   SHOP VIBE — BLUE & WHITE THEME
   Primary: #667eea
======================================== */

:root {
    --primary: #667eea;
    --primary-hover: #5a6fd6;
    --primary-dark: #4658c8;
    --text: #1f2937;
    --muted: #6b7280;
    --white: #ffffff;
    --page-bg: #f5f7ff;
    --light-blue: #eef1ff;
    --border: #dbe2ff;
    --shadow: 0 5px 20px rgba(31, 41, 55, 0.08);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

html {
    scroll-behavior: smooth;
    scroll-padding-top: 90px;
}

body {
    background: var(--page-bg);
    color: var(--text);
    line-height: 1.5;
}

a {
    text-decoration: none;
}

/* ========================================
   NAVBAR
======================================== */

.navbar {
    min-height: 70px;
    background: var(--white);
    color: var(--text);
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 6%;
    gap: 15px;
    box-shadow: 0 4px 18px rgba(102, 126, 234, 0.12);
    border-bottom: 1px solid #e5e7eb;
    position: sticky;
    top: 0;
    z-index: 100;
}

.navbar .logo {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 24px;
    font-weight: bold;
    color: var(--primary);
    white-space: nowrap;
}

.navbar .logo img {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    object-fit: cover;
    display: block;
}

.navbar .logo strong {
    color: var(--primary);
}

.nav-right {
    display: flex;
    align-items: center;
    gap: 10px;
}

.welcome {
    color: var(--muted);
    font-size: 14px;
    margin-right: 4px;
}

.navbar .nav-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    padding: 9px 14px;
    background: var(--white);
    color: var(--primary);
    border: 1px solid var(--border);
    border-radius: 9px;
    font-size: 14px;
    font-weight: 600;
    transition: background 0.2s, color 0.2s, border-color 0.2s;
}

.navbar .nav-btn:hover {
    background: var(--light-blue);
    border-color: var(--primary);
}

.navbar .cart-nav-btn {
    background: var(--primary);
    border-color: var(--primary);
    color: var(--white);
}

.navbar .cart-nav-btn:hover {
    background: var(--primary-hover);
    border-color: var(--primary-hover);
}

.nav-menu-toggle {
    display: none;
    align-items: center;
    justify-content: center;
    min-width: 42px;
    min-height: 40px;
    padding: 7px 10px;
    border: 1px solid var(--border);
    border-radius: 9px;
    background: var(--white);
    color: var(--primary);
    font-size: 22px;
    cursor: pointer;
}

/* ========================================
   HERO / FESTIVE SALE BANNER
======================================== */

.hero {
    margin: 28px 6% 24px;
    padding: 52px 25px;
    border: 1px solid var(--border);
    border-radius: 22px;
    color: var(--text);
    text-align: center;
    overflow: hidden;
    background:
        radial-gradient(
            circle at 10% 15%,
            rgba(102, 126, 234, 0.15),
            transparent 35%
        ),
        radial-gradient(
            circle at 90% 85%,
            rgba(102, 126, 234, 0.12),
            transparent 35%
        ),
        linear-gradient(135deg, #ffffff, #f0f3ff);
    position: relative;
    box-shadow: 0 12px 35px rgba(102, 126, 234, 0.10);
}

.hero-content {
    position: relative;
    z-index: 1;
}

.sale-label {
    display: inline-block;
    background: var(--light-blue);
    color: var(--primary-dark);
    border: 1px solid var(--border);
    padding: 7px 16px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: bold;
    letter-spacing: 1px;
}

.hero h1 {
    font-size: clamp(30px, 5vw, 50px);
    line-height: 1.2;
    font-weight: 800;
    margin: 18px 0 12px;
    color: var(--text);
}

.hero h1 span {
    display: block;
    color: var(--primary);
}

.hero p {
    color: var(--muted);
    font-size: 16px;
    line-height: 1.8;
    margin-bottom: 22px;
}

.hero-decoration {
    position: absolute;
    inset: 0;
    overflow: hidden;
    pointer-events: none;
    color: rgba(102, 126, 234, 0.25);
}

.hero-decoration span {
    position: absolute;
    font-size: 38px;
}

.hero-decoration span:nth-child(1) {
    top: 15%;
    left: 8%;
}

.hero-decoration span:nth-child(2) {
    top: 20%;
    right: 9%;
    font-size: 48px;
}

.hero-decoration span:nth-child(3) {
    bottom: 12%;
    right: 17%;
    font-size: 27px;
}

/* Countdown: keeps existing React countdown classes */

.countdown {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin: 20px 0 25px;
    flex-wrap: wrap;
}

.time-box {
    min-width: 75px;
    padding: 12px 10px;
    background: var(--white);
    color: var(--primary-dark);
    border: 1px solid var(--border);
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.08);
}

.time-box strong {
    display: block;
    font-size: 27px;
    line-height: 1.4;
    color: var(--primary);
}

.time-box small {
    font-size: 12px;
    color: var(--muted);
}

/* Shared Shop Now button */

.shop-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: var(--primary);
    color: var(--white);
    padding: 13px 27px;
    border: 1px solid var(--primary);
    border-radius: 30px;
    font-weight: bold;
    box-shadow: 0 5px 14px rgba(102, 126, 234, 0.22);
    transition: background 0.2s, transform 0.2s, box-shadow 0.2s;
}

.shop-btn:hover {
    background: var(--primary-hover);
    box-shadow: 0 8px 18px rgba(102, 126, 234, 0.28);
    transform: translateY(-2px);
}

/* ========================================
   FEATURES
======================================== */

.features {
    margin: 0 6% 32px;
    padding: 20px;
    background: var(--white);
    border: 1px solid #edf0ff;
    border-radius: 16px;
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 15px;
    text-align: center;
    box-shadow: var(--shadow);
}

.feature {
    padding: 10px;
    color: var(--muted);
    font-size: 14px;
}

.feature strong {
    display: block;
    margin-bottom: 5px;
    color: var(--primary-dark);
    font-size: 15px;
}

/* ========================================
   PRODUCTS SECTION
======================================== */

.products-section {
    padding: 10px 6% 45px;
    scroll-margin-top: 85px;
}

.section-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
    margin-bottom: 22px;
}

.section-heading h2 {
    font-size: 27px;
    color: var(--text);
}

.section-heading p {
    color: var(--muted);
    margin-top: 6px;
    font-size: 14px;
}

/* Existing product grid */

.products {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 18px;
}

.product-card {
    background: var(--white);
    border: 1px solid #edf0ff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: transform 0.25s, box-shadow 0.25s;
    display: flex;
    flex-direction: column;
    min-width: 0;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(102, 126, 234, 0.15);
}

.product-image {
    width: 100%;
    height: 190px;
    padding: 10px;
    object-fit: contain;
    background: var(--white);
}

.product-info {
    padding: 15px;
    display: flex;
    flex-direction: column;
    flex: 1;
    min-width: 0;
}

.product-info h3 {
    font-size: 16px;
    overflow-wrap: anywhere;
    margin-bottom: 8px;
    color: var(--text);
}

.product-info h3 a {
    color: inherit;
}

.product-info h3 a:hover {
    color: var(--primary);
}

.brand {
    color: var(--muted);
    font-size: 13px;
    margin-bottom: 12px;
}

.price {
    color: var(--primary-dark);
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 15px;
}

.cart-btn {
    margin-top: auto;
    display: block;
    width: 100%;
    padding: 12px;
    background: var(--primary);
    color: var(--white);
    border: 1px solid var(--primary);
    border-radius: 9px;
    text-align: center;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.2s, transform 0.2s;
}

.cart-btn:hover {
    background: var(--primary-hover);
    transform: translateY(-1px);
}

/* Empty product state */

.empty {
    background: var(--white);
    padding: 25px;
    border: 1px solid var(--border);
    border-radius: 12px;
    color: var(--muted);
    grid-column: 1 / -1;
}

/* ========================================
   DEAL STRIP
======================================== */

.deal-strip {
    margin: 0 6% 35px;
    background: var(--white);
    border: 1px solid var(--border);
    border-left: 5px solid var(--primary);
    border-radius: 14px;
    padding: 20px 22px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    box-shadow: var(--shadow);
}

.deal-strip h3 {
    color: var(--primary-dark);
    margin-bottom: 5px;
}

.deal-strip p {
    color: var(--muted);
    font-size: 13px;
}

/* ========================================
   FOOTER
======================================== */

footer {
    background: var(--white);
    color: var(--muted);
    text-align: center;
    padding: 28px 15px;
    font-size: 13px;
    border-top: 1px solid var(--border);
}

footer h3 {
    color: var(--primary);
    font-size: 21px;
}

/* ========================================
   TABLET
======================================== */

@media (max-width: 950px) {
    .products {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .navbar {
        padding-left: 4%;
        padding-right: 4%;
    }
}

/* ========================================
   MOBILE
======================================== */

@media (max-width: 650px) {
    .navbar {
        padding: 12px 15px;
        gap: 10px;
        flex-wrap: wrap;
    }

    .navbar .logo {
        font-size: 20px;
        gap: 8px;
    }

    .navbar .logo img {
        width: 38px;
        height: 38px;
    }

    .nav-menu-toggle {
        display: inline-flex;
        margin-left: auto;
    }

    .nav-right {
        display: none;
        flex: 0 0 100%;
        width: 100%;
        flex-direction: column;
        align-items: stretch;
        gap: 9px;
        padding-top: 10px;
        border-top: 1px solid var(--border);
    }

    .nav-right.nav-open {
        display: flex;
    }

    .welcome {
        display: block;
        padding: 5px 2px;
    }

    .navbar .nav-btn {
        width: 100%;
        padding: 11px;
        font-size: 14px;
    }

    .hero {
        margin: 20px 15px;
        padding: 36px 16px;
        border-radius: 17px;
    }

    .hero h1 {
        font-size: clamp(29px, 8vw, 38px);
    }

    .hero p {
        font-size: 14px;
    }

    .hero-decoration span {
        font-size: 25px;
    }

    .countdown {
        gap: 8px;
    }

    .time-box {
        min-width: 62px;
        padding: 10px 7px;
    }

    .time-box strong {
        font-size: 22px;
    }

    .time-box small {
        font-size: 11px;
    }

    .features {
        margin: 0 15px 25px;
        padding: 13px;
        grid-template-columns: 1fr;
        text-align: left;
        gap: 5px;
    }

    .feature {
        padding: 10px;
    }

    .products-section {
        padding: 5px 15px 30px;
    }

    .section-heading h2 {
        font-size: 22px;
    }

    .products {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .product-image {
        height: 145px;
    }

    .product-info {
        padding: 11px;
    }

    .product-info h3 {
        font-size: 14px;
    }

    .price {
        font-size: 17px;
    }

    .cart-btn {
        font-size: 12px;
        padding: 10px 5px;
    }

    .deal-strip {
        margin: 0 15px 25px;
        padding: 16px;
        flex-direction: column;
        align-items: flex-start;
    }

    .deal-strip .shop-btn {
        align-self: flex-start;
    }
}

/* Extra-small phones */

@media (max-width: 350px) {
    .products {
        grid-template-columns: 1fr;
    }

    .hero {
        padding: 30px 12px;
    }

    .hero h1 {
        font-size: 27px;
    }

    .shop-btn {
        padding: 11px 20px;
    }
}

/* Reduced motion accessibility */

@media (prefers-reduced-motion: reduce) {
    html {
        scroll-behavior: auto;
    }

    *,
    *::before,
    *::after {
        transition-duration: 0.01ms !important;
        animation-duration: 0.01ms !important;
    }
}

/* =========================================
   SHOP VIBE — PREMIUM HOMEPAGE ANIMATIONS
   ========================================= */

/* Smooth entrance for the hero banner */
@keyframes svHeroEnter {
    from {
        opacity: 0;
        transform: translateY(24px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.hero {
    animation: svHeroEnter 0.85s cubic-bezier(.2, .7, .2, 1) both;
}

.hero .sale-label {
    animation: svHeroEnter 0.65s ease-out 0.1s both;
}

.hero h1 {
    animation: svHeroEnter 0.75s ease-out 0.2s both;
}

.hero p {
    animation: svHeroEnter 0.75s ease-out 0.3s both;
}

.hero .countdown {
    animation: svHeroEnter 0.75s ease-out 0.4s both;
}

.hero .shop-btn {
    animation: svHeroEnter 0.75s ease-out 0.5s both;
}

/* Floating decorative elements */
@keyframes svFloat {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-12px) rotate(5deg);
    }
}

.hero-decoration span:nth-child(1) {
    animation: svFloat 4s ease-in-out infinite;
}

.hero-decoration span:nth-child(2) {
    animation: svFloat 5s ease-in-out 0.5s infinite;
}

.hero-decoration span:nth-child(3) {
    animation: svFloat 4.5s ease-in-out 1s infinite;
}

/* Countdown boxes */
.time-box {
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.time-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 24px rgba(102, 126, 234, 0.18);
}

/* Features: subtle lift */
.feature {
    border-radius: 12px;
    transition: background 0.3s ease, transform 0.3s ease;
}

.feature:hover {
    background: #f5f7ff;
    transform: translateY(-4px);
}

/* Product cards: staggered entrance */
@keyframes svCardEnter {
    from {
        opacity: 0;
        transform: translateY(22px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.products > .product-card {
    animation: svCardEnter 0.65s ease both;
}

.products > .product-card:nth-child(1)  { animation-delay: 0.05s; }
.products > .product-card:nth-child(2)  { animation-delay: 0.10s; }
.products > .product-card:nth-child(3)  { animation-delay: 0.15s; }
.products > .product-card:nth-child(4)  { animation-delay: 0.20s; }
.products > .product-card:nth-child(5)  { animation-delay: 0.25s; }
.products > .product-card:nth-child(6)  { animation-delay: 0.30s; }
.products > .product-card:nth-child(7)  { animation-delay: 0.35s; }
.products > .product-card:nth-child(8)  { animation-delay: 0.40s; }

/* Premium card hover */
.product-card {
    transition:
        transform 0.3s cubic-bezier(.2, .7, .2, 1),
        box-shadow 0.3s ease,
        border-color 0.3s ease;
}

.product-card:hover {
    transform: translateY(-7px);
    border-color: #cbd4ff;
    box-shadow: 0 16px 32px rgba(70, 88, 200, 0.14);
}

.product-card .product-image {
    transition: transform 0.45s cubic-bezier(.2, .7, .2, 1);
}

.product-card:hover .product-image {
    transform: scale(1.045);
}

/* Section heading accent */
.section-heading h2 {
    transition: color 0.25s ease;
}

.section-heading:hover h2 {
    color: var(--primary-dark);
}

/* Buttons: smooth interaction */
.shop-btn,
.cart-btn,
.navbar .nav-btn {
    transition:
        transform 0.25s ease,
        box-shadow 0.25s ease,
        background 0.25s ease,
        border-color 0.25s ease;
}

.shop-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 24px rgba(102, 126, 234, 0.3);
}

.cart-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 7px 16px rgba(102, 126, 234, 0.2);
}

.navbar .nav-btn:hover {
    transform: translateY(-1px);
}

/* Deal strip entrance */
.deal-strip {
    animation: svHeroEnter 0.75s ease-out both;
}

/* Keyboard accessibility */
.shop-btn:focus-visible,
.cart-btn:focus-visible,
.navbar .nav-btn:focus-visible {
    outline: 3px solid rgba(102, 126, 234, 0.45);
    outline-offset: 3px;
}

/* Respect users who prefer reduced motion */
@media (prefers-reduced-motion: reduce) {
    .hero,
    .hero .sale-label,
    .hero h1,
    .hero p,
    .hero .countdown,
    .hero .shop-btn,
    .hero-decoration span,
    .products > .product-card,
    .deal-strip {
        animation: none !important;
    }

    .product-card,
    .product-card .product-image,
    .feature,
    .time-box,
    .shop-btn,
    .cart-btn,
    .navbar .nav-btn {
        transition: none !important;
    }

    .product-card:hover,
    .product-card:hover .product-image,
    .feature:hover,
    .time-box:hover {
        transform: none;
    }
}

/* Scroll-triggered reveal */
.sv-reveal {
    opacity: 0;
    transform: translateY(24px);
    transition:
        opacity 0.7s ease,
        transform 0.7s cubic-bezier(.2, .7, .2, 1);
}

.sv-reveal.sv-visible {
    opacity: 1;
    transform: translateY(0);
}

/* Prevent hidden sections if motion is disabled */
@media (prefers-reduced-motion: reduce) {
    .sv-reveal {
        opacity: 1;
        transform: none;
        transition: none;
    }
}

/* Premium sticky navbar */
.navbar {
    transition: box-shadow 0.3s ease,
                background-color 0.3s ease,
                border-color 0.3s ease;
}

.navbar.sv-scrolled {
    box-shadow: 0 8px 28px rgba(70, 88, 200, 0.16);
    border-bottom-color: rgba(102, 126, 234, 0.25);
}

/* Premium button press */
.shop-btn,
.cart-btn,
.navbar .nav-btn {
    position: relative;
    overflow: hidden;
    -webkit-tap-highlight-color: transparent;
}

.shop-btn:active,
.cart-btn:active,
.navbar .nav-btn:active {
    transform: scale(0.97);
}

</style>
</head>

<body>

<nav class="navbar">
    <a href="index.php" class="logo">
        <img src="Assets/LOGO.jpg" alt="Shop Vibe Logo">
        <span>Shop <strong>Vibe</strong></span>
    </a>

    <button
        class="nav-menu-toggle"
        type="button"
        aria-label="Toggle navigation"
        aria-expanded="false"
        onclick="const menu = this.nextElementSibling; const open = menu.classList.toggle('nav-open'); this.setAttribute('aria-expanded', open);"
     >
        ☰
    </button>

    <div class="nav-right">
        <span class="welcome">
            Welcome, <?php echo htmlspecialchars($userName, ENT_QUOTES, 'UTF-8'); ?>
        </span>

        <a href="#products" class="nav-btn">Products</a>
        <a href="cart.php" class="nav-btn cart-nav-btn">
            🛒 <span>Cart</span>
        </a>
        <a href="logout.php" class="nav-btn logout-btn">Logout</a>
    </div>
</nav>

<!-- React-powered festive sale section -->
<!-- Shop Vibe Festive Hero Banner -->
<section class="hero" id="sale-app">
    <div class="hero-content">
        <span class="sale-label">✨ FESTIVE SPECIAL</span>

        <h1>
            Celebrate Durga Puja
            <span>with Amazing Deals!</span>
        </h1>

        <p class="hero-description">
            IS LIVE! &nbsp; | &nbsp; Exciting Offers &nbsp; | &nbsp; Best Deals
        </p>

        <div id="countdown-root"></div>

        <a href="#products" class="shop-btn">
            Shop Now <span aria-hidden="true">→</span>
        </a>
    </div>

    <div class="hero-decoration" aria-hidden="true">
        <span>✦</span>
        <span>✧</span>
        <span>✦</span>
    </div>
</section>


<section class="features">
    <div class="feature"><strong>🚚 Free Shipping</strong>On orders above ₹999</div>
    <div class="feature"><strong>🔒 Secure Shopping</strong>Shop with confidence</div>
    <div class="feature"><strong>🎁 Festive Deals</strong>Discover your favourites</div>
</section>


<section class="products-section" id="products">
    <div class="section-heading">
        <div>
            <h2>Our Products 🛍️</h2>
            <p>Discover amazing products and start shopping today.</p>
        </div>
    </div>

    <div id="products-root"></div>
</section>


<div class="deal-strip">
    <div>
        <h3>🎁 Special Festive Deals</h3>
        <p>Explore your favourite products this Durga Puja!</p>
    </div>
    <a href="#products" class="shop-btn">Shop Now ✨</a>
</div>

<footer>
    <h3>🛒 Shop Vibe</h3>
    <p style="margin-top:8px;">Your Style • Our Priority</p>
    <p style="margin-top:10px;">© 2026 Shop Vibe. All rights reserved.</p>
</footer>

<?php
$manifestPath = __DIR__ . '/frontend/dist/.vite/manifest.json';

if (file_exists($manifestPath)) {
    $manifest = json_decode(file_get_contents($manifestPath), true);
    $entry = $manifest['index.html'] ?? null;

    if ($entry) {
        foreach ($entry['css'] ?? [] as $cssFile) {
            echo '<link rel="stylesheet" href="frontend/dist/' .
                htmlspecialchars($cssFile, ENT_QUOTES, 'UTF-8') . '">' . PHP_EOL;
        }

        if (!empty($entry['file'])) {
            echo '<script type="module" src="frontend/dist/' .
                htmlspecialchars($entry['file'], ENT_QUOTES, 'UTF-8') .
                '"></script>' . PHP_EOL;
        }
    }
}
?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const reducedMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    ).matches;

    const sections = document.querySelectorAll(
        ".features, .products-section, .deal-strip, footer"
    );

    if (reducedMotion || !("IntersectionObserver" in window)) {
        return;
    }

    sections.forEach(function (section) {
        section.classList.add("sv-reveal");
    });

    const observer = new IntersectionObserver(
        function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add("sv-visible");
                    observer.unobserve(entry.target);
                }
            });
        },
        {
            threshold: 0.12,
            rootMargin: "0px 0px -35px 0px"
        }
    );

    sections.forEach(function (section) {
        observer.observe(section);
    });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.querySelector(".navbar");

    if (!navbar) return;

    function updateNavbar() {
        navbar.classList.toggle("sv-scrolled", window.scrollY > 10);
    }

    updateNavbar();
    window.addEventListener("scroll", updateNavbar, { passive: true });
});
</script>

<script>
document.addEventListener("click", function (event) {
    const button = event.target.closest(
        ".shop-btn, .cart-btn, .navbar .nav-btn"
    );

    if (!button || button.disabled) return;
    if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
        return;
    }

    const rect = button.getBoundingClientRect();
    const ripple = document.createElement("span");

    const size = Math.max(rect.width, rect.height);

    ripple.style.cssText = `
        position: absolute;
        width: ${size}px;
        height: ${size}px;
        left: ${event.clientX - rect.left - size / 2}px;
        top: ${event.clientY - rect.top - size / 2}px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.4);
        transform: scale(0);
        animation: svRipple 0.55s ease-out forwards;
        pointer-events: none;
    `;

    button.appendChild(ripple);

    ripple.addEventListener("animationend", function () {
        ripple.remove();
    }, { once: true });
});
</script>

<style>
@keyframes svRipple {
    to {
        transform: scale(2.5);
        opacity: 0;
    }
}
</style>



</body>
</html>