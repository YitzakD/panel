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

				</div>

			</div>

		</div>

	</div>


	<?php #	Contenu ?>
	<div class="p-portlet-body">
		
		<form action="" method="post" class="p-form-table">
			
			<div class="form-group mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

				<label for="provider" class="mb-0">Dénomination&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="text" name="provider" id="provider" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("provider") ?: $fournisseur->p_name; ?>" placeholder="Entrez le nom" autofocus required />

			<?= !empty($error[1]) 
				? '<span class="help-block mt-1">' . $error[1] . '</span>' 
				: '<small class="text-muted">Entrez le nom de l\'entreprise.</small>'; 
			?>

			</div>
			

			<div class="form-group mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

				<label for="corresponding" class="mb-0">Interlocuteur&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="text" name="corresponding" id="corresponding" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("corresponding") ?: $fournisseur->c_name; ?>" placeholder="Entrez le nom de l'interlocuteur" required />

			<?= !empty($error[2]) 
				? '<span class="help-block mt-1">' . $error[2] . '</span>' 
				: '<small class="text-muted">Entrez le nom complet de l\'interlocuteur.</small>'; 
			?>

			</div>
			

			<div class="form-group mb-3<?= !empty($error) && count($error[3]) != 0 ? ' has-error' : '';  ?>">

				<label for="pemail" class="mb-0">Adresse E-mail&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="email" name="pemail" id="pemail" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("pemail") ?: $fournisseur->p_mail; ?>" placeholder="Entrez l'adresse e-mail de l'interlocuteur" required />

			<?= !empty($error[3]) 
				? '<span class="help-block mt-1">' . $error[3] . '</span>' 
				: '<small class="text-muted">Entrez l\'adesse e-mail de l\'interlocuteur.</small>'; 
			?>

			</div>
			

			<div class="form-group mb-3<?= !empty($error) && count($error[4]) != 0 ? ' has-error' : '';  ?>">

				<label for="phones" class="mb-0">Téléphone&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="number" name="phones" id="phones" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("phones") ?: $fournisseur->contacts; ?>" placeholder="Entrez le numéro de téléphonique." required />

			<?= !empty($error[4]) 
				? '<span class="help-block mt-1">' . $error[4] . '</span>' 
				: '<small class="text-muted">Le format téléphonique réquis est sans espace.</small>'; 
			?>

			</div>
			

			<div class="form-group mb-3<?= !empty($error) && count($error[5]) != 0 ? ' has-error' : '';  ?>">

				<label for="type" class="mb-0">Type</label>

				<select name="type" class="form-control p-form-ctrl p-form-ctrl-sm">

                    <option value="RP" <?= $fournisseur->type === "RP" ? "selected" : ""; ?>>Régie Publicitaire</option>

                    <option value="AC" <?= $fournisseur->type === "AC" ? "selected" : ""; ?>>Agence en Communication</option>

                    <option value="AP" <?= $fournisseur->type === "AP" ? "selected" : ""; ?>>Autre / Personne</option>

				</select>

			<?= !empty($error[5]) 
				? '<span class="help-block mt-1">' . $error[5] . '</span>' 
				: '<small class="text-muted">Le format téléphonique réquis est sans espace.</small>'; 
			?>

			</div>


			<button type="submit" name="editsubmit" class="btn btn-sm btn-primary p-btn-primary mb-3 mr-1">Editer</button>

			<button type="reset" class="btn btn-sm btn-light border mb-3">Annuler</button>

		</form>

	</div>

</div>