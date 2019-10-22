<div class="p-body text-center">
	
	<form method="POST" action="" class="p-form-signup">
		
		<img class="mb-4" src="<?= $MEDIAS . '/uses/logo-p.png'; ?>" alt width="72" height="72">

		<h1 class="h3 mb-3 font-weight-normal">Enregistrement</h1>

		
		<div class="form-group mb-2<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">
			
			<label for="pseudo" class="sr-only">Pseudonyme</label>
			
			<input type="text" name="pseudo" id="pseudo" class="form-control p-form-ctrl" value="<?= get_input("pseudo") ?: e($savedident); ?>" placeholder="Pseudonyme" required="required" autocomplete="off" autofocus />
		
		<?= !empty($error[1]) ? '<span class="help-block text-left">' . $error[1] . '</span>' : ''; ?>
		
		</div>

		<div class="form-group mb-2<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">
			
			<label for="emailaddr" class="sr-only">Adresse E-mail</label>
			
			<input type="email" name="emailaddr" id="emailaddr" class="form-control p-form-ctrl" value="<?= get_input("emailaddr") ?: e($savedemail); ?>" placeholder="Adresse E-mail" required="required" autocomplete="off" />
		
		<?= !empty($error[2]) ? '<span class="help-block text-left">' . $error[2] . '</span>' : ''; ?>
		
		</div>


		<div class="form-group mb-2<?= !empty($error) && count($error[3]) != 0 ? ' has-error' : '';  ?>">
			
			<label for="motdepasse" class="sr-only">Mot de passe</label>
			
			<input type="password" name="motdepasse" id="motdepasse" class="form-control p-form-ctrl" placeholder="Mot de passe" required="required" />
		
		<?= !empty($error[3]) ? '<span class="help-block text-left">' . $error[3] . '</span>' : ''; ?>
		
		</div>


		<div class="text-left mb-3"></div>


		<button type="submit" name="registersubmit" class="btn btn-lg btn-primary btn-block p-btn-primary mb-3">Créer</button>


		<div class="text-right">

			<a href="<?= WURI . '?r=login/'; ?>"><i class="fas fa-angle-left"></i>&nbsp;Revenir au formulaire de connexion</a>

		</div>
	
	</form>

</div>