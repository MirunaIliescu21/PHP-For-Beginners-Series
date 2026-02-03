<?php

namespace Core;

class Validator 
{
    /**
     * Pure Function = allows us to make it static
     * Static functions can be called without first creating a instance of that class.
     */
    public static function string($value, $min = 1, $max = INF)
    {
        $value = trim($value); // trim to avoid blank spaces

        return strlen($value) >= $min && strlen($value) <= $max; 
    }

    public static function email($value)
    {
        // Validator::email('john@example.com') -> return true bc has the form of the email address
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}