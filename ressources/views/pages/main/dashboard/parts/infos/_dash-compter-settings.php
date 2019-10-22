<div class="row">
	
	<div class="col-12 col-md-7 col-lg-8">	

		<?php if(get_session("type") === "2"): ?>

			<div class="row">

				<div class="col-6 col-md-6 col-lg-6">

					<div class="p-portlet rounded">

						<div class="d-block pl-4 pr-4 pt-4 text-muted small">Caisse</div>

						<div class="d-block p-4">

							<?php

							$month = date('m');

							$year = date("Y");

						    $caisse = find_one("init_caisse", "month", $month, "AND year='$year'");
						    
						    $pointcaisse = find_one("point_caisse", "init_id", $caisse->id);

							?>

							<span class="d-block text-center text-muted"><?= WEBSITE_NAME; ?></span>

							<div class="text-center">

								<span class="h1 mb-4"><?= number_format($pointcaisse->mo_solde, 0, '', '.'); ?></span>

								<div class="mt-2">

									<div class="row no-gutters">
										
										<div class="col-1"></div>

										<div class="col-5">

											<div class="row no-gutters">
													
												<div class="col-2 text-right">
													<i class="fas fa-long-arrow-alt-down text-success mt-3"></i>
												</div>

												<div class="col-10">
													
													<small class="d-block text-muted">Débits</small>
													
													<strong class="text-success"><?= number_format($pointcaisse->mo_in, 0, '', '.'); ?></strong>
												</div>

											</div>

										</div>

										<div class="col-5 border-left">

											<div class="row no-gutters">

												<div class="col-10">
													
													<small class="d-block text-muted">Crédits</small>
													
													<strong class="text-danger"><?= number_format($pointcaisse->mo_out, 0, '', '.'); ?></strong>
												</div>
												
												<div class="col-2">
													<i class="fas fa-long-arrow-alt-up text-danger mt-3"></i>
												</div>

											</div>

										</div>

										<div class="col-1"></div>

									</div>

								</div>

							</div>

						</div>	
						
					</div>
						
				</div>
				
				<div class="col-6 col-md-6 col-lg-6">

					<div class="p-portlet rounded">

						<div class="d-block pl-4 pr-4 pt-4 text-muted small">Banque</div>

						<div class="d-block p-4">

							<?php

						    $bank = find_one("bank", "prefered", "1");

							$initbank = find_one("init_bank", "bank_id", $bank->id);
						    
						    $pointbank = find_one("point_bank", "init_id", $initbank->id);

							?>

							<span class="d-block text-center text-muted"><?= $bank->bank_name; ?></span>

							<div class="text-center">

								<span class="h1 mb-4"><?= number_format($pointbank->solde, 0, '', '.'); ?></span>

								<div class="mt-2">

									<div class="row no-gutters">
										
										<div class="col-1"></div>

										<div class="col-5">

											<div class="row no-gutters">
													
												<div class="col-2 text-right">
													<i class="fas fa-long-arrow-alt-down text-success mt-3"></i>
												</div>

												<div class="col-10">
													
													<small class="d-block text-muted">Crédits</small>
													
													<strong class="text-success"><?= number_format($pointbank->credit, 0, '', '.'); ?></strong>
												</div>

											</div>

										</div>

										<div class="col-5 border-left">

											<div class="row no-gutters">

												<div class="col-10">
													
													<small class="d-block text-muted">Débits</small>
													
													<strong class="text-danger"><?= number_format($pointbank->debit, 0, '', '.'); ?></strong>
												</div>
												
												<div class="col-2">
													<i class="fas fa-long-arrow-alt-up text-danger mt-3"></i>
												</div>

											</div>

										</div>

										<div class="col-1"></div>

									</div>

								</div>

							</div>

						</div>	
						
					</div>
						
				</div>

			</div>

		<?php endif; ?>
		
		<div class="row no-gutters">
			
			<div class="col-6 col-md-6 col-lg-3">

				<div class="p-portlet rounded">

					<div class="d-block p-4 text-center">
					
						<div class="display-3"><?= $signboardscounter; ?></div>

						<span class="text-muted small text-uppercase"><?= $signboardscounter > 1  ? "Faces" : "face"; ?></span>

					</div>

				</div>

			</div>

			
			<div class="col-6 col-md-6 col-lg-3">

				<div class="p-portlet rounded">

					<div class="d-block p-4 text-center">
					
						<div class="display-3"><?= $disposcounter; ?></div>

						<span class="text-muted small text-uppercase"><?= $disposcounter > 1  ? "Disponibles" : "Disponible"; ?></span>

					</div>

				</div>

			</div>

			
			<div class="col-6 col-md-6 col-lg-3">

				<div class="p-portlet rounded">

					<div class="d-block p-4 text-center">
					
						<div class="display-3"><?= $reservationscounter; ?></div>

						<span class="text-muted small text-uppercase"><?= $reservationscounter > 1  ? "Réservations" : "Réservation"; ?></span>

					</div>

				</div>

			</div>

			
			<div class="col-6 col-md-6 col-lg-3">

				<div class="p-portlet rounded">

					<div class="d-block p-4 text-center">
					
						<div class="display-3"><?= $campagnescounter; ?></div>

						<span class="text-muted small text-uppercase"><?= $campagnescounter > 1  ? "Campagnes" : "Campagne"; ?></span>

					</div>

				</div>

			</div>

		</div>

	</div>
	
	
	<div class="col-12 col-md-5 col-lg-4">

		<div class="p-portlet rounded">

			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<h3>Paramêtres de compte</h3>
				</div>

			</div>

			<div class="p-portlet-body">

				<form action="" method="post" class="p-form-table">
						
					<div class="form-group<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">
						
						<label for="upassword" class="mb-0">Taille du Menu
						<span class="d-block small text-muted">Switcher entre le menu (standard) plein et le menu mini (icone uniquement).</span></label>

						<div>
							
							<label class="p-switch p-switch-menu-box">
								
								<input type="checkbox" id="p-switch-menu" name="menumode[]" value="<?= $upref->menumode; ?>" <?= $upref->menumode === "M" ? "checked" : ""; ?>>
								
								<span class="p-switch-slider round"></span>
							
							</label>
						
						</div>

					<?= !empty($error[1]) ? '<span class="help-block mt-1">' . $error[1] . '</span>' : ''; ?>

					</div>

				</form>
				
			</div>

		</div>

	</div>


</div>