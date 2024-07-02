<?php
require_once '../../../../BaseDeDonnees/codesConnexion.php';
$connexionPDO = BaseDeDonnees::connecterBDD('postgres');

pg_query($connexionPDO, "BEGIN;");

try {
    if (isset($_POST['ingredientsObj'])) {
        $ingredientsObj = json_decode($_POST['ingredientsObj'], true);
        foreach ($ingredientsObj as $key => $ingredient) {
            $commandeSQL = "UPDATE INGREDIENT SET STOCK_REEL = STOCK_REEL + " . $ingredient . " WHERE ID = " . $key;
            $resultat = pg_query($connexionPDO, $commandeSQL);
            if (!$resultat) {
                throw new Exception('Erreur dans la mise à jour de l\'ingrédient ID: ' . $key);
            }
        }
    }
    // Si tout s'est bien passé, valider la transaction
    pg_query($connexionPDO, "COMMIT;");
    echo "Transaction réussie";
} catch (Exception $e) {
    // En cas d'erreur, annuler la transaction
    pg_query($connexionPDO, "ROLLBACK;");
    echo "Transaction échouée : " . $e->getMessage();
}

pg_close($connexionPDO);
