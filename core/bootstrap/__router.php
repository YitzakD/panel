<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */


/**Vérification des parametres d'URL par le server #*/

$requri = $_SERVER["REQUEST_URI"];

$requri = trim($requri, '/');

$parm = explode('/', $requri);


$m = $parm[1];

if(count($parm) > 2) {

	if(isset($parm[2])) { $con = $parm[2]; }

	if(isset($parm[3])) { $vue = $parm[3]; }

	if(isset($parm[4])) { $svue = $parm[4]; }

	$ID = end($parm);
	
}