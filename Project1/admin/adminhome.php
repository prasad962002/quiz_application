<?php
session_start();
if(!isset($_SESSION['admin']) && $_SESSION['admin'] == false){
  header("location:adminlogin.php");
  exit();
}
// echo var_dump($_SESSION);
include("../partials/_dbconnect.php");
$addcat = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $catname = $_POST['cat_desc'];
  $addsql = "INSERT INTO `category` (`cat_desc`) VALUES ('$catname')";
  $addresult = mysqli_query($conn, $addsql);
  if ($addresult) {
    $addcat = "success";
  } else {
    $addcat = "fail";
  }
}

//Delete category
$delcat = '';
if (isset($_GET['delcat'])) {
  $delcat = $_GET['delcat'];

  $delsql = "DELETE FROM `category` WHERE `cat_id`=$delcat";
  $delresult = mysqli_query($conn, $delsql);
  if ($delresult) {
    $delcat = 'success';
  } else {
    $delcat = 'fail';
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Admin - Home</title>
</head>

<body>
  <?php
  include("../partials/_adminheader.php");
  if ($addcat == "success") {
    echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
          New category has been added.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
  }
  if ($delcat == "success") {
    echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
          category has been deleted.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
  }
  ?>
  <h1 class="text-center font-weight-bold mt-3">Welcome Admin</h1>
  <div class="row m-5">
    <div class="col-sm-4">
      <div class="card border-dark mb-3">
        <div class="card-body p-4 text-center">
          <h3 class="card-title">No. of quizzes created</h3>
          <hr class="badge-dark"><br>
          <?php
          $qsql = "SELECT * FROM `quiz`";
          $qresult = mysqli_query($conn, $qsql);
          $qnumrows = mysqli_num_rows($qresult);
          ?>
          <h1 class="card-text"><?php echo $qnumrows; ?></h1>
          <a href="allquiz.php" class="btn btn-outline-dark d-block py-2 mt-3 font-weight-bold">Manage Quizzes</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card border-dark mb-3">
        <div class="card-body p-4 text-center">
          <h3 class="card-title">No. of users </h3>
          <hr class="badge-dark"><br>
          <?php
          $usql = "SELECT * FROM `user`";
          $uresult = mysqli_query($conn, $usql);
          $unumrows = mysqli_num_rows($uresult);
          ?>
          <h1 class="card-text"><?php echo $unumrows; ?></h1>
          <a href="usersmanage.php" class="btn btn-outline-dark d-block py-2 mt-3 font-weight-bold">Manage Users</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card border-dark mb-3">
        <div class="card-body p-4 text-center">
          <h3 class="card-title">Most attempted Quiz</h3>
          <hr class="badge-dark"><br>
          <h1 class="card-text" style="white-space: nowrap; overflow:hidden; text-overflow: ellipsis;">General Knowledge ^</h1>
          <a href="resultanalysis.php" class="btn btn-outline-dark d-block py-2 mt-3 font-weight-bold">Go to user results</a>
        </div>
      </div>
    </div>
  </div>
  <br>

  <div class="container col-md-3 mb-5">
    <ul class="list-group">
      <li class="list-group-item active border text-center"><b>Quiz Category List</b></li>
      <?php
      $sql = "SELECT * FROM `category`";
      $result = mysqli_query($conn, $sql);
      $numrows = mysqli_num_rows($result);
      if ($numrows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          //echo '<li class="list-group-item" id="' . $row['cat_id'] . '">' . $row['cat_desc'] . '<a class="float-right text-danger" role="button" href="adminhome.php?delcat=' . $row['cat_id'] . '"><i class="fa fa-trash-o"></i></a></li>';
          echo '<li class="list-group-item" id="' . $row['cat_id'] . '">' . $row['cat_desc'] . '<a class="float-right text-danger delete" role="button"><i class="fa fa-trash-o"></i></a></li>';
        }
      }
      ?>
    </ul>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <div class="input-group mt-3  text-monospace">
        <input type="text" class="form-control border border-dark" name="cat_desc" placeholder="Enter category..." autocomplete="off" required>
        <div class="input-group-append">
          <button class="btn btn-success" type="submit" id="button-addon2">Add category</button>
        </div>
      </div>
    </form>
  </div>
<script>
  //Delete
  deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        //console.log("edit ",e.target.parentNode.parentNode.parentNode.children[3].innerHTML);
        console.log("delete ", e.target.parentNode.parentNode.id);
        catid = e.target.parentNode.parentNode.id;
        if (confirm("All the quizzes related to category will be unlisted. \n Do you really want to delete this category?")) {
          //console.log("yes");
          window.location = `adminhome.php?delcat=${catid}`;
        } else {
          console.log("no");
        }
      });
    });
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
  <script src="adminscript.js"></script>
</body>

</html>