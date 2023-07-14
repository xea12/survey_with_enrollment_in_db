<?php
class FormValidator {
    public static function areFieldsFilled($fields, $data) {
        foreach ($fields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                return false;
            }
        }
        return true;
    }
}
?>