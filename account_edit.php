<?php
require_once 'db_connect.php';

$conn = getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $account_id = $_POST["account_id"];
    $acct_name = $_POST["acct_name"];
    $sbscrbr_lname = $_POST["sbscrbr_lname"];
    $sbscrbr_fname = $_POST["sbscrbr_fname"];
    $sbscrbr_email = $_POST["sbscrbr_email"];
    $saml_auth_enabled = isset($_POST["saml_auth_enabled"]) ? 1 : 0;
    $two_factor_auth_enabled = isset($_POST["two_factor_auth_enabled"]) ? 1 : 0;

    $sql = "UPDATE Account SET AcctName=?, SbscrbrLname=?, SbscrbrFname=?, SbscrbrEmail=?, SamlAuthEnabled=?, TwoFactorAuthEnabled=? WHERE AccountId=?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssiis", $acct_name, $sbscrbr_lname, $sbscrbr_fname, $sbscrbr_email, $saml_auth_enabled, $two_factor_auth_enabled, $account_id);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        // Redirect to account_list.php with reload parameter
        header("Location: account_list.php?reload=true");
        exit();
    } else {
        echo "Error updating account: " . $conn->error;
    }

    $stmt->close();
} else {
    $account_id = $_GET["id"];
    $sql = "SELECT * FROM Account WHERE AccountId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $account_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $account = $result->fetch_assoc();
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
</head>
<body>
    <h1>Edit Account</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="hidden" name="account_id" value="<?php echo $account['AccountId']; ?>">
        Account Name: <input type="text" name="acct_name" value="<?php echo $account['AcctName']; ?>" required><br>
        Last Name: <input type="text" name="sbscrbr_lname" value="<?php echo $account['SbscrbrLname']; ?>" required><br>
        First Name: <input type="text" name="sbscrbr_fname" value="<?php echo $account['SbscrbrFname']; ?>" required><br>
        Email: <input type="email" name="sbscrbr_email" value="<?php echo $account['SbscrbrEmail']; ?>" required><br>
        SAML Auth Enabled: <input type="checkbox" name="saml_auth_enabled" <?php echo $account['SamlAuthEnabled'] ? 'checked' : ''; ?>><br>
        Two Factor Auth Enabled: <input type="checkbox" name="two_factor_auth_enabled" <?php echo $account['TwoFactorAuthEnabled'] ? 'checked' : ''; ?>><br>
        <input type="submit" value="Update Account">
    </form>
    <br>
    <a href="account_list.php">Back to Account List</a>
</body>
</html>