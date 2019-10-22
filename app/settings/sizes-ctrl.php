<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#	Baseline
$i = 1;
	
$current = 1;

$limit = 10;

$subpage = '/settings/sizes/parts/';


ob_start();

if(isset($con) && ($con === 'nouveau')) {

	#	Informations de base
	if(isset($_POST['newsubmit'])) {

		$error = [];

		if(not_empty(['size'])) {

			extract($_POST);

	        if(!is_numeric($size)) {

	        	$error[1] = "Votre saisie ne correspond pas à un chiffre ou un nombre.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $size;

	            $msg = $error[1];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

	        if(($size < "0") || ($size === "0")) {

	        	$error[1] = "Le format ne peut pas être inférieur ou égal à zéro (0).";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $size;

	            $msg = $error[1];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }


	        if(count($error) == 0) {

	        	$q = $db->prepare("INSERT INTO sizes(size) VALUES(:size)");

	            $q->execute(['size' => $size]);

				set_flash("Le format a été ajouter avec succès.", "success");

		            
	            $field = $con;

	            $title = $m[1] . ', ' . $zonetitle;

	            $msg = "Le format a été ajouter avec succès.";

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
	require PAGES . $subpage . '_sizes.new.php';

}






elseif(isset($con) && ($con === 'edition')) {

	if(is_numeric($ID)) {

		$exist = cell_count("sizes", "id", $ID);

		id_count($exist, "Impossible de trouver ce format dans la base de données.");

		$size = find_one("sizes", "id", $ID);


		#	Informations de base
		if(isset($_POST['editsubmit'])) {

			$error = [];

			if(not_empty(['esize'])) {

				extract($_POST);

				if(is_already_use('sizes', 'size', $esize) && ($esize !== $zone->size)) {

		            $error[1] = "Il existe déjà un format avec la même dénomination.";

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $size->size;

		            $msg = $error[1];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }

		        if(!is_numeric($esize)) {

		        	$error[1] = "Votre saisie ne correspond pas à un chiffre ou un nombre.";

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $esize;

		            $msg = $error[1];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }

		        if(($esize < "0") || ($esize === "0")) {

		        	$error[1] = "Le format ne peut pas être inférieur ou égal à zéro (0).";

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $esize;

		            $msg = $error[1];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }


		        if(count($error) == 0) {

		        	$q = $db->prepare("UPDATE sizes SET size=:size WHERE id=:id");

                	$q->execute([
	                    'size' => $esize,
	                    'id' => $ID
	                ]);

					set_flash("Les informations de base du format ont bien été mis à jour.", "success");

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $size->size;

		            $msg = "Les informations de base du format ont bien été mis à jour.";

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
		require PAGES . $subpage . '_sizes.edit.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'suppression')) {

	if(is_numeric($ID)) {

		$exist = cell_count("sizes", "id", $ID);

		$size = find_one("sizes", "id", $ID);

		id_count($exist, "Impossible de trouver ce format dans la base de données.");


		check_access(array('1'));

		
		if(isset($_POST)) {

			extract($_POST);

			set_flash("Le format a été supprimer avec succès.", "success");

	            
            $field = $con;

            $title = $m[1] . ', ' . $size->size;

            $msg = "Le format a été supprimer avec succès.";

            $year = date("Y");

            set_activity(get_session("uid"), $field, $title, $msg);

			delete_one('sizes', 'id', $ID);


			redirect(WURI . '?r=' . $m[1] . '/');

		}

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






else {

	$sizescounter__ = count_all("sizes", "WHERE id>1");
		
	$nbpages = ceil($sizescounter__/$limit);

	if(!empty($_GET['s']) && is_numeric($_GET['s'])) {

		$page = intval($_GET['s']);

		if($page >= 1 && $page <= $nbpages) { $current = $page; }

		elseif($page < 1) { $current = 1; }

		else { $current = $nbpages; }

	}

	$start = ($current * $limit - $limit);

    $sizes__ = find_all("sizes", "WHERE id>1 ORDER BY id DESC LIMIT $start, $limit");
    

	#	Liste
	require PAGES . $subpage . '_sizes.list.php';

}

$__sizes = ob_get_clean();



#	Ajout de la vue
require PAGES . '/settings/sizes/sizes.php';

?>