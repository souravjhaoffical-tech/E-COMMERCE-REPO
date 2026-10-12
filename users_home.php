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
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background: #f5f6fa;
    color: #25213b;
}

a { text-decoration: none; }

.navbar {
    min-height: 70px;
    background: white;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 6%;
    gap: 15px;
    box-shadow: 0 2px 10px #0000000c;
    position: sticky;
    top: 0;
    z-index: 10;
}

.logo {
    font-size: 25px;
    font-weight: bold;
    color: #667eea;
}

.nav-right {
    display: flex;
    align-items: center;
    gap: 12px;
}

.welcome {
    color: #555;
    font-size: 14px;
}

.nav-btn {
    padding: 10px 16px;
    background: #667eea;
    color: white;
    border-radius: 9px;
    font-size: 14px;
}

.hero {
    margin: 28px 6% 22px;
    padding: 40px 25px;
    border-radius: 20px;
    color: white;
    text-align: center;
    overflow: hidden;
    background:
        radial-gradient(circle at 10% 20%, #ff9b3829, transparent 30%),
        linear-gradient(120deg, #32105c, #7115a0 55%, #c21c57);
    position: relative;
}

.sale-label {
    display: inline-block;
    background: #ff9c35;
    color: #35104e;
    padding: 7px 16px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: bold;
    letter-spacing: 1px;
}

.hero h1 {
    font-size: clamp(30px, 5vw, 48px);
    margin: 16px 0 10px;
}

.hero h1 span { color: #ffd46c; }

.hero p {
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 22px;
}

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
    background: #ffffff18;
    border: 1px solid #ffffff60;
    border-radius: 12px;
}

.time-box strong {
    display: block;
    font-size: 27px;
}

.time-box small { font-size: 12px; }

.shop-btn {
    display: inline-block;
    background: linear-gradient(135deg, #ffad39, #ffdf80);
    color: #42104f;
    padding: 13px 27px;
    border-radius: 30px;
    font-weight: bold;
    transition: .2s;
}

.shop-btn:hover { transform: scale(1.04); }

.features {
    margin: 0 6% 30px;
    padding: 18px;
    background: white;
    border-radius: 14px;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    text-align: center;
    box-shadow: 0 4px 16px #00000008;
}

.feature {
    padding: 8px;
    color: #51419a;
    font-size: 14px;
}

.feature strong {
    display: block;
    margin-bottom: 5px;
}

.products-section {
    padding: 10px 6% 45px;
}

.section-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
    margin-bottom: 22px;
}

.section-heading h2 { font-size: 27px; }

.section-heading p {
    color: #777;
    margin-top: 6px;
    font-size: 14px;
}

.products {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 18px;
}

.product-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px #0000000c;
    transition: transform .25s, box-shadow .25s;
    display: flex;
    flex-direction: column;
    min-width: 0;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px #00000014;
}

.product-image {
    width: 100%;
    height: 190px;
    padding: 10px;
    object-fit: contain;
    background: #fff;
}

.product-info {
    padding: 15px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.product-info h3 {
    font-size: 16px;
    overflow-wrap: anywhere;
    margin-bottom: 8px;
}

.brand {
    color: #777;
    font-size: 13px;
    margin-bottom: 12px;
}

.price {
    color: #6741dc;
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 15px;
}

.cart-btn {
    margin-top: auto;
    display: block;
    width: 100%;
    padding: 12px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: 0;
    border-radius: 9px;
    text-align: center;
    font-weight: bold;
    cursor: pointer;
}

.cart-btn:hover { opacity: .9; }

.empty {
    background: white;
    padding: 25px;
    border-radius: 12px;
    color: #666;
    grid-column: 1 / -1;
}

.deal-strip {
    margin: 0 6% 35px;
    background: #eee9ff;
    border: 1px solid #dfd5ff;
    border-radius: 13px;
    padding: 18px 22px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
}

.deal-strip h3 { color: #5c35bd; margin-bottom: 5px; }
.deal-strip p { color: #666; font-size: 13px; }

footer {
    background: #211b3e;
    color: white;
    text-align: center;
    padding: 25px 15px;
    font-size: 13px;
}

@media (max-width: 950px) {
    .products { grid-template-columns: repeat(3, minmax(0, 1fr)); }
}

@media (max-width: 650px) {
    .navbar { padding: 14px 18px; }
    .logo { font-size: 20px; }
    .nav-right { gap: 7px; }
    .welcome { display: none; }
    .nav-btn { padding: 9px 11px; font-size: 12px; }

    .hero { margin: 20px 15px; padding: 30px 15px; }
    .hero p { font-size: 14px; }
    .time-box { min-width: 62px; padding: 10px 7px; }
    .time-box strong { font-size: 22px; }

    .features {
        margin: 0 15px 25px;
        grid-template-columns: 1fr;
        text-align: left;
    }

    .products-section { padding: 5px 15px 30px; }
    .section-heading h2 { font-size: 22px; }
    .products { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; }
    .product-image { height: 145px; }
    .product-info { padding: 11px; }
    .product-info h3 { font-size: 14px; }
    .price { font-size: 17px; }
    .cart-btn { font-size: 12px; padding: 10px 5px; }

    .deal-strip { margin: 0 15px 25px; padding: 15px; }
}

@media (max-width: 350px) {
    .products { grid-template-columns: 1fr; }
}
</style>
</head>

<body>

<nav class="navbar">
    <div class="logo">🛒 Shop Vibe</div>

    <div class="nav-right">
        <span class="welcome">Welcome, <?php echo $userName; ?></span>
        <a href="#products" class="nav-btn">Products</a>
        <a href="cart.php" class="nav-btn">🛒 Cart</a>
        <a href="logout.php" class="nav-btn">Logout</a>
    </div>
</nav>

<!-- React-powered festive sale section -->
<section class="hero" id="sale-app">
    <span class="sale-label">FESTIVE SPECIAL</span>
    <h1>Durga Puja <span>Sale</span> 🪔</h1>
    <p>IS LIVE! &nbsp; | &nbsp; Big Discounts &nbsp; | &nbsp; Best Deals</p>
    <div class="countdown">
        <div class="time-box"><strong>--</strong><small>Days</small></div>
        <div class="time-box"><strong>--</strong><small>Hours</small></div>
        <div class="time-box"><strong>--</strong><small>Minutes</small></div>
        <div class="time-box"><strong>--</strong><small>Seconds</small></div>
    </div>
    <a href="#products" class="shop-btn">Shop Now →</a>
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

    <div class="products">
    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <?php while ($product = mysqli_fetch_assoc($result)): ?>
            <article class="product-card">
                <img
                    src="uploads/<?php echo rawurlencode(basename($product['image'] ?? '')); ?>"
                    class="product-image"
                    alt="<?php echo htmlspecialchars($product['p_name'] ?? 'Product', ENT_QUOTES, 'UTF-8'); ?>"
                    loading="lazy"
                    onerror="this.style.visibility='hidden';"
                >

                <div class="product-info">
                    <h3><?php echo htmlspecialchars($product['p_name'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h3>

                    <p class="brand">
                        <?php echo htmlspecialchars($product['p_brand'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                    </p>

                    <div class="price">
                        ₹<?php echo htmlspecialchars((string)($product['p_price'] ?? '0'), ENT_QUOTES, 'UTF-8'); ?>
                    </div>

                    <a
                        href="add_cart.php?id=<?php echo urlencode((string)$product['id']); ?>"
                        class="cart-btn"
                    >🛒 Add to Cart</a>
                </div>
            </article>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="empty">No products available right now. Please check back soon!</p>
    <?php endif; ?>
    </div>
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

<!-- React for the countdown only; PHP still renders products -->
<script src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
<script src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>
<script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>

<script type="text/babel">
const saleEnd = new Date("2026-10-20T23:59:59+05:30");

function SaleCountdown() {
    const [remaining, setRemaining] = React.useState(
        Math.max(0, saleEnd.getTime() - Date.now())
    );

    React.useEffect(() => {
        const timer = setInterval(() => {
            setRemaining(Math.max(0, saleEnd.getTime() - Date.now()));
        }, 1000);

        return () => clearInterval(timer);
    }, []);

    const totalSeconds = Math.floor(remaining / 1000);
    const days = Math.floor(totalSeconds / 86400);
    const hours = Math.floor((totalSeconds % 86400) / 3600);
    const minutes = Math.floor((totalSeconds % 3600) / 60);
    const seconds = totalSeconds % 60;

    const units = [
        [days, "Days"],
        [hours, "Hours"],
        [minutes, "Minutes"],
        [seconds, "Seconds"]
    ];

    return (
        <div className="countdown" aria-live="polite">
            {units.map(([value, label]) => (
                <div className="time-box" key={label}>
                    <strong>{String(value).padStart(2, "0")}</strong>
                    <small>{label}</small>
                </div>
            ))}
        </div>
    );
}

const root = document.querySelector("#sale-app");
if (root) {
    const countdownMount = document.createElement("div");
    const oldCountdown = root.querySelector(".countdown");
    if (oldCountdown) oldCountdown.replaceWith(countdownMount);
    ReactDOM.createRoot(countdownMount).render(<SaleCountdown />);
}
</script>

</body>
</html>