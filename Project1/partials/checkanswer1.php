<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    include("_dbconnect.php");
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $qid = $_POST['qid'];
        $tresult = 0;              
        // echo var_dump($_POST);
        $email = $_SESSION['email'];
        if (empty($_POST['quizcheck'])) {
            $tresult = 0;
            echo "You have not selected any answers";
            //Query for 0 result
        } else {
            $selected = $_POST['quizcheck'];
            echo var_dump($selected) . "Selected<br>";
            $numselected = count($_POST['quizcheck']);
            echo var_dump($selected);
            $sql = "SELECT * FROM `question` WHERE `quiz_id` = $qid";
            $result = mysqli_query($conn, $sql);
            $numrows = mysqli_num_rows($result);

            $no = 1;
            //Create empty variables
            for ($z = 1; $z <= 20; $z++) {
                # code...
                ${"question$z"} = 'question' . $z;
                ${"selectedoption$z"} = "";
            }
            while ($row = mysqli_fetch_assoc($result)) {
                $cqid = $row['question_id'];                
                if (empty($selected[$cqid])) {
                    ${"question$no"} = 'question' . $no;
                    ${"selectedoption$no"} = "";
                    echo "<br>empty:" . ${"question$no"};
                    $no++;
                }
                else{
                    if ($row['answer_id'] == intval($selected[$cqid])) {
                        $tresult++;
                    }
                    ${"question$no"} = 'question' . $no;
                    echo "<br>question no" . ${"question$no"};
                    ${"selectedoption$no"} = strval($selected[$cqid]);
                    echo ':selectedoption' . ${"selectedoption$no"};
                    $no++;
            }
            }
            
            echo 'Out of ' . $numrows . ' you have selected ' . $numselected . '<br>';
            echo 'result: ' . $tresult . '/' . $numrows;
echo "<br>";
            for ($exno = 1; $exno <= 20; $exno++) {
                echo ${"question$exno"};
                echo ${"selectedoption$exno"};
                echo "<br>";
            }

            $sql = "INSERT INTO `resultrecord` (`email`, `quiz_id`, `selected_question`, `correct_ans`) VALUES ('$email', '$qid', $numselected, $tresult);";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $lastsql = "SELECT * FROM `resultrecord` WHERE `email` LIKE '$email' ORDER BY id DESC LIMIT 1;";
                $lastidresult = mysqli_query($conn, $lastsql);
                $lastrow = mysqli_fetch_assoc($lastidresult);
                $lastid = $lastrow['id'];
                echo $lastid;

                for ($exno = 1; $exno <= 20; $exno++) {
       
                    $ans = ${"selectedoption$exno"};
                    $qsql = "UPDATE `resultrecord` SET `${"question$exno"}` = '$ans' WHERE `resultrecord`.`id` = $lastid";
                    $qresult = mysqli_query($conn, $qsql);
                    if ($qresult) {
                        echo "Record inserted".$exno;
                    }
                }
                header("location:../userquiz.php?qsubmit=success");
                exit();
            }            
            header("location:../userquiz.php?qsubmit=fail");
                    }
                }
            }



            // echo var_dump($selected);
            // $keys = array_keys($selected);
            // //Selected option
            // $values = array_values($selected);
            // $k = 1;
            // foreach ($values as $key => $value) {
            //     # code...

            //     ${"question$k"} = 'question'. $k;
            //     echo "<br>".${"question$k"};
            //     ${"option$k"} = strval($value);
            //     echo ':' . ${"option$k"};
            //     $k++;
            // }

            // $sql = "INSERT INTO `resultrecord` (`email`, `quiz_id`, `selected_question`, `correct_ans`) VALUES ('$email', '$qid', $numselected, $tresult);";
            // $result = mysqli_query($conn, $sql);
            // if ($result) {        
            //     $lastsql = "SELECT * FROM `resultrecord` WHERE `email` LIKE '$email' ORDER BY id DESC LIMIT 1;";
            //     $lastidresult = mysqli_query($conn, $lastsql);
            //     $lastrow = mysqli_fetch_assoc($lastidresult);
            //     $lastid = $lastrow['id'];
            //     $q =1;
            //     foreach ($keys as $key => $value){
            //         $ans = ${"option$q"};
            //          $ans = (string)$ans;
            //         $qsql = "UPDATE `resultrecord` SET `${"question$value"}` = '$ans' WHERE `resultrecord`.`id` = '$lastid';";
            //         $qresult = mysqli_query($conn, $qsql);
            //         if ($qresult) {
            //             echo "Record inserted";
            //             echo "s";
            //         }
            //         $q++;
            //     }
            
            //comment
            // for ($q = 1; $q <= count($keys); $q++) {
            //     # code...
            //      $ans = ${"option$q"};
            //      $ans = (string)$ans;
            //     $qsql = "UPDATE `resultrecord` SET `${"question$q"}` = '$ans' WHERE `resultrecord`.`id` = '$lastid';";
            //     $qresult = mysqli_query($conn, $qsql);
            //     if ($qresult) {
            //         echo "Record inserted";
            //         echo "s";
            //     }
            // }


            //    }
