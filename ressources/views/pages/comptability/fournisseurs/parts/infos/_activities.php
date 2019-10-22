<div class="row no-gutters">

	<?php #	Latest BC ?>
	<div class="col-12 col-md-12 col-lg-12">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3>Dernières commandes</h3>
				</div>

			</div>


			<?php #	Contenu ?>
			<div class="d-block pb-4">

				<table class="table table-striped p-datatable">

					<thead>
						
						<tr>
							
							<th></th>

							<th>Description</th>

							<th>Total</th>

							<th class="text-right">Actions</th>

						</tr>

					</thead>

					<tbody>
						
						<?php if($commandescounter > 0): ?>

							<?php foreach($commandes as $item): ?>

							<tr>

								<td class="icon"><i class="far fa-file-pdf text-danger"></i></td>
		 							
		 						<td scope="row">

		 							<?= 'BC-' . $item->bc_id; ?>
 									<small class="d-block text-muted"><?= $item->description; ?></small>

		 						</td>

		 						<td><?= number_format($item->ttc, 0, '', ' '); ?></td>

		 						<td class="text-right">

		 							<a href="<?= WURI . '?r=commandes/infos/' . $item->id . '/'; ?>" class="btn btn-sm p-0"><i class="fas fa-eye"></i></a>

		 						</td>

							</tr>

							<?php endforeach; ?>

						<?php else: ?>

							<tr>
								
								<td colspan="4" class="p-datatable-empty">
		 								
		 								<p>Vous n'avez aucune commandes avec <?= $fournisseur->p_name; ?></p>

								</td>

							</tr>

						<?php endif; ?>

					</tbody>

				</table>	

			</div>	

		</div>

	</div>

</div>	