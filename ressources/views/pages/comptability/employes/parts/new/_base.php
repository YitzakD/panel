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
			
			<div class="form-group mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

				<label for="emp_names" class="mb-0">Nom et prénom(s)&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="text" name="emp_names" id="emp_names" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("emp_names"); ?>" placeholder="Entrez les nom et prénoms" autofocus required />

			<?= !empty($error[1]) 
				? '<span class="help-block mt-1">' . $error[1] . '</span>' 
				: '<small class="text-muted">Entrez les nom et prénoms de l\'employé.</small>'; 
			?>

			</div>

			<div class="form-group mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

				<label for="add_phone" class="mb-0">Téléphone&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="number" name="add_phone" id="add_phone" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("add_phone"); ?>" placeholder="Entrez le numéro de téléphone" required />

			<?= !empty($error[2]) 
				? '<span class="help-block mt-1">' . $error[2] . '</span>' 
				: '<small class="text-muted">Entrez le numéro de téléphone de l\'employé.</small>'; 
			?>

			</div>

			<div class="form-group mb-3<?= !empty($error) && count($error[3]) != 0 ? ' has-error' : '';  ?>">

				<label for="dev_mail" class="mb-0">Adresse E-mail&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="email" name="dev_mail" id="dev_mail" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("dev_mail"); ?>" placeholder="Entrez l'adresse e-mail de l'employé" required />

			<?= !empty($error[3]) 
				? '<span class="help-block mt-1">' . $error[3] . '</span>' 
				: '<small class="text-muted">Entrez l\'adresse e-mail de l\'employé.</small>'; 
			?>

			</div>


			<button type="submit" name="newsubmit" class="btn btn-sm btn-primary p-btn-primary mb-3 mr-1">Ajouter</button>

		</form>

	</div>

</div>