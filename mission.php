<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Our Mission - ShopVibe</title>
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
.hero p{line-height:1.8}
.content{max-width:1000px;margin:45px auto;padding:20px}
.cards{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
.card{background:white;padding:30px 22px;border-radius:14px;box-shadow:0 5px 18px #0001;text-align:center}
.card h2{margin:15px 0}
.card p{color:#555;line-height:1.7}
.icon{font-size:38px}
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
<h1>Our <span>Mission</span></h1>
<p>Making online shopping simple, convenient and enjoyable.</p>
</section>
<section class="content">
<div class="cards">
<div class="card"><div class="icon">🎯</div><h2>Our Goal</h2><p>To provide a simple and convenient online shopping experience.</p></div>
<div class="card"><div class="icon">💙</div><h2>Customer First</h2><p>To understand customer needs and improve our shopping platform.</p></div>
<div class="card"><div class="icon">🚀</div><h2>Our Vision</h2><p>To build a user-friendly platform where customers can discover products easily.</p></div>
</div>
</section>
<footer>&copy; <?php echo date("Y"); ?> <span>ShopVibe</span>. All Rights Reserved.</footer>
</body>
</html>
