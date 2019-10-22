<div class="p-portlet rounded">
	
	<?php #	En-tête ?>
	<div class="p-portlet-head">
		
		<div class="p-portlet-head-label">
			<h3>Actions de modification</h3>
		</div>

	</div>
	
	
	<?php #	Contenu ?>
	<?php if($employe->occ_poste !== ""): ?>
		
		<a href="<?= WURI . '?r=' . $m[1] . '/edition/' . $ID . '/';  ?>" class="p-portlet-link text-muted">> Informations de base</a>

	<?php else: ?>	

		<span class="p-portlet-link text-muted">> Informations de base</span>

	<?php endif; ?>

	<a href="" class="p-portlet-link font-weight-bold">Informations spécifique</a>

</div>	
		