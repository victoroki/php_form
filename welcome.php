<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true) {
    header("location: form.php");
    exit;
}

$email = $_SESSION['email'];
include("connection.php");

$sql = "SELECT * FROM users where email='$email'";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo $row['firstname'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>welcome</title>
    <style>
        h1{
            text-align:center;
            padding:30px;
        }
    </style>
</head>
<body>
    <h1>Welcome!!</h1>
    <p style="text-align:center" ><a href="logout.php">logout</a></p>
</body>
</html>