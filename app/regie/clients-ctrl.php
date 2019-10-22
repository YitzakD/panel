<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#	Baseline
$i = 1;
	
$current = 1;

$limit = 10;

$subpage = '/regie/clients/parts/';

$compteur = find_all("clients");

$curr = array_search($ID, array_column($compteur, 'id'));

$next = nextElement($compteur, $curr);

$prev = prevElement($compteur, $curr);


ob_start();

if(isset($con) && ($con === 'nouveau')) {

	#	Informations de base
	if(isset($_POST['newsubmit'])) {

		$error = [];

		if(not_empty(['entname', 'interlocuteur', 'entmail', 'entphone'])) {

			extract($_POST);

			if(is_already_use('clients', 'e_name', $entname)) {

	            $error[1] = "Il existe déjà un client qui porte la même dénomination.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $entname;

	            $msg = $error[1];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

			if(!filter_var($entmail, FILTER_VALIDATE_EMAIL)) {

	            $error[3] = "L'adresse e-mail saisie n'est pas valide.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $entname;

	            $msg = $error[3];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

	        if(!is_numeric($entphone)) {

	        	$error[4] = "Votre saisie ne correspond pas à un numéro de téléphone.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $entname;

	            $msg = $error[4];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

	        if(mb_strlen($entphone) < 8) {

	        	$error[4] = "Le numéro de téléphone doit contenir au moins huit (8) chiffres.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $entname;

	            $msg = $error[4];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }


	        if(count($error) == 0) {

	        	$q = $db->prepare("INSERT INTO clients(e_name,c_name,a_mail,contacts,type,created) VALUES(:e_name, :c_name, :a_mail, :contacts, :type, :created)");

	        	$r = $db->prepare("INSERT INTO notebook(client_id) VALUES(:client_id)");

				$q->execute([
					'e_name' => $entname,
					'c_name' => $interlocuteur,
					'a_mail' => $entmail,
					'contacts' => $entphone,
					'type' => $type,
					'created' => date('Y-m-d H:i:s')
				]);

				$cid = $db->lastInsertId();

				$r->execute(['client_id' => $cid]);
				

				set_flash("Le client a été ajouter avec succès.", "success");

		            
	            $field = $con;

	            $title = $m[1] . ', ' . $entname;

	            $msg = "Le client a été ajouter avec succès.";

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);


				redirect(WURI . '?r=' . $m[1] . '/complete/' . $cid . '/');

	        } else { save_input_data(); }

		} else {

			save_input_data();

			$error[] = "Veuillez à remplir tous les champs marqués par un astérisk (*).";

	            
            $field = $con;

            $title = $m[1] . ', Régie';

            $msg = "Veuillez à remplir tous les champs marqués par un astérisk (*).";

            $year = date("Y");

            set_activity(get_session("uid"), $field, $title, $msg);

		}

	} else { clear_input_data(); }


	#	Liste
	require PAGES . $subpage . '_clients.new.php';

}






elseif(isset($con) && ($con === 'infos')) {

	if(is_numeric($ID)) {

		$exist = cell_count("clients", "id", $ID);

		id_count($exist, "Impossible de trouver ce client dans la base de données.");

		$client = find_one("clients", "id", $ID);

		$campcounter = cell_count("init_camp", "client_id", $ID);

		$rsvcounter = cell_count("init_rsv", "client_id", $ID);

		$invoicecounter = cell_count("bills", "client_id", $ID);

		$invoices = find_all("bills", " WHERE client_id='$ID' ORDER BY id DESC LIMIT 5");

		$proformacounter = cell_count("pformas", "client_id", $ID);

		$proformas = find_all("pformas", " WHERE client_id='$ID' ORDER BY id DESC LIMIT 5");

		$lastcamps = cell_count("init_rsv", "client_id", $ID, "AND etat!='En attente'");

		$lastrsv = cell_count("init_rsv", "client_id", $ID, "AND etat='En attente'");


		#	Liste
		require PAGES . $subpage . '_clients.infos.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}	

}






elseif(isset($con) && ($con === 'edition')) {

	if(is_numeric($ID)) {

		$exist = cell_count("clients", "id", $ID);

		id_count($exist, "Impossible de trouver ce client dans la base de données.");

		$client = find_one("clients", "id", $ID);


		#	Informations de base
		if(isset($_POST['editsubmit'])) {

			$error = [];

			if(not_empty(['entname', 'interlocuteur', 'entmail', 'entphone'])) {

				extract($_POST);

				if(is_already_use('clients', 'e_name', $entname) && ($entname !== $client->e_name)) {

		            $error[1] = "Il existe déjà un client qui porte la même dénomination.";

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $client->e_name;

		            $msg = $error[1];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }

				if(!filter_var($entmail, FILTER_VALIDATE_EMAIL)) {

		            $error[3] = "L'adresse e-mail saisie n'est pas valide.";

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $client->e_name;

		            $msg = $error[3];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }

		        if(!is_numeric($entphone)) {

		        	$error[4] = "Votre saisie ne correspond pas à un numéro de téléphone.";

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $entname;

		            $msg = $error[4];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }

		        if(mb_strlen($entphone) < 8) {

		        	$error[4] = "Le numéro de téléphone doit contenir au moins huit (8) chiffres.";

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $entname;

		            $msg = $error[4];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }


		        if(count($error) == 0) {

		        	$q = $db->prepare("UPDATE clients SET e_name=:e_name, c_name=:c_name, a_mail=:a_mail, contacts=:contacts, type=:type, created=:created WHERE id=:id");

					$q->execute([
						'e_name' => $entname,
						'c_name' => $interlocuteur,
						'a_mail' => $entmail,
						'contacts' => $entphone,
						'type' => $type,
						'created' => date('Y-m-d H:i:s'),
						'id' => $ID
					]);

					set_flash("Les informations de base du client ont bien été mis à jour.", "success");

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $client->e_name;

		            $msg = "Les informations de base du client ont bien été mis à jour.";

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);


					redirect(WURI . '?r=' . $m[1] . '/');

		        } else { save_input_data(); }

			} else {

				save_input_data();

				$error[] = "Veuillez à remplir tous les champs marqués par un astérisk (*).";

		            
	            $field = $con;

	            $title = $m[1] . ', ' . $client->e_name;

	            $msg = "Veuillez à remplir tous les champs marqués par un astérisk (*).";

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

			}

		} else { clear_input_data(); }


		#	Liste
		require PAGES . $subpage . '_clients.edit.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'complete')) {
	
	if(is_numeric($ID)) {

		$exist = cell_count("clients", "id", $ID);

		id_count($exist, "Impossible de trouver ce client dans la base de données.");

		$client = find_one("clients", "id", $ID);


		#	Informations de facturation
		if(isset($_POST['invoicesubmit'])) {

			$error = [];

			if(not_empty(['bp', 'cc'])) {

				extract($_POST);

		        if(mb_strlen($cc) < 4) {

		        	$error[2] = "Votre saisie ne correspond pas à un numéro de compte contribuable.";

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $client->e_name;

		            $msg = $error[2];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }

		        if(count($error) == 0) {

		        	$q = $db->prepare("UPDATE clients SET bp=:bp, cc=:cc, created=:created WHERE id=:id");

					$q->execute([
						'bp' => $bp,
						'cc' => $cc,
						'created' => date('Y-m-d H:i:s'),
						'id' => $ID
					]);

					set_flash("Les informations de facturations du client ont bien été mis à jour.", "success");

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $client->e_name;

		            $msg = "Les informations de facturations du client ont bien été mis à jour.";

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		            if(!empty($_SESSION['toreturn_URI'])) { redirect($_SESSION['toreturn_URI']); }

		            else { redirect(WURI . '?r=' . $m[1] . '/'); }

		        } else { save_input_data(); }

			} else {

				save_input_data();

				$error[] = "Veuillez à remplir tous les champs marqués par un astérisk (*).";

		            
	            $field = $con;

	            $title = $m[1] . ', ' . $client->e_name;

	            $msg = "Veuillez à remplir tous les champs marqués par un astérisk (*).";

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

			}

		} else { clear_input_data(); }


		#	Liste
		require PAGES . $subpage . '_clients.up.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






else {

	$clientscounter__ = count_all("clients");
		
	$nbpages = ceil($clientscounter__/$limit);

	if(!empty($_GET['s']) && is_numeric($_GET['s'])) {

		$page = intval($_GET['s']);

		if($page >= 1 && $page <= $nbpages) { $current = $page; }

		elseif($page < 1) { $current = 1; }

		else { $current = $nbpages; }

	}

	$start = ($current * $limit - $limit);

    $clients__ = find_all("clients", " ORDER BY e_name ASC LIMIT $start, $limit");


	#	Liste
	require PAGES . $subpage . '_clients.list.php';

}

$__clients = ob_get_clean();



#	Ajout de la vue
require PAGES . '/regie/clients/clients.php';

?>