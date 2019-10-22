<div class="p-inner-main-subheader row">

	<div class="p-inner-main-containor col-12 col-md-6 col-lg-7">

		<div class="p-inner-main-containor-main">

			<h3 class="p-inner-main-containor-main-title"><?= WEBSITE_NAME; ?></h3>

			<span class="p-inner-main-containor-main-separator sr-only"></span>

			<div class="p-breadcrumbs">
				
				<a href="<?= WURI . '?r=' . $m[1] . '/'; ?>" class="p-breadcrumb-home"><i class="fas fa-home"></i></a>

				<span class="p-breadcrumb-separator"></span>

				<a href class="p-breadcrumb-link"><?= ucfirst($m[1]); ?></a>

			</div>

		</div>

	</div>

	<div class="p-inner-main-toolbar col-12 col-md-6 col-lg-5">

		<div class="p-inner-main-toolbar-main">

			<div class="p-portlet-head-toolbar" style="display: unset;">
						
				<div class="dropdown d-inline-block float-right">
					
					<button class="btn btn-sm btn-primary p-btn-primary" type="button" id="portleToolbar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-plus"></i></button>

					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="portleToolbar">

						<h6 class="dropdown-header">Actions rapides</h6>

						<a class="dropdown-item" href="<?= WURI . '?r=disponibilites/recherche/'; ?>"><i class="fas fa-search p-portlet-head-toolbar-dropdown-icon mr-3"></i>Disponibilités</a>

						<a class="dropdown-item" href="<?= WURI . '?r=reservations/nouvelle/'; ?>"><i class="fas fa-book p-portlet-head-toolbar-dropdown-icon mr-3"></i>Réservations</a>

						<a class="dropdown-item" href="<?= WURI . '?r=proformas/nouvelle/'; ?>"><i class="fas fa-file-invoice p-portlet-head-toolbar-dropdown-icon mr-3"></i>Proformas</a>

						<a class="dropdown-item" href="<?= WURI . '?r=clients/nouveau/'; ?>"><i class="fas fa-file-invoice p-portlet-head-toolbar-dropdown-icon mr-3"></i>Clients</a>
					</div>

				</div>

				<span class="btn btn-sm btn-primary p-btn-primary-outline small float-right mr-2"><?=  date_to_fr(date('l, j M Y',strtotime($today))); ?></span>

			</div>

		</div>

	</div>

</div>