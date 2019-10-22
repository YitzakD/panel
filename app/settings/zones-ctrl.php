<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#	Baseline
$i = 1;
	
$current = 1;

$limit = 10;

$subpage = '/settings/zones/parts/';

$compteur = find_all("zones", "WHERE id>1");

$curr = array_search($ID, array_column($compteur, 'id'));

$next = nextElement($compteur, $curr);

$prev = prevElement($compteur, $curr);


ob_start();

if(isset($con) && ($con === 'nouvelle')) {

	#	Informations de base
	if(isset($_POST['newsubmit'])) {

		$error = [];

		if(not_empty(['zonetitle'])) {

			extract($_POST);

	        if(mb_strlen($zonetitle) < 3) {

	        	$error[1] = "Le nom d'une zone doit contenir au moins trois (3) lettres.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $zonetitle;

	            $msg = $error[1];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

			if(is_already_use('zones', 'zone_title', $zonetitle)) {

	            $error[1] = "Il existe déjà une zone qui porte la même dénomination.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $zonetitle;

	            $msg = $error[1];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }
	        

	        if(count($error) == 0) {

	        	$q = $db->prepare("INSERT INTO zones(zone_title) VALUES(:zone_title)");

	            $q->execute(['zone_title' => $zonetitle]);

				set_flash("La zone a été ajouter avec succès.", "success");

		            
	            $field = $con;

	            $title = $m[1] . ', ' . $zonetitle;

	            $msg = "La zone a été ajouter avec succès.";

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);


				redirect(WURI . '?r=' . $m[1] . '/');

        	} else { save_input_data(); }


		} else {

			save_input_data();

			$error[] = "Veuillez à remplir tous les champs marqués par un astérisk (*).";

	            
            $field = $con;

            $title = $m[1] . ', Réglages';

            $msg = "Veuillez à remplir tous les champs marqués par un astérisk (*).";

            $year = date("Y");

            set_activity(get_session("uid"), $field, $title, $msg);

		}

	} else { clear_input_data(); }


	#	Liste
	require PAGES . $subpage . '_zones.new.php';

}






elseif(isset($con) && ($con === 'infos')) {

	if(is_numeric($ID)) {

		$exist = cell_count("zones", "id", $ID);

		id_count($exist, "Impossible de trouver cette zone dans la base de données.");

		$zone = find_one("zones", "id", $ID);

		$villescounter = cell_count("cities", "zid", $ID);

		$villes = find_all("cities", " WHERE zid='$ID' ORDER BY id DESC LIMIT 5");

		$cmunescounter = cell_count("cmunes", "zid", $ID);

		$communes = find_all("cmunes", " WHERE zid='$ID' ORDER BY id DESC LIMIT 5");

		$sboardscounter = cell_count("signboards", "zone", $ID);

		$sboards = find_all("signboards", " WHERE zone='$ID' ORDER BY RAND() LIMIT 5");

		
		#	Liste
		require PAGES . $subpage . '_zones.infos.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'edition')) {

	if(is_numeric($ID)) {

		$exist = cell_count("zones", "id", $ID);

		id_count($exist, "Impossible de trouver cette zone dans la base de données.");

		$zone = find_one("zones", "id", $ID);


		#	Informations de base
		if(isset($_POST['editsubmit'])) {

			$error = [];

			if(not_empty(['zonetitle'])) {

				extract($_POST);

				if(is_already_use('zones', 'zone_title', $zonetitle) && ($zonetitle !== $zone->zone_title)) {

		            $error[1] = "Il existe déjà une zone qui porte la même dénomination.";

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $zone->zone_title;

		            $msg = $error[1];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }

		        if(mb_strlen($zonetitle) < 3) {

		        	$error[1] = "Le nom d'une zone doit contenir au moins trois (3) lettres.";

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $zonetitle;

		            $msg = $error[1];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }

		        if(count($error) == 0) {

		        	$q = $db->prepare("UPDATE zones SET zone_title=:zone_title WHERE id=:id");

                	$q->execute([
	                    'zone_title' => $zonetitle,
	                    'id' => $ID
	                ]);

					set_flash("Les informations de base de la zone ont bien été mis à jour.", "success");

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $zone->zone_title;

		            $msg = "Les informations de base de la zone ont bien été mis à jour.";

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);


					redirect(WURI . '?r=' . $m[1] . '/');

		        } else { save_input_data(); }

			} else {

				save_input_data();

				$error[] = "Veuillez à remplir tous les champs marqués par un astérisk (*).";

		            
	            $field = $con;

	            $title = $m[1] . ', Réglages';

	            $msg = "Veuillez à remplir tous les champs marqués par un astérisk (*).";

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

			}

		} else { clear_input_data(); }


		#	Liste
		require PAGES . $subpage . '_zones.edit.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'suppression')) {

	if(is_numeric($ID)) {

		$exist = cell_count("zones", "id", $ID);

		$zone = find_one("zones", "id", $ID);

		id_count($exist, "Impossible de trouver cette zone dans la base de données.");


		check_access(array('1'));

		
		if(isset($_POST)) {

			extract($_POST);

			set_flash("La zone a été supprimer avec succès.", "success");

	            
            $field = $con;

            $title = $m[1] . ', ' . $zone->zone_title;

            $msg = "La zone a été supprimer avec succès.";

            $year = date("Y");

            set_activity(get_session("uid"), $field, $title, $msg);

			delete_one('zones', 'id', $ID);


			redirect(WURI . '?r=' . $m[1] . '/');

		}

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'print')) {

	$zonescounter__ = count_all("zones", "WHERE id>1");

	$zones = find_all("zones", "WHERE id>1 ORDER BY zone_title ASC");


	#	Liste
	require PAGES . $subpage . '_zones.print.php';

}






else {


	$zonescounter__ = count_all("zones", "WHERE id>1");
		
	$nbpages = ceil($zonescounter__/$limit);

	if(!empty($_GET['s']) && is_numeric($_GET['s'])) {

		$page = intval($_GET['s']);

		if($page >= 1 && $page <= $nbpages) { $current = $page; }

		elseif($page < 1) { $current = 1; }

		else { $current = $nbpages; }

	}

	$start = ($current * $limit - $limit);

    $zones__ = find_all("zones", "WHERE id>1 ORDER BY id DESC LIMIT $start, $limit");


	#	Liste
	require PAGES . $subpage . '_zones.list.php';

}

$__zones = ob_get_clean();



#	Ajout de la vue
require PAGES . '/settings/zones/zones.php';

?>