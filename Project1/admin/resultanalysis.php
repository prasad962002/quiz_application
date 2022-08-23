<?php
session_start();
if(!isset($_SESSION['admin']) && $_SESSION['admin'] == false){
  header("location:adminlogin.php");
  exit();
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

  <title>Admin - Home</title>
</head>

<body>
  <?php
  include("../partials/_adminheader.php");
  include("../partials/_dbconnect.php");

  $sql = "SELECT *, time(`crdate`) as resulttime FROM `resultrecord`";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  ?>
  <div class="table-responsive pt-3">
    <table class="table px-0" id="resultTable">
      <thead class="thead-light">
        <tr>
          <th scope="col">Sr no.</th>
          <th scope="col">User email</th>
          <th scope="col">Quiz id</th>
          <th scope="col">Total questions</th>
          <th scope="col">Selected Question</th>
          <th scope="col">Correct Answer</th>
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
          <td>" . $row['email'] . "</td>
          <td>"; 
          $quizid = $row['quiz_id'] ;
          $qsql = "SELECT * FROM `quiz` WHERE `quiz_id` = $quizid";
          $qresult = mysqli_query($conn, $qsql);
          $qrow = mysqli_fetch_assoc($qresult);
          echo $qrow['quiz_desc'];
          echo "</td>
          <td>"; 
          echo $qrow['total_question'];
          echo"</td>
          <td>" . $row['selected_question'] . "</td>
          <td>" . $row['correct_ans'] . "</td>
          <td>
          <div class=\"container\">
          <a class=\"btn btn-info edit text-white font-weight-bold  m-2 py-2 role=\"button\" href=\"../partials/displayresult.php?resultid=".$row['id']."&admin=1\">View Details</a>          
          </div>
          </td>
        </tr>";
          $no++;

          //#SELECT TIME(`crdate`), INTERVAL(TIME(`crdate`), 30 minute) FROM `resultrecord`;
// SELECT crdate, date_add(crdate,interval 30 minute) as newLoginDate 
// FROM `resultrecord`;
//SELECT resultrecord.quiz_id, quiz.quiz_desc, resultrecord.email
// FROM `resultrecord`
// INNER JOIN quiz
// ON resultrecord.quiz_id=quiz.quiz_id;
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
  <script src="adminscript.js"></script>
  <!-- Data table links -->
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
  <script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#resultTable').DataTable();
    });
  </script>
</body>

</html>