<?php
namespace model\exceptions;

/**
 * Exception personnalisée pour les erreurs liées à la FAQ
 */
class FaqException extends \Exception
{
    /**
     * @param string $message Message d'erreur
     * @param int $code Code d'erreur
     */
    function __construct($message, $code = 0){
        parent::__construct($message, $code);
    }
}
