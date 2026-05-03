<?php
session_start();
if (!(isset($_SESSION['userId']))) { // if user is not logged in
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Entry</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/addEntry.css">
    <script src=js/addEntry.js defer></script>

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
            <a href="logout.php" class="hoverLink">
                <p class="text">Logout</p>
            </a>
        </nav>
        <aside>
            <h3 class='text'>Welcome, User!</h3>
        </aside>
    </header>

    <main>
        <h1 class="text">Add Entry</h1>

        <section>
            <article id="blog">
                <div id='header'>
                    <h2 class="text article-text">Add Blog</h2>
                </div>
                <form action="addPost.php" method="POST">
                    <p id='errorMsg' class='text article-text'></p>

                    <div class="form-element">
                        <input type="text" placeholder="Title" id="title" name="title">
                    </div>

                    <div class="form-element">
                        <textarea placeholder="Enter your text here" id="blog-text" name="blog-text" rows="15"></textarea>
                    </div>

                    <div class="form-element" id="form-buttons">
                        <button type="submit" id="post">Post</button>
                        <button type="reset" id="clear">Clear</button>
                    </div>
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
            <a href="https://www.linkedin.com/in/muhammad-ghufran-luqman-a20a252a5/" class="hoverLink">
                <p class="text">LinkedIn</p>
            </a>
            <a href="https://github.com/ghufran-luqman" class="hoverLink">
                <p class="text">GitHub</p>
            </a>
        </nav>
    </footer>
</body>
</html>