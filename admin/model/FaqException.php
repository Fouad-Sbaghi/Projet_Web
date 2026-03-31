<?php
namespace model;

/**
 * Exception personnalisée pour les FAQ
 */
class FaqException extends \Exception
{
    function __construct($message, $code = 0){
        parent::__construct($message, $code);
    }
}
