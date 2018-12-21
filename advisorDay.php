<?php

require_once 'scripts/database.php';
require_once 'scripts/app_config.php';

$advisor_search = $_POST['day'];
$advisor_search = '%'.$advisor_search.'%';
$sql = "SELECT aa.available_id, a.advisor_id, a.firstName,a.lastName,a.email,aa.availableDate, aa.availableTime, aa.room, a.rating, a.totalAppointments FROM tblAdvisorAvailable aa JOIN tblAdvisors a ON aa.advisor_id = a.advisor_id  WHERE availableDate LIKE ?;";
$stmt = mysqli_stmt_init($con);
if(!mysqli_stmt_prepare($stmt, $sql)){
  echo "ERROR PREPAREs";
  echo mysqli_error($con);
} else{
  mysqli_stmt_bind_param($stmt, "s", $advisor_search);
  mysqli_stmt_execute($stmt);
  if(!mysqli_stmt_bind_result($stmt, $available_id, $advisor_id,$advisor_firstName, $advisor_lastName, $advisor_email, $advisor_availableDate, $advisor_availableTime, $advisor_room, $rating, $totalAppointments)){
    echo "Error binding result";
    } else{
      $advisor_firstName = htmlspecialchars($advisor_firstName, ENT_QUOTES, 'UTF-8');
      $advisor_lastName = htmlspecialchars($advisor_lastName, ENT_QUOTES, 'UTF-8');
      $advisor_email = htmlspecialchars($advisor_email, ENT_QUOTES, 'UTF-8');
      $advisor_search = str_replace('%', '', $advisor_search);
      echo "<div style='font-size:20px; font-weight:bold;'>$advisor_search</div>";

      while(mysqli_stmt_fetch($stmt)){
        //print out advisors
        echo "
        <div class='appointment_wrapper'>
          <div class='date'>
            <span> $advisor_availableDate</span>
          </div>
          <div class='details'>
            <div style='font-size: 22px;font-weight: bold;margin-bottom:5px; '> $advisor_firstName $advisor_lastName </div>

            <div class='icons2'>
              <i class='far fa-envelope'></i>
            </div>
            <div class='infos2'>
              $advisor_email
              &nbsp;
            </div>


            <div class='icons2'>
              <i class='far fa-calendar-o'></i>
            </div>
            <div class='infos2'>
              $advisor_availableDate
              &nbsp;
            </div>

            <div class='icons2'>
              <i class='far fa-clock-o'></i>
            </div>
            <div class='infos2'>
              $advisor_availableTime
              &nbsp;
            </div>

            <div class='icons2'>
              <i class='fas fa-search-location'></i>
            </div>
            <div class='infos2'>
              $advisor_room
              &nbsp;
            </div>
            <div class='icons2'>
              Rating:
            </div>
            <div class='infos2'>
              $rating out of 5
              &nbsp;
            </div>
            <div class='icons2'>
              Total Appointments:
            </div>
            <div class='infos2'>
              $totalAppointments
              &nbsp;
            </div>

          </div>
          <div class='selection'>
            <div style='font-size:20px'>                    <a href='scripts/request_advisor_appointment.php?$advisor_id/$available_id'>Request Appointment</a></div>
            <!-- <i class='far fa-calendar-check fa-lg'></i> -->
          </div>
        </div>
        <div id='survey' style='visibility:hidden;'>Request Appointment</div>
        ";
      }
  }
}

?>
