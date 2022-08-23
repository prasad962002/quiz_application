<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="mystyle.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Quiz - Home</title>
</head>

<body>
  <?php
  include 'partials/_loginmodal.php';
  include 'partials/_signupmodal.php';
  if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == 'true') {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Your account is created. You can now log in.</strong> 
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
  }
  if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == 'false') {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>' . $_GET['error'] . '</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
  } else {
    if (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == 'false') {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>' . $_GET['error'] . '</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
  }
  ?>
  <div class="bg-image"></div>
  <div class="bg-text">
    <h1>Let's Quiz</h1>
    <p>Test your skills and become master</p>
    <button type="button" class="btn  m-2" data-toggle="modal" data-target="#loginModal">Log In</button>
    <button type="button" class="btn  m-2" data-toggle="modal" data-target="#signupModal">Sign Up</button>

  </div>
  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();

    document.getElementById("signuppassword").onfocus = function() {
      document.getElementById('passins').style.display = "block";
    };
    document.getElementById("signuppassword").onblur = function() {
      document.getElementById('passins').style.display = "none";
    };
  </script>

  <script src="scripts/passvalid.js">
  </script>
</body>

</html>