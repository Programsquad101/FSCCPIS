<?php
$url = "http///$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$tutor_id = substr($url, strrpos($url, '?' )+1)."\n";
$tutor_id = substr($tutor_id.'/', 0, strpos($tutor_id, '/'));

$schedule_id = substr($url, strrpos($url, '/' )+1)."\n";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Check out what is going on with the CPIS Department at Farmingdale">
    <meta name="viewport" content="wvalueth=device-wvalueth, initial-scale=1">
    <meta name="author" content="cpis.com">

    <title>Farmingdale CPIS</title>
    <link rel="stylesheet" type="text/css" media="screen" href="css/survey.css">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/index.js"></script>

</head>

<body>
    <main>
        <div class="header">
            <h2 style="text-align:center;">Tutor Evaluation Survey</h2>
        </div>
        <div class="container">
            <div class="group">
                <div>
                    <h4>Please use this scale in your evaluation:</h4>
                    5 - Strongly Agree<br>
                    4 - Agree<br>
                    3 - Neither Agree Nor Disagree<br>
                    2 - Disagree<br>
                    1 - Strongly Disagree<br>
                </div>
                <br>
                <div>
                        This Evaluation is confidential: when you submit the evaluation, your identity is removed from your answers
                        so your Tutor will not see your name. <br><br>
                        Click "Mark Complete" button when you have finished answering all questions.
                </div>
            </div>
            <hr style="width:90%;margin-bottom: 30px;">
            <div class="group">
                <div> Tutor Uses time effectively. </div>
                <form method="POST" action="scripts/survey-input.php?<?php echo "$tutor_id/$schedule_id"?>">
                    1.<input type="radio" class="form-radio" name="time_effective" value="1">
                    2.<input type="radio" class="form-radio" name="time_effective" value="2">
                    3.<input type="radio" class="form-radio" name="time_effective" value="3">
                    4.<input type="radio" class="form-radio" name="time_effective" value="4">
                    5.<input type="radio" class="form-radio" name="time_effective" value="5">
                    <br>
                    <br><br>
                    <div>The Tutor's course material was well-organized.</div>
                    1.<input type="radio" class="form-radio" name="organized" value="1">
                    2.<input type="radio" class="form-radio" name="organized" value="2">
                    3.<input type="radio" class="form-radio" name="organized" value="3">
                    4.<input type="radio" class="form-radio" name="organized" value="4">
                    5.<input type="radio" class="form-radio" name="organized" value="5">
                    <br>
                    <br><br>
                    <div>The Tutor seemed to care about my learning.</div>
                    1.<input type="radio" class="form-radio" name="caring" value="1">
                    2.<input type="radio" class="form-radio" name="caring" value="2">
                    3.<input type="radio" class="form-radio" name="caring" value="3">
                    4.<input type="radio" class="form-radio" name="caring" value="4">
                    5.<input type="radio" class="form-radio" name="caring" value="5">
                    <br>
                    <br><br>
                    <div>The Tutor responded effectively to questions raised in class.</div>
                    1.<input type="radio" class="form-radio" name="questions_effective" value="1">
                    2.<input type="radio" class="form-radio" name="questions_effective" value="2">
                    3.<input type="radio" class="form-radio" name="questions_effective" value="3">
                    4.<input type="radio" class="form-radio" name="questions_effective" value="4">
                    5.<input type="radio" class="form-radio" name="questions_effective" value="5">
                    <br>
                    <br><br>
                    <div> The pace at which the Tutor covered the material was good </div>
                    1.<input type="radio" class="form-radio" name="pace" value="1">
                    2.<input type="radio" class="form-radio" name="pace" value="2">
                    3.<input type="radio" class="form-radio" name="pace" value="3">
                    4.<input type="radio" class="form-radio" name="pace" value="4">
                    5.<input type="radio" class="form-radio" name="pace" value="5">

                    <br>
                    <br><br>
                    <div>Overall, I would rate this Tutor highly.</div>
                    1.<input type="radio" class="form-radio" name="rating" value="1">
                    2.<input type="radio" class="form-radio" name="rating" value="2">
                    3.<input type="radio" class="form-radio" name="rating" value="3">
                    4.<input type="radio" class="form-radio" name="rating" value="4">
                    5.<input type="radio" class="form-radio" name="rating" value="5">
                    <br>
                    <button name="tutor-btn" type="submit">Mark Complete</button>
                </form>
            </div>
    </main>
</body>

</html>
