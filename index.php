<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>ShopVibe - 3D E-Commerce</title>

<style>

/* ================= GLOBAL ================= */

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

html{
    scroll-behavior:smooth;
}

body{
    background:#080b16;
    color:white;
    overflow-x:hidden;
}

/* Animated background */

body::before{
    content:"";
    position:fixed;
    width:500px;
    height:500px;
    background:#00eaff;
    opacity:.08;
    filter:blur(100px);
    border-radius:50%;
    top:-150px;
    left:-150px;
    animation:bgMove1 8s ease-in-out infinite alternate;
    pointer-events:none;
}

body::after{
    content:"";
    position:fixed;
    width:500px;
    height:500px;
    background:#ff3cac;
    opacity:.08;
    filter:blur(100px);
    border-radius:50%;
    bottom:-150px;
    right:-150px;
    animation:bgMove2 8s ease-in-out infinite alternate;
    pointer-events:none;
}

@keyframes bgMove1{
    from{
        transform:translate(0,0);
    }
    to{
        transform:translate(180px,120px);
    }
}

@keyframes bgMove2{
    from{
        transform:translate(0,0);
    }
    to{
        transform:translate(-150px,-100px);
    }
}


/* ================= NAVBAR ================= */

nav{
    width:100%;
    padding:18px 7%;
    display:flex;
    align-items:center;
    justify-content:space-between;
    background:rgba(10,13,30,.85);
    backdrop-filter:blur(15px);
    position:sticky;
    top:0;
    z-index:1000;
    border-bottom:1px solid rgba(255,255,255,.08);
}

.logo{
    font-size:28px;
    font-weight:bold;
    color:#00eaff;
    text-shadow:0 0 15px rgba(0,234,255,.5);
    animation:logoGlow 2s ease-in-out infinite alternate;
}

.logo span{
    color:#ff3cac;
}

@keyframes logoGlow{
    from{
        transform:translateY(0);
        text-shadow:0 0 10px rgba(0,234,255,.3);
    }
    to{
        transform:translateY(-3px);
        text-shadow:0 0 25px rgba(0,234,255,.8);
    }
}

nav ul{
    display:flex;
    list-style:none;
    gap:30px;
}

nav ul li a{
    color:white;
    text-decoration:none;
    position:relative;
    transition:.3s;
}

nav ul li a::after{
    content:"";
    position:absolute;
    width:0;
    height:2px;
    background:linear-gradient(90deg,#00eaff,#ff3cac);
    left:0;
    bottom:-7px;
    transition:.3s;
}

nav ul li a:hover{
    color:#00eaff;
}

nav ul li a:hover::after{
    width:100%;
}


/* ================= NAV RIGHT ================= */

.nav-right{
    display:flex;
    align-items:center;
    gap:25px;
}


/* ================= LOGIN BUTTON ================= */

.login-btn{
    position:relative;
    display:inline-flex;
    align-items:center;
    justify-content:center;

    padding:11px 24px;

    color:white;
    text-decoration:none;

    font-size:15px;
    font-weight:bold;

    border-radius:30px;

    background:linear-gradient(
        135deg,
        #00eaff,
        #0077ff,
        #ff3cac
    );

    background-size:200% 200%;

    box-shadow:
        0 8px 0 #075078,
        0 15px 25px rgba(0,234,255,.25);

    transition:.3s;

    animation:
        loginFloat 3s ease-in-out infinite,
        gradientMove 4s ease infinite;

    overflow:hidden;
}

.login-btn::before{
    content:"";
    position:absolute;
    top:0;
    left:-100%;
    width:70%;
    height:100%;
    background:rgba(255,255,255,.35);
    transform:skewX(-25deg);
    transition:.5s;
}

.login-btn:hover::before{
    left:130%;
}

.login-btn:hover{
    transform:
        translateY(-6px)
        rotateX(10deg)
        scale(1.05);

    box-shadow:
        0 12px 0 #075078,
        0 20px 35px rgba(0,234,255,.4);
}

.login-btn:active{
    transform:translateY(3px);
    box-shadow:
        0 4px 0 #075078,
        0 8px 15px rgba(0,234,255,.2);
}

@keyframes loginFloat{
    0%,100%{
        transform:translateY(0);
    }
    50%{
        transform:translateY(-4px);
    }
}

@keyframes gradientMove{
    0%{
        background-position:0% 50%;
    }
    50%{
        background-position:100% 50%;
    }
    100%{
        background-position:0% 50%;
    }
}


/* ================= CART ================= */

.cart{
    position:relative;
    cursor:pointer;
    font-size:22px;
    transition:.3s;
}

.cart:hover{
    transform:
        scale(1.2)
        rotate(-8deg);
    filter:drop-shadow(0 0 10px #00eaff);
}

.cart-count{
    position:absolute;
    top:-10px;
    right:-12px;

    background:#ff3cac;

    width:20px;
    height:20px;

    border-radius:50%;

    font-size:12px;

    display:flex;
    align-items:center;
    justify-content:center;

    box-shadow:0 0 15px rgba(255,60,172,.7);

    animation:cartPulse 1.5s infinite;
}

@keyframes cartPulse{
    0%,100%{
        transform:scale(1);
    }
    50%{
        transform:scale(1.15);
    }
}


/* ================= HERO ================= */

.hero{
    min-height:85vh;

    display:flex;
    align-items:center;
    justify-content:space-between;

    padding:60px 8%;

    position:relative;
}

.hero-text{
    width:50%;
    animation:heroText 1s ease forwards;
}

@keyframes heroText{
    from{
        opacity:0;
        transform:translateX(-80px);
    }
    to{
        opacity:1;
        transform:translateX(0);
    }
}

.hero-text h1{
    font-size:65px;
    line-height:1.05;
    margin-bottom:20px;
}

.hero-text h1 span{
    background:linear-gradient(
        90deg,
        #00eaff,
        #ff3cac,
        #00eaff
    );

    background-size:200%;

    -webkit-background-clip:text;
    color:transparent;

    animation:textGradient 4s linear infinite;
}

@keyframes textGradient{
    0%{
        background-position:0%;
    }
    100%{
        background-position:200%;
    }
}

.hero-text p{
    color:#aaa;
    font-size:18px;
    line-height:1.7;
    margin-bottom:30px;
}


/* ================= SHOP BUTTON ================= */

.shop-btn{
    padding:15px 30px;

    border:none;
    border-radius:30px;

    background:
        linear-gradient(
            90deg,
            #00eaff,
            #ff3cac
        );

    color:white;

    font-size:16px;
    font-weight:bold;

    cursor:pointer;

    box-shadow:
        0 8px 0 #075078,
        0 15px 30px rgba(0,234,255,.25);

    transition:.3s;

    position:relative;
}

.shop-btn:hover{
    transform:
        translateY(-7px)
        scale(1.05);

    box-shadow:
        0 12px 0 #075078,
        0 25px 40px rgba(0,234,255,.4);
}

.shop-btn:active{
    transform:translateY(3px);
}


/* ================= HERO 3D PRODUCT ================= */

.hero-product{
    width:400px;
    height:400px;

    display:flex;
    justify-content:center;
    align-items:center;

    perspective:1000px;

    animation:heroProductAppear 1.2s ease forwards;
}

@keyframes heroProductAppear{
    from{
        opacity:0;
        transform:translateX(100px);
    }
    to{
        opacity:1;
        transform:translateX(0);
    }
}

.product-3d{
    width:260px;
    height:330px;

    border-radius:30px;

    background:
        linear-gradient(
            145deg,
            #151a30,
            #050711
        );

    border:1px solid rgba(255,255,255,.12);

    box-shadow:
        20px 20px 50px rgba(0,0,0,.7),
        0 0 35px rgba(0,234,255,.12),
        inset 0 0 30px rgba(255,255,255,.03);

    transform-style:preserve-3d;

    animation:float 4s ease-in-out infinite;

    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;

    position:relative;
}

.product-3d::before{
    content:"";
    position:absolute;

    width:150px;
    height:150px;

    background:#00eaff;

    opacity:.08;

    filter:blur(60px);

    border-radius:50%;

    top:50px;
}

.product-3d:hover{
    transform:
        rotateY(20deg)
        rotateX(10deg)
        scale(1.05);

    box-shadow:
        30px 30px 70px rgba(0,0,0,.8),
        0 0 50px rgba(0,234,255,.3);
}

.product-icon{
    width:200px;
    height:200px;

    transform:translateZ(70px);

    transition:.5s;
}

.product-icon img{
    width:100%;
    height:100%;

    object-fit:contain;

    border-radius:40px;

    filter:
        drop-shadow(0 20px 25px rgba(0,0,0,.7));

    transition:.5s;
}

.product-3d:hover .product-icon{
    transform:
        translateZ(100px)
        rotateY(10deg)
        scale(1.05);
}

.product-3d h2{
    margin-top:25px;
    transform:translateZ(50px);
}

.product-3d p{
    color:#00eaff;
    margin-top:10px;
    transform:translateZ(40px);
    font-size:18px;
    font-weight:bold;
}

@keyframes float{
    0%,100%{
        transform:translateY(0) rotateY(-10deg);
    }

    50%{
        transform:translateY(-20px) rotateY(10deg);
    }
}


/* ================= PRODUCTS ================= */

.products{
    padding:70px 7%;
    position:relative;
}

.section-title{
    text-align:center;
    margin-bottom:40px;
}

.section-title h2{
    font-size:40px;

    background:
        linear-gradient(
            90deg,
            white,
            #00eaff,
            white
        );

    background-size:200%;

    -webkit-background-clip:text;
    color:transparent;

    animation:textGradient 4s linear infinite;
}

.section-title p{
    color:#888;
    margin-top:10px;
}


/* ================= SEARCH ================= */

.search-box{
    display:flex;
    justify-content:center;
    margin-bottom:30px;
}

.search-box input{
    width:350px;

    padding:15px 20px;

    border-radius:30px;

    border:1px solid #333;

    outline:none;

    background:#111527;

    color:white;

    transition:.3s;

    box-shadow:
        0 0 0 rgba(0,234,255,0);
}

.search-box input:focus{
    border-color:#00eaff;

    box-shadow:
        0 0 25px rgba(0,234,255,.2);

    transform:scale(1.03);
}


/* ================= FILTER ================= */

.filters{
    display:flex;
    justify-content:center;

    gap:12px;

    flex-wrap:wrap;

    margin-bottom:40px;
}

.filters button{
    padding:10px 20px;

    border:1px solid #333;

    border-radius:20px;

    background:#111527;

    color:white;

    cursor:pointer;

    transition:.3s;

    box-shadow:0 4px 0 #050711;
}

.filters button:hover,
.filters button.active{
    background:#00eaff;
    color:#000;

    transform:
        translateY(-4px)
        scale(1.05);

    box-shadow:
        0 8px 15px rgba(0,234,255,.2);
}


/* ================= PRODUCT GRID ================= */

.product-grid{
    display:grid;

    grid-template-columns:
        repeat(
            auto-fit,
            minmax(230px,1fr)
        );

    gap:30px;
}


/* ================= CARD ================= */

.card{
    background:
        linear-gradient(
            145deg,
            #151a30,
            #0c0f20
        );

    border:
        1px solid rgba(255,255,255,.08);

    border-radius:25px;

    padding:20px;

    transition:.5s;

    transform-style:preserve-3d;

    position:relative;

    overflow:hidden;

    animation:cardAppear .8s ease both;
}

.card:nth-child(1){
    animation-delay:.1s;
}

.card:nth-child(2){
    animation-delay:.2s;
}

.card:nth-child(3){
    animation-delay:.3s;
}

.card:nth-child(4){
    animation-delay:.4s;
}

.card:nth-child(5){
    animation-delay:.5s;
}

.card:nth-child(6){
    animation-delay:.6s;
}

@keyframes cardAppear{
    from{
        opacity:0;
        transform:
            translateY(50px)
            rotateX(20deg);
    }

    to{
        opacity:1;
        transform:
            translateY(0)
            rotateX(0);
    }
}

.card::before{
    content:"";

    position:absolute;

    width:150px;
    height:150px;

    background:#00eaff;

    opacity:.06;

    border-radius:50%;

    filter:blur(50px);

    top:-60px;
    right:-60px;

    transition:.5s;
}

.card:hover::before{
    transform:scale(2);
    opacity:.12;
}

.card:hover{
    transform:
        translateY(-12px)
        rotateX(5deg)
        rotateY(-5deg)
        scale(1.02);

    box-shadow:
        0 25px 50px rgba(0,234,255,.12),
        0 0 30px rgba(255,60,172,.06);
}

.card-img{
    height:190px;

    border-radius:20px;

    background:
        linear-gradient(
            135deg,
            #202747,
            #101426
        );

    display:flex;

    align-items:center;
    justify-content:center;

    font-size:85px;

    margin-bottom:20px;

    transition:.5s;

    transform-style:preserve-3d;

    box-shadow:
        inset 0 0 30px rgba(255,255,255,.03);
}

.card:hover .card-img{
    transform:
        translateZ(35px)
        scale(1.04)
        rotateY(3deg);
}

.card h3{
    font-size:20px;
    margin-bottom:8px;

    transform:translateZ(20px);
}

.category{
    color:#888;
    font-size:14px;
}

.price{
    color:#00eaff;

    font-size:22px;

    font-weight:bold;

    margin:15px 0;
}


/* ================= ADD BUTTON ================= */

.add-btn{
    width:100%;

    padding:12px;

    border:none;

    border-radius:12px;

    background:
        linear-gradient(
            90deg,
            #00eaff,
            #00bcd4
        );

    cursor:pointer;

    font-weight:bold;

    transition:.3s;

    box-shadow:
        0 5px 0 #075078;
}

.add-btn:hover{
    background:
        linear-gradient(
            90deg,
            #ff3cac,
            #ff5ebc
        );

    color:white;

    transform:
        translateY(-5px)
        scale(1.03);

    box-shadow:
        0 9px 20px rgba(255,60,172,.25);
}

.add-btn:active{
    transform:translateY(2px);
}


/* ================= CART PANEL ================= */

.cart-panel{
    position:fixed;

    top:0;

    right:-400px;

    width:380px;

    height:100vh;

    background:
        linear-gradient(
            145deg,
            #151a30,
            #080b16
        );

    z-index:2000;

    padding:30px;

    box-shadow:
        -20px 0 50px rgba(0,0,0,.5),
        -5px 0 30px rgba(0,234,255,.08);

    transition:.5s;

    border-left:1px solid rgba(255,255,255,.08);
}

.cart-panel.open{
    right:0;

    animation:cartOpen .5s ease;
}

@keyframes cartOpen{
    from{
        transform:translateX(100px);
        opacity:.5;
    }

    to{
        transform:translateX(0);
        opacity:1;
    }
}

.cart-header{
    display:flex;
    justify-content:space-between;
    margin-bottom:30px;
}

.cart-header h2{
    color:#00eaff;
}

.close-cart{
    cursor:pointer;
    font-size:25px;
    transition:.3s;
}

.close-cart:hover{
    color:#ff3cac;
    transform:
        rotate(90deg)
        scale(1.2);
}

.cart-items{
    max-height:65vh;
    overflow-y:auto;
}

.cart-item{
    display:flex;
    justify-content:space-between;
    align-items:center;

    padding:15px 0;

    border-bottom:1px solid #333;
}

.cart-item span{
    color:#00eaff;
}

.cart-item button{
    border:none;
    background:none;
    cursor:pointer;
    font-size:18px;
    transition:.3s;
}

.cart-item button:hover{
    transform:scale(1.2);
}

.total{
    margin-top:25px;

    font-size:22px;

    display:flex;

    justify-content:space-between;
}

#totalPrice{
    color:#00eaff;
    font-weight:bold;
}

.checkout{
    width:100%;

    padding:15px;

    margin-top:20px;

    border:none;

    border-radius:12px;

    background:
        linear-gradient(
            90deg,
            #00eaff,
            #ff3cac
        );

    color:white;

    cursor:pointer;

    font-size:16px;

    font-weight:bold;

    transition:.3s;

    box-shadow:
        0 6px 0 #075078;
}

.checkout:hover{
    transform:
        translateY(-5px)
        scale(1.02);

    box-shadow:
        0 12px 25px rgba(0,234,255,.25);
}


/* ================= FOOTER ================= */

footer{
    text-align:center;

    padding:40px;

    background:#050711;

    color:#777;

    margin-top:50px;

    border-top:
        1px solid rgba(255,255,255,.05);
}


/* ================= RESPONSIVE ================= */

@media(max-width:800px){

    nav{
        padding:15px 5%;
    }

    nav ul{
        display:none;
    }

    .logo{
        font-size:23px;
    }

    .nav-right{
        gap:15px;
    }

    .login-btn{
        padding:9px 17px;
        font-size:13px;
    }

    .hero{
        flex-direction:column;

        text-align:center;

        gap:50px;

        padding-top:50px;
    }

    .hero-text{
        width:100%;
    }

    .hero-text h1{
        font-size:45px;
    }

    .hero-text p{
        font-size:16px;
    }

    .hero-product{
        width:100%;
    }

    .cart-panel{
        width:100%;
        right:-100%;
    }

    .products{
        padding:50px 5%;
    }

    .section-title h2{
        font-size:32px;
    }

    .search-box input{
        width:90%;
    }
}

</style>
</head>


<body>


<!-- ================= NAVBAR ================= -->

<nav>

    <div class="logo">
        shop<span> vibe</span>
    </div>


    <ul>

        <li>
            <a href="#home">Home</a>
        </li>

        <li>
            <a href="#products">Products</a>
        </li>

        <li>
            <a href="#">Deals</a>
        </li>

        <li>
            <a href="#">About</a>
        </li>

    </ul>


    <!-- LOGIN + CART -->

    <div class="nav-right">

        <!-- CONNECTED TO login.php -->

        <a href="login.php" class="login-btn">
            Login
        </a>


        <div class="cart" onclick="openCart()">

            🛒

            <div
                class="cart-count"
                id="cartCount">
                0
            </div>

        </div>

    </div>

</nav>



<!-- ================= HERO ================= -->

<section class="hero" id="home">


    <div class="hero-text">

        <h1>
            Shop The
            <span>Future.</span>
        </h1>


        <p>
            Discover premium products with a futuristic
            shopping experience powered by interactive
            3D design.
        </p>


        <button
            class="shop-btn"
            onclick="
            document
            .getElementById('products')
            .scrollIntoView({
                behavior:'smooth'
            })">

            Explore Products →

        </button>

    </div>



    <!-- 3D PRODUCT -->

    <div class="hero-product">

        <div class="product-3d">


            <div class="product-icon">

                <img
                    src="headphones-5064411_1280.jpg"
                    alt="AirBeat X">

            </div>


            <h2>
                AirBeat X
            </h2>


            <p>
                ₹2,999
            </p>


        </div>

    </div>

</section>



<!-- ================= PRODUCTS ================= -->

<section
    class="products"
    id="products">


    <div class="section-title">

        <h2>
            Featured Products
        </h2>

        <p>
            Choose your favourite products
        </p>

    </div>



    <!-- SEARCH -->

    <div class="search-box">

        <input
            type="text"
            id="search"
            placeholder="Search products..."
            onkeyup="searchProducts()">

    </div>



    <!-- FILTER -->

    <div class="filters">


        <button
            class="active"
            onclick="
            filterProducts('all',this)">

            All

        </button>


        <button
            onclick="
            filterProducts('electronics',this)">

            Electronics

        </button>


        <button
            onclick="
            filterProducts('fashion',this)">

            Fashion

        </button>


        <button
            onclick="
            filterProducts('gaming',this)">

            Gaming

        </button>


    </div>



    <!-- PRODUCT GRID -->

    <div
        class="product-grid"
        id="productGrid">


        <!-- PRODUCT 1 -->

        <div
            class="card"
            data-category="electronics"
            data-name="Wireless Headphones">

            <div class="card-img">
                🎧
            </div>

            <h3>
                Wireless Headphones
            </h3>

            <p class="category">
                Electronics
            </p>

            <div class="price">
                ₹2,999
            </div>

            <button
                class="add-btn"
                onclick="
                addToCart(
                    'Wireless Headphones',
                    2999
                )">

                Add To Cart

            </button>

        </div>



        <!-- PRODUCT 2 -->

        <div
            class="card"
            data-category="electronics"
            data-name="Smart Watch">

            <div class="card-img">
                ⌚
            </div>

            <h3>
                Smart Watch
            </h3>

            <p class="category">
                Electronics
            </p>

            <div class="price">
                ₹3,499
            </div>

            <button
                class="add-btn"
                onclick="
                addToCart(
                    'Smart Watch',
                    3499
                )">

                Add To Cart

            </button>

        </div>



        <!-- PRODUCT 3 -->

        <div
            class="card"
            data-category="fashion"
            data-name="Premium Sneakers">

            <div class="card-img">
                👟
            </div>

            <h3>
                Premium Sneakers
            </h3>

            <p class="category">
                Fashion
            </p>

            <div class="price">
                ₹2,499
            </div>

            <button
                class="add-btn"
                onclick="
                addToCart(
                    'Premium Sneakers',
                    2499
                )">

                Add To Cart

            </button>

        </div>



        <!-- PRODUCT 4 -->

        <div
            class="card"
            data-category="gaming"
            data-name="Gaming Controller">

            <div class="card-img">
                🎮
            </div>

            <h3>
                Gaming Controller
            </h3>

            <p class="category">
                Gaming
            </p>

            <div class="price">
                ₹1,999
            </div>

            <button
                class="add-btn"
                onclick="
                addToCart(
                    'Gaming Controller',
                    1999
                )">

                Add To Cart

            </button>

        </div>



        <!-- PRODUCT 5 -->

        <div
            class="card"
            data-category="electronics"
            data-name="VR Headset">

            <div class="card-img">
                🥽
            </div>

            <h3>
                VR Headset
            </h3>

            <p class="category">
                Electronics
            </p>

            <div class="price">
                ₹6,999
            </div>

            <button
                class="add-btn"
                onclick="
                addToCart(
                    'VR Headset',
                    6999
                )">

                Add To Cart

            </button>

        </div>



        <!-- PRODUCT 6 -->

        <div
            class="card"
            data-category="fashion"
            data-name="Street Hoodie">

            <div class="card-img">
                👕
            </div>

            <h3>
                Street Hoodie
            </h3>

            <p class="category">
                Fashion
            </p>

            <div class="price">
                ₹1,299
            </div>

            <button
                class="add-btn"
                onclick="
                addToCart(
                    'Street Hoodie',
                    1299
                )">

                Add To Cart

            </button>

        </div>


    </div>

</section>



<!-- ================= CART ================= -->

<div
    class="cart-panel"
    id="cartPanel">


    <div class="cart-header">

        <h2>
            Your Cart
        </h2>

        <div
            class="close-cart"
            onclick="closeCart()">

            ✕

        </div>

    </div>



    <div
        class="cart-items"
        id="cartItems">

        <p>
            Your cart is empty.
        </p>

    </div>



    <div class="total">

        <span>
            Total
        </span>

        <span id="totalPrice">
            ₹0
        </span>

    </div>



    <button
        class="checkout"
        onclick="checkout()">

        Proceed To Checkout

    </button>

</div>



<!-- ================= FOOTER ================= -->

<footer>

    © 2026 shop vibe |
    Future of Shopping

</footer>



<!-- ================= JAVASCRIPT ================= -->

<script>


/* ================= CART ================= */

let cart = [];


function addToCart(name,price){

    cart.push({
        name:name,
        price:price
    });

    updateCart();

    alert(
        name +
        " added to cart!"
    );

}



function updateCart(){

    document
    .getElementById("cartCount")
    .innerText = cart.length;


    let cartItems =
        document.getElementById(
            "cartItems"
        );


    let total = 0;


    if(cart.length === 0){

        cartItems.innerHTML =
            "<p>Your cart is empty.</p>";

    }

    else{

        cartItems.innerHTML = "";


        cart.forEach(
            (item,index)=>{

                total += item.price;


                cartItems.innerHTML += `

                    <div class="cart-item">

                        <div>

                            ${item.name}

                            <br>

                            <span>
                                ₹${item.price}
                            </span>

                        </div>


                        <button
                            onclick="
                            removeItem(${index})">

                            ❌

                        </button>

                    </div>

                `;

            }
        );

    }


    document
    .getElementById("totalPrice")
    .innerText =
        "₹" + total;

}



function removeItem(index){

    cart.splice(index,1);

    updateCart();

}



function openCart(){

    document
    .getElementById("cartPanel")
    .classList.add("open");

}



function closeCart(){

    document
    .getElementById("cartPanel")
    .classList.remove("open");

}



function checkout(){

    if(cart.length === 0){

        alert(
            "Your cart is empty!"
        );

        return;

    }


    alert(
        "Checkout successful! Total: " +
        document
        .getElementById("totalPrice")
        .innerText
    );

}



/* ================= CATEGORY FILTER ================= */

function filterProducts(
    category,
    button
){

    let cards =
        document.querySelectorAll(
            ".card"
        );


    cards.forEach(
        card=>{

            if(
                category === "all" ||
                card.dataset.category === category
            ){

                card.style.display =
                    "block";

            }

            else{

                card.style.display =
                    "none";

            }

        }
    );


    document
    .querySelectorAll(
        ".filters button"
    )
    .forEach(
        btn=>{

            btn.classList.remove(
                "active"
            );

        }
    );


    button.classList.add(
        "active"
    );

}



/* ================= SEARCH ================= */

function searchProducts(){

    let search =
        document
        .getElementById("search")
        .value
        .toLowerCase();


    document
    .querySelectorAll(".card")
    .forEach(
        card=>{

            let name =
                card.dataset.name
                .toLowerCase();


            if(
                name.includes(search)
            ){

                card.style.display =
                    "block";

            }

            else{

                card.style.display =
                    "none";

            }

        }
    );

}

</script>


</body>
</html>