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

$URI = $_SERVER["HTTP_REFERER"];
$WURI = explode('?r=', $URI);


session_start();

include_once $CORE.$DS.'config/db.config.php';
include_once $CORE.$DS.'includes/global.func.php';
include_once $CORE.$DS.'includes/log.func.php';
include_once $CORE.$DS.'includes/session.func.php';
include_once $CORE.$DS.'includes/regie.func.php';


if(get_session("uid")) {

	$uid = get_session("uid");

	$upref = find_one("uprefs", "uid", $uid);

	if($upref->stylemode === "C") {

		update_one("uprefs", "stylemode", "D", $upref->id);

		echo $WURI[0]."ressources/public/css/panel-dark.style.css";

	} else {

		update_one("uprefs", "stylemode", "C", $upref->id);

		echo $WURI[0]."ressources/public/css/panel.style.css";

	}

}

?>