<div class="row no-gutters">

	<?php #	Recents municipalities ?>
	<div class="col-12 col-md-12 col-lg-12">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3>Communes récentes</h3>
				</div>

			</div>


			<?php #	Contenu ?>
			<div class="d-block pb-4">

				<table class="table table-striped p-datatable">
					
					<thead>
						
						<tr>
							
							<th scope="col">#</th>

     						<th scope="col">Dénomination</th>

     						<th scope="col" class="text-right">Actions</th>

						</tr>

					</thead>

					<tbody>

					<?php if($cmunescounter > 0): ?>

						<?php $i = 1; ?>

						<?php foreach($communes as $item): ?>

						<tr>
	 							
	 						<td scope="row"><?= $i++; ?></td>

	 						<td><?= $item->cmune_title; ?></td>

	 						<th class="text-right">

	 							<a href="<?= WURI . '?r=communes/infos/' . $item->id . '/'; ?>" class="btn btn-sm p-0"><i class="far fa-eye"></i></a>

	 						</th>

						</tr>

						<?php endforeach; ?>


					<?php else: ?>

						<tr>
							
							<td colspan="3" class="p-datatable-empty">
	 								
	 								<p>Vous n'avez aucune communes dans <?= $zone->zone_title; ?></p>

							</td>

						</tr>

					<?php endif; ?>

					</tbody>

				</table>

			</div>	

		</div>

	</div>



	<?php #	Recents signboards ?>
	<div class="col-12 col-md-12 col-lg-12">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3>Panneaux récents</h3>
				</div>

			</div>


			<?php #	Contenu ?>
			<div class="d-block pb-4">

				<table class="table table-striped p-datatable">
					
					<thead>
						
						<tr>
							
							<th scope="col">#</th>

     						<th scope="col">Format</th>

     						<th scope="col" class="text-right">Actions</th>

						</tr>

					</thead>

					<tbody>

					<?php if($sboardscounter > 0): ?>

						<?php $i = 1; ?>

						<?php foreach($sboards as $item): ?>

							<?php $size = find_one("sizes", "id", $item->size); ?>

						<tr>
	 							
	 						<td scope="row"><?= 'DEV-' . $item->nbr; ?></td>

	 						<td><?= $size->size . 'm²'; ?></td>

	 						<th class="text-right">

	 							<a href="<?= WURI . '?r=panneaux/infos/' . $item->id . '/'; ?>" class="btn btn-sm p-0"><i class="far fa-eye"></i></a>

	 						</th>

						</tr>

						<?php endforeach; ?>


					<?php else: ?>

						<tr>
							
							<td colspan="3" class="p-datatable-empty">
	 								
	 								<p>Vous n'avez aucun panneaux dans <?= $zone->zone_title; ?></p>

							</td>

						</tr>

					<?php endif; ?>

					</tbody>

				</table>	
				
			</div>	

		</div>

	</div>

</div>