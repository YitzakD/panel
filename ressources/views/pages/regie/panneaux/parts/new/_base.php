<div class="p-portlet rounded">
	
	<?php #	En-tête ?>
	<div class="p-portlet-wizard-nav">
		
		<div class="p-wizard-nav-line"></div>

		<div class="p-wizard-nav-items">
			
			<a class="p-wizard-nav-item" href="#" data-pwizard-state="current">
				
				<span>1</span>
				<i class="fas fa-check p-wizard-nav-item-icon"></i>
				<div class="p-wizard-nav-item-label">Identification</div>

			</a>
			
			<a class="p-wizard-nav-item" href data-pwizard-state="pendding">
				
				<span>2</span>
				<i class="fas fa-check p-wizard-nav-item-icon"></i>
				<div class="p-wizard-nav-item-label">Geolocalisation</div>

			</a>

			
			<a class="p-wizard-nav-item" href data-pwizard-state="pendding">
				
				<span>3</span>
				<i class="fas fa-check p-wizard-nav-item-icon"></i>
				<div class="p-wizard-nav-item-label">Image</div>

			</a>

		</div>

	</div>

	<div class="p-portlet-wizard-form">

		<h3 class="h5 pt-4 pb-4 text-muted">Identifiction</h3>

		<form action="" method="post" class="p-form-table">

			<div class="form-group mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

				<label for="nbr" class="mb-0">Identifiant&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="number" name="nbr" id="nbr" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("nbr"); ?>" placeholder="Entrez l'identifiant" autofocus required />

			<?= !empty($error[1]) 
				? '<span class="help-block mt-1">' . $error[1] . '</span>' 
				: '<small class="text-muted">Entrez l\'identifiant du panneau.</small>'; 
			?>

			</div>


			<div class="form-row">

				<div class="form-group col-md-5 mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

					<label for="format" class="mb-0">Format</label>

					<div class="input-group">

						<select name="format" id="format" class="form-control p-form-ctrl p-form-ctrl-sm">

						<?php foreach($formats as $item): ?>
						
							<option value="<?= $item->id ?>"><?= $item->size; ?></option>	

						<?php endforeach; ?>

						</select>
				
						<span class="input-group-addon input-ga-select rounded-right font-weight-bold">m²</span>

					</div>

				<?= !empty($error[2]) 
					? '<span class="help-block mt-1">' . $error[2] . '</span>' 
					: '<small class="text-muted">Choisissez un client dans la liste ci-dessus.</small>'; 
				?>

				</div>

				<div class="form-group col-md-7 mb-3<?= !empty($error) && count($error[3]) != 0 ? ' has-error' : '';  ?>">

					<label for="cid" class="mb-0">Commune d'appartenance</label>

					<select name="cid" id="cid" class="form-control p-form-ctrl p-form-ctrl-sm">

						<?php foreach($communes as $item): ?>
						
						<option value="<?= $item->id ?>"><?= $item->cmune_title; ?></option>	

						<?php endforeach; ?>

					</select>

				<?= !empty($error[3]) 
					? '<span class="help-block mt-1">' . $error[3] . '</span>' 
					: '<small class="text-muted">Choisissez la commune d\'appartenance du panneau dans la liste ci-dessus.</small>'; 
				?>

				</div>

			</div>


			<button type="submit" name="steponesubmit" class="btn btn-sm btn-primary p-btn-primary mb-3 mr-1">Suivant</button>

		</form>

	</div>	

</div>