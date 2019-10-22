<div class="p-portlet rounded-top">
	
	<div class="p-portlet-invoice">
	
		<?php #	En-tête ?>
		<div class="p-portlet-invoice-head">
			
			<div class="p-invoice-containor">

				<div class="p-invoice-head-brand row no-gutters">
					
					<h1 class="p-invoice-brand-title text-uppercase col-5 col-md-5 col-lg-6">BON DE COMMANDE</h1>

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
				
				<div class="table-responsive">
					
					<table class="table table-sm">
						
						<thead>

							<tr>

								<td class="text-uppercase">Description</td>
								
								<td class="text-uppercase">Qte</td>
								
								<td class="text-uppercase">Tarif</td>

								<td class="text-uppercase text-right">Montant</td>

							</tr>

						</thead>

						<tbody>
							
							<tr>
								
								<td>

									<?= $commande->description; ?>
									<div class="small mt-1"><?= $commande->dating; ?></div>

								</td>

								<td><?= $commande->qte ?></td>

								<td><?= number_format($commande->pu, 0, '', ' '); ?></td>

								<td class="text-right"><?= number_format($commande->ht, 0, '', ' '); ?></td>

							</tr>

						</tbody>

					</table>
					
					<table class="table table-sm">

						<thead>
							
							<tr>

								<td class="text-uppercase text-right">Taxes</td>

								<td></td>

							</tr>

						</thead>

						<tbody>

							<?php if($commande->odp > 0): ?>
							<tr>
								
								<td class="text-uppercase text-right">ODP</td>
								<td class="text-right"><?= number_format($commande->odp, 0, '', ' '); ?></td>

							</tr>

							<tr>
								
								<td class="text-uppercase text-right">TM</td>
								<td class="text-right"><?= number_format($commande->tm, 0, '', ' '); ?></td>

							</tr>
							<?php endif; ?>

							<?php if($commande->transport > 0): ?>
							<tr>
								
								<td class="text-uppercase text-right">Transport</td>
								<td class="text-right"><?= number_format($commande->transport, 0, '', ' '); ?></td>

							</tr>
							<?php endif; ?>

							<?php if($commande->other_tax === "Oui"): ?>
							<tr>
								
								<td class="text-uppercase text-right"><?= $commande->other_tax_name ?></td>
								<td class="text-right"><?= number_format($commande->other_tax_amount, 0, '', ' '); ?></td>

							</tr>
							<?php endif; ?>

							<?php if($commande->tva > 0): ?>
							<tr>
								
								<td class="text-uppercase text-right">Tva (18%)</td>
								<td class="text-right"><?= number_format($commande->tva, 0, '', ' '); ?></td>

							</tr>

							<tr>
								
								<td class="text-uppercase text-right">Tsp (3%)</td>
								<td class="text-right"><?= number_format($commande->tsp, 0, '', ' '); ?></td>

							</tr>
							<?php endif; ?>

						</tbody>

					</table>

				</div>

			</div>

		</div>


		<?php #	Pied ?>
		<div class="p-portlet-invoice-foot">
			
			<div class="p-invoice-containor">
				
				<div class="table-responsive">
					
					<table class="table table-sm">
						
						<thead>

							<tr>

								<td></td>

								<td class="text-uppercase text-right">Montant total</td>

							</tr>

						</thead>

						<tbody>

							<tr>

								<td>
									
									<div class="small text-muted">
										
										<i class="text-danger font-weight-bold align-top">*</i> Tous les tarifs & montants sont exprimés en FCFA XOF

									</div>

								</td>

								<td class="text-right font-weight-bold text-danger ttc"><?= number_format($commande->ttc, 0, '', ' '); ?></td>

							</tr>

						</tbody>

					</table>

				</div>

			</div>

		</div>


		<div class="p-portlet-invoice-actions">
			
			<div class="p-invoice-containor">

				<a href="<?= WURI . '?r=' . $m[1] . '/transaction/' . $ID . '/'; ?>" class="btn btn-primary p-btn-primary-outline">Versements</a>


				<a href="<?= WURI . 'export.php/' . $m[1] . '/details/' . $ID . '/'; ?>" target="_blank" class="btn btn-primary p-btn-primary float-right"><i class="fas fa-download"></i></a>
				
				<button type="button" class="btn btn-primary p-btn-primary float-right p-hidden mr-2" onclick="window.print();">Imprimer</button>

			</div>
			
		</div>

	</div>

</div>