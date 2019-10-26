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


if(isset($_POST['taskid'])) {

	$error = [];

	extract($_POST);

	$sessionid = get_session("uid");

	$sessionpseudo = get_session("pseudo");

	$taskcounter = cell_count("tasks", "id", $taskid);

	$task = find_one("tasks", "id", $taskid);

	$sessionid = get_session("uid");

	$upref = find_one("uprefs", "uid", $sessionid);

	?>

	<div class="d-block">
	
		<div class="row no-gutters p-4 p-notebook-head">
			
			<div class="col-8 col-sm-8 col-md-9 col-lg-10">
				
				<h5 class="h5">Ma tâche</h5>

			</div>

			<div class="col-4 col-sm-4 col-md-3 col-lg-2 text-right">
				
				<a href="#" class="btn btn-sm btn-primary p-btn-primary" id="p-hide-task-board-sidebar-toggle"><i class="fas fa-times"></i></a>

			</div>

		</div>

		<div class="p-addressbook pb-2 pt-2" id="p-addressbook">

			<small>

				<div class="d-block pl-4 pr-4 pt-2 pb-2">
					
					<div class="d-block pl-4 pr-4 pb-2 mb-2 text-right small text-uppercase" style="border-bottom: 1px solid <?= $upref->stylemode === 'D' ? '#394046' : '#DEE2E6'; ?>">
						
						<?php if($task->state === "initiate"): ?>
						
							<a href="#" id="p-task-state-change" accesskey="<?= $task->id; ?>">Exécuter</a>

						<?php elseif($task->state === "standby"): ?>
						
							<a href="#" id="p-task-state-change" accesskey="<?= $task->id; ?>">Procéder</a>

						<?php elseif($task->state === "done"): ?>
						
							<span class="text-muted">En attente</span>

						<?php else: ?>
						
							<span class="text-success">Tâche éffectuée</span>

						<?php endif; ?>

					</div>

					<div class="mb-4">

						<div class="mb-0 text-muted">Il vous reste</div>

						<div>

							<?= nbJours($task->created, $task->deadline) > 1 ? nbJours($task->created, $task->deadline) . " jours" : nbJours($task->created, $task->deadline) . " jour"; ?>

						</div>

					</div>

					<div class="mb-4">

						<div class="mb-0 text-muted">Que devez-vous faire?</div>

						<div class=""><?= nl2br($task->task); ?></div>

					</div>

					<div class="mb-4">

						<div class="mb-0 text-muted">A exécuter au plus tard</div>

						<div><?= date('j/n/Y ', strtotime($task->deadline)); ?></div>

					</div>

				</div>

			</small>	

		</div>

	</div>
	
	<?php

}

?>