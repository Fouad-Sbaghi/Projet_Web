<?php
namespace model\exceptions;

class UtilisateurException extends \Exception
{
    function __construct($message, $code = 0){
        parent::__construct($message, $code);
    }
}
