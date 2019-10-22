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
			<div class="p-wizard-nav-item-label">Durée</div>

		</a>

		<a class="p-wizard-nav-item" href="<?= WURI . '?r=' . $m[1] . '/edition/etape-3/' . $ID . '/'; ?>" data-pwizard-state="done">
			
			<span>3</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Tarif</div>

		</a>

		<a class="p-wizard-nav-item" href="<?= WURI . '?r=' . $m[1] . '/edition/etape-4/' . $ID . '/'; ?>" data-pwizard-state="done">
			
			<span>4</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Transport</div>

		</a>

		<a class="p-wizard-nav-item" href data-pwizard-state="current">
			
			<span>5</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Taxe Alcool</div>

		</a>

		<a class="p-wizard-nav-item" href data-pwizard-state="pendding">
			
			<span>6</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">ODP / TM</div>

		</a>

		<a class="p-wizard-nav-item" href data-pwizard-state="pendding">
			
			<span>7</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">TVA / TSP</div>

		</a>

		<a class="p-wizard-nav-item" href data-pwizard-state="pendding">
			
			<span>8</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Finalisation</div>

		</a>

	</div>

</div>

<div class="p-portlet-wizard-form">

	<h3 class="h5 pt-4 pb-4 text-muted">Taxe Alcool</h3>

	<form action="" method="post" class="p-form-table">

	    <div class="form-group mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

	     	<label for="alcool_type">TM spéciale Alcool
	     		<small class="d-block text-muted">Permet de calculer la taxe liée à la pbulicité faite aux boissons alcoolisées</small>
	     	</label>

			<select name="alcool_type" class="form-control p-form-ctrl p-form-ctrl-sm">

                <option value="Non" <?= $proforma->alcool_type === "Non" ? "selected" : ""; ?>>Non</option>

                <option value="Oui" <?= $proforma->alcool_type === "Oui" ? "selected" : ""; ?>>Oui</option>

			</select>

		<?= !empty($error[1]) 
			? '<span class="help-block mt-1">' . $error[1] . '</span>' 
			: '<small class="text-muted">Confimez ou infirmez la Taxe Mucipale relative à la publicité faite aux boissons alcoolisées.</small>';
		?>

	    </div>
		


		<a href="<?= WURI . '?r=' . $m[1] . '/edition/etape-4/' . $ID . '/'; ?>" class="btn btn-sm btn-primary p-btn-primary-outline mt-4 mb-3">Précédent</a>

		<button type="submit" name="stepfivesubmit" class="btn btn-sm btn-primary p-btn-primary mt-4 mb-3 float-right">Suivant</button>

	</form>

</div>