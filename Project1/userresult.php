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

  <style>
    tr,
    #myTable td, p {
      text-align: center;
      vertical-align: middle;
    }
  </style>
  <title>Quiz - Result</title>
</head>

<body>
  <?php
  session_start();
  // if(isset($_SESSION['startedquiz'])){
  //   $startedquizid = $_SESSION['startedquiz'];
  //   echo $startedquizid;
  //   header("location:question.php?quizid=$startedquizid");
  // }
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    include 'partials/_header.php';
    //echo'Welcome '. $_SESSION['username']; 

    //session_start();
    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <a class="navbar-brand text-secondary" href="welcome.php">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item change">
     <a class="nav-link" href="userquiz.php">Quiz <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item change">
     <a class="nav-link" href="userprofile.php">Profile</a>
     </li>
     <li class="nav-item active change">
     <a class="nav-link" href="userresult.php">Result</a>
    </li>
    <li class="nav-item change">
     <a class="nav-link " href="userfeedback.php">Feedback</a>
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
  ?>
  <?php
  include("partials/_dbconnect.php");
  $email = $_SESSION['email'];
  $sql = "SELECT * FROM `resultrecord` WHERE `email` LIKE '$email' ORDER BY `id` DESC";
  $result = mysqli_query($conn, $sql);
  if ($result) {
  ?>
    <div class="table-responsive pt-3">
      <table class="table px-0" id="myTable">
        <thead class="thead-light">
          <tr>
            <th scope="col">Sr no.</th>
            <th scope="col">Quiz</th>
            <th scope="col">Time</th>
            <th scope="col">
              No of questions
            </th>
            <th scope="col">Score</th>
            <th scope="col">Date </th>
            <th scope="col">More details</th>
          </tr>
          
        </thead>
        <tbody>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
          $today = $row['crdate'];
          $today = substr($today, 0, 10);
          $today = str_replace("-", "/", $today);
          //$today = strrev($today);
          $qid = $row['quiz_id'];
          //Get quiz topic
          $quizsql = "SELECT * FROM `quiz` WHERE `quiz_id` = $qid";
          $quizresult = mysqli_query($conn, $quizsql);
          $quizrow = mysqli_fetch_assoc($quizresult);

          echo "<tr>
        <th scope='row'><p>" . $no . "</p></th>
          <td>" . $quizrow['quiz_desc'] . "</td>
          <td>" . $quizrow['quiz_time'] . " min</td>
          <td>" . $quizrow['total_question'] . "</td>
          <td>" . $row['correct_ans'] . "</td>
          <td>" . $today . "</td>          
          <td><a class=\"btn btn-info text-white font-weight-bold m-2 py-2\" href=\"partials/displayresult.php?resultid=".$row['id']."\" id=\"".$row['id']."\" role=\"button\">View Details</a></td>                    
        </tr>";
          $no++;
        }
      } else {
        echo "<h1>You didn't gave any quiz</h1>";
      }
        ?>
        </tbody>
      </table>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- Data table links -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
  -->
    <script>
      $(document).ready(function() {
        $('#myTable').DataTable();
      });
    </script>

</body>

</html>