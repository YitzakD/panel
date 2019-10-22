<div class="p-portlet-wizard-nav">
		
	<div class="p-wizard-nav-line"></div>

	<div class="p-wizard-nav-items">

		<a class="p-wizard-nav-item" href data-pwizard-state="current">
			
			<span>1</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Modification</div>

		</a>

		<a class="p-wizard-nav-item" href data-pwizard-state="pendding">
				
			<span>2</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Ajout / Soustraction de panneaux</div>

		</a>

		<a class="p-wizard-nav-item" href data-pwizard-state="pendding">
			
			<span>3</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Finalisation</div>

		</a>

	</div>

</div>

<div class="p-portlet-wizard-form">

	<h3 class="h5 pt-4 pb-4"><?= $client->e_name; ?></h3>

	<form action="" method="post" class="p-form-table">

		<div class="form-row">

			<div class="form-group col-md-7 mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

				<label for="camp_name" class="mb-0">Libellé de la campagne&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="text" name="camp_name" id="camp_name" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("camp_name") ?: $campagne->camp_name; ?>" placeholder="Entrez le libellé" autofocus required />

			<?= !empty($error[1]) 
				? '<span class="help-block mt-1">' . $error[1] . '</span>' 
				: '<small class="text-muted">Entrez le nom de la campagne.</small>'; 
			?>

			</div>

		    <div class="form-group col-md-5 mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

				<label for="fin" class="mb-0">Date de fin&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="text" name="fin" id="fin" class="form-control p-form-ctrl p-form-ctrl-sm affdate" value="<?= get_input("fin") ?: $campagne->fin; ?>" placeholder="Entrez la date de fin" autocomplete="off" required />

			<?= !empty($error[2]) 
				? '<span class="help-block mt-1">' . $error[2] . '</span>' 
				: '<small class="text-muted">Entrez la date de fin de l\'opération.</small>'; 
			?>

			</div>

		</div>


		<button type="submit" name="steponesubmit" class="btn btn-sm btn-primary p-btn-primary mt-4 mb-3 float-right">Suivant</button>

	</form>

</div>