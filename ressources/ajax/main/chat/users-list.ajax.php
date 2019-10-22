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

	$sessionid = get_session("uid");

	$users = find_all("users", " WHERE id!='$sessionid' AND active='1'");

?>

<div class="chatbox-header">
	
	<div class="d-block p-4">

		<h4 class="text-center m-2">Bonjour&nbsp;<?= get_session("pseudo"); ?></h4>

	</div>

</div>

<div class="chatbox-separator"></div>

<div class="chatbox-contenor">
	
	<div class="chatbox-inner-contenor pr-4 pl-4" id="cbic">
		
	<?php foreach($users as $item): ?>

		<?php $utype = find_one("utypes", "id", $item->utid); ?>

		<?php $upref = find_one("uprefs", "uid", $item->id); ?>

		<?php $chatinfoscounter = cell_count("init_chat", "starter", $sessionid, "AND reciever='$item->id' OR (starter='$item->id' AND reciever='$sessionid')"); ?>


		<?php if($chatinfoscounter > 0): ?>
	
			<?php $chatinfos = find_one("init_chat", "starter", $sessionid, "AND reciever='$item->id' OR (starter='$item->id' AND reciever='$sessionid')"); ?>

			<?php $hash = $chatinfos->chathash; ?>

			<?php $msgcounter = count_all("chat", "WHERE chathash='$hash' AND sender='$item->id' AND etat='0'"); ?>

		<?php endif; ?>
		
		<a href class="chatbox-user" id="chatboxuser" accesskey="<?= $item->id; ?>">

			<div class="chatbox-user-item-icon">

				<?php $in = explode(" ", $item->pseudo); ?>

				<?php if($chatinfoscounter > 0 && $msgcounter > 0): ?>

					<span class="chatbox-user-badge"><small class="badge badge-danger"><?= $msgcounter; ?></small></span>

				<?php endif; ?>
										
				<span class="d-block p-datatable-pic text-center">
					<div class="p-datatable-avatarname text-uppercase" style="background-color: <?= '#'.RandomCouleur(); ?>"><?= isset($in[1][0]) ? $avatarname = $in[0][0].$in[1][0] : $avatarname = $in[0][0]; ?></div>
				</span>
				
				<span class="<?= $upref->onlinemode === '1' ? 'chatbox-user-online' : ''; ?>"></span>

			</div>

			<div class="chatbox-user-item-title">
			
				<span><?= ucfirst($item->pseudo); ?></span>
			
			</div>

			<div class="chatbox-user-item-desc">
				
				<small class="d-block"><?= $utype->utype_name; ?></small>

			</div>

		</a>

	<?php endforeach; ?>

	</div>

</div>

<?php

}

?>