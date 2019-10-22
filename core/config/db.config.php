<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#	Database credentials
define("DB_HOST", "localhost");

define("DB_NAME", "u532250745_panel");

define("DB_USERNAME", "u532250745_proot");

define("DB_PASSWORD", "4bHYlTula7H3QVof4W");

date_default_timezone_set('Africa/Abidjan');

try {

    $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    die("Erreur : " .$e->getMessage());

}
