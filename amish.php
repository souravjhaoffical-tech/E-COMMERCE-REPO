
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#080d1b">
    <title>Amish Kumar Singh | Portfolio</title>

    <!-- Existing Dark Mode Files -->
    <link rel="stylesheet" href="darkmode/darkmode.css">
    <script src="darkmode/darkmode-head.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
        }

        :root {
            --bg: #080d1b;
            --card: #111a2e;
            --text: #f4f7ff;
            --muted: #aab5ca;
            --accent: #7c8cff;
            --accent2: #38d6c5;
            --border: rgba(255,255,255,.1);
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .container {
            width: 88%;
            max-width: 1150px;
            margin: auto;
        }

        header {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(8,13,27,.92);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid var(--border);
        }

        nav {
            min-height: 75px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            font-size: 25px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .logo span {
            color: var(--accent);
        }

        .nav-links {
            display: flex;
            gap: 27px;
            list-style: none;
        }

        .nav-links a {
            color: var(--muted);
            font-size: 14px;
            transition: .3s;
        }

        .nav-links a:hover {
            color: var(--accent);
        }

        .hero {
            min-height: 88vh;
            display: flex;
            align-items: center;
            padding: 70px 0;
        }

        .hero-content {
            display: grid;
            grid-template-columns: 1.4fr 1fr;
            align-items: center;
            gap: 60px;
        }

        .tag {
            display: inline-block;
            color: var(--accent2);
            border: 1px solid rgba(56,214,197,.3);
            background: rgba(56,214,197,.08);
            padding: 7px 15px;
            border-radius: 30px;
            font-size: 13px;
            margin-bottom: 22px;
        }

        .hero h1 {
            font-size: clamp(38px, 6vw, 65px);
            line-height: 1.12;
            margin-bottom: 20px;
        }

        .hero h1 span {
            color: var(--accent);
        }

        .hero p {
            color: var(--muted);
            max-width: 600px;
            font-size: 16px;
            margin-bottom: 30px;
        }

        .buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 12px 23px;
            border-radius: 8px;
            background: var(--accent);
            color: white;
            font-weight: bold;
            transition: .3s;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(124,140,255,.25);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--border);
        }

        .profile-image {
            width: 320px;
            height: 320px;
            margin: auto;
            border-radius: 50%;
            padding: 8px;
            background: linear-gradient(135deg,var(--accent),var(--accent2));
            box-shadow: 0 0 70px rgba(124,140,255,.18);
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid var(--bg);
        }

        section {
            padding: 85px 0;
            scroll-margin-top: 80px;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title h2 {
            font-size: 35px;
            margin-bottom: 10px;
        }

        .section-title p {
            color: var(--muted);
        }

        .section-title span {
            color: var(--accent);
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 35px;
        }

        .card {
            background: var(--card);
            padding: 30px;
            border: 1px solid var(--border);
            border-radius: 16px;
            transition: .3s;
        }

        .card:hover {
            transform: translateY(-5px);
            border-color: rgba(124,140,255,.5);
        }

        .card h3 {
            margin-bottom: 15px;
            font-size: 21px;
        }

        .card p {
            color: var(--muted);
        }

        .skills-grid {
            display: grid;
            grid-template-columns: repeat(4,1fr);
            gap: 18px;
        }

        .skill {
            text-align: center;
            padding: 25px 15px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            transition: .3s;
        }

        .skill:hover {
            transform: translateY(-5px);
            border-color: var(--accent);
        }

        .skill h3 {
            font-size: 17px;
            margin-bottom: 8px;
        }

        .skill p {
            color: var(--muted);
            font-size: 13px;
        }

        .timeline {
            max-width: 750px;
            margin: auto;
        }

        .timeline-item {
            padding: 25px;
            margin-bottom: 20px;
            border-left: 3px solid var(--accent);
            background: var(--card);
            border-radius: 0 12px 12px 0;
        }

        .timeline-item h3 {
            margin-bottom: 6px;
        }

        .timeline-item span {
            color: var(--accent2);
            font-size: 14px;
        }

        .timeline-item p {
            color: var(--muted);
            margin-top: 10px;
        }

        .project-grid {
            display: grid;
            grid-template-columns: repeat(2,1fr);
            gap: 25px;
        }

        .project-card {
            background: var(--card);
            padding: 30px;
            border-radius: 15px;
            border: 1px solid var(--border);
        }

        .project-card h3 {
            margin-bottom: 12px;
        }

        .project-card p {
            color: var(--muted);
            margin-bottom: 18px;
        }

        .project-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .project-tags span {
            background: rgba(124,140,255,.12);
            color: var(--accent);
            padding: 5px 11px;
            border-radius: 20px;
            font-size: 12px;
        }

        .contact-box {
            max-width: 700px;
            margin: auto;
            text-align: center;
        }

        .contact-box p {
            color: var(--muted);
            margin-bottom: 25px;
        }

        footer {
            text-align: center;
            padding: 25px;
            border-top: 1px solid var(--border);
            color: var(--muted);
            font-size: 14px;
        }

        /* =================================
           SWARM REBUILD - SINGLE ENGINE
        ================================= */

        .swarm-overlay {
            position: fixed;
            inset: 0;
            z-index: 998;
            pointer-events: none;
            opacity: 1;
            transition: opacity .7s ease;
        }

        .swarm-overlay.finished {
            opacity: 0;
        }

        .swarm-hud {
            position: fixed;
            top: 92px;
            left: 50%;
            transform: translateX(-50%);
            width: min(390px, calc(100vw - 30px));
            padding: 15px 18px;
            background: rgba(12,20,40,.95);
            border: 1px solid rgba(124,140,255,.4);
            border-radius: 14px;
            box-shadow: 0 12px 45px rgba(0,0,0,.4);
            backdrop-filter: blur(15px);
            color: white;
        }

        .swarm-hud-top {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            align-items: center;
            font-size: 13px;
            font-weight: bold;
        }

        .swarm-hud-status {
            color: #38d6c5;
            font-size: 11px;
            margin-top: 8px;
            min-height: 17px;
        }

        .swarm-track {
            height: 5px;
            background: rgba(255,255,255,.12);
            border-radius: 10px;
            margin-top: 12px;
            overflow: hidden;
        }

        .swarm-track-fill {
            width: 0;
            height: 100%;
            background: linear-gradient(90deg,#7c8cff,#38d6c5);
            border-radius: 10px;
            transition: width .15s linear;
        }

        .swarm-agent {
            position: fixed;
            z-index: 999;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            gap: 6px;
            pointer-events: none;
            opacity: 0;
            transition:
                left .35s ease,
                top .35s ease,
                opacity .3s;
        }

        .swarm-agent.visible {
            opacity: 1;
        }

        .swarm-cursor {
            width: 0;
            height: 0;
            border-left: 7px solid transparent;
            border-right: 3px solid transparent;
            border-top: 19px solid var(--agent-color);
            transform: rotate(-25deg);
            filter: drop-shadow(0 0 5px var(--agent-color));
        }

        .swarm-agent-name {
            background: var(--agent-color);
            color: #07101e;
            padding: 4px 9px;
            border-radius: 5px 8px 8px 8px;
            font-size: 10px;
            font-weight: bold;
            white-space: nowrap;
            box-shadow: 0 3px 12px rgba(0,0,0,.25);
        }

        .swarm-target {
            outline: 2px solid var(--agent-color) !important;
            outline-offset: 5px;
            box-shadow: 0 0 25px var(--agent-glow) !important;
        }

        /* Character reveal */

        .swarm-char {
            opacity: 0;
            transition: opacity .04s linear;
        }

        .swarm-char.visible {
            opacity: 1;
        }

        /* Replay button */

        .swarm-replay {
            position: fixed;
            right: 22px;
            bottom: 22px;
            z-index: 1000;
            border: 1px solid rgba(124,140,255,.5);
            background: linear-gradient(135deg,#7c8cff,#38d6c5);
            color: #07101e;
            padding: 13px 20px;
            border-radius: 30px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 5px 25px rgba(124,140,255,.3);
            transition: .3s;
        }

        .swarm-replay:hover {
            transform: translateY(-4px);
        }

        .swarm-replay:disabled {
            opacity: .6;
            cursor: wait;
        }

        @media(max-width:900px) {
            .hero-content {
                grid-template-columns: 1fr 1fr;
                gap: 30px;
            }

            .skills-grid {
                grid-template-columns: repeat(2,1fr);
            }
        }

        @media(max-width:650px) {
            .container {
                width: 92%;
            }

            nav {
                flex-direction: column;
                padding: 15px 0;
                gap: 12px;
            }

            .nav-links {
                gap: 13px;
                flex-wrap: wrap;
                justify-content: center;
            }

            .nav-links a {
                font-size: 12px;
            }

            .hero {
                padding: 55px 0;
            }

            .hero-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .hero p {
                margin-left: auto;
                margin-right: auto;
            }

            .buttons {
                justify-content: center;
            }

            .profile-image {
                width: 240px;
                height: 240px;
                grid-row: 1;
            }

            .about-grid,
            .project-grid {
                grid-template-columns: 1fr;
            }

            .section-title h2 {
                font-size: 29px;
            }

            section {
                padding: 65px 0;
            }

            .swarm-hud {
                top: 135px;
            }

            .swarm-replay {
                right: 12px;
                bottom: 12px;
                padding: 11px 15px;
                font-size: 12px;
            }

            .swarm-agent-name {
                font-size: 9px;
            }
        }

        @media(prefers-reduced-motion:reduce) {
            .swarm-agent,
            .swarm-overlay,
            .swarm-target,
            .swarm-char {
                transition-duration: .01ms !important;
            }
        }

    </style>
</head>

<body>

<!-- HEADER -->

<header>
    <div class="container">
        <nav>
            <a href="#home" class="logo">AMISH<span>.</span></a>

            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#skills">Skills</a></li>
                <li><a href="#education">Education</a></li>
                <li><a href="#projects">Projects</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </div>
</header>

<!-- HOME SECTION -->

<section class="hero" id="home">
    <div class="container">
        <div class="hero-content">

            <div>
                <span class="tag">Welcome to my portfolio</span>

                <h1>
                    Hi, I'm <span>Amish Kumar Singh</span>
                </h1>

                <p>
                    I'm a BCA student and aspiring web developer passionate
                    about building modern, responsive and user-friendly
                    websites. I enjoy working with frontend technologies
                    and exploring backend development.
                </p>

                <div class="buttons">
                    <a href="#projects" class="btn">View My Work</a>
                    <a href="#contact" class="btn btn-outline">Contact Me</a>
                </div>
            </div>

            <div class="profile-image">
                <img src="Assets/amish.jpeg.jpeg" alt="Amish Kumar Singh">
            </div>

        </div>
    </div>
</section>

<!-- ABOUT SECTION -->

<section id="about">
    <div class="container">

        <div class="section-title">
            <h2>About <span>Me</span></h2>
            <p>Get to know more about me</p>
        </div>

        <div class="about-grid">

            <div class="card">
                <h3>Who I Am</h3>
                <p>
                    I am a Bachelor of Computer Applications student
                    interested in web development and software technology.
                    I enjoy learning new technologies and turning ideas
                    into practical projects.
                </p>
            </div>

            <div class="card">
                <h3>My Goals</h3>
                <p>
                    My goal is to become a skilled full-stack developer.
                    I am continuously improving my programming knowledge,
                    problem-solving abilities and practical development skills.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- SKILLS SECTION -->

<section id="skills">
    <div class="container">

        <div class="section-title">
            <h2>My <span>Skills</span></h2>
            <p>Technologies and tools I work with</p>
        </div>

        <div class="skills-grid">

            <div class="skill">
                <h3>HTML5</h3>
                <p>Web Structure</p>
            </div>

            <div class="skill">
                <h3>CSS3</h3>
                <p>Web Styling</p>
            </div>

            <div class="skill">
                <h3>JavaScript</h3>
                <p>Interactive Websites</p>
            </div>

            <div class="skill">
                <h3>PHP</h3>
                <p>Backend Development</p>
            </div>

            <div class="skill">
                <h3>MySQL</h3>
                <p>Database Management</p>
            </div>

            <div class="skill">
                <h3>React</h3>
                <p>Frontend Development</p>
            </div>

            <div class="skill">
                <h3>C Programming</h3>
                <p>Programming Fundamentals</p>
            </div>

            <div class="skill">
                <h3>MS Office</h3>
                <p>Productivity Tools</p>
            </div>

        </div>
    </div>
</section>

<!-- EDUCATION SECTION -->

<section id="education">
    <div class="container">

        <div class="section-title">
            <h2>My <span>Education</span></h2>
            <p>My academic journey</p>
        </div>

        <div class="timeline">

            <div class="timeline-item">
                <h3>Bachelor of Computer Applications (BCA)</h3>
                <span>Gujarati Anglo College</span>
                <p>
                    Currently pursuing BCA under Maulana Abul Kalam Azad
                    University of Technology (MAKAUT).
                </p>
            </div>

            <div class="timeline-item">
                <h3>Higher Secondary Education</h3>
                <span>West Point Academy</span>
                <p>
                    Completed higher secondary education with a focus
                    on the PCMB stream.
                </p>
            </div>

            <div class="timeline-item">
                <h3>Secondary Education</h3>
                <span>Jogamaya Memorial Institute</span>
                <p>
                    Completed secondary education with a strong
                    academic foundation.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- PROJECTS SECTION -->

<section id="projects">
    <div class="container">

        <div class="section-title">
            <h2>My <span>Projects</span></h2>
            <p>Some of my development work</p>
        </div>

        <div class="project-grid">

            <div class="project-card">
                <h3>Shop Vibe - E-Commerce Website</h3>

                <p>
                    A team-based e-commerce project focused on building
                    an online shopping platform with product management,
                    user authentication and database integration.
                </p>

                <div class="project-tags">
                    <span>HTML</span>
                    <span>CSS</span>
                    <span>PHP</span>
                    <span>MySQL</span>
                    <span>React</span>
                </div>
            </div>

            <div class="project-card">
                <h3>Personal Portfolio Website</h3>

                <p>
                    A responsive personal portfolio website designed
                    to present my skills, education, projects and
                    professional information.
                </p>

                <div class="project-tags">
                    <span>HTML</span>
                    <span>CSS</span>
                    <span>JavaScript</span>
                    <span>Responsive Design</span>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- CONTACT SECTION -->

<section id="contact">
    <div class="container">

        <div class="section-title">
            <h2>Contact <span>Me</span></h2>
            <p>Let's connect and work together</p>
        </div>

        <div class="contact-box">
            <p>
                Feel free to connect with me for collaboration,
                development opportunities or professional discussions.
            </p>

            <div class="buttons" style="justify-content:center;">

                <a href="https://www.linkedin.com/in/amishkumarsingh"
                   class="btn"
                   target="_blank"
                   rel="noopener noreferrer">
                    LinkedIn
                </a>

                <a href="https://github.com/Amish-works"
                   class="btn btn-outline"
                   target="_blank"
                   rel="noopener noreferrer">
                    GitHub
                </a>

                <a href="mailto:singhamishkumar0624@gmail.com"
                   class="btn btn-outline">
                    Email Me
                </a>

            </div>
        </div>

    </div>
</section>

<!-- FOOTER -->

<footer>
    <p>© 2026 Amish Kumar Singh. All Rights Reserved.</p>
</footer>


<!-- ==================================
     SINGLE SWARM REBUILD INTERFACE
================================== -->

<div class="swarm-overlay" id="swarmOverlay">

    <div class="swarm-hud">

        <div class="swarm-hud-top">
            <span>⚡ SWARM REBUILD</span>
            <span id="swarmPercent">0%</span>
        </div>

        <div class="swarm-hud-status" id="swarmStatus">
            Initializing virtual agents...
        </div>

        <div class="swarm-track">
            <div class="swarm-track-fill" id="swarmProgress"></div>
        </div>

    </div>

    <!-- PIXEL -->

    <div class="swarm-agent" id="agentPixel"
         style="--agent-color:#ff6384;--agent-glow:rgba(255,99,132,.3)">

        <span class="swarm-cursor"></span>
        <span class="swarm-agent-name">⚡ Pixel</span>

    </div>

    <!-- NOVA -->

    <div class="swarm-agent" id="agentNova"
         style="--agent-color:#38d6c5;--agent-glow:rgba(56,214,197,.3)">

        <span class="swarm-cursor"></span>
        <span class="swarm-agent-name">🌐 Nova</span>

    </div>

    <!-- BYTE -->

    <div class="swarm-agent" id="agentByte"
         style="--agent-color:#b18cff;--agent-glow:rgba(177,140,255,.3)">

        <span class="swarm-cursor"></span>
        <span class="swarm-agent-name">💻 Byte</span>

    </div>

    <!-- ECHO -->

    <div class="swarm-agent" id="agentEcho"
         style="--agent-color:#ffc857;--agent-glow:rgba(255,200,87,.3)">

        <span class="swarm-cursor"></span>
        <span class="swarm-agent-name">🚀 Echo</span>

    </div>

</div>

<button class="swarm-replay" id="swarmReplay">
    ⚡ Replay Animation
</button>


<!-- ==================================
     SWARM REBUILD JAVASCRIPT ENGINE
================================== -->

<script>
(() => {

    "use strict";

    /* ELEMENT REFERENCES */

    const overlay = document.getElementById("swarmOverlay");
    const progressBar = document.getElementById("swarmProgress");
    const percentText = document.getElementById("swarmPercent");
    const statusText = document.getElementById("swarmStatus");
    const replayButton = document.getElementById("swarmReplay");

    if (!overlay || !progressBar || !percentText ||
        !statusText || !replayButton) {
        console.error("Swarm Engine: Required elements missing.");
        return;
    }


    /* AGENT CONFIGURATION */

    const agents = [
        {
            name: "Pixel",
            id: "agentPixel",
            color: "#ff6384"
        },
        {
            name: "Nova",
            id: "agentNova",
            color: "#38d6c5"
        },
        {
            name: "Byte",
            id: "agentByte",
            color: "#b18cff"
        },
        {
            name: "Echo",
            id: "agentEcho",
            color: "#ffc857"
        }
    ];

    agents.forEach(agent => {
        agent.element = document.getElementById(agent.id);
    });


    /* BUILDING SECTIONS */

    const sections = [
        {
            selector: "header",
            agent: 0,
            label: "Building navigation"
        },
        {
            selector: "#home",
            agent: 1,
            label: "Creating hero introduction"
        },
        {
            selector: "#about",
            agent: 2,
            label: "Building About section"
        },
        {
            selector: "#skills",
            agent: 3,
            label: "Adding technical skills"
        },
        {
            selector: "#education",
            agent: 0,
            label: "Building education timeline"
        },
        {
            selector: "#projects",
            agent: 1,
            label: "Creating project showcase"
        },
        {
            selector: "#contact",
            agent: 2,
            label: "Building contact section"
        },
        {
            selector: "footer",
            agent: 3,
            label: "Finishing portfolio"
        }
    ];


    /* ENGINE SETTINGS */

    let running = false;
    let prepared = false;
    let currentRun = 0;

    const reducedMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    );


    /* DELAY */

    function wait(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }


    /* PREPARE TEXT WITHOUT DESTROYING HTML STRUCTURE */

    function prepareText(element) {

        if (element.dataset.swarmPrepared === "true") {
            return;
        }

        const walker = document.createTreeWalker(
            element,
            NodeFilter.SHOW_TEXT,
            {
                acceptNode(node) {

                    if (!node.nodeValue.trim()) {
                        return NodeFilter.FILTER_REJECT;
                    }

                    const parent = node.parentElement;

                    if (!parent) {
                        return NodeFilter.FILTER_REJECT;
                    }

                    if (parent.closest(
                        "script,style,noscript,textarea,input,select,option,svg,[data-no-swarm]"
                    )) {
                        return NodeFilter.FILTER_REJECT;
                    }

                    return NodeFilter.FILTER_ACCEPT;
                }
            }
        );

        const nodes = [];

        while (walker.nextNode()) {
            nodes.push(walker.currentNode);
        }

        nodes.forEach(node => {

            const fragment = document.createDocumentFragment();

            [...node.nodeValue].forEach(character => {

                const span = document.createElement("span");

                span.className = "swarm-char";
                span.textContent = character;

                fragment.appendChild(span);

            });

            node.parentNode.replaceChild(fragment, node);

        });

        element.dataset.swarmPrepared = "true";
    }


    /* PREPARE ALL SECTIONS */

    function prepareAllSections() {

        if (prepared) return;

        sections.forEach(item => {

            const element = document.querySelector(item.selector);

            if (element) {
                prepareText(element);
            }

        });

        prepared = true;
    }


    /* RESET REVEAL */

    function resetSections() {

        sections.forEach(item => {

            const element = document.querySelector(item.selector);

            if (!element) return;

            element.querySelectorAll(".swarm-char").forEach(char => {
                char.classList.remove("visible");
            });

            element.classList.remove("swarm-target");

        });

    }


    /* POSITION AGENT */

    function positionAgent(agent, target) {

        if (!agent || !agent.element || !target) return;

        const rect = target.getBoundingClientRect();

        const x = Math.min(
            window.innerWidth - 120,
            Math.max(5, rect.left + Math.min(rect.width / 2, 100))
        );

        const y = Math.min(
            window.innerHeight - 35,
            Math.max(5, rect.top + 10)
        );

        agent.element.style.left = x + "px";
        agent.element.style.top = y + "px";

        agent.element.classList.add("visible");
    }


    /* HIDE ALL AGENTS */

    function hideAgents() {

        agents.forEach(agent => {

            if (agent.element) {
                agent.element.classList.remove("visible");
            }

        });

    }


    /* UPDATE PROGRESS */

    function updateProgress(value) {

        const percentage = Math.min(100, Math.max(0, value));

        progressBar.style.width = percentage + "%";
        percentText.textContent = percentage + "%";

    }


    /* REVEAL SECTION */

    async function revealSection(item, index, total, runId) {

        const element = document.querySelector(item.selector);

        if (!element) return;

        if (runId !== currentRun) return;

        const agent = agents[item.agent];

        statusText.textContent =
            agent.name + " is " + item.label.toLowerCase() + "...";

        element.classList.add("swarm-target");

        element.style.setProperty(
            "--agent-color",
            agent.color
        );

        element.style.setProperty(
            "--agent-glow",
            agent.color + "55"
        );

        element.scrollIntoView({
            behavior: "smooth",
            block: "start"
        });

        await wait(450);

        if (runId !== currentRun) return;

        const chars = Array.from(
            element.querySelectorAll(".swarm-char")
        );

        const chunkSize = reducedMotion.matches ? 100000 : 5;

        /* SHOW CHARACTERS IN SMALL GROUPS */

        for (let i = 0; i < chars.length; i += chunkSize) {

            if (runId !== currentRun) return;

            const chunk = chars.slice(i, i + chunkSize);

            chunk.forEach(char => {
                char.classList.add("visible");
            });

            const currentChar = chunk[chunk.length - 1];

            if (currentChar) {
                positionAgent(agent, currentChar);
            }

            const completedCharacters = Math.min(
                i + chunkSize,
                chars.length
            );

            const sectionProgress = chars.length
                ? completedCharacters / chars.length
                : 1;

            const totalProgress =
                ((index + sectionProgress) / total) * 100;

            updateProgress(Math.round(totalProgress));

            if (!reducedMotion.matches) {
                await wait(8);
            }

        }

        element.classList.remove("swarm-target");

        statusText.textContent =
            "✓ " + item.label + " completed";

        await wait(180);

    }


    /* COMPLETE ANIMATION */

    function finishAnimation(runId) {

        if (runId !== currentRun) return;

        hideAgents();

        updateProgress(100);

        statusText.textContent =
            "✓ All four agents completed your portfolio!";

        overlay.classList.add("finished");

        replayButton.textContent = "⚡ Replay Animation";
        replayButton.disabled = false;

        running = false;

    }


    /* MAIN SWARM ENGINE */

    async function runSwarm() {

        if (running) return;

        running = true;

        const runId = ++currentRun;

        replayButton.disabled = true;
        replayButton.textContent = "⚡ Building...";

        overlay.classList.remove("finished");

        prepareAllSections();

        resetSections();

        hideAgents();

        updateProgress(0);

        statusText.textContent =
            "Connecting Pixel, Nova, Byte and Echo...";

        agents.forEach(agent => {

            if (agent.element) {
                agent.element.classList.remove("visible");
            }

        });

        await wait(500);

        if (runId !== currentRun) return;

        /* REDUCED MOTION MODE */

        if (reducedMotion.matches) {

            sections.forEach(item => {

                const element = document.querySelector(item.selector);

                if (element) {
                    element.querySelectorAll(".swarm-char")
                        .forEach(char => char.classList.add("visible"));
                }

            });

            finishAnimation(runId);

            return;
        }


        /* PROCESS EACH SECTION */

        for (let i = 0; i < sections.length; i++) {

            if (runId !== currentRun) return;

            await revealSection(
                sections[i],
                i,
                sections.length,
                runId
            );

        }


        /* FINAL STAGE */

        statusText.textContent =
            "All systems successfully completed!";

        await wait(700);

        if (runId !== currentRun) return;

        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });

        await wait(500);

        finishAnimation(runId);

    }


    /* REPLAY BUTTON */

    replayButton.addEventListener("click", () => {

        if (running) return;

        runSwarm();

    });


    /* INITIAL PAGE LOAD */

    function initializeSwarm() {

        if (reducedMotion.matches) {

            prepareAllSections();

            sections.forEach(item => {

                const element = document.querySelector(item.selector);

                if (element) {
                    element.querySelectorAll(".swarm-char")
                        .forEach(char => char.classList.add("visible"));
                }

            });

            overlay.classList.add("finished");

            return;
        }

        runSwarm();

    }


    if (document.readyState === "complete") {

        initializeSwarm();

    } else {

        window.addEventListener(
            "load",
            initializeSwarm,
            { once: true }
        );

    }


})();
</script>


<!-- EXISTING DARK MODE SCRIPT -->

<script src="darkmode/darkmode.js"></script>

</body>
</html>
