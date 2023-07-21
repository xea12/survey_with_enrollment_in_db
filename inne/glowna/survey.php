<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);
require ('includes/application_top.php');
require('survey/class/DatabaseConn.php');
require('survey/class/SurveyResponse.php');
require('survey/class/FormGenerator.php');
require('survey/class/FormValidator.php');
$dbConnection = new DatabaseConn();
$surveyId = isset($_GET['ankieta']) ? $_GET['ankieta'] : '1';
$formGenerator = new FormGenerator($surveyId, $dbConnection);
$email = '';
$response = '';
$q1 = $formGenerator->getQuestion(1);
$a1 = $formGenerator->getAnswer(1);

$q2 = $formGenerator->getQuestion(2);
$a2 = $formGenerator->getAnswer(2);

$q3 = $formGenerator->getQuestion(3);
$a3 = $formGenerator->getAnswer(3);

$q4 = $formGenerator->getQuestion(4);
$a4 = $formGenerator->getAnswer(4);

if (isset($_SESSION['customer_id'])) {
    $customerId = $_SESSION['customer_id'];
    $emailQuery = "select customers_email_address from customers where customers_id = ". $_SESSION['customer_id'];
    $emailRes = $dbConnection->getMysqli()->query($emailQuery);
    $email = $emailRes->fetch_array()[0];
} else {
    $customerId = '';
}


$question_name = $formGenerator->getAllQuestionNameFromSurvey();
$rr = [];
foreach ($question_name as $item) {
    $rr[] = $item['question_name'];
}
//var_dump($rr);
if (isset($_POST['submit'])) {
    $requiredFields = ['rating', 'hear_about_us', 'recommend', 'email', 'comments'];
    if (FormValidator::areFieldsFilled($requiredFields, $_POST)) {

        $rating = $_POST['rating'];
        $hearAboutUs = $_POST['hear_about_us'];
        $recommend = $_POST['recommend'];
        $contactPref = isset($_POST['contact_pref']) ? $_POST['contact_pref'] : array();
        $email = $_POST['email'];

        $comments = $_POST['comments'];
        $contactPrefString = implode(',', $contactPref);
        $questions = [
            $_POST['question_1'] => $rating,
            $_POST['question_2'] => $hearAboutUs,
            $_POST['question_3'] => $recommend,
            $_POST['question_4'] => $contactPrefString
        ];

/*        $questions = [];
        foreach ($question_name as $item) {
            $_

        }
            $_POST['question_1'] => $rating,
            $_POST['question_2'] => $hearAboutUs,
            $_POST['question_3'] => $recommend,
            $_POST['question_4'] => $contactPrefString*/


        $surveyResponse = new SurveyResponse($surveyId, $customerId, $email, $comments, $contactPref, $questions);
        $surveyResponse->saveResponse($dbConnection);

        $response = "Dziekujemy za wypełnienie ankiety";
    }
}

var_dump($questions);



$dbConnection->closeConnection();
?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>Ankieta DrTusz</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link rel="stylesheet" href="/survey/style.css">
	</head>
	<body>

    <script type="text/javascript" src="survey/js/script.js"></script>
    <?php 
    if (!empty($_POST)) {
       echo '<script>setStep(2)</script>';
    }?>
	</body>
</html>
  <?php

  get_translation(DIR_WS_LANGUAGES . $language . '/' . FILENAME_STAR_PRODUCT);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_STAR_PRODUCT));

  $content = CONTENT_SURVEY;


  include (bts_select('main', $content_template)); // BTSv1.5




  require(DIR_WS_INCLUDES . 'application_bottom.php');

?>