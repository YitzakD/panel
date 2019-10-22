<div class="row no-gutters">
	
	<?php #	Infos ?>
	<div class="col-12 col-md-12 col-lg-12">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">
					<?php $in = explode(" ", $fournisseur->p_name); ?>
 									
					<span class="d-inline-block mr-2 p-datatable-pic">
						<div class="p-datatable-avatarname" style="background-color: <?= '#'.RandomCouleur(); ?>"><?= isset($in[1][0]) ? $avatarname = $in[0][0].$in[1][0] : $avatarname = $in[0][0]; ?></div>
					</span>

					<span class="d-inline-block">
						<div><?= ucfirst($fournisseur->p_name); ?></div>
						<span class="d-block small text-muted"><?= setAtype($fournisseur->type); ?></span>
					</span>

				</div>

				<div class="p-portlet-head-toolbar">
					
					<div class="dropdown">
						
						<button class="btn btn-sm btn-primary p-btn-primary" type="button" id="portleToolbar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="portleToolbar">

							<h6 class="dropdown-header">Actions rapides</h6>

							<a class="dropdown-item" href="<?= WURI . '?r=' . $m[1] . '/infos/nouveau-bon/' . $ID . '/'; ?>"><i class="fas fa-plus p-portlet-head-toolbar-dropdown-icon mr-3"></i>créer une commande</a>

							<a class="dropdown-item" href="<?= WURI . '?r=' . $m[1] . '/edition/' . $ID . '/'; ?>"><i class="far fa-edit p-portlet-head-toolbar-dropdown-icon mr-3"></i>Editer</a>

							<a class="dropdown-item" href="<?= WURI . 'export.php/' . $m[1] . '/details/' . $ID . '/'; ?>" target="_blank"><i class="fas fa-print p-portlet-head-toolbar-dropdown-icon mr-3"></i>Exporter</a>

						</div>

					</div>

				</div>

			</div>



			<div class="p-portlet-separator mt-4 mb-4"></div>


			<?php #	Contenu ?>
			<div class="p-portlet-body">
				
				<table class="table p-display-info-list">
					
					<tbody>
						
						<tr>
							
							<td class="icon"><i class="fas fa-hashtag"></i></td>

							<td class="item">Interlocuteur</td>

							<td><?= $fournisseur->c_name; ?></td>

						</tr>
						
						<tr>
							
							<td class="icon"><i class="fas fa-phone"></i></td>

							<td class="item">Téléphone</td>

							<td><?= '+225' . '&nbsp;' . $fournisseur->contacts; ?></td>

						</tr>
						
						<tr>
							
							<td class="icon"><i class="fas fa-at"></i></td>

							<td class="item">Email</td>

							<td><?= $fournisseur->p_mail; ?></td>

						</tr>
						
						<tr>
							
							<td class="icon"><i class="fas fa-calendar-day"></i></td>

							<td class="item">Dépuis le</td>

							<td><?= date('j/n/Y ',strtotime($fournisseur->created)); ?></td>

						</tr>

					</tbody>

				</table>

			</div>


		</div>
		
	</div>

</div>