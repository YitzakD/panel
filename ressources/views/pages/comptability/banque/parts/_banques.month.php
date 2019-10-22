<div class="p-inner-containor">
	
	<div class="p-inner-main-containor">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3><?= month_convert($initbank->month); ?><small><?= $initbank->year; ?></small></h3>
				</div>

				<div class="p-portlet-head-toolbar">
					
					<div class="dropdown">
						
						<button class="btn btn-sm btn-primary p-btn-primary" type="button" id="portleToolbar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="portleToolbar">

							<h6 class="dropdown-header">Actions rapides</h6>

							<a class="dropdown-item" href="<?= WURI . 'export.php/' . $m[1] . '/details/' . $vue . '/' . $ID . '/'; ?>" target="_blank"><i class="fas fa-print p-portlet-head-toolbar-dropdown-icon mr-3"></i>Exporter</a>

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
						
					<?php if($moovscounter > 0): ?>

						<?php foreach($moovsbank as $item): ?>

                		<?php $point = find_one("point_bank", "init_id", $item->id); ?>

 						<tr>
 							
 							<td scope="row"><?= $item->day ?></td>
						
							<td scope="row">

								<?= number_format($item->amount, 0, '', ' '); ?>
								<?= $item->typeof == '1' ? '<small class="d-block text-success">Crédit</small>' : '<small class="d-block text-danger">Débit</small>'; ?>
									
							</td>
							
							<td scope="row"><?= $item->description !== "Initialisation" ? $item->description : "Solde de depart"; ?></td>

 							<th class="text-right"></th>

 						</tr>

 						<?php endforeach; ?>	

 					<?php else: ?>

 						<tr>
 							
 							<td colspan="6" class="p-datatable-empty">

 								<h5><i class="fas fa-box-open mr-2"></i>Tableau vide!</h5>

 								<p>Vous n'avez aucun mouvements pour le moment</p>

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

 						<th scope="col">Crédits (Fcfa)</th>

 						<th scope="col">Débits (Fcfa)</th>

  						<th scope="col">Solde (Fcfa)</th>

					</tr>

				</thead>


				<tbody>

					<tr>
						
						<td scope="row"></td>

						<td scope="row"><?= number_format($pointbank->solde_depart, 0, '', ' '); ?></td>

						<td scope="row" class="text-success font-weight-bold"><?= number_format($pointbank->credit, 0, '', ' '); ?></td>

						<td scope="row" class="text-danger font-weight-bold"><?= number_format($pointbank->debit, 0, '', ' '); ?></td>

						<td scope="row" class="text-info font-weight-bold"><?= number_format($pointbank->solde, 0, '', ' '); ?></td>

					</tr>
				
				</tbody>

			</table>

		</div>

	</div>

</div>