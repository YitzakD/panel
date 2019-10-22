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

				<label for="size" class="mb-0">Dénomination&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<div class="input-group">
					
					<input type="number" name="size" id="size" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("size"); ?>" placeholder="Entrez le format" autofocus required />
				
					<span class="input-group-addon rounded-right font-weight-bold">m²</span>

				</div>

			<?= !empty($error[1]) 
				? '<span class="help-block mt-1">' . $error[1] . '</span>' 
				: '<small class="text-muted">Entrez un format de panneau.</small>'; 
			?>

			</div>


			<button type="submit" name="newsubmit" class="btn btn-sm btn-primary p-btn-primary mb-3 mr-1">Ajouter</button>

		</form>

	</div>

</div>
