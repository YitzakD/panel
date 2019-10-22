<div class="p-portlet rounded">

	<?php #	En-tête ?>
	<div class="p-portlet-head">
		
		<div class="p-portlet-head-label">
			<h3>Paramêtres de compte</h3>
		</div>

	</div>


	<?php #	Contenu ?>
	<div class="p-portlet-body">

		<form action="" method="post" class="p-form-table">
			
			<div class="form-row">
				
				<div class="form-group col-12 col-md-12 col-lg-6 mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

					<label for="utid" class="mb-0">Rôle admin</label>

					<select name="utid" id="utid" class="form-control p-form-ctrl p-form-ctrl-sm">
						
					<?php $types = find_all("utypes"); ?>

					<?php foreach($types as $item): ?>
						
						<option value="<?= $item->id ?>" <?= $item->id === $utilisateur->utid ? "selected" : ""; ?>><?= $item->utype_name; ?></option>

					<?php endforeach; ?>

					</select>

				<?= !empty($error[1]) 
					? '<span class="help-block mt-1">' . $error[1] . '</span>' 
					: '<small class="text-muted">Modifiez le type d\'accès de ' . $utilisateur->pseudo . '.</small>'; 
				?>

				</div>
				
				<div class="form-group col-12 col-md-12 col-lg-6 mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

					<label for="active" class="mb-0">Compte</label>

					<select name="active" id="active" class="form-control p-form-ctrl p-form-ctrl-sm">
						
						<option value="0" <?= $utilisateur->active === "0" ? "selected" : ""; ?>>Désactivé</option>

						<option value="1" <?= $utilisateur->active === "1" ? "selected" : ""; ?>>Actif</option>		

					</select>

				<?= !empty($error[2]) 
					? '<span class="help-block mt-1">' . $error[2] . '</span>' 
					: '<small class="text-muted">Modifiez l\'etat du compte de ' . $utilisateur->pseudo . '.</small>'; 
				?>

				</div>

			</div>


			<button type="submit" name="comptesubmit" class="btn btn-sm btn-primary p-btn-primary mb-3 mr-1 p-pill-submit">Editer</button>

		</form>
		
	</div>

</div>