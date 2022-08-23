<?php
session_start();
?>
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
  <title>Quiz - Feedback</title>
</head>

<body>
  <?php
  // if(isset($_SESSION['startedquiz'])){
  //   $startedquizid = $_SESSION['startedquiz'];
  //   echo $startedquizid;
  //   header("location:partials/question.php?quizid=$startedquizid");
  // }
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    include 'partials/_header.php';
    //echo'Welcome '. $_SESSION['username']; 

    //session_start();
    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand text-secondary" href="welcome.php">Home</a>
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
    <li class="nav-item active change">
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

  <?php
  //connect to db
  include 'partials/_dbconnect.php';
  $showAlert = false;
  //INSERT INTO `feedback` (`feedback_id`, `satisfication`, `feedback_desc`, `feedback_date`) VALUES (NULL, 'Good', 'Website is good\r\n', current_timestamp());
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $satisfy = $_POST['exampleRadios'];
    $feedback = $_POST['feedback'];
    $email = $_SESSION['email'];
    $sql = "INSERT INTO `feedback` (`feedback_by`, `satisfication`, `feedback_desc`) VALUES ('$email','$satisfy', '$feedback');";
    $result = mysqli_query($conn, $sql);
    if($result){
      $showAlert = true;
    }
  }
  ?>
  <?php
                if($showAlert){
                echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Thank you for feedback. Your feedback has been submitted.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                }
                ?> 
  <div class="container mt-5 border  shadow-lg bg-white rounded">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6 p-4">
        <h2 class="text-center">Feedback Form</h2>
        <p class="text-center">We would love to hear your thoughts, concerns or problem with anything so we can improve!</p>
        <hr class="w-100 bg-dark">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <p>How satisfied you with our services</p>
          <div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="Excellent" required>
              <label class="form-check-label" for="exampleRadios1">
                Excellent
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="Good">
              <label class="form-check-label" for="exampleRadios2">
                Good
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="Neutral">
              <label class="form-check-label" for="exampleRadios3">
                Neutral
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4" value="Poor">
              <label class="form-check-label" for="exampleRadios4">
                Poor
              </label>
            </div>
            <div class="form-group mt-3">
    <label for="exampleFormControlTextarea1">If you have specific feedback, please write to us...</label>
    <textarea class="form-control " id="exampleFormControlTextarea1" rows="3" name="feedback"></textarea>
  </div>
</div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
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


</body>

</html>