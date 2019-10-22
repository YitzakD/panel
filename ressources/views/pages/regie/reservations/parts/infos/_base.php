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

							<a class="dropdown-item" href="<?= WURI . '?r=' . $m[1] . '/edition/etape-2/' . $ID . '/'; ?>"><i class="far fa-edit p-portlet-head-toolbar-dropdown-icon mr-3"></i>Editer</a>

							<a class="dropdown-item" href="<?= WURI . 'export.php/' . $m[1] . '/details/t=list/' . $ID . '/'; ?>" target="_blank"><i class="fas fa-print p-portlet-head-toolbar-dropdown-icon mr-3"></i>Exporter</a>

							<a class="dropdown-item" href="<?= WURI . 'export.php/' . $m[1] . '/details/t=img/' . $ID . '/'; ?>" target="_blank"><i class="fas fa-image p-portlet-head-toolbar-dropdown-icon mr-3"></i>Exporter en image</a>

						</div>

					</div>

				</div>

			</div>



			<div class="p-portlet-separator mt-4 mb-4"></div>



			<?php #	Contentu ?>
			<div class="p-portlet-body">
				
				<table class="table p-display-info-list">
					
					<tbody>
						
						<tr>
							
							<td class="icon"><i class="fas fa-ellipsis-v"></i></td>

							<td class="item">Libellé</td>

							<td><?= $reservation->camp_name; ?></td>

						</tr>

						<tr>
							
							<td class="icon"><i class="fas fa-calendar-day"></i></td>

							<td class="item">Début</td>

							<td><?= date('j/n/Y ',strtotime($reservation->debut)); ?></td>

						</tr>

						<tr>
							
							<td class="icon"><i class="fas fa-calendar-week"></i></td>

							<td class="item">Fin</td>

							<td><?= date('j/n/Y ',strtotime($reservation->fin)); ?></td>

						</tr>

					</tbody>

				</table>

			</div>

		</div>

		<?php if($reservation->etat === "En attente"): ?>

		<form action="<?= WURI . '?r=' . $m[1] . '/validation/' . $ID . '/'; ?>" method="POST">

			<input type="hidden" name="RHID" value="<?= $reservation->id; ?>">

			<button class="btn btn-block btn-primary p-btn-primary text-left mb-4" type="submit" <?= $rsvd_nbrcounter > 0 ? '' : 'disabled'; ?>>
			
				<?php if($_SESSION['type'] === "1"): ?>

				<i class="fas fa-check mr-2 ml-2"></i>
				<span class="pl-2 pr-4 border-left">Valider la réservation</span>

				<?php else: ?>

				<i class="fas fa-exchange-alt mr-2 ml-2"></i>
				<span class="pl-2 pr-4 border-left">Demander une validation</span>

				<?php endif; ?>

			</button>

		</form>

		<?php endif; ?>
		
	</div>

</div>