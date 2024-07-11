<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav>
        <ul>
            
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>


    <h2>Dashboard</h2>
    <p>Welcome, user! Your current balance is $<?php echo $_SESSION['balance']; ?></p>
    <form action="deposit.php" method="post">
        <label for="amount">Deposit Amount:</label>
        <input type="number" id="amount" name="amount" required>
        <button type="submit">Deposit</button>
    </form>
    <form action="withdraw.php" method="post">
        <label for="amount">Withdraw Amount:</label>
        <input type="number" id="amount" name="amount" required>
        <button type="submit">Withdraw</button>
    </form>
    <!-- <form action="transactions.php" method="get">
            <button type="submit">View Transactions</button>
        </form> -->
    <form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
