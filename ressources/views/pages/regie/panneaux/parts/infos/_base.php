<div class="row no-gutters">

	<?php #	Client Card ?>
	<div class="col-12 col-md-12 col-lg-12">

		<div class="p-portlet rounded">

			<?php #	Contentu ?>
			<div class="p-portlet-display-bg text-center">

				<img src="<?= $signboard->file_road_sm; ?>" width="100%" alt data-toggle="modal" data-target=".bd-example-modal-lg" style="cursor: pointer;">

			</div>

			<div class="p-portlet-display-bottom">

				<div class="row p-display-details">
					
					<div class="col-6">
						
						<div class="title">IDENTIFIANT</div>

						<div class="counter"><?= 'DEV-' . $signboard->nbr; ?></div>

					</div>
					
					<div class="col-6">
						
						<div class="title">COMMUNE</div>

						<div class="counter"><?= $cmune->cmune_title ; ?></div>

					</div>

				</div>

			</div>

		</div>
		
	</div>

	
	
	<?php #	Client info ?>
	<div class="col-12 col-md-12 col-lg-12">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3>A propos</h3>
				</div>

				<div class="p-portlet-head-toolbar">
					
					<div class="dropdown">
						
						<button class="btn btn-sm btn-primary p-btn-primary" type="button" id="portleToolbar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="portleToolbar">

							<h6 class="dropdown-header">Actions rapides</h6>

							<a class="dropdown-item" href="<?= WURI . '?r=' . $m[1] . '/edition/etape-1/' . $ID . '/'; ?>"><i class="far fa-edit p-portlet-head-toolbar-dropdown-icon mr-3"></i>Editer</a>

							<a class="dropdown-item" href="<?= WURI . 'export.php/' . $m[1] . '/details/' . $ID . '/'; ?>" target="_blank"><i class="fas fa-print p-portlet-head-toolbar-dropdown-icon mr-3"></i>Exporter</a>

							<div class="dropdown-divider"></div>

							<button class="dropdown-item" style="cursor: pointer;" data-toggle="modal" data-target=".p-confirm-modal-sm"><i class="far fa-trash-alt p-portlet-head-toolbar-dropdown-icon mr-3"></i>Supprimer</button>

						</div>

					</div>

				</div>

			</div>


			<?php #	Contenu ?>
			<div class="p-portlet-body">
				
				<table class="table p-display-info-list">
					
					<tbody>
						
						<tr>

							<td class="item">Identifiant</td>

							<td><?= 'DEV-' . $signboard->nbr; ?></td>

						</tr>
						
						<tr>

							<td class="item">Format</td>

							<td><?= $size->size . 'm²'; ?></td>

						</tr>

						<tr>

							<td class="item">Zone</td>

							<td><?= $zone->zone_title; ?></td>

						</tr>

						<tr>

							<td class="item">Ville</td>

							<td><?= $ville->city_title; ?></td>

						</tr>

						<tr>

							<td class="item">Localisation&nbsp;&nbsp;</td>

							<td><?= $signboard->geoloc; ?></td>

						</tr>

						<tr>

							<td class="item">Etat</td>

							<td class="text-uppercase"><?= $signboard->etat; ?></td>

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



<?php #	Picture Modal ?>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

	<div class="modal-dialog modal-dialog-centered" role="document">
	
		<div class="modal-content">
			
			<div class="modal-header">
				
				<h5 class="modal-title" id="exampleModalLongTitle"><?= 'DEV-' . $signboard->nbr; ?></h5>
				
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			
			</div>

			<div class="modal-body text-center"><img src="<?= $signboard->file_road; ?>" width="100%" alt></div>

			
			<div class="modal-footer">
				
				<div class="p text-muted font-weight-bold text-uppercase" style="font-size: .83rem"><?= $signboard->geoloc; ?></div>

				<a href="<?= WURI . '?r=' . $m[1] . '/ajout-image/' . $ID . '/'; ?>" type="link" class="btn btn-link" style="font-size: .83rem"><i class="fas fa-edit"></i>&nbsp;Modiifier</a>

			</div>

		</div>

	</div>

</div>