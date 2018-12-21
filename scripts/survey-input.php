<?php
require_once 'database.php';

$url = "http///$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$id = substr($url, strrpos($url, '?' )+1)."\n";
$id = substr($id.'/', 0, strpos($id, '/'));

$schedule_id = substr($url, strrpos($url, '/' )+1)."\n";

  if(isset($_POST['advisor-btn'])){
    $organized = $_POST['organized'];
    $helpful = $_POST['helpful'];
    $rating = $_POST['rating'];

    $sum = $organized + $helpful + $rating;
    $total_rating = $sum / 3;

      $sql = "INSERT INTO tblAdvisorSurvey(total_rating, advisor_id, helpful, rating, organized) VALUES(?,?,?,?,?);";
      $stmt = mysqli_stmt_init($con);
      if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "no preprear";
      } else{
        mysqli_stmt_bind_param($stmt, "diiii", $total_rating, $id, $helpful, $rating, $organized);
        mysqli_stmt_execute($stmt);
      }

      $sql = "UPDATE tblAdvisors SET totalAppointments = totalAppointments + 1, totalRatings = totalRatings + ?, rating = ROUND(totalRatings / totalAppointments,1) WHERE advisor_id = ?;";
      $stmt = mysqli_stmt_init($con);
      if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "no preprear";
      } else{
        mysqli_stmt_bind_param($stmt, "ii", $rating, $id);
        mysqli_stmt_execute($stmt);
        //Delete the appointment
        $sql = "DELETE FROM tblAdvisorScheduled WHERE schedule_id = ?;";
        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt, $sql)){
          echo "bad prepare";
        } else{
          mysqli_stmt_bind_param($stmt, "i", $schedule_id);
          mysqli_stmt_execute($stmt);
          header("Location:../student");
          exit();
        }
      }

    }

    if(isset($_POST['tutor-btn'])){
      $time_effective = $_POST['time_effective'];
      $organized = $_POST['organized'];
      $caring = $_POST['caring'];
      $questions_effective = $_POST['questions_effective'];
      $pace = $_POST['pace'];
      $rating = $_POST['rating'];
      $sum = $time_effective + $organized + $caring + $questions_effective + $pace + $rating;

      //Calculate the average by dividing $sum by the
      //amount of numbers that are in our set.
      $total_rating = $sum / 6;

        $sql = "INSERT INTO tblTutorSurvey(total_rating, tutor_id, time_effective, organized, caring, questions_effective, pace, rating) VALUES(?,?,?,?,?,?,?,?);";
        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt, $sql)){
          echo "no preprear";
        } else{
          mysqli_stmt_bind_param($stmt, "diiiiiii", $total_rating, $id, $time_effective, $organized, $caring, $questions_effective, $pace, $rating);
          mysqli_stmt_execute($stmt);
        }

        $sql = "UPDATE tblTutors SET totalAppointments = totalAppointments + 1, totalRatings = totalRatings + ?, rating = ROUND(totalRatings / totalAppointments,1) WHERE tutor_id = ?;";
        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt, $sql)){
          echo "no preprear";
        } else{
          mysqli_stmt_bind_param($stmt, "ii", $rating, $id);
          mysqli_stmt_execute($stmt);
          //Delete the appointment
          $sql = "DELETE FROM tblTutorScheduled WHERE schedule_id = ?;";
          $stmt = mysqli_stmt_init($con);
          if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "bad prepare";
          } else{
            mysqli_stmt_bind_param($stmt, "i", $schedule_id);
            mysqli_stmt_execute($stmt);
            header("Location:../student");
            exit();
          }
        }
      }








?>
