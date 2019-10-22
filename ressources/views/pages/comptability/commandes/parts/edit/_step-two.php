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
			<div class="p-wizard-nav-item-label">Détails</div>

		</a>

		<a class="p-wizard-nav-item" href data-pwizard-state="pendding">
			
			<span>3</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Taxes</div>

		</a>

		<a class="p-wizard-nav-item" href data-pwizard-state="pendding">
			
			<span>4</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Finalisation</div>

		</a>

	</div>

</div>

<div class="p-portlet-wizard-form">

	<h3 class="h5 pt-4 pb-4 text-muted">Détails de commande</h3>

	<form action="" method="post" class="p-form-table">

		<div class="form-row">

			<div class="form-group col-md-4 mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

				<label for="qte" class="mb-0">Quantité&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="number" name="qte" id="qte" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("qte") ?: $commande->qte; ?>" placeholder="Entrez la quantité" autofocus required />

			<?= !empty($error[1]) 
				? '<span class="help-block mt-1">' . $error[1] . '</span>' 
				: '<small class="text-muted">Entrez la quantité d\'élément à la commande.</small>'; 
			?>

			</div>

			<div class="form-group col-md-8 mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

				<label for="pu" class="mb-0">Prix unitaire&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="number" name="pu" id="pu" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("pu") ?: $commande->pu; ?>" placeholder="Entrez le prix unitaire" required />

			<?= !empty($error[2]) 
				? '<span class="help-block mt-1">' . $error[2] . '</span>' 
				: '<small class="text-muted">Entrez le prix à l\'unité de l\'élément à la commande.</small>'; 
			?>

			</div>

		</div>

		<div class="form-group mb-3<?= !empty($error) && count($error[3]) != 0 ? ' has-error' : '';  ?>">

			<label for="ht" class="mb-0">Prix HT&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

			<input type="number" name="ht" id="ht" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("ht") ?: $commande->ht; ?>" placeholder="Entrez le prix hors taxe" required />

		<?= !empty($error[3]) 
			? '<span class="help-block mt-1">' . $error[3] . '</span>' 
			: '<small class="text-muted">Entrez le prix total Hors Taxes de la commande.</small>'; 
		?>

		</div>

		<h3 class="h5 pt-4 pb-4 text-muted">Frais liés au transport</h3>

		<div class="form-group mb-3<?= !empty($error) && count($error[4]) != 0 ? ' has-error' : '';  ?>">

			<label for="transport" class="mb-0">Frais de transport</label>

			<input type="number" name="transport" id="transport" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("transport") ?: $commande->transport; ?>" placeholder="Entrez le montant du transport" />

		<?= !empty($error[4]) 
			? '<span class="help-block mt-1">' . $error[4] . '</span>' 
			: '<small class="text-muted">Entrez le montant des frais liés au transport de la commande.</small>'; 
		?>

		</div>
		


		<a href="<?= WURI . '?r=' . $m[1] . '/edition/etape-1/' . $ID . '/'; ?>" class="btn btn-sm btn-primary p-btn-primary-outline mt-4 mb-3">Précédent</a>

		<button type="submit" name="steptwosubmit" class="btn btn-sm btn-primary p-btn-primary mt-4 mb-3 float-right">Suivant</button>

	</form>

</div>