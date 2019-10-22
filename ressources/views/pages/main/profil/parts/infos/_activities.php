<div class="row no-gutters">

	<div class="col-12 col-md-12 col-lg-12 p-portlet rounded">

		<?php #	En-tête ?>
		<div class="p-portlet-head">
			
			<div class="p-portlet-head-label"><h3>Profil</h3></div>

		</div>


		<?php #	Contenu ?>
		<div class="p-portlet-body">
		
			<table class="table p-display-info-list">

				<tbody>
				<tr>
					
					<td>Identifiant</td>
					
					<td><?= $userinfo->pseudo; ?></td>

				</tr>

				<tr>
					
					<td>Compte</td>
					
					<td><?= $userinfo->active > 0 ? "Actif" : "Non actif"; ?></td>

				</tr>

				<tr>
					
					<td>Adresse E-mail</td>
					
					<td><?= $userinfo->email ?></td>

				</tr>

				</tbody>

			</table>

		</div>

	</div>

	<div class="col-12 col-md-12 col-lg-12 p-portlet rounded">

		<?php #	En-tête ?>
		<div class="p-portlet-head">
			
			<div class="p-portlet-head-label"><h3>Journal d'activités</h3></div>

		</div>


		<?php #	Contenu ?>
		<div class="d-block pb-4">

			<table class="table table-striped p-datatable">

				<thead>
					
				<tr>
					
					<th scope="col">#</th>

					<th scope="col">Année</th>

					<th scope="col">Etat</th>

					<th scope="col">Compte</th>

					<th scope="col" class="text-right">Actions</th>

				</tr>

				</thead>

				<tbody>
					
				<?php if($activitiescounter > 0): ?>

				<?php foreach($allyears as $year): ?>

				<?php 

					$actualyear = date("Y");
					
					$__activitiescounter__ = cell_count("activities", "uid", $userinfo->id, "AND created_year='$year->created_year'");

				?>
					
				<tr>

					<td scope="row"><?= $i++; ?></td>
					
					<td><?= $year->created_year; ?></td>

					<td><?= $year->created_year < $actualyear ? "Passée" : "En cours"; ?></td>

					<td><?= $__activitiescounter__ > 1 ? $__activitiescounter__ . " activités" : $__activitiescounter__ . " activité"; ?></td>

					<th class="text-right">

						<a href="<?= WURI . '?r=' . $m[1] . '/activites/' . $year->created_year . '/'; ?>" class="btn btn-sm p-0"><i class="far fa-eye"></i></a>

					</th>

				</tr>

				<?php endforeach; ?>
				
				<?php else: ?>

				<tr>
					
					<td colspan="3" class="p-datatable-empty">

						<h5><i class="fas fa-box-open mr-2"></i>Tableau vide!</h5>

						<p>Vous n'avez aucunes activités pour le moment</p>

					</td>

				</tr>

				<?php endif; ?>	

				</tbody>

			</table>
				
		</div>

	</div>

</div>