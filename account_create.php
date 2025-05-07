<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/your/php-error.log');
error_reporting(E_ALL);

require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = getConnection();

    $acct_name = $_POST["acct_name"];
    $passwd_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $sbscrbr_lname = $_POST["sbscrbr_lname"];
    $sbscrbr_fname = $_POST["sbscrbr_fname"];
    $sbscrbr_email = $_POST["sbscrbr_email"];
    $acct_created_on = date("Y-m-d H:i:s");
    $saml_auth_enabled = isset($_POST["saml_auth_enabled"]) ? 1 : 0;
    $two_factor_auth_enabled = isset($_POST["two_factor_auth_enabled"]) ? 1 : 0;

    $sql = "INSERT INTO Account (AcctName, PasswdHash, SbscrbrLname, SbscrbrFname, SbscrbrEmail, AcctCreatedOn, SamlAuthEnabled, TwoFactorAuthEnabled) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ssssssii", $acct_name, $passwd_hash, $sbscrbr_lname, $sbscrbr_fname, $sbscrbr_email, $acct_created_on, $saml_auth_enabled, $two_factor_auth_enabled);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        
        // Redirect to account_list.php with reload parameter
        header("Location: account_list.php?reload=true");
        exit();
    } else {
        echo "Error executing statement: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
</head>
<body>
    <h1>Create Account</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Account Name: <input type="text" name="acct_name" required><br>
        Password: <input type="password" name="password" required><br>
        Last Name: <input type="text" name="sbscrbr_lname" required><br>
        First Name: <input type="text" name="sbscrbr_fname" required><br>
        Email: <input type="email" name="sbscrbr_email" required><br>
        SAML Auth Enabled: <input type="checkbox" name="saml_auth_enabled"><br>
        Two Factor Auth Enabled: <input type="checkbox" name="two_factor_auth_enabled"><br>
        <input type="submit" value="Create Account">
    </form>
    <br>
    <a href="account_list.php">Back to Account List</a>
</body>
</html>