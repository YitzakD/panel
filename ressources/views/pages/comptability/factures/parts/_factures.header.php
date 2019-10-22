<div class="p-inner-main-subheader row">

	<div class="p-inner-main-containor col-12 col-md-6 col-lg-7">

		<div class="p-inner-main-containor-main">

			<h3 class="p-inner-main-containor-main-title">Comptabilité</h3>

			<span class="p-inner-main-containor-main-separator sr-only"></span>

			<div class="p-breadcrumbs">
				
				<a href="<?= WURI . '?r=' . $m[1] . '/'; ?>" class="p-breadcrumb-home"><i class="fas fa-home"></i></a>

				<span class="p-breadcrumb-separator"></span>

				<a href class="p-breadcrumb-link"><?= ucfirst($m[1]); ?></a>

				<?php if(isset($con)): ?>

					<?php if(preg_match('(&s=[0-9]+)', $con)): ?>

					<span class="p-breadcrumb-separator"></span>

					<a href class="p-breadcrumb-link p-breadcrumb-link-active">Liste</a>

					<span class="p-breadcrumb-separator"></span>

					<a href class="p-breadcrumb-link">Suite - (Page <?= $current; ?>)</a>

					<?php elseif(preg_match('(client-transactions)', $con)): ?>

					<span class="p-breadcrumb-separator"></span>

					<a href class="p-breadcrumb-link p-breadcrumb-link-active"><?= ucfirst('Transaction du client'); ?></a>

					<span class="p-breadcrumb-separator"></span>

					<a href class="p-breadcrumb-link"><?= $client->e_name; ?></a>


					<?php else: ?>

					<span class="p-breadcrumb-separator"></span>

					<a href class="p-breadcrumb-link p-breadcrumb-link-active"><?= ucfirst($con); ?></a>

						<?php if(isset($ID)): ?>

							<?php if(!preg_match('(&s=[0-9]+)', $ID)): ?>

							<span class="p-breadcrumb-separator"></span>

							<a href class="p-breadcrumb-link"><?= 'F-' . $facture->pf_id; ?></a>

							<?php endif; ?>

						<?php endif; ?>

					<?php endif; ?>

				<?php else: ?>

				<span class="p-breadcrumb-separator"></span>

				<a href class="p-breadcrumb-link p-breadcrumb-link-active">Liste</a>

				<?php endif; ?>

			</div>

		</div>

	</div>

	<?php if(!isset($con)): ?>

	<div class="p-inner-main-toolbar col-12 col-md-6 col-lg-5">

		<div class="p-inner-main-toolbar-main">
			
			<div class="input-group">

				<i class="fas fa-spinner fa-pulse mr-4" style="margin-top: 9px;" id="p-spinner"></i>

				<input type="text" id="sb-search-input-plus" class="form-control p-form-ctrl p-form-ctrl-sm" placeholder="Dites-nous ce que vous recherchez">
				
				<span class="input-group-addon input-ga-select rounded-right font-weight-bold"><i class="fas fa-search"></i></span>

			</div>

		</div>

	</div>

	<?php elseif(isset($con) && $con === "infos"): ?>

	<div class="p-inner-main-toolbar col-12 col-md-6 col-lg-5">

		<div class="p-inner-main-toolbar-main text-right">

			<a href="<?= WURI . '?r=' . $m[1] . '/'. $con . '/' . $prev->id . '/'; ?>" class="btn btn-sm btn-primary p-btn-primary <?= is_null($prev->id) ? 'disabled' : ''; ?> mr-1" style="padding: .3rem .75rem;"><i class="fas fa-angle-left"></i></a>

			<a href="<?= WURI . '?r=' . $m[1] . '/'. $con . '/' . $next->id . '/'; ?>" class="btn btn-sm btn-primary p-btn-primary <?= is_null($next->id) ? 'disabled' : ''; ?> ml-1" style="padding: .3rem .75rem;"><i class="fas fa-angle-right"></i></a>

		</div>	

	</div>

	<?php endif; ?>

</div>