<div class="p-portlet rounded-top">
	
	<div class="p-portlet-invoice">
	
		<?php #	En-tête ?>
		<div class="p-portlet-invoice-head p-portlet-invoice-real-head">
			
			<div class="p-invoice-containor-plus">

				<div class="p-invoice-head-brand row no-gutters">
					
					<h1 class="p-invoice-brand-title text-uppercase col-5 col-md-5 col-lg-6">Facture</h1>

					<div  class="p-invoice-logo col-7 col-md-7 col-lg-6">
						
						<a><img src="<?= WURI . 'ressources/public/media/uses/logo-p.png'; ?>"></a>

					</div>

				</div>

				<div class="p-portlet-invoice-items row no-gutters">
					
					<div class="p-invoice-item col-6 col-md-6 col-lg-6">

						<span class="p-invoice-item-subtitle">Destinataire</span>
						<span class="p-invoice-item-text">
							<?= $client->e_name; ?>
							<div class="small"><?= 'NCC° <b>' . $client->cc . '</b><br>' . $client->bp; ?></div>
						</span>

					</div>

					<div class="p-invoice-item col-6 col-md-6 col-lg-6 text-right">

						<span class="p-invoice-item-subtitle">Date</span>
						<span class="p-invoice-item-text"><?= date('j/n/Y ',strtotime(date('Y-m-d'))); ?></span>

					</div>

				</div>

			</div>

		</div>


		<?php #	Corps ?>
		<div class="p-portlet-invoice-body">
			
			<div class="p-invoice-containor-plus">
				
				<div class="table-responsive">
					
					<table class="table table-sm">
						
						<thead>

							<tr>
								
								<td class="text-uppercase">Qte</td>

								<td class="text-uppercase">Désignation</td>
								
								<td class="text-uppercase">Tarif HT / Mois</td>

								<td class="text-uppercase">Ap. Remise</td>

								<td class="text-uppercase text-right">Montant</td>

							</tr>

						</thead>

						<tbody>
							
							<tr>

								<td class="border-right"><?= $facture->sb_count ?></td>
								
								<td class="font-weight-bold border-right">Location d'espace publicitaire de panneau(x) <?= $facture->sb_size . 'm²'; ?></td>

								<td class="border-right"><?= number_format($facture->one_ht_price, 0, '', ' '); ?></td>

								<td class="border-right"></td>

								<td class="text-right"><?= number_format($this_price =(($facture->one_ht_price * $facture->sb_count) * $facture->nb_month), 0, '', ' '); ?></td>

							</tr>
							
							<tr>

								<td class="border-right"></td>
								
								<td class="border-right">Type : <?= $facture->screen_type; ?></td>

								<td class="border-right"></td>

								<td class="border-right"></td>

								<td class="text-right"></td>

							</tr>
							
							<tr>

								<td class="border-right"></td>
								
								<td class="border-right">Durée : <?= $facture->letter_time . ' (' . $facture->numeric_time . ') ' . 'jours'; ?></td>

								<td class="border-right"></td>

								<td class="border-right"></td>

								<td class="text-right"></td>

							</tr>
							
							<tr>

								<td class="border-right"></td>
								
								<td class="border-right">Période : <?=date('j/n/Y ',strtotime($facture->debut)) . ' - ' . date('j/n/Y ',strtotime($facture->fin)); ?></td>

								<td class="border-right"></td>
								<td class="border-right"></td>

								<td class="text-right"></td>

							</tr>
							
							<tr>

								<td class="border-right"></td>
								
								<td class="border-right">Remise eceptionelle : <?= $facture->remised; ?></td>

								<td class="border-right"></td>

								<td class="border-right"><?= number_format($facture->one_stoped_price, 0, '', ' '); ?></td>

								<td class="text-right"><?= number_format($facture->ht_price, 0, '', ' '); ?></td>

							</tr>
							
							<?php if($facture->agency_remised === "Oui"): ?>
							<tr>

								<td class="border-right"></td>
								
								<td class="border-right">Commission agence 15% : <?= $facture->agency_remised; ?></td>

								<td class="border-right"></td>

								<td class="border-right"></td>

								<td class="text-right"><?= number_format($facture->agency_remised_ht_price, 0, '', ' '); ?></td>

							</tr>
							<?php endif; ?>
							
							<?php if($facture->int_city_count > 0): ?>
							<tr>

								<td class="border-right"><?= $facture->int_city_count; ?></td>
								
								<td class="border-right">Transport intérieur (75 000 F/Ville)</td>

								<td class="border-right"></td>

								<td class="border-right"></td>

								<td class="text-right"><?= number_format($facture->transport_price, 0, '', ' '); ?></td>

							</tr>
							<?php endif; ?>

							<tr><td colspan="5"></td></tr>
							
							<?php if($facture->alcool_type === "Oui"): ?>
							<tr>

								<td class="border-right"><?= $facture->sb_count; ?></td>
								
								<td class="border-right">TM - ALCOOL (2000/m²/Mois)</td>

								<td class="border-right"><?= number_format((2000 * $facture->sb_size), 0, '', ' '); ?></td>

								<td class="border-right"></td>

								<td class="text-right"><?= number_format($facture->tm_alcool_amount, 0, '', ' '); ?></td>

							</tr>
							<?php endif; ?>

							<?php if($facture->odp === "Oui" && $facture->odp_amount > 0): ?>
           						<?php if($facture->alcool_type === "Non" && $facture->tm_amount > 0): ?>
								<tr>

									<td class="border-right"><?= $facture->sb_count; ?></td>
									
									<td class="border-right">TM (1000/m²/Mois)</td>

									<td class="border-right"><?= number_format((1000 * $facture->sb_size), 0, '', ' '); ?></td>

									<td class="border-right"></td>

									<td class="text-right"><?= number_format($facture->tm_amount, 0, '', ' '); ?></td>

								</tr>
        						<?php endif; ?>
							<tr>

								<td class="border-right"><?= $true_sb = $facture->sb_count - $facture->sb_p_count; ?></td>
								
								<td class="border-right">ODP (1000/m²/Mois)</td>

								<td class="border-right"><?= number_format((1000 * $facture->sb_size), 0, '', ' '); ?></td>

								<td class="border-right"></td>

								<td class="text-right"><?= number_format($facture->odp_amount, 0, '', ' '); ?></td>

							</tr>

							<?php elseif($facture->odp === "Non" && $facture->tm_amount > 0): ?>
							<tr>

								<td class="border-right"><?= $facture->sb_count; ?></td>
								
								<td class="border-right">TM (1000/m²/Mois)</td>

								<td class="border-right"><?= number_format((1000 * $facture->sb_size), 0, '', ' '); ?></td>

								<td class="border-right"></td>

								<td class="text-right"><?= number_format($facture->tm_amount, 0, '', ' '); ?></td>

							</tr>
        					<?php endif; ?>
        
        					<?php if($facture->odp === "Oui" && $facture->odp_p_amount > 0 && $facture->sb_p_count > 0): ?>
           						<?php if($facture->alcool_type === "Non" && $facture->tm_amount > 0): ?>
								<tr>

									<td class="border-right"><?= $facture->sb_count; ?></td>
									
									<td class="border-right">TM (1000/m²/Mois)</td>

									<td class="border-right"><?= number_format((1000 * $facture->sb_size), 0, '', ' '); ?></td>

									<td class="border-right"></td>

									<td class="text-right"><?= number_format($facture->tm_amount, 0, '', ' '); ?></td>

								</tr>
        						<?php endif; ?>
							<tr>

								<td class="border-right"><?= $true_sb = $facture->sb_p_count; ?></td>
								
								<td class="border-right">ODP-PLATEAU (4000/m²/Mois)</td>

								<td class="border-right"><?= number_format((4000 * $facture->sb_size), 0, '', ' '); ?></td>

								<td class="border-right"></td>

								<td class="text-right"><?= number_format($facture->odp_p_amount, 0, '', ' '); ?></td>

							</tr>
        					<?php endif; ?>

						</tbody>

					</table>

					<table class="table table-sm">

						<thead>

						<tr>

							<td class="text-uppercase">Récapitulative</td>

							<td></td>

							<td></td>

						</tr>

						</thead>

						<tbody>
							
						<?php if($facture->agree_tva === "Oui"): ?>
						<tr>

							<td></td>	
							<td class="text-uppercase text-right border-right">Total HT</td>
							<td class="text-right">

								<?= number_format($facture->agency_remised_ht_price, 0, '', ' '); ?>
									
							</td>

						</tr>

							<?php if($facture->tva > 0): ?>
							<tr>
								
								<td></td>
								<td class="text-uppercase text-right border-right">Tva (18%)</td>
								<td class="text-right"><?= number_format($facture->tva, 0, '', ' '); ?></td>

							</tr>

							<tr>
								
								<td></td>
								<td class="text-uppercase text-right border-right">Tsp (3%)</td>
								<td class="text-right"><?= number_format($facture->tsp, 0, '', ' '); ?></td>

							</tr>
							<?php endif; ?>

						<?php else: ?>
							
						<tr>
							
							<td></td>
							<td class="text-uppercase text-right border-right">Total HT</td>
							<td class="text-right">
								<?php
								$tht = ($facture->agency_remised_ht_price + $facture->transport_price + $facture->odp_amount + $facture->odp_p_amount + $facture->tm_alcool_amount + $facture->tm_amount); ?>

								<?= number_format($tht, 0, '', ' '); ?>
									
							</td>

						</tr>

						<?php endif; ?>

						</tbody>

					</table>
				</div>

			</div>

		</div>


		<?php #	Pied ?>
		<div class="p-portlet-invoice-foot">
			
			<div class="p-invoice-containor-plus">
				
				<div class="table-responsive">
					
					<table class="table table-sm">
						
						<thead>

						<tr>

							<td class="text-uppercase">

								Arrêtée la présente facture à la somme de
								
							</td>

							<td class="text-uppercase text-right">Montant total <?= $facture->agree_tva === "Oui" ? 'TTC' : ''; ?></td>

						</tr>

						</thead>

						<tbody>

						<tr>

							<td class="letter-ttc">

								<?php if($facture->agree_tva === "Oui"): ?>
								
									<?= $facture->letter_ttc_price . ' francs cfa ttc'; ?>

								<?php else: ?>
								
									<?= $facture->letter_ttc_price . ' francs cfa'; ?>

								<?php endif; ?>
									
							</td>

							<td class="text-right font-weight-bold ttc"><?= number_format($facture->numeric_ttc_price, 0, '', ' '); ?></td>

						</tr>

						<tr>

							<td colspan="2" class="min-border">
									
								<div class="small text-muted">
									<i class="text-danger font-weight-bold align-top">*</i> Tous les tarifs & montants sont exprimés en FCFA XOF
								</div>
									
								<div class="small text-muted">
									<i class="text-danger font-weight-bold align-top">*</i> La TVA en République de Côte d'Ivoire est de 18%
								</div>

								<div class="small text-muted">
									<i class="text-danger font-weight-bold align-top">*</i> La TSP désigne la TAXE SUR LA PUBLICITE, elle est de 3%
								</div>


							</td>
							
						</tr>
						
						</tbody>
						
					</table>

				</div>

			</div>

		</div>


		<div class="p-portlet-invoice-actions">
			
			<div class="p-invoice-containor-plus">

				<?php if(get_session('type') === '2'): ?>

					<a href="<?= WURI . '?r=' . $m[1] . '/transaction/' . $ID . '/'; ?>" class="btn btn-primary p-btn-primary-outline">Versements</a>

				<?php else: ?>

					<a href="<?= WURI . 'export.php/' . $m[1] . '/details/' . $ID . '/'; ?>" target="_blank" class="btn btn-primary p-btn-primary-outline">Sauvegarder</a>

				<?php endif; ?>

				<!-- ##### -->

				<?php if(get_session('type') === '2'): ?>

					<a href="<?= WURI . 'export.php/' . $m[1] . '/details/' . $ID . '/'; ?>" target="_blank" class="btn btn-primary p-btn-primary float-right"><i class="fas fa-download"></i></a>

				<?php endif; ?>

				<button type="button" class="btn btn-primary p-btn-primary float-right mr-2 p-hidden" onclick="window.print();">Imprimer</button>


			</div>
			
		</div>

	</div>

</div>