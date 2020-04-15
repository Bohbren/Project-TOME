<?php

class validation {
    
    public static function textboxNotEmpty($param) {
        return !empty($param);
    }
    
    public static function isValidPassword($pwd) {
        if(!empty($pwd)) {
            if(strlen($pwd) > 8) {
                return true;
            }
        }
        return false;
    }
    
    public static function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
}