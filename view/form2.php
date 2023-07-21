<?php
session_start();
ini_set('display_errors', '1');
error_reporting(E_ALL);
require('../../includes/configure.php');
require('../class/DatabaseConn.php');
require('../class/SurveyQuestionSave.php');
require('../class/SurveyGetFormInfo.php');
require('../class/SaveSurveyName.php');
$dbConnection = new DatabaseConn();
$getForm = new SurveyGetFormInfo();
$options = $getForm->getFormOption($dbConnection);
$surveyData = $getForm->getLastSurveyName($dbConnection);
$lastQuestion = '';
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'];
$currentURL = $protocol . $host . '/survey.php?ankieta=' . $surveyData['id'];

if (isset($_SESSION['lastQuestion']) && $_SESSION['lastQuestion'] != '') {
    echo $_SESSION['lastQuestion'];
}

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

<body>
    <div id="form2" class="hidden">
        <?php

        if (isset($_SESSION['success']) && $_SESSION['success'] === true) {
            $msg = '<br>Twoja ankieta "' . $surveyData['name'] . '" z nr ' . $surveyData['id'];
            echo $msg;
        }

        ?><br><br>
        <form id="survey-details-form" class="" method="post" action="../save_question_answer.php">
            <input type="text" name="question_id" placeholder="ID pytania" required>
            <input type="hidden" name="survey_id" value="<?= $surveyData['id']?>">
            <input type="text" name="question" placeholder="Treść pytania" required>
            <select name="options" id="options">
                <?php
                foreach ($options as $option) {
                    echo '<option value="'.$option[0].'">' . $option[1]
                        . '</option>';
                }
                ?>
            </select>
            <input type="text" name="question_name" placeholder="określ nazwe pytania" required><br><br><br>
            <div id="answer">
                <input type="text" name="answer[]" placeholder="Odpowiedz 1" ><br><br>
                <input type="text" name="answer[]" placeholder="Odpowiedz 2" ><br><br>
                <input type="text" name="answer[]" placeholder="Odpowiedz 3" ><br><br>
                <input type="text" name="answer[]" placeholder="Odpowiedz 4" ><br><br>
                <input type="text" name="answer[]" placeholder="Odpowiedz 5" ><br><br>
            </div>
            <button type="submit">Dodaj kolejne</button>
            <button onclick="pokaAnkiete()">Pokaż ankiete</button>
        </form>

    </div>
    <script>
        function pokaAnkiete() {
            window.location.href = "<?= $currentURL ?>";
        }
    </script>
    <script>

        const optSelect = document.getElementById('options');
        const answerDiv = document.getElementById('answer');

        optSelect.addEventListener('change', function () {
            console.log(optSelect.value);
            if (optSelect.value == 3) {
                answerDiv.style.display = 'none';
            } else {
                answerDiv.style.display = 'block';
            }
        });
    </script>
</body>

</html>
