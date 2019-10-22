<?php if(isset($vue) && (!isset($rvue)) ): ?>

	<?php require PAGES . $subpage . 'year/_base-activities.php'; ?>
	
<?php elseif(isset($vue) && (isset($rvue)) ): ?>

	<?php 
	
		foreach ($users as $value) {
				
			$useractivitiescounter = cell_count("activities", "created_year", $vue, "AND uid='$ID'");
					
			$nbpages = ceil($useractivitiescounter/$limit);

			if(!empty($_GET['s']) && is_numeric($_GET['s'])) {

				$page = intval($_GET['s']);

				if($page >= 1 && $page <= $nbpages) { $current = $page; }

				elseif($page < 1) { $current = 1; }

				else { $current = $nbpages; }

			}

			$start = ($current * $limit - $limit);

			$useractivities = find_all("activities", "WHERE created_year='$vue' AND uid='$ID' ORDER BY created DESC LIMIT $start, $limit");


		}

		$userinfos = find_one("users", "id", $ID);
		
		require PAGES . $subpage . 'year/_others-activities.php'; 

	?>

<?php else: ?>

	<?php require PAGES . $subpage . 'year/_base-activities.php'; ?>

<?php endif; ?>