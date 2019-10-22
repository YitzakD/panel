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

    $split = explode(" ", $note->note);

	unset($split[$tagkey]);

    $split = array_merge($split);

    $newenter = implode(" ", $split);

    update_one("notebook", "note", $newenter, $dataitem);

?>

<?php } ?>