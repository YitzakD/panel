<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#	Baseline
$i = 1;
	
$current = 1;

$limit = 10;

$subpage = '/comptability/fournisseurs/parts/';

$compteur = find_all("providers");

$curr = array_search($ID, array_column($compteur, 'id'));

$next = nextElement($compteur, $curr);

$prev = prevElement($compteur, $curr);


ob_start();

if(isset($con) && ($con === 'nouveau')) {

	#	Informations de base
	if(isset($_POST['newsubmit'])) {

		$error = [];

		if(not_empty(['provider', 'corresponding', 'pemail', 'phones'])) {

			extract($_POST);

			if(is_already_use('providers', 'p_name', $provider)) {

	            $error[1] = "Il existe déjà un fournisseur qui porte la même dénomination.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $provider;

	            $msg = $error[1];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

			if(!filter_var($pemail, FILTER_VALIDATE_EMAIL)) {

	            $error[3] = "L'adresse e-mail saisie n'est pas valide.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $provider;

	            $msg = $error[3];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

	        if(!is_numeric($phones)) {

	        	$error[4] = "Votre saisie ne correspond pas à un numéro de téléphone.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $provider;

	            $msg = $error[4];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

	        if(mb_strlen($phones) < 8) {

	        	$error[4] = "Le numéro de téléphone doit contenir au moins huit (8) chiffres.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $provider;

	            $msg = $error[4];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }


	        if(count($error) == 0) {

	        	$q = $db->prepare("INSERT INTO providers(p_name,c_name,p_mail,contacts,type,created) VALUES(:p_name, :c_name, :p_mail, :contacts, :type, :created)");

				$q->execute([
					'p_name' => $provider,
					'c_name' => $corresponding,
					'p_mail' => $pemail,
					'contacts' => $phones,
					'type' => $type,
					'created' => date('Y-m-d H:i:s')
				]);

				$cid = $db->lastInsertId();

				set_flash("Le fournisseur a été ajouter avec succès.", "success");

		            
	            $field = $con;

	            $title = $m[1] . ', ' . $provider;

	            $msg = "Le fournisseur a été ajouter avec succès.";

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);


				redirect(WURI . '?r=' . $m[1] . '/');

	        } else { save_input_data(); }

		} else {

			save_input_data();

			$error[] = "Veuillez à remplir tous les champs marqués par un astérisk (*).";

	            
            $field = $con;

            $title = $m[1] . ', Comptabilité';

            $msg = "Veuillez à remplir tous les champs marqués par un astérisk (*).";

            $year = date("Y");

            set_activity(get_session("uid"), $field, $title, $msg);

		}

	} else { clear_input_data(); }


	#	Liste
	require PAGES . $subpage . '_fournisseurs.new.php';

}






elseif(isset($con) && ($con === 'infos')) {

	if(is_numeric($ID)) {

		$exist = cell_count("providers", "id", $ID);

		id_count($exist, "Impossible de trouver ce fournisseur dans la base de données.");

		$fournisseur = find_one("providers", "id", $ID);

		$commandescounter = cell_count("bc", "f_id", $ID);

		$commandes = find_all("bc", " WHERE f_id='$ID' ORDER BY id DESC LIMIT 10");


		if(isset($vue) && ($vue != $ID) && ($vue === 'nouveau-bon')) {
		
			$_SESSION['provider'] = $ID;

			redirect(WURI . '?r=commandes/nouvelle/');

		}

		
		#	Liste
		require PAGES . $subpage . '_fournisseurs.infos.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}	

}






elseif(isset($con) && ($con === 'edition')) {

	if(is_numeric($ID)) {

		$exist = cell_count("providers", "id", $ID);

		id_count($exist, "Impossible de trouver ce fournisseur dans la base de données.");

		$fournisseur = find_one("providers", "id", $ID);


		#	Informations de base
		if(isset($_POST['editsubmit'])) {

			$error = [];

			if(not_empty(['provider', 'corresponding', 'pemail', 'phones'])) {

				extract($_POST);

				if(is_already_use('providers', 'p_name', $provider) && ($provider !== $fournisseur->p_name)) {

		            $error[1] = "Il existe déjà un fournisseur qui porte la même dénomination.";

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $fournisseur->p_name;

		            $msg = $error[1];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }

				if(!filter_var($pemail, FILTER_VALIDATE_EMAIL)) {

		            $error[3] = "L'adresse e-mail saisie n'est pas valide.";

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $fournisseur->p_name;

		            $msg = $error[3];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }

		        if(!is_numeric($phones)) {

		        	$error[4] = "Votre saisie ne correspond pas à un numéro de téléphone.";

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $provider;

		            $msg = $error[4];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }

		        if(mb_strlen($phones) < 8) {

		        	$error[4] = "Le numéro de téléphone doit contenir au moins huit (8) chiffres.";

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $provider;

		            $msg = $error[4];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }


		        if(count($error) == 0) {

		        	$q = $db->prepare("UPDATE providers SET p_name=:p_name, c_name=:c_name, p_mail=:p_mail, contacts=:contacts, type=:type, created=:created WHERE id=:id");

					$q->execute([
						'p_name' => $provider,
						'c_name' => $corresponding,
						'p_mail' => $pemail,
						'contacts' => $phones,
						'type' => $type,
						'created' => date('Y-m-d H:i:s'),
						'id' => $ID
					]);

					set_flash("Les informations de base du fournisseur ont bien été mis à jour.", "success");

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $fournisseur->p_name;

		            $msg = "Les informations de base du fournisseur ont bien été mis à jour.";

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);


					redirect(WURI . '?r=' . $m[1] . '/');

		        } else { save_input_data(); }

			} else {

				save_input_data();

				$error[] = "Veuillez à remplir tous les champs marqués par un astérisk (*).";

		            
	            $field = $con;

	            $title = $m[1] . ', ' . $fournisseur->p_name;

	            $msg = "Veuillez à remplir tous les champs marqués par un astérisk (*).";

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

			}

		} else { clear_input_data(); }


		#	Liste
		require PAGES . $subpage . '_fournisseurs.edit.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






else {

	$fournisseurscounter__ = count_all("providers");
		
	$nbpages = ceil($fournisseurscounter__/$limit);

	if(!empty($_GET['s']) && is_numeric($_GET['s'])) {

		$page = intval($_GET['s']);

		if($page >= 1 && $page <= $nbpages) { $current = $page; }

		elseif($page < 1) { $current = 1; }

		else { $current = $nbpages; }

	}

	$start = ($current * $limit - $limit);

    $fournisseurs__ = find_all("providers", " ORDER BY id DESC LIMIT $start, $limit");


	#	Liste
	require PAGES . $subpage . '_fournisseurs.list.php';

}

$__fournisseurs = ob_get_clean();



#	Ajout de la vue
require PAGES . '/comptability/fournisseurs/fournisseurs.php';

?>