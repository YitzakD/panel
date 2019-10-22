<div class="row no-gutters">

	<?php #	Infos ?>
	<div class="col-12 col-md-12 col-lg-12">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					
					<?php 

						$in = explode(" ", $utilisateur->pseudo);

 						$utype = find_one("utypes", "id", $utilisateur->utid);

					?>
 									
					<span class="d-inline-block mr-2 p-datatable-pic">
						<div class="p-datatable-avatarname text-uppercase" style="background-color: <?= '#'.RandomCouleur(); ?>"><?= isset($in[1][0]) ? $avatarname = $in[1][0] : $avatarname = $in[0][0]; ?></div>
					</span>

					<span class="d-inline-block">
						<div class="text-capitalize"><?= $utilisateur->pseudo; ?></div>
						<span class="d-block small text-muted"><?= $utype->utype_name; ?></span>
					</span>

				</div>

				<div class="p-portlet-head-toolbar">
					
					<div class="dropdown">
						
						<button class="btn btn-sm btn-primary p-btn-primary" type="button" id="portleToolbar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="portleToolbar">

							<h6 class="dropdown-header">Actions rapides</h6>

							<div class="dropdown-divider"></div>

							<button class="dropdown-item" style="cursor: pointer;" data-toggle="modal" data-target=".p-confirm-modal-sm">

								<i class="far fa-trash-alt p-portlet-head-toolbar-dropdown-icon mr-3"></i>Supprimer

							</button>

						</div>

					</div>

				</div>

			</div>



			<div class="p-portlet-separator mt-4 mb-4"></div>



			<?php #	Contentu ?>
			<div class="d-block pb-4">

				<div class="nav flex-column nav-pills p-nav-pills-v">

					<a class="nav-link <?= $con === 'infos' ? 'active' : ''; ?>" href="<?= WURI . '?r=' . $m[1] . '/infos/' . $utilisateur->id . '/'; ?>">

						<i class="fas fa-user-circle mr-3"></i>Profil

					</a>
					
					<a class="nav-link <?= ($con === 'edition') && ($vue === 'base') ? 'active' : ''; ?>" href="<?= WURI . '?r=' . $m[1] . '/edition/base/' . $utilisateur->id . '/'; ?>">

						<i class="fas fa-id-badge mr-3"></i>Informations de base

					</a>
					
					<a class="nav-link <?= ($con === 'edition') && ($vue === 'compte')  ? 'active' : ''; ?>" href="<?= WURI . '?r=' . $m[1] . '/edition/compte/' . $utilisateur->id . '/'; ?>">

						<i class="fas fa-shield-alt mr-3"></i>Paramètres de compte

					</a>
					
					<a class="nav-link <?= ($con === 'edition') && ($vue === 'utilisateur')  ? 'active' : ''; ?>" href="<?= WURI . '?r=' . $m[1] . '/edition/utilisateur/' . $utilisateur->id . '/'; ?>">

						<i class="fas fa-cog mr-3"></i>Paramêtres utilisateur

					</a>
				
				</div>

			</div>

		</div>
		
	</div>

</div>





<?php #	Confirmation Modal ?>
<div class="modal fade p-confirm-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">

		<div class="modal-content">

			<h3 class="p-modal-head"><i class="fas fa-exclamation-circle text-danger icon"></i></h3>

			<div class="h5">Êtes-vous sûre?</div>

			<div class="p text-muted mb-4">Vous ne pourrez pas revenir en arrière!</div>


			<form action="<?= WURI . '?r=' . $m[1] . '/suppression/' . $ID . '/'; ?>" method="post" class="p-3 mb-2">

				<button type="submit" class="btn btn-sm btn-primary">Oui, supprimez!</button>

				<button type="reset" class="btn btn-sm btn-light border"  data-dismiss="modal">Annuler</button>

			</form>

		</div>

	</div>

</div>