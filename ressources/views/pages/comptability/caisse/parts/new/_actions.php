<?php if(is_already_use("init_caisse", "month", $_month, " AND year='$_year'")): ?>

	<div class="p-portlet rounded">

		<?php $lastpoint = find_last("point_caisse"); ?>
		<?php $initcaisseinfo = find_one("init_caisse", "id", $lastpoint->init_id); ?>
	
		<?php #	En-tête ?>
		<div class="p-portlet-head">
			
			<div class="p-portlet-head-label">
				<h3>

					<?= month_convert($initcaisseinfo->month); ?>
					<small><?= $initcaisseinfo->year; ?></small>
					
				</h3>
			</div>

		</div>
		
		
		<?php #	Contenu ?>
		<div class="p-portlet-body">
			
			<table class="table p-datatable">

				<thead>

					<tr>

						<th scope="col">

							<i class="fas fa-long-arrow-alt-up text-success"></i> Débit

						</th>

						<th scope="col">

							<i class="fas fa-long-arrow-alt-down text-danger"></i> Crédit

						</th>

						<th scope="col">

							<i class="fas fa-long-arrow-alt-up text-success"></i><i class="fas fa-long-arrow-alt-down text-danger"></i> Solde

						</th>

					</tr>

				</thead>

				<tbody>
					
					<tr>
						
						<td class="font-weight-bold text-success"><?= number_format($lastpoint->mo_new_solde + $lastpoint->mo_in, 0, '', ' '); ?></td>
					
						<td class="font-weight-bold text-danger"><?= number_format($lastpoint->mo_out, 0, '', ' '); ?></td>

						<td class="font-weight-bold text-info"><?= number_format($lastpoint->mo_solde, 0, '', ' '); ?></td>
					
					</tr>

				</tbody>

			</table>

		</div>

	</div>

<?php endif; ?>