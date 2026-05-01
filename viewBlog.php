<?php
session_start();

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "portfolio_logins";

// Creates connection
$conn = new mysqli($servername, $username, $password, $dbname);

if (!(isset($_SESSION['userId']))) { // if the user is not logged in
    // check if there are any blog posts
    $query_result = $conn->query("SELECT * FROM posts");
    if (!($query_result->num_rows>0)) { // if no posts
        header("Location: login.php");
        exit();
    }
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
    <link rel="stylesheet" href="css/viewBlog.css">
    <script src="js/viewBlog.js" defer></script>

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
                <p class="text" id="current">View Blog</p>
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
        <h1 class="text">View Blog</h1>

        <section>
            <article id="blog">
                <h2 class="text article-text">Add Blog</h2>
                <button type="submit" id="add-post" data-logged-in="<?php echo isset($_SESSION['userId']) ? 'true' : 'false'; ?>">Add Post</button>
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