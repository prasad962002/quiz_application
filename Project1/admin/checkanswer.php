<?php
include("../partials/_dbconnect.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $qid = $_POST['qid'];
    $tresult = 0;
    //echo $qid;

    if (empty($_POST['quizcheck'])) {
        $tresult = 0;
        echo "You have not selected any answers";
    } else {
        $selected = $_POST['quizcheck'];
        //echo var_dump($selected[2]);
        $sql = "SELECT * FROM `question` WHERE `quiz_id` = $qid";
        $result = mysqli_query($conn, $sql);
        $numrows = mysqli_num_rows($result);

        while ($row = mysqli_fetch_assoc($result)) {
            for ($i = 1; $i <= $numrows; $i++) {
                if (empty($selected[$i])) {
                    //echo $i;
                } else {
                    $check = $row['answer_id'] == intval($selected[$i]);
                    //var_dump($check);
                    if ($check) {
                        //echo $selected[$i];
                        $tresult++;
                    }
                }
            }
        }
        echo 'Out of ' . $numrows . ' you have selected ' . count($_POST['quizcheck']) . '<br>';
        echo 'result: ' . $tresult . '/' . $numrows;
    }
}
