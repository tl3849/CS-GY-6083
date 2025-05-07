<?php
require_once 'db_connect.php';

if (isset($_GET["id"])) {
    $conn = getConnection();

    $account_id = $_GET["id"];

    $sql = "DELETE FROM Account WHERE AccountId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $account_id);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        // Redirect to account_list.php with reload parameter
        header("Location: account_list.php?reload=true");
        exit();
    } else {
        echo "Error deleting account: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No account ID provided";
}

echo "<br><a href='account_list.php'>Back to Account List</a>";
?>