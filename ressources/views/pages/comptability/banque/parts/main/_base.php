<div class="row no-gutters">

	<?php if(isset($banquescounter__) && ($banquescounter__ > 0)): ?>

	<?php foreach($banques__ as $item): ?>

	<div class="col-12 col-md-12 col-lg-12">

		<a href="<?= WURI . '?r=' . $m[1] . '/details/' . $item->bankhash . '/'; ?>" class="p-portlet rounded p-portlet-min p-bank-link">


			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">

					<h3><?= $item->bank_name; ?><?= $item->prefered === "1" ? '<small class="text-success">Compte préféré</small>' : ''; ?></h3>

				</div>

			</div>

			<div class="p-portlet-separator mt-1 mb-1"></div>

			<div class="d-block pl-4 pr-4 pt-1 pb-3">
			
				<?php if($item->bank_number > 0): ?>

					<span class="h6"><?= number_format($item->bank_number, 0, '', ' '); ?></span>

					<span class="small d-block text-muted">Num. Compte</span>

				<?php else: ?>

					<span class="small d-block"><?= $item->account_manager; ?></span>

					<span class="small d-block text-muted">Gestionnaire</span>

				<?php endif; ?>

			</div>

		</a>

	</div>

	<?php endforeach; ?>

	<?php else: ?>

	<div class="col-12 col-md-12 col-lg-12">
		
		<div class="p-portlet-dashed rounded text-center">

			<div class="d-block p-4">
			
				<a href="<?= WURI . '?r=' . $m[1] . '/nouveau-compte/'; ?>" class="btn btn-sm btn-primary p-btn-primary"><i class="fas fa-plus"></i></a>

				<span class="d-block small text-muted mt-2">Ajouter un nouveau compte bancaire</span>

			</div>	

		</div>

	</div>

	<?php endif; ?>

</div>
