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

$WURI = $_SERVER["HTTP_REFERER"];


session_start();

include_once $CORE.$DS.'config/db.config.php';
include_once $CORE.$DS.'includes/global.func.php';
include_once $CORE.$DS.'includes/regie.func.php';

if(isset($_POST["searchindex"])) {

	extract($_POST);

	$resultcounter = count_all("signboards", " WHERE nbr LIKE '%$searchindex%' OR geoloc LIKE '%$searchindex%'");

	$result = find_all("signboards", " WHERE nbr LIKE '%$searchindex%' OR geoloc LIKE '%$searchindex%' ORDER BY id ASC, nbr ASC");

?>

<div class="pt-4 pb-4">

	<?php if($resultcounter > 0): ?>

	<table class="table table-hover table-striped p-datatable">
	
	<thead>

	<tr>

		<th scope="col">#</th>

		<th scope="col">Format</th>

		<th scope="col">Commune</th>

		<th scope="col">Situation géograpique</th>

		<th scope="col" class="text-right">Actions</th>

	</tr>

	</thead>

	<tbody>

	<?php foreach($result as $item): ?>

	<?php
		
		$size = find_one("sizes", "id", $item->size);

		$commune = find_one("cmunes", "id", $item->cmune);

	?>	

	<tr>
		
		<?php if($item->etat !== "ras"): ?>
						
		<td scope="row" class="border-left" style="border-left-color: #E74C3C!important;"><?= $item->nbr; ?></td>

		<?php else: ?>
		
		<td scope="row"><?= $item->nbr; ?></td>
		
		<?php endif ?>

		<td class="text-left text-uppercase"><?= $size->size . 'm²'; ?></td>

		<td class="text-left p-text-color-orange font-weight-bold"><?= $commune->cmune_title; ?></td>
						
		<td class="text-left text-uppercase"><?= $item->geoloc; ?></td>
		
		<td class="text-right">
			
			<div class="dropdown d-inline">

				<a href type="link" id="<?= $item->id; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>

				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="<?= $item->id; ?>">

					<a class="dropdown-item" href="<?= $WURI . 'infos/' . $item->id . '/'; ?>"><i class="far fa-eye p-datatable-toolbar-dropdown-icon mr-3"></i>Voir</a>

					<a class="dropdown-item" href="<?= $WURI . 'edition/' . $item->id . '/'; ?>"><i class="far fa-edit p-datatable-toolbar-dropdown-icon mr-3"></i>Modifier</a>

				</div>

			</div>

			<button class="btn btn-sm btn-link p-0 ml-3" id="<?= $item->id; ?>" style="cursor: pointer;" data-toggle="modal" data-target="#myModal<?= $item->id ?>"><i class="far fa-trash-alt"></i></button>

			<?php #	Confirmation Modal ?>
			<div class="modal fade p-confirm-modal-sm" id="myModal<?= $item->id ?>" tabindex="-1" role="dialog" aria-labelledby="Teste" aria-hidden="true">

				<div class="modal-dialog modal-sm modal-dialog-centered" role="document">

					<div class="modal-content">

						<h3 class="p-modal-head"><i class="fas fa-exclamation-circle text-warning icon"></i></h3>

						<div class="h5">Êtes-vous sûre?</div>

						<div class="p text-muted mb-4">Vous ne pourrez pas revenir en arrière!</div>


						<form action="<?= $WURI . '?r=panneaux/suppression/' . $item->id . '/'; ?>" method="post" class="p-3 mb-2">

							<button type="submit" class="btn btn-sm btn-primary">Oui, supprimez!</button>

							<button type="reset" class="btn btn-sm btn-light border"  data-dismiss="modal">Annuler</button>

						</form>

					</div>

				</div>

			</div>

		</td>

	</tr>

	<?php endforeach; ?>
	
	</tbody>

	</table>

	<?php else: ?>

	<table class="table table-hover table-striped p-datatable">

	<tbody>
		
		<tr>
			
			<td colspan="6" class="p-datatable-empty">

				<h5><i class="fas fa-box-open mr-2"></i>Tableau vide!</h5>

				<p>Aucun résultats pour votre recherchre</p>

			</td>

		</tr>

	</tbody>

	</table>

	<?php endif; ?>

</div>

<?php		

}

?>