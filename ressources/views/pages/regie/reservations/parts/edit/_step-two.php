<div class="p-portlet-wizard-nav">
		
	<div class="p-wizard-nav-line"></div>

	<div class="p-wizard-nav-items">

		<a class="p-wizard-nav-item" href="<?= WURI . '?r=' . $m[1] . '/edition/etape-1/' . $ID . '/'; ?>" data-pwizard-state="done">
			
			<span>1</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Création</div>

		</a>

		<a class="p-wizard-nav-item" href data-pwizard-state="current">
				
			<span>2</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Durée</div>

		</a>

		<a class="p-wizard-nav-item" href data-pwizard-state="pendding">
			
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

	<h3 class="h5 pt-4 pb-4 text-muted">Dates</h3>

	<form action="" method="post" class="p-form-table">

		<div class="form-row">

		    <div class="form-group col-md-6 mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

				<label for="debut" class="mb-0">Date de debut&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="text" name="debut" id="debut" class="form-control p-form-ctrl p-form-ctrl-sm affdate" value="<?= get_input("debut") ?: $reservation->debut; ?>" placeholder="Entrez la date de debut" autocomplete="off" required />

			<?= !empty($error[1]) 
				? '<span class="help-block mt-1">' . $error[1] . '</span>' 
				: '<small class="text-muted">Entrez la date de debut de l\'opération.</small>'; 
			?>

			</div>

		    <div class="form-group col-md-6 mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

				<label for="fin" class="mb-0">Date de fin&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="text" name="fin" id="fin" class="form-control p-form-ctrl p-form-ctrl-sm affdate" value="<?= get_input("fin") ?: $reservation->fin; ?>" placeholder="Entrez la date de fin" autocomplete="off" required />

			<?= !empty($error[2]) 
				? '<span class="help-block mt-1">' . $error[2] . '</span>' 
				: '<small class="text-muted">Entrez la date de fin de l\'opération.</small>'; 
			?>

			</div>

		</div>
		


		<a href="<?= WURI . '?r=' . $m[1] . '/edition/etape-1/' . $ID . '/'; ?>" class="btn btn-sm btn-primary p-btn-primary-outline mt-4 mb-3">Précédent</a>

		<button type="submit" name="steptwosubmit" class="btn btn-sm btn-primary p-btn-primary mt-4 mb-3 float-right">Suivant</button>

	</form>

</div>