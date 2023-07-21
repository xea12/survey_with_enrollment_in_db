<?php

class SurveyQuestionSave
{
    private $surveyId;
    private $questionId;
    private $question;
    private $option_id;
    private $question_name;

    public function __construct($surveyId, $questionId, $question, $option_id, $question_name) {
        $this->surveyId = $surveyId;
        $this->questionId = $questionId;
        $this->question = $question;
        $this->option_id = $option_id;
        $this->question_name = $question_name;
    }

    public function saveQuestion(DatabaseConn $dbConnection) {
        try {
            $mysqli = $dbConnection->getMysqli();
            $mysqli->set_charset("utf8mb4");

            $stmt = $mysqli->prepare("INSERT INTO survey_question (survey_id, question_id, question, option_id, question_name) VALUES (?, ?, ?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Błąd przy tworzeniu zapytania do bazy danych: " . $mysqli->error);
            }

            $stmt->bind_param("iisis", $this->surveyId, $this->questionId, $this->question, $this->option_id, $this->question_name);
            if (!$stmt->execute()) {
                throw new Exception("Błąd przy wykonywaniu zapytania do bazy danych: " . $stmt->error);
            }

            $stmt->close();
        } catch (Exception $e) {
            echo "Wystąpił błąd podczas zapisu do bazy danych: " . $e->getMessage();
        }
    }



}