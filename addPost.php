<?php
date_default_timezone_set('UTC');

include 'config.php';


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$title = $_POST['title'];
$blog_text = $_POST['blog-text'];
$current_datetime = date('Y-m-d H:i:s');

$query_result = $conn->prepare("INSERT INTO posts (title, body, created_at)
                            VALUES (?, ?, ?)");

$query_result->bind_param("sss", $title, $blog_text, $current_datetime);
$query_result->execute();

$query_result->close();
$conn->close();

header("Location: viewBlog.php");
exit();
?>
