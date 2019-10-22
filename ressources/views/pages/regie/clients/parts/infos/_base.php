<div class="row no-gutters">

	<?php #	Infos ?>
	<div class="col-12 col-md-12 col-lg-12">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<?php $in = explode(" ", $client->e_name); ?>
 									
					<span class="d-inline-block mr-2 p-datatable-pic">
						<div class="p-datatable-avatarname" style="background-color: <?= '#'.RandomCouleur(); ?>"><?= isset($in[1][0]) ? $avatarname = $in[0][0].$in[1][0] : $avatarname = $in[0][0]; ?></div>
					</span>

					<span class="d-inline-block">
						<div><?= ucfirst($client->e_name); ?></div>
						<span class="d-block small text-muted"><?= $client->c_name; ?></span>
					</span>

				</div>

				<div class="p-portlet-head-toolbar">
					
					<div class="dropdown">
						
						<button class="btn btn-sm btn-primary p-btn-primary" type="button" id="portleToolbar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="portleToolbar">

							<h6 class="dropdown-header">Actions rapides</h6>

							<a class="dropdown-item" href="<?= WURI . '?r=' . $m[1] . '/edition/' . $ID . '/'; ?>"><i class="far fa-edit p-portlet-head-toolbar-dropdown-icon mr-3"></i>Editer</a>

							<a class="dropdown-item" href="<?= WURI . 'export.php/' . $m[1] . '/details/' . $ID . '/'; ?>" target="_blank"><i class="fas fa-print p-portlet-head-toolbar-dropdown-icon mr-3"></i>Exporter</a>

						</div>

					</div>

				</div>

			</div>

			<div>

				<div class="row p-display-details">
					
					<div class="col-12 col-md-4 col-lg-4">
						
						<div class="title">Campagnes</div>

						<div class="counter"><?= $campcounter; ?></div>

					</div>
					
					<div class="col-12 col-md-4 col-lg-4">
						
						<div class="title">Réservations</div>

						<div class="counter"><?= $rsvcounter; ?></div>

					</div>

					<div class="col-12 col-md-4 col-lg-4">
						
						<div class="title">Facturations</div>

						<div class="counter"><?= $invoicecounter; ?></div>

					</div>

				</div>

			</div>



			<div class="p-portlet-separator mt-4 mb-4"></div>



			<?php #	Contentu ?>
			<div class="p-portlet-body">
				
				<table class="table p-display-info-list">
					
					<tbody>
						
						<tr>
							
							<td class="icon"><i class="fas fa-phone"></i></td>

							<td class="item">Téléphone</td>

							<td><?= '+225' . '&nbsp;' . $client->contacts; ?></td>

						</tr>

						<tr>
							
							<td class="icon"><i class="fas fa-map-marker-alt"></i></td>

							<td class="item">Boîte postale</td>

							<td><?= $client->bp != "" ? $client->bp : '<i class="fas fa-times text-danger"></i>' ?></td>

						</tr>

						<tr>
							
							<td class="icon"><i class="fas fa-closed-captioning"></i></td>

							<td class="item">Num. Compte Contribuable</td>

							<td><?= $client->cc != "" ? $client->cc : '<i class="fas fa-times text-danger"></i>' ?></td>

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