<?php namespace Wonde\Exceptions;


class ValidationError extends \Exception
{
    private $errors;

    /**
     * Set validation errors
     *
     * @param $errors
     * @return mixed
     */
    public function setErrors($errors)
    {
        return $this->errors = $errors;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }
}