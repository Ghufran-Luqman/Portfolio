<?php
session_start();
date_default_timezone_set('UTC');

include 'config.php';


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

$logged_in=false;

if ((isset($_SESSION['userId']))) {
    $logged_in=true;
}

if (isset($_POST['month'])) { // if the user filtered for a month
    $month = $_POST['month'];
}
else { // if the user did not filter
    $month = date('F'); // gets current month
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Blog</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/viewBlog.css">
    <link rel="stylesheet" media="screen and (max-width: 768px)" href="css/mobile.css">
    <script src="js/viewBlog.js" defer></script>

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
        <h1 class="text">View Blog</h1>

        <section>
            <article id='blogs'>
                <div id='titleAndDropdown'>
                    <h2 class='text article-text'>Blog Posts</h2>
                    <form method='POST' action='viewBlog.php' id='dropdown'>
                        <select class='text' name='month'>
                            <?php
                            $availableMonthsQuery = "SELECT DISTINCT MONTHNAME(created_at) as monthName, MONTH(created_at) as monthNum FROM posts ORDER BY monthNUM DESC";
                            $monthsQueryResult = $conn->query($availableMonthsQuery);
                            
                            $currentMonth = date('F');
                            if ($month == $currentMonth) {
                                echo "<option value='".$currentMonth."' selected>".$currentMonth."</option>";
                            }
                            else {
                                echo "<option value='".$currentMonth."'>".$currentMonth."</option>";
                            }

                            while ($option = $monthsQueryResult->fetch_assoc()) {
                                if ($option['monthName'] != $currentMonth) { // don't do current month as already added above
                                    if ($month == $option['monthName']) {
                                        echo "<option value='".$option['monthName']."' selected>".$option['monthName']."</option>";
                                    }
                                    else {
                                        echo "<option value='".$option['monthName']."'>".$option['monthName']."</option>";
                                    }
                                }
                            }
                            ?>
                        </select>
                        <button type='submit' class='text article-text material-icons material-btn'>filter_list</button>
                        <a href='viewBlog.php'><span class='text article-text material-icons material-btn' id='refresh'>refresh</span></a>
                    </form>
                </div>
                <?php
                if ($posts) { // if there are posts
                    $query = "SELECT id, title, body, created_at FROM posts WHERE MONTHNAME(created_at) = '$month'";
                    $result = $conn->query($query);

                    // put all posts into array
                    $blogPosts=[];
                    while($row=$result->fetch_assoc()) {
                        $blogPosts[]=$row;
                    }

                    // insertion sorting algorithm
                    for ($i = 1; $i < count($blogPosts); $i++) {
                        $current = $blogPosts[$i];
                        $currentTime = strtotime($current['created_at']); // converts time from string to time since 1970 (bigger = newer)
                        $j = $i - 1;

                        while ($j >= 0 && strtotime($blogPosts[$j]['created_at']) < $currentTime) { // until end of array is reached or newer element is reached
                            $blogPosts[$j + 1] = $blogPosts[$j]; // shifts previous element to the right by one space
                            $j--; // shifts pointer down (creates empty slot at j+1)
                        }

                        $blogPosts[$j + 1] = $current;
                    }

                    foreach ($blogPosts as $post) {
                        echo "<div class='blogEntry'>";
                        $dateToDisplay = date("jS F Y, g:i T", strtotime($post['created_at']));
                        echo "<div id='date-div'>
                        <p class='text article-text date-time' id='date'>".$dateToDisplay."</p>";
                        if ($logged_in) {
                            echo "
                            <form action='editPost.php'>
                                <input type='hidden' name='id' value='".$post['id']."'>
                                <button type='submit' class='text article-text material-icons material-btn'>edit</button>
                            </form>

                            <form action='deletePost.php'>
                                <input type='hidden' name='id' value='".$post['id']."'>
                                <button type='submit' class='text article-text material-icons material-btn delete-btn'>delete</button>
                            </form>
                            ";
                        }
                        echo "</div>";
                        echo "<h3 class='text article-text title'>".$post['title']."</h3>";
                        echo "<p class='text article-text body'>".nl2br($post['body'])."</p>";
                        echo "<hr>";
                        echo "</div>";
                    }

                    if (count($blogPosts)==0) {
                        echo "<p class='text article-text'>There are currently no posts with that filter.</p>";
                    }
                }
                else { // no posts
                    echo "<p class='text article-text'>There are no posts currently. Please add a post to view it.</p>";
                }
                ?>
            </article>
            <div id='add-blog'>
                <button type="submit" id="add-post" data-logged-in="<?php 
                if (isset($_SESSION['userId'])) {
                    echo 'true';
                }
                else {
                    echo 'false';
                } ?>">Add Post</button>
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

<?php
$query_result->close();
$conn->close();


?>
