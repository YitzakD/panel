<form action="" method="post" class="p-form-table">

	<div class="form-group mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">
		
		<label for="upassword" class="mb-0">Session</label>
		<span class="d-block small text-muted">Switcher si vous voulez garder votre session active sur ce navigateur.</span>

		<div>
			
			<label class="p-switch">
				
				<input type="checkbox" id="p-switch-session" name="sessionmode[]" value="<?= $upref->sessionmode; ?>" <?= $upref->sessionmode === "1" ? "checked" : ""; ?>>
				
				<span class="p-switch-slider round"></span>
			
			</label>

			<div class="setres"></div>
		
		</div>

	<?= !empty($error[1]) ? '<span class="help-block mt-1">' . $error[1] . '</span>' : ''; ?>

	</div>

	<div class="mb-4 mt-4 border-top"></div>
				
	<div class="form-group mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">
		
		<label for="upassword" class="mb-0">Taille du Menu</label>
		<span class="d-block small text-muted">Switcher entre le menu plein (standard) et le menu mini (icone uniquement).</span>

		<div>
							
			<label class="p-switch p-switch-menu-box">
				
				<input type="checkbox" id="p-switch-menu" name="menumode[]" value="<?= $upref->menumode; ?>" <?= $upref->menumode === "M" ? "checked" : ""; ?>>
				
				<span class="p-switch-slider round"></span>
			
			</label>
		
		</div>

	<?= !empty($error[2]) ? '<span class="help-block mt-1">' . $error[2] . '</span>' : ''; ?>

	</div>



	<div class="form-group mb-3<?= !empty($error) && count($error[3]) != 0 ? ' has-error' : '';  ?>">
		
		<label for="upassword" class="mb-0">Style des couleurs (<span class="text-danger font-weight-bold">Disponible bientôt</span>)</label>
		<span class="d-block small text-muted">Switcher entre le style Couloré (standard) et le style Dark.</span>

		<div>
			
			<label class="p-switch">
				
				<input type="checkbox" id="p-switch-style" name="stylemode[]" value="<?= $upref->stylemode; ?>" <?= $upref->stylemode === "D" ? "checked" : ""; ?>>
				
				<span class="p-switch-slider round"></span>
			
			</label>
		
		</div>

	<?= !empty($error[3]) ? '<span class="help-block mt-1">' . $error[3] . '</span>' : ''; ?>

	</div>

</form>