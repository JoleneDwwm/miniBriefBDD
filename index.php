<?php

// CONTROLLER 

// I. Accès à la BDD 

require_once('Connexion.php');
require_once('tpl.html');

// III. Afficher le site

// II. Create Read Update Delete 

// Bouton "cacher ( = effacer l'affichage) les entrées de la BDD"
if(isset($_POST['buttonErase'])){
    $_POST = NULL; 
} 

// Bouton "afficher les entrées de la BDD"
if(isset($_POST['buttonShow'])){
    $sqlQuery = "SELECT * FROM liens";
    $dbEntries = $mysqlClient->prepare($sqlQuery);
    $dbEntries->execute();
    $dbEntriesResult = $dbEntries->fetchAll();
    foreach ($dbEntriesResult as $dbEntriesResult) {
        ?>
        <div class="grayBox">
        <p>Code de l'entrée dans la base de données: <?php echo $dbEntriesResult[0]; ?></p>
            <p>Nom de l'entrée: <?php echo $dbEntriesResult[1]; ?></p>
            <p>Adresse complète du lien: <a href="<?php echo $dbEntriesResult[2]; ?>"><?php echo $dbEntriesResult[2]; ?></p></a>
            <p>Description: <?php echo $dbEntriesResult[3]; ?></p>
        </div>
        <?php
    }
}
    
// Formulaire "ajouter une entrée dans la BDD"
if(isset($_POST['newLinkName']) && isset($_POST['newLinkAddress']) && isset($_POST['newLinkDescription'])){ 
    $newLinkName = $_POST['newLinkName'];
    $newLinkAddress = $_POST['newLinkAddress'];
    $newLinkDescription = $_POST['newLinkDescription'];
    $sqlQuery = "INSERT INTO `liens` (`nom`, `url`, `description`) VALUES ('$newLinkName', '$newLinkAddress', '$newLinkDescription')";
    $newDbEntry = $mysqlClient->prepare($sqlQuery);
    $newDbEntry->execute();
    echo '<script>alert("Votre entrée a bien été ajoutée!")</script>';
}

// Formulaire "effacer une entrée dans la BDD"
if(isset($_POST['numberDelete'])){
    $numberDelete = $_POST['numberDelete'];
    $sqlQuery = "DELETE FROM `liens` WHERE `liens`.`numero` = '$numberDelete'";
    $deleteEntry = $mysqlClient->prepare($sqlQuery);
    $deleteEntry->execute();
    echo '<script>alert("Votre entrée a bien été supprimée!")</script>';
}
// Formulaire "afficher les entrées par catégories"

switch(true){
    // Option 1
case (isset($_POST['frontEnd'])): 
    $sqlQuery = "SELECT * FROM `liens` JOIN `categories` ON `liens`.`categoriesId` = `categories`.`numero` WHERE(`categories`.`numero`=0)";
    $cat0 = $mysqlClient->prepare($sqlQuery);
    $cat0->execute();
    $cat0Result = $cat0->fetchAll();
    foreach ($cat0Result as $dbEntriesResult) {
        ?>
        <div class="grayBox">
        <p>Code de l'entrée dans la base de données: <?php echo $dbEntriesResult[0]; ?></p>
            <p>Nom de l'entrée: <?php echo $dbEntriesResult[1]; ?></p>
            <p>Adresse complète du lien: <a href="<?php echo $dbEntriesResult[2]; ?>"><?php echo $dbEntriesResult[2]; ?></p></a>
            <p>Description: <?php echo $dbEntriesResult[3]; ?></p>
        </div>
        <?php
        }
    break;
// Option 2
case (isset($_POST['backEnd'])): 
    $sqlQuery = "SELECT * FROM `liens` JOIN `categories` ON `liens`.`categoriesId` = `categories`.`numero` WHERE(`categories`.`numero`=1)";
    $cat1 = $mysqlClient->prepare($sqlQuery);
    $cat1->execute();
    $cat1Result = $cat1->fetchAll();
    foreach ($cat1Result as $dbEntriesResult) {
        ?>
        <div class="grayBox">
            <p>Code de l'entrée dans la base de données: <?php echo $dbEntriesResult[0]; ?></p>
            <p>Nom de l'entrée: <?php echo $dbEntriesResult[1]; ?></p>
            <p>Adresse complète du lien: <a href="<?php echo $dbEntriesResult[2]; ?>"><?php echo $dbEntriesResult[2]; ?></p></a>
            <p>Description: <?php echo $dbEntriesResult[3]; ?></p>
        </div>
        <?php
        }
    break;
// Option 3
case (isset($_POST['outils'])): 
    $sqlQuery = "SELECT * FROM `liens` JOIN `categories` ON `liens`.`categoriesId` = `categories`.`numero` WHERE (`categories`.`numero`=2) OR (`categories`.`numero`=3)";
    $cat2 = $mysqlClient->prepare($sqlQuery);
    $cat2->execute();
    $cat2Result = $cat2->fetchAll();
    foreach ($cat2Result as $dbEntriesResult) {
        ?>
        <div class="grayBox">
            <p>Code de l'entrée dans la base de données: <?php echo $dbEntriesResult[0]; ?></p>
            <p>Nom de l'entrée: <?php echo $dbEntriesResult[1]; ?></p>
            <p>Adresse complète du lien: <a href="<?php echo $dbEntriesResult[2]; ?>"><?php echo $dbEntriesResult[2]; ?></p></a>
            <p>Description: <?php echo $dbEntriesResult[3]; ?></p>
        </div>
        <?php
        }
    break;
}

// Formulaire "modifier une entrée dans la BDD" 
switch(true){
        // partie 1: afficher l'entrée à formuler
case isset($_POST['findIdNumber']): 
    $idNumber = $_POST['findIdNumber'];
    $sqlQuery = "SELECT * FROM liens WHERE numero = '$idNumber'";
    $makeForm = $mysqlClient->prepare($sqlQuery);
    $makeForm->execute();
    $makeFormResult = $makeForm->fetchAll();
    foreach ($makeFormResult as $makeFormResult) {
        ?>
        <div class="grayBox">
        <form method="post">
        Code de l'entrée dans la base de données (non modifiable): <?php echo $makeFormResult[0]; ?><input type="hidden" value="<?php echo $makeFormResult[0]; ?>" name="modified0"></br>
        Nom à modifier: <input type="text" value="<?php echo $makeFormResult[1];?>" name="modified1"></br>
        Adresse url à modifier: <input type="text" value="<?php echo $makeFormResult[2];?>" name="modified2"></br>
        Description à modifier: <input type="text" value="<?php echo $makeFormResult[3];?>" name="modified3"></br>
        <input class="button" type="submit">
        </form>
        </div>
        <?php
    }
    break;
// partie 2: formulaire de modifications
case(isset($_POST['modified0']) && isset($_POST['modified1']) && isset($_POST['modified2']) && isset($_POST['modified3'])): 
        $idNumber = $_POST['modified0'];
        $modified1 = $_POST['modified1'];
        $modified2 = $_POST['modified2'];
        $modified3 = $_POST['modified3'];
        $sqlQuery = "UPDATE liens SET nom = '$modified1', url = '$modified2', description = '$modified3' WHERE numero = '$idNumber'";
        $updateForm = $mysqlClient->prepare($sqlQuery);
        $updateForm->execute();
        echo '<script>alert("Votre entrée a bien été modifiée!")</script>';
    break; 
}

?>
