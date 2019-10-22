<div class="p-inner-containor">
	
	<div class="p-inner-main-containor">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3>Ajouté récemment<small>Total <?= $campagnescounter__; ?></small></h3>
				</div>

				<div class="p-portlet-head-toolbar">
					
					<div class="dropdown">
						
						<button class="btn btn-sm btn-primary p-btn-primary" type="button" id="portleToolbar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="portleToolbar">

							<h6 class="dropdown-header">Actions rapides</h6>

							<a class="dropdown-item" href="<?= WURI . '?r=reservations/nouvelle/'; ?>"><i class="fas fa-plus p-portlet-head-toolbar-dropdown-icon mr-3"></i>Ajouter</a>

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

 						<th scope="col">Libellé</th>

 						<th scope="col">Client</th>

 						<th scope="col">Dates</th>

  						<th scope="col" class="text-right">Actions</th>

					</tr>

 					</thead>


 					<tbody id="sb-search-table">
 						
 					<?php if($campagnescounter__ > 0): ?>

 						<?php foreach($campagnes__ as $item): ?>

 							<?php $client = find_one("clients", "id", $item->client_id); ?>

					<tr>

						<?php if($item->etat === "Closed"): ?>

						<td scope="row" class="p-border-attention border-left border-success"><?= $i++; ?></td>

						<?php elseif($item->etat === "En cours"): ?>

						<td scope="row" class="p-border-attention border-left border-primary"><?= $i++; ?></td>

						<?php else: ?>

						<td scope="row" class="p-border-attention border-left border-warning"><?= $i++; ?></td>

						<?php endif; ?>

						<td>

							<?= $item->camp_name; ?>
							<small class="d-block text-muted"><?= $item->etat === "Closed" ? "Campagne terminée" : $item->etat; ?></small>

						</td>

						<td><?= $client->e_name; ?></td>

						<td>

							<?= date('j/n/Y ',strtotime($item->debut)); ?>
							<small class="d-block text-muted"><?= date('j/n/Y ',strtotime($item->fin)); ?></small>

						</td>

						<th class="text-right">

							<?php if($item->etat === "Closed"): ?>

							<a href="<?= WURI . '?r=' . $m[1] . '/infos/' . $item->id . '/'; ?>" class="btn btn-sm p-0"><i class="far fa-eye"></i></a>

 							<?php elseif($item->etat === "En cours"): ?>

							<form method="POST" action="<?= WURI . '?r=' . $m[1] . '/edition/en-pause/' . $item->id . '/'; ?>" class="d-inline p-0">
								
								<button class="btn btn-sm btn-link p-0 mr-3" type="submit" data-toggle="tooltip" data-placement="left" title="Mettre la campagne en mode PAUSE" name="playcampsubit"><i class="fas fa-pause text-warning" title="Mettre la campagne"></i></button>

							</form>
							
							<div class="dropdown d-inline">
				
							<a href type="link" id="<?= $item->id; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>

								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="<?= $item->id; ?>">

									<?php if($item->etat === "En cours"): ?>
		 							
	 								<a class="dropdown-item" href="<?= WURI . '?r=' . $m[1] . '/infos/' . $item->id . '/'; ?>"><i class="far fa-eye p-datatable-toolbar-dropdown-icon mr-3"></i>Voir</a>
	 							
 									<?php endif ?>

									<a class="dropdown-item" href="<?= WURI . '?r=' . $m[1] . '/edition/etape-2/' . $item->id . '/'; ?>"><i class="far fa-edit p-datatable-toolbar-dropdown-icon mr-3"></i>Modifier</a>

								</div>

							</div>

							<?php elseif($item->etat === "En pause"): ?>

							<form method="POST" action="<?= WURI . '?r=' . $m[1] . '/edition/en-pause/' . $item->id . '/'; ?>" class="d-inline p-0">

								<button class="btn btn-sm btn-link p-0 mr-3" type="submit" data-toggle="tooltip" data-placement="left" title="Mettre la campagne en mode PLAY" name="playcampsubit"><i class="fas fa-play text-success"></i></button>

							</form>
	 							
 							<?php endif ?>

						</th>

					</tr>

 						<?php endforeach; ?>	

 					<?php else: ?>

					<tr>
						
						<td colspan="6" class="p-datatable-empty">

							<h5><i class="fas fa-box-open mr-2"></i>Tableau vide!</h5>

							<p>Vous n'avez aucune campagnes pour le moment</p>

						</td>

					</tr>	

 					<?php endif; ?>

 					</tbody>

				</table>

			</div>	


			<?php #	Pied de page ?>
			<div class="p-portlet-foot">

				<div class="p-portlet-foot-main">
					
					<blockquote class="blockquote" style="margin: 5px 0;">

						<footer class="blockquote-footer"><cite title="Source Title">Liste des <?= $m[1]; ?></cite></footer>

					</blockquote>

				</div>

				<?php if($campagnescounter__ > $limit): ?>

				<div class="p-portlet-foot-toolbar">

				<?= paginate(WURI . "?r=" . $m[1] . "/", "&s=", $nbpages, $current); ?>

				</div>

				<?php endif; ?>

			</div>

		</div>

	</div>

</div>