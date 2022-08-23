<?php
    include("_dbconnect.php");
  if(isset($_GET['delete'])){
    $deleteid = $_GET['delete'];
    echo var_dump($deleteid);
    $delsql = "DELETE FROM `user` WHERE email = $deleteid";
    $delresult = mysqli_query($conn, $delsql);
    if($delsql){
      header("../admin/usersmanage.php?delete=true");
    }
    else{
      echo"Fail to delete";
    }
  }
