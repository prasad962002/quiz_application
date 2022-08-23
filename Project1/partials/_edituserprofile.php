<?php
session_start();
require'_dbconnect.php';
$uid = $_SESSION['user_id'];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
     $editfirstname = $_POST['editfirstname'];
     $editlastname = $_POST['editlastname'];
    $gender = $_POST['editgender'];
    $editfirstname = ucfirst($editfirstname);
    $editlastname = ucfirst($editlastname);
        $sql = "UPDATE `user` SET `firstname` = '$editfirstname',`lastname` = '$editlastname', `gender` = '$gender' WHERE `user`.`user_id` = $uid;";
        $result = mysqli_query($conn, $sql);
        if($result){
                header('location:../userprofile.php?update=success');
                $_SESSION['username'] = $editfirstname;
                              
        }
    }
?>