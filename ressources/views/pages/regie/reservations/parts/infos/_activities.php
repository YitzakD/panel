<div class="row no-gutters">

	<?php #	Relationship development ?>
	<div class="col-12 col-md-12 col-lg-12">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3>Liste de panneaux rérservés <small class="text-muted p-hidden">Total <?= $rsvd_nbrcounter; ?></small></h3>
				</div>

				<div class="p-portlet-head-toolbar">
						
					<form action="<?= WURI . '?r=' . $m[1] . '/suppression/vider/' . $ID . '/'; ?>" method="POST">
						
						<button class="btn btn-sm btn-primary p-btn-primary" type="submit" data-toggle="tooltip" data-placement="left" title="Vider la réservation de ses panneaux ?" <?= $rsvd_nbrcounter > 0 ? '' : 'disabled'; ?>><i class="fas fa-trash"></i></button>

					</form>

				</div>

			</div>


			<?php #	Contenu ?>
			<div class="d-block pb-4">

				<table class="table table-striped p-datatable">
					
					<thead>
						
						<tr>
							
							<th scope="col">#</th>

     						<th scope="col">situation géographique</th>

     						<th scope="col" class="text-right">Actions</th>

						</tr>

					</thead>

					<tbody>

					<?php if($rsvd_nbrcounter > 0): ?>

						<?php foreach($rsvd_nbr as $item): ?>

							<?php $geoinfo = find_one("signboards", "nbr", $item->nbr); ?>

						<tr>
	 							
	 						<td scope="row"><span class="small"><?= 'DEV-' . $item->nbr; ?></span></td>

	 						<td><span class="small"><?= $geoinfo->geoloc; ?></span></td>

	 						<th class="text-right">
	 							
								<span class="small">

									<form action="<?= WURI . '?r=' . $m[1] . '/suppression/soustraire/' . $ID . '/'; ?>" method="POST">

										<input type="hidden" name="SBHID" value="<?= $item->id; ?>">
										<button class="btn btn-sm btn-link p-0" type="submit" title="soustraire ce panneau de la réservation ?"><i class="fas fa-trash-alt"></i></button>

									</form>

								</span>

	 						</th>

						</tr>

						<?php endforeach; ?>

					<?php else: ?>

						<tr>
							
							<td colspan="3" class="p-datatable-empty">
	 								
	 								<p>Vous n'avez aucun panneaux pour cette réservation</p>

							</td>

						</tr>

					<?php endif; ?>

					</tbody>

				</table>	
				
			</div>	

		</div>

	</div>

</div>	