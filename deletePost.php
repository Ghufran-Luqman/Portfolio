<?php
session_start();

if (!(isset($_SESSION['userId']))) { // if user is not logged in
    header("Location: login.php");
}

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "portfolio_logins";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$conn->query("DELETE FROM posts WHERE id='$id'");

$conn->close();
header("Location: viewBlog.php");
exit();
?>