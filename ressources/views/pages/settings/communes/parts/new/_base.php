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

				<label for="communetitle" class="mb-0">Dénomination&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="text" name="communetitle" id="communetitle" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("communetitle"); ?>" placeholder="Entrez le nom" autofocus required />

			<?= !empty($error[1]) 
				? '<span class="help-block mt-1">' . $error[1] . '</span>' 
				: '<small class="text-muted">Entrez le nom de la commune.</small>'; 
			?>

			</div>

			<div class="form-group mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

				<label for="vid" class="mb-0">Ville d'appartenance</label>

				<select name="vid" class="form-control p-form-ctrl p-form-ctrl-sm">

					<?php foreach($villes as $item): ?>
					
					<option value="<?= $item->id ?>"><?= $item->city_title; ?></option>	

					<?php endforeach; ?>

				</select>

			<?= !empty($error[2]) 
				? '<span class="help-block mt-1">' . $error[2] . '</span>' 
				: '<small class="text-muted">Choisissez la ville d\'appartenance de la commune dans la liste ci-dessus.</small>'; 
			?>

			</div>


			<button type="submit" name="newsubmit" class="btn btn-sm btn-primary p-btn-primary mb-3 mr-1">Ajouter</button>

		</form>

	</div>

</div>