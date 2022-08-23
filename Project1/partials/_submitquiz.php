<?php
include("../partials/_dbconnect.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //var_dump($_POST);
  // $arr = $_POST;
  // foreach ($arr as $x => $val) {
  //   echo "$x = $val<br>";
  // }
  // $questioncount = $_POST['questioncount'];
  // for ($i = 1; $i <= $questioncount; $i++) {
  //   echo 'question' . $i . ' : ';
  //   echo ltrim($_POST["question{$i}"]) . "<br>";
  //   $q = "question$i";
  //   for ($a = 1; $a <= 4; $a++) {
  //     echo 'Option' . $a . ' : ';
  //     echo ltrim($_POST["{$q}option{$a}"]) . "<br>";
  //   }
  //   echo '<br>';
  // }
  echo '<br>';
  //echo $_POST['quiz_topic'];
  $quiztopic = $_POST['quiz_topic'];
  echo '<br>';
  //echo $_POST['quiz_time'];
  $quiztime = $_POST['quiz_time'];
  $quizcode = mt_rand(1000, 9999);
  echo '<br>';
  //echo $_POST['questioncount'];
  $questioncount = $_POST['questioncount'];
  $quizstatus = $_POST['quiz_status'];
  $quizcategory = $_POST['quiz_category'];

  //Insert quiz topic, time, code into database
  $insertqsql = "INSERT INTO `quiz`(`cat_id`, `quiz_desc`, `quiz_time`, `total_question`, `quiz_code`, `quiz_status`) VALUES ($quizcategory, '$quiztopic', '$quiztime', $questioncount, $quizcode, $quizstatus)";
  $insertqresult = mysqli_query($conn, $insertqsql);
  if ($insertqresult) {
    echo 'Quiz name, time inserted<br>';
  } else {
    echo 'Quiz name, time not inserted';
  }

  //Get id of inserted quiz
  $sql = "SELECT * FROM `quiz` WHERE `quiz_desc` LIKE '$quiztopic' ORDER BY quiz_id DESC";
  $result = mysqli_query($conn, $sql);
  if ($result) {    
      $row = mysqli_fetch_assoc($result);
      $quizid = $row['quiz_id'];    
  }
  //Insert questions into db
  for ($i = 1; $i <= $questioncount; $i++) {
    $noq = $_POST["question{$i}"]; 
    $noq = str_replace("'","\'", $noq);  
    $quizid = intval($quizid);
    $curques = ltrim($noq);   

    $insertques = "INSERT INTO `question`(`quiz_id`,`question_desc`) VALUES($quizid,'$curques')";
    $resultques = mysqli_query($conn, $insertques);
    if ($resultques) {
      echo $curques."Question inserted <br>";
    } else {
      echo $curques." Question not inserted <br>";
    }

    //Get inserted question id
    $quessql = "SELECT * FROM `question` WHERE `question_desc` LIKE '$curques'  AND `quiz_id` = $quizid ORDER BY question_id DESC";
    $quesresult = mysqli_query($conn, $quessql);
    if($quesresult){      
        $quesrow = mysqli_fetch_assoc($quesresult);
        $quesid = $quesrow['question_id'];      
    }
    else{
      echo mysqli_error($conn);
    }
echo $quesid;
    // Insert 4 options
    for ($op = 1; $op <= 4; $op++) {
      $curroption = ltrim($_POST["question{$i}option{$op}"]);
      $curroption = str_replace("'","\'", $curroption);
      //echo $curroption;
      $opinsertsql = "INSERT INTO `answer`(`question_id`, `answer_desc`) VALUES ($quesid,'$curroption')"; 
      $opinsertresult = mysqli_query($conn, $opinsertsql);
      if($opinsertresult){
        echo $curroption."Answer inserted<br>";
      }
      else{
        echo $curroption."Answer not inserted<br>";
      }
    }

    //correctoption
    $correctoption = $_POST["question{$i}correctoption"];
    $scorrectoption = substr($correctoption, -7);
    $finalcorroption =  $_POST["question{$i}{$scorrectoption}"];

    //Get id of correct option
    $getcorrans = "SELECT * FROM `answer` WHERE `answer_desc` LIKE '$finalcorroption' ORDER BY answer_id DESC";
    $resultcorrans = mysqli_query($conn, $getcorrans);
      $corransrow = mysqli_fetch_assoc($resultcorrans);
      $corransid = $corransrow['answer_id'];    
echo $corransid;
    //Update correct answer in question table
    $updateansid = "UPDATE `question` SET `answer_id`= $corransid WHERE `question_id` = $quesid";
    $resultupdateansid = mysqli_query($conn, $updateansid);
    if($resultupdateansid){
      echo"Answer id updated<br>";
    }
    else{
      echo"Answer id not updated<br>";
    }
  }
  header("location:../admin/allquiz.php");
}
?>