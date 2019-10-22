<div class="p-portlet rounded">
	
	<div class="d-block p-4">
		
		<form action="" method="post" class="p-form-table">

			<div class="form-group mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

				<label for="typeof" class="mb-0">Type</label>

				<select name="typeof" class="form-control p-form-ctrl p-form-ctrl-sm">
					
					<option value="2">Débit</option>

					<option value="1">Crédit</option>
				
				</select>

			<?= !empty($error[1]) ? '<span class="help-block mt-1">' . $error[1] . '</span>' : ''; ?>

			</div>
					
			<div class="form-group mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

				<label for="amount" class="mb-0">Montant&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="number" name="amount" id="amount" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("amount"); ?>" placeholder="Entrez le montant" autocomplete="off" autofocus required />

			<?= !empty($error[2]) 
				? '<span class="help-block mt-1">' . $error[2] . '</span>' 
				: '<small class="text-muted">Entrez le montant de la transaction.</small>'; 
			?>

			</div>
				
			<div class="form-group mb-3<?= !empty($error) && count($error[3]) != 0 ? ' has-error' : '';  ?>">

				<label for="about" class="mb-0">Description&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<textarea name="about" class="form-control p-form-ctrl p-form-ctrl-sm" placeholder="Entrez les informations" required><?= get_input("about"); ?></textarea>

			<?= !empty($error[3]) 
				? '<span class="help-block mt-1">' . $error[3] . '</span>' 
				: '<small class="text-muted">Entrez les informations complémentaires sur la transaction.</small>'; 
			?>

			</div>


			<button type="submit" name="bankmoovsubmit" class="btn btn-sm btn-primary p-btn-primary p-pill-submit">Déclarer</button>

		</form>

	</div>

</div>