<div class="p-inner-containor">
	
	<div class="p-inner-main-containor">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3>Transactions récentes<small class="p-hidden">Total <?= $statementcounter__; ?></small></h3>
				</div>

				<div class="p-portlet-head-toolbar">
					
					<div class="dropdown">
						
						<button class="btn btn-sm btn-primary p-btn-primary" type="button" id="portleToolbar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="portleToolbar">

							<h6 class="dropdown-header">Actions rapides</h6>

							<a class="dropdown-item" href="<?= WURI . 'export.php/' . $m[1] . '/client-transactions/' . $ID . '/'; ?>" target="_blank"><i class="fas fa-print p-portlet-head-toolbar-dropdown-icon mr-3"></i>Exporter</a>

						</div>

					</div>

				</div>

			</div>


			<?php #	Contenu ?>
			<div class="d-block pt-4 pb-4">

				<table class="table table-striped p-datatable p-datatable-emp">
				
					<thead>

    					<tr>

      						<th scope="col">#</th>

     						<th scope="col">Facture N°</th>

     						<th scope="col">Montant TTC (Fcfa)</th>

     						<th scope="col">Acomptes Perçus (Fcfa)</th>

     						<th scope="col">Solde (Fcfa)</th>

      						<th scope="col" class="text-right">Actions</th>

   						</tr>

 					</thead>


 					<tbody id="sb-search-table">
 						
 					<?php if($statementcounter__ > 0): ?>

 						<?php foreach($statement__ as $item): ?>

 							<?php $facture = find_one("bills", "pf_id", $item->pf_id); ?>

 						<tr>
 							
							<td scope="row"><?= $i++; ?></td>

 							<td><?= 'F-' . $item->pf_id; ?></td>

 							<td><?= number_format($item->ttc, 0, '', ' '); ?></td>

 							<td><?= number_format($item->tac, 0, '', ' '); ?></td>

 							<td><?= number_format($item->rap, 0, '', ' '); ?></td>

 							<th class="text-right">

								<a href="<?= WURI . '?r=' . $m[1] . '/transaction/' . $facture->id . '/'; ?>" class="btn btn-sm p-0"><i class="far fa-eye"></i></a>

 							</th>

 						</tr>

 						<?php endforeach; ?>	

 					<?php else: ?>

 						<tr>
 							
 							<td colspan="6" class="p-datatable-empty">

 								<h5><i class="fas fa-box-open mr-2"></i>Tableau vide!</h5>

 								<p>Vous n'avez aucune trasactions pour le moment</p>

 							</td>

 						</tr>	

 					<?php endif; ?>

 					</tbody>

				</table>

			</div>	


			<?php #	Pied de page ?>
			<div class="p-portlet-foot">

				<div class="p-portlet-foot-main p-hidden">
					
					<blockquote class="blockquote" style="margin: 5px 0;">

						<footer class="blockquote-footer"><cite title="Source Title">Liste des transactions du client</cite></footer>

					</blockquote>

				</div>

			</div>

		</div>

	</div>

</div>