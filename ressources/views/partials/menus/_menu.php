<div class="d-block">

	<div class="row no-gutters p-menu-head">
		
		<div class="col-12 col-md-12 col-lg-12">

			<a href="<?= WURI . '?r=dashboard/'; ?>" class="p-0 m-0"><img src="<?= $MEDIAS . '/uses/logo-e.png'; ?>" alt></a>

			<span class="p-menu-button"><i class="fas fa-align-justify"></i></span>

		</div>

	</div>

	<ul class="p-menu-content mt-4">

		<li><a href="<?= WURI . '?r=dashboard/'; ?>" class="<?= $m[1] === 'dashboard' ? 'p-actived-menu' : ''; ?>" title="Tableau de bord">

			<i class="fas fa-chart-line p-menu-content-left-icon"></i>&nbsp;

			<span class="p-menu-content-text">Dashboard</span>

			<?php if($m[1] === 'dashboard'): ?><i class="fas fa-ellipsis-h p-menu-content-right-icon"></i><?php endif; ?>

		</a></li>

		<span class="h5">Régie</span>

		<li><a href="<?= WURI . '?r=clients/'; ?>" class="<?= $m[1] === 'clients' ? 'p-actived-menu' : ''; ?>" title="Clients">

			<i class="fas fa-handshake p-menu-content-left-icon"></i>&nbsp;

			<span class="p-menu-content-text">Clients</span>

			<?php if($m[1] === 'clients'): ?><i class="fas fa-ellipsis-h p-menu-content-right-icon"></i><?php endif; ?>

		</a></li>
			
		<li class="dropright">

			<a href="<?= WURI . '#'; ?>" class="<?= (($m[1] === 'campagnes') || ($m[1] === 'reservations')) ? 'p-actived-menu' : ''; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Campagnes">

				<i class="fas fa-book p-menu-content-left-icon"></i>&nbsp;
				
				<span class="p-menu-content-text">Campagnes</span>

				<i class="fas fa-angle-right p-menu-content-right-icon"></i>

			</a>

			<ul class="dropdown-menu">
				
				<li><a href="<?= WURI . '?r=reservations/'; ?>" class="dropdown-item"><span class="p-submenu-content-text">Réservations</span></a></li>

				<li><a href="<?= WURI . '?r=campagnes/'; ?>" class="dropdown-item"><span class="p-submenu-content-text">Campagnes</span></a></li>

			</ul>

		</li>

		<li><a href="<?= WURI . '?r=disponibilites/'; ?>" class="<?= $m[1] === 'disponibilites' ? 'p-actived-menu' : ''; ?>" title="Disponibilités">

			<i class="fas fa-calendar-check p-menu-content-left-icon"></i>&nbsp;

			<span class="p-menu-content-text">Disponibilités</span>

			<?php if($m[1] === 'disponibilites'): ?><i class="fas fa-ellipsis-h p-menu-content-right-icon"></i><?php endif; ?>

		</a></li>

		<li><a href="<?= WURI . '?r=panneaux/'; ?>" class="<?= $m[1] === 'panneaux' ? 'p-actived-menu' : ''; ?>" title="Panneaux">

			<i class="fas fa-sign p-menu-content-left-icon"></i>&nbsp;

			<span class="p-menu-content-text">Panneaux</span>

			<?php if($m[1] === 'panneaux'): ?><i class="fas fa-ellipsis-h p-menu-content-right-icon"></i><?php endif; ?>

		</a></li>

		<span class="h5">Comptabilité</span>

		<li class="dropright">

			<a href="<?= WURI . '#'; ?>" class="<?= (($m[1] === 'proformas') || ($m[1] === 'factures')) ? 'p-actived-menu' : ''; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Facturations">

				<i class="fas fa-file-invoice p-menu-content-left-icon"></i>&nbsp;
				
				<span class="p-menu-content-text">Facturations</span>

				<i class="fas fa-angle-right p-menu-content-right-icon"></i>

			</a>

			<ul class="dropdown-menu">
				
				<li><a href="<?= WURI . '?r=proformas/'; ?>" class="dropdown-item"><span class="p-submenu-content-text">Pro-formas</span></a></li>

				<li><a href="<?= WURI . '?r=factures/'; ?>" class="dropdown-item"><span class="p-submenu-content-text">Factures</span></a></li>

			</ul>

		</li>
		
		<li class="dropright">

			<a href="<?= WURI . '#'; ?>" class="<?= (($m[1] === 'fournisseurs') || ($m[1] === 'commandes')) ? 'p-actived-menu' : ''; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Fournisseurs">

				<i class="fas fa-truck p-menu-content-left-icon"></i>&nbsp;

				<span class="p-menu-content-text">Fournisseurs</span>

				<i class="fas fa-angle-right p-menu-content-right-icon"></i>

			</a>

			<ul class="dropdown-menu">
				
				<li><a href="<?= WURI . '?r=fournisseurs/'; ?>" class="dropdown-item"><span class="p-submenu-content-text">Fournisseurs</span></a></li>

				<li><a href="<?= WURI . '?r=commandes/'; ?>" class="dropdown-item"><span class="p-submenu-content-text">Commandes</span></a></li>

			</ul>

		</li>
		
		<?php if(get_session('type') === "1" || get_session('type') === "2"): ?>
		
		<li class="dropright">

			<a href="#" class="<?= (($m[1] === 'caisse') || ($m[1] === 'banque')) ? 'p-actived-menu' : ''; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Trésorerie">

				<i class="fas fa-piggy-bank p-menu-content-left-icon"></i>&nbsp;
				
				<span class="p-menu-content-text">Trésorerie</span>

				<i class="fas fa-angle-right p-menu-content-right-icon"></i>

			</a>

			<ul class="dropdown-menu" data-menu-last="tresorerie">

				<li><a href="<?= WURI . '?r=banque/'; ?>" class="dropdown-item"><span class="p-submenu-content-text">Banque</span></a></li>
				
				<li><a href="<?= WURI . '?r=caisse/'; ?>" class="dropdown-item"><span class="p-submenu-content-text">Caisse</span></a></li>

			</ul>

			<!-- <a href="<?= WURI . '?r=caisse/'; ?>" class="<?= $m[1] === 'caisse' ? 'p-actived-menu' : ''; ?>" title="Caisse">

			<i class="fas fa-piggy-bank p-menu-content-left-icon"></i>&nbsp;

			<span class="p-menu-content-text">Caisse</span>

			<?php if($m[1] === 'caisse'): ?><i class="fas fa-ellipsis-h p-menu-content-right-icon"></i><?php endif; ?>

			</a> -->

		</li>
			
			<?php if(get_session('type') === "2"): ?>

			<li><a href="<?= WURI . '?r=employes/'; ?>" class="<?= $m[1] === 'employes' ? 'p-actived-menu' : ''; ?>" title="Employés">

				<i class="fas fa-users p-menu-content-left-icon"></i>&nbsp;

				<span class="p-menu-content-text">Employés</span>

				<?php if($m[1] === 'employes'): ?><i class="fas fa-ellipsis-h p-menu-content-right-icon"></i><?php endif; ?>

			</a></li>

			<?php endif; ?>
		
		<?php endif; ?>


		<?php if(get_session('type') === "1" || get_session('type') === "3"): ?>

		<span class="h5">Réglages</span>

		<li class="dropright">

			<a href="#" class="<?= (($m[1] === 'zones') || ($m[1] === 'villes') || ($m[1] === 'communes') || ($m[1] === 'formats')) ? 'p-actived-menu' : ''; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Paramètres">

				<i class="fas fa-cog p-menu-content-left-icon"></i>&nbsp;
				
				<span class="p-menu-content-text">Paramètres</span>

				<i class="fas fa-angle-right p-menu-content-right-icon"></i>

			</a>

			<ul class="dropdown-menu" data-menu-last="parametres">
				
				<li><a href="<?= WURI . '?r=zones/'; ?>" class="dropdown-item"><span class="p-submenu-content-text">Zones</span></a></li>

				<li><a href="<?= WURI . '?r=villes/'; ?>" class="dropdown-item"><span class="p-submenu-content-text">Villes</span></a></li>

				<li><a href="<?= WURI . '?r=communes/'; ?>" class="dropdown-item"><span class="p-submenu-content-text">Communes</span></a></li>

				<li><a href="<?= WURI . '?r=formats/'; ?>" class="dropdown-item"><span class="p-submenu-content-text">Formats</span></a></li>

			</ul>

		</li>

		<?php endif; ?>


		<?php if(get_session('type') === "1"): ?>

		<li class="dropright">

			<a href="#" class="<?= (($m[1] === 'activites') || ($m[1] === 'utilisateurs')) ? 'p-actived-menu' : ''; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Paramètres">

				<i class="fas fa-user-secret p-menu-content-left-icon"></i>&nbsp;
				
				<span class="p-menu-content-text">Super</span>

				<i class="fas fa-angle-right p-menu-content-right-icon"></i>

			</a>

			<ul class="dropdown-menu" data-menu-last="super-parametres">

				<li><a href="<?= WURI . '?r=utilisateurs/'; ?>" class="dropdown-item"><span class="p-submenu-content-text">Utilisateurs</span></a></li>

				<li><a href="<?= WURI . '?r=activites/'; ?>" class="dropdown-item"><span class="p-submenu-content-text">Journal d'activités</span></a></li>

			</ul>
			
		</li>

		<?php endif; ?>


	</ul>

	

</div>