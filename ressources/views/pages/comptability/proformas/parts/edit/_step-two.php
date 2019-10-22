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
			<div class="p-wizard-nav-item-label">Tarif</div>

		</a>

		<a class="p-wizard-nav-item" href data-pwizard-state="pendding">
			
			<span>4</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Transport</div>

		</a>

		<a class="p-wizard-nav-item" href data-pwizard-state="pendding">
			
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

	<h3 class="h5 pt-4 pb-4 text-muted">Durée de la campagne</h3>

	<form action="" method="post" class="p-form-table">

		<div class="form-row">

		    <div class="form-group col-md-4 mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

		     	<label for="numeric_time">Durée (en chiffre)</label>
		      
		     	<input type="text" name="numeric_time" id="numeric_time" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= $proforma->numeric_time . ' Jours'; ?>" placeholder="Entrez la durée en chiffre" disabled />

			<?= !empty($error[1]) 
				? '<span class="help-block mt-1">' . $error[1] . '</span>' 
				: '<small class="text-muted">La durée en chiffre est calculer automatiquement.</small>'; 
			?>

		    </div>

		    <div class="form-group col-md-8 mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

		     	<label for="letter_time">Durée (en lettre)&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

		     	<div class="input-group">

		     		<input type="text" name="letter_time" id="letter_time" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("letter_time") ?: $proforma->letter_time; ?>" placeholder="Entrez la durée en toute lettre" autofocus required />
				
					<span class="input-group-addon rounded-right">Jours</span>

		     	</div>	

			<?= !empty($error[2]) 
				? '<span class="help-block mt-1">' . $error[2] . '</span>' 
				: '<small class="text-muted">Entrez en toute lettre le nombre qui apparaît dans la case précédente.</small>';
			?>

		    </div>

		</div>
		


		<a href="<?= WURI . '?r=' . $m[1] . '/edition/etape-1/' . $ID . '/'; ?>" class="btn btn-sm btn-primary p-btn-primary-outline mt-4 mb-3">Précédent</a>

		<button type="submit" name="steptwosubmit" class="btn btn-sm btn-primary p-btn-primary mt-4 mb-3 float-right">Suivant</button>

	</form>

</div>