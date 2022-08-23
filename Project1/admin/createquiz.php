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

  <title>Admin -Create Quiz</title>
</head>

<body>
  <?php
  include("../partials/_adminheader.php");
  include("../partials/_dbconnect.php");
  ?>
  <form action="../partials/_submitquiz.php" method="POST" autocomplete="off">
    <div class="container mt-5">
      <!-- Quiz topic -->
      <div class="input-group mb-3 input-group-lg">
        <div class="input-group-prepend">
          <span class="input-group-text bg-dark text-white" id="basic-addon1">Quiz topic</span>
        </div>
        <input type="text" class="form-control" id="quiz_topic" aria-describedby="basic-addon1" name="quiz_topic" placeholder="Enter Quiz topic" required>
      </div>
      <div class="row">
        <div class="input-group mb-3 input-group-lg col">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white" id="basic-addon3">Time</span>            
        </div>
        <input type="number" class="form-control col-md-4" id="quiz_time" name="quiz_time" aria-describedby="basic-addon3" placeholder="Time(in mins)" required onkeydown="timevalidate(this)" maxlength="5" min="0" max="200">
      </div>
      <div class="input-group mb-3 input-group-lg col">
        <div class="input-group-prepend">
          <span class="input-group-text bg-dark text-white" id="basic-addon3">Status</span>
        </div>
        <select class="custom-select col-md-4" id="quizstatus" name="quiz_status">
                <!-- <option selected>Choose...</option> -->
                <option value="1" selected class="text-center">Enable</option>
                <option value="0"  class="text-center">Disable</option>              
              </select>
      </div>

      <div class="input-group mb-3 input-group-lg col">
        <div class="input-group-prepend">
          <span class="input-group-text bg-dark text-white" id="basic-addon3">Categories</span>
        </div>
        <select class="custom-select col-md-8" id="quizstatus" name="quiz_category">
            <?php
             $sql = "SELECT * FROM `category`";
             $result = mysqli_query($conn, $sql);
             $numrows = mysqli_num_rows($result);
             if ($numrows > 0) {
               while ($row = mysqli_fetch_assoc($result)) {
                echo'<option value="'.$row['cat_id'].'"  class="text-center">'.$row['cat_desc'].'</option>';
               }
              }
            ?>                       
              </select>
      </div>
    </div>
    </div>

    <!-- Question input -->
    <div class="container col-md-6 mx-auto mt-5 pb-5" id="outcontainer">
      <div class="card mb-3 mx-auto mb-5 qacontainer" id="qcontainer1" style="border: 1px ridge black; border-radius:12px">
        <div class="card-body">
          <div class="card-text px-5">
            <div class="form-group row">
              <!-- Question input -->
              <label for="question1">Question 1 &nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" class="form-control col-md-9" id="question1" name="question1" placeholder="Enter question" required>
            </div>
            <hr style="border:1px solid darkgrey;" class="mb-4">
            <!-- Options input-->
            <div class="form-group row ">
              <label for="question1option1">Option 1 &nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" class="form-control col-md-8" id="question1option1" name="question1option1" placeholder="Enter option" required>
            </div>
            <div class="form-group row">
              <label for="question1option2">Option 2 &nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" class="form-control col-md-8" id="question1option2" name="question1option2" placeholder="Enter option" required>
            </div>
            <div class="form-group row">
              <label for="question1option3">Option 3 &nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" class="form-control col-md-8" id="question1option3" name="question1option3" placeholder="Enter option">
            </div>
            <div class="form-group row">
              <label for="question1option4">Option 4 &nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" class="form-control col-md-8" id="question1option4" name="question1option4" placeholder="Enter option">
            </div>

            <!-- Select correct answer -->
            <div class="input-group ">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Choose correct answer</label>
              </div>
              <select class="custom-select" id="inputGroupSelect01"  name="question1correctoption">
                <!-- <option selected>Choose...</option> -->
                <option value="question1option1" selected class="text-center">Option1</option>
                <option value="question1option2" class="text-center">Option2</option>
                <option value="question1option3" class="text-center">Option3</option>
                <option value="question1option4" class="text-center">Optiom4</option>
              </select>
            </div>
          
          </div>
        </div>
      </div>
    </div>
    <div class="upperbtn fixed-bottom bg-dark mx-auto p-3">
      <div class="mx-auto text-center">
        <button type="button" class="btn btn-danger mr-2" onclick="deletequestion()">Delete Question</button>
        <button type="submit" class="btn btn-primary mx-2">Submit</button>
        <button type="button" class="btn btn-success ml-2" onclick="addquestion()">Add Question</button>
      </div>
    </div>
    <!-- input to check number of questions -->
    <input type="hidden" name="questioncount" id="questioncount" value="1">
  </form>

  <script type="text/javascript">
    var i = 1;
    // Add question function
    function addquestion() {      
      var qna = document.getElementsByClassName('qacontainer');
      if (qna.length >= 20) {
        alert("Maximum 20 questions per quiz is allowed");
      } 
      else {
        const div = document.getElementById('qcontainer1');
        const clone = div.cloneNode(true);
        //clone.id = "foo2";
        document.getElementById('outcontainer').appendChild(clone);
        //var qna = document.getElementsByClassName('qacontainer');
        let lastelmnt = qna[qna.length - 1];
        //console.log(qna[qna.length-1]);
        //let prevdivid = lastelmnt.previousElementSibling.id;
        i++;
        lastelmnt.id = 'qacontainer' + String(i);
        let currdivid = lastelmnt.id;
        let allelmnt = document.getElementById(currdivid).querySelectorAll("*");
        for (let e = 0; e < allelmnt.length; e++) {
          console.log(e, allelmnt[e]);          
        }
        // console.log(allelmnt[4], allelmnt[8], allelmnt[11], allelmnt[14], allelmnt[17], allelmnt[21], allelmnt[25]);
        let j = 1;
        for (let elmnt = 22; elmnt <= 25; elmnt++) {
          allelmnt[elmnt].value = 'question' + String(i) + 'option' + String(j);
          j++;
          //console.log(allelmnt[elmnt]);
        }

        //Set question number text and label for attribute
        allelmnt[3].innerHTML = "Question" + String(i) + "&nbsp;&nbsp;&nbsp;&nbsp;";
        //console.log(allelmnt[3]);

        //4,8,11, 14,17,21,25
        //Set id for clone div
        allelmnt[4].id = 'question' + String(i);
        allelmnt[8].id = 'question' + String(i) + 'option1';
        allelmnt[11].id = 'question' + String(i) + 'option2';
        allelmnt[14].id = 'question' + String(i) + 'option3';
        allelmnt[17].id = 'question' + String(i) + 'option4';
        allelmnt[21].id = 'question' + String(i) + 'correctoption';

        //

        //set name for clone div
        allelmnt[4].name = 'question' + String(i);
        allelmnt[8].name = 'question' + String(i) + 'option1';
        allelmnt[11].name = 'question' + String(i) + 'option2';
        allelmnt[14].name = 'question' + String(i) + 'option3';
        allelmnt[17].name = 'question' + String(i) + 'option4';
        allelmnt[21].name = 'question' + String(i) + 'correctoption';

        // set all label attribute value for clone div
        allelmnt[3].setAttribute("for", "question" + String(i));
        allelmnt[7].setAttribute("for","question" + String(i) + "option1");
        allelmnt[10].setAttribute('for','question' + String(i) + 'option2');
        allelmnt[13].setAttribute('for','question' + String(i) + 'option3');
        allelmnt[16].setAttribute('for','question' + String(i) + 'option4');
        allelmnt[20].setAttribute('for','question' + String(i) + 'correctoption');

        //Empty input value for clone div
        const selectedelmnts = [4,8,11,14,17];
        selectedelmnts.forEach(itrtfunction);
        function itrtfunction(value, index, array){
          allelmnt[value].value = ''; 
          console.log(allelmnt[value]);
        }
        //allelmnt[21].value = 'question' + String(i) + 'correctoption';

        //allelmnt[4].value = '';

        // set Question count
        document.getElementById('questioncount').value = i;

        //Focus on new question container
        window.location.hash = currdivid;
      }
    }

    //Delete last question
    function deletequestion() {
      var qna = document.getElementsByClassName('qacontainer');
      let last = qna.length - 1;
      //console.log(qna);
      if (qna.length > 1) {
        console.log(qna[last]);
        qna[last].remove();
        i--;
        document.getElementById('questioncount').value = i;

      } else {
        alert("Cannot delete... Atleast one question should be in quiz");
      }
    }


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