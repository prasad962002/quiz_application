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
        ul{
            padding-left: 1rem;
        }
        li{
            list-style-type: disc;
        }
        </style>
    <title>Quiz - Home</title>
</head>

<body>
    <?php
    session_start();
    //   if(isset($_SESSION['startedquiz'])){
    //     $startedquizid = $_SESSION['startedquiz'];
    //     echo $startedquizid;
    //     header("location:question.php?quizid=$startedquizid");
    //   }
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        include '_header.php';
        include '_dbconnect.php';

    //     echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    // <a class="navbar-brand text-secondary" href="../welcome.php">Home</a>
    // <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    //  <span class="navbar-toggler-icon"></span>
    // </button>
    
    // <div class="collapse navbar-collapse" id="navbarSupportedContent">
    // <ul class="navbar-nav mr-auto">
    // <li class="nav-item change">
    //  <a class="nav-link" href="../userquiz.php">Quiz <span class="sr-only">(current)</span></a>
    // </li>
    // <li class="nav-item change">
    //  <a class="nav-link" href="../userprofile.php">Profile</a>
    // </li>
    // <li class="nav-item change">
    //  <a class="nav-link" href="../userresult.php">Result</a>
    // </li>
    // <li class="nav-item change">
    //  <a class="nav-link" href="../userfeedback.php">Feedback</a>
    // </li>
    // </ul>
    //    <form class="form-inline my-2 my-lg-0">
    //    <a href="_logout.php" role="button" class="btn btn-primary float-right m-2">Log out</a>
    //  </form>
    // </div>
    // </nav>';
    } else {
        header("location: ../index.php");
    }
    ?>

    <?php
    //From join code
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $quizcode = $_POST['quizcode'];
        $qsql = "SELECT * FROM `quiz` WHERE `quiz_code` = $quizcode";
        $qresult = mysqli_query($conn, $qsql);
        $numrow = mysqli_num_rows($qresult);
        if ($numrow === 1) {
            $qrow = mysqli_fetch_assoc($qresult);
        } else {
            echo "<br><br><h1><center>Quiz not found or Quiz code is wrong...</center></h1>";
            exit();
        }
    }


    //Taking quiz details from db
    if (isset($_GET['quizid'])) {
        $qid = $_GET['quizid'];
        $qsql = "SELECT * FROM `quiz` WHERE `quiz_id` = $qid";
        $qresult = mysqli_query($conn, $qsql);
        $qrow = mysqli_fetch_assoc($qresult);
    }
    ?>
    <div class="container col-md-5 mx-auto mt-5">
        <div class="card mb-3 my-auto mx-auto text-monospace" style="border: 1px solid grey;">
            <div class="card-header text-center bg-info text-white pt-4">
                <h5 class="font-weight-bolder">Quiz details</h5>
            </div>
            <div class="card-body">
                <div class="card-text px-5">
                    <table>
                        <tr>
                            <td>
                                <p>Quiz code:</p>
                            </td>
                            <td>
                                <p><?php echo $qrow['quiz_code']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Quiz name:</p>
                            </td>
                            <td>
                                <p><?php echo $qrow['quiz_desc']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Time limit:</p>
                            </td>
                            <td>
                                <p><?php echo $qrow['quiz_time']; ?>&nbsp;min</p>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p>Total no of questions:</p>
                            </td>
                            <td>
                                <p><?php echo $qrow['total_question']; ?></p>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2"><u>
                                    <h5 class="text-center font-weight-bolder">Instructions:</u></h5>
                                <ul>
                                    <li>There is only one possible answer of every question.</li>
                                    <li>When you are completing the Quiz make sure you are in a quiet environment so you can concentrate well.</li>
                                    <!-- <li>there</li> -->
                                    <li>Quiz will automatically submit when time is over.</li>
                                    <li>That's all you need to know about quiz GOOD LUCK.</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a class="btn btn-success text-white font-weight-bold m-2 " href="../userquiz.php" role="button" style="border-radius: 8px;padding: 10px 32px;">Back</a>
                                <!-- <button type="button" class="btn btn-primary col-md-4">Back</button> -->
                            </td>
                            <td>
                                <a class="btn btn-success text-white font-weight-bold m-2" href="question.php?quizid=<?php echo $qrow['quiz_id'] ?>" role="button" style="border-radius: 8px;padding: 10px 32px;">Start Quiz</a>
                                <!-- <button type="button" class="btn btn-primary col-md-auto" id="showans">Show question and answers</button> -->
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php

    ?>

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