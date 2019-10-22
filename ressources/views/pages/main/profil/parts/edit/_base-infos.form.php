<div class="p-portlet rounded">

	<?php #	En-tête ?>
	<div class="p-portlet-head">
		
		<div class="p-portlet-head-label"><h3>Informations de base</h3></div>

	</div>


	<?php #	Contenu ?>
	<div class="p-portlet-body">

		<form action="" method="post" class="p-form-table">
			
			<div class="form-row">

				<div class="form-group col-12 col-md-12 col-lg-6  mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

					<label for="pseudo" class="mb-0">Identifiant / Pseudonyme&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

					<input type="text" name="pseudo" id="pseudo" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("pseudo") ?: $userinfo->pseudo; ?>" placeholder="Entrez l'identiant" autofocus autocomplete="off" required />

				<?= !empty($error[1]) 
					? '<span class="help-block mt-1">' . $error[1] . '</span>' 
					: '<small class="text-muted">Modifiez votre identifiant.</small>'; 
				?>

				</div>

				<div class="form-group col-12 col-md-12 col-lg-6 mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

					<label for="email" class="mb-0">Adresse E-mail&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

					<input type="email" name="email" id="email" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("email") ?: $userinfo->email; ?>" placeholder="Entrez l'adresse e-mail" autocomplete="off" required />

				<?= !empty($error[2]) 
					? '<span class="help-block mt-1">' . $error[2] . '</span>' 
					: '<small class="text-muted">Modifiez votre adresse E-mail.</small>';
				?>

				</div>

			</div>	


			<button type="submit" name="profilbasesubmit" class="btn btn-sm btn-primary p-btn-primary mb-3 mr-1 p-pill-submit">Editer</button>

		</form>

	</div>

</div>