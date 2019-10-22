<div class="p-body text-center">
	
	<form method="POST" action="" class="p-form-signup">
		
		<h1 class="h1 mb-4 font-weight-bold p-text-color-orange"><?= WEBSITE_NAME; ?></h1>

		<h1 class="h3 mb-3 font-weight-normal">Réinitialiser le compte</h1>

		<p class="text-muted">Si vous voyer ce formulaire, alors vous êtes sur le point de réinitialiser votre <b>mot de passe</b>. <a href="<?= WURI . '?r=login/'; ?>">Cliquez ici</a> si ce n'est pas votre souhait?</p>


		<div class="form-group mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">
			
			<label for="motdepasse" class="sr-only">Réinitialiser le mot de passe</label>
			
			<input type="password" name="motdepasse" id="motdepasse" class="form-control p-form-ctrl" placeholder="Réinitialiser le mot de passe" required="required" autofocus />
		
		<?= !empty($error[1]) ? '<span class="help-block text-left">' . $error[1] . '</span>' : ''; ?>
		
		</div>


		<div class="text-left mb-3"></div>


		<button type="submit" name="resetsubmit" class="btn btn-lg btn-primary btn-block p-btn-primary mb-3">Réinitialiser</button>


		<p class="mt-5 mb-3 text-muted"><?= WEBSITE_COPYRIGHT; ?></p>
	
	</form>

</div>