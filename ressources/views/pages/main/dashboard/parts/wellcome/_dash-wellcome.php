<div class="p-portlet rounded p-bg-dash p-dash">
	
	<div class="row no-gutters">
		
		<div class="col-12 col-md-6 col-lg-6">

			<div class="p-dash-title">
				
				<h3 class="">Bienvenue <?= get_session('pseudo'); ?>!</h3>

				<p class="p-0 mb-1">Vous avez <b><?= $thenotificationscounter ?></b> notification(s) en attente!</p>

				<p class="p-0 mb-1">La journée s'annonce belle, alors mieux vaut en profiter!</p>

			</div>	

		</div>

		<div class="col-12 col-md-6 col-lg-6 p-dash-img">

			<img class="mb-4" src="<?= $MEDIAS . '/uses/astro.png'; ?>">

		</div>

	</div>

</div>