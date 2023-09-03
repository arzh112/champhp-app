<?php

class ErrorCode
{
    public const ADMIN_ACCESS_ERROR = 1;
    public const INVALID_CREDENTIALS = 2;
    public const FIELDS_REQUIRED = 3;
    public const INVALID_EMAIL = 4;
    public const FAILD_DB_CONNECT = 5;
    public const FAILD_CONFIRM_PASS = 6;
    public const LOGIN_REQUIRED = 7;

    public static function getErrorMessage(int $errorCode): string
    {
        switch ($errorCode) {
            case self::ADMIN_ACCESS_ERROR:
                $result = "Veuillez vous connecter pour accéder à l'administration";
                break;
            case self::INVALID_CREDENTIALS:
                $result = "Les identifiants saisis n'ont pas permis de vous identifier";
                break;
            case self::FIELDS_REQUIRED:
                $result = "Tous les champs du formulaire sont obligatoires";
                break;
            case self::INVALID_EMAIL:
                $result = "L'adresse mail n'est pas valide";
                break;
            case self::FAILD_DB_CONNECT:
                $result = "La connexion à la base de donnée à échouée";
                break;
            case self::FAILD_CONFIRM_PASS:
                $result = "La confirmation du mot de passe a échoué";
                break;
            case self::LOGIN_REQUIRED:
                $result = "Veuillez vous connecter";
                break;
            default:
                $result = "Une erreur est survenue";
        }

        return $result;
    }
}
