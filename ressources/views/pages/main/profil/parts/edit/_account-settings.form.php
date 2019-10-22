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
				
			<div class="form-group mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

				<label for="upassword" class="mb-0">Mot de passe</label>

				<input type="password" name="upassword" id="upassword" class="form-control p-form-ctrl p-form-ctrl-sm"  placeholder="Entrez le mot de passe" autocomplete="off" />

			<?= !empty($error[1]) 
				? '<span class="help-block mt-1">' . $error[1] . '</span>' 
				: '<small class="text-muted">Modifiez votre mot de passe.</small>'; 
			?>

			</div>


			<button type="submit" name="profilcomptesubmit" class="btn btn-sm btn-primary p-btn-primary mb-3 mr-1 p-pill-submit">Editer</button>

		</form>
		
	</div>

</div>