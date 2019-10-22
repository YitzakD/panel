<?php
/**
 * Copyright: DEV-AFRIKA
 * Dev: Yitzak DEKPEMOU - DEV-Codex
 */


/**Vérifie si une session à déjà été créer pour un utilisateur #*/

if(!isset($_SESSION['uid']) || !isset($_SESSION['pseudo'])) {

    $_SESSION['fw'] = $_SERVER['REQUEST_URI'];

    header('Location:?r=login/');	
    exit();

}