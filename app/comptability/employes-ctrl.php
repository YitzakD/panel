<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#	Baseline
$i = 1;
	
$current = 1;

$limit = 10;

$subpage = '/comptability/employes/parts/';

$compteur = find_all("employees");

$curr = array_search($ID, array_column($compteur, 'id'));

$next = nextElement($compteur, $curr);

$prev = prevElement($compteur, $curr);


ob_start();

if(isset($con) && ($con === 'nouveau')) {

	#	Informations de base
	if(isset($_POST['newsubmit'])) {

		$error = [];

		if(not_empty(['emp_names'])) {

			extract($_POST);

			if(is_already_use('employees', 'emp_names', $emp_names)) {

	            $error[1] = "Il existe déjà un employé qui a la même nomination.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $emp_names;

	            $msg = $error[1];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

			if(!filter_var($dev_mail, FILTER_VALIDATE_EMAIL)) {

	            $error[3] = "L'adresse e-mail saisie n'est pas valide.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $emp_names;

	            $msg = $error[3];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

	        if(!is_numeric($add_phone)) {

	        	$error[2] = "Votre saisie ne correspond pas à un numéro de téléphone.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $emp_names;

	            $msg = $error[2];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

	        if(mb_strlen($add_phone) < 8) {

	        	$error[2] = "Le numéro de téléphone doit contenir au moins huit (8) chiffres.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $emp_names;

	            $msg = $error[2];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }


	        if(count($error) == 0) {

	        	$matr = geraHash(10);

	        	$q = $db->prepare("INSERT INTO employees(matr,emp_names,dev_mail,add_phone,created) VALUES(:matr, :emp_names, :dev_mail, :add_phone, :created)");

				$q->execute([
					'matr' => $matr,
					'emp_names' => $emp_names,
					'dev_mail' => $dev_mail,
					'add_phone' => $add_phone,
					'created' => date('Y-m-d H:i:s')
				]);

				$eid = $db->lastInsertId();

				set_flash("L'employé a été ajouter avec succès.", "success");

		            
	            $field = $con;

	            $title = $m[1] . ', ' . $emp_names;

	            $msg = "L'employé a été ajouter avec succès.";

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);


				redirect(WURI . '?r=' . $m[1] . '/complete/' . $eid . '/');

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
	require PAGES . $subpage . '_employes.new.php';

}






elseif(isset($con) && ($con === 'infos')) {

	if(is_numeric($ID)) {

		$exist = cell_count("employees", "id", $ID);

		id_count($exist, "Impossible de trouver cet employé dans la base de données.");

		$employe = find_one("employees", "id", $ID);

		
		#	Liste
		require PAGES . $subpage . '_employes.infos.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'edition')) {

	if(is_numeric($ID)) {

		$exist = cell_count("employees", "id", $ID);

		id_count($exist, "Impossible de trouver cet employé dans la base de données.");

		$employe = find_one("employees", "id", $ID);


		#	Informations de base
		if(isset($_POST['editsubmit'])) {

			$error = [];

			if(not_empty(['emp_names', 'add_phone', 'dev_mail'])) {

				extract($_POST);

				if(is_already_use('employees', 'emp_names', $emp_names) && ($emp_names !== $employe->emp_names)) {

		            $error[1] = "Il existe déjà un employé qui porte la même nomination.";

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $employe->emp_names;

		            $msg = $error[1];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }

				if(!filter_var($dev_mail, FILTER_VALIDATE_EMAIL)) {

		            $error[3] = "L'adresse e-mail saisie n'est pas valide.";

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $employe->emp_names;

		            $msg = $error[3];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }

		        if(!is_numeric($add_phone)) {

		        	$error[2] = "Votre saisie ne correspond pas à un numéro de téléphone.";

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $emp_names;

		            $msg = $error[2];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }

		        if(mb_strlen($add_phone) < 8) {

		        	$error[2] = "Le numéro de téléphone doit contenir au moins huit (8) chiffres.";

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $emp_names;

		            $msg = $error[2];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }


		        if(count($error) == 0) {

		        	$q = $db->prepare("UPDATE employees SET emp_names=:emp_names, add_phone=:add_phone, dev_mail=:dev_mail, created=:created WHERE id=:id");

					$q->execute([
						'emp_names' => $emp_names,
						'add_phone' => $add_phone,
						'dev_mail' => $dev_mail,
						'created' => date('Y-m-d H:i:s'),
						'id' => $ID
					]);


					set_flash("Les informations de base de l'employé ont bien été mis à jour.", "success");

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $employe->e_name;

		            $msg = "Les informations de base de l'employé ont bien été mis à jour.";

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);


					redirect(WURI . '?r=' . $m[1] . '/');

		        } else { save_input_data(); }

			} else {

				save_input_data();

				$error[] = "Veuillez à remplir tous les champs marqués par un astérisk (*).";

		            
	            $field = $con;

	            $title = $m[1] . ', ' . $employe->emp_names;

	            $msg = "Veuillez à remplir tous les champs marqués par un astérisk (*).";

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

			}

		} else { clear_input_data(); }

		
		#	Liste
		require PAGES . $subpage . '_employes.edit.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'suppression')) {

	if(is_numeric($ID)) {

		$exist = cell_count("employees", "id", $ID);

		id_count($exist, "Impossible de trouver cet employé dans la base de données.");

		$employe = find_one("employees", "id", $ID);

		
		if(isset($_POST)) {

			extract($_POST);

			set_flash("L'employé a été supprimer avec succès.", "success");

	            
            $field = $con;

            $title = $m[1] . ', ' . $employe->emp_names;

            $msg = "L'employé a été supprimer avec succès.";

            $year = date("Y");

            set_activity(get_session("uid"), $field, $title, $msg);

			delete_one('employees', 'id', $ID);


			redirect(WURI . '?r=' . $m[1] . '/');

		}

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'complete')) {
	
	if(is_numeric($ID)) {

		$exist = cell_count("employees", "id", $ID);

		id_count($exist, "Impossible de trouver cet employé dans la base de données.");

		$employe = find_one("employees", "id", $ID);


		if(isset($_POST['completesubmit'])) {

			$error = [];

			if(not_empty(['emb_date', 'occ_poste', 'salary'])) {

				extract($_POST);

		        if(!is_numeric($salary)) {

		        	$error[2] = "Votre saisie ne correspond pas à un montant.";

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $employe->emp_names;

		            $msg = $error[2];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }


		        if(count($error) == 0) {

		        	$q = $db->prepare("UPDATE employees SET emb_date=:emb_date, contract_type=:contract_type, occ_poste=:occ_poste, salary=:salary, others_infos=:others_infos, created=:created WHERE id=:id");

					$q->execute([
						'emb_date' => $emb_date,
						'contract_type' => $contract_type,
						'occ_poste' => $occ_poste,
						'salary' => $salary,
						'others_infos' => $others_infos,
						'created' => date('Y-m-d H:i:s'),
						'id' => $ID
					]);

					set_flash("Les informations spécifiques de l'employé ont bien été mis à jour.", "success");

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $employe->emp_names;

		            $msg = "Les informations spécifiques de l'employé ont bien été mis à jour.";

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);


					redirect(WURI . '?r=' . $m[1] . '/');

		        } else { save_input_data(); }

			} else {

				save_input_data();

				$error[] = "Veuillez à remplir tous les champs marqués par un astérisk (*).";

		            
	            $field = $con;

	            $title = $m[1] . ', ' . $employe->emp_names;

	            $msg = "Veuillez à remplir tous les champs marqués par un astérisk (*).";

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

			}


		} else { clear_input_data(); }

		
		#	Liste
		require PAGES . $subpage . '_employes.up.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






else {

	$employescounter__ = count_all("employees");
		
	$nbpages = ceil($employescounter__/$limit);

	if(!empty($_GET['s']) && is_numeric($_GET['s'])) {

		$page = intval($_GET['s']);

		if($page >= 1 && $page <= $nbpages) { $current = $page; }

		elseif($page < 1) { $current = 1; }

		else { $current = $nbpages; }

	}

	$start = ($current * $limit - $limit);

    $employes__ = find_all("employees", " ORDER BY id DESC LIMIT $start, $limit");


	#	Liste
	require PAGES . $subpage . '_employes.list.php';

}

$__employes = ob_get_clean();



#	Ajout de la vue
require PAGES . '/comptability/employes/employes.php';

?>