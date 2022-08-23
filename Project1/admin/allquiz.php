<?php
session_start();
ob_start();
if(!isset($_SESSION['admin']) && $_SESSION['admin'] == false){
  header("location:adminlogin.php");
  exit();
}
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
    #quizmanageTable td {
      text-align: center;
      vertical-align: middle;
    }
  </style>
  <title>Admin - quizmanage</title>
</head>

<body>

  <?php

  //Delete user 
  $deletedquiz = false;
  if (isset($_GET['delete'])) {
    $deletequizid = $_GET['delete'];
    $delsql = "DELETE FROM `quiz` WHERE `quiz_id` = '$deletequizid'";
    $delresult = mysqli_query($conn, $delsql);

    $delrecsql = "DELETE FROM `resultrecord` WHERE `quiz_id` = '$deletequizid'";
    $delrecresult = mysqli_query($conn, $delrecsql);
    if ($delresult) {
      $deletedquiz = true;
    } else {
      echo "Fail to delete";
    }
  }



  ?>
  <?php
  if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    header("location: ../index.php");
  }
  include("../partials/_adminheader.php");
  if ($deletedquiz) {
    echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                  Quiz has been deleted.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
  }
  ?>

  <div class="table-responsive pt-3">
    <table class="table px-0" id="quizmanageTable">
      <thead class="thead-light">
        <tr>
          <th scope="col">Sr no.</th>
          <th scope="col">Quiz Name</th>
          <th scope="col">Quiz Code</th>
          <th scope="col">No of questions</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM `quiz` ORDER BY `quiz_id` DESC";
        $result = mysqli_query($conn, $sql);
        // $row = mysqli_fetch_assoc($result);
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
          echo "
        <tr id=\"" . $row['quiz_id'] . "\">
          <th scope='row'>" . $no . "</th>
          <td>" . $row['quiz_desc'] . "</td>
          <td>" . $row['quiz_code'] . "</td>
          <td>" . $row['total_question'] . "</td>
          <td>";
          if ($row['quiz_status'] == 1) {
            echo '<a class="badge badge-success p-2" href="../partials/changestatus.php?quizid=' . $row['quiz_id'] . '&status=0">Enabled</a>';
          } else {
            echo '<a class="badge badge-danger p-2" href="../partials/changestatus.php?quizid=' . $row['quiz_id'] . '&status=1">Disabled</a>';
          }
          echo "</td>
          <td>
          <div class=\"container\">
          <a class=\"btn btn-info font-weight-bold m-2 py-2\" role=\"button\" href=\"../partials/_quizinfo.php?quizid=" . $row['quiz_id'] . "\">Preview</a>
          <a class=\"btn btn-danger font-weight-bold m-2 py-2 delete\" role=\"button\">Delete</a>
          
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
      $('#quizmanageTable').DataTable();
    });
  </script>
  <script>
    //Delete quiz
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        //console.log("edit ",e.target.parentNode.parentNode.parentNode.children[3].innerHTML);
        console.log("delete ", e.target.parentNode.parentNode.parentNode.id);
        quizid = e.target.parentNode.parentNode.parentNode.id;
        if (confirm("Be careful! All results related to this quiz will also deleted. \nDo you want to delete this quiz?")) {
          //console.log("yes");
          window.location = `allquiz.php?delete=${quizid}`;
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