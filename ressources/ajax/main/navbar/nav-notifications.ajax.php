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

	$pseudo = get_session("pseudo");
	
	$thenotificationscounter = count_all("notifications", "WHERE dest='$uid' AND state='on'");

	$thenotifications = find_all("notifications", "WHERE dest='$uid' AND state='on' ORDER BY created DESC");

	$notificationscounter = count_all("notifications", "WHERE dest='$uid'");
					
	$notifications = find_all("notifications", "WHERE dest='$uid' AND state='off' ORDER BY created DESC LIMIT 0,10");

?>

	<?php if($thenotificationscounter > 0): ?>

	<div class="p-notification-header pl-3 pr-3 pb-2 pt-2 text-muted small border-bottom">

		<span class="text-uppercase">Nouveau</span>

		<span class="d-inline-block float-right"><a href="<?= $WURI[0] . '?r=profil/notifications/lire-tout/'; ?>">Tout marquer comme lu</a></span>

	</div>

	<?php foreach($thenotifications as $item): ?>

	<?php $si = find_one("users", "id", $item->starter_id); ?>

		<div href class="p-notification p-notification-clickable">

			<a href="<?= $WURI[0] . '?r=notifications/notif/' . $item->id . '/'; ?>">

				<div class="text-capitalize">

					<div class="p-notification-indicator bg-primary rounded"></div>

					<strong><?= $si->pseudo ;?></strong>
						
				</div>

				<div><?= $item->description; ?></div>

				<div>
					
					<span class="d-inline small p-0"><?= $item->type === "H" ? "<i class='fas fa-angle-double-up text-danger'></i>" : "<i class='fas fa-angle-right text-primary'></i>"; ?></span>
					<span class="d-inline small text-muted ml-2 p-0"><?= set_time($item->created); ?></span>
						
				</div>

			</a>
				
		</div>

	<?php endforeach; ?>

	<?php endif; ?>

	<div class="p-notification-header pl-3 pb-2 pt-2 text-muted small text-uppercase border-bottom">Plus tôt</div>

	<?php foreach($notifications as $item): ?>

	<?php $si = find_one("users", "id", $item->starter_id); ?>

		<div href class="p-notification p-notification-clickable">

			<a href="<?= $WURI[0] . '?r=notifications/notif/' . $item->id . '/'; ?>">

				<div class="text-capitalize">

					<span><?= $si->pseudo ?></span>
						
				</div>

				<div><?= $item->description; ?></div>

				<div>
					
					<span class="d-inline small p-0"><?= $item->type === "H" ? "<i class='fas fa-angle-double-up text-danger'></i>" : "<i class='fas fa-angle-right text-primary'></i>"; ?></span>
					<span class="d-inline small text-muted ml-2 p-0"><?= set_time($item->created); ?></span>
						
				</div>

			</a>
				
		</div>

	<?php endforeach; ?>

<?php 

}

?>