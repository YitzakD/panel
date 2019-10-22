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
			<div class="p-wizard-nav-item-label">Détails</div>

		</a>

		<a class="p-wizard-nav-item" href="<?= WURI . '?r=' . $m[1] . '/edition/etape-3/' . $ID . '/'; ?>" data-pwizard-state="done">
			
			<span>3</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Taxes</div>

		</a>

		<a class="p-wizard-nav-item" href data-pwizard-state="current">
			
			<span>4</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Finalisation</div>

		</a>

	</div>

</div>

<div class="p-portlet-wizard-form">

	<h3 class="h5 pt-4 pb-4 text-muted">Taxes d'Etat</h3>

	<form action="" method="post" class="p-form-table">

		<div class="form-row">

			<div class="form-group col-md-6 mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

				<label for="tva" class="mb-0">TVA&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="number" name="tva" id="tva" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("tva") ?: $commande->tva; ?>" placeholder="Entrez le montant de la TVA" required />

			<?= !empty($error[1]) 
				? '<span class="help-block mt-1">' . $error[1] . '</span>' 
				: '<small class="text-muted">Entrez le montant de la Taxe sur la Valeur Ajoutée de la commande.</small>'; 
			?>

			</div>

			<div class="form-group col-md-6 mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

				<label for="tsp" class="mb-0">TSP&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="number" name="tsp" id="tsp" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("tsp") ?: $commande->tsp; ?>" placeholder="Entrez le montant de la TSP" required />

			<?= !empty($error[2]) 
				? '<span class="help-block mt-1">' . $error[2] . '</span>' 
				: '<small class="text-muted">Entrez le montant de la Taxe Sur la Publicité de la commande.</small>'; 
			?>

			</div>

		</div>

		<div class="form-group mb-3<?= !empty($error) && count($error[3]) != 0 ? ' has-error' : '';  ?>">

			<label for="ttc" class="mb-0">TTC&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

			<input type="number" name="ttc" id="ttc" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("ttc") ?: $commande->ttc; ?>" placeholder="Entrez le montant TTC" required />

		<?= !empty($error[3]) 
			? '<span class="help-block mt-1">' . $error[3] . '</span>' 
			: '<small class="text-muted">Entrez le montant de Toute Taxe Confondue de la commande.</small>'; 
		?>

		</div>
		


		<a href="<?= WURI . '?r=' . $m[1] . '/edition/etape-3/' . $ID . '/'; ?>" class="btn btn-sm btn-primary p-btn-primary-outline mt-4 mb-3">Précédent</a>

		<button type="submit" name="stepfoursubmit" class="btn btn-sm btn-primary p-btn-primary mt-4 mb-3 float-right">Suivant</button>

	</form>

</div>