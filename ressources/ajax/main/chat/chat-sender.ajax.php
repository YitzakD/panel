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

if(get_session("uid") && isset($_POST['chathash']) && isset($_POST['msg'])) {

	$error = [];

	extract($_POST);

	$sessionid = get_session("uid");

	$sessionpseudo = get_session("pseudo");

	$chatinfos = find_one("init_chat", "chathash", $chathash);

	$q = $db->prepare("INSERT INTO chat(chathash,sender,msg,created) VALUES(:chathash, :sender, :msg, :created)");

	$q->execute([
		'chathash' => $chathash,
		'sender' => $sessionid,
		'msg' => $msg,
		'created' => date('Y-m-d H:i:s')
	]);

	if($chatinfos->starter === $sessionid) {
	
		set_notifier("S", "Vous avez récu un message de $sessionpseudo", $sessionid, $chatinfos->reciever, "");

	} else {
	
		set_notifier("S", "Vous avez récu un message de $sessionpseudo", $sessionid, $chatinfos->starter, "");

	}

}

?>