<div class="p-portlet rounded">
	
	<?php #	En-tête ?>
	<div class="p-portlet-head">
		
		<div class="p-portlet-head-label">
			<h3>Image du panneau</h3>
		</div>

	</div>


	<?php #	Contenu ?>
	<div class="p-portlet-body">
		
		<form action="" method="post" class="p-form-table" enctype="multipart/form-data">

			<div class="form-group mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

				<label for="etat" class="mb-0">Choix d'image</label>

				<div class="input-group">
					
					<div class="custom-file">

						<input type="file" name="file_road" id="p-sb-file-box" class="custom-file-input p-form-ctrl p-form-ctrl-sm">

						<label class="custom-file-label" for="p-sb-file-box">Choisisser un fichier</label>

					</div>

					<span class="input-group-addon input-ga-select rounded-right font-weight-bold">

						<i class="fas fa-download"></i>

					</span>

				</div>	

			<?= !empty($error[1]) 
				? '<span class="help-block mt-1">' . $error[1] . '</span>' 
				: '<small class="text-muted" id="p-get-file-name">Choisissez une image pour le panneau. Taille maximale autorisée : 5Mo</small>'; 
			?>

			</div>


			<button type="submit" name="upsubmit" class="btn btn-sm btn-primary p-btn-primary mb-3 mr-1">Editer</button>

			<button type="reset" class="btn btn-sm btn-light border mb-3">Annuler</button>

		</form>

	</div>

</div>