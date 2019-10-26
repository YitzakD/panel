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


if(isset($_POST['taskd']) && isset($_POST['task']) && isset($_POST['taskid'])) {

	$error = [];

	extract($_POST);

	$sessionid = get_session("uid");

	$sessionpseudo = get_session("pseudo");

	$task = find_one("tasks", "id", $taskid);

	$date = DateTime::createFromFormat('Y-m-d', $taskd);
	
	if($date === false) {

		$error[] = "La date que vous avez saisie n'est pas valide";

	}

	if(!is_numeric($taskid) && cell_count("tasks", "id", $taskid) < 1) {

		$error[] = "Impossible de trouver cette tâche dans la base de données";

	}

	$q = $db->prepare("UPDATE tasks SET task=:task, deadline=:deadline, created=:created WHERE id=:id AND starter=:starter");

	$q->execute([
		'task' => $task,
		'deadline' => $taskd,
		'created' => date('Y-m-d H:i:s'),
		'id' => $taskid,
		'starter' => $sessionid
	]);

	set_notifier("S", "Vous avez une tâche de $sessionpseudo qui a étémodifié", $sessionid, $task->reciever, "");

	echo "true";

}

?>