<?php

  $username = $_SESSION["useruid"];
  include 'includes/dbh.inc.php';

  //$query = "SELECT visit_by.v_date, visit_by.v_time, poi.pname FROM visit_by INNER JOIN poi ON visit_by.v_poi = poi.id WHERE v_username = '$username';";
  $query1 = "SELECT v_username, v_poi_name, v_date, v_time FROM visit_by;";
  $run1 = mysqli_query($conn,$query1);
  $visit_by = array();
  if (mysqli_num_rows($run1) > 0) {
    while($row = mysqli_fetch_assoc($run1)) {
      array_push($visit_by, array('v_username' =>  $row['v_username'],'v_poi_name' =>  $row['v_poi_name'], 'v_date' => $row['v_date'], 'v_time' => $row['v_time']));
    }
  }

  $query2 = "SELECT patient_username, date_of_diagnosis FROM patient;";
  $run2 = mysqli_query($conn,$query2);
  $patient = array();
  if (mysqli_num_rows($run2) > 0) {
    while($row = mysqli_fetch_assoc($run2)) {
      array_push($patient, array('patient_username' =>  $row['patient_username'],'patient_username' =>  $row['patient_username']));
    }
  }

?>
