<?php 
include '_dbconnect.php';
    if(isset($_GET['quizid']) && isset($_GET['status'])){
        $quizid =  $_GET['quizid'];
        $statusval = $_GET['status'];
        $sql = "UPDATE `quiz` SET `quiz_status`= $statusval WHERE `quiz_id` = $quizid";
        $result = mysqli_query($conn, $sql);
        header("location:../admin/allquiz.php");
    }
    else{
        header("location:../admin/allquiz.php");
    }