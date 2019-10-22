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

		<a class="p-wizard-nav-item" href data-pwizard-state="current">
			
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

	<h3 class="h5 pt-4 pb-4 text-muted">Taxes municipales</h3>

	<form action="" method="post" class="p-form-table">

		<div class="form-row">

			<div class="form-group col-md-6 mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

				<label for="odp" class="mb-0">ODP&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="number" name="odp" id="odp" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("odp") ?: $commande->odp; ?>" placeholder="Entrez le montant de l'ODP" autofocus required />

			<?= !empty($error[1]) 
				? '<span class="help-block mt-1">' . $error[1] . '</span>' 
				: '<small class="text-muted">Entrez le montant relatif à l\'Occupation du Domaine Publique.</small>'; 
			?>

			</div>

			<div class="form-group col-md-6 mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

				<label for="tm" class="mb-0">TM&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="number" name="tm" id="tm" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("tm") ?: $commande->tm; ?>" placeholder="Entrez le prix unitaire" required />

			<?= !empty($error[2]) 
				? '<span class="help-block mt-1">' . $error[2] . '</span>' 
				: '<small class="text-muted">Entrez le montant relatif à la Taxe Municiaple.</small>'; 
			?>

			</div>

		</div>

		<h3 class="h5 pt-4 pb-4 text-muted">Autres taxes</h3>

		<div class="form-group mb-3<?= !empty($error) && count($error[3]) != 0 ? ' has-error' : '';  ?>">

			<label for="ht" class="mb-0">Autre taxe ?</label>

			<select name="other_tax" class="form-control p-form-ctrl p-form-ctrl-sm">

                <option value="Non" <?= $commande->other_tax === "non" ? "selected" : ""; ?>>Non</option>

                <option value="Oui" <?= $commande->other_tax === "Oui" ? "selected" : ""; ?>>Oui</option>

			</select>

		<?= !empty($error[3]) 
			? '<span class="help-block mt-1">' . $error[3] . '</span>' 
			: '<small class="text-muted">Confirmmez l\'existence d\'une autre taxe.</small>'; 
		?>

		</div>

		<div class="form-group mb-3<?= !empty($error) && count($error[4]) != 0 ? ' has-error' : '';  ?>">

			<label for="other_tax_name" class="mb-0">Nom de la taxe aditionnelle</label>

			<input type="text" name="other_tax_name" id="other_tax_amount" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("other_tax_name") ?: $commande->other_tax_name; ?>" placeholder="Entrez le nom de la taxe" />

		<?= !empty($error[4]) 
			? '<span class="help-block mt-1">' . $error[4] . '</span>' 
			: '<small class="text-muted">Entrez le nom de la taxe aditionnelle en agrégé.</small>'; 
		?>

		</div>

		<div class="form-group mb-3<?= !empty($error) && count($error[5]) != 0 ? ' has-error' : '';  ?>">

			<label for="other_tax_amount" class="mb-0">Montant de la taxe aditionnelle</label>

			<input type="number" name="other_tax_amount" id="other_tax_amount" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("other_tax_amount") ?: $commande->other_tax_amount; ?>" placeholder="Entrez le montant de la taxe" />

		<?= !empty($error[5]) 
			? '<span class="help-block mt-1">' . $error[5] . '</span>' 
			: '<small class="text-muted">Entrez le montant de la taxe aditionnelle.</small>'; 
		?>

		</div>
		


		<a href="<?= WURI . '?r=' . $m[1] . '/edition/etape-2/' . $ID . '/'; ?>" class="btn btn-sm btn-primary p-btn-primary-outline mt-4 mb-3">Précédent</a>

		<button type="submit" name="stepthreesubmit" class="btn btn-sm btn-primary p-btn-primary mt-4 mb-3 float-right">Suivant</button>

	</form>

</div>