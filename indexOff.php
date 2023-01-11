<!DOCTYPE html>
<html lang="en">
<?php
try
    {
        $mysqlClient = new PDO('mysql:host=localhost;dbname=brief5;charset=utf8', 'root', '' );
    }
catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage("Il y a une erreur!" ));
    }
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire du Brief 5</title>
</head>
<body style="background-color:#008080;">

<div style="background-color:#c3c3c3;text-align:center;border-style:double;padding:1rem;margin:1rem;">
    <p>Afficher ou cacher toutes les entrées de la base de données</p>
<form style="margin:auto;" method="post">
    <input type="submit" name="buttonShow" class="button" value="Afficher" />
    <input type="submit" name="buttonErase" class="button" value="Cacher" />
</form>
</div>

<?php
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
?>

<div style="background-color:#c3c3c3;text-align:center;border-style:double;padding:1rem;margin:1rem;">
<p>Ajouter une entrée dans la base de données</p>
<form method="post">
    Ajouter un nom à votre entrée: <input type="text" name="newLinkName">
    Ajouter l'adresse du site web: <input type="text" name="newLinkAddress">
    Ajouter une description: <input type="text" name="newLinkDescription">
    <input type="submit">
</form>
</div>

<?php
if (isset($_POST['newLinkName']) && isset($_POST['newLinkAddress']) && isset($_POST['newLinkDescription'])) {
    $newLinkName = $_POST['newLinkName'];
    $newLinkAddress = $_POST['newLinkAddress'];
    $newLinkDescription = $_POST['newLinkDescription'];
    $sqlQuery = "INSERT INTO `liens` (`nom`, `url`, `description`) VALUES ('$newLinkName', '$newLinkAddress', '$newLinkDescription')";
    $newDbEntry = $mysqlClient->prepare($sqlQuery);
    $newDbEntry->execute();
    echo '<script>alert("Votre entrée a bien été ajoutée!")</script>';
}
?>

<div style="background-color:#c3c3c3;text-align:center;border-style:double;padding:1rem;margin:1rem;">
<p>Supprimer une entrée dans la base de données</p>
<form method="post">
    Sélectionner le numéro de l'entrée: <input type="int" name="numberDelete">
    <input type="submit">
</form>
</div>

<?php
if (isset($_POST['numberDelete'])) {
    $numberDelete = $_POST['numberDelete'];
    $sqlQuery = "DELETE FROM `liens` WHERE `liens`.`numero` = '$numberDelete'";
    $deleteEntry = $mysqlClient->prepare($sqlQuery);
    $deleteEntry->execute();
    echo '<script>alert("Votre entrée a bien été supprimée!")</script>';
}
?>

<div style="background-color:#c3c3c3;text-align:center;border-style:double;padding:1rem;margin:1rem;">
<p>Modifier une entrée dans la base de données</p>
<form method="post">
    Veuillez indiquer le numéro de l'entrée: <input type="int" name="findIdNumber">
    <input type="submit">
    <input type="submit" name="buttonErase" class="button" value="Effacer" />
</form>

<?php
if (isset($_POST['findIdNumber'])) {
    $idNumber = $_POST['findIdNumber'];
    $sqlQuery = "SELECT * FROM liens WHERE numero = '$idNumber'";
    $makeForm = $mysqlClient->prepare($sqlQuery);
    $makeForm->execute();
    $makeFormResult = $makeForm->fetchAll();

    foreach ($makeFormResult as $makeFormResult) {
        ?>
        <form method="post">
        Code de l'entrée dans la base de données (non modifiable): <?php echo $makeFormResult[0]; ?></br>
        <input type="hidden" value="<?php echo $makeFormResult[0]; ?>" name="modified0">
        Nom à modifier: <input type="text" value="<?php echo $makeFormResult[1];?>" name="modified1"></br>
        Adresse du site modifier: <input type="text" value="<?php echo $makeFormResult[2];?>" name="modified2"></br>
        Adresse complète à modifier: <input type="text" value="<?php echo $makeFormResult[3];?>" name="modified3"></br>
        Description à modifier: <input type="text" value="<?php echo $makeFormResult[4];?>" name="modified4"></br>
        <input type="submit">
        </form>
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
?>
</div>

</body>
</html>