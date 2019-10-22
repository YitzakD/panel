<div class="row no-gutters">

	<?php #	Infos ?>
	<div class="col-12 col-md-12 col-lg-12">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					
					<?php 

						$in = explode(" ", $userinfo->pseudo);

 						$utype = find_one("utypes", "id", $userinfo->utid);

					?>
 									
					<span class="d-inline-block mr-2 p-datatable-pic">
						<div class="p-datatable-avatarname text-uppercase" style="background-color: <?= '#'.RandomCouleur(); ?>"><?= isset($in[1][0]) ? $avatarname = $in[1][0] : $avatarname = $in[0][0]; ?></div>
					</span>

					<span class="d-inline-block">
						<div class="text-capitalize"><?= $userinfo->pseudo; ?></div>
						<span class="d-block small text-muted"><?= $utype->utype_name; ?></span>
					</span>

				</div>

				<div class="p-portlet-head-toolbar">
					
					<div class="dropdown">
						
						<button class="btn btn-sm btn-primary p-btn-primary" type="button" id="portleToolbar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="portleToolbar">

							<h6 class="dropdown-header">Actions rapides</h6>

							<a class="dropdown-item" href="#"><i class="fas fa-print p-portlet-head-toolbar-dropdown-icon mr-3"></i>Exporter</a>

						</div>

					</div>

				</div>

			</div>



			<div class="p-portlet-separator mt-4 mb-4"></div>



			<?php #	Contentu ?>
			<div class="d-block pb-4">

				<div class="nav flex-column nav-pills p-nav-pills-v">

					<a class="nav-link <?= (!isset($con)) || ($con === 'infos') ? 'active' : ''; ?>" href="<?= WURI . '?r=' . $m[1] . '/infos/'; ?>">

						<i class="fas fa-user-circle mr-3"></i>Profil

					</a>
					
					<a class="nav-link <?= ($con === 'edition') && ($vue === 'base') ? 'active' : ''; ?>" href="<?= WURI . '?r=' . $m[1] . '/edition/base/' . get_session('uhash') . '/'; ?>">

						<i class="fas fa-id-badge mr-3"></i>Informations de base

					</a>
					
					<a class="nav-link <?= ($con === 'edition') && ($vue === 'compte') ? 'active' : ''; ?>" href="<?= WURI . '?r=' . $m[1] . '/edition/compte/' . get_session('uhash') . '/'; ?>">

						<i class="fas fa-shield-alt mr-3"></i>Paramètres de compte

					</a>
					
					<a class="nav-link <?= ($con === 'notifications') || ($con === 'notifications' && isset($vue)) ? 'active' : ''; ?>" href="<?= WURI . '?r=' . $m[1] . '/notifications/'; ?>">

						<i class="fas fa-bell mr-3"></i>Centre de notifications

						<span class="badge badge-danger"></span>

					</a>
					
					<a class="nav-link <?= ($con === 'activites') || ($con === 'activites' && isset($vue)) ? 'active' : ''; ?>" href="<?= WURI . '?r=' . $m[1] . '/activites/'; ?>">

						<i class="fas fa-newspaper mr-3"></i>Journal d'activités

					</a>
					
					<a class="nav-link <?= ($con === 'reglages') && (!isset($vue)) ? 'active' : ''; ?>" href="<?= WURI . '?r=' . $m[1] . '/reglages/'; ?>">

						<i class="fas fa-cog mr-3"></i>Réglages

					</a>
				
				</div>

			</div>

		</div>
		
	</div>

</div>