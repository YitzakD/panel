<div class="p-portlet rounded">

	<?php #	En-tête ?>
	<div class="p-portlet-head">
		
		<div class="p-portlet-head-label">

			<h3>Notifications <small>Total <?= $notificationscounter . "&nbsp;($thenotificationscounter)"; ?></small></h3>

		</div>

		<div class="p-portlet-head-toolbar">

			<a class="font-weight-bold" href="<?= WURI . '?r=' . $m[1] . '/notifications/lire-tout/'; ?>">Tout marquer comme lu</a>

		</div>

	</div>


	<?php #	Contenu ?>
	<div class="d-block">

	<?php if($notificationscounter > 0): ?>

	<?php foreach($notifications as $item): ?>

		<?php $si = find_one("users", "id", $item->starter_id); ?>

		<div href class="p-user-notification p-notification-clickable">

			<a href="<?= WURI . '?r=notifications/notif/' . $item->id . '/'; ?>">

				<div class="text-capitalize">

				<?php if($item->state === "on"): ?>

					<div class="p-notification-indicator bg-primary rounded"></div>

					<strong><?= $si->pseudo ;?></strong>

				<?php  else: ?>

					<span><?= $si->pseudo ?></span>	

				<?php endif; ?>	
						
				</div>

				<div><?= $item->description; ?></div>

				<div>
					
					<span class="d-inline small p-0"><?= $item->type === "H" ? "<i class='fas fa-angle-double-up text-danger'></i>" : "<i class='fas fa-angle-right text-primary'></i>"; ?></span>
					<span class="d-inline small text-muted ml-2 p-0"><?= set_time($item->created); ?></span>
						
				</div>

			</a>
				
		</div>

	<?php endforeach; ?>
	
	<?php else: ?>

	<div class="p-user-notification text-muted">Vos n'avez aucunes notifications pour le moment.</div>

	<?php endif; ?>	

	</div>
	

	<div class="p-portlet-foot">

		<div class="p-portlet-foot-main">
			
			<blockquote class="blockquote" style="margin: 5px 0;">

				<footer class="blockquote-footer"><cite title="Source Title">Liste des <?= $con; ?></cite></footer>

			</blockquote>

		</div>

		<?php if($notificationscounter > $limit): ?>

		<div class="p-portlet-foot-toolbar">

		<?= paginate(WURI . "?r=" . $m[1] . "/" . $con . "/", "&s=", $nbpages, $current); ?>

		</div>

		<?php endif; ?>

	</div>

</div>