<?php

require_once 'scripts/database.php';
require_once 'scripts/app_config.php';

$allowed = 'Accept';
$tutorDay = $_POST['tutorDay'];
$tutorDayPrint = $_POST['tutorDay'];
$tutorDay = '%'.$tutorDay.'%';
echo "<div style='font-size:20px; font-weight:bold;'>$tutorDayPrint</div>";

  $sql = "SELECT s.skills, a.available_id,a.availableDate, a.availableTime, t.tutor_id, t.firstName, t.lastName, t.pricing, t.status, t.email, t.rating, t.totalAppointments FROM tblTutors t JOIN tblTutorAvailable a ON t.tutor_id = a.tutor_id JOIN tblSkills s ON s.tutor_id = t.tutor_id WHERE allowed = ? AND a.availableDate LIKE ?;";
  $stmt = mysqli_stmt_init($con);
  if(!mysqli_stmt_prepare($stmt, $sql)){
    echo mysqli_error($con);
  } else{
    mysqli_stmt_bind_param($stmt, "ss", $allowed, $tutorDay);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $skills, $available_id, $date, $time, $tutor_id,$firstName, $lastName, $pricing, $status, $email,$rating, $totalAppointments);
    while(mysqli_stmt_fetch($stmt)){
      echo "
      <div class='appointment_wrapper'>
        <div class='date'>
          <span> $date</span>
        </div>
        <div class='details'>
          <div style='font-size: 22px;font-weight: bold;margin-bottom:5px; '> $firstName $lastName</div>

          <div class='icons2'>
            <i class='far fa-envelope'></i>
          </div>
          <div class='infos2'>
            $email
            &nbsp;
          </div>


          <div class='icons2'>
            <i class='far fa-calendar-o'></i>
          </div>
          <div class='infos2'>
            $day
            &nbsp;
          </div>

          <div class='icons2'>
            <i class='far fa-clock-o'></i>
          </div>
          <div class='infos2'>
            $time
            &nbsp;
          </div>

          <div class='icons2'>
            <i class='fas fa-search-location'></i>
          </div>
          <div class='infos2'>
            Whitman Hall 123
          </div>
          <br>
          <div class='icons2'>
            <i class='fas fa-dollar-sign'></i>
          </div>
          <div class='infos2'>
            $pricing
            &nbsp;
          </div>
          <div class='icons2'>
            <i class='fas fa-code'></i>
          </div>
          <div class='infos2'>
            $skills
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
          <div style='font-size:20px'><a href='scripts/request_tutor_appointment.php?$tutor_id/$available_id'>Request Appointment</a></div>
          <!-- <i class='far fa-calendar-check fa-lg'></i> -->
        </div>
      </div>
      <div id='survey' style='visibility:hidden;'>Request Appointment</div>
    ";
  }
}

?>
