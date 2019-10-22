<div class="p-portlet-wizard-nav">
		
	<div class="p-wizard-nav-line"></div>

	<div class="p-wizard-nav-items">

		<a class="p-wizard-nav-item" href="<?= WURI . '?r=' . $m[1] . '/edition/etape-1/' . $ID . '/'; ?>" data-pwizard-state="done">
			
			<span>1</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Identification</div>

		</a>

		<a class="p-wizard-nav-item" href data-pwizard-state="current">
				
			<span>2</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Géolocalisation</div>

		</a>

		<a class="p-wizard-nav-item" href data-pwizard-state="pendding">
			
			<span>3</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Image</div>

		</a>

	</div>

</div>

<div class="p-portlet-wizard-form">

	<h3 class="h5 pt-4 pb-4 text-muted">Situation géographique</h3>

	<form action="" method="post" class="p-form-table">


		<div class="form-group mb-3<?= !empty($error) && count($error[4]) != 0 ? ' has-error' : '';  ?>">

				<label for="geolocalisation" class="mb-0">Situation géographique&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<textarea name="geolocalisation" class="form-control p-form-ctrl p-form-ctrl-sm" placeholder="Entrez la situation géographique" required><?= get_input("geolocalisation"); ?><?= $signboard->geoloc; ?></textarea>

		<?= !empty($error[4]) 
			? '<span class="help-block mt-1">' . $error[4] . '</span>' 
			: '<small class="text-muted">Entrez la situation géographique du panneau.</small>'; 
		?>

		</div>


		<a href="<?= WURI . '?r=' . $m[1] . '/edition/etape-1/' . $ID . '/'; ?>" class="btn btn-sm btn-primary p-btn-primary-outline mt-4 mb-3">Précédent</a>

		<button type="submit" name="steptwosubmit" class="btn btn-sm btn-primary p-btn-primary mt-4 mb-3 float-right">Suivant</button>

	</form>

</div>