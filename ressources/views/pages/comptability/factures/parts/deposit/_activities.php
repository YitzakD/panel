<div class="row no-gutters">

	<?php #	transactions table ?>
	<div class="col-12 col-md-12 col-lg-12">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3>

						<?= 'F-' . $facture->pf_id; ?>
						<small class="p-hidden"><?= $client->e_name; ?></small>

					</h3>
				</div>

				<div class="p-portlet-head-toolbar">
					
					<div class="dropdown">
						
						<button class="btn btn-sm btn-primary p-btn-primary" type="button" id="portleToolbar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="portleToolbar">

							<h6 class="dropdown-header">Actions rapides</h6>

							<a class="dropdown-item" href="<?= WURI . 'export.php/' . $m[1] . '/transaction/' . $ID . '/'; ?>" target="_blank"><i class="fas fa-print p-portlet-head-toolbar-dropdown-icon mr-3"></i>Exporter</a>

						</div>

					</div>

				</div>

			</div>
		
		
			<?php #	Contenu ?>
			<div class="d-block pb-4">
				
				<table class="table table-striped p-datatable">
				
					<thead>

						<tr>

	 						<th scope="col">Date</th>

	 						<th scope="col">Montant</th>

	  						<th scope="col" class="text-right">Actions</th>

							</tr>

						</thead>


						<tbody>
							
						<?php if($depositcounter > 0): ?>

							<?php foreach($deposit as $item): ?>

						<tr>
							
							<td scope="row">
								
								<span class="small d-block text-muted"><?= set_time($item->created); ?></span>
									
							</td>
							
							<td scope="row"><?= number_format($item->payed_amount, 0, '', ' '); ?></td>

							<th class="text-right">

								<button class="btn btn-sm btn-link p-0 ml-3" id="<?= $item->id; ?>" style="cursor: pointer;" data-toggle="modal" data-target="#myModal<?= $item->id ?>"><i class="far fa-trash-alt"></i></button>

								<?php #	Confirmation Modal ?>
								<div class="modal fade p-confirm-modal-sm" id="myModal<?= $item->id ?>" tabindex="-1" role="dialog" aria-labelledby="Teste" aria-hidden="true">

									<div class="modal-dialog modal-sm modal-dialog-centered" role="document">

										<div class="modal-content">

											<h3 class="p-modal-head"><i class="fas fa-exclamation-circle text-danger icon"></i></h3>

											<div class="h5">Êtes-vous sûre?</div>

											<div class="p text-muted mb-4 font-weight-light">Vous ne pourrez pas revenir en arrière!</div>


											<form action="<?= WURI . '?r=' . $m[1] . '/suppression/&f=' . $item->id . '/' . $ID. '/'; ?>" method="post" class="p-3 mb-2">

												<input type="hidden" name="hID" value="<?= $item->id; ?>">

												<button type="submit" class="btn btn-sm btn-primary">Oui, supprimez!</button>

												<button type="reset" class="btn btn-sm btn-light border"  data-dismiss="modal">Annuler</button>

											</form>

										</div>

									</div>

								</div>

							</th>

						</tr>

							<?php endforeach; ?>	

						<?php else: ?>

							<tr>
								
								<td colspan="6" class="p-datatable-empty">

									<h5><i class="fas fa-box-open mr-2"></i>Tableau vide!</h5>

									<p>Vous n'avez reçu aucun versements pour cette facture pour le moment</p>

								</td>

							</tr>	

						<?php endif; ?>
							
						</tbody>

				</table>

			</div>	

		</div>

	</div>



	<?php #	transactions resume ?>
	<?php if($depositcounter > 0): ?>
	<div class="col-12 col-md-12 col-lg-12">
		
		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3>Récapitulatif</h3>
				</div>

			</div>
		
		
			<?php #	Contenu ?>
			<table class="table table-sm p-datatable table-dark">
			
				<thead>

					<tr>

 						<th scope="col"></th>

 						<th scope="col">Montant TTC (Fcfa)</th>

 						<th scope="col">Acomptes perçus (Fcfa)</th>

 						<th scope="col">Solde (Fcfa)</th>

					</tr>

				</thead>


				<tbody>

					<tr>
						
						<td scope="row"></td>

						<td scope="row"><?= number_format($statement->ttc, 0, '', ' '); ?></td>

						<td scope="row" class="text-success font-weight-bold"><?= number_format($statement->tac, 0, '', ' '); ?></td>

						<td scope="row" class="text-danger font-weight-bold"><?= number_format($statement->rap, 0, '', ' '); ?></td>

					</tr>
				
				</tbody>

			</table>



		</div>

	</div>
	<?php endif; ?>
	
</div>		