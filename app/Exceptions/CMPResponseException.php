<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class CMPResponseException extends Exception
{

    private $errors;
    protected $message;
    protected $code;

    public function __construct($code = "", $errors = [])
    {

        if(!$error_code = config("error_codes.". $code)) $error_code = config("error_codes.unknown");

        $this->message = $error_code["message"];
        $this->code = $error_code["code"];
        $this->errors = $errors;
        parent::__construct($this->message, $this->code);
    }

    public function render($request) {

        return response()->json([
            "message" => $this->message,
            "errors" => (!empty($this->errors)) ? $this->errors : null
        ], $this->code);
    }
}
