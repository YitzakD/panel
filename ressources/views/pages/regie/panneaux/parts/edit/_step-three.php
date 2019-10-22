<div class="p-portlet-wizard-nav">
		
	<div class="p-wizard-nav-line"></div>

	<div class="p-wizard-nav-items">

		<a class="p-wizard-nav-item" href="<?= WURI . '?r=' . $m[1] . '/edition/etape-1/' . $ID . '/'; ?>" data-pwizard-state="done">
			
			<span>1</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Identification</div>

		</a>

		<a class="p-wizard-nav-item" href="<?= WURI . '?r=' . $m[1] . '/edition/etape-2/' . $ID . '/'; ?>" data-pwizard-state="done">
				
			<span>2</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Géolocalisation</div>

		</a>

		<a class="p-wizard-nav-item" href data-pwizard-state="current">
			
			<span>3</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Image</div>

		</a>

	</div>

</div>

<div class="p-portlet-wizard-form">

	<h3 class="h5 pt-4 pb-4 text-muted">Situation géographique</h3>

	<form action="" method="post" class="p-form-table" enctype="multipart/form-data">

			<div class="form-group mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

				<label for="etat" class="mb-0">Choix d'image</label>

				<div class="input-group">
					
					<div class="custom-file">

						<input type="file" name="file_road" id="p-sb-file-box" class="custom-file-input p-form-ctrl p-form-ctrl-sm">

						<label class="custom-file-label" for="p-sb-file-box">Choisisser un fichier</label>

					</div>

					<span class="input-group-addon input-ga-select rounded-right font-weight-bold">

						<i class="fas fa-download"></i>

					</span>

				</div>	

			<?= !empty($error[1]) 
				? '<span class="help-block mt-1">' . $error[1] . '</span>' 
				: '<small class="text-muted" id="p-get-file-name">Choisissez une image pour le panneau. Taille maximale autorisée : 5Mo</small>'; 
			?>

			</div>


		<a href="<?= WURI . '?r=' . $m[1] . '/edition/etape-2/' . $ID . '/'; ?>" class="btn btn-sm btn-primary p-btn-primary-outline mt-4 mb-3">Précédent</a>

		<button type="submit" name="stepthreesubmit" class="btn btn-sm btn-primary p-btn-primary mt-4 mb-3 float-right">Suivant</button>

	</form>

</div>