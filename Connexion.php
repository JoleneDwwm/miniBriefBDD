<?php

// MODEL 

try
{
    $mysqlClient = new PDO('mysql:host=localhost;dbname=brief5;charset=utf8', 'root', '' );
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage("Erreur survenue lors de la connexion à la base de données" ));
}
