<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: login.html");
    exit();
}

$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "dt";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amount = $_POST['amount'];
    $userid = $_SESSION['userid'];

    $sql = "UPDATE users SET balance = balance + $amount WHERE id = $userid";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['balance'] += $amount;
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
