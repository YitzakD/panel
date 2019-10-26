<div class="d-block p-inner-header">

	<div class="p-nav-content d-flex justify-content-between">

		<ul class="nav justify-content-start">
			
			<li class="nav-item"><a href="#" class="nav-link" id="p-show-sidebar-notebook-toggle"><i class="fas fa-address-book p-nav-content-icon"></i></a></li>

			<li class="nav-item"><a href="#" class="nav-link" id="p-show-sidebar-tasks-toggle"><i class="fas fa-tasks p-nav-content-icon"></i></a></li>

		</ul>
		
		<ul class="nav justify-content-end">
		
			<li class="nav-item dropdown">
				
				<a href="#" class="nav-link p-notification-f" id="p-nav-content-notfication-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-bell p-nav-content-icon"></i>

					<span class="badge badge-danger" id="badge"></span>

				</a>
				
				<div class="dropdown-menu" aria-labelledby="p-nav-content-notfication-dropdown">

					<p class="dropdown-header">Notifications</p>

					<?php

						$uid = get_session("uid");

						$pseudo = get_session("pseudo");

						$notificationscounter = count_all("notifications", "WHERE dest='$uid'");

					?>

					<div class="p-dropdown-item-p" id="p-nav-notification-box">
						
						<?php if($notificationscounter > 0): ?>

							<div class="d-block p-notification-inner"></div>

							<div class="d-block p-notification-see-all text-center">

								<a href="<?= WURI . '?r=profil/notifications/'; ?>">Voir tout</a>

							</div>

						<?php else: ?>

							<div class="p-notification text-muted">Vos n'avez aucunes notifications pour le moment.</div>

						<?php endif; ?>	

					</div>

				</div>

			</li>

			<li class="nav-item"><a href="#" class="nav-link" id="p-show-sidebar-menu-toggle"><i class="fas fa-th p-nav-content-icon"></i></a></li>

			<li class="nav-item dropdown">
				
				<a href="#" class="nav-link" id="p-nav-content-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Hi, <?= get_session('pseudo'); ?><i class="fas fa-user-circle ml-2"></i>
				</a>
				
				<div class="dropdown-menu" aria-labelledby="p-nav-content-user-dropdown">

					<p class="dropdown-profil">
						<span class="d-block"><?= get_session('pseudo'); ?></span>
					</p>

					<span class="text-muted">

						<?php $role = find_one("utypes", "id", get_session('type')); ?>
						
						<?= $role->utype_name; ?>

					</span>

					<a class="dropdown-item" href="<?= WURI . '?r=profil/infos/'; ?>"><i class="far fa-address-card mr-3 p-nav-content-dropdown-icon"></i>Mon profil</a>

					<a class="dropdown-item" href="<?= WURI . '?r=profil/reglages/'; ?>"><i class="fas fa-cog mr-3 p-nav-content-dropdown-icon"></i>Réglages</a>

					<div class="dropdown-divider"></div>

					<form action="<?= WURI . '?r=logout/'; ?>" method="post" class="px-4 py-3">
						
						<button type="submit" class="btn btn-sm btn-primary p-btn-primary">Déconnexion</button>

					</form>

				</div>

			</li>

			<li class="nav-item"><a href="#" class="nav-link" id="p-show-sidebar-settings-toggle"><i class="fas fa-cog p-nav-content-icon"></i></a></li>

		</ul>

	</div>

</div>