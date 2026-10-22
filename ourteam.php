<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Our Team - ShopVibe</title>

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

/* HEADING */
.team-hero {
    text-align: center;
    padding: 45px 20px 25px;
}

.team-hero h1 {
    font-size: 42px;
    color: #111827;
    margin-bottom: 15px;
}

.team-hero h1 span {
    color: #ff9800;
}

.team-hero p {
    color: #666;
    font-size: 17px;
    line-height: 1.7;
}

/* TEAM IMAGE */
.team-container {
    max-width: 1100px;
    margin: 20px auto 60px;
    padding: 0 20px;
}

.team-photo {
    position: relative;
    width: 100%;
    max-width: 700px;
    margin: 0 auto;
    overflow: hidden;
    border-radius: 18px;
    box-shadow: 0 10px 30px #0002;
}

.team-photo img {
    display: block;
    width: 100%;
    height: auto;
}

/* INVISIBLE CHARACTER CLICK AREAS */
.character {
    position: absolute;
    top: 0;
    height: 100%;
    border: none;
    outline: none;
    background: transparent;
    box-shadow: none;
    cursor: pointer;
    border-radius: 0;
    -webkit-tap-highlight-color: transparent;
}

.character:hover,
.character:focus,
.character:focus-visible,
.character:active {
    border: none;
    outline: none;
    background: transparent;
    box-shadow: none;
}

/* CHARACTER POSITIONS */
.character-1 {
    left: 0%;
    width: 25%;
}

.character-2 {
    left: 25%;
    width: 23%;
}

.character-3 {
    left: 48%;
    width: 25%;
}

.character-4 {
    left: 73%;
    width: 27%;
}
/* HAR CHARACTER KE UPAR NAAM */
.name-box {
    display: none;
    position: absolute;
    z-index: 20;
    transform: translateX(-50%);
    text-align: center;
    background: transparent;
    padding: 0;
    max-width: 90%;
}

.name-box.show {
    display: block;
}

.name-box a {
    color: white;
    background: rgba(0, 0, 0, 0.7);
    padding: 7px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 16px;
    font-weight: bold;
    white-space: nowrap;
}

.name-box a:hover {
    text-decoration: underline;
}
/* CLICKABLE NAME */
.name-box a {
    display: inline-block;
    color: white;
    background: rgba(0, 0, 0, 0.7);
    padding: 8px 14px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 18px;
    font-weight: bold;
}

.name-box a:hover {
    text-decoration: underline;
}

/* FOOTER */
footer {
    background: #111827;
    color: white;
    text-align: center;
    padding: 22px;
}

footer span {
    color: #ff9800;
}

/* MOBILE RESPONSIVE */
@media (max-width: 768px) {
    nav {
        justify-content: center;
    }

    nav ul {
        justify-content: center;
        gap: 13px;
    }

    .team-hero {
        padding: 35px 15px 20px;
    }

    .team-hero h1 {
        font-size: 31px;
    }

    .team-hero p {
        font-size: 15px;
    }

    .team-container {
        padding: 0 10px;
    }

    .team-photo {
        border-radius: 10px;
    }

    .name-box a {
        padding: 6px 10px;
        font-size: 14px;
    }
}
</style>
</head>

<body id="top">

<!-- NAVBAR -->
<nav>
    <a href="index.php" class="logo">
        <img src="Assets/LOGO.jpeg" alt="ShopVibe Logo">
        ShopVibe
    </a>

    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="mission.php">Our Mission</a></li>
        <li><a href="why-choose-us.php">Why Choose Us</a></li>
        <li><a href="ourteam.php" class="active">Our Team</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="faq.php">FAQ</a></li>
    </ul>
</nav>

<!-- HEADING -->
<section class="team-hero">
    <h1>Meet Our <span>Teammates</span></h1>
    <p>Click on a character to meet our team!</p>
</section>

<!-- TEAM IMAGE -->
<section class="team-container">

    <div class="team-photo">

        <!-- TEAM IMAGE PATH -->
        <img src="Assets/team-photo.jpeg.jpeg"
             alt="ShopVibe Team">

        <!-- NAME POPUP: ONLY NAME WILL APPEAR -->
        <div class="name-box" id="nameBox">
            <a href="#" id="memberLink">Teammate Name</a>
        </div>

        <!-- CHARACTER 1: LEFT SIDE -->
        <button type="button"
                class="character character-1"
                aria-label="Meet teammate 1"
                onclick="showName(1)">
        </button>

        <!-- CHARACTER 2 -->
        <button type="button"
                class="character character-2"
                aria-label="Meet teammate 2"
                onclick="showName(2)">
        </button>

        <!-- CHARACTER 3 -->
        <button type="button"
                class="character character-3"
                aria-label="Meet teammate 3"
                onclick="showName(3)">
        </button>

        <!-- CHARACTER 4: RIGHT SIDE -->
        <button type="button"
                class="character character-4"
                aria-label="Meet teammate 4"
                onclick="showName(4)">
        </button>

    </div>

</section>

<!-- FOOTER -->
<footer>
    &copy; <?php echo date("Y"); ?>
    <span>ShopVibe</span>. All Rights Reserved.
</footer>

<script>

/* ==========================================
   APNE TEAMMATES KE NAAM AUR PAGE LINKS YAHAAN SET KARO

   name = popup mein dikhne wala naam
   link = naam par click karne se khulne wala page

   Example:
   name: "Rahul",
   link: "rahul.php"
   ========================================== */

const teammates = {
    1: {
        name: "Amish singh",
        link: "amish.php"
    },

    2: {
        name: "Ritika varma",
        link: "member2.php"
    },

    3: {
        name: "sourav kumar jha",
        link: "member3.php"
    },

    4: {
        name: "santosh verma",
        link: "member4.php"
    }
};

function showName(number) {
    const teammate = teammates[number];
    const nameBox = document.getElementById("nameBox");
    const memberLink = document.getElementById("memberLink");

    memberLink.textContent = teammate.name;
    memberLink.href = teammate.link;

    // Har character ke upar naam ki position
    const positions = {
        1: { left: "12.5%", top: "10%" },
        2: { left: "36.5%", top: "10%" },
        3: { left: "60.5%", top: "10%" },
        4: { left: "86.5%", top: "10%" }
    };

    nameBox.style.left = positions[number].left;
    nameBox.style.top = positions[number].top;

    nameBox.classList.add("show");
}

</script>

</body>
</html>
