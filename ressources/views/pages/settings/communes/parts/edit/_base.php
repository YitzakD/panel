<div class="p-portlet rounded">
	
	<?php #	En-tête ?>
	<div class="p-portlet-head">
		
		<div class="p-portlet-head-label">
			<h3>Informations de base</h3>
		</div>

		<div class="p-portlet-head-toolbar">
			
			<div class="dropdown">
				
				<button class="btn btn-sm btn-primary p-btn-primary" type="button" id="portleToolbar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>

				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="portleToolbar">

					<h6 class="dropdown-header">Actions rapides</h6>

					<a class="dropdown-item" href="<?= WURI . 'export.php/' . $m[1] . '/details/' . $ID . '/'; ?>" target="_blank"><i class="fas fa-print p-portlet-head-toolbar-dropdown-icon mr-3"></i>Exporter</a>
							
					<div class="dropdown-divider"></div>

					<button class="dropdown-item" style="cursor: pointer;" data-toggle="modal" data-target=".p-confirm-modal-sm"><i class="far fa-trash-alt p-portlet-head-toolbar-dropdown-icon mr-3"></i>Supprimer</button>

				</div>

			</div>

		</div>

	</div>


	<?php #	Contenu ?>
	<div class="p-portlet-body">

		<form action="" method="post" class="p-form-table">
			
			<div class="form-group mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

				<label for="communetitle" class="mb-0">Dénomination&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="text" name="communetitle" id="communetitle" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("communetitle") ?: $commune->cmune_title; ?>" placeholder="Entrez le nom" autofocus required />

			<?= !empty($error[1]) 
				? '<span class="help-block mt-1">' . $error[1] . '</span>' 
				: '<small class="text-muted">Entrez le nom de la commune.</small>'; 
			?>

			</div>

			<div class="form-group mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

				<label for="vid" class="mb-0">Ville d'appartenance</label>

				<select name="vid" class="form-control p-form-ctrl p-form-ctrl-sm">

					<?php foreach($villes as $item): ?>

					<?php if($commune->vid === $item->id): ?>
					
					<option value="<?= $item->id ?>" selected><?= $item->city_title; ?></option>	

					<?php else: ?>
					
					<option value="<?= $item->id ?>"><?= $item->city_title; ?></option>

					<?php endif; ?>
					
					<?php endforeach; ?>

				</select>

			<?= !empty($error[2]) 
				? '<span class="help-block mt-1">' . $error[2] . '</span>' 
				: '<small class="text-muted">Choisissez la ville d\'appartenance de la commune dans la liste ci-dessus.</small>'; 
			?>

			</div>


			<button type="submit" name="editsubmit" class="btn btn-sm btn-primary p-btn-primary mb-3 mr-1">Ajouter</button>

			<button type="reset" class="btn btn-sm btn-light border mb-3">Annuler</button>

		</form>

	</div>

</div>





<?php #	Confirmation Modal ?>
<div class="modal fade p-confirm-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">

		<div class="modal-content">

			<h3 class="p-modal-head"><i class="fas fa-exclamation-circle text-danger icon"></i></h3>

			<div class="h5">Êtes-vous sûre?</div>

			<div class="p text-muted mb-4">Vous ne pourrez pas revenir en arrière!</div>


			<form action="<?= WURI . '?r=' . $m[1] . '/suppression/' . $ID . '/'; ?>" method="post" class="p-3 mb-2">

				<button type="submit" class="btn btn-sm btn-primary">Oui, supprimez!</button>

				<button type="reset" class="btn btn-sm btn-light border"  data-dismiss="modal">Annuler</button>

			</form>

		</div>

	</div>

</div>