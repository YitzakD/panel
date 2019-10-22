<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#	get_session function -> Gère les clés sauvées en session.
if(!function_exists('get_session')) {

    function get_session($key) {

        if($key) { return !empty($_SESSION[$key]) ? e($_SESSION[$key]) : null; }

    }

}



#	is_logged_in function -> Vérifie si un user est connecté, et qu'une session à bien été créer.
if(!function_exists('is_logged_in')) {

    function is_logged_in() {

        return isset($_SESSION['uid']) || isset($_SESSION['pseudo']);

    }

}