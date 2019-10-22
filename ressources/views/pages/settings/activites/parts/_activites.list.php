<div class="p-inner-containor">
	
	<div class="p-inner-main-containor">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3>Ajouté récemment<small class="p-hidden">Total <?= $activitiescounter__; ?></small></h3>
				</div>

			</div>


			<?php #	Contenu ?>
			<div class="d-block pt-4 pb-4">

				<table class="table table-striped p-datatable">
				
					<thead>

    					<tr>

      						<th scope="col">#</th>

     						<th scope="col">Année</th>

     						<th scope="col">Compte</th>

      						<th scope="col" class="text-right">Actions</th>

   						</tr>

 					</thead>


 					<tbody id="sb-search-table">
 						
 					<?php if($activitiescounter__ > 0): ?>

 						<?php foreach($allyears__ as $item): ?>

		                <?php

		                	$actualyear = date("Y");

		                	$__activitiescounter__ = cell_count("activities", "created_year", $item->created_year);

		                	$__userscounter__ = find_distinct_nbr("activities", "uid", "WHERE created_year='$item->created_year'");

	                	?>

 						<tr>
 							
 							<td scope="row"><?= $i++; ?></td>

 							<td scope="row">

 								<?= $item->created_year; ?>

 								<span class="d-block small text-muted"><?= $item->created_year < $actualyear ? "Pasée" : "En cours"; ?></span>

 							</td>

 							<td>

 								<?= $__activitiescounter__>1 ? $__activitiescounter__." activités" : $__activitiescounter__." activité"; ?>

 								<span class="d-block small text-muted"><?= $__userscounter__>1 ? $__userscounter__." utilisateurs" : $__userscounter__." utilisateur"; ?></span>

 							</td>

 							<th class="text-right">

								<a href="<?= WURI . '?r=' . $m[1] . '/details/' . $item->created_year . '/'; ?>" class="btn btn-sm p-0" style="cursor: pointer;"><i class="far fa-eye"></i></a>

 							</th>

 						</tr>

 						<?php endforeach; ?>	

 					<?php else: ?>

 						<tr>
 							
 							<td colspan="6" class="p-datatable-empty">

 								<h5><i class="fas fa-box-open mr-2"></i>Tableau vide!</h5>

 								<p>Vous n'avez aucune activités détecter pour le moment</p>

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
				
				<?php if($activitiescounter__ > $limit): ?>

				<div class="p-portlet-foot-toolbar">

				<?= paginate(WURI . "?r=" . $m[1] . "/", "&s=", $nbpages, $current); ?>

				</div>

				<?php endif; ?>

			</div>

		</div>

	</div>

</div>