<?php if(isset($ID)): ?>

	<?php require PAGES . $subpage . 'details/_activities.php'; ?>

<?php else: ?>

	<?php require PAGES . $subpage . 'details/_base.activities.php'; ?>

<?php endif; ?>