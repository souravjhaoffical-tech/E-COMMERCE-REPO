<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Portfolio</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
    scroll-behavior: smooth;
}

body {
    background: #000;
    color: white;
}

/* NAVBAR */
header {
    width: 100%;
    padding: 25px 8%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top: 0;
    z-index: 100;
    background: #000;
}

.logo {
    color: #b95f65;
    font-size: 28px;
    font-weight: bold;
    text-decoration: none;
}

nav {
    display: flex;
    gap: 35px;
}

nav a {
    color: white;
    text-decoration: none;
    font-size: 16px;
    font-weight: bold;
    transition: 0.3s;
}

nav a:hover,
nav a.active {
    color: #b95f65;
}

/* HOME SECTION */
section {
    min-height: 100vh;
    padding: 100px 8%;
    scroll-margin-top: 75px;
}

#home {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 60px;
    padding-top: 40px;
}

.home-img {
    flex: 1;
    display: flex;
    justify-content: center;
}

.home-img img {
    width: 100%;
    max-width: 410px;
    height: 540px;
    object-fit: cover;
    border-radius: 50%;
    box-shadow: 0 0 25px #b95f6540;
}

.home-content {
    flex: 1.2;
}

.home-content h1 {
    font-size: 48px;
    margin-bottom: 12px;
}

.home-content h1 span,
.home-content h2 span {
    color: #b95f65;
}

.home-content h2 {
    font-size: 30px;
    margin-bottom: 20px;
}

.home-content p {
    color: #ddd;
    line-height: 1.7;
    margin-bottom: 25px;
}

.social-icons {
    display: flex;
    gap: 15px;
    margin-bottom: 28px;
}

.social-icons a {
    color: #b95f65;
    border: 2px solid #b95f65;
    width: 40px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    text-decoration: none;
    font-weight: bold;
}

.social-icons a:hover {
    background: #b95f65;
    color: #000;
}

.btn {
    display: inline-block;
    padding: 12px 28px;
    border: 2px solid #b95f65;
    color: #b95f65;
    border-radius: 30px;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s;
}

.btn:hover {
    background: #b95f65;
    color: #000;
}

/* OTHER SECTIONS */
.section-title {
    text-align: center;
    font-size: 42px;
    margin-bottom: 45px;
}

.section-title span {
    color: #b95f65;
}

.section-content {
    max-width: 900px;
    margin: auto;
    padding: 30px;
    border: 1px solid #333;
    border-radius: 15px;
    background: #0b0b0b;
}

.section-content h3 {
    color: #b95f65;
    font-size: 25px;
    margin-bottom: 15px;
}

.section-content p {
    color: #ddd;
    line-height: 1.9;
    margin-bottom: 15px;
}

.skill {
    margin: 22px 0;
}

.skill p {
    margin-bottom: 8px;
}

.skill-bar {
    width: 100%;
    height: 10px;
    background: #333;
    border-radius: 10px;
    overflow: hidden;
}

.skill-level {
    height: 100%;
    background: #b95f65;
}

.contact-links a {
    color: #b95f65;
    text-decoration: none;
}

footer {
    text-align: center;
    padding: 25px;
    color: #aaa;
    border-top: 1px solid #222;
}

/* MOBILE */
@media (max-width: 900px) {
    header {
        flex-direction: column;
        gap: 20px;
    }

    nav {
        justify-content: center;
        flex-wrap: wrap;
        gap: 16px;
    }

    nav a {
        font-size: 14px;
    }

    #home {
        flex-direction: column;
        text-align: center;
        gap: 35px;
    }

    .home-img img {
        max-width: 300px;
        height: 350px;
    }

    .home-content h1 {
        font-size: 36px;
    }

    .home-content h2 {
        font-size: 24px;
    }

    .social-icons {
        justify-content: center;
    }

    section {
        padding: 75px 6%;
    }

    .section-title {
        font-size: 32px;
    }
}
</style>
</head>

<body>

<!-- NAVBAR: LINKS SAME HTML KE SECTIONS PAR JAYENGE -->
<header>
    <a href="#home" class="logo">Sourav</a>

    <nav>
        <a href="ourteam.php" class="active">Home</a>
        <a href="#services">Services</a>
        <a href="#skills">Skills</a>
        <a href="#education">Education</a>
        <a href="#experience">Experience</a>
        <a href="#contact">Contact</a>
    </nav>
</header>

<!-- HOME -->
<section id="home">

    <img src="Assets/sourav.jpeg" alt="Anime Profile"
     style="width: 280px; height: 300px; object-fit: cover; border-radius: 50%;">
    <div class="home-content">
        <h1>Hi, It's <span>Sourav</span></h1>
        <h2>I'm a <span>Developer</span></h2>

        <p>
            Hello! Welcome to my personal portfolio.
            I am passionate about web development, design
            and creating modern digital experiences.
            Explore my skills, education and projects below.
        </p>

        <div class="social-icons">
            <!-- Apne real social media links yahan add karna -->
            <a href="#contact" aria-label="LinkedIn">in</a>
            <a href="#contact" aria-label="GitHub">G</a>
            <a href="#contact" aria-label="X">X</a>
            <a href="#contact" aria-label="Instagram">IG</a>
        </div>

        <a href="#contact" class="btn">Hire me</a>
    </div>

</section>

<!-- SERVICES -->
<section id="services">
    <h2 class="section-title">My <span>Services</span></h2>

    <div class="section-content">
        <h3>Web Development</h3>
        <p>
            I create responsive websites using HTML, CSS,
            JavaScript and PHP.
        </p>

        <h3>UI Design</h3>
        <p>
            I design clean, modern and user-friendly website
            interfaces for different screen sizes.
        </p>

        <h3>Website Maintenance</h3>
        <p>
            I help maintain websites and fix layout or
            functionality issues.
        </p>
    </div>
</section>

<!-- SKILLS -->
<section id="skills">
    <h2 class="section-title">My <span>Skills</span></h2>

    <div class="section-content">

        <div class="skill">
            <p>HTML</p>
            <div class="skill-bar">
                <div class="skill-level" style="width:90%"></div>
            </div>
        </div>

        <div class="skill">
            <p>CSS</p>
            <div class="skill-bar">
                <div class="skill-level" style="width:80%"></div>
            </div>
        </div>

        <div class="skill">
            <p>JavaScript</p>
            <div class="skill-bar">
                <div class="skill-level" style="width:65%"></div>
            </div>
        </div>

        <div class="skill">
            <p>PHP and MySQL</p>
            <div class="skill-bar">
                <div class="skill-level" style="width:75%"></div>
            </div>
        </div>

    </div>
</section>

<!-- EDUCATION -->
<section id="education">
    <h2 class="section-title">My <span>Education</span></h2>

    <div class="section-content">
        <h3>My Academic Journey</h3>
        <p>
            <strong>Course:</strong> BCA
        </p>
        <p>
            <strong>Institution:</strong> Calcutta anglo gujrati college 
        </p>
        <p>
            <strong>Year:</strong> 2024-2028
        </p>
        <p>
            Education

**Bachelor of Computer Applications (BCA)**  
Calcutta Anglo Gujarati College  
Currently Pursuing

**Higher Secondary (Class 12)**  
Howrah St. John's High School  
Completed

**Secondary Education (Class 10)** 
Howrah St. John's High School  
Completed
        </p>
    </div>
</section>

<!-- EXPERIENCE -->
<section id="experience">
    <h2 class="section-title">My <span>Experience</span></h2>

    <div class="section-content">
        <h3>Projects and Experience</h3>
        <p>
            I am a passionate web developer with hands-on experience in building and developing web projects.<br>
            I have worked on several projects that have helped me improve my programming, problem-solving,<br>
             and database management skills. I enjoy creating user-friendly, responsive, and visually<br> 
             appealing websites.<br>

             Project: ShopVibe – E-commerce Website<br>

            ShopVibe is an e-commerce website that I developed as a project.<br>
             I worked on designing the website, writing code, managing the database,<br>
              and implementing essential shopping features.<br>
                <h4>Technologies used</h4>
                <br><br>

                - HTML and CSS for website structure and styling.<br>
                - PHP for server-side functionality.<br>
                - MySQL for database management.<br>
                - JavaScript for interactive features.<br>
                - XAMPP for local development and testing.<br><br>

                <h4> key contibution </h4>
                <br><br>
                - Designed and developed website pages with a user-friendly interface.<br>
                - Created and styled responsive layouts.<br>
                - Implemented product listing and shopping cart functionality.<br>
                - Worked on user registration and login.<br>
                - Managed product and user data using MySQL. <br>
                - Worked on checkout and payment-related functionality.<br>
                - Tested and debugged code to improve website performance.<br>
                <br><br>
                
        </p>

        <h3>ShopVibe E-Commerce Project</h3>
        <p>
            Experience & Skills
                <br>
                I have practical project-based experience in web development and database management. <br>  
                 Through working on multiple projects, I have gained experience in writing clean code, designing web pages, <br>
                  connecting websites with databases, troubleshooting errors, and developing functional web applications.<br>

                    <br>
                Technical Skills: HTML, CSS, PHP, JavaScript, MySQL, Database Management, Git, GitHub, XAMPP, and basic React.js.
                <br><br>
        </p>
    </div>
</section>

<!-- CONTACT -->
<section id="contact">
    <h2 class="section-title">Contact <span>Me</span></h2>

    <div class="section-content contact-links">
        <h3>Let's Work Together</h3>

        <p>
            Email:
            <a href="mailto:souravjhaoffical@gmail.com">
                souravjhaoffical@gmail.com
            </a>
        </p>

        <p>
            GitHub:
            <a href="https://github.com/souravjhaoffical-tech">
                souravjhaoffical-tech
            </a>
        </p>

        <p>
            +91-7003779937
        </p>
    </div>
</section>

<footer>
    &copy; 2026 Sourav | My Portfolio
</footer>

</body>
</html>