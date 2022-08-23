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
  <title>User quiz</title>
  <style>
    mark{
      color: red;
      background-color: yellow;
    }
  </style>
</head>

<body>
  <?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    include 'partials/_header.php';
    include 'partials/_dbconnect.php';
    
    if(isset($_GET['qsubmit']) && $_GET['qsubmit'] == "success"){
      echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
      Your quiz is submitted.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    }

    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <a class="navbar-brand text-secondary" href="welcome.php">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle active" href="userquiz.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
          Quiz
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="userquiz.php?catid=0">All</a>
        ';
             $sql = "SELECT * FROM `category` LIMIT 10";
             $result = mysqli_query($conn, $sql);
             $numrows = mysqli_num_rows($result);
             if ($numrows > 0) {
               while ($row = mysqli_fetch_assoc($result)) {
                //echo'<option value="'.$row['cat_id'].'"  class="text-center"><a href="userquiz.php?catid='.$row['cat_id'].'">'.$row['cat_desc'].'</a></option>';
                echo '<a class="dropdown-item" href="userquiz.php?catid='.$row['cat_id'].'">'.$row['cat_desc'].'</a>';
               }
              }          
          echo'
        </div>
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
    <div class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="search" placeholder="Search"  id="searchquiz" autocomplete="off"  aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" onclick="search()" >Search</button>
       <a href="partials/_logout.php" role="button" class="btn btn-primary float-right m-2">Log out</a>
     </div>
    </div>
    </nav>';
  } else {
    header("location: index.php");
  }
  ?>
  <div class="col-md-9 mt-5 mx-auto">
    <?php 
    if(isset($_GET['catid'])){
      if($_GET['catid'] != 0){
        $catid = $_GET['catid'];
        $sql = "SELECT * FROM `category` WHERE `cat_id`=$catid";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        echo'<h2><span class="px-5 py-3 bg-primary text-white rounded-pill">Category  :   '.$row['cat_desc'].'</span></h2>';
      } 
      elseif ($_GET['catid'] == 0) {       
        echo'<h2><span class="px-5 py-3 bg-primary text-white rounded-pill">Category  :   All</span></h2>';
      }
    }
    ?>
  </div>
  <div class="row mx-5" id="qdiv">
    <?php
    if(isset($_GET['catid'])){
      if($_GET['catid'] == 0){
        $sql = "SELECT * FROM `quiz` WHERE `quiz_status` = 1";
      }
      else{
        $catid = $_GET['catid'];
        $sql = "SELECT * FROM `quiz` WHERE `quiz_status` = 1 AND `cat_id` = $catid";
      }
    }
    else{

      $sql = "SELECT * FROM `quiz` WHERE `quiz_status` = 1";
    }
    $result = mysqli_query($conn, $sql);
    if(!$result){
      echo '<h1>No category found</h1>';
    }
    $numrows = mysqli_num_rows($result);
    if($numrows >0){
    while ($row = mysqli_fetch_assoc($result)) {
      //echo $row['quiz_desc'].'<br>';
      echo '<div class="col-md-4 mt-5">
        <div class="card border border-secondary shadow-lg">
        <div class="card-body text-center">
          <h5 class="card-title pt-3 cdiv" >' . $row['quiz_desc'] . '</h5>
          <p>Time :  '.$row['quiz_time'].' mins<br>          
          Total Questions :  '.$row['total_question'].'</p>
          <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
          <a href="partials/quizdetails.php?quizid=' . $row['quiz_id'] . '" class="btn btn-primary ">Start</a>
        </div>
      </div>
    </div>';
    }
  }
  else{
    echo '<div class="col-md-8 mt-5 bg-alert"><h1 class="text-center">No quizzes found</h1></div>';
  }
    ?>
  </div>

  <script type="text/javascript">
    const p = document.getElementsByClassName("cdiv");    
    function search(){
      let input = document.getElementById("searchquiz").value;          
      if(input !== ""){
        let regExp = new RegExp(input, "gi");        
        for (let i = 0; i < p.length; i++) {          
          p[i].innerHTML = (p[i].textContent).replace(regExp, "<mark>$&</mark>");                    
        }
      }
    }
  </script>
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