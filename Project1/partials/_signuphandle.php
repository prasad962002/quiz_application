<?php
require'_dbconnect.php';//Signup handle
$showerror = false;
$showalert = false;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $firstname = $_POST['firstname'];
    if(ctype_digit($firstname)){
        $showerror = "Name cannot contain numbers";
        header("location:../index.php?signupsuccess=false&error=$showerror");
        exit();
    }
    $lastname = $_POST['lastname'];
    if(ctype_digit($firstname)){
        $showerror = "Name cannot contain numbers";
        header("location:../index.php?signupsuccess=false&error=$showerror");
        exit();
    }
    $signupemail = $_POST['signupemail'];
    $signuppassword = $_POST['signuppassword'];
    $csignuppassword = $_POST['csignuppassword'];
    $gender = $_POST['gender'];
    $firstname = ucfirst($firstname);
    $lastname = ucfirst($lastname);
    $existuser = "SELECT * FROM `user` WHERE email='$signupemail'";
    $result = mysqli_query($conn, $existuser);
    $numexistsrows = mysqli_num_rows($result);
    if($numexistsrows == 1){
        $showerror = "Email already exists";
    }
    else{
        if($signuppassword == $csignuppassword){
            $sql = "INSERT INTO `user` (`firstname`, `lastname`, `email`, `password`, `gender`) VALUES ('$firstname', '$lastname', '$signupemail', '$signuppassword', '$gender')";
            $result = mysqli_query($conn, $sql);
            if($result){
                $showalert = true;
                header('location:../index.php?signupsuccess=true');
                exit();
            }
        }
        else{
          $showerror = "Password does not match";
      }
    }
    header("location:../index.php?signupsuccess=false&error=$showerror");
}
?>