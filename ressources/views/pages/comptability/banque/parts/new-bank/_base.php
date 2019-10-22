<div class="p-portlet rounded">

	<?php #	En-tête ?>
	<div class="p-portlet-head">
		
		<div class="p-portlet-head-label"><h3>Ajouter un nouveau compte</h3></div>

	</div>


	<?php #	Contenu ?>
	<div class="p-portlet-body">

		<form action="" method="post" class="p-form-table">
			
			<div class="form-row">
				
				<div class="form-group col-12 col-md-12 col-lg-7 mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

					<label for="bank_name" class="mb-0">Dénomination&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

					<input type="text" name="bank_name" id="bank_name" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("bank_name"); ?>" placeholder="Entrez le nom de la banque" autofocus autocomplete="off" required />

				<?= !empty($error[1]) 
					? '<span class="help-block mt-1">' . $error[1] . '</span>' 
					: '<small class="text-muted">Entrez le nom de votre BANQUE.</small>'; 
				?>

				</div>
				
				<div class="form-group col-12 col-md-12 col-lg-5 mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

					<label for="bank_number" class="mb-0">Numéro de compte</label>

					<input type="number" name="bank_number" id="bank_number" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("bank_number"); ?>" placeholder="Entrez le numéro de compte" autocomplete="off" />

				<?= !empty($error[2]) 
					? '<span class="help-block mt-1">' . $error[2] . '</span>' 
					: '<small class="text-muted">Entrez votre numéro de compte (9 chiffres ou plus).</small>'; 
				?>

				</div>

			</div>
			
			<div class="form-group mb-3<?= !empty($error) && count($error[3]) != 0 ? ' has-error' : '';  ?>">

				<label for="account_manager" class="mb-0">Gestionaire&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="text" name="account_manager" id="account_manager" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("account_manager"); ?>" placeholder="Entrez le nom du gestionnaire" required />

			<?= !empty($error[3]) 
				? '<span class="help-block mt-1">' . $error[3] . '</span>' 
				: '<small class="text-muted">Entrez le nom de votre gestionnaire en banque.</small>'; 
			?>

			</div>
			
			<div class="form-row">
				
				<div class="form-group col-12 col-md-12 col-lg-6 mb-3<?= !empty($error) && count($error[4]) != 0 ? ' has-error' : '';  ?>">

					<label for="am_phone" class="mb-0">Contacts&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

					<input type="number" name="am_phone" id="am_phone" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("am_phone"); ?>" placeholder="Entrez le numéro de téléphone" autocomplete="off" required />

				<?= !empty($error[4]) 
					? '<span class="help-block mt-1">' . $error[4] . '</span>' 
					: '<small class="text-muted">Entrez le numéro de téléphone de votre gestionnaire.</small>'; 
				?>

				</div>
				
				<div class="form-group col-12 col-md-12 col-lg-6 mb-3<?= !empty($error) && count($error[5]) != 0 ? ' has-error' : '';  ?>">

					<label for="am_mail" class="mb-0"></label>

					<input type="email" name="am_mail" id="am_mail" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("am_mail"); ?>" placeholder="Entrez l'adresse e-mail" autocomplete="off" />

				<?= !empty($error[5]) 
					? '<span class="help-block mt-1">' . $error[5] . '</span>' 
					: '<small class="text-muted">Entrez l\'adresse e-mail de votre gestionnaire.</small>'; 
				?>

				</div>

			</div>


			<button type="submit" name="bankbasesubmit" class="btn btn-sm btn-primary p-btn-primary mb-3 mr-1 p-pill-submit">Ajouter</button>

		</form>

	</div>
	
</div>		