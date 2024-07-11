<?php




$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "dt";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}



$user_id = $_SESSION['userid'];

$query = "SELECT * FROM transactions WHERE user_id = ? ORDER BY timestamp DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$transactions = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transactions</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="transactions.php">View Transactions</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>Transactions</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $transaction) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($transaction['id']); ?></td>
                        <td><?php echo htmlspecialchars($transaction['amount']); ?></td>
                        <td><?php echo htmlspecialchars($transaction['transaction_type']); ?></td>
                        <td><?php echo htmlspecialchars($transaction['timestamp']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
