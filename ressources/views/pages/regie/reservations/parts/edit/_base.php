<div class="p-portlet rounded">

	<?php if(isset($vue) && $vue === 'etape-1'): ?>

		<?php require PAGES . $subpage . 'edit/_step-one.php'; ?>

	<?php elseif(isset($vue) && $vue === 'etape-2'): ?>

		<?php require PAGES . $subpage . 'edit/_step-two.php'; ?>

	<?php elseif(isset($vue) && $vue === 'etape-3'): ?>

		<?php require PAGES . $subpage . 'edit/_step-three.php'; ?>

	<?php elseif(isset($vue) && $vue === 'etape-4'): ?>

		<?php require PAGES . $subpage . 'edit/_step-four.php'; ?>

	<?php else: ?>

		<?php require PAGES . $subpage . 'edit/_step-one.php'; ?>

	<?php endif; ?>

</div>