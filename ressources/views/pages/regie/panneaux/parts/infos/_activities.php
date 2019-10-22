<div class="row no-gutters">

	<div class="col-12 col-md-12 col-lg-12">

		<div class="row">

			<div class="col-12 col-md-6 col-lg-6">

				<div class="p-portlet rounded">

					<div class="d-block p-4 text-center">
					
						<div class="display-2"><?= count($lastcamps); ?></div>

						<span class="text-muted small text-uppercase"><?= count($lastcamps) > 1  ? "Campagnes" : "Campagne"; ?></span>

					</div>

				</div>	

			</div>

			<div class="col-12 col-md-6 col-lg-6">

				<div class="p-portlet rounded">

					<div class="d-block p-4 text-center">
					
						<div class="display-2"><?= count($lastrsv); ?></div>

						<span class="text-muted small text-uppercase"><?= count($lastcamps) > 1  ? "Réservations" : "Réservation"; ?></span>

					</div>

				</div>		

			</div>

		</div>

	</div>
	
	

	<?php #	Recents invoices ?>
	<div class="col-12 col-md-12 col-lg-12">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3>Campagnes récentes <small><?= "Total " . count($lastcamps); ?></small></h3>
				</div>

			</div>


			<?php #	Contenu ?>
			<div class="d-block pb-4">

				<table class="table table-striped p-datatable">
					
					<thead>
						
					<tr>

 						<th scope="col">Campgane</th>

 						<th scope="col">Date</th>

 						<th scope="col">Etat</th>

 						<th scope="col" class="text-right">Actions</th>

					</tr>

					</thead>

					<tbody>
					<?php if(count($lastcamps) > 0): ?>

					<?php foreach($lastcamps as $item): ?>

					<tr>

						<td>

							<?= $item->camp_name; ?>
							<span class="d-block small text-muted"><?= $item->e_name; ?></span>

						</td>

						<td>

							<?= date('j/n/Y ',strtotime($item->debut)); ?>
							<span class="d-block small text-muted"><?= date('j/n/Y ',strtotime($item->fin)); ?></span>

						</td>

						<td><?= $item->etat === "Closed" ? "Terminée" : $item->etat; ?></td>

						<th class="text-right">

 							<a href="<?= WURI . '?r=campagnes/infos/' . $item->id . '/'; ?>" class="btn btn-sm p-0"><i class="far fa-eye"></i></a>

						</th>

					</tr>

					<?php endforeach; ?>

					<?php else: ?>

					<tr>
						
						<td colspan="5" class="p-datatable-empty">
 								
							<p>Aucune campagnes récentes n'a été trouver pour ce panneau DEV-<?= $signboard->nbr; ?></p>

						</td>

					</tr>

					<?php endif; ?>
					</tbody>

				</table>	
			
			</div>	

		</div>

	</div>

</div>