<?php 
include "db.php"; 
 
if (isset($_POST['add'])) { 
    $brand = $_POST['brand']; 
    $name = $_POST['name']; 
    $price = $_POST['price']; 
 
    $sql = "INSERT INTO eproduct (p_brand, p_name, p_price) 
            VALUES ('$brand','$name','$price')"; 
    
    mysqli_query($conn,$sql); 
    
    header("location: product.php"); 
} 
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>ShopVibe - Add Product</title>


<style>

/* ================= RESET ================= */

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}


/* ================= BODY ================= */

body{

    min-height:100vh;

    display:flex;

    justify-content:center;

    align-items:center;

    background:
        radial-gradient(
            circle at top left,
            rgba(0,234,255,.15),
            transparent 35%
        ),
        radial-gradient(
            circle at bottom right,
            rgba(255,60,172,.15),
            transparent 35%
        ),
        #080b16;

    color:white;

    overflow:hidden;

}


/* ================= BACKGROUND CIRCLES ================= */

.bg-circle{

    position:fixed;

    border-radius:50%;

    filter:blur(3px);

    opacity:.25;

    pointer-events:none;

}


.circle1{

    width:300px;
    height:300px;

    background:#00eaff;

    top:-100px;
    left:-100px;

    animation:
        moveCircle1 7s ease-in-out infinite alternate;

}


.circle2{

    width:350px;
    height:350px;

    background:#ff3cac;

    bottom:-150px;
    right:-100px;

    animation:
        moveCircle2 8s ease-in-out infinite alternate;

}


@keyframes moveCircle1{

    from{
        transform:translate(0,0);
    }

    to{
        transform:translate(150px,120px);
    }

}


@keyframes moveCircle2{

    from{
        transform:translate(0,0);
    }

    to{
        transform:translate(-120px,-100px);
    }

}


/* ================= MAIN CARD ================= */

.container{

    width:500px;

    padding:40px;

    border-radius:30px;

    background:
        rgba(17,21,39,.85);

    backdrop-filter:blur(20px);

    border:
        1px solid rgba(255,255,255,.12);

    box-shadow:

        0 30px 80px rgba(0,0,0,.6),

        0 0 40px rgba(0,234,255,.08),

        inset 0 0 30px
        rgba(255,255,255,.02);

    transform-style:preserve-3d;

    animation:
        cardAppear 1s ease forwards;

    position:relative;

}


/* ================= CARD ANIMATION ================= */

@keyframes cardAppear{

    from{

        opacity:0;

        transform:
            translateY(80px)
            rotateX(20deg)
            scale(.9);

    }

    to{

        opacity:1;

        transform:
            translateY(0)
            rotateX(0)
            scale(1);

    }

}


/* ================= TOP GLOW ================= */

.container::before{

    content:"";

    position:absolute;

    top:-2px;
    left:20%;

    width:60%;
    height:2px;

    background:
        linear-gradient(
            90deg,
            transparent,
            #00eaff,
            #ff3cac,
            transparent
        );

    box-shadow:
        0 0 20px #00eaff;

}


/* ================= LOGO ================= */

.logo{

    text-align:center;

    font-size:32px;

    font-weight:bold;

    margin-bottom:8px;

    color:#00eaff;

    text-shadow:
        0 0 15px rgba(0,234,255,.5);

    animation:
        logoFloat 3s ease-in-out infinite;

}


.logo span{

    color:#ff3cac;

}


@keyframes logoFloat{

    0%,100%{
        transform:translateY(0);
    }

    50%{
        transform:translateY(-5px);
    }

}


/* ================= HEADING ================= */

h1{

    text-align:center;

    font-size:28px;

    margin-top:15px;

    margin-bottom:8px;

}


.subtitle{

    text-align:center;

    color:#888;

    font-size:14px;

    margin-bottom:30px;

}


/* ================= FORM ================= */

.form-group{

    margin-bottom:22px;

}


.form-group label{

    display:block;

    margin-bottom:8px;

    color:#ccc;

    font-size:14px;

}


/* ================= INPUT ================= */

.form-group input{

    width:100%;

    padding:15px 18px;

    border-radius:14px;

    border:
        1px solid rgba(255,255,255,.1);

    outline:none;

    background:#0c1020;

    color:white;

    font-size:15px;

    transition:.3s;

    box-shadow:
        inset 0 0 15px
        rgba(0,0,0,.25);

}


.form-group input::placeholder{

    color:#666;

}


.form-group input:focus{

    border-color:#00eaff;

    box-shadow:

        0 0 20px
        rgba(0,234,255,.15),

        inset 0 0 10px
        rgba(0,234,255,.05);

    transform:
        translateZ(10px)
        scale(1.01);

}


/* ================= ADD BUTTON ================= */

.add-btn{

    width:100%;

    padding:15px;

    margin-top:5px;

    border:none;

    border-radius:15px;

    background:
        linear-gradient(
            90deg,
            #00eaff,
            #0077ff,
            #ff3cac
        );

    background-size:200% 200%;

    color:white;

    font-size:16px;

    font-weight:bold;

    cursor:pointer;

    box-shadow:

        0 7px 0 #075078,

        0 15px 30px
        rgba(0,234,255,.2);

    transition:.3s;

    animation:
        gradientMove 4s ease infinite;

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


.add-btn:hover{

    transform:
        translateY(-6px)
        scale(1.02);

    box-shadow:

        0 12px 0 #075078,

        0 25px 40px
        rgba(0,234,255,.3);

}


.add-btn:active{

    transform:translateY(3px);

    box-shadow:

        0 3px 0 #075078;

}


/* ================= BACK LINK ================= */

.back-link{

    display:block;

    text-align:center;

    margin-top:22px;

    color:#00eaff;

    text-decoration:none;

    font-size:14px;

    transition:.3s;

}


.back-link:hover{

    color:#ff3cac;

    transform:translateY(-2px);

}


/* ================= 3D FLOATING ICONS ================= */

.icon{

    position:fixed;

    font-size:35px;

    opacity:.15;

    pointer-events:none;

}


.icon1{

    top:20%;

    left:12%;

    animation:
        iconFloat1 5s ease-in-out infinite;

}


.icon2{

    top:65%;

    left:8%;

    animation:
        iconFloat2 6s ease-in-out infinite;

}


.icon3{

    top:20%;

    right:10%;

    animation:
        iconFloat3 5s ease-in-out infinite;

}


.icon4{

    bottom:15%;

    right:12%;

    animation:
        iconFloat4 7s ease-in-out infinite;

}


@keyframes iconFloat1{

    0%,100%{
        transform:
            translateY(0)
            rotate(0deg);
    }

    50%{
        transform:
            translateY(-30px)
            rotate(20deg);
    }

}


@keyframes iconFloat2{

    0%,100%{
        transform:
            translateY(0)
            rotate(0deg);
    }

    50%{
        transform:
            translateY(25px)
            rotate(-20deg);
    }

}


@keyframes iconFloat3{

    0%,100%{
        transform:
            translateY(0)
            rotate(0deg);
    }

    50%{
        transform:
            translateY(-25px)
            rotate(-15deg);
    }

}


@keyframes iconFloat4{

    0%,100%{
        transform:
            translateY(0)
            rotate(0deg);
    }

    50%{
        transform:
            translateY(30px)
            rotate(15deg);
    }

}


/* ================= RESPONSIVE ================= */

@media(max-width:600px){

    .container{

        width:
            calc(100% - 30px);

        padding:30px 25px;

    }

    .logo{

        font-size:27px;

    }

    h1{

        font-size:24px;

    }

    .icon{

        display:none;

    }

}

</style>

</head>


<body>


<!-- BACKGROUND -->

<div class="bg-circle circle1"></div>

<div class="bg-circle circle2"></div>


<!-- FLOATING ICONS -->

<div class="icon icon1">
    🛒
</div>

<div class="icon icon2">
    📦
</div>

<div class="icon icon3">
    💳
</div>

<div class="icon icon4">
    🛍️
</div>



<!-- MAIN FORM -->

<div class="container">


    <div class="logo">
        shop<span> vibe</span>
    </div>


    <h1>
        Add Product
    </h1>


    <p class="subtitle">
        Add a new product to your ShopVibe store
    </p>



    <form method="post">


        <!-- BRAND -->

        <div class="form-group">

            <label>
                Product Brand
            </label>

            <input
                type="text"
                name="brand"
                placeholder="Enter product brand"
                required>

        </div>



        <!-- PRODUCT NAME -->

        <div class="form-group">

            <label>
                Product Name
            </label>

            <input
                type="text"
                name="name"
                placeholder="Enter product name"
                required>

        </div>



        <!-- PRICE -->

        <div class="form-group">

            <label>
                Product Price
            </label>

            <input
                type="number"
                name="price"
                placeholder="Enter product price"
                required>

        </div>



        <!-- BUTTON -->

        <button
            type="submit"
            name="add"
            class="add-btn">

            + Add Product

        </button>


    </form>



    <!-- BACK -->

    <a
        href="product.php"
        class="back-link">

        ← View Products

    </a>


</div>


</body>

</html>


