<?php

class FormGenerator {
    private $surveyId;
    private $mysqli;

    public function __construct($surveyId, DatabaseConn $dbConnection) {
        $this->surveyId = $surveyId;
        $this->mysqli = $dbConnection->getMysqli();
    }

    public function getAllQuestionNameFromSurvey() {
        $q = "SELECT question_name, option_id FROM survey_question WHERE survey_id = ?";
        $stmt = $this->mysqli->prepare($q);
        $stmt->bind_param("i", $this->surveyId);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $rows;
    }

    public function getQuestion($questionId) {
        $q = "SELECT question_id, question, question_name, option_id FROM survey_question WHERE survey_id = $this->surveyId and question_id = $questionId";
        $g = $this->mysqli->query($q);
        $r = $g->fetch_array();

        return $r;
    }

    public function getAnswer($questionId) {
        $q = "SELECT id, sort_id, answer FROM survey_answer WHERE survey_id = $this->surveyId and question_id = $questionId";
        $g = $this->mysqli->query($q);
        $r = $g->fetch_all();

        return $r;
    }

    public function createRateForm($question, $answers, $name) {
        echo '<p>'. $question['question'];
        echo '<input type="hidden" name="question_'.$question['question_id'] .'" value="'.$question['question_id'] .'"></p>';
        echo '<div class="rating">';
        foreach ($answers as $item) {
            echo '<input type="radio" name="'.$name.'" id="radio'.$item[0].'" value="'.$item[2].'">';
            echo '<label for="radio'.$item[0].'">'.$item[1].'</label>';
        }
        echo '</div><div class="rating-footer"><span>'. $answers[0][2];
        echo '</span><span>'. $answers[count($answers)-1][2] . '</span></div>';
    }

    public function createRadioForm($q, $a, $name) {
           echo '<p>' . $q['question'] . '<input type="hidden" name="question_2" value="' . $q['question_id'] .'"></p>';
           echo '<div class="group" style="top: -35px;">';
            foreach($a as $item){
                echo '<label for="radio'.$item[0].'">';
                echo '<input type="radio" name="'.$name.'" id="radio'.$item[0].'" value="'.$item[2].'">';
                echo $item[2].'</label>';
            }
           echo '</div>';
    }

    public function createCheckForm($q, $a, $name) {
        echo '<p>' . $q['question'] . '<input type="hidden" name="question_4" value="'.$q['question_id'] .'"></p>';
        echo '<div class="group" required>';
        foreach ($a as $item) {
            echo '<label for="check'.$item[0].'">';
            echo '<input type="checkbox" name="'.$name.'[]" id="check'.$item[0].'" value="'.$item[2].'">';
            echo $item[2].'</label>';
        }
        echo '</div>';
    }
}

