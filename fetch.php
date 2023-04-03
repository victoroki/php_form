<?php
 include("connection.php");

 $sql = "SELECT * FROM `users` WHERE firstname='amos'";
 $result =$conn->query($sql);

 if($result->num_rows > 0){
    while ($row = $result->fetch_assoc()) {
        echo "id" . $row["id"] . "firstname" . $row["firstname"] . "lastname" . $row["lastname"] . "email" . $row["email"];
    }
 }else{
    echo "no data";
 }
?>