<div class="row no-gutters">

	<?php #	Infos ?>
	<div class="col-12 col-md-12 col-lg-12">

		<div class="p-portlet rounded">

			<?php #	En-tête ?>
			<div class="p-portlet-head">
				
				<div class="p-portlet-head-label">

					<span class="d-block">
						<div class="text-capitalize"><?= $vue; ?></div>
						<span class="d-block small text-muted">
							
							<?= $yearuserscounter>1 ? $yearuserscounter." utilisateurs" : $yearuserscounter." utilisateur"; ?>,&nbsp;(<?= $yearactivitiescounter>1 ? $yearactivitiescounter." activités" : $yearactivitiescounter." activité"; ?>)

						</span>
					</span>

				</div>

			</div>



			<div class="p-portlet-separator mt-4 mb-4"></div>



			<?php #	Contentu ?>
			<div class="d-block pb-4">

				<div class="nav flex-column nav-pills p-nav-pills-v">

				<?php if($yearactivitiescounter > 0): ?>

				<?php foreach ($users as $item): ?>

					<?php 

						$uinfo = find_one("users", "id", $item->uid);

						$uacounter = cell_count("activities", "created_year", $vue, "AND uid='$item->uid'");

					?>

					<?php if(isset($vue) && (!isset($rvue)) && $item->uid === get_session('uid')): ?>

					<a class="nav-link active" href="<?= WURI . '?r=' . $m[1] . '/details/' . $vue . '/' . get_session('uid') . '/'; ?>">

					<?php elseif(isset($vue) && (isset($rvue)) && $ID === $item->uid): ?>

						<a class="nav-link active" href="<?= WURI . '?r=' . $m[1] . '/details/' . $vue . '/' . $item->uid . '/'; ?>">

					<?php else: ?>

						<a class="nav-link" href="<?= WURI . '?r=' . $m[1] . '/details/' . $vue . '/' . $item->uid . '/'; ?>">

					<?php endif; ?>

						<i class="fas fa-user-circle mr-3"></i><?= $uinfo->pseudo; ?>

					</a>

				<?php endforeach; ?>

				<?php else: ?>

					<span class="text-muted">Aucunutilisateurs n'a été retrouvé cette année.</span>

				<?php endif; ?>
				
				</div>

			</div>

		</div>
		
	</div>

</div>