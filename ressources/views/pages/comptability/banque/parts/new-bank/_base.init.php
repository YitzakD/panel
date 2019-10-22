<div class="p-portlet rounded">

	<?php #	En-tête ?>
	<div class="p-portlet-head">
		
		<div class="p-portlet-head-label"><h3>Initialisation du compte</h3></div>

	</div>


	<?php #	Contenu ?>
	<div class="p-portlet-body">

		<form action="" method="post" class="p-form-table">
			
			<div class="form-group mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

				<label for="acc_sold" class="mb-0">Solde&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="number" name="acc_sold" id="acc_sold" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("acc_sold"); ?>" placeholder="Entrez le solde du compte" required />

			<?= !empty($error[1]) 
				? '<span class="help-block mt-1">' . $error[1] . '</span>' 
				: '<small class="text-muted">Entrez le solde de votre compte afin d\'initialiser le système de rapprochement.</small>'; 
			?>

			</div>


			<button type="submit" name="accountbasesubmit" class="btn btn-sm btn-primary p-btn-primary mb-3 mr-1 p-pill-submit">Initialiser</button>


		</form>	

	</div>
	
</div>