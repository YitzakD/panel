<div class="p-inner-containor">
	
	<div class="p-inner-main-containor">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3>Ajouté récemment<small>Total <?= $fournisseurscounter__; ?></small></h3>
				</div>

				<div class="p-portlet-head-toolbar">
					
					<div class="dropdown">
						
						<button class="btn btn-sm btn-primary p-btn-primary" type="button" id="portleToolbar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="portleToolbar">

							<h6 class="dropdown-header">Actions rapides</h6>

							<a class="dropdown-item" href="<?= WURI . '?r=' . $m[1] . '/nouveau/'; ?>"><i class="fas fa-plus p-portlet-head-toolbar-dropdown-icon mr-3"></i>Ajouter</a>

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

     						<th scope="col">Dénomination</th>

     						<th scope="col">Interlocuteur</th>

     						<th scope="col">Contacts</th>

      						<th scope="col" class="text-right">Actions</th>

   						</tr>

 					</thead>


 					<tbody id="sb-search-table">
 						
 					<?php if($fournisseurscounter__ > 0): ?>

 						<?php foreach($fournisseurs__ as $item): ?>

 						<tr>
 							
 							<td scope="row"><?= $i++; ?></td>

 							<td>
 								<?php $in = explode(" ", $item->p_name); ?>
 									
								<span class="d-inline-block mr-2 p-datatable-pic">
									<div class="p-datatable-avatarname" style="background-color: <?= '#'.RandomCouleur(); ?>"><?= isset($in[1][0]) ? $avatarname = $in[0][0].$in[1][0] : $avatarname = $in[0][0]; ?></div>
								</span>

								<span class="d-inline-block">
									<div><?= ucfirst($item->p_name); ?></div>
									<small class="d-block text-muted"><?= setAtype($item->type); ?></small>
								</span>

 							</td>

 							<td><?=  ucfirst($item->c_name); ?></td>

 							<td>

 								<?= '+225 ' . $item->contacts; ?>
 								<small class="d-block text-muted"><?= $item->p_mail; ?></small>

 							</td>

 							<th class="text-right">
 								
 								<div class="dropdown d-inline">
						
									<a href type="link" id="<?= $item->id; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>

									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="<?= $item->id; ?>">

										<a class="dropdown-item" href="<?= WURI . '?r=' . $m[1] . '/infos/' . $item->id . '/'; ?>"><i class="far fa-eye p-datatable-toolbar-dropdown-icon mr-3"></i>Voir</a>

										<a class="dropdown-item" href="<?= WURI . '?r=' . $m[1] . '/edition/' . $item->id . '/'; ?>"><i class="far fa-edit p-datatable-toolbar-dropdown-icon mr-3"></i>Modifier</a>

									</div>

								</div>

 							</th>

 						</tr>

 						<?php endforeach; ?>	

 					<?php else: ?>

 						<tr>
 							
 							<td colspan="6" class="p-datatable-empty">

 								<h5><i class="fas fa-box-open mr-2"></i>Tableau vide!</h5>

 								<p>Vous n'avez aucun fournisseurs pour le moment</p>

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

				<?php if($fournisseurscounter__ > $limit): ?>

				<div class="p-portlet-foot-toolbar">

				<?= paginate(WURI . "?r=" . $m[1] . "/", "&s=", $nbpages, $current); ?>

				</div>

				<?php endif; ?>

			</div>

		</div>

	</div>

</div>