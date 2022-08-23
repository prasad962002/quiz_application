<?php echo'<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand text-secondary" href="welcome.php" >Home</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
 <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav mr-auto">
<li class="nav-item change">
 <a class="nav-link" href="userquiz.php">Quiz <span class="sr-only">(current)</span></a>
</li>
<li class="nav-item change">
 <a class="nav-link text-white" href="userprofile.php">Profile</a>
</li>
<li class="nav-item change">
 <a class="nav-link" href="userresult.php">Result</a>
</li>
<li class="nav-item change">
 <a class="nav-link" href="userfeedback.php">Feedback</a>
</li>
</ul>
   <form class="form-inline my-2 my-lg-0">
  <a href="partials/_logout.php" role="button" class="btn btn-primary float-right m-2">Log out</a>
     
 </form>
</div>
</nav>';
?>