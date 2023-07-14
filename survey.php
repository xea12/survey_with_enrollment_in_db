<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);
require ('includes/application_top.php');
$mysqli = new mysqli(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$mysqli->set_charset('utf8');
$email = '';
$survey_id = 1;
$response = '';

if (isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];
    $email_query = "select customers_email_address from customers where customers_id = ". $_SESSION['customer_id'];
    $email_res = $mysqli->query($email_query);
    $email = $email_res->fetch_array()[0];
} else {
    $customer_id = '';
}


if (isset($_POST['submit'])) {
    // Sprawdź, czy wszystkie wymagane pola zostały przesłane
    $requiredFields = ['rating', 'hear_about_us', 'recommend', 'email', 'comments'];
    if (areFieldsFilled($requiredFields, $_POST)) {
        // Pobierz dane z formularza
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
        
 

        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        $stmt = $mysqli->prepare("INSERT INTO survey_responses (survey_id, customer_id, question_id, answer) VALUES (?, ?, ?, ?)");

        $solved = checkWhichTime($email, $mysqli); 
        
        
        foreach ($questions as $question => $answer) {
            $stmt->bind_param("iiss", $survey_id, $customer_id, $question, $answer);
            $stmt->execute();
        }

        $stmt = $mysqli->prepare("INSERT INTO survey_user_data (solved, email, comments, customer_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("issi", $solved, $email, $comments, $customer_id);
        $stmt->execute();
        $response = "Dziekujemy za wypełnienie ankiety";

        $stmt->close();
    }
}




// Sprawdzenie czy podany email wypełniał już kiedys ankiete

function checkWhichTime($email, $mysqli) 
{
    $check_which_time_query = "SELECT solved, email FROM survey_user_data WHERE email = '". $email ."' ORDER BY solved DESC"; 
    $check_which_time = $mysqli->query($check_which_time_query);
    $check_which_time = $check_which_time->fetch_array();
    if (isset($check_which_time['email']) && $check_which_time['email'] === $email) {
        $solved = $check_which_time['solved'] + 1;
    } else {
        $solved = 1;
    }
    return $solved;
}

// Funkcja sprawdzająca, czy wszystkie wymagane pola są wypełnione
function areFieldsFilled($fields, $data) 
{
    foreach ($fields as $field) {
        if (!isset($data[$field]) || empty($data[$field])) {
            return false;
        }
    }
    return true;
}

// Pobranie pytania z bazy 
function getQuestion($survey_id, $mysqli, $question_id)
{
    $q = "SELECT question_id, question FROM survey_question 
        WHERE survey_id = $survey_id and question_id = $question_id";
    $g = $mysqli->query($q);
    $r = $g->fetch_array();
    
    return $r;
}
// Pobiera odpowiedzi do pytania według id pytania i id ankiety
function getAnswer($survey_id, $mysqli, $question_id)
{

     $q = "SELECT id, sort_id, answer FROM survey_answer WHERE survey_id = $survey_id and question_id = $question_id";
    $g = $mysqli->query($q);
    $r = $g->fetch_all();
    
    return $r;
}
// Tworzy formularz oceny z zarkrezu wpisanych odpowiedzi 
function createRateForm($q, $a, $name) 
{
    echo '<p>'. $q['question'];  
    echo '<input type="hidden" name="question_'.$q['question_id'] .'" value="'.$q['question_id'] .'"></p>';
    echo '<div class="rating">';
    foreach ($a as $item) { 
        echo '<input type="radio" name="'.$name.'" id="radio'.$item[0].'" value="'.$item[2].'">';
        echo '<label for="radio'.$item[0].'">'.$item[1].'</label>'; 
    }
    echo '</div><div class="rating-footer"><span>'. $a[0][2]; 
    echo '</span><span>'. $a[count($a)-1][2] . '</span></div>';

}

$q1 = getQuestion($survey_id, $mysqli, 1);
$a1 = getAnswer($survey_id, $mysqli, 1);

$q2 = getQuestion($survey_id, $mysqli, 2);
$a2 = getAnswer($survey_id, $mysqli, 2);

$q3 = getQuestion($survey_id, $mysqli, 3);
$a3 = getAnswer($survey_id, $mysqli, 3);

$q4 = getQuestion($survey_id, $mysqli, 4); 
$a4 = getAnswer($survey_id, $mysqli, 4);

$mysqli->close();

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>Survey Form</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link rel="stylesheet" href="survey/style.css">
	</head>
	<body>
        <div id="survey-window" class="survey">
            <div id="overlay" class="overlay"></div>
            <form class="survey-form" method="post" action="">		
            <h1><i class="far fa-list-alt"></i>Survey Form</h1>
                <div id="steps2" class="steps">
                    <div class="step current"></div>
                    <div class="step"></div>
                    <div class="step"></div>
                </div>
                <div id="page-info"></div> 
                <div class="step-content asks-step current" data-step="1" id="step-1">
                    <div class="fields">
                        <?= createRateForm($q1, $a1, 'rating') ?>
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
                        <?= createRateForm($q3, $a3, 'recommend') ?>
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
                        <label for="comments">Additional Comments</label>
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