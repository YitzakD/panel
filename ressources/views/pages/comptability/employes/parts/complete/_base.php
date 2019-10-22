<div class="p-portlet rounded">
	
	<?php #	En-tête ?>
	<div class="p-portlet-head">
		
		<div class="p-portlet-head-label">
			<h3>Informations de base</h3>
		</div>

		<div class="p-portlet-head-toolbar">

			<?php if(($employe->occ_poste === "")): ?>

			<a href="<?= WURI . '?r=' . $m[1] . '/infos/' . $ID . '/'; ?>" class="btn btn-sm btn-primary"  data-toggle="tooltip" data-placement="bottom" title="Completer les informations spécifiques plus tard ?"><i class="far fa-thumbs-up"></i>&nbsp;Plus tard</a>

			<?php endif; ?>

		</div>

	</div>


	<?php #	Contenu ?>
	<div class="p-portlet-body">
		
		<form action="" method="post" class="p-form-table">
			
			<div class="form-group mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

				<label for="emb_date" class="mb-0">Date d'embauche&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="date" name="emb_date" id="emb_date" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("emb_date") ?: $employe->emb_date; ?>" autofocus required />

			<?= !empty($error[1]) 
				? '<span class="help-block mt-1">' . $error[1] . '</span>' 
				: '<small class="text-muted">Entrez la date à laquelle l\'employé a été embauché.</small>'; 
			?>

			</div>

			<div class="form-group mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

				<label for="contract_type" class="mb-0">Type de contrat</label>

				<select name="contract_type" class="form-control p-form-ctrl p-form-ctrl-sm">
					
					<option value="CDD" <?= $employe->contract_type === "CDD" ? "selected" : ""; ?>>CDD</option>

					<option value="CDI" <?= $employe->contract_type === "CDI" ? "selected" : ""; ?>>CDI</option>

					<option value="FREELANCE" <?= $employe->contract_type === "FREELANCE" ? "selected" : ""; ?>>FREELANCE</option>
				
				</select>

			<?= !empty($error[2]) 
				? '<span class="help-block mt-1">' . $error[2] . '</span>' 
				: '<small class="text-muted">sélectionnez le type de contrat.</small>'; 
			?>

			</div>

			<div class="form-group mb-3<?= !empty($error) && count($error[3]) != 0 ? ' has-error' : '';  ?>">

				<label for="occ_poste" class="mb-0">Poste occupé&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="text" name="occ_poste" id="occ_poste" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("occ_poste") ?: $employe->occ_poste; ?>" placeholder="Entrez le poste actuel" required />

			<?= !empty($error[3]) 
				? '<span class="help-block mt-1">' . $error[3] . '</span>' 
				: '<small class="text-muted">Entrez le poste actuel occupé par l\'employé.</small>'; 
			?>

			</div>

			<div class="form-group mb-3<?= !empty($error) && count($error[4]) != 0 ? ' has-error' : '';  ?>">

				<label for="salary" class="mb-0">Montant du salaire&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="number" name="salary" id="salary" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("salary") ?: $employe->salary; ?>" placeholder="Entrez le montant du salaire" required />

			<?= !empty($error[4]) 
				? '<span class="help-block mt-1">' . $error[4] . '</span>' 
				: '<small class="text-muted">Entrez le montant du salaire de l\'employé.</small>'; 
			?>

			</div>

			<div class="form-group mb-3<?= !empty($error) && count($error[5]) != 0 ? ' has-error' : '';  ?>">

				<label for="others_infos" class="mb-0">Autres informations</label>

				<textarea name="others_infos" class="form-control p-form-ctrl p-form-ctrl-sm" placeholder="Entrez les informations utiles sur cet employé"><?= get_input("others_infos") ?: $employe->others_infos; ?></textarea>

			<?= !empty($error[5]) 
				? '<span class="help-block mt-1">' . $error[5] . '</span>' 
				: '<small class="text-muted">Entrez les informations utiles sur cet employé qui pourraient nécésités notre attention.</small>'; 
			?>

			</div>


			<button type="submit" name="completesubmit" class="btn btn-sm btn-primary p-btn-primary mb-3 mr-1">Completer les informations</button>

		</form>

	</div>

</div>