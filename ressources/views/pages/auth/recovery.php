<div class="p-body text-center">
	
	<form method="POST" action="" class="p-form-signup">
		
		<img class="mb-4" src="<?= $MEDIAS . '/uses/logo-p.png'; ?>" alt width="72" height="72">

		<h1 class="h3 mb-3 font-weight-normal">Récupérer mon compte</h1>

		
		<div class="form-group mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">
			
			<label for="identifiant" class="sr-only">Pseudonyme ou Adresse E-mail</label>
			
			<input type="text" name="identifiant" id="identifiant" class="form-control p-form-ctrl" value="<?= get_input("identifiant"); ?>" placeholder="Pseudonyme ou Adresse E-mail" required="required" autocomplete="off" autofocus />
		
		<?= !empty($error[1]) ? '<span class="help-block text-left">' . $error[1] . '</span>' : ''; ?>
		
		</div>


		<div class="text-left mb-3"></div>


		<button type="submit" name="recoverysubmit" class="btn btn-lg btn-primary btn-block p-btn-primary mb-3">Récupérer</button>


		<div class="text-right"><a href="<?= WURI . '?r=login/'; ?>">
			<i class="fas fa-angle-left"></i>&nbsp;Retour</a></div>


		<p class="mt-5 mb-3 text-muted"><?= WEBSITE_COPYRIGHT; ?></p>
	
	</form>

</div>