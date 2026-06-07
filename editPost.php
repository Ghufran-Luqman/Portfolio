<?php
session_start();

if (!(isset($_SESSION['userId']))) { // if user is not logged in
    header("Location: login.php");
}


include 'config.php';


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$result = $conn->query("SELECT title, body FROM posts WHERE id='$id'");
if ($result && $result->num_rows>0) {
    $postData = $result->fetch_assoc();
    $postTitle = $postData['title'];
    $postBody = $postData['body'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/addEntry.css">
    <link rel="stylesheet" media="screen and (max-width: 768px)" href="css/mobile.css">
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
        <h1 class="text">Edit Post</h1>

        <section>
            <article id="blog">
                <div id='header'>
                    <h2 class="text article-text">Add Blog</h2>
                </div>
                <form action="addEditedPost.php" method="POST">
                    <p id='errorMsg' class='text article-text'></p>

                    <input type='hidden' name='id' value='<?php echo $id; ?>'>

                    <div class="form-element">
                        <?php
                        echo "<input type='text' placeholder='Title' id='title' name='title' value='".$postTitle."'>";
                        ?>
                    </div>

                    <div class="form-element">
                        <?php
                        echo "<textarea placeholder='Enter your text here' id='blog-text' name='blog-text' rows='15' value=''>".$postBody."</textarea>";
                        ?>
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
