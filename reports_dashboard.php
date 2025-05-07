<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Reports Dashboard</h1>
    <ul>
        <li><a href="report_saml_enabled.php">Accounts with SAML Auth Enabled</a></li>
        <li><a href="report_recent_accounts.php">Recently Created Accounts</a></li>
        <li><a href="report_two_factor_auth.php">Two-Factor Auth Usage</a></li>
    </ul>
    <br>
    <a href="account_list.php">Back to Account List</a>
</body>
</html>