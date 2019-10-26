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

	$sessiontype = get_session("type");

	$task = find_one("tasks", "id", $taskid);

	$user = find_one("users", "id", $task->reciever);

	?>

	<div class="d-block">
	
		<div class="row no-gutters p-4 p-notebook-head">
			
			<div class="col-8 col-sm-8 col-md-9 col-lg-10">
				
				<h5 class="h5">Modifier une tâche</h5>

			</div>

			<div class="col-4 col-sm-4 col-md-3 col-lg-2 text-right">
				
				<a href="#" class="btn btn-sm btn-primary p-btn-primary" id="p-hide-tasks-item-toggle"><i class="fas fa-times"></i></a>

			</div>

		</div>

		<div class="p-addressbook pl-4 pr-4 pb-2 pt-2" id="p-addressbook">

			<div id="task-error" class="text-danger text-center" style="font-size: .83rem;"></div>

			<div class="mb-4" style="font-size: .83rem;">

				<label for="task_reciever" class="mb-0">Exécutant</label>

				<div class="text-uppercase font-weight-bold"><?= $user->pseudo; ?></div>

			</div>

			<div class="mb-4"  style="font-size: .83rem;">

				<label for="task_deadline" class="mb-0">Date butoire</label>

				<input type="date" name="task_deadline" class="form-control p-form-ctrl p-form-ctrl-sm" id="up_task_deadline" value="<?= $task->deadline; ?>" placeholder="Entrez une date butoire" required />

			</div>

			<div class="mb-4"  style="font-size: .83rem;">

				<label for="task_desc" class="mb-0">Description</label>

				<textarea name="task_desc" class="form-control p-form-ctrl p-form-ctrl-sm" id="elasticarea" placeholder="Décrivez la tâche" required><?= $task->task ?></textarea>

			</div>


			<div class="mb-4 text-right"  style="font-size: .83rem;">

				<button type="submit" id="p-edit-task-btn" class="btn btn-sm btn-primary p-btn-primary mb-3 mr-1">Modifier</button>

			</div>

		</div>

	</div>
	
	<?php	

}

?>