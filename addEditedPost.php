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

$id = $_POST['id'];
$title = $_POST['title'];
$body = $_POST['blog-text'];

$conn->query("UPDATE posts SET title='$title', body='$body' WHERE id='$id'");

$conn->close();

header("Location: viewBlog.php");
exit();
?>
