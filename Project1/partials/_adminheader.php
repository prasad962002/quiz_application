<?php

echo'<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top p-1">
  <a class="navbar-brand text-warning pl-2 font-weight-bolder" style="cursor:pointer;letter-spacing:5px;font-family:Lucida Console;" href="adminhome.php">Administrator</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mx-auto">
      <li class="nav-item px-2">
        <a class="nav-link linkin" href="adminhome.php">Dashboard<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item px-2">
        <a class="nav-link linkin" href="createquiz.php">Create quiz</a>
      </li>
      <li class="nav-item px-2">
        <a class="nav-link linkin" href="allquiz.php">Quizzes manage</a>
      </li>
      <li class="nav-item px-2">
        <a class="nav-link linkin" href="usersmanage.php">User Management</a>
      </li>
      <li class="nav-item px-2">
        <a class="nav-link linkin" href="adminfeedback.php">Feedback</a>
      </li>
      <li class="nav-item px-2">
        <a class="nav-link linkin" href="resultanalysis.php">Result Analysis</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0 ">
    <a href="../partials/_logout.php" role="button" class="btn btn-primary m-2">Log out</a>
    </form>
  </div>
</nav>';
?>