<div class="p-inner-containor">
	
	<div class="p-inner-main-containor">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3>Ajouté récemment<small class="p-hidden">Total <?= $banquescounter__; ?></small></h3>
				</div>

				<div class="p-portlet-head-toolbar">
					
					<div class="dropdown">
						
						<button class="btn btn-sm btn-primary p-btn-primary" type="button" id="portleToolbar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="portleToolbar">

							<h6 class="dropdown-header">Actions rapides</h6>

							<a class="dropdown-item" href="<?= WURI . 'export.php/' . $m[1] . '/liste/' . $ID . '/'; ?>" target="_blank"><i class="fas fa-print p-portlet-head-toolbar-dropdown-icon mr-3"></i>Exporter</a>

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

     						<th scope="col">Mois</th>

     						<th scope="col">Crédit (Fcfa)</th>

     						<th scope="col">Débit (Fcfa)</th>

     						<th scope="col">Solde (Fcfa)</th>

      						<th scope="col" class="text-right">Actions</th>

   						</tr>

 					</thead>


 					<tbody id="sb-search-table">
 						
 					<?php if($banquescounter__ > 0): ?>

 						<?php foreach($banque__ as $item): ?>

                		<?php $pointbank = find_one("point_bank", "init_id", $item->id); ?>

 						<tr>
 							
 							<td scope="row"><?= $i++; ?></td>

 							<td scope="row">

 								<?= month_convert($item->month); ?>
 								<small class="d-block text-muted"><?= $item->year; ?></small>
 									
 							</td>

 							<td scope="row"><?= number_format($pointbank->solde_depart + $pointbank->credit, 0, '', ' '); ?></td>

 							<td scope="row"><?= number_format($pointbank->debit, 0, '', ' '); ?></td>

 							<td scope="row"><?= number_format($pointbank->solde, 0, '', ' '); ?></td>

 							<th class="text-right">

								<?php if($actualmonth === month_convert($item->month) && ($_year === $item->year)): ?>
 								
 								<div class="dropdown d-inline">
						
									<a href type="link" id="<?= $item->id; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>

									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="<?= $item->id; ?>">

										<a class="dropdown-item" href="<?= WURI . '?r=' . $m[1] . '/infos/' . $item->id . '/' . $ID . '/'; ?>"><i class="far fa-eye p-datatable-toolbar-dropdown-icon mr-3"></i>Voir</a>

										<a class="dropdown-item" href="<?= WURI . '?r=' . $m[1] . '/infos/' . $item->id . '/' . $ID . '/'; ?>"><i class="far fa-edit p-datatable-toolbar-dropdown-icon mr-3"></i>Modifier</a>

									</div>

								</div>

								<?php else: ?>

								<a class="btn btn-sm p-0" href="<?= WURI . '?r=' . $m[1] . '/infos/rapprochement-mois/' . $item->id . '/' . $ID . '/'; ?>"><i class="far fa-eye"></i></a>

								<?php endif; ?>

 							</th>

 						</tr>

 						<?php endforeach; ?>	

 					<?php else: ?>

 						<tr>
 							
 							<td colspan="6" class="p-datatable-empty">

 								<h5><i class="fas fa-box-open mr-2"></i>Tableau vide!</h5>

 								<p>Vous n'avez aucun rapprochements pour le moment</p>

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

						<footer class="blockquote-footer"><cite title="Source Title">Liste des rapprochements</cite></footer>

					</blockquote>

				</div>

				<?php if($banquescounter__ > $limit): ?>

				<div class="p-portlet-foot-toolbar">

				<?= paginate(WURI . "?r=" . $m[1] . "/", "&s=", $nbpages, $current); ?>

				</div>

				<?php endif; ?>

			</div>

		</div>

	</div>

</div>