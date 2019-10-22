<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#	Baseline
$i = 1;
	
$current = 1;

$limit = 10;

$subpage = '/settings/activites/parts/';


ob_start();

if(isset($con) && ($con === 'details')) {

	if(is_numeric($vue) && mb_strlen($vue) ===  4) {

		$exist = cell_count("activities", "created_year", $vue);

		id_count($exist, "Impossible de trouver les informations dans la base de données.");

		$yearuserscounter = find_distinct_nbr("activities", "uid", "WHERE created_year='$vue'");

		$yearactivitiescounter = cell_count("activities", "created_year", $vue);
    	
    	$activitiesusersyear = find_distinct("activities", "uid", "WHERE created_year='$vue'");

    	$users = find_distinct("activities", "uid", "WHERE created_year='$vue'");

    	if(isset($vue) && (!isset($rvue))) {

    		$ID = get_session('uid');

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

    	} elseif(isset($vue) && (isset($rvue))) {

    		$ID = $rvue;

    		if(!(f_inarray($ID, "uid", $users))) {

				set_flash("Impossible de retrouver les activités de cet uttilisateur.", "danger");



				$field = $con;

		        $title = $m[1] . ', ' . $userinfo->pseudo;

		        $msg = "Impossible de retrouver les activités de cet uttilisateur.";

		        $year = date("Y");

		        set_activity(get_session("uid"), $field, $title, $msg);

		        redirect(WURI . '?r=' . $m[1] . '/' . $con . '/' . $vue . '/');

    		}

    	}

		
		#	Liste
		require PAGES . $subpage . '_activites.year-details.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






else {

	$activitiescounter__ = find_years_nbr("activities");

	#	$yearscounter = find_years("activities");
		
	$nbpages = ceil($activitiescounter__/$limit);

	if(!empty($_GET['s']) && is_numeric($_GET['s'])) {

		$page = intval($_GET['s']);

		if($page >= 1 && $page <= $nbpages) { $current = $page; }

		elseif($page < 1) { $current = 1; }

		else { $current = $nbpages; }

	}

	$start = ($current * $limit - $limit);

	$allyears__ = find_years("activities", "ORDER BY created_year DESC LIMIT $start, $limit");


	#	Liste
	require PAGES . $subpage . '_activites.list.php';

}

$__activites = ob_get_clean();



#	Ajout de la vue
require PAGES . '/settings/activites/activites.php';

?>
