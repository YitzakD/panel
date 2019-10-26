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

	$task = find_one("tasks", "id", $taskid);

	if($sessionid === $task->starter) {

		$q = $db->prepare("UPDATE tasks SET state=:state, created=:created WHERE id=:id AND starter=:starter");

		$q->execute([
			'state' => "closed",
			'created' => date('Y-m-d H:i:s'),
			'id' => $taskid,
			'starter' => $sessionid
		]);

		set_notifier("S", "$sessionpseudo a mit fin à votre tâche", $sessionid, $task->reciever, "");

		echo "true";

	} else {

		$user = find_one("users", "id", $task->reciever);

		if($task->state === "initiate") {

			$q = $db->prepare("UPDATE tasks SET state=:state, created=:created WHERE id=:id");

			$q->execute([
				'state' => "standby",
				'created' => date('Y-m-d H:i:s'),
				'id' => $taskid
			]);

			set_notifier("S", "$user->pseudo a commencé à exécuter votre tâche", $task->reciever, $task->starter, "");

			echo "true";

		} elseif($task->state === "standby") {


			$q = $db->prepare("UPDATE tasks SET state=:state, created=:created WHERE id=:id");

			$q->execute([
				'state' => "done",
				'created' => date('Y-m-d H:i:s'),
				'id' => $taskid
			]);

			set_notifier("H", "$user->pseudo a procédé à votre tâche. Cliquez sur &nbsp;<code>Terminer</code>&nbsp; pour conclure la tâche", $task->reciever, $task->starter, "");

			echo "true";

		}

	}

}

?>