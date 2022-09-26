<?php
if (isset($_POST["save_date"])) {
  include_once '../cus_header.php';
  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  $date_of_diagnosis = $_POST["date_of_diagnosis"];
  $patient_username = $_SESSION["useruid"];

  if (emptyInputDate($date_of_diagnosis) !== false) {
    header("location: ../patient_report.php?error=emptyinput");
    exit();
  }

  checkActivePatient($conn, $date_of_diagnosis ,$patient_username);

  dateCheck($date_of_diagnosis);

  saveDate($conn, $patient_username, $date_of_diagnosis);

}

else{
  header("location: ../cus_process.php");
}
