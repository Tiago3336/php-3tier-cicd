<?php
require_once 'db.php';

$result = $conn->query("SELECT NOW() AS db_time");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP 3-Tier Application</title>
</head>
<body>
    <h1>PHP 3-Tier Application</h1>

    <h2>Application Status: Running</h2>

    <p><strong>Web Tier:</strong> PHP + Apache</p>
    <p><strong>Database Tier:</strong> MySQL</p>
    <p><strong>Database Connection:</strong> Successful</p>
    <p><strong>Database Server Time:</strong>
        <?php echo htmlspecialchars($row['db_time']); ?>
    </p>
</body>
</html>

<?php
$conn->close();
?>
