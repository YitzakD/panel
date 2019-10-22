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

	$abookcounter = count_all("clients");

	$abook = find_all("clients", "ORDER BY e_name ASC");

	?>

	<div class="d-block">
	
		<div class="row no-gutters p-4 p-notebook-head">
			
			<div class="col-8 col-sm-8 col-md-9 col-lg-10">
				
				<h5 class="h5">Carnet d'adresse</h5>

			</div>

			<div class="col-4 col-sm-4 col-md-3 col-lg-2 text-right">
				
				<a href="#" class="btn btn-sm btn-primary p-btn-primary" id="p-hide-notebook-sidebar-toggle"><i class="fas fa-times"></i></a>

			</div>

		</div>

		<div class="p-addressbook pb-2 pt-2" id="p-addressbook">

			<small>	

			<?php if($abookcounter > 0): ?>

				<table class="table table-striped p-datatable">

					<thead>
					
					<tr>
					
						<th scope="col" class="border-top-0">Dénomination</th>

					</tr>

					</thead>
					
				</table>

				<div class="p-addressbook-box" id="p-addressbook-box">

				<?php foreach($abook as $item): ?>
				
					<?php $contact = find_one("notebook", "client_id", $item->id); ?>
			
					<a href="#" class="p-addressbook-item d-flex justify-content-between pr-4 pl-4" id="p-show-address-item-toggle" accesskey="<?= $contact->id; ?>">

						<span><?= $item->e_name; ?></span>
							
					</a>

				<?php endforeach; ?>

				</div>

			<?php else: ?>

				<span class="d-block bg-light p-4 text-center text-muted">

					<h5><i class="fas fa-box-open mr-2"></i>Carnet vide!</h5>

					<p>Votre carnet d'adresse est vide</p>

				</span>

			<?php endif; ?>

			</small>

		</div>

	</div>
	<?php

}

?>