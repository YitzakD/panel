<div class="p-inner-main-subheader">

	<div class="p-inner-main-containor">

		<div class="p-inner-main-containor-main">

			<h3 class="p-inner-main-containor-main-title">Paramètres</h3>

			<span class="p-inner-main-containor-main-separator sr-only"></span>

			<div class="p-breadcrumbs">
				
				<a href="<?= WURI . '?r=' . $m[1] . '/'; ?>" class="p-breadcrumb-home"><i class="fas fa-home"></i></a>

				<span class="p-breadcrumb-separator"></span>

				<a href class="p-breadcrumb-link"><?= ucfirst($m[1]); ?></a>

				<?php if(isset($con)): ?>
					
					<?php if($con != "nouveau"): ?>

						<?php if(preg_match('(&s=[0-9]+)', $con)): ?>

						<span class="p-breadcrumb-separator"></span>

						<a href class="p-breadcrumb-link p-breadcrumb-link-active">Liste</a>

						<span class="p-breadcrumb-separator"></span>

						<a href class="p-breadcrumb-link">Suite - (Page <?= $current; ?>)</a>

						<?php else: ?>

						<span class="p-breadcrumb-separator"></span>

						<a href class="p-breadcrumb-link p-breadcrumb-link-active"><?= ucfirst($con); ?></a>

							<?php if(isset($ID)): ?>

								<?php if(!preg_match('(&s=[0-9]+)', $ID)): ?>

								<span class="p-breadcrumb-separator"></span>

								<a href class="p-breadcrumb-link"><?= $size->size; ?></a>

								<?php endif; ?>

							<?php endif; ?>

						<?php endif; ?>

					<?php else: ?>

					<span class="p-breadcrumb-separator"></span>

					<a href class="p-breadcrumb-link p-breadcrumb-link-active"><?= ucfirst($con); ?></a>

					<?php endif; ?>

				<?php else: ?>

				<span class="p-breadcrumb-separator"></span>

				<a href class="p-breadcrumb-link p-breadcrumb-link-active">Liste</a>

				<?php endif; ?>

			</div>

		</div>

	</div>

</div>