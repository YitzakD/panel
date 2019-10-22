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

		<a class="p-wizard-nav-item" href="<?= WURI . '?r=' . $m[1] . '/edition/etape-3/' . $ID . '/'; ?>" data-pwizard-state="current">
			
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

	<h3 class="h5 pt-4 pb-4 text-muted">Tarification</h3>

	<form action="" method="post" class="p-form-table">

	    <div class="form-group mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

	     	<label for="one_ht_price">Prix HT / Panneau</label>

     		<input type="number" name="one_ht_price" id="one_ht_price" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("one_ht_price") ?: $proforma->one_ht_price; ?>" placeholder="Entrez le prix HT" autofocus />	

		<?= !empty($error[1]) 
			? '<span class="help-block mt-1">' . $error[1] . '</span>' 
			: '<small class="text-muted">Entrez le prix Hors Taxe par panneau.</small>';
		?>

	    </div>

		<div class="form-row">

		    <div class="form-group col-md-6 mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

		     	<label for="sb_count">Total de panneaux&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>
		      
		     	<input type="number" name="sb_count" id="sb_count" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= $proforma->sb_count; ?>" placeholder="Entrez le nombre de panneaux" required />

			<?= !empty($error[2]) 
				? '<span class="help-block mt-1">' . $error[2] . '</span>' 
				: '<small class="text-muted">Entrez le nombre total de panneaux.</small>'; 
			?>

		    </div>

		    <div class="form-group col-md-6 mb-3<?= !empty($error) && count($error[3]) != 0 ? ' has-error' : '';  ?>">

		     	<label for="sb_p_count">Total au Plateau</label>

		     	<input type="number" name="sb_p_count" id="sb_p_count" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("sb_p_count") ?: $proforma->sb_p_count; ?>" placeholder="Entrez le nombre de panneaux" />

			<?= !empty($error[3]) 
				? '<span class="help-block mt-1">' . $error[3] . '</span>' 
				: '<small class="text-muted">Entrez le nombre total de panneaux figurant au Plateau.</small>';
			?>

		    </div>

		</div>

		<h3 class="h5 pt-4 pb-4 text-muted">Remise consentit</h3>

		<div class="form-row">

		    <div class="form-group col-md-6 mb-3<?= !empty($error) && count($error[4]) != 0 ? ' has-error' : '';  ?>">

		     	<label for="remised">Faire une remise</label>

				<select name="remised" class="form-control p-form-ctrl p-form-ctrl-sm">

	                <option value="Oui" <?= $proforma->remised === "Oui" ? "selected" : ""; ?>>Oui</option>

	                <option value="Non" <?= $proforma->remised === "Non" ? "selected" : ""; ?>>Non</option>

				</select>

			<?= !empty($error[4]) 
				? '<span class="help-block mt-1">' . $error[4] . '</span>' 
				: '<small class="text-muted">Confirmez si vous faites une remise.</small>'; 
			?>

		    </div>

		    <div class="form-group col-md-6 mb-3<?= !empty($error) && count($error[5]) != 0 ? ' has-error' : '';  ?>">

		     	<label for="one_stoped_price">Nouveau HT / Panneau après remise</label>

		     	<input type="number" name="one_stoped_price" id="one_stoped_price" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("one_stoped_price") ?: $proforma->one_stoped_price; ?>" placeholder="Entrez le nombre de panneaux" />

			<?= !empty($error[5]) 
				? '<span class="help-block mt-1">' . $error[5] . '</span>' 
				: '<small class="text-muted">Entrez le nouveau montant HT décidé si remise il y a.</small>';
			?>

		    </div>

		</div>

	    <div class="form-group mb-3<?= !empty($error) && count($error[6]) != 0 ? ' has-error' : '';  ?>">

	     	<label for="agency_remised">Commission agence ?</label>

			<select name="agency_remised" class="form-control p-form-ctrl p-form-ctrl-sm">

                <option value="Non" <?= $proforma->agency_remised === "Non" ? "selected" : ""; ?>>Non</option>

                <option value="Oui" <?= $proforma->agency_remised === "Oui" ? "selected" : ""; ?>>Oui</option>

			</select>	

		<?= !empty($error[6]) 
			? '<span class="help-block mt-1">' . $error[6] . '</span>' 
			: '<small class="text-muted">Confirmez qu\'il y a bien une commission d\'agence.</small>';
		?>

	    </div>
		


		<a href="<?= WURI . '?r=' . $m[1] . '/edition/etape-2/' . $ID . '/'; ?>" class="btn btn-sm btn-primary p-btn-primary-outline mt-4 mb-3">Précédent</a>

		<button type="submit" name="stepthreesubmit" class="btn btn-sm btn-primary p-btn-primary mt-4 mb-3 float-right">Suivant</button>

	</form>

</div>