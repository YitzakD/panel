<?php include_once PARTIALS . '/_header.php'; ?>

	<div class="dev-block-alert">
		
		<?php include_once PARTIALS . '/notifications/_flash.ntf.php'; ?>

		<?php include_once PARTIALS . '/notifications/_error.ntf.php'; ?>

	</div>

<?php /**Absence de session #*/ if(!isset($_SESSION['uid'])): ?>

	<div class="d-block">

		<?= $content; ?>

	</div>

<?php /**Présence de session #*/ else: ?>

<?php $upref = find_one("uprefs", "uid", get_session('uid')); ?>

	<div class="d-block">

		<?php if($upref->menumode === "M"): ?>
		
		<div class="p-menu p-menu-minimize" id="p-menu"><?php include_once PARTIALS . '/menus/_menu.php'; ?></div>

		<div class="p-content p-content-maximize" id="p-content">

		<?php else: ?>
		
		<div class="p-menu" id="p-menu"><?php include_once PARTIALS . '/menus/_menu.php'; ?></div>

		<div class="p-content" id="p-content">

		<?php endif; ?>

			<div class="p-header"><?php include_once PARTIALS . '/menus/_nav.php'; ?></div>

			<div class="p-main">

				<?= $content; ?>

				<a href class="p-chatbox-icon"><i class="far fa-comment-alt"></i></a>
					<span class="badge badge-danger p-global-chatcounter" id="p-global-chatcounter"></span>

			</div>

			<div class="p-orverlay"></div>

			<div class="p-sidebar-menu" id="p-show-menu">

				<?php include_once PARTIALS . '/sidebars/_menu.php'; ?>
				
			</div>

			<div class="p-sidebar-settings" id="p-show-settings">

				<?php include_once PARTIALS . '/sidebars/_settings.php'; ?>
				
			</div>

			<div class="p-sidebar-notebook" id="p-show-notebook"></div>
			
		</div>

	</div>	

<?php endif; ?>	

<?php include_once PARTIALS . '/_footer.php'; ?>