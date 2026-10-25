<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - ShopVibe</title>

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

        /* NAVBAR */
        nav {
            background: #111827;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 6%;
            flex-wrap: wrap;
            gap: 15px;
        }

        .logo {
            display: inline-flex;
            align-items: center;
        }
        .logo img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
        }

        .logo span {
            color: #f59e0b;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 25px;
            align-items: center;
        }

        nav ul a {
            color: white;
            text-decoration: none;
            font-size: 15px;
            transition: 0.3s;
        }

        nav ul a:hover,
        nav ul a.active {
            color: #ff9800;
        }

        /* HERO SECTION */
        .hero {
            background: linear-gradient(135deg, #111827, #4338ca);
            color: white;
            text-align: center;
            padding: 85px 20px;
        }

        .hero h1 {
            font-size: 45px;
            margin-bottom: 15px;
        }

        .hero h1 span {
            color: #ff9800;
        }

        .hero p {
            font-size: 17px;
            line-height: 1.8;
            max-width: 700px;
            margin: auto;
        }

        /* ABOUT SECTION */
        .about {
            max-width: 1100px;
            margin: 60px auto;
            padding: 0 25px;
            display: flex;
            align-items: center;
            gap: 40px;
        }

        .about-text {
            flex: 1;
        }

        .about-text h2 {
            font-size: 32px;
            margin-bottom: 20px;
            color: #111827;
        }

        .about-text h2 span {
            color: #ff9800;
        }

        .about-text p {
            font-size: 16px;
            line-height: 1.8;
            color: #555;
            margin-bottom: 15px;
        }

        .about-image {
            flex: 1;
            min-width: 0;
        }

        .about-image img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 18px;
            box-shadow: 0 10px 25px #0002;
        }

        /* MISSION */
        .mission {
            background: white;
            padding: 55px 20px;
            text-align: center;
        }

        .section-title {
            font-size: 32px;
            margin-bottom: 35px;
        }

        .section-title span {
            color: #ff9800;
        }

        .cards {
            max-width: 1100px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .card {
            background: #f5f7fb;
            padding: 30px 20px;
            border-radius: 15px;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px #0001;
        }

        .card .icon {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .card h3 {
            margin-bottom: 12px;
            font-size: 21px;
        }

        .card p {
            color: #666;
            line-height: 1.7;
            font-size: 15px;
        }

        /* CONTACT BANNER */
        .contact {
            text-align: center;
            padding: 60px 20px;
            background: linear-gradient(135deg, #ff9800, #ff6b00);
            color: white;
        }

        .contact h2 {
            font-size: 32px;
            margin-bottom: 15px;
        }

        .contact p {
            margin-bottom: 25px;
            line-height: 1.7;
        }

        .contact a {
            display: inline-block;
            background: #111827;
            color: white;
            text-decoration: none;
            padding: 13px 28px;
            border-radius: 7px;
            transition: 0.3s;
        }

        .contact a:hover {
            background: #263449;
        }

        /* FOOTER */
        footer {
            background: #111827;
            color: white;
            text-align: center;
            padding: 25px 15px;
        }

        footer span {
            color: #ff9800;
        }

        /* MOBILE RESPONSIVE */
        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                padding: 15px;
            }

            nav ul {
                justify-content: center;
                flex-wrap: wrap;
                gap: 15px;
            }

            nav ul a {
                font-size: 14px;
            }

            .hero {
                padding: 60px 20px;
            }

            .hero h1 {
                font-size: 32px;
            }

            .about {
                flex-direction: column;
                margin: 40px auto;
            }

            .about-text h2,
            .section-title {
                font-size: 27px;
            }

            .about-image {
                width: 100%;
            }

            .about-image img {
                height: 230px;
            }

            .cards {
                grid-template-columns: 1fr;
            }

            .contact h2 {
                font-size: 27px;
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
        <li><a href="#about">About Us</a></li>
        <li><a href="mission.php">Our Mission</a></li>
        <li><a href="why_chosse_us.php">Why Choose Us</a></li>
        <li><a href="ourteam.php">Our Team</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="#faq">FAQ</a></li>
    </ul>
</nav>

    <!-- HERO -->
    <section class="hero">
        <h1>About <span>ShopVibe</span></h1>
        <p>
            Welcome to ShopVibe – Your Shopping, Your Style!
            Discover a convenient shopping experience where
            finding your favourite products becomes simple and enjoyable.
        </p>
    </section>

    <!-- ABOUT US -->
    <section class="about">
        <div class="about-text">
            <h2>Who <span>We Are</span></h2>

            <p>
                ShopVibe is an online shopping platform created
                to make shopping easy, convenient and enjoyable.
            </p>

            <p>
                Our website allows customers to explore products,
                add their favourite items to the cart and place orders
                through a simple and user-friendly interface.
            </p>

            <p>
                We aim to provide a smooth shopping journey
                and continuously improve our website for our customers.
            </p>
        </div>

        <div class="about-image">
            <img
                src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=900&q=80"
                alt="Online Shopping">
        </div>
    </section>

    <!-- MISSION AND VALUES -->
    <section class="mission">
        <h2 class="section-title">Why Choose <span>ShopVibe?</span></h2>

        <div class="cards">
            <div class="card">
                <div class="icon">🛍️</div>
                <h3>Easy Shopping</h3>
                <p>
                    Browse products, explore your options
                    and shop through a simple interface.
                </p>
            </div>

            <div class="card">
                <div class="icon">🎯</div>
                <h3>Our Mission</h3>
                <p>
                    To make online shopping convenient
                    and create a better experience for customers.
                </p>
            </div>

            <div class="card">
                <div class="icon">💙</div>
                <h3>Customer First</h3>
                <p>
                    We value customer feedback and aim
                    to make every shopping visit better.
                </p>
            </div>
        </div>
    </section>

    <!-- CONTACT -->
    <section class="contact">
        <h2>Let's Connect!</h2>
        <p>
            Have a question or suggestion?
            We would love to hear from you.
        </p>

        <a href="contact.php">Contact Us</a>
    </section>

    <!-- FOOTER -->
    <footer>
        <p>
            &copy; <?php echo date("Y"); ?>
            <span>ShopVibe</span>. All Rights Reserved.
        </p>
    </footer>

</body>
</html>