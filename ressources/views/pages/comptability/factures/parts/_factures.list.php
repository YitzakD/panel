<div class="p-inner-containor">
	
	<div class="p-inner-main-containor">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3>Ajouté récemment<small class="p-hidden">Total <?= $facturescounter__; ?></small></h3>
				</div>

				<div class="p-portlet-head-toolbar">
					
					<div class="dropdown">
						
						<button class="btn btn-sm btn-primary p-btn-primary" type="button" id="portleToolbar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="portleToolbar">

							<h6 class="dropdown-header">Actions rapides</h6>

							<a class="dropdown-item" href="<?= WURI . '?r=proformas/nouvelle/'; ?>"><i class="fas fa-plus p-portlet-head-toolbar-dropdown-icon mr-3"></i>Ajouter</a>

							<a class="dropdown-item" href="<?= WURI . 'export.php/' . $m[1] . '/'; ?>" target="_blank"><i class="fas fa-print p-portlet-head-toolbar-dropdown-icon mr-3"></i>Exporter</a>

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

     						<th scope="col">Montant HT (Fcfa)</th>

     						<th scope="col">Montant TTC (Fcfa)</th>

      						<th scope="col" class="text-right">Actions</th>

   						</tr>

 					</thead>


 					<tbody id="sb-search-table">
 						
 					<?php if($facturescounter__ > 0): ?>

 						<?php foreach($factures__ as $item): ?>

 							<?php $client = find_one("clients", "id", $item->client_id); ?>

 						<tr>
 							
							<td scope="row"><?= $i++; ?></td>

 							<td>

 								<?= '309F-' . date('jny',strtotime($item->created)) . '/' . $item->pf_id; ?>
 								<small class="d-block text-muted"><?= $client->e_name; ?></small>

 							</td>

 							<td><?= number_format($item->agency_remised_ht_price, 0, '', ' '); ?></td>

 							<td>

 								<?= number_format($item->numeric_ttc_price, 0, '', ' '); ?>
 								<small class="d-block text-muted"><?= 'TVA : ' . number_format($item->tva, 0, '', ' '); ?></small>

 							</td>

 							<th class="text-right">

								<a href="<?= WURI . '?r=' . $m[1] . '/infos/' . $item->id . '/'; ?>" class="btn btn-sm p-0"><i class="far fa-eye"></i></a>

 							</th>

 						</tr>

 						<?php endforeach; ?>	

 					<?php else: ?>

 						<tr>
 							
 							<td colspan="6" class="p-datatable-empty">

 								<h5><i class="fas fa-box-open mr-2"></i>Tableau vide!</h5>

 								<p>Vous n'avez aucune factures pour le moment</p>

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

						<footer class="blockquote-footer"><cite title="Source Title">Liste des <?= $m[1]; ?></cite></footer>

					</blockquote>

				</div>

				<?php if($facturescounter__ > $limit): ?>

				<div class="p-portlet-foot-toolbar">

				<?= paginate(WURI . "?r=" . $m[1] . "/", "&s=", $nbpages, $current); ?>

				</div>

				<?php endif; ?>

			</div>

		</div>

	</div>

</div>