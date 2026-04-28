<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/index.css">

    <!--font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Bpmf+Zihi+Kai+Std&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <a href="index.php" class="hoverLink">
                <p class="text" id="current">Home</p>
            </a>
            <a href="education.php" class="hoverLink">
                <p class="text">Education</p>
            </a>
            <a href="portfolio.php" class="hoverLink">
                <p class="text">Portfolio</p>
            </a>
            <a href="skills.php" class="hoverLink">
                <p class="text">Skills</p>
            </a>
            <a href="viewBlog.php" class="hoverLink">
                <p class="text">View Blog</p>
            </a>
            <?php
            if (isset($_SESSION['userId'])) { // if user is logged in
                echo
                '<a href="logout.php" class="hoverLink">
                    <p class="text">Logout</p>
                </a>';
            }
            else {
                echo
                '<a href="login.php" class="hoverLink">
                    <p class="text">Login</p>
                </a>';
            }
            ?>
        </nav>
    </header>

    <main>
        <h1 class="text">Ghufran Luqman</h1>


        <section>
            <article>
                <h2 class="text article-text">About Me</h2>
                <div class="article-content">
                    <figure>
                            <img src="images/self-image-cropped.jpg"/>
                            <figcaption class="text article-text">(in Turkey)</figcaption>
                    </figure>
                    <div class="article-description move-down">
                        <h4 class="text article-text">Computer Science Undergraduate Student at Queen Mary University of London</h4>
                        <p class="text article-text">As an aspiring student, my aim is to make an impact in the field - perhaps in Cybersecurity.
                            To achieve this, I plan to gain as much knowledge and experience as I can during my bachelor's degree in Computer Science,
                            by working for a year in the industry, as well as participating in multiple hackathons, helping me to learn new skills and languages.
                        </p>
                    </div>
                </div>

            </article>
            <article id="experience">
                <h2 class="text article-text">Experience</h2>
                <div class="article-content">
                    <div class="article-description">
                        <h4 class="text article-text">Computer Technician Intern at Computer Gurus Ltd.</h4>
                        <ul>
                            <li class="text article-text">Acquired knowledge in installing and configuring operating systems, assembling PCs, professionally conducting repairs, testing devices and managing customer interactions.</li>
                            <li class="text article-text">Gained interest for repairing devices by staying after work hours to complete additional tasks, using this opportunity to refine adaptability skills and teamwork.</li>
                            <li class="text article-text">Completed repairs of various electronic devices whilst collaborating as a team under pressure.</li>
                        </ul>
                    </div>
                </div>
            </article>
        </section>
    </main>
    <footer>
        <h2 class="text">Contact</h2>
        <nav>
            <a href="tel:+447933567581" class="hoverLink">
                <p class="text">Phone</p>
            </a>
            <a href="mailto:ghufranluqman1@gmail.com" class="hoverLink">
                <p class="text">Email</p>
            </a>
            <a href="https://www.linkedin.com/in/muhammad-luqman-a20a252a5/" class="hoverLink">
                <p class="text">LinkedIn</p>
            </a>
            <a href="https://github.com/ghufran-luqman" class="hoverLink">
                <p class="text">GitHub</p>
            </a>
        </nav>
    </footer>
</body>
</html>