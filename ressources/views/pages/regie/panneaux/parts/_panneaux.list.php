<div class="p-inner-containor">
	
	<div class="p-inner-main-containor">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3>Ajouté dans <?= WEBSITE_NAME; ?><small class="p-hidden">Total <?= $signboardscounter__; ?></small></h3>
				</div>

				<div class="p-portlet-head-toolbar">
					
					<div class="dropdown">
						
						<button class="btn btn-sm btn-primary p-btn-primary" type="button" id="portleToolbar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="portleToolbar">

							<h6 class="dropdown-header">Actions rapides</h6>

							<a class="dropdown-item" href="<?= WURI . '?r=' . $m[1] . '/nouveau/'; ?>"><i class="fas fa-plus p-portlet-head-toolbar-dropdown-icon mr-3"></i>Ajouter</a>

							<a class="dropdown-item" href="<?= WURI . 'export.php/' . $m[1] . '/t=list/'; ?>" target="_blank"><i class="fas fa-print p-portlet-head-toolbar-dropdown-icon mr-3"></i>Exporter</a>

							<a class="dropdown-item" href="<?= WURI . 'export.php/' . $m[1] . '/t=img/'; ?>" target="_blank"><i class="fas fa-image p-portlet-head-toolbar-dropdown-icon mr-3"></i>Exporter en image</a>

						</div>

					</div>

				</div>

			</div>


			<div id="sb-search-box"></div>

			<div id="sb-hidden-search-box">

				<?php #	Contenu ?>
				<?php if($zonescounter > 0): ?>

				<?php foreach($zones__ as $zone): ?>

				<div class="d-block pt-4 pb-4">
					
					<h3 class="h6 font-weight-bold text-uppercase" style="padding: 0 1.5rem"><?= $zone->zone_title; ?></h3>

					<?php if(cell_count("signboards", "zone", $zone->id) > 0): ?>

						<?php $communes = find_all("cmunes", " WHERE zid='$zone->id' ORDER BY cmune_title ASC"); ?>

						<?php foreach($communes as $commune): ?>

						<?php $signboards = find_signboards($zone->id, $commune->id); ?>

						<?php $SBC_counter = find_signboards_nbr($zone->id, $commune->id); ?>

						<table class="table table-striped p-datatable">
						
						<thead>

    					<tr>

      						<th scope="col" width="10%">#</th>

     						<th scope="col" width="10%">Format</th>

      						<th scope="col">Situation géograpique</th>

      						<th scope="col" width="10%" class="text-right">Actions</th>

   						</tr>

	 					</thead>

						<thead>

						<tr>

							<th colspan="4" class="p-text-color-orange text-capitalize font-weight-bold mb-0">

								<?= $commune->cmune_title; ?>
								&nbsp;<i class="fas fa-angle-right"></i>&nbsp;<?= $SBC_counter; ?>

							</th>

						</tr>

						</thead>

	 					<tbody>

	 					<?php if($SBC_counter > 0): ?>

 						<?php foreach($signboards as $item): ?>

 						<tr>

 							<?php if($item->etat !== "ras"): ?>
 							
 							<td scope="row" class="p-border-attention border-left border-danger"><?= 'DEV-' . $item->nbr; ?></td>

 							<?php else: ?>
 							
 							<td scope="row"><?= 'DEV-' . $item->nbr; ?></td>
 							
 							<?php endif ?>
 							
 							<td class="text-left text-uppercase"><?= $item->size . 'm²'; ?></td>
 							
 							<td class="text-left text-uppercase">

 								<?= $item->geoloc; ?>
 								<small class="d-block text-muted"><?= $item->etat; ?></small>

 							</td>
 							
 							<th class="text-right">
 								
 								<div class="dropdown d-inline">
					
									<a href type="link" id="<?= $item->id; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>

									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="<?= $item->id; ?>">

										<a class="dropdown-item" href="<?= WURI . '?r=' . $m[1] . '/infos/' . $item->id . '/'; ?>"><i class="far fa-eye p-datatable-toolbar-dropdown-icon mr-3"></i>Voir</a>

										<a class="dropdown-item" href="<?= WURI . '?r=' . $m[1] . '/edition/etape-1/' . $item->id . '/'; ?>"><i class="far fa-edit p-datatable-toolbar-dropdown-icon mr-3"></i>Modifier</a>

									</div>

								</div>

								<button class="btn btn-sm btn-link p-0 ml-3" id="<?= $item->id; ?>" style="cursor: pointer;" data-toggle="modal" data-target="#myModal<?= $item->id ?>"><i class="far fa-trash-alt"></i></button>

								<?php #	Confirmation Modal ?>
								<div class="modal fade p-confirm-modal-sm" id="myModal<?= $item->id ?>" tabindex="-1" role="dialog" aria-labelledby="Teste" aria-hidden="true">

									<div class="modal-dialog modal-sm modal-dialog-centered" role="document">

										<div class="modal-content">

											<h3 class="p-modal-head"><i class="fas fa-exclamation-circle text-danger icon"></i></h3>

											<div class="h5">Êtes-vous sûre?</div>

											<div class="p text-muted mb-4">Vous ne pourrez pas revenir en arrière!</div>


											<form action="<?= WURI . '?r=' . $m[1] . '/suppression/' . $item->id . '/'; ?>" method="post" class="p-3 mb-2">

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

 							<td colspan="5" class="p-datatable-empty">
 								
 								<p>Vous n'avez aucun panneaux dans <?= $commune->cmune_title; ?></p>

 							</td>

 						</tr>
	 					
	 					<?php endif; ?>

	 					</tbody>

						</table>

						<?php endforeach; ?>

					<?php else: ?>

						<div class="d-block">

						<table class="table table-hover table-striped p-datatable">

							<tbody>
								
								<tr>
									
									<td colspan="6" class="p-datatable-empty">

		 								<h5><i class="fas fa-box-open mr-2"></i>Tableau vide!</h5>

		 								<p>Vous n'avez aucun panneaux dans cette zone</p>

		 							</td>

								</tr>

							</tbody>

		 				</table>

						</div>

					<?php endif; ?>

				</div>
					
				<?php endforeach; ?>

				<?php else: ?>

				<div class="d-block pt-4 pb-4">

				<table class="table table-hover table-striped p-datatable">

					<tbody>
						
						<tr>
							
							<td colspan="6" class="p-datatable-empty">

 								<h5><i class="fas fa-box-open mr-2"></i>Tableau vide!</h5>

 								<p>Vous n'avez aucune zones définies pour le moment</p>

 							</td>

						</tr>

					</tbody>

 				</table>

				</div>

				<?php endif; ?>

			</div>

		</div>

	</div>

</div>