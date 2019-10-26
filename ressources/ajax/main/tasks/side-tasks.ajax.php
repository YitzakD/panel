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

	$sessionpseudo = get_session("pseudo");

	$upref = find_one("uprefs", "uid", $sessionid);

	$taskscounter = count_all("tasks", "WHERE starter='$sessionid' OR reciever='$sessionid'");

	$tasks = find_all("tasks", "WHERE starter='$sessionid' OR reciever='$sessionid' ORDER BY state");

	?>

	<div class="d-block">
	
		<div class="row no-gutters p-4 p-notebook-head">
			
			<div class="col-8 col-sm-8 col-md-9 col-lg-10">
				
				<h5 class="h5">Tâches</h5>

			</div>

			<div class="col-4 col-sm-4 col-md-3 col-lg-2 text-right">
				
				<a href="#" class="btn btn-sm btn-primary p-btn-primary" id="p-hide-tasks-sidebar-toggle"><i class="fas fa-times"></i></a>

			</div>

		</div>

		<div class="p-addressbook pb-2 pt-2" id="p-addressbook">

			<small class="relative">

			<?php if($taskscounter > 0): ?>

				<div class="d-block pl-4 pr-4">

			<?php foreach($tasks as $item): ?>

				<?php $sender = find_one("users", "id", $item->starter); ?>

				<?php $reciever = find_one("users", "id", $item->reciever); ?>

				<div class="p-portlet rounded" style="border: 1px solid <?= $upref->stylemode === 'D' ? '#394046' : '#DEE2E6'; ?>">
					
					<div class="p-portlet-head">
				
						<div class="p-portlet-head-label">
							
						<?php if($item->starter === $sessionid): ?>

							<h3 class="text-uppercase"><?= $reciever->pseudo; ?></h3>

						<?php else: ?>

							<h3 class="text-uppercase"><?= $sender->pseudo; ?></h3>

						<?php endif; ?>	

						</div>

					</div>

					<div class="d-block pl-4 pr-4 pt-2 pb-4">

						<?= read_more($item->task, "10"); ?>

						<small class="d-block text-muted"><?= set_time($item->created); ?></small>

					</div>

					<div class="d-block pl-4 pr-4 pt-3 pb-3 text-right small text-uppercase" style="background-color: rgba(0, 0, 0, 0.05);">

					<?php if($item->starter === $sessionid): ?>

						<?php if($item->state !== "closed"): ?>

							<?php if($item->state !== "done"): ?>

								<a href="#" class="mr-4" id="p-task-edit-tool" accesskey="<?= $item->id; ?>">Modifier</a>

							<?php endif; ?>

							<a href="#" id="p-task-state-change" accesskey="<?= $item->id; ?>">Terminer</a>

						<?php else: ?>
						
							<span class="text-muted">Tâche éffectuée</span>

						<?php endif; ?>

					<?php else: ?>

						<a href="#" class="mr-4" id="p-task-see-tool" accesskey="<?= $item->id; ?>">Voire</a>

						<?php if($item->state === "initiate"): ?>
						
							<a href="#" id="p-task-state-change" accesskey="<?= $item->id; ?>">Exécuter</a>

						<?php elseif($item->state === "standby"): ?>
						
							<a href="#" id="p-task-state-change" accesskey="<?= $item->id; ?>">Procéder</a>

						<?php elseif($item->state === "done"): ?>
						
							<span class="text-muted">En attente</span>

						<?php else: ?>
						
							<span class="text-success">Tâche éffectuée</span>

						<?php endif; ?>

					<?php endif; ?>

					</div>

				</div>

			<?php endforeach; ?>

				</div>

			<?php else: ?>

				<span class="d-block p-4 text-center text-muted">

					<h5><i class="fas fa-box-open mr-2"></i>Liste vide!</h5>

					<p>Vous n'avez aucune tâches pour le moment</p>

				</span>

			<?php endif; ?>

			<?php if(get_session("type") === "2" || get_session("type") === "3"): ?>

				<div class="p-add-task" id="p-add-task"><i class="fas fa-plus"></i></div>

			<?php endif; ?>

			</small>	

		</div>

	</div>
	
	<?php

}

?>