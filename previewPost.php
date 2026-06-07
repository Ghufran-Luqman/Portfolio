<?php
session_start();
date_default_timezone_set('UTC');

$title = $_POST['title'];
$body = $_POST['blog-text'];


include 'config.php';


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$logged_in=false;

if ((isset($_SESSION['userId']))) {
    $logged_in=true;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Blog</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/viewBlog.css">
    <link rel="stylesheet" href="css/previewPost.css">
    <link rel="stylesheet" media="screen and (max-width: 768px)" href="css/mobile.css">


    <!--font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Bpmf+Zihi+Kai+Std&display=swap" rel="stylesheet">

    <!--delete icon-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
        <h1 class="text">Preview Blog</h1>
        <div id='previewButtons'>
            <form action='addPost.php' method='POST'>
                <input type='hidden' name='title' value='<?php echo $title; ?>'>
                <input type='hidden' name='blog-text' value='<?php echo $body; ?>'>
                <button type='submit'>Upload</button>
            </form>
            <form action='addEntry.php' method='POST'>
                <input type='hidden' name='title' value='<?php echo $title; ?>'>
                <input type='hidden' name='blog-text' value='<?php echo $body; ?>'>
                <button type='submit'>Edit Post</button>
            </form>
        </div>
        <section>
            <article id='blogs'>
                <div id='titleAndDropdown'>
                    <h2 class='text article-text'>Blog Posts</h2>
                </div>
                <div class='blogEntry'>
                    <div id='date-div'>
                        <p class='text article-text date-time' id='date'><?php echo date("jS F Y, g:i T"); ?></p>;
                    </div>
                    <h3 class='text article-text title'><?php echo $title; ?></h3>
                    <p class='text article-text body'><?php echo nl2br($body); ?></p>
                    <hr>
                </div>
                <?php
                    $query = "SELECT id, title, body, created_at FROM posts";
                    $result = $conn->query($query);

                    // put all posts into array
                    $blogPosts=[];
                    while($row=$result->fetch_assoc()) {
                        $blogPosts[]=$row;
                    }

                    // insertion sorting algorithm
                    for ($i = 1; $i < count($blogPosts); $i++) {
                        $current = $blogPosts[$i];
                        $currentTime = strtotime($current['created_at']);
                        $j = $i - 1;

                        while ($j >= 0 && strtotime($blogPosts[$j]['created_at']) < $currentTime) {
                            $blogPosts[$j + 1] = $blogPosts[$j];
                            $j--;
                        }

                        $blogPosts[$j + 1] = $current;
                    }
                    

                    foreach ($blogPosts as $post) {
                        echo "<div class='blogEntry'>";
                        $dateToDisplay = date("jS F Y, g:i T", strtotime($post['created_at']));
                        echo "<div id='date-div'>
                                <p class='text article-text date-time' id='date'>".$dateToDisplay."</p>";
                        echo "</div>";
                        echo "<h3 class='text article-text title'>".$post['title']."</h3>";
                        echo "<p class='text article-text body'>".nl2br($post['body'])."</p>";
                        echo "<hr>";
                        echo "</div>";
                    }
                ?>
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

