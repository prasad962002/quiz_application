<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- JQuery google CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        .blu {
            border: 3px solid #000;

        }

        td:last-child {
            text-align: center;
        }

        input[type=radio] {
            visibility: hidden;
        }

        .correct {
            background-color: green !important;
        }
    </style>
    <title>Quiz Preview</title>
</head>

<body>    
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        include("_dbconnect.php");
        if (isset($_GET['quizid'])) {
            $quizid = $_GET['quizid'];
        }
        $qsql = "SELECT * FROM `quiz` WHERE `quiz_id` = $quizid";
        $qresult = mysqli_query($conn, $qsql);
        $qrow = mysqli_fetch_assoc($qresult);
    } else {
        header("location: ../index.php");
    }
    ?>

    <div class="container col-md-5 mx-auto mt-5">
        <div class="card mb-3 my-auto mx-auto blu">
            <div class="card-header text-center bg-secondary text-white pt-4">
                <h5 class="font-weight-bolder">Quiz Preview</h5>
            </div>
            <div class="card-body">
                <div class="card-text px-5">
                    <table>
                    <tr>
                            <td>
                                <p>Quiz Category:</p>
                            </td>
                            <td>
                                <p><?php echo $qrow['quiz_desc']; ?></p>
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
                                <p>Quiz code:</p>
                            </td>
                            <td>
                                <p><?php echo $qrow['quiz_code']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Time:</p>
                            </td>
                            <td>
                                <p><?php echo $qrow['quiz_time'].' min'; ?></p>
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
                            <td>
                                <p>Status</p>
                            </td>
                            <td>
                                <p><?php if( $qrow['quiz_status'] == 1){
                                    echo "Enabled";
                                }
                                else{
                                    echo"Disabled";
                                }
                                ?></p>
                            </td>
                        </tr>
                    
                        <tr>
                            <td>
                                <a class="btn btn-primary text-white font-weight-bold m-2 py-2" href="../admin/allquiz.php" role="button">Back</a>
                                
                            </td>
                            <td>
                                <a class="btn btn-primary text-white font-weight-bold m-2 py-2" id="showans" role="button">Show question and answers</a>
                                <!-- <button type="button" class="btn btn-primary col-md-auto" id="showans">Show question and answers</button> -->
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Show queston and answer -->
    <?php
    $sql = "SELECT * FROM `quiz` WHERE `quiz_id`=$quizid";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>
    <div class="container ml-auto mt-5 border-light d-none" id="qnacontainer">
            <?php
            $noq = 1;
            $sql = "SELECT * FROM `question` WHERE `quiz_id` = $quizid";
            $result = mysqli_query($conn, $sql);
            $numrows = mysqli_num_rows($result);
            while ($row = mysqli_fetch_assoc($result)) {
                $qid = $row['question_id'];
                echo '
    <div class="card mb-3 mx-auto border-dark question-container col-md-6" >
      <div class="card-header bg-white p-3 border-dark">' . $noq . '. ' . $row['question_desc'] . '</div>
      <div class="card-body">      
      ';
                //Answer table query
                $sql2 = "SELECT * FROM `answer` WHERE `question_id` = $qid";
                $result2 = mysqli_query($conn, $sql2);
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    //echo $row2['answer_desc'];                        
                    echo '<div class="form-check mt-3 ml-3 py-2 rounded-pill">
            <input class="form-check-input " type="radio" name="quizcheck[' . $row2['question_id'] . ']" id="' . $row2['answer_id'] . '" value="' . $row2['answer_id'] . '">
            <label class="form-check-label" for="' . $row2['answer_id'] . '">
            ' . $row2['answer_desc'] . '
            </label>
          </div>
          ';
                }
                echo '</div></div>';
                $noq++;
                
            }
            ?>        
    </div>

    <?php
    //To display correct answers &#10004;
    $sql = "SELECT * FROM `question` WHERE `quiz_id` = $quizid";
    $result = mysqli_query($conn, $sql);    
    $numrows = mysqli_num_rows($result);
    // echo'hi'.$numrows.$qid;
    while ($row = mysqli_fetch_assoc($result)) {
        // echo "<br>".$row['answer_id'];
    ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $(' #<?php echo intval($row['answer_id']); ?>').parent().css("background-color", "#28a745").css("color", "white");                
            });
        </script>
    <?php
    }

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
    <!-- Script for disable all radio buttons -->
    <script>
        var btns = document.querySelectorAll('input[type="radio"]');
        //console.log(document.getElementById('1').parentNode.textContent += '&#10004;');
        for (var i = 0; i < btns.length; i++) {
            //btns[i].disabled = true;
            btns[i].parentNode.classList.add("blu");
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#showans').click(function() {
                $("#qnacontainer").toggleClass('d-none');
            });
        });
    </script>
</body>

</html>