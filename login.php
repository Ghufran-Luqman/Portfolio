<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">

    <!--font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Bpmf+Zihi+Kai+Std&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <a href="index.php" class="hoverLink">
                <p class="text">Home</p>
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
            <a href="login.php" class="hoverLink">
                <p class="text" id="current">Login</p>
            </a>
        </nav>
    </header>

    <main>
        <h1 class="text">Login</h1>

        <section>
            <article id="login">
                <h2 class="text article-text">Login</h2>
                <form action="loginProcess.php" method="POST">
                    <?php
                    session_start();
                    if (isset($_SESSION['error_message'])) {
                        echo "<p class='text article-text' id='error_message'>" . $_SESSION['error_message'] . " Please try again.</p>";
                        unset($_SESSION['error_message']);
                    }
                    ?>
                    <div class="form-element">
                        <input autocomplete="on" type="email" id="email" name="email" placeholder="Email" class="text article-text" required>
                    </div>

                    <div class="form-element">
                        <input type="password" id="password" name="password" placeholder="Password (min 7)" class="text article-text" pattern=".{7,}" required>
                    </div>
                    <button type="submit">Login</button>
                </form>
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