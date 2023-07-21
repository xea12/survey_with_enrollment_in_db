<?php
session_start();
ini_set('display_errors', '1');
error_reporting(E_ALL);
require('../includes/configure.php');
require('class/DatabaseConn.php');

if (isset($_POST['survey-name']) && $_POST['survey-name'] !== '') {
    $surveyName = $_POST['survey-name'];

    $db = new DatabaseConn();
    $conn = $db->getMysqli();

    $stmt = $conn->prepare("INSERT INTO survey_name (name) VALUES (?)");
    $stmt->bind_param("s", $surveyName);

    if ($stmt->execute()) {

        echo "Dane zapisane!";
        $_SESSION['success'] = true;
    } else {

        echo "Błąd: " . $conn->error;
    }

    $conn->close();
    $_SESSION['msg'] = '';
    header('Location: /survey/view/form2.php');
} else {
    $_SESSION['msg'] = "Podaj nazwe ankiety !!";
    header('Location: /add_survey.php');
}


