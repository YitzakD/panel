<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */


/**Vérification des parametres d'URL par le server #*/

$requri = $_SERVER["REQUEST_URI"];

$requri = trim($requri, '/');

$parm = explode('/', $requri);



if($parm[0] != "") {

	if($parm[0] === "?r=login") {

		$mod = $parm[0];

		##Envoie |uid| à la session ##
		
		if(isset($_SESSION['uid'])) {

			$_SESSION['fwu'] = $mod.'/';
		
			header('Location:?r=login/');	
	   		
	   		exit();

		}

	} elseif($parm[0] === "?r=register" || $parm[0] === "?r=recovery" || $parm[0] === "?r=reset") {

		$mod = $parm[0];

		if(isset($_SESSION['uid'])) {

			$_SESSION['fwu'] = $mod.'/';
		
			header('Location:' . $mod.'/');	
	   		
	   		exit();

		}

	} else {

		$mod = $parm[0];

		if(isset($_SESSION['uid']) || isset($_SESSION['pseudo'])) {}

		else {

			$_SESSION['fwu'] = $mod.'/';
		
			header('Location:?r=login/');	
	   		
	   		exit();

		}

	}

} else {

	if(!isset($_SESSION['uid'])) {

		$_SESSION['fwu'] = "?r=dashboard/";
	
		header('Location:?r=login/');	
   		
   		exit();

	} else {

		$_SESSION['fwu'] = "?r=dashboard/";

		$fwu = $_SESSION['fwu'];

		header('Location:' . $fwu);

		exit();

	}

}



if(count($parm) > 1) {

	$con = $parm[1];

	if(isset($parm[2])) { $vue = $parm[2]; }

	if(isset($parm[3])) { $rvue = $parm[3]; }

	$ID = end($parm);

}



$m = explode('=', $mod);




/**Réccupération de l'URL par la variable _GET #*/

$G = $_GET["r"];

$G = trim($G, '/');

$get = explode('/', $G);