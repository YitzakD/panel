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

if(get_session("uid")) {

	$error = [];

	extract($_POST);

	$sessionid = get_session("uid");

	$unreadmsg = 0;

	$chatinfos = find_all("init_chat", "WHERE (starter='$sessionid') OR (reciever='$sessionid')");
	if(count($chatinfos) > 0) {
		
	
		foreach($chatinfos as $item) {
			
			$hash = $item->chathash;

			$msgcounter = count_all("chat", "WHERE chathash='$hash' AND sender!='$sessionid' AND etat='0'");

			$unreadmsg = $unreadmsg + $msgcounter;
		
		}
	
	}

	if($unreadmsg > 0) { echo $unreadmsg; }

}

?>