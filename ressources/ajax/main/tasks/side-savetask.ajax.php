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


if(isset($_POST['taskr']) && isset($_POST['taskd']) && isset($_POST['task'])) {

	$error = [];

	extract($_POST);

	$sessionid = get_session("uid");

	$sessionpseudo = get_session("pseudo");

	$date = DateTime::createFromFormat('Y-m-d', $taskd);


	
	if(!is_numeric($taskr) && cell_count("users", "id", $taskr) < 1) {

		$error[] = "Impossible de trouver cet utilisateur";

	}
	
	if($date === false) {

		$error[] = "La date que vous avez saisie n'est pas valide";

	}

	$q = $db->prepare("INSERT INTO tasks(starter,reciever,task,deadline,created) VALUES(:starter, :reciever, :task, :deadline, :created)");

	$q->execute([
		'starter' => $sessionid,
		'reciever' => $taskr,
		'task' => $task,
		'deadline' => $taskd,
		'created' => date('Y-m-d H:i:s')
	]);

	set_notifier("H", "Vous avez récu une tâche de $sessionpseudo", $sessionid, $taskr, "");

	echo "true";

}

?>