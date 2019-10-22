<div class="p-portlet rounded">

	<?php #	En-tête ?>
	<div class="p-portlet-head">
		
		<div class="p-portlet-head-label">
			<h3>Informations de base</h3>
		</div>

	</div>


	<?php #	Contenu ?>
	<div class="p-portlet-body">
		
		<form action="" method="post" class="p-form-table">

			<div class="form-row">
				
				<div class="form-group col-12 col-md-12 col-lg-6 mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">
					
					<label for="pseudo" class="mb-0">Pseudonyme&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

					<input type="text" name="pseudo" id="pseudo" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("pseudo"); ?>" placeholder="Entrez le pseudonyme" autofocus autocomplete="off" required />

				<?= !empty($error[1]) 
					? '<span class="help-block mt-1">' . $error[1] . '</span>' 
					: '<small class="text-muted">Entrez le pseudonyme de l\'utilisateur.</small>'; 
				?>

				</div>
				
				<div class="form-group col-12 col-md-12 col-lg-6 mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">
					
					<label for="email" class="mb-0">E-mail&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

					<input type="email" name="email" id="email" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("email"); ?>" placeholder="Entrez l'adresse e-mail" autocomplete="off" required />

				<?= !empty($error[2]) 
					? '<span class="help-block mt-1">' . $error[2] . '</span>' 
					: '<small class="text-muted">Entrez l\'adressee-mail de l\'utilisateur.</small>'; 
				?>

				</div>

			</div>
			
			<div class="form-group mb-3<?= !empty($error) && count($error[3]) != 0 ? ' has-error' : '';  ?>">

				<label for="password" class="mb-0">Mot de passe&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="password" name="password" id="password" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("password"); ?>" placeholder="Entrez le mot de passe" autocomplete="off" required />

			<?= !empty($error[3]) 
				? '<span class="help-block mt-1">' . $error[3] . '</span>' 
				: '<small class="text-muted">Entrez le mot de passe de l\'utilisateur.</small>'; 
			?>

			</div>

			<div class="form-row">
				
				<div class="form-group col-12 col-md-12 col-lg-6 mb-3<?= !empty($error) && count($error[4]) != 0 ? ' has-error' : '';  ?>">

					<label for="utid" class="mb-0">Rôle admin</label>

					<select name="utid" id="utid" class="form-control p-form-ctrl p-form-ctrl-sm">
						
					<?php $types = find_all("utypes"); ?>

					<?php foreach($types as $item): ?>
						
						<option value="<?= $item->id ?>"><?= $item->utype_name; ?></option>

					<?php endforeach; ?>

					</select>

				<?= !empty($error[4]) 
					? '<span class="help-block mt-1">' . $error[4] . '</span>' 
					: '<small class="text-muted">Choisissez le type d\'accès de l\'utilisateur.</small>'; 
				?>

				</div>
				
				<div class="form-group col-12 col-md-12 col-lg-6 mb-3<?= !empty($error) && count($error[5]) != 0 ? ' has-error' : '';  ?>">

					<label for="active" class="mb-0">Etat du compte</label>

					<select name="active" id="active" class="form-control p-form-ctrl p-form-ctrl-sm">
						
						<option value="0">Compte désactivé</option>

						<option value="1">Compte actif</option>		

					</select>

				<?= !empty($error[5]) 
					? '<span class="help-block mt-1">' . $error[5] . '</span>' 
					: '<small class="text-muted">Choisissez l\'etat du compte de l\'utilisateur.</small>'; 
				?>

				</div>
				
			</div>


			<button type="submit" name="newsubmit" class="btn btn-sm btn-primary p-btn-primary mb-3 mr-1">Ajouter</button>

		</form>

	</div>

</div>