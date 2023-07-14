<?php

class SurveyResponse {
    private $surveyId;
    private $customerId;
    private $email;
    private $comments;
    private $contactPref;
    private $questions;

    public function __construct($surveyId, $customerId, $email, $comments, $contactPref, $questions) {
        $this->surveyId = $surveyId;
        $this->customerId = $customerId;
        $this->email = $email;
        $this->comments = $comments;
        $this->contactPref = $contactPref;
        $this->questions = $questions;
    }

    public function saveResponse(DatabaseConn $dbConnection) {
        $mysqli = $dbConnection->getMysqli();

        $email = filter_var($this->email, FILTER_SANITIZE_EMAIL);

        $stmt = $mysqli->prepare("INSERT INTO survey_responses (survey_id, customer_id, question_id, answer) VALUES (?, ?, ?, ?)");

        $solved = $this->checkWhichTime($email, $mysqli);

        foreach ($this->questions as $question => $answer) {
            $stmt->bind_param("iiss", $this->surveyId, $this->customerId, $question, $answer);
            $stmt->execute();
        }

        $stmt = $mysqli->prepare("INSERT INTO survey_user_data (solved, email, comments, customer_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("issi", $solved, $email, $this->comments, $this->customerId);
        $stmt->execute();

        $stmt->close();
    }

    private function checkWhichTime($email, $mysqli) {
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
}


?>