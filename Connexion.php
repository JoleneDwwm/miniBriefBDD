<?php

// MODEL 

try
{
    $mysqlClient = new PDO('mysql:host=aws.connect.psdb.cloud;dbname=brief5;charset=utf8', 'sal9oejw5lvfm8j9prto', 'pscale_pw_om9oqQZsFlZfQAP3qf3VaA3AjmGK0oy9HegTky9HBNa' );
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage("Erreur survenue lors de la connexion à la base de données" ));
}
