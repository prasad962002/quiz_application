<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Change Password</title>
</head>

<body>

    <?php
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
        header('location:../welcome.php');
    }
    //connection to db
    include '_dbconnect.php';
    $email =  $_SESSION['email'];
    $error = "";
    $success = false;
    $sql = "SELECT * FROM `user` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        $row = mysqli_fetch_assoc($result);
        //echo $row['password']; 
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $oldpassword = $_POST['opassword'];
        $newpassword = $_POST['npassword'];
        $confirmpassword = $_POST['cpassword'];
        //echo $oldpassword;
        if ($newpassword == "") {
            $error = "New password cannot be empty";
            //exit();
        }
        if (($oldpassword == $row['password']) && ($oldpassword != $newpassword) && $newpassword != '') {
            if ($newpassword == $confirmpassword) {
                $sql = "UPDATE `user` SET `password` = '$newpassword' WHERE `user`.`email` = '$email'";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    //header('location:../userprofile.php');
                    $success = true;
                }
            } else {
                $error = "Password not match";
                $success = false;
            }
        } else {
            if ($oldpassword == $newpassword) {
                $error = "New passsword and old password should not be same";
            } else {
                $error = "Wrong old password";
            }
        }
    }

    ?>
    <h1 class="text-center mt-4">Change Password</h1>
    <div class="row d-flex justify-content-center">
        <div class="col-md-3 mt-5 p-4 shadow-lg">
            <div class="z-depth-3">
                <?php
                if ($error) {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    ' . $error . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                }
                if ($success) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Password changed successfully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                }
                ?>
                <form class="col-md-auto" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">                    
                    
                    <div class="form-group">
                    <label for="oldPassword">Old Password</label>
                        <div class="input-group">
                        <input type="password" class="form-control" id="oldPassword" name="opassword" required>
                            <div class="input-group-append">
                                <span class="show-pass input-group-text" onclick="toggle(this)" role="button">
                                    <i class="fa fa-eye" onclick="myFunction(this)"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="newPassword">New Password</label><br>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="npassword" min="6" required pattern="(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter and one special character, and at least 8 or more characters">
                            <div class="input-group-append">
                                <span class="show-pass input-group-text" onclick="toggle(this)" role="button">
                                    <i class="fa fa-eye" onclick="myFunction(this)"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <ul class="list-unstyled" style="display: none; transition: 2s" id="passins" >
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

                    <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                        <div class="input-group">
                        <input type="password" class="form-control" id="confirmPassword" name="cpassword" min="6" required>
                            <div class="input-group-append">
                                <span class="show-pass input-group-text" onclick="toggle(this)" role="button">
                                    <i class="fa fa-eye" onclick="myFunction(this)"></i>
                                </span>
                            </div>
                        </div>
                    </div>
        
                    <div class="form-group row">
                        <div class="col-sm-auto">
                            <a class="btn btn-primary text-center " href="../userprofile.php" role="button">Back</a>
                        </div>
                        <div class="col-sm-auto">
                            <button type="submit" class="btn btn-primary text-center ">Change password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script src="../scripts/passvalid.js">       
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