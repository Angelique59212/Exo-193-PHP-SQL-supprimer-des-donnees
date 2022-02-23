<?php
require 'Classes/DB.php';

$db = new DB();
$bdd = $db::getInstance();

try {
    $sql = "DELETE FROM user WHERE id = 4";
    if ($bdd->exec($sql) !== false) {
        echo "L'entrée dont l'id est 4 a bien été supprimée <br>";
    }
    $sql = "TRUNCATE TABLE user";
    if ($bdd->exec($sql) !== false) {
        echo "Contenu de la table supprimé<br>";
    }

    $stmt = $bdd->prepare("
        INSERT INTO user (nom, prenom, rue, numero, code_postal, ville, pays, mail)
        VALUES (:nom, :prenom, :rue, :numero, :code_postal, :ville, :pays, :mail)
    ");
    $nom = 'Dehainaut';
    $prenom = 'Angélique';
    $rue = 'boussus';
    $numero = 35;
    $code_postal = 59212;
    $ville = 'Wignehies';
    $pays = 'France';
    $mail = 'angelique.dehainaut59@gmail.com';

    $stmt->bindParam('nom',$nom);
    $stmt->bindParam('prenom',$prenom);
    $stmt->bindParam('rue',$rue);
    $stmt->bindParam('numero',$numero);
    $stmt->bindParam('code_postal',$code_postal);
    $stmt->bindParam('ville',$ville);
    $stmt->bindParam('pays',$pays);
    $stmt->bindParam('mail',$mail);

    $stmt->execute();

    $sql = "DROP TABLE user";
    if ($bdd->exec($sql) !== false) {
        echo 'Table user complètement supprimée';
    }

    $sql = "DROP DATABASE donnees";
    if ($bdd->exec($sql) !== false) {
        echo "Base de données complètement supprimées";
    }
}
catch (PDOException $exception) {
    echo $exception->getMessage();
}
/**
 * 1. Importez la table user dans une base de données que vous aurez créée au préalable via PhpMyAdmin
 * 2. En utilisant l'objet de connexion qui a déjà été défini =>
 *    --> Remplacez les informations de connexion ( nom de la base et vérifiez les paramètres d'accès ).
 *    --> Supprimez le dernier utilisateur de la liste, faites une capture d'écran dans PhpMyAdmin pour me montrer que
 vous avez supprimé l'entrée et pushez la avec votre code.
 *    --> Faites un truncate de la base de données, les auto incréments présents seront remis à 0
 *    --> Insérez un nouvel utilisateur dans la table ( faites un screenshot et ajoutez le au repo )
 *    --> Finalement, vous décidez de supprimer complètement la table
 *    --> Et pour finir, comme vous n'avez plus de table dans la base de données, vous décidez de supprimer aussi la base de données.
 */