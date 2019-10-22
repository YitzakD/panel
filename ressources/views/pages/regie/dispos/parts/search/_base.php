<div class="p-portlet rounded">
	
	<?php #	En-tête ?>
	<div class="p-portlet-head">
		
		<div class="p-portlet-head-label">
			<h3>Recherche de disponibilité</h3>
		</div>

	</div>


	<?php #	Contenu ?>
	<div class="p-portlet-body">
		
		<form action="" method="post" class="p-form-table">

			<div class="form-row">
			
				<div class="form-group col-md-6 mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

					<label for="debut" class="mb-0">Date de debut&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

					<input type="text" name="debut" id="debut" class="form-control p-form-ctrl p-form-ctrl-sm affdate" value="<?= get_input("debut"); ?>" placeholder="Entrez la date de debut" autocomplete="off" required />

				<?= !empty($error[1]) 
					? '<span class="help-block mt-1">' . $error[1] . '</span>' 
					: '<small class="text-muted">Déterminer une date de début.</small>'; 
				?>

				</div>
			
				<div class="form-group col-md-6 mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

					<label for="fin" class="mb-0">Date de fin&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

					<input type="text" name="fin" id="fin" class="form-control p-form-ctrl p-form-ctrl-sm affdate" value="<?= get_input("fin"); ?>" placeholder="Entrez la date de fin" autocomplete="off" required />

				<?= !empty($error[2]) 
					? '<span class="help-block mt-1">' . $error[2] . '</span>' 
					: '<small class="text-muted">Déterminer une date butoire.</small>'; 
				?>

				</div>

			</div>

			<div class="form-row">
			
				<div class="form-group col-md-4 mb-3<?= !empty($error) && count($error[3]) != 0 ? ' has-error' : '';  ?>">

					<label for="size" class="mb-0">Format</label>

					<?php $sizes = find_all("sizes", " WHERE id>1"); ?>

					<select name="size" id="size" class="form-control p-form-ctrl p-form-ctrl-sm">

					<?php foreach($sizes as $item): ?>

		            	<option value="<?= $item->id ?>"><?= $item->size . ' m²'; ?></option>

		            <?php endforeach; ?>

					</select>

				<?= !empty($error[3]) 
					? '<span class="help-block mt-1">' . $error[3] . '</span>' 
					: '<small class="text-muted">Choisissez un format dans la liste ci-dessus.</small>'; 
				?>

				</div>
			
				<div class="form-group col-md-8 mb-3<?= !empty($error) && count($error[4]) != 0 ? ' has-error' : '';  ?>">

					<label for="area" class="mb-0">Zone</label>

					<?php $zones = find_all("zones", " WHERE id>1"); ?>

					<select name="area" id="area" class="form-control p-form-ctrl p-form-ctrl-sm">

						<option disabled class="font-weight-bold text-muted">Zones</option>

						<?php foreach($zones as $item): ?>

							<option value="<?= $item->id ?>"><?= $item->zone_title; ?></option>

						<?php endforeach; ?>

						<option disabled class="font-weight-bold text-muted">Autres</option>

						<option value="0">Tout le térritoire</option>

					</select>

				<?= !empty($error[4]) 
					? '<span class="help-block mt-1">' . $error[4] . '</span>' 
					: '<small class="text-muted">Choisissez la zone dans la liste ci-dessus.</small>'; 
				?>

				</div>

			</div>

			<button type="submit" id="p-show-dispo-btn" name="newsubmit" class="btn btn-sm btn-primary p-btn-primary mb-3 mr-1">Rechercher la disponibilité</button>

		</form>

	</div>

</div>