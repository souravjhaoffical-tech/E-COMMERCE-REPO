<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>ShopVibe- 3D E-Commerce</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    background:#080b16;
    color:white;
    overflow-x:hidden;
}


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
}

.logo span{
    color:#ff3cac;
}

nav ul{
    display:flex;
    list-style:none;
    gap:30px;
}

nav ul li a{
    color:white;
    text-decoration:none;
    transition:.3s;
}

nav ul li a:hover{
    color:#00eaff;
}

.cart{
    position:relative;
    cursor:pointer;
    font-size:22px;
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
}

/* ===== HERO ===== */

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
}

.hero-text h1{
    font-size:65px;
    line-height:1.05;
    margin-bottom:20px;
}

.hero-text h1 span{
    background:linear-gradient(90deg,#00eaff,#ff3cac);
    -webkit-background-clip:text;
    color:transparent;
}

.hero-text p{
    color:#aaa;
    font-size:18px;
    line-height:1.7;
    margin-bottom:30px;
}

.shop-btn{
    padding:15px 30px;
    border:none;
    border-radius:30px;
    background:linear-gradient(90deg,#00eaff,#ff3cac);
    color:white;
    font-size:16px;
    cursor:pointer;
    box-shadow:0 0 30px rgba(0,234,255,.25);
    transition:.3s;
}

.shop-btn:hover{
    transform:translateY(-5px) scale(1.05);
}

/* ===== 3D PRODUCT ===== */

.hero-product{
    width:400px;
    height:400px;
    display:flex;
    justify-content:center;
    align-items:center;
    perspective:1000px;
}

.product-3d{
    width:260px;
    height:330px;
    border-radius:30px;

    background:linear-gradient(
        145deg,
        #000000,
        #0b0b0b
    );

    border:1px solid rgba(0, 0, 0, 0.15);

    box-shadow:
        20px 20px 50px rgba(0,0,0,.7),
        0 0 35px rgba(0, 0, 0, 0.08);

    transform-style:preserve-3d;

    animation:float 4s ease-in-out infinite;

    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
}

.product-3d:hover{
    transform:rotateY(20deg) rotateX(10deg);
}

.product-icon{
    width:200px;
    height:200px;
    transform:translateZ(70px);
}

.product-icon img{
    width:100%;
    height:100%;
    object-fit:contain;
    border-radius:40px;
}

.product-3d h2{
    margin-top:25px;
    transform:translateZ(50px);
}

.product-3d p{
    color:#00eaff;
    margin-top:10px;
    transform:translateZ(40px);
}

@keyframes float{
    0%,100%{
        transform:translateY(0) rotateY(-10deg);
    }
    50%{
        transform:translateY(-20px) rotateY(10deg);
    }
}

/* ===== PRODUCTS ===== */

.products{
    padding:70px 7%;
}

.section-title{
    text-align:center;
    margin-bottom:40px;
}

.section-title h2{
    font-size:40px;
}

.section-title p{
    color:#888;
    margin-top:10px;
}

/* ===== SEARCH ===== */

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
}

/* ===== FILTER ===== */

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
}

.filters button:hover,
.filters button.active{
    background:#00eaff;
    color:#000;
}

/* ===== PRODUCT GRID ===== */

.product-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(230px,1fr));
    gap:30px;
}

/* ===== CARD ===== */

.card{
    background:linear-gradient(145deg,#151a30,#0c0f20);
    border:1px solid rgba(255,255,255,.08);
    border-radius:25px;
    padding:20px;
    transition:.4s;
    transform-style:preserve-3d;
    position:relative;
    overflow:hidden;
}

.card:hover{
    transform:translateY(-12px) rotateX(4deg) rotateY(-4deg);
    box-shadow:0 25px 50px rgba(0,234,255,.12);
}

.card-img{
    height:190px;
    border-radius:20px;
    background:linear-gradient(135deg,#202747,#101426);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:85px;
    margin-bottom:20px;
    transition:.4s;
}

.card:hover .card-img{
    transform:translateZ(35px) scale(1.04);
}

.card h3{
    font-size:20px;
    margin-bottom:8px;
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

.add-btn{
    width:100%;
    padding:12px;
    border:none;
    border-radius:12px;
    background:#00eaff;
    cursor:pointer;
    font-weight:bold;
    transition:.3s;
}

.add-btn:hover{
    background:#ff3cac;
    color:white;
    transform:scale(1.03);
}

/* ===== CART PANEL ===== */

.cart-panel{
    position:fixed;
    top:0;
    right:-400px;
    width:380px;
    height:100vh;
    background:#101426;
    z-index:2000;
    padding:30px;
    box-shadow:-20px 0 50px rgba(0,0,0,.5);
    transition:.4s;
}

.cart-panel.open{
    right:0;
}

.cart-header{
    display:flex;
    justify-content:space-between;
    margin-bottom:30px;
}

.close-cart{
    cursor:pointer;
    font-size:25px;
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

.total{
    margin-top:25px;
    font-size:22px;
    display:flex;
    justify-content:space-between;
}

.checkout{
    width:100%;
    padding:15px;
    margin-top:20px;
    border:none;
    border-radius:12px;
    background:linear-gradient(90deg,#00eaff,#ff3cac);
    color:white;
    cursor:pointer;
    font-size:16px;
}

/* ===== FOOTER ===== */

footer{
    text-align:center;
    padding:40px;
    background:#050711;
    color:#777;
    margin-top:50px;
}

/* ===== RESPONSIVE ===== */

@media(max-width:800px){

    nav ul{
        display:none;
    }

    .hero{
        flex-direction:column;
        text-align:center;
        gap:50px;
    }

    .hero-text{
        width:100%;
    }

    .hero-text h1{
        font-size:45px;
    }

    .hero-product{
        width:100%;
    }

    .cart-panel{
        width:100%;
        right:-100%;
    }
    
}
</style>
</head>

<body>

<!-- NAVBAR -->

<nav>

    <div class="logo">
        shop<span> vibe</span>
    </div>

    <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#products">Products</a></li>
        <li><a href="#">Deals</a></li>
        <li><a href="#">About</a></li>
    </ul>

    <div class="cart" onclick="openCart()">
        🛒
        <div class="cart-count" id="cartCount">0</div>
    </div>

</nav>


<!-- HERO -->

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

        <button class="shop-btn"
                onclick="document.getElementById('products').scrollIntoView({behavior:'smooth'})">
            Explore Products →
        </button>

    </div>


    <div class="hero-product">

        <div class="product-3d">

            <div class="product-icon">
                <img src="headphones-5064411_1280.jpg" alt="AirBeat X">
            </div>

            <h2>AirBeat X</h2>

            <p>₹2,999</p>

        </div>

    </div>

</section>


<!-- PRODUCTS -->

<section class="products" id="products">

    <div class="section-title">

        <h2>Featured Products</h2>

        <p>Choose your favourite products</p>

    </div>


    <!-- SEARCH -->

    <div class="search-box">

        <input
            type="text"
            id="search"
            placeholder="Search products..."
            onkeyup="searchProducts()"
        >

    </div>


    <!-- FILTER -->

    <div class="filters">

        <button class="active"
                onclick="filterProducts('all',this)">
            All
        </button>

        <button onclick="filterProducts('electronics',this)">
            Electronics
        </button>

        <button onclick="filterProducts('fashion',this)">
            Fashion
        </button>

        <button onclick="filterProducts('gaming',this)">
            Gaming
        </button>

    </div>


    <!-- PRODUCT GRID -->

    <div class="product-grid" id="productGrid">


        <div class="card"
             data-category="electronics"
             data-name="Wireless Headphones">

            <div class="card-img">🎧</div>

            <h3>Wireless Headphones</h3>

            <p class="category">Electronics</p>

            <div class="price">₹2,999</div>

            <button class="add-btn"
                    onclick="addToCart('Wireless Headphones',2999)">
                Add To Cart
            </button>

        </div>


        <div class="card"
             data-category="electronics"
             data-name="Smart Watch">

            <div class="card-img">⌚</div>

            <h3>Smart Watch</h3>

            <p class="category">Electronics</p>

            <div class="price">₹3,499</div>

            <button class="add-btn"
                    onclick="addToCart('Smart Watch',3499)">
                Add To Cart
            </button>

        </div>


        <div class="card"
             data-category="fashion"
             data-name="Premium Sneakers">

            <div class="card-img">👟</div>

            <h3>Premium Sneakers</h3>

            <p class="category">Fashion</p>

            <div class="price">₹2,499</div>

            <button class="add-btn"
                    onclick="addToCart('Premium Sneakers',2499)">
                Add To Cart
            </button>

        </div>


        <div class="card"
             data-category="gaming"
             data-name="Gaming Controller">

            <div class="card-img">🎮</div>

            <h3>Gaming Controller</h3>

            <p class="category">Gaming</p>

            <div class="price">₹1,999</div>

            <button class="add-btn"
                    onclick="addToCart('Gaming Controller',1999)">
                Add To Cart
            </button>

        </div>


        <div class="card"
             data-category="electronics"
             data-name="VR Headset">

            <div class="card-img">🥽</div>

            <h3>VR Headset</h3>

            <p class="category">Electronics</p>

            <div class="price">₹6,999</div>

            <button class="add-btn"
                    onclick="addToCart('VR Headset',6999)">
                Add To Cart
            </button>

        </div>


        <div class="card"
             data-category="fashion"
             data-name="Street Hoodie">

            <div class="card-img">👕</div>

            <h3>Street Hoodie</h3>

            <p class="category">Fashion</p>

            <div class="price">₹1,299</div>

            <button class="add-btn"
                    onclick="addToCart('Street Hoodie',1299)">
                Add To Cart
            </button>

        </div>


    </div>

</section>


<!-- CART -->

<div class="cart-panel" id="cartPanel">

    <div class="cart-header">

        <h2>Your Cart</h2>

        <div class="close-cart"
             onclick="closeCart()">
            ✕
        </div>

    </div>


    <div class="cart-items" id="cartItems">

        <p>Your cart is empty.</p>

    </div>


    <div class="total">

        <span>Total</span>

        <span id="totalPrice">₹0</span>

    </div>


    <button class="checkout"
            onclick="checkout()">
        Proceed To Checkout
    </button>

</div>


<!-- FOOTER -->

<footer>

    © 2026 shop vibe | Future of Shopping

</footer>


<script>

/* ===== CART ===== */

let cart = [];

function addToCart(name,price){

    cart.push({
        name:name,
        price:price
    });

    updateCart();

    alert(name + " added to cart!");

}


function updateCart(){

    document.getElementById("cartCount").innerText =
        cart.length;

    let cartItems =
        document.getElementById("cartItems");

    let total = 0;

    if(cart.length === 0){

        cartItems.innerHTML =
            "<p>Your cart is empty.</p>";

    }else{

        cartItems.innerHTML = "";

        cart.forEach((item,index)=>{

            total += item.price;

            cartItems.innerHTML += `

                <div class="cart-item">

                    <div>
                        ${item.name}
                        <br>
                        <span>₹${item.price}</span>
                    </div>

                    <button
                        onclick="removeItem(${index})">
                        ❌
                    </button>

                </div>

            `;

        });

    }

    document.getElementById("totalPrice").innerText =
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

        alert("Your cart is empty!");

        return;

    }

    alert(
        "Checkout successful! Total: " +
        document.getElementById("totalPrice").innerText
    );

}


/* ===== CATEGORY FILTER ===== */

function filterProducts(category,button){

    let cards =
        document.querySelectorAll(".card");

    cards.forEach(card=>{

        if(category === "all" ||
           card.dataset.category === category){

            card.style.display = "block";

        }else{

            card.style.display = "none";

        }

    });


    document
        .querySelectorAll(".filters button")
        .forEach(btn=>{
            btn.classList.remove("active");
        });

    button.classList.add("active");

}


/* ===== SEARCH ===== */

function searchProducts(){

    let search =
        document
        .getElementById("search")
        .value
        .toLowerCase();

    document
        .querySelectorAll(".card")
        .forEach(card=>{

            let name =
                card.dataset.name.toLowerCase();

            if(name.includes(search)){

                card.style.display = "block";

            }else{

                card.style.display = "none";

            }

        });

}

</script>

</body>
</html>
