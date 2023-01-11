<?php
try
{
    $mysqlClient = new PDO('mysql:host=localhost;dbname=brief5;charset=utf8', 'root', '' );
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage("Il y a une erreur!" ));
}

if(isset($_POST['buttonShow'])) {
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
}  
if(isset($_POST['buttonErase'])) {
    $_POST = NULL ; 
}
if (isset($_POST['newLinkName']) && isset($_POST['newLinkAddress']) && isset($_POST['newLinkDescription'])) {
    $newLinkName = $_POST['newLinkName'];
    $newLinkAddress = $_POST['newLinkAddress'];
    $newLinkDescription = $_POST['newLinkDescription'];
    $sqlQuery = "INSERT INTO `liens` (`nom`, `url`, `description`) VALUES ('$newLinkName', '$newLinkAddress', '$newLinkDescription')";
    $newDbEntry = $mysqlClient->prepare($sqlQuery);
    $newDbEntry->execute();
    echo '<script>alert("Votre entrée a bien été ajoutée!")</script>';
}
if (isset($_POST['numberDelete'])) {
    $numberDelete = $_POST['numberDelete'];
    $sqlQuery = "DELETE FROM `liens` WHERE `liens`.`numero` = '$numberDelete'";
    $deleteEntry = $mysqlClient->prepare($sqlQuery);
    $deleteEntry->execute();
    echo '<script>alert("Votre entrée a bien été supprimée!")</script>';
}
if (isset($_POST['findIdNumber'])) {
    $idNumber = $_POST['findIdNumber'];
    $sqlQuery = "SELECT * FROM liens WHERE numero = '$idNumber'";
    $makeForm = $mysqlClient->prepare($sqlQuery);
    $makeForm->execute();
    $makeFormResult = $makeForm->fetchAll();

    foreach ($makeFormResult as $makeFormResult) {
        ?>
        <div style="background-color:#c3c3c3;text-align:center;border-style:double;padding:1rem;margin:1rem;">
        <form method="post">
        Code de l'entrée dans la base de données (non modifiable): <?php echo $makeFormResult[0]; ?></br>
        <input type="hidden" value="<?php echo $makeFormResult[0]; ?>" name="modified0">
        Nom à modifier: <input type="text" value="<?php echo $makeFormResult[1];?>" name="modified1"></br>
        Adresse du site modifier: <input type="text" value="<?php echo $makeFormResult[2];?>" name="modified2"></br>
        Adresse complète à modifier: <input type="text" value="<?php echo $makeFormResult[3];?>" name="modified3"></br>
        Description à modifier: <input type="text" value="<?php echo $makeFormResult[4];?>" name="modified4"></br>
        <input type="submit">
        </form>
        </div>
        <?php
    }
}
if (isset($_POST['modified0']) && isset($_POST['modified1']) && isset($_POST['modified2']) && isset($_POST['modified3']) && isset($_POST['modified4'])) {
    $idNumber = $_POST['modified0'];
    $modified1 = $_POST['modified1'];
    $modified2 = $_POST['modified2'];
    $modified3 = $_POST['modified3'];
    $modified4 = $_POST['modified4'];
    $sqlQuery = "UPDATE liens SET nom = '$modified1', website = '$modified2', url = '$modified3', description = '$modified4' WHERE numero = '$idNumber'";
    $updateForm = $mysqlClient->prepare($sqlQuery);
    $updateForm->execute();
    echo '<script>alert("Votre entrée a bien été modifiée!")</script>';
}

$varTest = 'je teste je teste je teste ';

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