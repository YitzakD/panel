<div class="row">
	
	<div class="col-12 col-md-6 col-lg-5">	

		<div class="p-portlet rounded p-portlet-min">

			<div class="p-portlet-head pt-3">				
				
				<div class="p-portlet-head-label">
					<h3>Compte bancaire<?= $bank->prefered === "1" ? '<small class="text-success">Préféré</small>' : ''; ?></h3>
				</div>

				<div class="p-portlet-head-toolbar">
					
					<div class="dropdown">
						
						<button class="btn btn-sm btn-primary p-btn-primary" type="button" id="portleToolbar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="portleToolbar">

							<h6 class="dropdown-header">Actions rapides</h6>

							<a class="dropdown-item" href="<?= WURI . '?r=' . $m[1] . '/liste/' . $bank->bankhash . '/'; ?>"><i class="fas fa-exchange-alt p-portlet-head-toolbar-dropdown-icon mr-3"></i>Liste</a>

							<a class="dropdown-item" href="<?= WURI . 'export.php/' . $m[1] . '/details/' . $pointbank->init_id . '/' . $initbank->bankhash . '/' ?>" target="_blank"><i class="fas fa-print p-portlet-head-toolbar-dropdown-icon mr-3"></i>Exporter</a>

						</div>

					</div>

				</div>

			</div>

			<div class="d-block pl-4 pr-4 pb-4">
				
				<div class="lead"><?= $bank->bank_name; ?> - <?= number_format($pointbank->solde, 0, '', '.') . " F"; ?></div>

				<span class="small text-muted"><?= $bank->account_manager; ?></span>

				<div class="d-block">
				
					<span class="d-inline-block">Téléphone</span>

					<span class="d-inline-block float-right">E-mail</span>

				</div>

				<div class="d-block">
				
					<a href class="small d-inline-block"><?= $am_phone ?></a>

					<a href class="small d-inline-block float-right"><?= $am_mail ?></a>

				</div>

			</div>

		</div>

		<div class="p-portlet rounded p-bank-transactions">

			<?php if(count($moovsbank) > 0): ?>

			<div class="row no-gutters">

				<span class="col-6 col-md-6 col-lg-6 small text-muted">Ce mois-ci</span>	
				
				<span class="col-6 col-md-6 col-lg-6 small text-right"><a href="<?= WURI . '?r=' . $m[1] . '/infos/' . $pointbank->init_id . '/' . $bank->bankhash . '/'; ?>">Tout voir</a></span>

			</div>

			<div class="p-bank-inner-transactions">

			<?php foreach($moovsbank as $item): ?>

				<div class="p-bank-transactions-item rounded row no-gutters">
					
					<span class=" col-6">

						<?= nl2br($item->description); ?>
						<span class="d-block small text-muted"><?= set_time($item->created); ?></span>

					</span>

					<span class="col-5 text-right <?= $item->typeof === '1' ? 'text-success' : 'text-danger'; ?>">


						<?= $item->typeof === "1" ? "+" . number_format($item->amount, 0, '', ' ') : "-" .  number_format($item->amount, 0, '', '.'); ?>

					</span>

					<span class="col-1 text-right">

						<button class="btn btn-sm btn-link p-0 m-0" id="<?= $item->id; ?>" style="cursor: pointer;" data-toggle="modal" data-target="#myModal<?= $item->id ?>"><i class="fas fa-times"></i></button>

						<div class="modal fade p-confirm-modal-sm" id="myModal<?= $item->id ?>" tabindex="-1" role="dialog" aria-labelledby="Teste" aria-hidden="true">

							<div class="modal-dialog modal-sm modal-dialog-centered" role="document">

								<div class="modal-content">

									<h3 class="p-modal-head"><i class="fas fa-exclamation-circle text-danger icon"></i></h3>

									<div class="h5">Êtes-vous sûre?</div>

									<div class="p text-muted mb-4 font-weight-light">Vous ne pourrez pas revenir en arrière!</div>


									<form action="<?= WURI . '?r=' . $m[1] . '/suppression/saisie/' . $bank->bankhash. '/'; ?>" method="post" class="p-3 mb-2">

										<input type="hidden" name="SHID" value="<?= $item->id; ?>">

										<button type="submit" class="btn btn-sm btn-primary">Oui, supprimez!</button>

										<button type="reset" class="btn btn-sm btn-light border"  data-dismiss="modal">Annuler</button>

									</form>

								</div>

							</div>

						</div>

					</span>

				</div>	

			<?php endforeach; ?>

			</div>

			<?php else: ?>

				<p class="small text-center text-muted font-weight-bold">Aucune transactions repertoriées.</p>

			<?php endif; ?>

		</div>	

	</div>
	
	<div class="col-12 col-md-6 col-lg-7">

		<div class="row">
			
			<div class="col-12 col-lg-6">
				
				<div class="p-portlet rounded p-portlet-min p-4 text-success">
	
					<div class="d-block lead font-weight-bold"><?= number_format($pointbank->credit, 0, '', '.') . " F"; ?></div>

					<span class="small text-muted">Credit</span>

				</div>

			</div>

			<div class="col-12 col-lg-6">
				
				<div class="p-portlet rounded p-portlet-min p-4 text-danger">
	
					<div class="d-block lead font-weight-bold"><?= number_format($pointbank->debit, 0, '', '.') . " F"; ?></div>

					<span class="small text-muted">Debit</span>

				</div>

			</div>

		</div>
		
		<div class="p-portlet rounded p-portlet-min">
			
			<div class="d-block p-4">
				
				<form action="" method="post" class="p-form-table">

					<div class="form-row">

						<div class="form-group col-12 col-lg-4 mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

							<label for="typeof" class="mb-0">Type</label>

							<select name="typeof" class="form-control p-form-ctrl p-form-ctrl-sm">
								
								<option value="2">Débit</option>

								<option value="1">Crédit</option>
							
							</select>

						<?= !empty($error[1]) ? '<span class="help-block mt-1">' . $error[1] . '</span>' : ''; ?>

						</div>
							
						<div class="form-group col-12 col-lg-8 mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

							<label for="amount" class="mb-0">Montant&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

							<input type="number" name="amount" id="amount" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("amount"); ?>" placeholder="Entrez le montant" autocomplete="off" autofocus required />

						<?= !empty($error[2]) 
							? '<span class="help-block mt-1">' . $error[2] . '</span>' 
							: '<small class="text-muted">Entrez le montant de la transaction.</small>'; 
						?>

						</div>

					</div>
						
					<div class="form-group mb-3<?= !empty($error) && count($error[3]) != 0 ? ' has-error' : '';  ?>">

						<label for="about" class="mb-0">Description&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

						<textarea name="about" class="form-control p-form-ctrl p-form-ctrl-sm" placeholder="Entrez les informations" required><?= get_input("about"); ?></textarea>

					<?= !empty($error[3]) 
						? '<span class="help-block mt-1">' . $error[3] . '</span>' 
						: '<small class="text-muted">Entrez les informations complémentaires sur la transaction.</small>'; 
					?>

					</div>


					<button type="submit" name="bankmoovsubmit" class="btn btn-sm btn-primary p-btn-primary p-pill-submit">Déclarer</button>

				</form>

			</div>

		</div>

	</div>

</div>