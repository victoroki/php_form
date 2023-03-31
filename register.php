<?php

$user_email = 0;
$success = 0;

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  include 'connection.php';
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $password_hash = password_hash($Password, PASSWORD_DEFAULT);


  $sql = "SELECT * FROM `users` WHERE email = '$email'";
  $result = mysqli_query($conn, $sql);
  if ($result){
    $num = mysqli_num_rows($result);
    if($num>0){
      $user_email = 1;
      // echo "email user aready exist";
    }else{
      $sql = "INSERT INTO `users` (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$password_hash')";
      $result = mysqli_query($conn, $sql);
    
      if($result){
        $success = 1;
        // echo "data inserted successfully";
      }else{
        die(mysqli_error($conn));
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
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
  <style>
	.success{width:50;border-radius:7px;background-color:#b1e9b1; width:50%;padding:9px; margin:5px auto;}
	.warn{ width:50;margin:5px auto;width:50%;border-radius:7px;background-color:#e9b1b1;padding:9px;}
 </style>
</head>

<body>
  <h1>Register Form</h1>

  <?php
  if ($user_email) {
    echo '<div class="warn">User email aready exist</div>';
  }
  ?>
    <?php
  if ($success) {
	  echo '<div class="success">you are sucessfully registered</div>';
	  header("Location:form.php");
  }
  ?>

  <div class="container">
    <div class="container">
    <form action="register.php" method="post">
      <input class="text" type="text" placeholder="Firstname" name="firstname" id="name" required>
      <input class="text" type="text" placeholder="Lastname" name="lastname" id="name" required>
      <input type="email" placeholder="Email" name="email" id="email" required>
      <input type="password" placeholder="password" name="password" id="password" required>
      <input type="password" placeholder="Confirm password" name="password_repeat" id="password" required>
  </div>
  <input type="submit" id="login" value="Register">
  </form>
  </div>
  <p>aready a member <a href="form.php">Login</a></p>
</body>

</html>
