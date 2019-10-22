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
	
	$counter = cell_count("auth_tokens", "uid", $uid);

	if($counter > 0) {

	    $q = $db->prepare("UPDATE uprefs SET sessionmode='0' WHERE uid=?");

	    $q->execute([$uid]);

		$q->closeCursor();

		/**/

		delete_one("auth_tokens", "uid",$uid);

		$_COOKIE = [];

	} else {

	    $q = $db->prepare("UPDATE uprefs SET sessionmode='1' WHERE uid=?");

	    $q->execute([$uid]);

		$q->closeCursor();

		/**/

		$token = geraHash(24);

        do {
            
            $selector = geraHash(9);

        } while(cell_count('auth_tokens', 'selector', $selector) > 0);

        
        $q = $db->prepare("INSERT INTO auth_tokens(expires, selector, uid, token) VALUES(DATE_ADD(NOW(), INTERVAL 365 DAY), :selector, :uid, :token)");

        $q->execute([
            'selector' => $selector,
            'uid' => $uid,
            'token' => $token
        ]);

        if($q) { echo $selector . ':' . $token; }

        else { echo "Error"; }

	}

}

?>