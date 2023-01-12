<?php

// I. Accès à la BDD 

try
{
    $mysqlClient = new PDO('mysql:host=localhost;dbname=brief5;charset=utf8', 'root', '' );
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage("Il y a une erreur!" ));
}

// II. Create Read Update Delete 

switch(true){

    // Bouton "cacher ( = effacer l'affichage) les entrées de la BDD"
    case isset($_POST['buttonErase']): 
        $_POST = NULL; 
        break; 
    
    // Bouton "afficher les entrées de la BDD"
    case isset($_POST['buttonShow']): 
        $sqlQuery = "SELECT * FROM liens";
        $dbEntries = $mysqlClient->prepare($sqlQuery);
        $dbEntries->execute();
        $dbEntriesResult = $dbEntries->fetchAll();
        foreach ($dbEntriesResult as $dbEntriesResult) {
            ?>
            <div style="background-color:#c3c3c3;border-style:double;padding:1rem;margin:1rem;">
                <p>Code de l'entrée dans la base de données: <?php echo $dbEntriesResult[0]; ?></p>
                <p>Nom de l'entrée: <?php echo $dbEntriesResult[1]; ?></p>
                <p>Adresse du site: <a href="<?php echo $dbEntriesResult[2]; ?>"><?php echo $dbEntriesResult[2]; ?></p></a>
                <p>Adresse complète du lien: <a href="<?php echo $dbEntriesResult[3]; ?>"><?php echo $dbEntriesResult[3]; ?></p></a>
                <p>Description: <?php echo $dbEntriesResult[4]; ?></p>
            </div>
            <?php
            }
        break;

    // Formulaire "ajouter une entrée dans la BDD"
    case isset($_POST['newLinkName']) && isset($_POST['newLinkAddress']) && isset($_POST['newLinkDescription']): 
        $newLinkName = $_POST['newLinkName'];
        $newLinkAddress = $_POST['newLinkAddress'];
        $newLinkDescription = $_POST['newLinkDescription'];
        $sqlQuery = "INSERT INTO `liens` (`nom`, `url`, `description`) VALUES ('$newLinkName', '$newLinkAddress', '$newLinkDescription')";
        $newDbEntry = $mysqlClient->prepare($sqlQuery);
        $newDbEntry->execute();
        echo '<script>alert("Votre entrée a bien été ajoutée!")</script>';
        break;

    // Formulaire "effacer une entrée dans la BDD"
    case isset($_POST['numberDelete']): 
        $numberDelete = $_POST['numberDelete'];
        $sqlQuery = "DELETE FROM `liens` WHERE `liens`.`numero` = '$numberDelete'";
        $deleteEntry = $mysqlClient->prepare($sqlQuery);
        $deleteEntry->execute();
        echo '<script>alert("Votre entrée a bien été supprimée!")</script>';
        break;

    // Formulaire "afficher les entrées par catégories, option 1"
    case (isset($_POST['frontEnd'])): 
        $sqlQuery = "SELECT * FROM `liens` JOIN `categories` ON `liens`.`categoriesId` = `categories`.`numero` WHERE(`categories`.`numero`=0)";
        $cat0 = $mysqlClient->prepare($sqlQuery);
        $cat0->execute();
        $cat0Result = $cat0->fetchAll();
        foreach ($cat0Result as $dbEntriesResult) {
            ?>
            <div style="background-color:#c3c3c3;border-style:double;padding:1rem;margin:1rem;">
                <p>Code de l'entrée dans la base de données: <?php echo $dbEntriesResult[0]; ?></p>
                <p>Nom de l'entrée: <?php echo $dbEntriesResult[1]; ?></p>
                <p>Adresse du site: <a href="<?php echo $dbEntriesResult[2]; ?>"><?php echo $dbEntriesResult[2]; ?></p></a>
                <p>Adresse complète du lien: <a href="<?php echo $dbEntriesResult[3]; ?>"><?php echo $dbEntriesResult[3]; ?></p></a>
                <p>Description: <?php echo $dbEntriesResult[4]; ?></p>
            </div>
            <?php
            }
        break;
    // Formulaire "afficher les entrées par catégories, option 2"
    case (isset($_POST['backEnd'])): 
        $sqlQuery = "SELECT * FROM `liens` JOIN `categories` ON `liens`.`categoriesId` = `categories`.`numero` WHERE(`categories`.`numero`=1)";
        $cat1 = $mysqlClient->prepare($sqlQuery);
        $cat1->execute();
        $cat1Result = $cat1->fetchAll();
        foreach ($cat1Result as $dbEntriesResult) {
            ?>
            <div style="background-color:#c3c3c3;border-style:double;padding:1rem;margin:1rem;">
                <p>Code de l'entrée dans la base de données: <?php echo $cat0Result[0]; ?></p>
                <p>Nom de l'entrée: <?php echo $cat0Result[1]; ?></p>
                <p>Adresse du site: <a href="<?php echo $cat0Result[2]; ?>"><?php echo $cat0Result[2]; ?></p></a>
                ?>
            <div style="background-color:#c3c3c3;border-style:double;padding:1rem;margin:1rem;">
                <p>Code de l'entrée dans la base de données: <?php echo $dbEntriesResult[0]; ?></p>
                <p>Nom de l'entrée: <?php echo $dbEntriesResult[1]; ?></p>
                <p>Adresse du site: <a href="<?php echo $dbEntriesResult[2]; ?>"><?php echo $dbEntriesResult[2]; ?></p></a>
                <p>Adresse complète du lien: <a href="<?php echo $dbEntriesResult[3]; ?>"><?php echo $dbEntriesResult[3]; ?></p></a>
                <p>Description: <?php echo $dbEntriesResult[4]; ?></p>
            </div>
            <?php
            }
        break;
    // Formulaire "afficher les entrées par catégories, option 3"
    case (isset($_POST['outils'])): 
        $sqlQuery = "SELECT * FROM `liens` JOIN `categories` ON `liens`.`categoriesId` = `categories`.`numero` WHERE (`categories`.`numero`=2) OR (`categories`.`numero`=3)";
        $cat2 = $mysqlClient->prepare($sqlQuery);
        $cat2->execute();
        $cat2Result = $cat2->fetchAll();
        foreach ($cat2Result as $dbEntriesResult) {
            ?>
            <div style="background-color:#c3c3c3;border-style:double;padding:1rem;margin:1rem;">
                <p>Code de l'entrée dans la base de données: <?php echo $dbEntriesResult[0]; ?></p>
                <p>Nom de l'entrée: <?php echo $dbEntriesResult[1]; ?></p>
                <p>Adresse du site: <a href="<?php echo $dbEntriesResult[2]; ?>"><?php echo $dbEntriesResult[2]; ?></p></a>
                <p>Adresse complète du lien: <a href="<?php echo $dbEntriesResult[3]; ?>"><?php echo $dbEntriesResult[3]; ?></p></a>
                <p>Description: <?php echo $dbEntriesResult[4]; ?></p>
            </div>
            <?php
            }
        break;

    // Formulaire "modifier une entrée dans la BDD, partie 1: afficher l'entrée à formuler"
    case isset($_POST['findIdNumber']): 
        $idNumber = $_POST['findIdNumber'];
        $sqlQuery = "SELECT * FROM liens WHERE numero = '$idNumber'";
        $makeForm = $mysqlClient->prepare($sqlQuery);
        $makeForm->execute();
        $makeFormResult = $makeForm->fetchAll();
        foreach ($makeFormResult as $makeFormResult) {
            ?>
            <div style="background-color:#c3c3c3;text-align:center;border-style:double;padding:1rem;margin:1rem;">
            <form method="post">
            Code de l'entrée dans la base de données (non modifiable): <?php echo $makeFormResult[0]; ?><input type="hidden" value="<?php echo $makeFormResult[0]; ?>" name="modified0"></br>
            Nom à modifier: <input type="text" value="<?php echo $makeFormResult[1];?>" name="modified1"></br>
            Adresse du site modifier: <input type="text" value="<?php echo $makeFormResult[2];?>" name="modified2"></br>
            Adresse complète à modifier: <input type="text" value="<?php echo $makeFormResult[3];?>" name="modified3"></br>
            Description à modifier: <input type="text" value="<?php echo $makeFormResult[4];?>" name="modified4"></br>
            <input type="submit">
            </form>
            </div>
            <?php
        }
        break;
    // Formulaire "modifier une entrée dans la BDD, partie 2: formulaire de modifications"
    case(isset($_POST['modified0']) && isset($_POST['modified1']) && isset($_POST['modified2']) && isset($_POST['modified3']) && isset($_POST['modified4'])): 
            $idNumber = $_POST['modified0'];
            $modified1 = $_POST['modified1'];
            $modified2 = $_POST['modified2'];
            $modified3 = $_POST['modified3'];
            $modified4 = $_POST['modified4'];
            $sqlQuery = "UPDATE liens SET nom = '$modified1', website = '$modified2', url = '$modified3', description = '$modified4' WHERE numero = '$idNumber'";
            $updateForm = $mysqlClient->prepare($sqlQuery);
            $updateForm->execute();
            echo '<script>alert("Votre entrée a bien été modifiée!")</script>';
        break; 
        
    default: 
        $_POST = NULL; 
}

$varTest = 'je teste je teste je teste ';

// III. Afficher le site 

//Template setup pt1/4
require_once('template.class.php');
define('TEMPLATES_PATH', 'templates');
//Instanciate new object 2/4
$template = new Template(TEMPLATES_PATH.'/tpl.html'); 
//Assign values 3/4
$template->assign('title', 'Bonjour');
$template->assign('text', $varTest);
//Show content 4/4 
$template->show();
?>