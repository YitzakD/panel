<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

/** Constante d'environnement pour atteindre des dossiers spécifiques #*/
$WEBROOT = dirname(dirname(dirname(__FILE__)));
$ROOT = dirname(dirname($WEBROOT));
$DS = DIRECTORY_SEPARATOR;
$CORE = $ROOT.$DS.'core';


session_start();

include_once $CORE.$DS.'config/db.config.php';
include_once $CORE.$DS.'includes/global.func.php';
include_once $CORE.$DS.'includes/log.func.php';
include_once $CORE.$DS.'includes/session.func.php';
include_once $CORE.$DS.'includes/regie.func.php';

if(isset($_POST['dataitem']) && is_numeric($_POST['dataitem'])) {

	$error = [];

	extract($_POST);

	$note = find_one("notebook", "id", $dataitem);

	if($note->note !== "") { $newenter = $note->note . " " . $newadd; }
	else { $newenter = $newadd; }

	if(filter_var($newadd, FILTER_VALIDATE_EMAIL)) {

    	update_one("notebook", "note", $newenter, $dataitem);

    	echo "";

    } elseif(is_numeric($newadd) && mb_strlen($newadd) > 7) {

    	update_one("notebook", "note", $newenter, $dataitem);

    	echo "";

	} else {

		$error[] = "votre saisie ne correspond pas à un numéro de téléphone (Le numéro de téléphone doit contenir au moins huit (8) chiffres).";

        $error[] = "l'adresse e-mail saisie n'est pas valide.";
	
    }

    if(count($error) != 0) {

    	foreach ($error as $key => $value) {

            if($key > 0) {

        		echo "<span class='d-block text-danger'>ou que " . $value . "</span>";
            
            } else {

                echo "<span class='d-block text-danger'>Il me semble que " . $value . "</span>";

            }

    	}

    }

?>

<?php } ?>