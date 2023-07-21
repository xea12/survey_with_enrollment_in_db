<?php
//var_dump($_POST);
session_start();
require('../includes/configure.php');
require('class/DatabaseConn.php');
require('class/SurveyQuestionSave.php');
$db = new DatabaseConn();

$conn = $db->getMysqli();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Zbieranie danych z formularza
    $survey_id = $_POST['survey_id'];
    $question_id = $_POST['question_id'];
    $question = $_POST['question'];
    $question_name = $_POST['question_name'];
    $selected_option = $_POST['options'];
    $answers = $_POST['answer'];
    $filteredAnswers = array_filter($answers);
    $last = $question_id. ' - '.$question . '<br>';
    $countAnswer = count($filteredAnswers);
    $question = new SurveyQuestionSave($survey_id, $question_id, $question, $selected_option, $question_name);
    $question->saveQuestion($db);

    if ($countAnswer > 0) {

        for($i=0; $i<$countAnswer+1; $i++){
            $sort_id = $i +1;
            $stmt = $conn->prepare("INSERT INTO survey_answer (question_id, sort_id, answer, survey_id) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iisi", $question_id, $sort_id, $filteredAnswers[$i], $survey_id);
            $stmt->execute();
            $stmt->close();
        }
    }

    $_SESSION['add'] = true;
    $_SESSION['lastQuestion'] .= $last;

}
header('Location: view/form2.php');
