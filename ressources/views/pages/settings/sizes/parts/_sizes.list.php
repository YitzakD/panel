<div class="p-inner-containor">
	
	<div class="p-inner-main-containor">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3>Ajouté récemment<small class="p-hidden">Total <?= $sizescounter__; ?></small></h3>
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

				<table class="table table-striped p-datatable">
				
					<thead>

    					<tr>

      						<th scope="col">#</th>

     						<th scope="col">Mensuration</th>

      						<th scope="col" class="text-right">Actions</th>

   						</tr>

 					</thead>


 					<tbody>
 						
 					<?php if($sizescounter__ > 0): ?>

 						<?php foreach($sizes__ as $item): ?>

 						<tr>
 							
 							<td scope="row"><?= $i++; ?></td>

 							<td><?= $item->size . 'm²'; ?></td>

 							<th class="text-right">

 								<a class="btn btn-sm p-0 m-0" href="<?= WURI . '?r=' . $m[1] . '/edition/' . $item->id . '/'; ?>" data-toggle="tooltip" data-placement="right" title="Editer le format">

 									<i class="far fa-edit p-datatable-toolbar-dropdown-icon"></i>

 								</a>

								<button class="btn btn-sm btn-link p-0 ml-3" id="<?= $item->id; ?>" style="cursor: pointer;" data-toggle="modal" data-target="#myModal<?= $item->id ?>"><i class="far fa-trash-alt"></i></button>

								<?php #	Confirmation Modal ?>
								<div class="modal fade p-confirm-modal-sm" id="myModal<?= $item->id ?>" tabindex="-1" role="dialog" aria-labelledby="Teste" aria-hidden="true">

									<div class="modal-dialog modal-sm modal-dialog-centered" role="document">

										<div class="modal-content">

											<h3 class="p-modal-head"><i class="fas fa-exclamation-circle text-danger icon"></i></h3>

											<div class="h5">Êtes-vous sûre?</div>

											<div class="p text-muted mb-4 font-weight-light">Vous ne pourrez pas revenir en arrière!</div>


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
 							
 							<td colspan="6" class="p-datatable-empty">

 								<h5><i class="fas fa-box-open mr-2"></i>Tableau vide!</h5>

 								<p>Vous n'avez aucun formats pour le moment</p>

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

			</div>
			
			<?php if($sizescounter__ > $limit): ?>
				
			<div class="p-portlet-foot">

				<div class="p-portlet-foot-main p-hidden">
					
					<blockquote class="blockquote" style="margin: 5px 0;">

						<footer class="blockquote-footer"><cite title="Source Title">Liste des <?= $m[1]; ?></cite></footer>

					</blockquote>

				</div>

				<div class="p-portlet-foot-toolbar">

				<?= paginate(WURI . "?r=" . $m[1] . "/", "&s=", $nbpages, $current); ?>

				</div>

			</div>

			<?php endif; ?>

		</div>

	</div>

</div>