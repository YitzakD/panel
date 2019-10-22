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

if(isset($_POST['dataitem']) && is_numeric($_POST['dataitem'])) {

	$error = [];

	extract($_POST);

	$address = find_one("notebook", "id", $dataitem);

	$others = explode(" ", $address->note);

?>

<?php foreach($others as $key => $val): ?>
				
	<?php if($val !== ""): ?>

	<span class="address-tag-item rounded">

		<span><?= $val; ?></span>

		<a hre="#" id="tag-del" accesskey="<?= $key; ?>"><i class="fas fa-times adress-tag-icon"></i></a>

	</span>

	<?php endif; ?>	

<?php endforeach; ?>

<?php } ?>	