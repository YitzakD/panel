<?php if($jan > 0): ?>

<div class="row">
	
	<div class="col-12 col-md-12 col-lg-12">

		<div class="p-portlet rounded p-4">
		
			<span class="d-block mb-4 small text-muted text-uppercase"><span data-toggle="tooltip" data-placement="right" title="Campagnes réalisées">―&nbsp;&nbsp;Cette année</span></span>


			<div class="p-dash-graph">
				

				<div class="p-graph-item text-center">

					<div class="p-gi-bar-item">

						<?php $janpercent = (($jan*100)/$a); ?>
						
						<div class="p-bar-item" style="height: <?= $janpercent; ?>%" data-toggle="tooltip" data-placement="left" title="Janvier: <?= $jan ?>"></div>

					</div>

					<small class="text-muted">J</small>

				</div>
				
				<div class="p-graph-item text-center">

					<div class="p-gi-bar-item">

						<?php $fevpercent = (($fev*100)/$a); ?>
						
						<div class="p-bar-item" style="height: <?= $fevpercent; ?>%" data-toggle="tooltip" data-placement="left" title="Février: <?= $fev ?>"></div>

					</div>

					<small class="text-muted">F</small>

				</div>
				
				<div class="p-graph-item text-center">

					<div class="p-gi-bar-item">

						<?php $marpercent = (($mar*100)/$a); ?>
						
						<div class="p-bar-item" style="height: <?= $marpercent; ?>%" data-toggle="tooltip" data-placement="left" title="Mars: <?= $mar ?>"></div>

					</div>

					<small class="text-muted">M</small>

				</div>
				
				<div class="p-graph-item text-center">

					<div class="p-gi-bar-item">

						<?php $avrpercent = (($avr*100)/$a); ?>
						
						<div class="p-bar-item" style="height: <?= $avrpercent; ?>%" data-toggle="tooltip" data-placement="left" title="Avril: <?= $avr ?>"></div>

					</div>

					<small class="text-muted">A</small>

				</div>
				
				<div class="p-graph-item text-center">

					<div class="p-gi-bar-item">

						<?php $maipercent = (($mai*100)/$a); ?>
						
						<div class="p-bar-item" style="height: <?= $maipercent; ?>%" data-toggle="tooltip" data-placement="left" title="Mai: <?= $mai ?>"></div>

					</div>

					<small class="text-muted">M</small>

				</div>
				
				<div class="p-graph-item text-center">

					<div class="p-gi-bar-item">

						<?php $juinpercent = (($juin*100)/$a); ?>
						
						<div class="p-bar-item" style="height: <?= $juinpercent; ?>%" data-toggle="tooltip" data-placement="left" title="Juin: <?= $juin ?>"></div>

					</div>

					<small class="text-muted">J</small>

				</div>
				
				<div class="p-graph-item text-center">

					<div class="p-gi-bar-item">

						<?php $juipercent = (($jui*100)/$a); ?>
						
						<div class="p-bar-item" style="height: <?= $juipercent; ?>%" data-toggle="tooltip" data-placement="left" title="Juillet: <?= $jui ?>"></div>

					</div>

					<small class="text-muted">J</small>

				</div>
				
				<div class="p-graph-item text-center">

					<div class="p-gi-bar-item">

						<?php $aoupercent = (($aou*100)/$a); ?>
						
						<div class="p-bar-item" style="height: <?= $aoupercent; ?>%" data-toggle="tooltip" data-placement="left" title="Août: <?= $aou ?>"></div>

					</div>

					<small class="text-muted">A</small>

				</div>
				
				<div class="p-graph-item text-center">

					<div class="p-gi-bar-item">

						<?php $septpercent = (($sep*100)/$a); ?>
						
						<div class="p-bar-item" style="height: <?= $septpercent; ?>%" data-toggle="tooltip" data-placement="left" title="Septembre: <?= $sep ?>"></div>

					</div>

					<small class="text-muted">S</small>

				</div>
				
				<div class="p-graph-item text-center">

					<div class="p-gi-bar-item">

						<?php $octpercent = (($oct*100)/$a); ?>
						
						<div class="p-bar-item" style="height: <?= $octpercent; ?>%" data-toggle="tooltip" data-placement="left" title="Octobre: <?= $oct ?>"></div>

					</div>

					<small class="text-muted">O</small>

				</div>
				
				<div class="p-graph-item text-center">

					<div class="p-gi-bar-item">

						<?php $novpercent = (($nov*100)/$a); ?>
						
						<div class="p-bar-item" style="height: <?= $novpercent; ?>%" data-toggle="tooltip" data-placement="left" title="Novembre: <?= $nov ?>"></div>

					</div>

					<small class="text-muted">N</small>

				</div>
				
				<div class="p-graph-item text-center">

					<div class="p-gi-bar-item">

						<?php $decpercent = (($dec*100)/$a); ?>
						
						<div class="p-bar-item" style="height: <?= $decpercent; ?>%" data-toggle="tooltip" data-placement="left" title="Décembre: <?= $dec ?>"></div>

					</div>

					<small class="text-muted">D</small>

				</div>

			</div>

		</div>

	</div>

</div>

<?php endif; ?>