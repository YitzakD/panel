<div class="p-portlet rounded">
	
	<?php #	En-tête ?>
	<div class="p-portlet-wizard-nav">
		
		<div class="p-wizard-nav-line"></div>

		<div class="p-wizard-nav-items">
			
			<a class="p-wizard-nav-item" href="#" data-pwizard-state="current">
				
				<span>1</span>
				<i class="fas fa-check p-wizard-nav-item-icon"></i>
				<div class="p-wizard-nav-item-label">Création</div>

			</a>
			
			<a class="p-wizard-nav-item" href data-pwizard-state="pendding">
				
				<span>2</span>
				<i class="fas fa-check p-wizard-nav-item-icon"></i>
				<div class="p-wizard-nav-item-label">Durée</div>

			</a>

			
			<a class="p-wizard-nav-item" href data-pwizard-state="pendding">
				
				<span>3</span>
				<i class="fas fa-check p-wizard-nav-item-icon"></i>
				<div class="p-wizard-nav-item-label">Tarif</div>

			</a>
			
			<a class="p-wizard-nav-item" href data-pwizard-state="pendding">
				
				<span>4</span>
				<i class="fas fa-check p-wizard-nav-item-icon"></i>
				<div class="p-wizard-nav-item-label">Transport</div>

			</a>
			
			<a class="p-wizard-nav-item" href data-pwizard-state="pendding">
				
				<span>5</span>
				<i class="fas fa-check p-wizard-nav-item-icon"></i>
				<div class="p-wizard-nav-item-label">Taxes Alcool</div>

			</a>
			
			<a class="p-wizard-nav-item" href data-pwizard-state="pendding">
				
				<span>6</span>
				<i class="fas fa-check p-wizard-nav-item-icon"></i>
				<div class="p-wizard-nav-item-label">ODP / TM</div>

			</a>
			
			<a class="p-wizard-nav-item" href data-pwizard-state="pendding">
				
				<span>7</span>
				<i class="fas fa-check p-wizard-nav-item-icon"></i>
				<div class="p-wizard-nav-item-label">TVA / TSP</div>

			</a>
			
			<a class="p-wizard-nav-item" href data-pwizard-state="pendding">
				
				<span>8</span>
				<i class="fas fa-check p-wizard-nav-item-icon"></i>
				<div class="p-wizard-nav-item-label">Finalisation</div>

			</a>

		</div>

	</div>

	<div class="p-portlet-wizard-form">

		<h3 class="h5 pt-4 pb-4 text-muted">Créer une pro-forma</h3>

		<form action="" method="post" class="p-form-table">

			<div class="form-group mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

				<label for="client_id" class="mb-0">Client</label>

				<?php $clients = find_all("clients"); ?>

				<select name="client_id" class="form-control p-form-ctrl p-form-ctrl-sm">

				<?php foreach($clients as $item): ?>

	            	<option value="<?= $item->id ?>"><?= $item->e_name; ?></option>

	            <?php endforeach; ?>

				</select>

			<?= !empty($error[1]) 
				? '<span class="help-block mt-1">' . $error[1] . '</span>' 
				: '<small class="text-muted">Choisissez un client dans la liste ci-dessus.</small>'; 
			?>

			</div>

			<div class="form-row">

				<div class="form-group col-md-4 mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

					<label for="sb_size" class="mb-0">Format</label>

					<?php $sizes = find_all("sizes", "WHERE id>1"); ?>

					<select name="sb_size" class="form-control p-form-ctrl p-form-ctrl-sm">

					<?php foreach($sizes as $item): ?>

		            	<option value="<?= $item->size ?>"><?= $item->size . ' m²'; ?></option>

		            <?php endforeach; ?>

					</select>

				<?= !empty($error[2]) 
					? '<span class="help-block mt-1">' . $error[2] . '</span>' 
					: '<small class="text-muted">Choisissez un format dans la liste ci-dessus.</small>'; 
				?>

				</div>

				<div class="form-group col-md-8 mb-3<?= !empty($error) && count($error[3]) != 0 ? ' has-error' : '';  ?>">

					<label for="screen_type" class="mb-0">Type d'affichage</label>

					<select name="screen_type" class="form-control p-form-ctrl p-form-ctrl-sm">

		                <option value="Affichage papier">Affichage papier</option>

		                <option value="Affichage bâche">Affichage bâche</option>

					</select>

				<?= !empty($error[3]) 
					? '<span class="help-block mt-1">' . $error[3] . '</span>' 
					: '<small class="text-muted">Choisissez un type d\'affichage dans la liste ci-dessus.</small>'; 
				?>

				</div>

			</div>

			<h3 class="h5 pt-4 pb-4 text-muted">Dates</h3>

			<div class="form-row">

				<div class="form-group col-md-6 mb-3<?= !empty($error) && count($error[4]) != 0 ? ' has-error' : '';  ?>">

					<label for="debut" class="mb-0">Date de debut&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

					<input type="text" name="debut" id="debut" class="form-control p-form-ctrl p-form-ctrl-sm affdate" value="<?= get_input("debut"); ?>" placeholder="Entrez la date de debut" autocomplete="off" required />

				<?= !empty($error[4]) 
					? '<span class="help-block mt-1">' . $error[4] . '</span>' 
					: '<small class="text-muted">Entrez la date de debut de l\'opération.</small>'; 
				?>

				</div>

				<div class="form-group col-md-6 mb-3<?= !empty($error) && count($error[5]) != 0 ? ' has-error' : '';  ?>">

					<label for="fin" class="mb-0">Date de fin&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

					<input type="text" name="fin" id="fin" class="form-control p-form-ctrl p-form-ctrl-sm affdate" value="<?= get_input("fin"); ?>" placeholder="Entrez la date de fin" autocomplete="off" required />

				<?= !empty($error[5]) 
					? '<span class="help-block mt-1">' . $error[5] . '</span>' 
					: '<small class="text-muted">Entrez la date de fin de l\'opération.</small>'; 
				?>

				</div>
			
			</div>


			<button type="submit" name="newsubmit" class="btn btn-sm btn-primary p-btn-primary mb-3 mr-1">Suivant</button>

		</form>

	</div>

	

</div>