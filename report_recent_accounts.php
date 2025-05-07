<?php
require_once 'db_connect.php';

$conn = getConnection();
$sql = "SELECT AccountId, AcctName, SbscrbrEmail, AcctCreatedOn FROM Account ORDER BY AcctCreatedOn DESC LIMIT 10";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recently Created Accounts</title>
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
    <h1>Recently Created Accounts (Last 10)</h1>
    <table>
        <thead>
            <tr>
                <th>Account ID</th>
                <th>Account Name</th>
                <th>Email</th>
                <th>Created On</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["AccountId"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["AcctName"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["SbscrbrEmail"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["AcctCreatedOn"]) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No accounts found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <br>
    <a href="reports_dashboard.php">Back to Reports Dashboard</a>
</body>
</html>

<?php
$conn->close();
?>