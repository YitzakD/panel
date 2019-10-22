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

	$item = find_one("clients", "id", $address->client_id);

	$others = explode(" ", $address->note);

?>

<div class="d-block">
	
	<div class="row no-gutters p-4 p-notebook-head">
		
		<div class="col-8 col-sm-8 col-md-9 col-lg-10">
			
			<h5 class="h5">Contact</h5>

		</div>

		<div class="col-4 col-sm-4 col-md-3 col-lg-2 text-right">
			
			<a href="#" class="btn btn-sm btn-primary p-btn-primary" id="p-hide-address-item-toggle"><i class="fas fa-times"></i></a>

		</div>

	</div>

	<div class="p-address pl-4 pr-4 mt-4">

		<?php $in = explode(" ", $item->e_name); ?>
								
		<span class="d-block p-datatable-pic text-center">
			<div class="p-datatable-avatarname" style="background-color: <?= '#'.RandomCouleur(); ?>"><?= isset($in[1][0]) ? $avatarname = $in[0][0].$in[1][0] : $avatarname = $in[0][0]; ?></div>
		</span>

		<span class="d-block text-center mt-2 mb-4 pb-4">
			<div class="font-weight-bold text-uppercase"><?= ucfirst($item->e_name); ?></div>
			<small class="d-block text-muted"><?= setAtype($item->type); ?></small>
		</span>

		<span class="d-block">
			<span class="small text-muted text-capitalize p-0 m-0">Téléphone</span>
			<a href class="d-block small p-0 m-0"><?= $item->contacts; ?></a>
		</span>

		<span class="d-block">
			<span class="small text-muted text-capitalize p-0 m-0">E-mail</span>
			<a href class="d-block small p-0 m-0"><?= $item->a_mail; ?></a>
		</span>

		<div class="mt-2">
			<span class="d-block small text-muted text-uppercase m-0">Autres contacts</span>

			<div class="address-tags-box mt-1 mb-3"></div>

			<input placeholder="Autres contacts" id="new-add" />

			<div class="tag-console small mt-2">Valider en appuyant sur la touche <code>Entrer</code> ou sur <code>La barre d'espace</code></div>

		</div>

	</div>

</div>

<?php } ?>