<div class="d-block">
	
	<div class="row no-gutters p-4">
		
		<div class="col-8 col-sm-8 col-md-9 col-lg-10">
			
			<ul class="nav nav-pills p-nav-pills-h" id="pills-tab" role="tablist">

				<li class="nav-item">
					<a class="nav-link active" id="pills-activities-tab" data-toggle="pill" href="#pills-activities" role="tab" aria-controls="pills-activities" aria-selected="false">Activités</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" id="pills-settings-tab" data-toggle="pill" href="#pills-settings" role="tab" aria-controls="pills-settings" aria-selected="false">Réglages</a>
				</li>

			</ul>

		</div>

		<div class="col-4 col-sm-4 col-md-3 col-lg-2 text-right">
			
			<a href="#" class="btn btn-sm btn-primary p-btn-primary" id="p-hide-settings-sidebar-toggle"><i class="fas fa-times"></i></a>

		</div>

	</div>


	<div class="row no-gutters pl-4 pr-4 pb-4">

		<div class="tab-content" id="pills-tabContent">

		  	<div class="tab-pane fade show active" id="pills-activities" role="tabpanel" aria-labelledby="pills-activity-tab">

				<?php require PARTIALS . '/sidebars/settings/_activities.php'; ?>

		  	</div>





			<div class="tab-pane fade" id="pills-settings" role="tabpanel" aria-labelledby="pills-settings-tab">

				<?php require PARTIALS . '/sidebars/settings/_sets.php'; ?>

			</div>

		</div>
		
	</div>

</div>