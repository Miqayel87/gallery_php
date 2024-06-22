<?php

class Validator
{
    public static function validateRequired($value)
    {
        return !empty($value);
    }

    public static function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    public static function validatePasswordStrength($password, $minLength = 8)
    {
        return strlen($password) >= $minLength;
    }

    public static function validateUsernameUnique($username, $userModel)
    {
        return empty($userModel->getUserByUsername($username));
    }

    public static function validateRequiredFile($value)
    {
        return !empty($value['name']);
    }
}