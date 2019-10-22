<div class="p-inner-containor">
	
	<div class="p-inner-main-containor">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3><?= month_convert($caisse->month); ?><small><?= $caisse->year; ?></small></h3>
				</div>

				<div class="p-portlet-head-toolbar">
					
					<div class="dropdown">
						
						<button class="btn btn-sm btn-primary p-btn-primary" type="button" id="portleToolbar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="portleToolbar">

							<h6 class="dropdown-header">Actions rapides</h6>

							<a class="dropdown-item" href="<?= WURI . 'export.php/' . $m[1] . '/details/' . $ID . '/'; ?>" target="_blank"><i class="fas fa-print p-portlet-head-toolbar-dropdown-icon mr-3"></i>Exporter</a>

						</div>

					</div>

				</div>

			</div>


			<?php #	Contenu ?>
			<div class="d-block pt-4 pb-4">

				<table class="table table-striped p-datatable p-datatable-emp">
				
					<thead>

    					<tr>

	 						<th scope="col">Jour</th>

	 						<th scope="col">Montant</th>

	 						<th scope="col">Justificatif</th>

  							<th scope="col" class="text-right"></th>

   						</tr>

 					</thead>


 					<tbody id="sb-search-table">
						
					<?php if($caissecounter > 0): ?>

						<?php foreach($caisses as $item): ?>

                		<?php $pointcaisse = find_one("point_caisse", "init_id", $item->id); ?>

 						<tr>
 							
 							<td scope="row"><?= $item->day ?></td>
						
							<td scope="row">

								<?= number_format($item->amount, 0, '', ' '); ?>
								<?= $item->typeof == '1' ? '<small class="d-block text-success">Entrée</small>' : '<small class="d-block text-danger">Sortie</small>'; ?>
									
							</td>
							
							<td scope="row"><?= nl2br($item->description); ?></td>

 							<th class="text-right"></th>

 						</tr>

 						<?php endforeach; ?>	

 					<?php else: ?>

 						<tr>
 							
 							<td colspan="6" class="p-datatable-empty">

 								<h5><i class="fas fa-box-open mr-2"></i>Tableau vide!</h5>

 								<p>Vous n'avez aucun mouvement pour le moment</p>

 							</td>

 						</tr>	

 					<?php endif; ?>

 					</tbody>

				</table>

			</div>	


			<?php #	Pied de page ?>

			<table class="table table-sm p-datatable table-dark">
			
				<thead>

					<tr>

 						<th scope="col"></th>

 						<th scope="col">Solde de départ (Fcfa)</th>

 						<th scope="col">Débits (Fcfa)</th>

 						<th scope="col">Crédits (Fcfa)</th>

  						<th scope="col">Solde de fin (Fcfa)</th>

					</tr>

				</thead>


				<tbody>

					<tr>
						
						<td scope="row"></td>

						<td scope="row"><?= number_format($point->mo_new_solde, 0, '', ' '); ?></td>

						<td scope="row" class="text-success font-weight-bold"><?= number_format($point->mo_in, 0, '', ' '); ?></td>

						<td scope="row" class="text-danger font-weight-bold"><?= number_format($point->mo_out, 0, '', ' '); ?></td>

						<td scope="row" class="text-info font-weight-bold"><?= number_format($point->mo_solde, 0, '', ' '); ?></td>

					</tr>
				
				</tbody>

			</table>

		</div>

	</div>

</div>