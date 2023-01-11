<?php
try
{
    $mysqlClient = new PDO('mysql:host=localhost;dbname=brief5;charset=utf8', 'root', '' );
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage("Il y a une erreur!" ));
}

//Template setup pt1/4
require_once('template.class.php');
define('TEMPLATES_PATH', 'templates');
//Instanciate new object 2/4
$template = new Template(TEMPLATES_PATH.'/tpl.html'); 
//Assign values 3/4
$template->assign('title', 'Bonjour');
$template->assign('text', 'Monde');
//Show content 4/4 
$template->show();
?>