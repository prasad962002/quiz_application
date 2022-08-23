<!doctype html>
<html lang="en">

<head>
  <!-- <script src="/Car rental website/script.js"></script> -->
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- <script src="https://kit.fontawesome.com/1c2c2462bf.js"></script> -->
  <title>Checkout Form</title>

</head>

<body>
  <div class="container">

    <form method="post" action="partials/_loginhandle.php" class="needs-validation " novalidate>
      <div class="form-group">
        <label for="loginemail">Email address</label>
        <input type="email" class="form-control" id="loginemail" name="loginemail" required>
        <div class="invalid-feedback">
          Please provide a valid zip.
        </div>
      </div>
      <div class="form-group">
        <label for="loginpassword">Password</label>
        <input type="password" id="password" class="form-control" id="loginpassword" name="loginpassword" required>
        <span class="show-pass" onclick="toggle()">
          <i class="fa fa-eye" onclick="myFunction(this)"></i>
        </span>
        <div id="popover-password">
          <p><span id="result"></span></p>
          <div class="progress">
            <div id="password-strength" class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
          </div>
          <ul class="list-unstyled">
            <li>
              <span class="low-upper-case">
                <i class="fa fa-circle" aria-hidden="true"></i>
                Lowercase &amp; Uppercase
              </span>
            </li>
            <li>
              <span class="one-number">
                <i class="fa fa-circle" aria-hidden="true"></i>
                Number (0-9)
              </span>
            </li>
            <li>
              <span class="one-special-char">
                <i class="fa fa-circle" aria-hidden="true"></i>
                Special Character (!@#$^*)
              </span>
            </li>
            <li>
              <span class="eight-character">
                <i class="fa fa-circle" aria-hidden="true"></i>
                Atleast 8 characters
              </span>
            </li>
          </ul>
        </div>


        <div class="invalid-feedback">
          Please provide a valid zip.
        </div>
      </div>

      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">Log in</button>
  </div>

  </form>
  <i class="fa fa-check" aria-hidden="true"></i>

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
  </script>
  <script>

let state = false;
let password = document.getElementById('password');
let passwordstrength = document.getElementById('password-strength');
let loweruppercase = document.querySelector('.low-upper-case i');
let number = document.querySelector('.one-number i');
let specialchar = document.querySelector('.one-special-char i');
let eightchar = document.querySelector('.eight-character i');

function myFunction(show){
  show.classList.toggle('fa-eye-slash');
}

function toggle(){
  if(state){
    password.setAttribute('type', 'password');
    state = false;
  }
  else{
    password.setAttribute('type', 'text');
    state = true;
  }
}

password.addEventListener('keyup', function () {
  let pass = password.value;
  checkStrength(pass);
});

function checkStrength(password) {
  //If password contains lower and upper case
  if(password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)){
    console.log("yes");
    loweruppercase.classList.remove('fa-circle');
    loweruppercase.classList.add('fa-check');

  }
  else{
    loweruppercase.classList.add('fa-circle');
    loweruppercase.classList.remove('fa-check');
  }

  //If password has number
  if(password.match(/([0-9])/)){
    number.classList.remove('fa-circle');
    number.classList.add('fa-check');
  }
  else{
    number.classList.add('fa-circle');
    number.classList.remove('fa-check');
  }


  //If password has one special character
  if(password.match(/([!,@,#,$,%,^,&,*,?,_,~])/)){
    specialchar.classList.remove('fa-circle');
    specialchar.classList.add('fa-check');
  }
  else{
    specialchar.classList.add('fa-circle');
    specialchar.classList.remove('fa-check');
  }

  //If password is more than 7
  if(password.length > 7){
  
    eightchar.classList.remove('fa-circle');
    eightchar.classList.add('fa-check');
  }
  else{
    eightchar.classList.add('fa-circle');
    eightchar.classList.remove('fa-check');
  }
}
  </script>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>