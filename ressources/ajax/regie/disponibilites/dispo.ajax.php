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

$URI = $_SERVER["HTTP_REFERER"];
$WURI = explode('?r=', $URI);


session_start();

include_once $CORE.$DS.'config/db.config.php';
include_once $CORE.$DS.'includes/global.func.php';
include_once $CORE.$DS.'includes/regie.func.php';

if(isset($_POST['debut']) && isset($_POST['fin']) && isset($_POST['size']) && isset($_POST['zone'])) {

	$error = [];

    extract($_POST);
	
	$zid = $zone;
	
	$fid = $size;
	
	$state = "ras";

	if($debut>$fin) {

	 	$error[] = "Impossible d'effectuer cette opértion car la date de début est supérieur à la date de fin.";

	}

?>

<?php if(count($error) == 0): ?>

	<?php if($zid == 0): ?>

		<?php $zones = find_all("zones", "WHERE id>1 ORDER BY zone_title ASC"); ?>

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3>Disponibilité Tout le territoire</h3>
				</div>

				<div class="p-portlet-head-toolbar">
					
					<div class="dropdown">
						
						<button class="btn btn-sm btn-primary p-btn-primary" type="button" id="portleToolbar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="portleToolbar">

							<h6 class="dropdown-header">Actions rapides</h6>

							<a class="dropdown-item" href="<?= $WURI[0] . 'export.php/disponibilites/recherche/z=' . $zid . '/s=' . $fid . '/d=' . $debut . '/f=' . $fin . '/t=list/'; ?>" target="_blank"><i class="fas fa-print p-portlet-head-toolbar-dropdown-icon mr-3"></i>Exporter</a>

							<a class="dropdown-item" href="<?= $WURI[0] . 'export.php/disponibilites/recherche/z=' . $zid . '/s=' . $fid . '/d=' . $debut . '/f=' . $fin . '/t=img/'; ?>" target="_blank"><i class="fas fa-image p-portlet-head-toolbar-dropdown-icon mr-3"></i>Exporter en image</a>

						</div>

					</div>

				</div>

			</div>

		</div>

		<?php foreach($zones as $zone): ?>

		<?php
			
			$communescounter = cell_count("cmunes", "zid", $zone->id);

			$communes = find_all("cmunes",  "WHERE zid='$zone->id' ORDER BY cmune_title ASC");

		?>

		<div class="p-portlet rounded">

			<div id="sb-hidden-search-box">

				<div class="d-block pt-4 pb-4">
					
					<h3 class="h6 font-weight-bold text-uppercase" style="padding: 0 1.5rem"><?= $zone->zone_title; ?></h3>

					<?php if($communescounter > 0): ?>

					<?php foreach($communes as $commune): ?>

					<?php

						$fsbcounter = find_fsignboards_nbr($zone->id, $commune->id, $fid, $state);
						
						$bfsbounter = find_signboards_tbf_nbr($debut, $fin, $zone->id, $commune->id, $fid, $state);

						$tdsbcounter = $fsbcounter + $bfsbounter;

						$fsboards = find_fsignboards($zone->id, $commune->id, $fid, $state);

						$bfsboards = find_signboards_tbf($debut, $fin, $zone->id, $commune->id, $fid, $state);

						#$freesboards = array_merge($fsboards, $bfsboards);

						$freesboards = $fsboards + $bfsboards;

					?>

						<table class="table table-striped p-datatable">
						
						<thead>

    					<tr>

      						<th scope="col" width="10%">#</th>

     						<th scope="col" width="10%">Format</th>

      						<th scope="col">Situation géograpique</th>

   						</tr>

   						<tr>
   							
   							<th colspan="3" class="p-text-color-orange text-capitalize font-weight-bold mb-0">

   								<?= $commune->cmune_title; ?>
								&nbsp;<i class="fas fa-angle-right"></i>&nbsp;<?= $tdsbcounter; ?>

   							</th>

   						</tr>

	 					</thead>

	 					<tbody>

	 					<?php if(($fsbcounter > 0) || ($bfsbounter > 0)): ?>

	 					<?php foreach($freesboards as $item): ?>	
	 						
 						<tr>
 							
 							<td scope="row"><?= 'DEV-' . $item->nbr; ?></td>

 							<td class="text-left text-uppercase"><?= $item->size . 'm²'; ?></td>
 							
 							<th class="text-left text-capitalize font-weight-normal"><?= $item->geoloc; ?></th>

 						</tr>

 						<?php endforeach; ?>

	 					<?php else: ?>

 						<tr>

 							<td colspan="3" class="p-datatable-empty">
 								
 								<p>Vous n'avez aucun panneaux disponibles dans <?= $commune->cmune_title; ?></p>

 							</td>

 						</tr>

	 					<?php endif; ?>	
	 						
	 					</tbody>

	 					</table>

					<?php endforeach; ?>

					<?php else: ?>

						<table class="table table-striped p-datatable">
							
							<tbody>
								
								<tr>

									<td colspan="3" class="p-datatable-empty">

										<h5><i class="fas fa-box-open mr-2"></i>Tableau vide!</h5>

		 								<p>Vous n'avez aucun panneaux dans cette zone</p>

									</td>

								</tr>

							</tbody>

						</table>

					<?php endif; ?>

				</div>

			</div>
			
		</div>		
					
		<?php endforeach; ?>

	<?php else: ?>

		<?php

		$zone = find_one("zones", "id", $zid);

        $communescounter = cell_count("cmunes", "zid", $zone->id);

		$communes = find_all("cmunes",  "WHERE zid='$zone->id' ORDER BY cmune_title ASC");

		?>

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3>Disponibilité <?= $zone->zone_title; ?></h3>
				</div>

				<div class="p-portlet-head-toolbar">
					
					<div class="dropdown">
						
						<button class="btn btn-sm btn-primary p-btn-primary" type="button" id="portleToolbar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="portleToolbar">

							<h6 class="dropdown-header">Actions rapides</h6>

							<a class="dropdown-item" href="<?= $WURI[0] . 'export.php/disponibilites/recherche/z=' . $zid . '/s=' . $fid . '/d=' . $debut . '/f=' . $fin . '/t=list/'; ?>" target="_blank"><i class="fas fa-print p-portlet-head-toolbar-dropdown-icon mr-3"></i>Exporter</a>

							<a class="dropdown-item" href="<?= $WURI[0] . 'export.php/disponibilites/recherche/z=' . $zid . '/s=' . $fid . '/d=' . $debut . '/f=' . $fin . '/t=img/'; ?>" target="_blank"><i class="fas fa-image p-portlet-head-toolbar-dropdown-icon mr-3"></i>Exporter en image</a>

						</div>

					</div>

				</div>

			</div>

		</div>



		<div class="p-portlet rounded">

			<div id="sb-hidden-search-box">

				<div class="d-block pt-4 pb-4">
					
					<h3 class="h6 font-weight-bold text-uppercase" style="padding: 0 1.5rem"><?= $zone->zone_title; ?></h3>

					<?php if($communescounter > 0): ?>

					<?php foreach($communes as $commune): ?>

					<?php

						$fsbcounter = find_fsignboards_nbr($zone->id, $commune->id, $fid, $state);
						
						$bfsbounter = find_signboards_tbf_nbr($debut, $fin, $zone->id, $commune->id, $fid, $state);

						$tdsbcounter = $fsbcounter + $bfsbounter;

						$fsboards = find_fsignboards($zone->id, $commune->id, $fid, $state);

						$bfsboards = find_signboards_tbf($debut, $fin, $zone->id, $commune->id, $fid, $state);

						$freesboards = array_merge($fsboards, $bfsboards);

						#$freesboards = $fsboards + $bfsboards;

					?>

						<table class="table table-striped p-datatable">
						
						<thead>

    					<tr>

      						<th scope="col" width="10%">#</th>

     						<th scope="col" width="10%">Format</th>

      						<th scope="col">Situation géograpique</th>

   						</tr>

   						<tr>
   							
   							<th colspan="3" class="p-text-color-orange text-capitalize font-weight-bold mb-0">

   								<?= $commune->cmune_title; ?>
								&nbsp;<i class="fas fa-angle-right"></i>&nbsp;<?= $tdsbcounter; ?>

   							</th>

   						</tr>

	 					</thead>

	 					<tbody>

	 					<?php if(($fsbcounter > 0) || ($bfsbounter > 0)): ?>

	 					<?php foreach($freesboards as $item): ?>	
	 						
 						<tr>
 							
 							<td scope="row"><?= 'DEV-' . $item->nbr; ?></td>

 							<td class="text-left text-uppercase"><?= $item->size . 'm²'; ?></td>
 							
 							<th class="text-left text-capitalize font-weight-normal"><?= $item->geoloc; ?></th>

 						</tr>

 						<?php endforeach; ?>

	 					<?php else: ?>

 						<tr>

 							<td colspan="3" class="p-datatable-empty">
 								
 								<p>Vous n'avez aucun panneaux disponibles dans <?= $commune->cmune_title; ?></p>

 							</td>

 						</tr>

	 					<?php endif; ?>	
	 						
	 					</tbody>

	 					</table>

					<?php endforeach; ?>

					<?php else: ?>

						<table class="table table-striped p-datatable">
							
							<tbody>
								
								<tr>

									<td colspan="3" class="p-datatable-empty">

										<h5><i class="fas fa-box-open mr-2"></i>Tableau vide!</h5>

		 								<p>Vous n'avez aucun panneaux dans cette zone</p>

									</td>

								</tr>

							</tbody>

						</table>

					<?php endif; ?>

				</div>

			</div>
			
		</div>
	
	<?php endif; ?>	

<?php else: ?>

<div class="p-portlet rounded">

	<div id="sb-hidden-search-box">	

		<div class="d-block pt-4 pb-4">

			<table class="table table-hover table-striped p-datatable">

				<tbody>

				<?php foreach($error as $itemerror): ?>
				
					<tr><td colspan="3" class="p-datatable-empty"><?= $itemerror ?></td></tr>

				<?php endforeach; ?>

				</tbody>	

			</table>

		</div>

	</div>

</div>

<?php endif; ?>	

<?php		

} else {

?>

<div class="p-portlet rounded">

	<div id="sb-hidden-search-box">

		<div class="d-block pt-4 pb-4">

		<table class="table table-hover table-striped p-datatable">

			<tbody>
				
				<tr>
					
					<td colspan="6" class="p-datatable-empty">

							<h5><i class="fas fa-box-open mr-2"></i>Tableau vide!</h5>

							<p>Nous n'avons pas pu récuperer de liste</p>

						</td>

				</tr>

			</tbody>

			</table>

		</div>	

	</div>

</div>

<?php

}

?>