<div class="p-portlet-wizard-nav">
		
	<div class="p-wizard-nav-line"></div>

	<div class="p-wizard-nav-items">

		<a class="p-wizard-nav-item" href data-pwizard-state="current">
			
			<span>1</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Création</div>

		</a>

		<a class="p-wizard-nav-item" href data-pwizard-state="pendding">
				
			<span>2</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Durée</div>

		</a>

		<a class="p-wizard-nav-item" href data-pwizard-state="pendding">
			
			<span>3</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Choix de panneaux</div>

		</a>

		<a class="p-wizard-nav-item" href data-pwizard-state="pendding">
			
			<span>4</span>
			<span class="p-wizard-nav-item-icon"><i class="fas fa-check p-wizard-icon"></i></span>
			<div class="p-wizard-nav-item-label">Finalisation</div>

		</a>

	</div>

</div>

<div class="p-portlet-wizard-form">

	<h3 class="h5 pt-4 pb-4 text-muted">Création</h3>

	<form action="" method="post" class="p-form-table">

		<div class="form-row">

			<div class="form-group col-md-5 mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

				<label for="client_id" class="mb-0">Client</label>

				<?php $clients = find_all("clients"); ?>

				<select name="client_id" class="form-control p-form-ctrl p-form-ctrl-sm" disabled>

				<?php foreach($clients as $item): ?>

	            	<option value="<?= $item->id ?>" <?= $reservation->client_id === $item->id ? "selected" : ""; ?>><?= $item->e_name; ?></option>

	            <?php endforeach; ?>

				</select>

			</div>

			<div class="form-group col-md-7 mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

				<label for="camp_name" class="mb-0">Libellé de la réservation&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="text" name="camp_name" id="camp_name" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("camp_name") ?: $reservation->camp_name; ?>" placeholder="Entrez le libellé" autofocus required />

			<?= !empty($error[2]) 
				? '<span class="help-block mt-1">' . $error[2] . '</span>' 
				: '<small class="text-muted">Entrez le nom de la réservation.</small>'; 
			?>

			</div>

		</div>


		<button type="submit" name="steponesubmit" class="btn btn-sm btn-primary p-btn-primary mt-4 mb-3 float-right">Suivant</button>

	</form>

</div>