<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Us - ShopVibe</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background: #f5f7fb;
    color: #222;
}

nav {
    background: #111827;
    padding: 15px 5%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
}

.logo {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #ff9800;
    font-size: 25px;
    font-weight: bold;
    text-decoration: none;
}

.logo img {
    width: 42px;
    height: 42px;
    object-fit: contain;
}

nav ul {
    display: flex;
    gap: 18px;
    list-style: none;
    flex-wrap: wrap;
}

nav ul a {
    color: white;
    text-decoration: none;
    font-size: 14px;
}

nav ul a:hover,
nav ul a.active {
    color: #ff9800;
}

.hero {
    background: linear-gradient(135deg, #111827, #4338ca);
    color: white;
    text-align: center;
    padding: 65px 20px;
}

.hero h1 {
    font-size: 42px;
    margin-bottom: 15px;
}

.orange {
    color: #ff9800;
}

.hero p {
    line-height: 1.8;
    font-size: 16px;
}

.contact-container {
    max-width: 1000px;
    margin: 50px auto;
    padding: 0 20px;
    text-align: center;
}

.contact-container h2 {
    font-size: 30px;
    margin-bottom: 15px;
}

.description {
    color: #666;
    line-height: 1.8;
    margin-bottom: 35px;
}

.contact-cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 22px;
}

.contact-card {
    background: white;
    padding: 30px 18px;
    border-radius: 15px;
    box-shadow: 0 6px 22px #0001;
    transition: 0.3s;
}

.contact-card:hover {
    transform: translateY(-7px);
    box-shadow: 0 12px 25px #0002;
}

.contact-icon {
    font-size: 42px;
    margin-bottom: 15px;
}

.contact-card h3 {
    margin-bottom: 12px;
}

.contact-card p {
    color: #666;
    font-size: 14px;
    margin-bottom: 20px;
    line-height: 1.7;
    overflow-wrap: anywhere;
}

.contact-btn {
    display: inline-block;
    padding: 11px 20px;
    background: #111827;
    color: white;
    text-decoration: none;
    border-radius: 7px;
    transition: 0.3s;
}

.contact-btn:hover {
    background: #ff9800;
}

.note {
    margin-top: 35px;
    color: #666;
    line-height: 1.8;
}

footer {
    background: #111827;
    color: white;
    text-align: center;
    padding: 22px;
    margin-top: 45px;
}
/* EMAIL - BLUE */
.contact-card:nth-child(1) {
    background: linear-gradient(135deg, #007bff, #00c6ff);
    color: white;
}

/* INSTAGRAM - PINK GRADIENT */
.contact-card:nth-child(2) {
    background: linear-gradient(135deg, #833ab4, #fd1d1d, #fcb045);
    color: white;
}

/* FACEBOOK - BLUE */
.contact-card:nth-child(3) {
    background: linear-gradient(135deg, #1877F2, #0B4DBB);
    color: white;
}

/* TEXT */
.contact-card p {
    color: white;
}

/* BUTTON */
.contact-card .contact-btn {
    background: white;
    color: #222;
    font-weight: bold;
}

.contact-card .contact-btn:hover {
    background: #111827;
    color: white;
}

@media (max-width: 768px) {
    nav {
        justify-content: center;
    }

    nav ul {
        justify-content: center;
        gap: 14px;
    }

    .hero h1 {
        font-size: 32px;
    }

    .contact-cards {
        grid-template-columns: 1fr;
    }
}    
</style>
</head>

<body>

<!-- NAVBAR -->
<nav>
    <a href="index.php" class="logo">
        <img src="Assets/LOGO.jpg" alt="ShopVibe Logo">
        ShopVibe
    </a>

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

<!-- HERO -->
<section class="hero">
    <h1>Contact <span class="orange">Us</span></h1>
    <p>
        Have a question about your shopping experience?<br>
        Connect with us through our contact channels.
    </p>
</section>

<!-- CONTACT OPTIONS -->
<section class="contact-container">

    <h2>Let's <span class="orange">Connect!</span></h2>

    <p class="description">
        We're happy to hear from you! Reach out to ShopVibe
        for product enquiries, order-related questions or feedback.
    </p>

    <div class="contact-cards">

        <!-- EMAIL -->
        <div class="contact-card">
            <div class="contact-icon">📧</div>
            <h3>Email Us</h3>
            <p>Send us your questions and enquiries by email.</p>

            <a class="contact-btn"
               href="mailto:YOUR_EMAIL@gmail.com">
                Send Email
            </a>
        </div>

        <!-- INSTAGRAM -->
        <div class="contact-card">
            <div class="contact-icon">📸</div>
            <h3>Instagram</h3>
            <p>Follow ShopVibe and connect with us on Instagram.</p>

            <a class="contact-btn"
               href="https://www.instagram.com/YOUR_HANDLE/"
               target="_blank"
               rel="noopener noreferrer">
                Visit Instagram
            </a>
        </div>

        <!-- FACEBOOK -->
        <div class="contact-card">
            <div class="contact-icon">🌐</div>
            <h3>Social Media</h3>
            <p>Stay connected with ShopVibe on social media.</p>

            <a class="contact-btn"
               href="https://www.facebook.com/YOUR_PAGE/"
               target="_blank"
               rel="noopener noreferrer">
                Visit Facebook
            </a>
        </div>

    </div>

    <p class="note">
        We appreciate your interest in ShopVibe.<br>
        Thank you for being a part of our shopping community!
    </p>

</section>

<!-- FOOTER -->
<footer>
    &copy; <?php echo date("Y"); ?>
    <span class="orange">ShopVibe</span>. All Rights Reserved.
</footer>

</body>
</html>

