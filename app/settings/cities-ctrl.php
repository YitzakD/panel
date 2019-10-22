<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#	Baseline
$i = 1;
	
$current = 1;

$limit = 10;

$subpage = '/settings/villes/parts/';

$compteur = find_all("cities", "WHERE id>1");

$curr = array_search($ID, array_column($compteur, 'id'));

$next = nextElement($compteur, $curr);

$prev = prevElement($compteur, $curr);


ob_start();

if(isset($con) && ($con === 'nouvelle')) {

	#	Informations de base
	$zones = find_all("zones", "WHERE id>1");


	if(isset($_POST['newsubmit'])) {

		$error = [];

		if(not_empty(['villetitle'])) {

			extract($_POST);

	        if(mb_strlen($villetitle) < 3) {

	        	$error[1] = "Le nom d'une ville doit contenir au moins trois (3) lettres.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $villetitle;

	            $msg = $error[1];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

			if(is_already_use('cities', 'city_title', $villetitle)) {

	            $error[1] = "Il existe déjà une ville qui porte la même dénomination.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $villetitle;

	            $msg = $error[1];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

	        if(cell_count("zones", "id", $zid) < 1) {

	        	$error[2] = "Impossible de retrouver cette zone dans la base de données.";

	            
	            $field = $con;

	            $title = $m[1] . ', Atteinte à l\'intégrité de la BDD';

	            $msg = $error[2];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }


	        if(count($error) == 0) {

	            $q = $db->prepare("INSERT INTO cities(zid,city_title) VALUES(:zid, :city_title)");

	            $q->execute([
	                'zid' => $zid,
	                'city_title' => $villetitle
	            ]);

				set_flash("La ville a été ajouter avec succès.", "success");

		            
	            $field = $con;

	            $title = $m[1] . ', ' . $villetitle;

	            $msg = "La ville a été ajouter avec succès.";

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
	require PAGES . $subpage . '_villes.new.php';

}






elseif(isset($con) && ($con === 'infos')) {

	if(is_numeric($ID)) {

		$exist = cell_count("cities", "id", $ID);

		id_count($exist, "Impossible de trouver cette ville dans la base de données.");

		$ville = find_one("cities", "id", $ID);

		$cmunescounter = cell_count("cmunes", "zid", $ID);

		$communes = find_all("cmunes", " WHERE zid='$ID' ORDER BY id DESC LIMIT 5");

		$sboardscounter = cell_count("signboards", "ville", $ID);

		$sboards = find_all("signboards", " WHERE ville='$ID' ORDER BY RAND() LIMIT 5");

		$zone = find_one("zones", "id", $ville->zid);

		
		#	Liste
		require PAGES . $subpage . '_villes.infos.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'edition')) {

	if(is_numeric($ID)) {

		$exist = cell_count("cities", "id", $ID);

		id_count($exist, "Impossible de trouver cette ville dans la base de données.");

		$ville = find_one("cities", "id", $ID);

		$zones = find_all("zones", "WHERE id>1");

		$zone = find_one("zones", "id", $ville->zid);


		#	Informations de base
		if(isset($_POST['editsubmit'])) {

			$error = [];

			if(not_empty(['villetitle'])) {

				extract($_POST);

				if(is_already_use('cities', 'city_title', $villetitle) && ($villetitle !== $ville->city_title)) {

		            $error[1] = "Il existe déjà une ville qui porte la même dénomination.";

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $ville->city_title;

		            $msg = $error[1];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }

		        if(mb_strlen($villetitle) < 3) {

		        	$error[1] = "Le nom d'une ville doit contenir au moins trois (3) lettres.";

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $villetitle;

		            $msg = $error[1];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }

		        if(cell_count("zones", "id", $zid) < 1) {

		        	$error[2] = "Impossible de retrouver cette zone dans la base de données.";

		            
		            $field = $con;

		            $title = $m[1] . ', Atteinte à l\'intégrité de la BDD';

		            $msg = $error[2];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }


		        if(count($error) == 0) {

		        	$q = $db->prepare("UPDATE cities SET zid=:zid, city_title=:city_title WHERE id=:id");

                	$q->execute([
	                    'zid' => $zid,
	                    'city_title' => $villetitle,
	                    'id' => $ID
	                ]);

					set_flash("Les informations de base de la ville ont bien été mis à jour.", "success");

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $ville->city_title;

		            $msg = "Les informations de base de la ville ont bien été mis à jour.";

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
		require PAGES . $subpage . '_villes.edit.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'suppression')) {

	if(is_numeric($ID)) {

		$exist = cell_count("cities", "id", $ID);

		$ville = find_one("cities", "id", $ID);

		id_count($exist, "Impossible de trouver cette ville dans la base de données.");


		check_access(array('1'));

		
		if(isset($_POST)) {

			extract($_POST);

			set_flash("La ville a été supprimer avec succès.", "success");

	            
            $field = $con;

            $title = $m[1] . ', ' . $ville->city_title;

            $msg = "La ville a été supprimer avec succès.";

            $year = date("Y");

            set_activity(get_session("uid"), $field, $title, $msg);

			delete_one('cities', 'id', $ID);


			redirect(WURI . '?r=' . $m[1] . '/');

		}

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






else {

	$villescounter__ = count_all("cities", "WHERE id>1");
		
	$nbpages = ceil($villescounter__/$limit);

	if(!empty($_GET['s']) && is_numeric($_GET['s'])) {

		$page = intval($_GET['s']);

		if($page >= 1 && $page <= $nbpages) { $current = $page; }

		elseif($page < 1) { $current = 1; }

		else { $current = $nbpages; }

	}

	$start = ($current * $limit - $limit);

    $villes__ = find_all("cities", "WHERE id>1 ORDER BY id DESC LIMIT $start, $limit");


	#	Liste
	require PAGES . $subpage . '_villes.list.php';

}

$__villes = ob_get_clean();



#	Ajout de la vue
require PAGES . '/settings/villes/villes.php';

?>