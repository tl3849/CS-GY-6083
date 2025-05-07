<?php
require_once 'db_connect.php';
$conn = getConnection();

$sql = "SELECT * FROM Account";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["AccountId"] . "</td>";
        echo "<td>" . $row["AcctName"] . "</td>";
        echo "<td>" . $row["SbscrbrLname"] . "</td>";
        echo "<td>" . $row["SbscrbrFname"] . "</td>";
        echo "<td>" . $row["SbscrbrEmail"] . "</td>";
        echo "<td>" . $row["AcctCreatedOn"] . "</td>";
        echo "<td>" . ($row["SamlAuthEnabled"] ? "Yes" : "No") . "</td>";
        echo "<td>" . ($row["TwoFactorAuthEnabled"] ? "Yes" : "No") . "</td>";
        echo "<td>
                <a href='account_edit.php?id=" . $row["AccountId"] . "'>Edit</a> | 
                <a href='account_delete.php?id=" . $row["AccountId"] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='9'>No accounts found</td></tr>";
}

$conn->close();
?>