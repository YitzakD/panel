<div class="p-portlet-wizard-nav">
		
	<div class="p-wizard-nav-line"></div>

	<div class="p-wizard-nav-items">

		<a class="p-wizard-nav-item" href="<?= WURI . '?r=' . $m[1] . '/edition/etape-1/' . $ID . '/'; ?>" data-pwizard-state="done">
			
			<span>1</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Création</div>

		</a>

		<a class="p-wizard-nav-item" href="<?= WURI . '?r=' . $m[1] . '/edition/etape-2/' . $ID . '/'; ?>" data-pwizard-state="done">
				
			<span>2</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Durée</div>

		</a>

		<a class="p-wizard-nav-item" href data-pwizard-state="current">
			
			<span>3</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Choix de panneaux</div>

		</a>

		<a class="p-wizard-nav-item" href data-pwizard-state="pendding">
			
			<span>4</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Finalisation</div>

		</a>

	</div>

</div>

<div class="p-portlet-wizard-form">

	<h3 class="h5 pt-4 pb-4 text-muted">Choix en fonction de la disponibilité de panneaux</h3>

	<form action="" method="post" class="p-form-table">

	    <div class="form-group mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

			<label for="debut" class="mb-0">Choix de panneaux&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

			<?php $zones = find_all("zones", "WHERE id>1 ORDER BY zone_title ASC");  ?>

			<?php foreach($zones as $zone): ?>

				<?php $communes = find_all("cmunes",  "WHERE zid='$zone->id' ORDER BY cmune_title ASC"); ?>

				<?php foreach($communes as $commune): ?>

				<div class="row no-gutters p-sb-picker mb-4">	

				<?php

					$fsboards = find_fsignboards($zone->id, $commune->id, $fid, $state);

					$bfsboards = find_signboards_tbf($reservation->debut, $reservation->fin, $zone->id, $commune->id, $fid, $state);

					$freesboards = array_merge($fsboards, $bfsboards);

					#$freesboards = $fsboards + $bfsboards;

				?>

					<?php foreach($freesboards as $item): ?>

					<div class="col-12 col-md-3 col-lg-2 nopad text-center">

						<label class="image-checkbox <?= f_inarray($item->nbr, "nbr", $rsvd_nbr) ? 'image-checkbox-checked' : '' ?>">

							<img class="img-responsive" src="<?= $item->file_road; ?>" />

							<div class="image-checkbox-image-text"><div class="img-text rounded"><?= $item->nbr; ?></div></div>

							<input type="checkbox" name="sboard[]" value="<?= $item->nbr; ?>" <?= f_inarray($item->nbr, "nbr", $rsvd_nbr) ? 'checked ' : ' ' ?>/>

							<span class="imc-icon text-center d-none"><i class="fas fa-check icr-ico"></i></span>

						</label>

					</div>

					<?php endforeach; ?>
					
				</div>

				<?php endforeach; ?>

			<?php endforeach; ?>


			<!---->

		<?= !empty($error[1]) 
			? '<span class="help-block mt-1">' . $error[1] . '</span>' 
			: '<small class="text-muted">CHoisissez un ou plusieurs panneaux dans la liste ci-dessous.</small>'; 
		?>

		</div>
		


		<a href="<?= WURI . '?r=' . $m[1] . '/edition/etape-2/' . $ID . '/'; ?>" class="btn btn-sm btn-primary p-btn-primary-outline mt-4 mb-3">Précédent</a>

		<button type="submit" name="stepthreesubmit" class="btn btn-sm btn-primary p-btn-primary mt-4 mb-3 float-right">Suivant</button>

	</form>

</div>