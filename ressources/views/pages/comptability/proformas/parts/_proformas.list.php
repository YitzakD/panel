<div class="p-inner-containor">
	
	<div class="p-inner-main-containor">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3>Ajouté récemment<small class="p-hidden">Total <?= $proformascounter__; ?></small></h3>
				</div>

				<div class="p-portlet-head-toolbar">
					
					<div class="dropdown">
						
						<button class="btn btn-sm btn-primary p-btn-primary" type="button" id="portleToolbar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="portleToolbar">

							<h6 class="dropdown-header">Actions rapides</h6>

							<a class="dropdown-item" href="<?= WURI . '?r=' . $m[1] . '/nouvelle/'; ?>"><i class="fas fa-plus p-portlet-head-toolbar-dropdown-icon mr-3"></i>Ajouter</a>

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

     						<th scope="col">Proforma N°</th>

     						<th scope="col">Montant HT (Fcfa)</th>

     						<th scope="col">Montant TTC (Fcfa)</th>

      						<th scope="col" class="text-right">Actions</th>

   						</tr>

 					</thead>


 					<tbody id="sb-search-table">
 						
 					<?php if($proformascounter__ > 0): ?>

 						<?php foreach($proformas__ as $item): ?>

 							<?php $client = find_one("clients", "id", $item->client_id); ?>

 						<tr>

 							<?php if($item->state === "Non"): ?>

							<td scope="row"><?= $i++; ?></td>

 							<?php elseif($item->state === "Attente"): ?>

							<td scope="row" class="p-border-attention border-left border-warning"><?= $i++; ?></td>

 							<?php else: ?>
 							
							<td scope="row" class="p-border-attention border-left border-success"><?= $i++; ?></td>
 							
 							<?php endif ?>

 							<td>

 								<?= 'PF-' . $item->pf_id; ?>
 								<small class="d-block text-muted"><?= $client->e_name; ?></small>

 							</td>

 							<td>

 								<?= number_format($item->ht_price, 0, '', ' '); ?>
 								<small class="d-block text-muted"><?= $item->agree_tva === "Oui" ? "TVA : " . number_format($item->tva, 0, '', ' ') : ""; ?></small>

 							</td>

 							<td>

 								<?= number_format($item->numeric_ttc_price, 0, '', ' '); ?>
 								<small class="d-block text-muted"><?= $item->letter_ttc_price; ?></small>

 							</td>

 							<th class="text-right">

 								<?php if($item->state === "Oui"): ?>

								<a href="<?= WURI . '?r=' . $m[1] . '/infos/' . $item->id . '/'; ?>" class="btn btn-sm p-0"><i class="far fa-eye"></i></a>

 								<?php else: ?>

 								<div class="dropdown d-inline">
						
									<a href type="link" id="<?= $item->id; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>

									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="<?= $item->id; ?>">

										<?php if($item->numeric_ttc_price != 0): ?>

										<a class="dropdown-item" href="<?= WURI . '?r=' . $m[1] . '/infos/' . $item->id . '/'; ?>"><i class="far fa-eye p-datatable-toolbar-dropdown-icon mr-3"></i>Voir</a>

										<?php endif; ?>

										<a class="dropdown-item" href="<?= WURI . '?r=' . $m[1] . '/edition/etape-1/' . $item->id . '/'; ?>"><i class="far fa-edit p-datatable-toolbar-dropdown-icon mr-3"></i>Modifier</a>

									</div>

								</div>

								<?php endif; ?>

 							</th>

 						</tr>

 						<?php endforeach; ?>	

 					<?php else: ?>

 						<tr>
 							
 							<td colspan="6" class="p-datatable-empty">

 								<h5><i class="fas fa-box-open mr-2"></i>Tableau vide!</h5>

 								<p>Vous n'avez aucune Pro-formas pour le moment</p>

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

				<?php if($proformascounter__ > $limit): ?>

				<div class="p-portlet-foot-toolbar">

				<?= paginate(WURI . "?r=" . $m[1] . "/", "&s=", $nbpages, $current); ?>

				</div>

				<?php endif; ?>

			</div>

		</div>

	</div>

</div>