
<?php
// Connexion à la base de données
require_once '../../../../BaseDeDonnees/codesConnexion.php';
$connexionPDO = BaseDeDonnees::connecterBDD('postgres');
// Fin connexion

/*if (isset($_GET['fournisseurs'])) {
    $fournisseurs = $_GET['fournisseurs'];*/
    $fournisseurs = "ALDI CENTRALE D''ACHAT ET CIE";
    $tableauIngredients = array();
    try {
        $commandeSQL = "SELECT ID_INGREDIENT FROM FOURNISSEUR_INGREDIENT where ID_FOURNISSEUR = '$fournisseurs';";
        $idIngredients = pg_query($connexionPDO, $commandeSQL);

        while ($row = pg_fetch_row($idIngredients)) {
            $tableauIngredients[$row[0]] = null;
        }
    } catch (Exception $e) {
        echo 'Erreur sur la premiere requete';
    }

    foreach ($tableauIngredients as $id => $ingredient) {
        try {
            $commandeSQL = "SELECT ID FROM INGREDIENT where ID = $id";
            $ingred = pg_query($connexionPDO, $commandeSQL);

            while ($row = pg_fetch_row($ingred)) {
                $tableauIngredients[$id] = $row[0];
            }
        } catch (Exception $e) {
            echo 'Erreur sur la deuxieme requete';
        }
    }
    $data = json_encode($tableauIngredients);
    echo $data;
/*} else {
    echo "Erreur sur le get fournisseur";
}*/
