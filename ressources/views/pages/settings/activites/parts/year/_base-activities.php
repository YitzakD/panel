<div class="p-portlet rounded">

	<?php #	En-tête ?>
	<div class="p-portlet-head">
		
		<div class="p-portlet-head-label">

			<h3>Journal d'activités <small class="p-hidden"><?= get_session('pseudo'); ?> - Total <?= $useractivitiescounter; ?></small></h3>

		</div>

	</div>


	<?php #	Contenu ?>
	<div class="d-block p-4">

	<?php if($useractivitiescounter > 0): ?>

	<?php foreach($useractivities as $value): ?>
	
		<div class="p-timeline-item">
			
			<div class="p-timeline-item-section">
				
				<div class="p-timeline-is-border-plus">
					
					<div class="p-timeline-is-icon">

						<?php if($value->field === "edition" || $value->field === "choix-banque"): ?>

							<i class="fas fa-pencil-alt text-warning"></i>

						<?php elseif($value->field === "suppression"): ?>	

							<i class="fas fa-eraser text-danger"></i>

						<?php elseif($value->field === "validation"): ?>	

							<i class="fas fa-check text-success"></i>

						<?php elseif($value->field === "Authentification" || $value->field === "notifications" || $value->field === "activites"): ?>	

							<i class="fas fa-user-circle text-primary"></i>

						<?php elseif($value->field === "nouvel" || $value->field === "nouveau" || $value->field === "nouvelle" || $value->field === "nouveau-compte" || $value->field === "nouvelle transaction bancaire"): ?>	

							<i class="fas fa-plus text-secondary"></i>

						<?php elseif($value->field === "ajout-image"): ?>	

							<i class="fas fa-image text-secondary"></i>

						<?php elseif($value->field === "reglages"): ?>	

							<i class="fas fa-cogs text-dark"></i>

						<?php elseif($value->field === "infos" || $value->field === "transactions" || $value->field === "complete" || $value->field === "transaction" || $value->field === "details"): ?>	

							<i class="fas fa-info text-warning"></i>

						<?php endif; ?>

					</div>

				</div>

				<span class="p-timeline-is-field">
					<span class="text-capitalize"><?= $value->field; ?></span>
					&nbsp;-&nbsp;<small><?= set_time($value->created); ?></small>
				</span>

			</div>

			<a href class="p-timeline-item-text"><?= $value->activity; ?></a>

			<a href class="p-timeline-item-info"><?= $value->title; ?></a>

		</div>

	<?php endforeach; ?>

	<?php else: ?>

	<div class="d-block text-center p-3 text-muted">Aucunes activités détecter.</div>
		
	<?php endif; ?>

	</div>


	<div class="p-portlet-foot">

		<div class="p-portlet-foot-main p-hidden">
			
			<blockquote class="blockquote" style="margin: 5px 0;">

				<footer class="blockquote-footer"><cite title="Source Title">Liste des <?= $con; ?></cite></footer>

			</blockquote>

		</div>

		<?php if($useractivitiescounter > $limit): ?>

		<div class="p-portlet-foot-toolbar">

		<?= paginate(WURI . "?r=$m[1]/$con/$vue/$ID/", "&s=", $nbpages, $current); ?>

		</div>

		<?php endif; ?>

	</div>

</div>	