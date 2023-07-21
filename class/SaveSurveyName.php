<?php

class SaveSurveyName
{
    private $surveyName;


    public function __construct($surveyName) {
        $this->surveyName = $surveyName;
    }
    public function saveSurveyName(DatabaseConn $dbConnection) {
        $mysqli = $dbConnection->getMysqli();

        $stmt = $mysqli->prepare("INSERT INTO survey_name (name) VALUES (?)");
        $stmt->bind_param("s", $this->surveyName);
        $stmt->execute();

        $stmt->close();
    }
}