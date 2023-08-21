<?php

class ErrorCode
{
    public const ADMIN_ACCESS_ERROR = 1;
    public const INVALID_CREDENTIALS = 2;
    public const FIELDS_REQUIRED = 3;
    public const INVALID_EMAIL = 4;

    public static function getErrorMessage(int $errorCode): string
    {
        switch ($errorCode) {
            case self::ADMIN_ACCESS_ERROR:
                $result = "Veuillez vous connecter pour accéder à l'administration";
                break;
            case self::INVALID_CREDENTIALS:
                $result = "Les identifiants fournis n'ont pas permis de vous identifier";
                break;
            case self::FIELDS_REQUIRED:
                $result = "Tous les champs du formulaire sont obligatoires";
                break;
            case self::INVALID_EMAIL:
                $result = "L'adresse email est invalide";
                break;
            default:
                $result = "Une erreur est survenue";
        }

        return $result;
    }
}
