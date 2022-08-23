<?php
session_start();
require'_dbconnect.php';
//$uid = $_SESSION['user_id'];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
     $editfirstname = $_POST['editfirstname'];
     $editlastname = $_POST['editlastname'];
     $gender = $_POST['editgender'];
     echo $gender;
     //$email = $_POST['editemail'];
     echo var_dump($_POST['editmail']);
     if(isset($_POST['editmail'])){
     }
     
    $editfirstname = ucfirst($editfirstname);
    $editlastname = ucfirst($editlastname);
        // $sql = "UPDATE `user` SET `firstname` = '$editfirstname',`lastname` = '$editlastname', `gender` = '$gender' WHERE `user`.`user_id` = $email;";
        // $result = mysqli_query($conn, $sql);
        // if($result){
        //         header('location:../admin/usersmanage.php?update=success');
        //         //$_SESSION['username'] = $editfirstname;
                              
        // }
    }
?>