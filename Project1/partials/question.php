<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <title>Quiz</title>
</head>

<body>
  <?php
  session_start();
  include("_dbconnect.php");
  $quizid = $_GET['quizid'];
  $sql = "SELECT * FROM `quiz` WHERE `quiz_id` = $quizid";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  ?>
  <div class="container ml-auto mt-auto">
    <form method="post" action="checkanswer1.php" id="quizForm">
      <input type="hidden" name="qid" value="<?php echo $row['quiz_id'] ?>">
      <h1 class="text-center my-5"><?php echo $row['quiz_desc'] . ' '; ?><span id="displayDiv" class="text-monospace badge badge-primary" style="float: right;"></span></h1>
      <input type="hidden" name="quiztime" id="quiztime" value="<?php echo $row['quiz_time']; ?>">
      <?php
      $noq = 1;
      // echo $quizid;
      $sql = "SELECT * FROM `question` WHERE `quiz_id` = $quizid";
      $result = mysqli_query($conn, $sql);
      $numrows = mysqli_num_rows($result);
      while ($row = mysqli_fetch_assoc($result)) {
        $qid = $row['question_id'];

        echo '
    <div class="card bg-light mb-3 mx-auto question-container" >
      <div class="card-header p-3">' . $noq . '. ' . $row['question_desc'] . '</div>
      <div class="card-body">      
      ';
        $sql2 = "SELECT * FROM `answer` WHERE `question_id` = $qid";
        $result2 = mysqli_query($conn, $sql2);
        while ($row2 = mysqli_fetch_assoc($result2)) {
          //echo $row2['answer_desc'];
          echo '<div class="form-check mt-3 ml-3">
            <input class="form-check-input" type="radio" name="quizcheck[' . $row2['question_id'] . ']" id="' . $row2['answer_id'] . '" value="' . $row2['answer_id'] . '">
            <label class="form-check-label" for="' . $row2['answer_id'] . '">
            ' . $row2['answer_desc'] . '
            </label>
          </div>
          ';
        }
        echo '</div></div>';
        $noq++;
      }
      ?>
      <div class="container mx-auto mt-0">
        <button type="button" id="back" class=" btn btn-info  px-5 py-2" style="float: left;"> &laquo;&nbsp;&nbsp;Back </button>
        <button type="button" id="next" class=" btn btn-info  px-5 py-2" style="float: right;">Next &nbsp;&nbsp;&raquo;</button>
        <button class="btn btn-success mx-auto px-5 py-2 col-md-4" id="submitbtn" type="submit" style="display: none;" onclick="confirm('Do you want to submit the questions?')">Submit</button>
      </div>
    </form>
  </div>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
  <script>
    var q = document.getElementsByClassName('question-container');
    //console.log(q);
    var nextbutton = document.querySelector('#next').addEventListener('click', onClicknext);
    var backbutton = document.querySelector('#back').addEventListener('click', onClickback);
    var allDiv = document.querySelectorAll('.question-container');
    for (let i = 0; i < allDiv.length; i++) {
      allDiv[i].style.display = 'none';
    }
    allDiv[0].style.display = 'block';
    var count = 1;

    function onClicknext(e) {
      if (count >= allDiv.length) {
        count = 0;
      }
      for (let i = 0; i < allDiv.length; i++) {
        allDiv[i].style.display = 'none';
      }
      allDiv[count].style.display = 'block';
      console.log('next count', count);
      count = count + 1;
      if (q[<?php echo $numrows; ?> - 1].style.display == 'block') {
        console.log("block");
        document.getElementById('submitbtn').style.display = 'block';
      } else {
        document.getElementById('submitbtn').style.display = 'none';
      }
    }

    function onClickback(e) {
      if (count <= 0) {
        count = allDiv.length;
      }
      count = count - 1;
      for (let i = 0; i < allDiv.length; i++) {
        allDiv[i].style.display = 'none';
      }
      allDiv[count].style.display = 'block';
      console.log('back count', count);
      if (q[<?php echo $numrows; ?> - 1].style.display == 'block') {
        console.log("block");
        document.getElementById('submitbtn').style.display = 'block';
      } else {
        document.getElementById('submitbtn').style.display = 'none';
      }
    }
  </script>

  <script>
    const startingMinutes = document.getElementById('quiztime').value;
    let time = startingMinutes * 60;
    const countdownElm = document.getElementById("displayDiv");
    console.log(document.getElementById("quizForm"));
    setInterval(updateCountdown, 1000);

    function updateCountdown() {
      const minutes = Math.floor(time / 60);
      let seconds = time % 60;
      seconds = seconds < 10 ? '0' + seconds : seconds;
      countdownElm.innerHTML = `Time left =  ${minutes}:${seconds}`;
      time--;
      if (time == 0) {
        document.getElementById("quizForm").submit();
        return 0;
      }
    }
  </script>
</body>

</html>