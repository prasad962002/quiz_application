<?php
//session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true ){
  $loggedin = true;
}
else{
  $loggedin = false;
}
echo'<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
   <a class="navbar-brand" href="index.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
  <li class="nav-item ">
    <a class="nav-link" href="index.php">Quiz <span class="sr-only">(current)</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Result</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Feedback</a>
  </li>
  </ul>
      <form class="form-inline my-2 my-lg-0">';
    if(!$loggedin){
    echo'<button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#loginModal">Log In</button>
    <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#signupModal">Sign Up</button>';  
    }
    if($loggedin){
      echo'<a href="partials/_logout.php" role="button" class="btn btn-primary float-right m-2">Log out</a>';
    }
    echo'    
    </form>
  </div>
</nav>';
?>
<?php
    include'_loginmodal.php';
    include'_signupmodal.php';
    if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == 'true'){
      echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Your account is created. You can now log in.</strong> 
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    }    
      if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == 'false'){
        echo'<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>'.$_GET['error'].'</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      }
    else{
      if(isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == 'false'){
        echo'<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>'.$_GET['error'].'</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      }
    }
    ?>