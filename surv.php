<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);
require ('includes/application_top.php');
require('survey/class/DatabaseConn.php');
require('survey/class/SurveyResponse.php');
require('survey/class/FormGenerator.php');
require('survey/class/FormValidator.php');
$dbConnection = new DatabaseConn(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE);

$email = '';
$surveyId = 1;
$response = '';

if (isset($_SESSION['customer_id'])) {
    $customerId = $_SESSION['customer_id'];
    $emailQuery = "select customers_email_address from customers where customers_id = ". $_SESSION['customer_id'];
    $emailRes = $dbConnection->getMysqli()->query($emailQuery);
    $email = $emailRes->fetch_array()[0];
} else {
    $customerId = '';
}

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

        $surveyResponse = new SurveyResponse($surveyId, $customerId, $email, $comments, $contactPref, $questions);
        $surveyResponse->saveResponse($dbConnection);

        $response = "Dziekujemy za wypełnienie ankiety";
    }
}

$formGenerator = new FormGenerator($surveyId, $dbConnection);

$q1 = $formGenerator->getQuestion(1);
$a1 = $formGenerator->getAnswer(1);

$q2 = $formGenerator->getQuestion(2);
$a2 = $formGenerator->getAnswer(2);

$q3 = $formGenerator->getQuestion(3);
$a3 = $formGenerator->getAnswer(3);

$q4 = $formGenerator->getQuestion(4);
$a4 = $formGenerator->getAnswer(4);

$dbConnection->closeConnection();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>Ankieta DrTusz</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link rel="stylesheet" href="survey/style.css">
	</head>
	<body>
        <div id="survey-window" class="survey">
            <div id="overlay" class="overlay"></div>
            <form class="survey-form" method="post" action="">		
            <h1><i class="far fa-list-alt"></i>Ankieta DrTusz</h1>
                <div id="steps2" class="steps">
                    <div class="step current"></div>
                    <div class="step"></div>
                    <div class="step"></div>
                </div>
                <div id="page-info"></div> 
                <div class="step-content asks-step current" data-step="1" id="step-1">
                    <div class="fields">
                        <?= $formGenerator->createRateForm($q1, $a1, 'rating') ?>
                        <p>
                            <?= $q2['question']  ?>
                            <input type="hidden" name="question_2" value="<?= $q2['question_id'] ?>">
                        </p>

                        <div class="group" style="top: -35px;">
                            <?php foreach($a2 as $item){
                                echo '<label for="radio'.$item[0].'">';
                                echo '<input type="radio" name="hear_about_us" id="radio'.$item[0].'" value="'.$item[2].'">';
                                echo $item[2].'</label>'; 
                            } ?>	
                        </div>					
                    </div>
                    <div class="buttons">
                        <a href="#" class="btn" data-set-step="2" style="margin-left: 75px;">Następna</a>
                    </div>
                </div>
                        <!-- page 2 -->
                <div class="step-content asks-step" data-step="2" id="step-2">
                    <div class="fields">
                        <?= $formGenerator->createRateForm($q3, $a3, 'recommend') ?>
                        <p>
                        <?= $q4['question']  ?>
                            <input type="hidden" name="question_4" value="<?= $q4['question_id'] ?>">
                        </p>
                        
                        <div class="group" required>
                            <?php foreach ($a4 as $item) {
                                echo '<label for="check'.$item[0].'">';
                                echo '<input type="checkbox" name="contact_pref[]" id="check'.$item[0].'" value="'.$item[2].'">';
                                echo $item[2].'</label>'; 
                            } ?>	
                        </div>
                    </div>
                    <div class="buttons">
                        <a href="#" class="btn alt" data-set-step="1">Wstecz</a>
                        <a href="#" class="btn" data-set-step="3">Następna</a>
                    </div>
                </div>

                <!-- page 3 -->
                <div class="step-content asks-step" data-step="3">
                    <div class="fields">
                        <label for="email">Twój Email</label>
                        <div class="field">
                            <i class="fas fa-envelope"></i>
                            <input id="email" type="email" name="email" <?=($email !== '') ? 'value="' .$email .'"' : 'placeholder="Twój Email"'?> required>
                        </div>
                        <label for="comments">Dodatkowe uwagi</label>
                        <div class="field">
                            <textarea id="comments" name="comments" placeholder="Wpisz swoje uwagi..."></textarea>
                        </div>
                    </div>
                    <div class="buttons">
                        <a href="#" class="btn alt" data-set-step="2">Wstecz</a>
                        <input type="submit" class="btn" name="submit" value="Wyślij">
                    </div>
                </div>

                <!-- page 4 -->
                <div class="step-content" data-step="4">
                    <div class="result"><?=$response?></div>
                </div>
                
            </div>
            </form>
        </div>

<script>
const setStep = step => {
    document.querySelectorAll(".step-content").forEach(element => element.style.display = "none");
    document.querySelector("[data-step='" + step + "']").style.display = "block";
    document.querySelectorAll(".steps .step").forEach((element, index) => {
        index < step-1 ? element.classList.add("complete") : element.classList.remove("complete");
        index == step-1 ? element.classList.add("current") : element.classList.remove("current");
        if (step === 4) {
            document.getElementById("page-info").classList.add("hidden");
            document.getElementById("steps2").classList.add("hidden");
            element.classList.add("hidden");
        }
    });
};
document.querySelectorAll("[data-set-step]").forEach(element => {
    element.onclick = event => {
        event.preventDefault();
        setStep(parseInt(element.dataset.setStep));
    };
});
const exit = document.querySelector('.overlay');
const survey = document.querySelector('#survey-window');
const overlay = document.querySelector('#overlay')
exit.addEventListener("click", function() {
    survey.classList.add('survey-display-none');
    overlay.classList.add('survey-display-none');
});
<?php if (!empty($_POST)): ?>
setStep(4);
<?php endif; ?>
</script>
<script>
    window.addEventListener('DOMContentLoaded', function () {
        var stepContent = document.querySelectorAll('.asks-step');
        var totalPages = stepContent.length;
        var currentPage = 1;

        function updatePageInfo() {
            var pageInfo = document.getElementById('page-info');
            pageInfo.textContent = 'Strona ' + currentPage + ' / ' + totalPages;
        }

        function showPage(page) {
            for (var i = 0; i < stepContent.length; i++) {
                stepContent[i].classList.remove('current');
            }
            stepContent[page - 1].classList.add('current');
            currentPage = page;
            updatePageInfo();
        }

        updatePageInfo();

        var nextBtns = document.querySelectorAll('[data-set-step]');
        nextBtns.forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                var nextPage = this.getAttribute('data-set-step');
                showPage(nextPage);
            });
        });
    });
</script>
	</body>
</html>
  <?php

  get_translation(DIR_WS_LANGUAGES . $language . '/' . FILENAME_STAR_PRODUCT);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_STAR_PRODUCT));

  $content = CONTENT_TEST;


  include (bts_select('main', $content_template)); // BTSv1.5




  require(DIR_WS_INCLUDES . 'application_bottom.php');

?>