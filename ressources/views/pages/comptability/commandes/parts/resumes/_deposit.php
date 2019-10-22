<div class="p-portlet rounded-top">
	
	<div class="p-portlet-invoice">
	
		<?php #	En-tête ?>
		<div class="p-portlet-invoice-head">
			
			<div class="p-invoice-containor">

				<div class="p-invoice-head-brand row no-gutters">
					
					<h1 class="p-invoice-brand-title text-uppercase col-5 col-md-5 col-lg-6">Résumé de transactions</h1>

					<div  class="p-invoice-logo col-7 col-md-7 col-lg-6">
						
						<a><img src="<?= WURI . 'ressources/public/media/uses/logo-p.png'; ?>"></a>

					</div>

				</div>

				<div class="p-portlet-invoice-items row no-gutters">
					
					<div class="p-invoice-item col-6 col-md-6 col-lg-6">

						<span class="p-invoice-item-subtitle">Destinataire</span>
						<span class="p-invoice-item-text">
							<?= $provider->p_name; ?>
							<div class="small"><?= $provider->c_name . ' (+225 ' . $provider->contacts . ')'; ?></div>
						</span>

					</div>

					<div class="p-invoice-item col-6 col-md-6 col-lg-6 text-right">

						<span class="p-invoice-item-subtitle">Date</span>
						<span class="p-invoice-item-text"><?= date('j/n/Y ',strtotime(date('Y-m-d'))); ?></span>

						<span class="p-invoice-item-subtitle">BON N°</span>
						<span class="p-invoice-item-text"><?= 'BC-' . $commande->bc_id; ?></span>

					</div>

				</div>

			</div>

		</div>


		<?php #	Corps ?>
		<div class="p-portlet-invoice-body">
			
			<div class="p-invoice-containor">

				<?php if($depositcounter > 0): ?>
				
				<div class="table-responsive">
					
					<table class="table table-sm">
						
						<thead>

							<tr>

								<td class="text-uppercase">Date</td>

								<td class="text-uppercase text-right">Montant</td>

							</tr>

						</thead>

						<tbody>
							
							<tr>
								
								<td><?= date('j/n/Y ',strtotime($deposit->created)); ?></td>

								<td class="text-right"><?= number_format($deposit->deposit_amount, 0, '', ' '); ?></td>

							</tr>

						</tbody>

					</table>

				</div>

				<?php endif; ?>

			</div>

		</div>


		<?php #	Pied ?>
		<div class="p-portlet-invoice-foot">
			
			<div class="p-invoice-containor">
				
				<div class="table-responsive">
					
					<table class="table table-sm">
						
						<thead>

							<tr>

								<td class="text-uppercase">Montant dû</td>

								<td class="text-uppercase">Total Verséments</td>

								<td class="text-uppercase text-right">Reste à Payer</td>

							</tr>

						</thead>

						<tbody>

							<tr>

								<td class="font-weight-bold text-muted ttc"><?= number_format($statement->ttc, 0, '', ' '); ?></td>

								<td class="font-weight-bold text-success ttc"><?= number_format($statement->tac, 0, '', ' '); ?></td>

								<td class="text-right font-weight-bold text-danger ttc"><?= number_format($statement->rap, 0, '', ' '); ?></td>

							</tr>

							<tr>

								<td colspan="3">
									
									<div class="small text-muted">
										
										<i class="text-danger font-weight-bold align-top">*</i> Tous les tarifs & montants sont exprimés en FCFA XOF

									</div>

								</td>

							</tr>

						</tbody>

					</table>

				</div>

			</div>

		</div>

		<div class="p-portlet-invoice-actions">
			
			<div class="p-invoice-containor">

				<button type="button" class="btn btn-primary p-btn-primary-outline" onclick="window.print();">Sauvegarder</button>
				
				<button type="button" class="btn btn-primary p-btn-primary float-right" onclick="window.print();">Imprimer</button>

			</div>
			
		</div>

	</div>

</div>