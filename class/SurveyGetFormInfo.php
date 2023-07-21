<?php

class SurveyGetFormInfo
{
    public function getFormOption(DatabaseConn $dbConnection) {
        $mysqli = $dbConnection->getMysqli();

        $query = 'SELECT * FROM survey_options_form';
        $result = $mysqli->query($query);
        $result = $result->fetch_all();

        return $result;

    }

    public function getLastSurveyName(DatabaseConn $dbConnection) {
        $mysqli = $dbConnection->getMysqli();

        $query = 'SELECT * FROM survey_name ORDER BY survey_name.id DESC LIMIT 1';
        $result = $mysqli->query($query);
        $result = $result->fetch_array();

        return $result;

    }

}