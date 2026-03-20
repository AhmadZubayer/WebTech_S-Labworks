const projectsData = [
    {
        id: 1,
        title: "Habit Tracker",
        description: "Modern habit tracking app with streak calculation, 30-day visual calendar, and community habit discovery.",
        category: "web",
        tech: ["React", "Firebase", "MongoDB", "Tailwind CSS"],
        github: "https://github.com/AhmadZubayer/HabitTracker-ReactJS-Clientside",
        live: "https://habirtracker-mern.web.app",
        image: "portfolio-imgs/habittracker.png"
    },
    {
        id: 2,
        title: "Transitly",
        description: "Complete transportation booking system with real-time tracking and seamless user experience.",
        category: "web",
        tech: ["React", "MongoDB", "Firebase"],
        github: "https://github.com/AhmadZubayer/Transitly-Clientside",
        live: "#",
        image: "portfolio-imgs/transitly.png"
    },
    {
        id: 3,
        title: "StayFinder",
        description: "Airbnb-like property booking platform with advanced search, filtering, and secure transactions.",
        category: "aspnet",
        tech: ["ASP.NET Core", "React", "SQL Server"],
        github: "https://github.com/AhmadZubayer/StayFinder--ASP.NET-Core-Project",
        live: "#",
        image: "portfolio-imgs/Stayfinder.png"
    },
    {
        id: 4,
        title: "Online Techshop Management System",
        description: "Scalable e-commerce platform for tech products with customer and admin dashboards.",
        category: "java",
        tech: ["Java", "MySQL", "JavaFX"],
        github: "https://github.com/AhmadZubayer/OnlineTechShop-ManagementSystem-3rdSemProject",
        live: "#",
        image: "portfolio-imgs/techshop.png"
    },
    {
        id: 5,
        title: "SourceStack App Store",
        description: "APK marketplace where users can browse, install apps, and save favorites for later.",
        category: "web",
        tech: ["React", "Express", "MongoDB", "Firebase"],
        github: "https://github.com/AhmadZubayer/sourcestack-app-store",
        live: "#",
        image: "portfolio-imgs/appstore.png"
    }
];

function projectContainer(filter = "all") {
    const container = document.getElementById("projectsContainer");
    container.innerHTML = "";

    projectsData.forEach(project => {
        if (filter === "all" || project.category === filter) {
            const card = document.createElement("div");
            card.className = "project-card";
            card.innerHTML = `
                <img src="${project.image}" alt="${project.title}" class="project-image">
                <div class="project-content">
                    <h3>${project.title}</h3>
                    <p class="project-desc">${project.description}</p>
                    <div>
                        ${project.tech.map(tech => `<span class="project-tag">${tech}</span>`).join("")}
                    </div>
                    <div class="project-links">
                        <span class="view-text">View Project On</span>
                        <a href="${project.github}" target="_blank" class="project-github">
                            <img src="portfolio-imgs/github-logo.png" alt="GitHub" class="github-icon">
                        </a>
                        ${project.live !== "#" ? `<a href="${project.live}" target="_blank" class="project-link">Live →</a>` : ""}
                    </div>
                </div>
            `;
            container.appendChild(card);
        }
    });
}

function setupThemeToggle() {
    const themeToggle = document.getElementById("themeToggle");
    const savedTheme = localStorage.getItem("theme");

    if (savedTheme === "dark") {
        document.body.classList.add("dark-mode");
    }

    themeToggle.addEventListener("click", () => {
        document.body.classList.toggle("dark-mode");
        const isDark = document.body.classList.contains("dark-mode");
        localStorage.setItem("theme", isDark ? "dark" : "light");
    });
}

function setupFilterButtons() {
    const filterButtons = document.querySelectorAll(".filter-btn");
    filterButtons.forEach(button => {
        button.addEventListener("click", (e) => {
            filterButtons.forEach(btn => btn.classList.remove("active"));
            button.classList.add("active");
            const filter = button.getAttribute("data-filter");
            projectContainer(filter);
        });
    });
}

function validateForm(e) {
    e.preventDefault();

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const subject = document.getElementById("subject").value.trim();
    const message = document.getElementById("message").value.trim();

    clearErrorMessages();

    let isValid = true;

    if (!name) {
        showError("nameError", "Name is required");
        isValid = false;
    }

    if (!email) {
        showError("emailError", "Email is required");
        isValid = false;
    } else if (!isValidEmail(email)) {
        showError("emailError", "Please enter a valid email");
        isValid = false;
    }

    if (!subject) {
        showError("subjectError", "Subject is required");
        isValid = false;
    }

    if (!message) {
        showError("messageError", "Message is required");
        isValid = false;
    }

    if (isValid) {
        const successMsg = document.getElementById("successMsg");
        successMsg.textContent = "Message sent successfully! Thank you for contacting me.";
        successMsg.style.display = "block";

        document.getElementById("contactForm").reset();

        setTimeout(() => {
            successMsg.style.display = "none";
        }, 4000);
    }
}

function showError(elementId, message) {
    const errorElement = document.getElementById(elementId);
    errorElement.textContent = message;
}

function clearErrorMessages() {
    const errorElements = document.querySelectorAll(".error-msg");
    errorElements.forEach(elem => elem.textContent = "");
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function setupScrollToTop() {
    const scrollBtn = document.getElementById("scrollToTop");

    window.addEventListener("scroll", () => {
        if (window.pageYOffset > 300) {
            scrollBtn.classList.add("show");
        } else {
            scrollBtn.classList.remove("show");
        }
    });

    scrollBtn.addEventListener("click", () => {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });
}

function setupTypingAnimation() {
    const typingElement = document.getElementById("typing-text");
    const phrases = [
        "Full-Stack Developer",
        "Software Engineer",
        "AI/ML Researcher"
    ];
    let phraseIndex = 0;
    let charIndex = 0;
    let isDeleting = false;
    let typingSpeed = 80;

    function typeText() {
        const currentPhrase = phrases[phraseIndex];

        if (isDeleting) {
            typingElement.textContent = currentPhrase.substring(0, charIndex - 1);
            charIndex--;
            typingSpeed = 40;
        } else {
            typingElement.textContent = currentPhrase.substring(0, charIndex + 1);
            charIndex++;
            typingSpeed = 80;
        }

        if (!isDeleting && charIndex === currentPhrase.length) {
            typingSpeed = 1500;
            isDeleting = true;
        }

        if (isDeleting && charIndex === 0) {
            isDeleting = false;
            phraseIndex = (phraseIndex + 1) % phrases.length;
            typingSpeed = 400;
        }

        setTimeout(typeText, typingSpeed);
    }

    typeText();
}

document.addEventListener("DOMContentLoaded", () => {
    projectContainer();
    setupThemeToggle();
    setupFilterButtons();
    setupScrollToTop();
    setupTypingAnimation();

    const contactForm = document.getElementById("contactForm");
    contactForm.addEventListener("submit", validateForm);

    const navLinks = document.querySelectorAll(".nav-links a");
    navLinks.forEach(link => {
        link.addEventListener("click", (e) => {
            const href = link.getAttribute("href");
            const targetId = href.substring(1);
            const targetSection = document.getElementById(targetId);

            if (targetSection) {
                e.preventDefault();
                
                navLinks.forEach(l => l.classList.remove("active"));
                link.classList.add("active");
                
                targetSection.scrollIntoView({
                    behavior: "smooth",
                    block: "start"
                });
            }
        });
    });

    window.addEventListener("scroll", () => {
        let current = "";
        const sections = document.querySelectorAll("section");
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (pageYOffset >= sectionTop - 200) {
                current = section.getAttribute("id");
            }
        });
        
        navLinks.forEach(link => {
            link.classList.remove("active");
            if (link.getAttribute("href").substring(1) === current) {
                link.classList.add("active");
            }
        });
    });
});
