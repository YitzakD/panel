<div class="row no-gutters">

	<div class="col-12 col-md-12 col-lg-12 p-portlet rounded">

		<?php #	En-tête ?>
		<div class="p-portlet-head">
			
			<div class="p-portlet-head-label"><h3>Profil <small class="text-capitalize"><?= $utilisateur->pseudo; ?></small></h3></div>

		</div>


		<?php #	Contenu ?>
		<div class="p-portlet-body">
		
			<table class="table p-display-info-list">

				<tbody>

				<tr>
					
					<td>Compte</td>
					
					<td><?= $utilisateur->active > 0 ? "Actif" : "Non actif"; ?></td>

				</tr>

				<tr>
					
					<td>Rôle admin</td>

					<?php $utype = find_one("utypes", "id", $utilisateur->utid); ?>
					
					<td><?= $utype->utype_name; ?></td>

				</tr>

				<tr>
					
					<td>Adresse E-mail</td>
					
					<td><?= $utilisateur->email ?></td>

				</tr>

				</tbody>	

			</table>

		</div>

	</div>

	<div class="col-12 col-md-12 col-lg-12 p-portlet rounded">

		<?php #	En-tête ?>
		<div class="p-portlet-head">
			
			<div class="p-portlet-head-label"><h3>Journal d'activités <small>25 dernières</small></h3></div>

		</div>


		<?php #	Contenu ?>
		<div class="d-block pb-4">

			<table class="table table-striped p-datatable">

				<thead>
					
				<tr>
					
					<th scope="col">Field</td>

					<th scope="col">Activités</td>

					<th scope="col"></td>

				</tr>

				</thead>

				<tbody>
					
				<?php if($activitiescounter > 0): ?>

				<?php foreach($activities as $item): ?>
					
				<tr>
					
					<td>
						
						<span class="text-capitalize"><?= $item->field; ?></span>
						<span class="d-block small text-muted"><?= set_time($item->created); ?></span>

					</td>

					<td>
						
						<span class="d-block small text-muted text-capitalize"><?= $item->title; ?></span>
						<?= $item->activity; ?>

					</td>

					<td style="display: table-cell!important;"><?=  date('j/n/Y ',strtotime($item->created)); ?></td>

				</tr>

				<?php endforeach; ?>
				
				<?php else: ?>

				<tr>
					
					<td colspan="3" class="p-datatable-empty">

							<h5><i class="fas fa-box-open mr-2"></i>Tableau vide!</h5>

							<p>Ce utilisateur n'a aucunes activités pour le moment</p>

						</td>

				</tr>	

				<?php endif; ?>	

				</tbody>

			</table>
				
		</div>

	</div>

</div>