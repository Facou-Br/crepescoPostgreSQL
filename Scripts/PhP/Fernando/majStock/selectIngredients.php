
<?php
// Connexion à la base de données
require_once '../../../../BaseDeDonnees/codesConnexion.php';
$connexionPDO = BaseDeDonnees::connecterBDD('postgres');
// Fin connexion

if (isset($_GET['fournisseurs'])) {
    $fournisseurs = $_GET['fournisseurs']; // Plus besoin d'utiliser addslashes

    $tableauIngredients = array();
    try {
        // Utilisation d'une requête préparée
        $commandeSQL = 'SELECT ID_INGREDIENT FROM FOURNISSEUR_INGREDIENT WHERE ID_FOURNISSEUR = $1;';
        $idIngredients = pg_prepare($connexionPDO, "SelectIDINGRED", $commandeSQL);
        $idIngredients = pg_execute($connexionPDO, "SelectIDINGRED", array($fournisseurs));

        while ($row = pg_fetch_row($idIngredients)) {
            $tableauIngredients[$row[0]] = null;
        }
    } catch (Exception $e) {
        echo 'Erreur sur la première requête';
    }

    foreach ($tableauIngredients as $id => $ingredient) {
        try {
            // Deuxième requête préparée
            $commandeSQL = "SELECT NOM FROM INGREDIENT WHERE ID = $id;";
            $ingred = pg_query($connexionPDO, $commandeSQL);

            while ($row = pg_fetch_row($ingred)) {
                $tableauIngredients[$id] = $row[0];
            }
        } catch (Exception $e) {
            echo 'Erreur sur la deuxième requête';
        }
    }
    $data = json_encode($tableauIngredients);
    echo $data;
} else {
    echo "Erreur sur le get fournisseur";
}
