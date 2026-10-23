<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Why Choose Us - ShopVibe</title>
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Arial,sans-serif}
body{background:#f5f7fb;color:#222}
nav{background:#111827;padding:15px 5%;display:flex;justify-content:space-between;align-items:center;gap:15px;flex-wrap:wrap}
.logo{display:flex;align-items:center;gap:10px;color:#ff9800;font-size:25px;font-weight:bold;text-decoration:none}
.logo img{width:42px;height:42px;object-fit:contain}
nav ul{display:flex;gap:20px;list-style:none;flex-wrap:wrap}
nav ul a{color:white;text-decoration:none;font-size:14px}
nav ul a:hover,.active{color:#ff9800}
.hero{background:linear-gradient(135deg,#111827,#4338ca);color:white;text-align:center;padding:75px 20px}
.hero h1{font-size:42px;margin-bottom:15px}
span{color:#ff9800}
.content{max-width:1100px;margin:45px auto;padding:20px}
.cards{display:grid;grid-template-columns:repeat(3,1fr);gap:22px}
.card{background:white;padding:30px 20px;text-align:center;border-radius:14px;box-shadow:0 6px 20px #0001;transition:.3s}
.card:hover{transform:translateY(-6px)}
.icon{font-size:40px}
.card h2{margin:15px 0}
.card p{color:#555;line-height:1.7}
footer{background:#111827;color:white;text-align:center;padding:22px}
@media(max-width:768px){nav{justify-content:center}nav ul{justify-content:center;gap:13px}.hero h1{font-size:32px}.cards{grid-template-columns:1fr}}
</style>
</head>
<body>
<nav>
<a href="index.php" class="logo"><img src="Assets/LOGO.jpg" alt="Logo">ShopVibe</a>
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="about.php">About Us</a></li>
<li><a href="mission.php" class="active">Our Mission</a></li>
<li><a href="why_chosse_us.php">Why Choose Us</a></li>
<li><a href="ourteam.php">Our Team</a></li>
<li><a href="contact.php">Contact Us</a></li>
<li><a href="faq.php">FAQ</a></li>
</ul>
</nav>
<section class="hero">
<h1>Why Choose <span>ShopVibe?</span></h1>
<p>Discover a simple and convenient way to shop online.</p>
</section>
<section class="content">
<div class="cards">
<div class="card"><div class="icon">🛍️</div><h2>Easy Shopping</h2><p>Explore products and browse our collection through a user-friendly interface.</p></div>
<div class="card"><div class="icon">📦</div><h2>Simple Ordering</h2><p>Add products to your cart and follow the checkout process to place an order.</p></div>
<div class="card"><div class="icon">📱</div><h2>Mobile Friendly</h2><p>Browse ShopVibe on your laptop, tablet or mobile phone.</p></div>
<div class="card"><div class="icon">💳</div><h2>Payment Options</h2><p>Use the payment options actually available at checkout.</p></div>
<div class="card"><div class="icon">✨</div><h2>Product Variety</h2><p>Explore available products and find items that suit your needs.</p></div>
<div class="card"><div class="icon">💬</div><h2>Get in Touch</h2><p>Contact us with questions, suggestions or feedback.</p></div>
</div>
</section>
<footer>&copy; <?php echo date("Y"); ?> <span>ShopVibe</span>. All Rights Reserved.</footer>
</body>
</html>