<?php
require_once 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account List</title>
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
    <h1>Account List</h1>
    <button onclick="window.location.href='account_create.php'">Create New Account</button>
    <button onclick="window.location.href='reports_dashboard.php'">Reports Dashboard</button>
    <table>
        <thead>
            <tr>
                <th>Account ID</th>
                <th>Account Name</th>
                <th>Subscriber Last Name</th>
                <th>Subscriber First Name</th>
                <th>Subscriber Email</th>
                <th>Account Created On</th>
                <th>SAML Auth Enabled</th>
                <th>Two Factor Auth Enabled</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="accountTableBody">
            <!-- Table rows will be loaded here via AJAX -->
        </tbody>
    </table>

    <script>
    function loadAccountList() {
        fetch('get_account_list.php?t=' + new Date().getTime())
            .then(response => response.text())
            .then(data => {
                document.getElementById('accountTableBody').innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    // Load the list when the page loads
    loadAccountList();

    // Reload the list every 30 seconds
    setInterval(loadAccountList, 30000);

    // Check if we need to force a reload (e.g., after create/edit/delete operations)
    if (window.location.href.includes('reload=true')) {
        loadAccountList();
        // Remove the reload parameter from the URL to prevent unnecessary reloads
        window.history.replaceState({}, document.title, 'account_list.php');
    }
    </script>

    <footer style="margin-top: 20px; text-align: center;">
        <p>View the source code on <a href="https://github.com/tl3849/CS-GY-6083" target="_blank">GitHub</a></p>
    </footer>
</body>
</html>