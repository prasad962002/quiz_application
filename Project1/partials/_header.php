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