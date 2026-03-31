<?php
namespace model;

/**
 * Exception personnalisée pour les Projets
 */
class ProjetException extends \Exception
{
    function __construct($message, $code = 0){
        parent::__construct($message, $code);
    }
}
