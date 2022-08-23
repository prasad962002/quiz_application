<?php
require'_dbconnect.php';
//Login handle
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $email = $_POST['loginemail'];
  $password = $_POST['loginpassword'];
  $sql = "SELECT * FROM `user` where email = '$email'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if($num == 1){
      while($row = mysqli_fetch_assoc($result)){
          if($password == $row['password']){
              session_start();
              $_SESSION['loggedin'] = true;
              $_SESSION['username'] = $row['firstname'];
              $_SESSION['email'] = $row['email'];
              $_SESSION['user_id'] = $row['user_id'];

              header("location: ../welcome.php?loginsuccess=true");
              exit();
          }
          else{
              $showerror = "Invalid credientials";
          }
      }
  }
  else{
      $showerror = "User not found";
  }
  header("location: ../index.php?loginsuccess=false&error=$showerror");
}
?>