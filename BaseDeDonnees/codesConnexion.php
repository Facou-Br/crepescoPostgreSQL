<?php
class BaseDeDonnees
{
    //Informations de connexion à la base de données
    private const HOST = "localhost";
    private const DATABASE = "crepesco_test";
    private const PORT = "5432";

    //Identifiants de connexion à la base de données en admin
    private const ADMIN_USER = "postgres";
    private const ADMIN_PASSWORD = "postgres";

    public static function connecterBDD($user)
    {
        $connection = null;

        if ($user == "postgres") {
            // Correction de la chaîne de connexion avec le formatage approprié et l'utilisation de self::
            $connection = pg_connect("host=" . self::HOST . " port=" . self::PORT . " dbname=" . self::DATABASE . " user=" . self::ADMIN_USER . " password=" . self::ADMIN_PASSWORD);
            if (!$connection) {
                echo "Une erreur s'est produite.\n";
                exit;
            }
        }

        return $connection;
    }
}
