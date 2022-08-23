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

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" />
  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
  <!-- Bootstrap core CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Material Design Bootstrap -->
  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet" /> -->
  <title>Quiz - Home</title>
</head>

<body>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="partials/_edituserprofile.php" method="post">
            <div class="form-group row">
              <div class="col-md-6">
                <label for="editfirstname">First Name</label>
                <input type="text" class="form-control" id="editfirstname" name="editfirstname" required>
              </div>
              <div class="col-md-6">
                <label for="editlastname">Last Name</label>
                <input type="text" class="form-control" id="editlastname" name="editlastname" required>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-3 ml-2">Gender :</div>
              <div class="form-group col-md-2 ml-3 custom-control custom-radio custom-control-inline">
                <input type="radio" id="editgendermale" value="male" name="editgender" class="custom-control-input">
                <label class="custom-control-label" for="editgendermale">Male</label>
              </div>
              <div class="custom-control col-md-2 ml-3 form-group custom-radio custom-control-inline">
                <input type="radio" id="editgenderfemale" value="female" name="editgender" class="custom-control-input">
                <label class="custom-control-label" for="editgenderfemale">Female</label>
              </div>
            </div>

            <div class="form-group">
              <label for="signupemail">Email address</label>
              <input type="email" class="form-control-plaintext" readonly id="editemail" name="editemail">
              <!-- <div id="emailHelp" class="form-text">Email address cannot be changed.</div> -->
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <?php
  // if(isset($_SESSION['startedquiz'])){
  //   $startedquizid = $_SESSION['startedquiz'];
  //   echo $startedquizid;
  //   header("location:partials/question.php?quizid=$startedquizid");
  // }
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    include 'partials/_header.php';
    //echo'Welcome '. $_SESSION['username']; 

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
    <li class="nav-item active change">
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

  //connection to db
  include 'partials/_dbconnect.php';
  $email =  $_SESSION['email'];
  $sql = "SELECT * FROM `user` WHERE `email` = '$email' ORDER BY `email` ASC";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if ($num == 1) {
    $row = mysqli_fetch_assoc($result);
  }

  ?>
  <?php
          if(isset($_GET['update']) && $_GET['update'] == 'success'){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  Your profile has been updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
          }
          ?>

  <div class="container bg-light">
    <div class="row d-flex justify-content-center">
      <div class="col-md-10 mt-5 pt-5 shadow-lg">
        <div class="row z-depth-3">
          <div class="col-sm-4 bg-info rounded-left">
            <div class="card-block text-center text-white">
              <i class="fas fa-user-tie fa-7x mt-5"></i>
              <h2 class="font-weight-bold mt-4"><?php echo $row['firstname']; ?></h2>
              <p>User</p>
              <i class="far fa-edit fa-2x mb-5"></i>
            </div>
          </div>
          <div class="col-sm-8 bg-white rounded-right">
            <h1 class="mt-3 text-center">Information</h1>
            <hr class="badge-primary mt-0 w-25" />
            <div class="row">
              <div class="col-sm-6">
                <p class="font-weight-bold" >First Name:</p>
                <h6 class="text-muted" id="ufirstname"><?php echo $row['firstname']; ?></h6>
              </div>
              <div class="col-sm-6">
                <p class="font-weight-bold">Last Name:</p>
                <h6 class="text-muted" id="ulastname"><?php echo $row['lastname']; ?></h6>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-6">
                <p class="font-weight-bold">Gender:</p>
                <h6 class="text-muted" id="ugender"><?php echo $row['gender']; ?></h6>
              </div>
              <div class="col-sm-6">
                <p class="font-weight-bold">Email:</p>
                <h6 class="text-muted" id="uemail"><?php echo $row['email']; ?></h6>
              </div>
            </div>
            <!-- <h4 class="mt-3">Projects</h4> -->
            <hr class="bg-primary" />
            <div class="row mt-4">
              <div class="col-sm-6 text-center">
                <a class="btn btn-warning text-dark font-weight-bold px-5 py-2 rounded-pill edit" data-toggle="modal" data-target="#exampleModal" role="button">Edit</a>
              </div>
              <div class="col-sm-6 text-center">
                <a class="btn btn-danger py-2 px-3 rounded-pill" href="partials/_changepassword.php" role="button">Change Password</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>  
    fname = document.getElementById("ufirstname").innerHTML;
    lname = document.getElementById("ulastname").innerHTML;
    jsgender = document.getElementById("ugender").innerHTML;
    jsemail = document.getElementById("uemail").innerHTML;
    console.log(fname, lname, jsgender, jsemail);
    document.getElementById('editfirstname').value = fname;
    document.getElementById('editlastname').value = lname;
    document.getElementById('editemail').value = jsemail;
    if (jsgender == "male") {
      document.getElementById('editgendermale').checked = jsgender;
    } else {
      document.getElementById('editgenderfemale').checked = jsgender;
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