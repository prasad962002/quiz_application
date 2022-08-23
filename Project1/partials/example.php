<?php

use LDAP\Result;

// session_start();
// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
//   header("location:adminlogin.php");
//   exit;
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage users</title>
</head>

<body>
  <?php //include 'process.php'; ?>
  <?php
  include '_dbconnect.php';
  // $sql = "Select * from users";
  // $result = mysqli_query($conn, $sql);
  //pre_r($result);
  $row['id'] = 1;
  ?>
  <div class="row justify-content-center">
    <table class="table">
      <thead>
        <tr>
          <th>Username</th>
          <th>Password</th>
          <th colspan="2">Action</th>
        </tr>
      </thead>
      <?php
      //while ($row=$result->fetch_assoc()):
      ?>
      <tr>
        <td>
          <?php echo $row['username'];?>
        </td>
        <td>
          <?php echo $row['password'];?>
        </td>
        <td>
          <a href="managecars.php?edit=<?php echo $row['id'];?>" class="btn btn-info">Edit</a>
          <a href="process.php?delete=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
          
        </td>
      </tr>
      <?php //endwhile;?>
    </table>
  </div>
  <?php
  function pre_r($array){
  echo'<pre>';
  print_r($array);
  echo'</pre>'; 
  }
  ?>
  <div class="container my-4" >
    <form action="/Car rental website/process.php" method="post">

      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username">

      </div>
      <div class="form-group ">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <div class="form-group">
        <button type="submit" name="save">Save</button>
      </div>
    </form>
  </div>
</body>
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->

</html>