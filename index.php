<?php
//Setup
require_once('template.class.php');
define('TEMPLATES_PATH', 'templates');

//Instanciate new object
$template = new Template(TEMPLATES_PATH.'/tpl.html'); 

//Assign values
$template->assign('title', 'Hello');
$template->assign('text', 'World');

//Show content
$template->show();
?>