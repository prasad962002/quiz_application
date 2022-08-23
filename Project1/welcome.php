<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script type="text/javascript" src="myscript.js"></script>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="mystyle2.css">
  <title>Quiz - Home</title>
</head>

<body>

  <?php
  session_start();
  //echo var_dump($_SESSION);
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    include 'partials/_header.php';
    include 'partials/_dbconnect.php';
    $fname = $_SESSION['username'];

    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand active" href="welcome.php">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item change">
     <a class="nav-link" href="userquiz.php">Quiz <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item change">
     <a class="nav-link" href="userprofile.php">Profile</a>
    </li>
    <li class="nav-item change">
     <a class="nav-link" href="userresult.php">Result</a>
    </li>
    <li class="nav-item change">
     <a class="nav-link" href="userfeedback.php">Feedback</a>
    </li>
    <li class="nav-item change">
     <a class="nav-link" href="about.php">About us</a>
    </li>
    </ul>
       <form class="form-inline my-2 my-lg-0">
       <a href="partials/_logout.php" role="button" class="btn btn-primary float-right m-2">Log out</a>
     </form>
    </div>
    </nav>';
  } else {
    header("location: index.php");
  }
  ?>
  <h1 class="text-center font-weight-bold mt-3">Welcome <?php echo $fname; ?></h1>

  <?php
  $email = $_SESSION['email'];
  // $aquizsql = "SELECT DISTINCT(quiz_id) FROM `resultrecord` WHERE `email` LIKE 'user1@gmail.com'";
  //SELECT (resultrecord.correct_ans)*100/(quiz.total_question) as percentage, resultrecord.email FROM `resultrecord` INNER JOIN quiz ON resultrecord.quiz_id=quiz.quiz_id WHERE resultrecord.email LIKE 'user1@gmail.com';
  $aquizsql = "SELECT DISTINCT(quiz_id) FROM `resultrecord` WHERE `email` LIKE '$email'";
  $aquizresult = mysqli_query($conn, $aquizsql);
  $aquizrow = mysqli_fetch_assoc($aquizresult);
  $aquiznumrows = mysqli_num_rows($aquizresult);
  ?>

  <div class="row m-5">
    <div class="col-sm-4">
      <div class="card border-dark mb-3">
        <div class="card-body p-4 text-center">
          <h3 class="card-title">No. of quizzes attempted</h3>
          <hr class="badge-dark"><br>
          <h1 class="card-text"><?php echo $aquiznumrows; ?></h1>
        </div>
      </div>
    </div>
    <?php
    $numquizsql = "SELECT count(quiz_id) FROM `quiz`;";
    $numquizresult = mysqli_query($conn, $numquizsql);
    $numquizrow = mysqli_fetch_assoc($numquizresult);
    ?>
    <div class="col-sm-4">
      <div class="card border-dark mb-3">
        <div class="card-body p-4 text-center">
          <h3 class="card-title">No. of quizzes Available</h3>
          <hr class="badge-dark"><br>
          <h1 class="card-text"><?php echo $numquizrow["count(quiz_id)"]; ?></h1>
        </div>
      </div>
    </div>

<?php
$highsql = "SELECT MAX((resultrecord.correct_ans)*100/(quiz.total_question)) as percentage, resultrecord.email FROM `resultrecord` INNER JOIN quiz ON resultrecord.quiz_id=quiz.quiz_id WHERE resultrecord.email LIKE '$email';";
$highresult = mysqli_query($conn, $highsql);
$highrow = mysqli_fetch_assoc($highresult);
?>
    <div class="col-sm-4">
      <div class="card border-dark mb-3">
        <div class="card-body p-4 text-center">
          <h3 class="card-title">Highest result</h3>
          <hr class="badge-dark"><br>
          <h1 class="card-text"><?php if(substr($highrow['percentage'], 0, 5) == ''){
            echo '0%';
          } 
          else{
            echo substr($highrow['percentage'], 0, 5).'%';}?></h1>
        </div>
      </div>
    </div>
  </div>
<form method="post" action="partials/quizdetails.php">
  <div class="container col-md-3 mb-5">
    <div class="input-group mt-3  text-monospace">
      <input type="number" class="form-control border border-dark" name="quizcode" placeholder="Enter code..." min="1000" max="9999" autocomplete="off">
      <div class="input-group-append">
        <button class="btn btn-outline-info" type="submit" id="button-addon2">Join by code</button>
      </div>
    </div>
  </div>
</form>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>