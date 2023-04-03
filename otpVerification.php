<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: form.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $opt_user = $_POST["otp"];
    $otp = rand(100000, 999999);
    $email = $_SESSION['email'];

    include("connection.php");
    

    $sql = "INSERT INTO `otp` (email, otp ) VALUES ('$email', '$otp')";
    if ($conn->query($sql) === true) {
        $sql = "SELECT * FROM `otp` WHERE email = '$email' AND otp = '$otp_user'";

        $result = mysqli_query($conn, $sql);
        if ($result) {
          $num = mysqli_num_rows($result);
            if ($num>0) {
                echo "email verfied";
            } else {
                header("location: welcome.php");
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
    <style>
        *::before,*::after{
            box-sizing: border-box;
        }
        body{
            padding: 0;
            margin: 0;
            text-align: center;
            font-size: 18px;
            align-items: center;
            background-color:white;
        }
        .container{
            width: 60%;
            margin: 10% auto;
            background-color: #cccc;
            padding: 1%;
            border-radius: 9px;
        }
        input[type="text"]{
            display: block;
            border: 0;
            border-radius: 10px;
            padding: 1% 3%;
            box-shadow:0 0 15px 4px rgba(0,0,0,0.06);;
            width: 47%;
            margin: 7px auto;
        }
        input[type="submit"]{
            display: block;
            border: 0;
            border-radius: 10px;
            padding: 0.6%;
            width: 30%;
            margin: 10px auto;
            background-color: rgb(78, 119, 105);
            font-size: 20px;
            color: aliceblue;
            cursor: pointer;
        }
        p{
            font-size: 19px;
            margin-bottom: 10%;
        }
    </style>
</head>
<body>
    <form action="otpVerification.php" method="post">
    <div class="container">
    <h1>Code Verification</h1>
    <p>we have sent a code to you email<br> <?php echo $_SESSION['email']; ?></p>
    <input type="text" name="otp" placeholder="OTP code" id="otp">
    <input type="submit" value="verfy otp">
    </div>
    </form>
</body>
</html>
