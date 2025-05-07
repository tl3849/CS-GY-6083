<?php
require_once 'db_connect.php';

$conn = getConnection();
$sql = "SELECT 
            SUM(CASE WHEN TwoFactorAuthEnabled = 1 THEN 1 ELSE 0 END) as enabled_count,
            SUM(CASE WHEN TwoFactorAuthEnabled = 0 THEN 1 ELSE 0 END) as disabled_count,
            COUNT(*) as total_count
        FROM Account";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two-Factor Auth Usage</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Two-Factor Auth Usage</h1>
    <table>
        <tr>
            <th>Metric</th>
            <th>Count</th>
            <th>Percentage</th>
        </tr>
        <tr>
            <td>Accounts with Two-Factor Auth Enabled</td>
            <td><?php echo $row['enabled_count']; ?></td>
            <td><?php echo round(($row['enabled_count'] / $row['total_count']) * 100, 2); ?>%</td>
        </tr>
        <tr>
            <td>Accounts with Two-Factor Auth Disabled</td>
            <td><?php echo $row['disabled_count']; ?></td>
            <td><?php echo round(($row['disabled_count'] / $row['total_count']) * 100, 2); ?>%</td>
        </tr>
        <tr>
            <td>Total Accounts</td>
            <td><?php echo $row['total_count']; ?></td>
            <td>100%</td>
        </tr>
    </table>
    <br>
    <a href="reports_dashboard.php">Back to Reports Dashboard</a>
</body>
</html>

<?php
$conn->close();
?>