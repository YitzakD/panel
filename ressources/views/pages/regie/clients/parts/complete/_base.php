<div class="p-portlet rounded">
	
	<?php #	En-tête ?>
	<div class="p-portlet-head">
		
		<div class="p-portlet-head-label">
			<h3>Informations de facturation</h3>
		</div>

		<div class="p-portlet-head-toolbar">

			<?php if(($client->bp === "") || ($client->cc === "")): ?>

			<a href="<?= WURI . '?r=' . $m[1] . '/infos/' . $ID . '/'; ?>" class="btn btn-sm btn-primary"  data-toggle="tooltip" data-placement="bottom" title="Completer les informations de facturations plus tard ?"><i class="far fa-thumbs-up"></i>&nbsp;Plus tard</a>

			<?php endif; ?>

		</div>

	</div>
	
	
	<?php #	Conteu ?>
	<div class="p-portlet-body">
		
		<form action="" method="post" class="p-form-table">
			
			<div class="form-group mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

				<label for="bp" class="mb-0">Adresse postale</label>

				<input type="text" name="bp" id="bp" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("bp") ?: $client->bp; ?>" placeholder="Entrez l'adresse postale" autofocus required />

			<?= !empty($error[1]) 
				? '<span class="help-block mt-1">' . $error[1] . '</span>' 
				: '<small class="text-muted">Entrez le nom de l\'adresse postale de l\'entreprise.</small>'; 
			?>

			</div>
			

			<div class="form-group mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

				<label for="cc" class="mb-0">Numéro de compte contribuable</label>

				<input type="text" name="cc" id="cc" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("cc") ?: $client->cc; ?>" placeholder="Entrez le numéro de compte contribuable" required />

			<?= !empty($error[2]) 
				? '<span class="help-block mt-1">' . $error[2] . '</span>' 
				: '<small class="text-muted">Entrez le numéro de compte contribuable de l\'entreprise.</small>'; 
			?>

			</div>


			<button type="submit" name="invoicesubmit" class="btn btn-sm btn-primary p-btn-primary mb-3 mr-1">Completer</button>

			<button type="reset" class="btn btn-sm btn-light border mb-3">Annuler</button>

		</form>

	</div>

</div>	
		