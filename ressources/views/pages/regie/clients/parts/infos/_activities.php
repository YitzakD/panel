<div class="row no-gutters">

	<?php #	Relationship development ?>
	<div class="col-12 col-md-12 col-lg-12">

		<div class="row">

			<div class="col-12 col-md-6 col-lg-6">

				<div class="p-portlet rounded">

					<div class="d-block p-4 text-center">
					
						<div class="display-2"><?= $lastcamps; ?></div>

						<span class="text-muted small text-uppercase"><?= $lastcamps > 1  ? "Campagnes" : "Campagne"; ?> réaliser</span>

					</div>

				</div>	

			</div>

			<div class="col-12 col-md-6 col-lg-6">

				<div class="p-portlet rounded">

					<div class="d-block p-4 text-center">
					
						<div class="display-2"><?= $lastrsv; ?></div>

						<span class="text-muted small text-uppercase"><?= $lastrsv > 1  ? "Réservations" : "Réservation"; ?> en Attente</span>

					</div>

				</div>		

			</div>

		</div>

	</div>
	
	

	<?php #	Recents invoices ?>
	<div class="col-12 col-md-12 col-lg-12">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3>Pro-formas récentes</h3>
				</div>

			</div>


			<?php #	Contenu ?>
			<div class="p-portlet-body">

				<table class="table p-display-info-list">
					
					<tbody>

					<?php if($proformacounter > 0): ?>	
						
					<?php foreach($proformas as $item): ?>	
						
					<tr>
						
						<td class="icon"><i class="far fa-file-pdf text-danger"></i></td>

						<td class="item">PRO-FORMA N.<?= $item->pf_id; ?></td>

						<td>
										
							<form action="#" method="post" class="p-0 m-0">

								<a href="<?= WURI . '?r=proformas/infos/' . $item->id; ?>" class="btn btn-sm p-0 m-0" style="cursor: pointer;"><i class="far fa-eye"></i></a>

							</form>

						</td>

					</tr>

					<?php endforeach; ?>

					<?php else: ?>

					<tr>

						<td colspan="3" class="p-datatable-empty">Il n'y a aucunes pro-formas</td>

					</tr>

					<?php endif; ?>

					</tbody>

				</table>

			</div>	

		</div>

	</div>



	<div class="col-12 col-md-12 col-lg-12">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3>Factures récentes</h3>
				</div>

			</div>


			<?php #	Contenu ?>
			<div class="p-portlet-body">

				<table class="table p-display-info-list">
					
					<tbody>

					<?php if($invoicecounter > 0): ?>	
						
					<?php foreach($invoices as $item): ?>	
						
					<tr>
						
						<td class="icon"><i class="far fa-file-pdf text-danger"></i></td>

						<td class="item">FACTURE N.<?= '309F-' . date('jny',strtotime($item->created)) . '/<b>' . $item->pf_id . '</b>'; ?></td>

						<?php if(get_session('type') === 2): ?>
							
						<td>
										
							<a href="<?= WURI . '?r=factures/infos/' . $item->id; ?>" class="btn btn-sm btn-link p-0 m-0" style="cursor: pointer;"><i class="far fa-eye"></i></a>

						</td>
						
						<?php else: ?>

						<td></td>

						<?php endif; ?>

					</tr>

					<?php endforeach; ?>

					<?php else: ?>

					<tr>

						<td colspan="3" class="p-datatable-empty">Il n'y a aucunes factures</td>

					</tr>

					<?php endif; ?>

					</tbody>

				</table>
				
			</div>	

		</div>

	</div>

</div>	