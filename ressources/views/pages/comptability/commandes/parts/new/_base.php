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
				<div class="p-wizard-nav-item-label">Détails</div>

			</a>

			
			<a class="p-wizard-nav-item" href data-pwizard-state="pendding">
				
				<span>3</span>
				<i class="fas fa-check p-wizard-nav-item-icon"></i>
				<div class="p-wizard-nav-item-label">Taxes & Facturations</div>

			</a>
			
			<a class="p-wizard-nav-item" href data-pwizard-state="pendding">
				
				<span>4</span>
				<i class="fas fa-check p-wizard-nav-item-icon"></i>
				<div class="p-wizard-nav-item-label">Finalisation</div>

			</a>

		</div>

	</div>

	<div class="p-portlet-wizard-form">

		<h3 class="h5 pt-4 pb-4 text-muted">Créer une commande</h3>

		<form action="" method="post" class="p-form-table">

			<div class="form-group mb-3">

				<label for="provider" class="mb-0">Fournisseur</label>

				<div class="font-weight-bold"><?= ucfirst($provider->p_name); ?></div>

			</div>

			<div class="form-group mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

				<label for="dating" class="mb-0">Datation&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="text" name="dating" id="dating" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("dating"); ?>" placeholder="Ex., 01/01/2000 - 31/01/2000" autofocus required />

			<?= !empty($error[1]) 
				? '<span class="help-block mt-1">' . $error[1] . '</span>' 
				: '<small class="text-muted">Entrez la datation de la commande.</small>'; 
			?>

			</div>

			<div class="form-group mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

				<label for="description" class="mb-0">Description&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<textarea name="description" class="form-control p-form-ctrl p-form-ctrl-sm" placeholder="Entrez le descriptif de la commande" required><?= get_input("description"); ?></textarea>

			<?= !empty($error[2]) 
				? '<span class="help-block mt-1">' . $error[2] . '</span>' 
				: '<small class="text-muted">Entrez la désignation à apparaître sur la commande.</small>'; 
			?>

			</div>


			<button type="submit" name="newsubmit" class="btn btn-sm btn-primary p-btn-primary mb-3 mr-1">Suivant</button>

		</form>

	</div>

	

</div>