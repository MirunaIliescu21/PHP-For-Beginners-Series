<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm
{
    protected $errors = [];

    /** When we instatiate login form, we instantly validate any attributes that are relevant to the form. */
    public function __construct(public array $attributes)
    {
        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Please provide a valid email address.';
        }

        if (!Validator::string($attributes['password'])) {
            $this->errors['password'] = 'Please provide a valid password';
        }
    }

    public static function validate($attributes)
    {
        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;
    }

    public function throw()
    {
        ValidationException::throw($this->errors(), $this->attributes);
    }

    /** Validation form has failed */
    public function failed()
    {
        return count($this->errors);
    }

    /** Getter for errors */
    public function errors()
    {
        return $this->errors;
    }

    /** Setter for a single error */
    public function error($field, $message)
    {
        $this->errors[$field] = $message;

        return $this;
    }
}