<?php if(isset($vue) && $vue === 'base'): ?>

	<?php require PAGES . $subpage . 'edit/_base-infos.form.php'; ?>
	
<?php elseif(isset($vue) && $vue === 'compte'): ?>

	<?php require PAGES . $subpage . 'edit/_account-settings.form.php'; ?>

<?php else: ?>

	<?php require PAGES . $subpage . 'edit/_base-infos.form.php'; ?>

<?php endif; ?>