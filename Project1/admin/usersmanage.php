<?php
session_start();
if(!isset($_SESSION['admin']) && $_SESSION['admin'] == false){
  header("location:adminlogin.php");
  exit();
}

ob_start();
include("../partials/_dbconnect.php");
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

  <style>
    tr,
    th,
    #usermanageTable td {
      text-align: center;
      vertical-align: middle;
    }
  </style>
  <title>Admin - Usermanage</title>
</head>

<body>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
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
            <!-- <form action="../partials/_edituserprofilebyadmin.php" method="post"> -->
            <div class="form-group row">
              <div class="col-md-6">
                <label for="editfirstname">First Name</label>
                <input type="text" class="form-control" id="editfirstname" name="editfirstname">
              </div>
              <div class="col-md-6">
                <label for="editlastname">Last Name</label>
                <input type="text" class="form-control" id="editlastname" name="editlastname">
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
            <!-- <input type="hidden" name="name" value="0"> -->
            <div class="form-group">
              <label for="signupemail">Email address</label>
              <input type="email" class="form-control-plaintext" name="editedemail" id="editusermail" readonly>
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
  //Update user
  $updateduser = false;
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $editfirstname = $_POST['editfirstname'];
    $editlastname = $_POST['editlastname'];
    $gender = $_POST['editgender'];
    $umail = $_POST['editedemail'];
    $editfirstname = ucfirst($editfirstname);
    $editlastname = ucfirst($editlastname);
    //echo var_dump($_POST);
    $sql = "UPDATE `user` SET `firstname` = '$editfirstname',`lastname` = '$editlastname', `gender` = '$gender' WHERE `user`.`email` = '$umail';";
    $result = mysqli_query($conn, $sql);
    if($result){
      $updateduser = true;
      }
      else{
        //echo"fail";
        $updateduser = false;
      }
    }

  //Delete user 
  $deleteduser = false;
  if (isset($_GET['delete'])) {
    $deleteid = $_GET['delete'];
    $delsql = "DELETE FROM `user` WHERE email = '$deleteid'";
    $delresult = mysqli_query($conn, $delsql);
    if ($delresult) {
      $deleteduser = true;
    } else {
      echo "Fail to delete";
    }
  }

  if ($updateduser) {
    echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                  User profile has been updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
  }

  if ($deleteduser) {
    echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                  User has been deleted.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
  }
  ?>
  <?php
  if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    header("location: ../index.php");
  }
  include("../partials/_adminheader.php");
  $sql = "SELECT * FROM `user`";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  ?>
  <div class="table-responsive pt-3">
    <table class="table px-0" id="usermanageTable">
      <thead class="thead-light">
        <tr>
          <th scope="col">Sr no.</th>
          <th scope="col">User Name</th>
          <th scope="col">User Email</th>
          <th scope="col">Gender</th>
          <th scope="col">Joined date</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
          echo "
        <tr id=\"" . $row['email'] . "\">
          <th scope='row'>" . $no . "</th>
          <td>" . $row['firstname'] . "  " . $row['lastname'] . "</td>

          <td>" . $row['email'] . "</td>
          <td>" . $row['gender'] . "</td>
          <td>" . substr($row['created'], 0, 10) . "</td>
          <td>
          <div class=\"container\">
          <a class=\"btn btn-warning edit text-dark font-weight-bold  m-2 py-2 edit role=\"button\" data-toggle=\"modal\" data-target=\"#exampleModal\">Edit</a>
          <a class=\"btn btn-danger text-white font-weight-bold  m-2 py-2 delete\" role=\"button\">Delete</a>
          </div>
          </td>
        </tr>";
          $no++;
        }
        ?>
      </tbody>
    </table>
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
  <!-- Data table links -->
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
  <script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#usermanageTable').DataTable();
    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        //console.log("edit ",e.target.parentNode.parentNode.parentNode.children[3].innerHTML);
        console.log("edit ", e.target.parentNode.parentNode.parentNode.children[1].innerHTML.split(" "));
        fullname = e.target.parentNode.parentNode.parentNode.children[1].innerHTML.split(" ");
        fname = fullname[0];
        lname = fullname[2];
        jsemail = e.target.parentNode.parentNode.parentNode.children[2].innerHTML;
        jsgender = e.target.parentNode.parentNode.parentNode.children[3].innerHTML;
        document.getElementById('editfirstname').value = fname;
        document.getElementById('editlastname').value = lname;
        document.getElementById('editusermail').value = jsemail;
        console.log(document.getElementById('editusermail').value);
        if (jsgender == "male") {
          document.getElementById('editgendermale').checked = jsgender;
        } else {
          document.getElementById('editgenderfemale').checked = jsgender;
        }
      });
    });

    //Delete
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        //console.log("edit ",e.target.parentNode.parentNode.parentNode.children[3].innerHTML);
        console.log("delete ", e.target.parentNode.parentNode.parentNode.id);
        usermail = e.target.parentNode.parentNode.parentNode.id;
        if (confirm("Do you want to delete the user ?")) {
          //console.log("yes");
          window.location = `usersmanage.php?delete=${usermail}`;
        } else {
          console.log("no");
        }
      });
    });
  </script>
  <?php
  ob_end_flush();
  ?>
  <script src="adminscript.js"></script>
</body>

</html>