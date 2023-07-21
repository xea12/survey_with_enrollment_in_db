<?php
session_start();
unset($_SESSION['lastQuestion']);
if (isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
} else {
    $msg = '';
}
echo $msg;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1">
    <title>Ankieta DrTusz</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="survey/style.css">
</head>

<body><br><br>
    <div id="form1">
        <form id="survey-name-form" class="" method="post" action="survey/save_survey_name.php">
            Podaj nazwe ankiety:<br><br>
            <input type="text" name="survey-name"><br><br>
            <button type="submit">zapisz</button>
        </form>
    </div>
</body>

</html>

