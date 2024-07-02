<?php
// Connexion à la base de données
require_once '../../../../BaseDeDonnees/codesConnexion.php';
$connexionPDO = BaseDeDonnees::connecterBDD('postgres');

$tableauFournisseurs = array();
try {
    $commandeSQL = "SELECT ID FROM FOURNISSEUR GROUP BY ID ORDER BY ID ASC;";
    $result = pg_query($connexionPDO, $commandeSQL);
    if (!$result) {
        echo "Une erreur s'est produite lors de la rêquete.\n";
        exit;
    }

    while ($row = pg_fetch_row($result)) {
        array_push($tableauFournisseurs, $row[0]);
    }
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage() . '<br />';
    echo 'N° : ' . $e->getCode();
    die();
}

$data = json_encode($tableauFournisseurs);
echo $data;
