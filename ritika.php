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
    <a href="#home" class="logo">Ritika</a>

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

    <img src="Assets/ritika.jpeg" alt="Anime Profile"
     style="width: 280px; height: 300px; object-fit: cover; border-radius: 50%;">
    <div class="home-content">
        <h1>Hi, It's <span>Ritika</span></h1>
        <h2>I'm a <span>Developer</span></h2>

        <p>
            Hello! Welcome to my personal portfolio.
            I am passionate about web development, design
            and creating modern digital experiences.
            Explore my skills, education and projects below.
        </p>

        <div class="social-icons">
            <!-- Apne real social media links yahan add karna -->
            <a href="https://www.linkedin.com/in/ritika-varma-667b71374/?isSelfProfile=true" aria-label="LinkedIn">in</a>
            <a href="https://github.com/ritikavarma235" aria-label="GitHub">G</a>
            <a href="#contact" aria-label="X">X</a>
            <a href="https://www.instagram.com/_.imritika23._/" aria-label="Instagram">IG</a>
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
            <strong>Course:</strong> Bachelor of computer applications (BCA)
        </p>
        <p>
            <strong>Institution:</strong> The Calcutta Anglo Gujarati College
        </p>
        <p>
            <strong>Year:</strong> 2024 - 2028
        </p>
        <p>
            <strong>Education:</strong> Bachelor of Computer Applications (BCA) - The Calcutta Anglo Gujarati College (Currently Pursuing)
        </p>
        <p>
            <strong>Higher Secondary:</strong> Class 12 - H.M.Education Centre (Completed)
        </p>
        <p>
            <strong>Secondary Education:</strong> Class 10 - H.M.Education Centre (Completed)
        </p>
    </div>
</section>

<!-- EXPERIENCE -->
<section id="experience">
    <h2 class="section-title">My <span>Experience</span></h2>

    <div class="section-content">
        <h3>Projects and Experience</h3>
        <p>
            I am an aspiring web developer with hands-on, project-based experience in building and developing web applications. I enjoy designing user-friendly interfaces, implementing functional features, working with databases, and solving programming problems. Through collaborative development, I have gained practical experience in frontend design, backend development, database integration, debugging, and version control.<br>
            
            Project: ShopVibe – E-Commerce Website
            ShopVibe is a collaborative e-commerce web application developed as part of a team project. I have contributed to website design, PHP development, MySQL database integration, user-facing pages, and shopping-related functionality. I have also worked on improving the website interface and developing an inventory management feature to track product quantities and availability.<br><br>
            
            <h4>Technologies Used</h4>
            <br>
            - HTML5 and CSS3: Website structure, styling, responsive layouts, and UI improvements.<br>
            - JavaScript: Interactive website functionality.<br>
            - PHP: Server-side scripting and backend functionality.<br>
            - MySQL: Database management and product data handling.<br>
            - React.js: Basic frontend development and integration.<br>
            - Git and GitHub: Version control, committing changes, pushing updates, and collaborating with teammates.<br>
            - XAMPP: Local development and testing environment.<br><br>

            <h4> Key Contributions </h4>
            <br>
            - Designed and improved website pages with a clean, user-friendly interface.<br>
            - Contributed to product listing, shopping cart, and user authentication features.<br>
            - Worked with PHP and MySQL for backend functionality and database management.<br>
            - Developed an initial inventory management page to track product quantities and stock availability.<br>
            - Updated the product database schema and integrated stock management into the admin dashboard.<br>
            - Used Git and GitHub for version control and team collaboration.<br>
            - Tested and debugged the application using XAMPP.
            <br><br>

            
        </p>

        <h3>ShopVibe E-Commerce Project</h3>
        <p>
            Experience & Skills
            <br>
            Through working on ShopVibe, I have developed practical experience in collaborative web development, database integration, debugging, and maintaining code using version control. I am continuing to improve my skills in building responsive interfaces, developing backend functionality, and integrating frontend and database components.


            <br>
            Technical Skills: HTML5, CSS3, JavaScript, PHP, MySQL, Database Management, Git, GitHub, XAMPP, and Basic React.js.
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
            <a href="mailto:varmaritika712@gmail.com">
                varmaritika712@gmail.com
            </a>
        </p>

        <p>
            GitHub:
            <a href="https://github.com/ritikavarma235">
                Visit GitHub
            </a>
        </p>

        <p>
            Phone:
            <a href="tel:+91 9830446890">
                +91 9830446890
            </a>
        </p>
    </div>
</section>

<footer>
    &copy; 2026 Ritika | My Portfolio
</footer>

</body>
</html>