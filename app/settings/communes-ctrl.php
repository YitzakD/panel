<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#	Baseline
$i = 1;
	
$current = 1;

$limit = 10;

$subpage = '/settings/communes/parts/';

$compteur = find_all("cmunes", "WHERE id>1");

$curr = array_search($ID, array_column($compteur, 'id'));

$next = nextElement($compteur, $curr);

$prev = prevElement($compteur, $curr);


ob_start();

if(isset($con) && ($con === 'nouvelle')) {

	#	Informations de base
	$villes = find_all("cities", "WHERE id>1");


	if(isset($_POST['newsubmit'])) {

		$error = [];

		if(not_empty(['communetitle'])) {

			extract($_POST);

	        if(mb_strlen($communetitle) < 3) {

	        	$error[1] = "Le nom d'une commune doit contenir au moins trois (3) lettres.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $communetitle;

	            $msg = $error[1];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

			if(is_already_use('cmunes', 'cmune_title', $communetitle)) {

	            $error[1] = "Il existe déjà une commune qui porte la même dénomination.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $communetitle;

	            $msg = $error[1];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

	        if(cell_count("cities", "id", $vid) < 1) {

	        	$error[2] = "Impossible de retrouver cette ville dans la base de données.";

	            
	            $field = $con;

	            $title = $m[1] . ', Atteinte à l\'intégrité de la BDD';

	            $msg = $error[2];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }


	        if(count($error) == 0) {

	        	$ville = find_one("cities", "id", $vid);

	        	$zone = find_one("zones", "id", $ville->zid);

	        	$zid = $zone->id;

	        	$q = $db->prepare("INSERT INTO cmunes(zid,vid,cmune_title) VALUES(:zid, :vid, :cmune_title)");

	            $q->execute([
	                'zid' => $zid,
	                'vid' => $vid,
	                'cmune_title' => $communetitle
	            ]);

				set_flash("La commune a été ajouter avec succès.", "success");

		            
	            $field = $con;

	            $title = $m[1] . ', ' . $communetitle;

	            $msg = "La commune a été ajouter avec succès.";

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
	require PAGES . $subpage . '_communes.new.php';

}






elseif(isset($con) && ($con === 'infos')) {

	if(is_numeric($ID)) {

		$exist = cell_count("cmunes", "id", $ID);

		id_count($exist, "Impossible de trouver cette commune dans la base de données.");

		$commune = find_one("cmunes", "id", $ID);

		$sboardscounter = cell_count("signboards", "cmune", $ID);

		$signboardscounter = find_signboards_nbr($commune->zid, $ID);

		$signboards = find_signboards($commune->zid, $ID, "", " LIMIT 5");

		$zone = find_one("zones", "id", $commune->zid);

		$ville = find_one("cities", "id", $commune->vid);

		
		#	Liste
		require PAGES . $subpage . '_communes.infos.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'edition')) {

	if(is_numeric($ID)) {

		$exist = cell_count("cmunes", "id", $ID);

		id_count($exist, "Impossible de trouver cette commune dans la base de données.");

		$commune = find_one("cmunes", "id", $ID);

		$villes = find_all("cities", "WHERE id>1");

		$ville = find_one("cities", "id", $commune->vid);


		if(isset($_POST['editsubmit'])) {

			$error = [];

			if(not_empty(['communetitle'])) {

				extract($_POST);

				if(is_already_use('cmunes', 'cmune_title', $communetitle) && ($communetitle !== $commune->cmune_title)) {

		            $error[1] = "Il existe déjà une commune qui porte la même dénomination.";

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $commune->cmune_title;

		            $msg = $error[1];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }

		        if(mb_strlen($communetitle) < 3) {

		        	$error[1] = "Le nom d'une commune doit contenir au moins trois (3) lettres.";

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $communetitle;

		            $msg = $error[1];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }

		        if(cell_count("cities", "id", $vid) < 1) {

		        	$error[2] = "Impossible de retrouver cette ville dans la base de données.";

		            
		            $field = $con;

		            $title = $m[1] . ', Atteinte à l\'intégrité de la BDD';

		            $msg = $error[2];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }


	        	if(count($error) == 0) {

	        		$_ville_ = find_one("cities", "id", $vid);

		        	$zone = find_one("zones", "id", $_ville_->zid);

		        	$zid = $zone->id;

		        	$q = $db->prepare("UPDATE cmunes SET zid=:zid, vid=:vid, cmune_title=:cmune_title WHERE id=:id");

                	$q->execute([
	                    'zid' => $zid,
	                    'vid' => $vid,
	                    'cmune_title' => $communetitle,
	                    'id' => $ID
	                ]);

					set_flash("Les informations de base de la commune ont bien été mis à jour.", "success");

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $commune->cmune_title;

		            $msg = "Les informations de base de la commune ont bien été mis à jour.";

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
		require PAGES . $subpage . '_communes.edit.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'suppression')) {

	if(is_numeric($ID)) {

		$exist = cell_count("cmunes", "id", $ID);

		$commune = find_one("cmunes", "id", $ID);

		id_count($exist, "Impossible de trouver cette commune dans la base de données.");


		check_access(array('1'));
		
		
		if(isset($_POST)) {

			extract($_POST);

			set_flash("La commune a été supprimer avec succès.", "success");

	            
            $field = $con;

            $title = $m[1] . ', ' . $commune->cmune_title;

            $msg = "La commune a été supprimer avec succès.";

            $year = date("Y");

            set_activity(get_session("uid"), $field, $title, $msg);

			delete_one('cmunes', 'id', $ID);


			redirect(WURI . '?r=' . $m[1] . '/');

		}

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






else {

	$communescounter__ = count_all("cmunes", "WHERE id>1");
		
	$nbpages = ceil($communescounter__/$limit);

	if(!empty($_GET['s']) && is_numeric($_GET['s'])) {

		$page = intval($_GET['s']);

		if($page >= 1 && $page <= $nbpages) { $current = $page; }

		elseif($page < 1) { $current = 1; }

		else { $current = $nbpages; }

	}

	$start = ($current * $limit - $limit);

    $communes__ = find_all("cmunes", "WHERE id>1 ORDER BY id DESC LIMIT $start, $limit");



	#	Liste
	require PAGES . $subpage . '_communes.list.php';

}


$__communes = ob_get_clean();



#	Ajout de la vue
require PAGES . '/settings/communes/communes.php';

?>