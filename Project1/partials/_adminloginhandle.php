<?php
require'_dbconnect.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo var_dump($_POST);
  $email = $_POST['loginemail'];
  $password = $_POST['loginpassword'];
  $sql = "SELECT * FROM `adminuser` where `admin_email` LIKE '$email'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if($num == 1){
      while($row = mysqli_fetch_assoc($result)){
          if($password == $row['admin_password']){
              session_start();
            //   $_SESSION['loggedin'] = true;
            //   $_SESSION['username'] = $row['firstname'];
            //   $_SESSION['email'] = $row['email'];
              $_SESSION['admin'] = true;
              header("location: ../admin/adminhome.php?loginsuccess=true");
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
  header("location: ../admin/adminlogin.php?loginsuccess=false&error=$showerror");
}
?>