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

  <style>
    tr,
    #feedbackTable td {
      text-align: center;
      vertical-align: middle;
    }
  </style>
  <title>Admin - Home</title>
</head>

<body>
  <?php
  include("../partials/_adminheader.php");
  include("../partials/_dbconnect.php");
  $sql = "SELECT * FROM `feedback`";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  ?>
  <div class="table-responsive pt-3">
    <table class="table px-0" id="feedbackTable" >
      <thead class="thead-light">
        <tr>
          <th scope="col">Sr no.</th>
          <th scope="col">Feedback by</th>
          <th scope="col">User Satisfaction</th>
          <th scope="col">Feedback description</th>
          <th scope="col">Date </th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $no = 1;
        while($row = mysqli_fetch_assoc($result)){
          if($row['feedback_desc'] == ''){
            $row['feedback_desc'] = 'Not given';
          }
          $today = $row['feedback_date'];
          $today = substr($today, 0,10);
          $today = str_replace("-","/", $today);
          //$today = strrev($today);
        echo"
        <tr>
          <th scope='row'>".$no."</th>
          <td>".$row['feedback_by']."</td>
          <td>".$row['satisfication']."</td>
          <td>".$row['feedback_desc']."</td>
          <td>".$today."</td>          
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
      $('#feedbackTable').DataTable();
    });
  </script>
  <script src="adminscript.js"></script>
</body>

</html>