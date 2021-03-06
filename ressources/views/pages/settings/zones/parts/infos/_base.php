<div class="row no-gutters">

	<?php #	Infos ?>
	<div class="col-12 col-md-12 col-lg-12">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<?php $in = explode(" ", $zone->zone_title); ?>
 									
					<span class="d-inline-block mr-2 p-datatable-pic">
						<div class="p-datatable-avatarname" style="background-color: <?= '#'.RandomCouleur(); ?>"><?= isset($in[1][0]) ? $avatarname = $in[1][0] : $avatarname = $in[0][0]; ?></div>
					</span>

					<span class="d-inline-block">
						<div class="text-uppercase"><?= $zone->zone_title; ?></div>
						<span class="d-block small text-muted"><?= 'REP. CÔTE D\'IVOIRE' ?></span>
					</span>

				</div>

				<div class="p-portlet-head-toolbar">
					
					<div class="dropdown">
						
						<button class="btn btn-sm btn-primary p-btn-primary" type="button" id="portleToolbar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="portleToolbar">

							<h6 class="dropdown-header">Actions rapides</h6>

							<a class="dropdown-item" href="<?= WURI . '?r=' . $m[1] . '/edition/' . $ID . '/'; ?>"><i class="far fa-edit p-portlet-head-toolbar-dropdown-icon mr-3"></i>Editer</a>

							<a class="dropdown-item" href="<?= WURI . 'export.php/' . $m[1] . '/details/' . $ID . '/'; ?>" target="_blank"><i class="fas fa-print p-portlet-head-toolbar-dropdown-icon mr-3"></i>Exporter</a>

							<div class="dropdown-divider"></div>

							<button class="dropdown-item" style="cursor: pointer;" data-toggle="modal" data-target=".p-confirm-modal-sm">

								<i class="far fa-trash-alt p-portlet-head-toolbar-dropdown-icon mr-3"></i>Supprimer

							</button>

						</div>

					</div>

				</div>

			</div>

			<div>

				<div class="row p-display-details">
					
					<div class="col-12 col-md-4 col-lg-4">
						
						<div class="title">Villes</div>

						<div class="counter"><?= $villescounter; ?></div>

					</div>
					
					<div class="col-12 col-md-4 col-lg-4">
						
						<div class="title">Communes</div>

						<div class="counter"><?= $cmunescounter; ?></div>

					</div>

					<div class="col-12 col-md-4 col-lg-4">
						
						<div class="title">Panneaux</div>

						<div class="counter"><?= $sboardscounter; ?></div>

					</div>

				</div>

			</div>



			<div class="p-portlet-separator mt-4 mb-4"></div>



			<?php #	Contentu ?>
			<div class="p-portlet-body">
				
				<table class="table p-display-info-list">
					
					<tbody>
						
						<tr>
							
							<td class="icon"><i class="fas fa-map-marker-alt"></i></td>

							<td class="item">Dénomination</td>

							<td class="text-uppercase"><?= $zone->zone_title; ?></td>

						</tr>

					</tbody>

				</table>

			</div>

		</div>
		
	</div>

</div>





<?php #	Confirmation Modal ?>
<div class="modal fade p-confirm-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">

		<div class="modal-content">

			<h3 class="p-modal-head"><i class="fas fa-exclamation-circle text-danger icon"></i></h3>

			<div class="h5">Êtes-vous sûre?</div>

			<div class="p text-muted mb-4">Vous ne pourrez pas revenir en arrière!</div>


			<form action="<?= WURI . '?r=' . $m[1] . '/suppression/' . $ID . '/'; ?>" method="post" class="p-3 mb-2">

				<button type="submit" class="btn btn-sm btn-primary">Oui, supprimez!</button>

				<button type="reset" class="btn btn-sm btn-light border"  data-dismiss="modal">Annuler</button>

			</form>

		</div>

	</div>

</div>