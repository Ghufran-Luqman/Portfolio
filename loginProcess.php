<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "portfolio_logins";

// creates connection
$conn = new mysqli($servername, $username, $password, $dbname);

// checks connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$userPassword = $_POST['password'];

$query_result = $conn->query("SELECT * FROM users WHERE email = '$email' AND password = '$userPassword'");

if ($query_result->num_rows > 0) {
    session_start();
    $_SESSION['userId'] = $email;

    header("Location: addEntry.php");
    exit();
}
else {
    session_start();
    $_SESSION['error_message'] = "Invalid login credentials!";
    header("Location: login.php");
    exit();
}

$query_result->close();
$conn->close();
?>