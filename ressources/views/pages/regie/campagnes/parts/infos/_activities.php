<div class="row no-gutters">

	<?php #	Relationship development ?>
	<div class="col-12 col-md-12 col-lg-12">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3>Liste de panneaux <small class="text-muted">Total <?= $rsvd_nbrcounter; ?></small></h3>
				</div>

			</div>


			<?php #	Contenu ?>
			<div class="d-block pb-4">

				<table class="table table-striped p-datatable">
					
					<thead>
						
						<tr>
							
							<th scope="col">#</th>

     						<th scope="col">situation géographique</th>

     						<th scope="col" class="text-right"></th>

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

 								<?php if(get_session("type") === "1"): ?>

 									<?php if($campagne->etat === "En cours"): ?>

	 								<form method="POST" action="<?= WURI . '?r=' . $m[1] . '/edition/soustraire/' . $ID . '/'; ?>" class="d-inline p-0 m-0">

	 									<input type="hidden" name="SBHID" value="<?= $item->id; ?>">
	 									
	 									<button class="btn btn-sm btn-link p-0 mr-3" type="submit" data-toggle="tooltip" data-placement="left" title="Supprimer le panneau de la sélection" name="delsbsubit"><i class="fas fa-trash-alt text-danger"></i></button>

	 								</form>		

 									<?php endif; ?>

 								<?php endif; ?>

 								<div class="d-inline">
 									
 									<a href="<?= WURI . '?r=panneaux/infos/' . $geoinfo->id . '/'; ?>" class="btn btn-sm p-0 m-0"><i class="far fa-eye"></i></a>
 									
 								</div>

	 							</span>

 							</th>

						</tr>

						<?php endforeach; ?>

					<?php else: ?>

						<tr>
							
							<td colspan="3" class="p-datatable-empty">
	 								
	 								<p>Vous n'avez aucun panneaux pour cette campagne</p>

							</td>

						</tr>

					<?php endif; ?>

					</tbody>

				</table>	
				
			</div>	

		</div>

	</div>

</div>	