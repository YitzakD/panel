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

if(get_session("uid") && isset($_POST['reciever']) && is_numeric($_POST['reciever'])) {

	$error = [];

	extract($_POST);

	$sessionid = get_session("uid");

	$pref = find_one("uprefs", "uid", $reciever);

	$_chatinfoscounter = cell_count("init_chat", "starter", $sessionid, "AND reciever='$reciever'");

	$_chatinfoscounter__ = cell_count("init_chat", "starter", $reciever, "AND reciever='$sessionid'");

	if(($_chatinfoscounter > 0) || ($_chatinfoscounter__ > 0)) {

		$chatinfos = find_one("init_chat", "starter", $sessionid, "AND reciever='$reciever' OR (starter='$reciever' AND reciever='$sessionid')");

		$chathash = $chatinfos->chathash;

		$recieverinfo = find_one("users", "id", $reciever);

	} else {

		$chathash = geraHash(12);

		$q = $db->prepare("INSERT INTO init_chat(chathash,starter,reciever) VALUES(:chathash, :starter, :reciever)");

		$q->execute([
			'chathash' => $chathash,
			'starter' => $sessionid,
			'reciever' => $reciever
		]);

		$recieverinfo = find_one("users", "id", $reciever);

	}

	update_all("chat", "etat", "1", "WHERE sender!='$sessionid' AND chathash='$chathash'");

?>

<div class="chatbox-header">
	
	<div class="d-block p-4">

		<span class="chatbox-close d-inline h4 m-2" id="cbcloser"><i class="fas fa-chevron-left"></i></span>

		<span class="d-inline h4 m-2 text-capitalize"><?= $recieverinfo->pseudo; ?></span>

		<small><?= $pref->onlinemode === "1" ? "En ligne" : "Hors ligne"; ?></small>

	</div>

</div>

<div class="chatbox-separator"></div>

<div class="chatbox-contenor">
	
	<div class="chat-loader pr-4 pl-4 pt-3 d-flex flex-column-reverse" id="cbic"></div>

	<div class="chatbox-form pb-2">

		<input type="hidden" id="chathash" value="<?= $chathash; ?>">

		<textarea class="chatbox-entry" id="elasticarea" placeholder="Entrez votre message."></textarea>

	</div>

</div>	

<?php

}

?>