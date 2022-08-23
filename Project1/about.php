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

  <!-- Fontawesome -->
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous"> -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
  <title>Quiz - Feedback</title>
</head>

<body>
  <?php
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    include 'partials/_header.php';

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
    <li class="nav-item change">
     <a class="nav-link" href="userfeedback.php">Feedback</a>
    </li>
    <li class="nav-item active change">
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


  <div class="container mt-2 border  shadow-lg bg-white rounded">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6 p-4">
        <h2 class="text-center">About Us</h2>
        <!-- <p class="text-center">We would love to hear your thoughts, concerns or problem with anything so we can improve!</p>
        <hr class="w-100 bg-dark"> -->
        <blockquote style="text-indent: 50px;">Quiz web application is used to take online test.
          With the help of quiz person can review what they learned and what they understand the key concepts of that topic. 
          Quizzes help students to identify what they know and what they don't know. 
          The students then have a better idea of how well they know the topics, motivating them to study more and helping them to focus on information that needs more practice.
        </blockquote>
        <blockquote style="text-indent: 50px;">          
          This can be used in educational institutions as well as in corporate world.         
          Quiz is a very important part of education for content revising.
           With the help of Quiz System, teachers would be able to create quizzes for students. Quiz management system can be implemented in colleges, universities or at home to check the preparation of students and revise the topics of different courses. 
          Quiz management system would be able to create and check the quizzes thus time can be saved.
        </blockquote>
        <address class="text-right"><cite><b>~Designed and Developed By: Prasad Jambhale</b></cite></address>
        
        <div class="social-links float-right">
         <b> Follow us :</b>
          <a href="#"><i class="fab fa-instagram fa-2x pt-3 px-3 ml-3 shadow-lg  rounded-circle mx-2" aria-hidden="true"></i></a>
          <a href="#"><i class="fab fa-facebook fa-2x pt-3 px-3 shadow-lg  rounded-circle" aria-hidden="true"></i></a>
        </div>
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