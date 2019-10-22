<div class="p-portlet rounded-top">
	
	<div class="p-portlet-invoice">
	
		<?php #	En-tête ?>
		<div class="p-portlet-invoice-head">
			
			<div class="p-invoice-containor-plus">

				<div class="p-invoice-head-brand row no-gutters">
					
					<h1 class="p-invoice-brand-title text-uppercase col-5 col-md-5 col-lg-6">Facture Proforma</h1>

					<div  class="p-invoice-logo col-7 col-md-7 col-lg-6">
						
						<a><img src="<?= WURI . 'ressources/public/media/uses/logo-p.png'; ?>"></a>

					</div>

				</div>

				<div class="p-portlet-invoice-items row no-gutters">
					
					<div class="p-invoice-item col-6 col-md-6 col-lg-6">

						<span class="p-invoice-item-subtitle">Destinataire</span>
						<span class="p-invoice-item-text">
							<?= $client->e_name; ?>
							<div class="small"><?= $client->c_name . ' (+225 ' . $client->contacts . ')'; ?></div>
						</span>

					</div>

					<div class="p-invoice-item col-6 col-md-6 col-lg-6 text-right">

						<span class="p-invoice-item-subtitle">Date</span>
						<span class="p-invoice-item-text"><?= date('j/n/Y ',strtotime(date('Y-m-d'))); ?></span>

						<span class="p-invoice-item-subtitle">PRO-FORMA N°</span>
						<span class="p-invoice-item-text"><?= 'PF-' . $proforma->pf_id; ?></span>

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

								<td class="border-right"><?= $proforma->sb_count ?></td>
								
								<td class="font-weight-bold border-right">Location d'espace publicitaire de panneau(x) <?= $proforma->sb_size . 'm²'; ?></td>

								<td class="border-right"><?= number_format($proforma->one_ht_price, 0, '', ' '); ?></td>

								<td class="border-right"></td>

								<td class="text-right"><?= number_format($this_price =(($proforma->one_ht_price * $proforma->sb_count) * $proforma->nb_month), 0, '', ' '); ?></td>

							</tr>
							
							<tr>

								<td class="border-right"></td>
								
								<td class="border-right">Type : <?= $proforma->screen_type; ?></td>

								<td class="border-right"></td>

								<td class="border-right"></td>

								<td class="text-right"></td>

							</tr>
							
							<tr>

								<td class="border-right"></td>
								
								<td class="border-right">Durée : <?= $proforma->letter_time . ' (' . $proforma->numeric_time . ') ' . 'jours'; ?></td>

								<td class="border-right"></td>

								<td class="border-right"></td>

								<td class="text-right"></td>

							</tr>
							
							<tr>

								<td class="border-right"></td>
								
								<td class="border-right">Période : <?= date('j/n/Y ',strtotime($proforma->debut)) . ' - ' . date('j/n/Y ',strtotime($proforma->fin)); ?></td>

								<td class="border-right"></td>
								<td class="border-right"></td>

								<td class="text-right"></td>

							</tr>
							
							<tr>

								<td class="border-right"></td>
								
								<td class="border-right">Remise eceptionelle : <?= $proforma->remised; ?></td>

								<td class="border-right"></td>

								<td class="border-right"><?= number_format($proforma->one_stoped_price, 0, '', ' '); ?></td>

								<td class="text-right"><?= number_format($proforma->ht_price, 0, '', ' '); ?></td>

							</tr>
							
							<?php if($proforma->agency_remised === "Oui"): ?>
							<tr>

								<td class="border-right"></td>
								
								<td class="border-right">Commission agence 15% : <?= $proforma->agency_remised; ?></td>

								<td class="border-right"></td>

								<td class="border-right"></td>

								<td class="text-right"><?= number_format($proforma->agency_remised_ht_price, 0, '', ' '); ?></td>

							</tr>
							<?php endif; ?>
							
							<?php if($proforma->int_city_count > 0): ?>
							<tr>

								<td class="border-right"><?= $proforma->int_city_count; ?></td>
								
								<td class="border-right">Transport intérieur (75 000 F/Ville)</td>

								<td class="border-right"></td>

								<td class="border-right"></td>

								<td class="text-right"><?= number_format($proforma->transport_price, 0, '', ' '); ?></td>

							</tr>
							<?php endif; ?>

							<tr><td colspan="5"></td></tr>
							
							<?php if($proforma->alcool_type === "Oui"): ?>
							<tr>

								<td class="border-right"><?= $proforma->sb_count; ?></td>
								
								<td class="border-right">TM - ALCOOL (2000/m²/Mois)</td>

								<td class="border-right"><?= number_format((2000 * $proforma->sb_size), 0, '', ' '); ?></td>

								<td class="border-right"></td>

								<td class="text-right"><?= number_format($proforma->tm_alcool_amount, 0, '', ' '); ?></td>

							</tr>
							<?php endif; ?>

							<?php if($proforma->odp === "Oui" && $proforma->odp_amount > 0): ?>
           						<?php if($proforma->alcool_type === "Non" && $proforma->tm_amount > 0): ?>
								<tr>

									<td class="border-right"><?= $proforma->sb_count; ?></td>
									
									<td class="border-right">TM (1000/m²/Mois)</td>

									<td class="border-right"><?= number_format((1000 * $proforma->sb_size), 0, '', ' '); ?></td>

									<td class="border-right"></td>

									<td class="text-right"><?= number_format($proforma->tm_amount, 0, '', ' '); ?></td>

								</tr>
        						<?php endif; ?>
							<tr>

								<td class="border-right"><?= $true_sb = $proforma->sb_count - $proforma->sb_p_count; ?></td>
								
								<td class="border-right">ODP (1000/m²/Mois)</td>

								<td class="border-right"><?= number_format((1000 * $proforma->sb_size), 0, '', ' '); ?></td>

								<td class="border-right"></td>

								<td class="text-right"><?= number_format($proforma->odp_amount, 0, '', ' '); ?></td>

							</tr>

							<?php elseif($proforma->odp === "Non" && $proforma->tm_amount > 0): ?>
							<tr>

								<td class="border-right"><?= $proforma->sb_count; ?></td>
								
								<td class="border-right">TM (1000/m²/Mois)</td>

								<td class="border-right"><?= number_format((1000 * $proforma->sb_size), 0, '', ' '); ?></td>

								<td class="border-right"></td>

								<td class="text-right"><?= number_format($proforma->tm_amount, 0, '', ' '); ?></td>

							</tr>
        					<?php endif; ?>
        
        					<?php if($proforma->odp === "Oui" && $proforma->odp_p_amount > 0 && $proforma->sb_p_count > 0): ?>
           						<?php if($proforma->alcool_type === "Non" && $proforma->tm_amount > 0): ?>
								<tr>

									<td class="border-right"><?= $proforma->sb_count; ?></td>
									
									<td class="border-right">TM (1000/m²/Mois)</td>

									<td class="border-right"><?= number_format((1000 * $proforma->sb_size), 0, '', ' '); ?></td>

									<td class="border-right"></td>

									<td class="text-right"><?= number_format($proforma->tm_amount, 0, '', ' '); ?></td>

								</tr>
        						<?php endif; ?>
							<tr>

								<td class="border-right"><?= $true_sb = $proforma->sb_p_count; ?></td>
								
								<td class="border-right">ODP-PLATEAU (4000/m²/Mois)</td>

								<td class="border-right"><?= number_format((4000 * $proforma->sb_size), 0, '', ' '); ?></td>

								<td class="border-right"></td>

								<td class="text-right"><?= number_format($proforma->odp_p_amount, 0, '', ' '); ?></td>

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
							
						<?php if($proforma->agree_tva === "Oui"): ?>
						<tr>

							<td></td>	
							<td class="text-uppercase text-right border-right">Total HT</td>
							<td class="text-right">

								<?= number_format($proforma->agency_remised_ht_price, 0, '', ' '); ?>
									
							</td>

						</tr>

							<?php if($proforma->tva > 0): ?>
							<tr>
								
								<td></td>
								<td class="text-uppercase text-right border-right">Tva (18%)</td>
								<td class="text-right"><?= number_format($proforma->tva, 0, '', ' '); ?></td>

							</tr>

							<tr>
								
								<td></td>
								<td class="text-uppercase text-right border-right">Tsp (3%)</td>
								<td class="text-right"><?= number_format($proforma->tsp, 0, '', ' '); ?></td>

							</tr>
							<?php endif; ?>

						<?php else: ?>
							
						<tr>
							
							<td></td>
							<td class="text-uppercase text-right border-right">Total HT</td>
							<td class="text-right">
								<?php
								$tht = ($proforma->agency_remised_ht_price + $proforma->transport_price + $proforma->odp_amount + $proforma->odp_p_amount + $proforma->tm_alcool_amount + $proforma->tm_amount); ?>

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

								Arrêtée la présente facture pro-forma à la somme de
								
							</td>

							<td class="text-uppercase text-right">Montant total <?= $proforma->agree_tva === "Oui" ? 'TTC' : ''; ?></td>

						</tr>

						</thead>

						<tbody>

						<tr>

							<td class="letter-ttc">

								<?php if($proforma->agree_tva === "Oui"): ?>
								
									<?= $proforma->letter_ttc_price . ' francs cfa ttc'; ?>

								<?php else: ?>
								
									<?= $proforma->letter_ttc_price . ' francs cfa'; ?>

								<?php endif; ?>
									
							</td>

							<td class="text-right font-weight-bold ttc"><?= number_format($proforma->numeric_ttc_price, 0, '', ' '); ?></td>

						</tr>
						
						</tbody>
						
					</table>
					
					<table class="table table-sm">

						<thead><tr><td colspan="3"></td></tr></thead>

						<tbody>	

							<tr>

								<td colspan="3" class="text-uppercase text-right p-hidden">

									<span class="border-left border-right border-bottom p-2">Bon pour accord</span>

								</td>

							</tr>

							<tr>

								<td colspan="3" class="min-border">
									
									<div class="small text-muted">
										<i class="text-danger font-weight-bold align-top">*</i> Tous les tarifs & montants sont exprimés en FCFA XOF
									</div>

								</td>

							</tr>

							<tr>

								<td colspan="3" class="min-border">
									
									<div class="small text-muted">
										<i class="text-danger font-weight-bold align-top">*</i> La TVA en République de Côte d'Ivoire est de 18%
									</div>

								</td>

							</tr>

							<tr>

								<td colspan="3" class="min-border">
									
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

		<div class="p-portlet-invoice-foot-page">
			
			<div class="p-invoice-containor-plus">
				
				<div class="table-responsive">
					
					<table class="table table-sm">
						
						<thead>

						<tr><td colspan="3"></td></tr>

						</thead>

						<tbody>

						<tr>

							<td colspan="3" class="text-center">

								<div>Angré Les Oscars – Cocody Abidjan, République de Côte d’Ivoire</div>
								<div>01 BP 1470 ABIDJAN 01 - Phones : <b>+225</b> 22 527 988 / 08 145 830</div>
								<div>NCC° <b>1638817V</b> - Site web : www.devafrika.com - Email : sercom.dev@devafrika.com</div>
									
							</td>

						</tr>
						
						</tbody>
						
					</table>

				</div>

			</div>

		</div>


		<div class="p-portlet-invoice-actions">
			
			<div class="p-invoice-containor-plus mb-3">

				<?php if($proforma->state === "Non" || $proforma->state === "Attente"): ?>

				<form action="" method="post" class="d-inline p-0 m-0">
					<input type="hidden" name="HID" value="<?= $ID; ?>">
					<button type="submit" name="releasesubmit" class="btn btn-primary p-btn-primary-outline">Confirmer</button>
				</form>

				<?php else: ?>

				<a href="<?= WURI . 'export.php/' . $m[1] . '/details/' . $ID . '/'; ?>" target="_blank" class="btn btn-primary p-btn-primary-outline">Sauvegarder</a>

				<?php endif;  ?>
				

				<a href="<?= WURI . 'export.php/' . $m[1] . '/details/' . $ID . '/'; ?>" target="_blank" class="btn btn-primary p-btn-primary float-right p-hidden"><i class="fas fa-download"></i></a>
				
				<button type="button" class="btn btn-primary p-btn-primary float-right mr-2 p-hidden" onclick="window.print();">Imprimer</button>

			</div>
			
		</div>

	</div>

</div>