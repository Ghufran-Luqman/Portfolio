<?php
session_start();
date_default_timezone_set('UTC');

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "portfolio_logins";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$posts = true;

$query_result = $conn->query("SELECT * FROM posts");
// check if there are any blog posts
if (!($query_result->num_rows>0)) { // if no posts
    $posts = false;
    if (!(isset($_SESSION['userId']))) { // if the user is not logged in
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
        <?php
        if (isset($_SESSION['userId'])) {
            echo
            "<aside>
                <h3 class='text'>Welcome, User!</h3>
            </aside>";
        }
        ?>
    </header>

    <main>
        <h1 class="text">View Blog</h1>

        <section>
            <article id='blogs'>
                <h2 class='text article-text'>Blog Posts</h2>
                <?php
                if ($posts) { // if there are posts
                    $query = "SELECT title, body, created_at FROM posts";
                    $result = $conn->query($query);

                    // put all posts into array
                    $blogPosts=[];
                    while($row=$result->fetch_assoc()) {
                        $blogPosts[]=$row;
                    }

                    // sorting algorithm to come..


                    foreach ($blogPosts as $post) {
                        echo "<div class='blogEntry'>";
                        $dateToDisplay = date("jS F Y, g:i T", strtotime($post['created_at']));
                        echo "<div id='date-div'>
                        <p class='text article-text date-time' id='date'>".$dateToDisplay."</p>
                        </div>";
                        echo "<h3 class='text article-text title'>".$post['title']."</h3>";
                        echo "<p class='text article-text body'>".nl2br($post['body'])."</p>";
                        echo "<hr>";
                        echo "</div>";
                    }
                }
                else { // no posts
                echo "<p class='text article-text'>There are no posts currently. Please add a post to view it.</p>";
                }
                ?>
            </article>
            <div id='add-blog'>
                <button type="submit" id="add-post" data-logged-in="<?php echo isset($_SESSION['userId']) ? 'true' : 'false'; ?>">Add Post</button>
            </div>
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

<?php
$query_result->close();
$conn->close();
?>