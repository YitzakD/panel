<div class="p-portlet rounded">
	
	<?php #	En-tête ?>
	<div class="p-portlet-head">
		
		<div class="p-portlet-head-label">
			<h3>Paiement</h3>
		</div>

	</div>


	<?php #	Contenu ?>
	<div class="p-portlet-body">
		
		<form action="" method="post" class="p-form-table">

			<div class="form-group mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

				<label for="amount" class="mb-0">Montant&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="number" name="amount" id="amount" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("amount"); ?>" placeholder="Entrez le montant" required />

			<?= !empty($error[1]) 
				? '<span class="help-block mt-1">' . $error[1] . '</span>' 
				: '<small class="text-muted">Entrez le montant du paiement reçu.</small>'; 
			?>

			</div>


			<button type="submit" name="depositsubmit" class="btn btn-sm btn-primary p-btn-primary mb-3 mr-1">Déclarer</button>

		</form>

	</div>

</div>

<div class="mb-4"><a href="<?= WURI . '?r=' . $m[1] . '/client-transactions/' . $client->id . '/'; ?>" class="small"><i class="fas fa-angle-right"></i>&nbsp;Voir toutes les transations avec ce client <?= $client->e_name;  ?></a></div>