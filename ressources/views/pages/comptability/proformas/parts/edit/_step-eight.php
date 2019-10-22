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

		<a class="p-wizard-nav-item" href="<?= WURI . '?r=' . $m[1] . '/edition/etape-5/' . $ID . '/'; ?>" data-pwizard-state="done">
			
			<span>5</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Taxe Alcool</div>

		</a>

		<a class="p-wizard-nav-item" href="<?= WURI . '?r=' . $m[1] . '/edition/etape-6/' . $ID . '/'; ?>" data-pwizard-state="done">
			
			<span>6</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">ODP / TM</div>

		</a>

		<a class="p-wizard-nav-item" href="<?= WURI . '?r=' . $m[1] . '/edition/etape-7/' . $ID . '/'; ?>" data-pwizard-state="done">
			
			<span>7</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">TVA / TSP</div>

		</a>

		<a class="p-wizard-nav-item" href data-pwizard-state="current">
			
			<span>8</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Finalisation</div>

		</a>

	</div>

</div>

<div class="p-portlet-wizard-form">

	<h3 class="h5 pt-4 pb-4 text-muted">Finalisation</h3>

	<form action="" method="post" class="p-form-table">

	    <div class="form-group mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

	     	<label for="numeric_ttc_price">TTC (en chiffre)</label>

	     	<input type="text" name="numeric_ttc_price" id="numeric_ttc_price" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= number_format($proforma->numeric_ttc_price, 0, '', ' ') . ' Fcfa'; ?>" placeholder="Entrez le montant TTC en chiffre" disabled />

		<?= !empty($error[1]) 
			? '<span class="help-block mt-1">' . $error[1] . '</span>' 
			: '<small class="text-muted">Le montant TTC en chiffre est calculer automatiquement.</small>';
		?>

	    </div>

		<div class="form-group mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

	     	<label for="numeric_ttc_price">TTC (en lettre)&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

	     	<textarea name="letter_ttc_price" class="form-control p-form-ctrl p-form-ctrl-sm" placeholder="Entrez le descriptif de la commande" autofocus required><?= get_input("letter_ttc_price") ?: $proforma->letter_ttc_price; ?></textarea>

		<?= !empty($error[2]) 
			? '<span class="help-block mt-1">' . $error[2] . '</span>' 
			: '<small class="text-muted">Le montant TTC en chiffre est calculer automatiquement.</small>';
		?>

	    </div>
		


		<a href="<?= WURI . '?r=' . $m[1] . '/edition/etape-7/' . $ID . '/'; ?>" class="btn btn-sm btn-primary p-btn-primary-outline mt-4 mb-3">Précédent</a>

		<button type="submit" name="stepeightsubmit" class="btn btn-sm btn-primary p-btn-primary mt-4 mb-3 float-right">Suivant</button>

	</form>

</div>