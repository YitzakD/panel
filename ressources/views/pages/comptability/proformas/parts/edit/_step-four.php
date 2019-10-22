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

		<a class="p-wizard-nav-item" href data-pwizard-state="current">
			
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

	<h3 class="h5 pt-4 pb-4 text-muted">Frais de transport</h3>

	<form action="" method="post" class="p-form-table">

	    <div class="form-group mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

	     	<label for="int_city_count">Total de ville hors Abidjan
	     		<small class="d-block text-muted">Permet de calculer les frais de transport liés au déplacement à l'intérieur du pays</small>
	     	</label>

     		<input type="number" name="int_city_count" id="int_city_count" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("int_city_count") ?: $proforma->int_city_count; ?>" placeholder="Entrez le prix HT" autofocus />	

		<?= !empty($error[1]) 
			? '<span class="help-block mt-1">' . $error[1] . '</span>' 
			: '<small class="text-muted">Entrez le total de villes ou votre equipe se deplacera hors d\'Abidjan pour la campagne.</small>';
		?>

	    </div>
		


		<a href="<?= WURI . '?r=' . $m[1] . '/edition/etape-3/' . $ID . '/'; ?>" class="btn btn-sm btn-primary p-btn-primary-outline mt-4 mb-3">Précédent</a>

		<button type="submit" name="stepfoursubmit" class="btn btn-sm btn-primary p-btn-primary mt-4 mb-3 float-right">Suivant</button>

	</form>

</div>