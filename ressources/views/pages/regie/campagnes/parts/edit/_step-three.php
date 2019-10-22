<div class="p-portlet-wizard-nav">
		
	<div class="p-wizard-nav-line"></div>

	<div class="p-wizard-nav-items">

		<a class="p-wizard-nav-item" href="<?= WURI . '?r=' . $m[1] . '/edition/etape-1/' . $ID . '/'; ?>" data-pwizard-state="done">
			
			<span>1</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Modification</div>

		</a>

		<a class="p-wizard-nav-item" href="<?= WURI . '?r=' . $m[1] . '/edition/etape-1/' . $ID . '/'; ?>" data-pwizard-state="done">
				
			<span>2</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Ajout / Soustraction de panneaux</div>

		</a>

		<a class="p-wizard-nav-item" href data-pwizard-state="current">
			
			<span>3</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Finalisation</div>

		</a>

	</div>

</div>

<div class="p-portlet-wizard-form">

	<h3 class="h5 pt-4 pb-4 text-muted">Récapitulatif</h3>

	<div class="row no-gutters">

		<div class="col-12 col-md-6 col-lg-6 mb-4">
			
			<span class="d-block text-muted small">Nom du client campagne</span>
			<h3 class="h4 text-uppercase"><?= $client->e_name; ?></h3>

		</div>
		
		<div class="col-12 col-md-6 col-lg-6 mb-4">
			
			<span class="d-block text-muted small">Libellé de la réservation</span>
			<h3 class="h4 text-uppercase"><?= $campagne->camp_name; ?></h3>

		</div>
		
		<div class="col-12 col-md-6 col-lg-6 mb-4">
			
			<span class="d-block text-muted small">Début de l'opération</span>
			<h3 class="h4 text-uppercase"><?= date('j/n/Y ',strtotime($campagne->debut)); ?></h3>

		</div>
		
		<div class="col-12 col-md-6 col-lg-6 mb-4">
			
			<span class="d-block text-muted small">Fin de l'opération</span>
			<h3 class="h4 text-uppercase"><?= date('j/n/Y ',strtotime($campagne->fin)); ?></h3>

		</div>

	</div>

	<h3 class="h5 pt-4 pb-4 text-muted">Liste de panneaux</h3>

	<table class="table table-sm table-striped">
		
		<thead>

		<tr>

			<th scope="col">#</th>

			<th scope="col">Situation géograpique</th>

			<!-- <th scope="col" class="text-right">Actions</th> -->

		</tr>

		</thead>

		<tbody>

		<?php foreach($rsvd_nbr as $item): ?>	
			<?php $sbinfo = find_one("signboards", "nbr", $item->nbr); ?>
		<tr>
			
			<td>

				<?= "DEV-" . $item->nbr; ?>
				
				<?php $sizeof = find_one("sizes", "id", $sbinfo->size); ?>
				<span class="d-block small text-muted"><?= $sizeof->size . 'm²'; ?></span>

			</td>
			
			<td>
				
				<?= $sbinfo->geoloc; ?>
				
				<?php $commune = find_one("cmunes", "id", $sbinfo->cmune); ?>
				<span class="d-block small text-muted"><?= $commune->cmune_title; ?></span>

			</td>

			<!-- <th></th> -->

		</tr>

		<?php endforeach; ?>

		</tbody>

	</table>

	<form action="" method="post" class="p-form-table">

		<a href="<?= WURI . '?r=' . $m[1] . '/edition/etape-2/' . $ID . '/'; ?>" class="btn btn-sm btn-primary p-btn-primary-outline mt-4 mb-3">Précédent</a>

		<button type="submit" name="stepthreesubmit" class="btn btn-sm btn-primary p-btn-primary mt-4 mb-3 float-right">Suivant</button>

	</form>

</div>