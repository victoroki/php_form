<?php
include 'connection.php';

$login = 0;
$invalid = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST["email"];
    $password = $_POST["password"];

      // $sql = "Select * from users where username='$username' AND password='$password'";
      $sql = "SELECT * FROM `users` WHERE email='$email'";
      $result = mysqli_query($conn, $sql);
      $num = mysqli_num_rows($result);
      if ($num == 1){
          while($row=mysqli_fetch_assoc($result)){
            echo $password;
              if (!password_verify($password, $row['password'])){ 
                  $login = true;
                  session_start();
                  $_SESSION['loggedin'] = true;
                  $_SESSION['email'] = $email;
                  header("location: otpVerification.php");
              } 
              else{
                // echo "Invalid Credentials";
                $invalid = 1;
              }
          }
          
      } 
      else{
          $showError = "Invalid Credentials";
      }
  }
      
  ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        *::after,
        *::before {
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
        }

        body {
            background-color: #f1f1f1;
            font-family: sans-serif;
            font-size: 16px;
            line-height: 1.5;
            color: #333;
            margin: 0;
            align-items: center;
            justify-content: center;
        }

        input[type="email"],
        input[type="password"] {
            display: block;
            width: 50%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin: 10px auto;
        }

        input[type="submit"] {
            display: block;
            width: 30%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin: 10px auto;
            background-color: #4CAF50;
            color: white;
        }

        .form {
            margin: 40px auto;
        }
        .success{
            width:50%;
	    background-color:#b1e9b1;
	    margin:5px auto;
	    text-align:center;
 	    font-size:17px;
	    padding:7px;
	    border-radius:9px;
	    
        }
        .warn{
            width:50%;
	    background-color:#e9b1b1;
	    margin:5px auto;
	    font-size:17px;
	    padding:7px;
	    text-align:center;
	    border-radius:9px; 
        }
    </style>
</head>

<body>
    <h1>Login</h1>

    <?php
    if ($login) {
        echo '<div class="success">logged in successfully</div>';
    }
    ?>
    <?php
    if ($invalid) {
        echo '<div class="warn">Invalid credentials</div>';
    }
    ?>

    <form action="form.php" method="post">
        <div class="form">
            <input type="email" name="email" id="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </div>
        <p style="font-size: 15px; text-align: center;margin-top: -15px;">New here ? <a href="register.php">Register</a>
        </p>
    </form>
</body>

</html>
