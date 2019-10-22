<div class="p-body text-center">
	
	<form method="POST" action="" class="p-form-signup">
		
		<img class="mb-4" src="<?= $MEDIAS . '/uses/logo-p.png'; ?>" alt width="72" height="72">

		<h1 class="h3 mb-3 font-weight-normal">Se connecter</h1>

		
		<div class="form-group mb-2<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">
			
			<label for="identifiant" class="sr-only">Identifiant</label>
			
			<input type="text" name="identifiant" id="identifiant" class="form-control p-form-ctrl" value="<?= get_input("identifiant"); ?>" placeholder="Identifiant" required="required" autocomplete="off" autofocus />
		
		<?= !empty($error[1]) ? '<span class="help-block text-left">' . $error[1] . '</span>' : ''; ?>
		
		</div>


		<div class="form-group mb-2<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">
			
			<label for="motdepasse" class="sr-only">Mot de passe</label>
			
			<input type="password" name="motdepasse" id="motdepasse" class="form-control p-form-ctrl" placeholder="Mot de passe" required="required" />
		
		<?= !empty($error[2]) ? '<span class="help-block text-left">' . $error[2] . '</span>' : ''; ?>
		
		</div>


		<!-- <div class="text-left mb-3">

			<div class="custom-control custom-checkbox mr-sm-2">

		        <input type="checkbox" name="rememberme" class="custom-control-input" id="rememberme" value="on">

		        <label class="custom-control-label" for="rememberme">Se souvenir de moi ?</label>

	      	</div>

		</div> -->


		<button type="submit" name="loginsubmit" class="btn btn-lg btn-primary btn-block p-btn-primary mb-3">Connexion</button>


		<div class="text-right"><a href="<?= WURI . '?r=recovery/'; ?>">Mot de passe oublié ?</a></div>


		<p class="mt-5 mb-3 text-muted"><?= WEBSITE_COPYRIGHT; ?></p>
	
	</form>

</div>