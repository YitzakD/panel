

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


	$chatinfos = find_one("init_chat", "starter", $sessionid, "AND reciever='$reciever' OR (starter='$reciever' AND reciever='$sessionid')");

	$chathash = $chatinfos->chathash;

	$chatscounter = count_all("chat", "WHERE chathash='$chathash'");

	$chats = find_all("chat", "WHERE chathash='$chathash' ORDER BY id DESC");

	$recieverinfo = find_one("users", "id", $reciever);

?>

<?php if($chatscounter > 0): ?>

<?php foreach($chats as $item): ?>

	<?php if($item->sender === $sessionid): ?>

		<div class="chat-messages chat-messages-sender">
			
			<div class="message" id="chat-message">

				<?= nl2br($item->msg); ?>

				<div class="small message-time text-right" id="chatbox-mt"><?= set_time($item->created); ?></div>

			</div>

		</div>

	<?php else: ?>

		<div class="chat-messages chat-messages-receiver">
			
			<div class="message" id="chat-message">

				<?= nl2br($item->msg); ?>

				<div class="small text-muted message-time text-left" id="chatbox-mt"><?= set_time($item->created); ?></div>

			</div>

		</div>

	<?php endif; ?>

<?php endforeach; ?>

<?php else: ?>

	<div class="d-flex align-items-center h-100 w-100" style="height: 22rem!important;">

		<div class="d-flex flex-column">

			<div class="text-center h6 align-middle">Nous n'avons trouvez aucun échanges entre vous et <?= $recieverinfo->pseudo; ?></div>

			<div class="small text-center text-muted">Evoyez lui un message en tapant sur <code>Entrer</code></div>
			
		</div>

	</div>

<?php endif; ?>

<?php

}

?>