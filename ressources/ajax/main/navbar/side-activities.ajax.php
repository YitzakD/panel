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

	$uid = get_session("uid");

	$activitiescounter = cell_count("activities", "uid", $uid);

	$activities = find_all("activities", "WHERE uid='$uid' ORDER BY id DESC LIMIT 0,25");

?>

	<?php if($activitiescounter > 0): ?>

	<?php foreach($activities as $item): ?>
	
	<div class="p-timeline-item">
		
		<div class="p-timeline-item-section">
			
			<div class="p-timeline-is-border">
				
				<div class="p-timeline-is-icon">

					<?php if($item->field == "edition" || $item->field === "choix-banque"): ?>

						<i class="fas fa-pencil-alt text-warning"></i>

					<?php elseif($item->field == "suppression"): ?>	

						<i class="fas fa-eraser text-danger"></i>

					<?php elseif($item->field == "validation"): ?>	

						<i class="fas fa-check text-success"></i>

					<?php elseif($item->field == "Authentification" || $item->field === "notifications" || $item->field === "activites"): ?>	

						<i class="fas fa-user-circle text-primary"></i>

					<?php elseif($item->field == "nouvel" || $item->field == "nouveau" || $item->field == "nouvelle" || $item->field === "nouveau-compte" || $item->field === "nouvelle transaction bancaire"): ?>	

						<i class="fas fa-plus text-secondary"></i>

					<?php elseif($item->field == "ajout-image"): ?>	

						<i class="fas fa-image text-secondary"></i>

					<?php elseif($item->field === "reglages"): ?>	

						<i class="fas fa-cogs text-dark"></i>

					<?php elseif($item->field == "infos" || $item->field == "transactions" || $item->field == "complete" || $item->field == "transaction" || $item->field === "details"): ?>	

						<i class="fas fa-info text-warning"></i>

					<?php endif; ?>	

				</div>

			</div>

			<span class="p-timeline-is-field">
				<span class="text-capitalize"><?= $item->field; ?></span>
				&nbsp;-&nbsp;<small><?= set_time($item->created); ?></small>
			</span>

		</div>

		<a href class="p-timeline-item-text"><?= $item->activity; ?></a>

		<a href class="p-timeline-item-info"><?= $item->title; ?></a>

	</div>

	<?php endforeach; ?>

	<div class="p-timeline-item-see-all">
		
		<a href="?r=profil/activites/" class="text-center font-weight-bold">Tout voir</a>

	</div>	

	<?php else: ?>
	
	<div class="d-block text-center p-3 text-muted">Aucunes activités détecter.</div>

	<?php endif; ?>	

<?php	

}

?>