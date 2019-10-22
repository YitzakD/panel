<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

setcookie('auth', '', time()-3600);



$field = "Authentification";

$title = $m[1] . ', ' . $_SESSION['pseudo'];

$msg = "Vous êtes bien déconnecté(e).";

$year = date("Y");

set_activity($_SESSION['uid'], $field, $title, $msg);



if(cell_count("auth_tokens", "uid", $_SESSION['uid'])) {

    $q = $db->prepare("UPDATE uprefs SET sessionmode='0' WHERE uid=?");

    $q->execute([$_SESSION['uid']]);

	$q->closeCursor();


	delete_one("auth_tokens", "uid", $_SESSION['uid']);

}

update_all("uprefs", "onlinemode", "0", "WHERE uid='".$_SESSION['uid']."'");

session_destroy();

$_SESSION = [];

$_COOKIE = [];

header('Location:' . WURI . '?r=login/');

?>