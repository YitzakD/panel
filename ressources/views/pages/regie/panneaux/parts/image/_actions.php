<div class="row no-gutters">

	<?php #	Actions de modifications ?>
	<div class="col-12 col-md-12 col-lg-12">

		<div class="p-portlet rounded">
			
			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3>Actions de modification</h3>
				</div>

			</div>
			
			
			<?php #	Contenu ?>
			<?php if($signboard->file_road_sm !== ""): ?>
				
				<a href="<?= WURI . '?r=' . $m[1] . '/edition/' . $ID . '/';  ?>" class="p-portlet-link text-muted">> Informations de base</a>

			<?php else: ?>	

				<span class="p-portlet-link text-muted">> Informations de base</span>

			<?php endif; ?>

			<a href="" class="p-portlet-link font-weight-bold">Image du paneau</a>	

		</div>

	</div>


	<?php #	Actions de modifications ?>
	<?php if($signboard->file_road_sm !== ""): ?>

	<div class="col-12 col-md-12 col-lg-12">

		<div class="p-portlet rounded">
			
			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3>Aperçu d'image</h3>
				</div>

			</div>

			<div class="p-portlet-body">
			
				<img src="<?= $signboard->file_road_sm; ?>" width="100%" alt data-toggle="modal" data-target=".bd-example-modal-lg" style="cursor: pointer;">	

			</div>

		</div>

	</div>

	<?php endif; ?>

</div>



<?php #	Picture Modal ?>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

	<div class="modal-dialog modal-dialog-centered" role="document">
	
		<div class="modal-content">
			
			<div class="modal-header">
				
				<h5 class="modal-title" id="exampleModalLongTitle"><?= 'DEV-' . $signboard->nbr; ?></h5>
				
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			
			</div>

			<div class="modal-body text-center"><img src="<?= $signboard->file_road; ?>" width="100%" alt></div>

			
			<div class="modal-footer">
				
				<div class="p text-muted font-weight-bold text-uppercase" style="font-size: .83rem"><?= $signboard->geoloc; ?></div>

			</div>

		</div>

	</div>

</div>
		