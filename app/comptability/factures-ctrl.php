<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#	Baseline
$i = 1;
	
$current = 1;

$limit = 10;

$subpage = '/comptability/factures/parts/';

$compteur = find_all("bills");

$curr = array_search($ID, array_column($compteur, 'id'));

$next = nextElement($compteur, $curr);

$prev = prevElement($compteur, $curr);


ob_start();

if(isset($con) && ($con === 'infos')) {

	if(is_numeric($ID)) {

		$exist = cell_count("bills", "id", $ID);

		id_count($exist, "Impossible de trouver cette pro-forma dans la base de données.");

		$item = find_one("bills", "id", $ID);

		$facture = find_one("pformas", "id", $item->p_id);

		$client = find_one("clients", "id", $facture->client_id);


		#	Liste
		require PAGES . $subpage . '_factures.infos.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'suppression')) {

	if(is_numeric($ID)) {

		$exist = cell_count("bills", "id", $ID);

		id_count($exist, "Impossible de trouver cette facture dans la base de données.");

		$facture = find_one("bills", "id", $ID);
		
		$client = find_one("clients", "id", $facture->client_id);

		$statement = find_one("init_payement", "pf_id", $facture->pf_id);
		

		#	Verification d'accès
		check_access(array('2'));


		if(isset($_POST)) {

			extract($_POST);

			$deposit = find_one("payements", "id", $hID);

			$tac = ($statement->tac - $deposit->payed_amount);
            
            $rap = ($statement->rap + $deposit->payed_amount);

            $q = $db->prepare("UPDATE init_payement SET tac=:tac, rap=:rap, created=:created WHERE id=:id");
            
            $q->execute([
                'tac' => $tac,
                'rap' => $rap,
                'created' => date('Y-m-d H:i:s'),
                'id' => $deposit->statement_id
            ]);

			set_flash("Le versement a été supprimer avec succès.", "success");

	            
            $field = $con;

            $title = $m[1] . ', ' . $facture->pf_id;

            $msg = "Le versement a été supprimer avec succès.";

            $year = date("Y");

            set_activity(get_session("uid"), $field, $title, $msg);


			delete_one('payements', 'id', $hID);


			redirect(WURI . '?r=' . $m[1] . '/transaction/' . $ID . '/');

		}

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'transaction')) {

	if(is_numeric($ID)) {

		$exist = cell_count("bills", "id", $ID);

		id_count($exist, "Impossible de trouver cette facture dans la base de données.");

		$facture = find_one("bills", "id", $ID);
		
		$client = find_one("clients", "id", $facture->client_id);

		$depositcounter = cell_count("payements", "pf_id", $facture->pf_id);

		$statement = find_one("init_payement", "pf_id", $facture->pf_id);
		
		
		#	Verification d'accès
		check_access(array('2'));


    	if(is_already_use("init_payement", "client_id", $facture->client_id, " AND pf_id='$facture->pf_id'")) {

    		$deposit = find_all("payements", " WHERE statement_id='$statement->id' ORDER BY id ASC");

    		if(isset($_POST['depositsubmit'])) {

				$error = [];

				if(not_empty(['amount'])) {

					extract($_POST);

			        if(!is_numeric($amount)) {

			        	$error[1] = "Votre saisie ne correspond pas à un montant valable.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $amount;

			            $msg = $error[1];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }

			        if(count($error) == 0) {

			        	$tac = ($statement->tac + $amount);
                		$rap = ($statement->ttc - $tac);

                		if ($statement->rap === 0) {

                			set_flash("Le versement n'a pas été pris en compte car la facture a été déjà soldée.", "warning");

							redirect(WURI . '?r=' . $m[1] . '/transaction/' . $ID . '/');

                		}

		        	 	$q = $db->prepare("UPDATE init_payement SET tac=:tac, rap=:rap, created=:created WHERE id=:id");

		        	 	$r = $db->prepare("INSERT INTO payements(statement_id, pf_id, payed_amount, created) VALUES(:statement_id, :pf_id, :payed_amount, :created)");

						$q->execute([
		                    'tac' => $tac,
		                    'rap' => $rap,
                			'created' => date('Y-m-d H:i:s'),
                			'id' => $statement->id
		                ]);


	                    $r->execute([
	                        'statement_id' => $statement->id,
	                        'pf_id' => $facture->pf_id,
	                        'payed_amount' => $amount,
	                        'created' => date('Y-m-d H:i:s')
	                    ]);

						set_flash("Versement enregistrer avec succès.", "success");

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $facture->pf_id;

			            $msg = "Versement enregistrer avec succès.";

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);


						redirect(WURI . '?r=' . $m[1] . '/transaction/' . $ID . '/');

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

    	} else {

    		$q = $db->prepare("INSERT INTO init_payement(client_id, pf_id, ttc, created) VALUES(:client_id, :pf_id, :ttc, :created)");

			$q->execute([
                'client_id' => $facture->client_id,
                'pf_id' => $facture->pf_id,
                'ttc' => $facture->numeric_ttc_price,
                'created' => date('Y-m-d H:i:s')
            ]);

            $statement_id = $db->lastInsertId();

            if(isset($_POST['depositsubmit'])) {

				$error = [];

				if(not_empty(['amount'])) {

					extract($_POST);

			        if(!is_numeric($amount)) {

			        	$error[1] = "Votre saisie ne correspond pas à un montant valable.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $amount;

			            $msg = $error[1];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }

			        if(count($error) == 0) {

		        	 	$q = $db->prepare("UPDATE init_payement SET tac=:tac, rap=:rap, created=:created WHERE pf_id=:pf_id");

		        	 	$r = $db->prepare("INSERT INTO payements(statement_id, pf_id, payed_amount, created) VALUES(:statement_id, :pf_id, :payed_amount, :created)");

						$q->execute([
		                    'tac' => $amount,
		                    'rap' => $facture->numeric_ttc_price - $amount,
                			'created' => date('Y-m-d H:i:s'),
                			'bc_id' => $facture->pf_id
		                ]);

	                    $r->execute([
	                        'statement_id' => $statement_id,
	                        'pf_id' => $facture->pf_id,
	                        'payed_amount' => $pamount,
	                        'created' => date('Y-m-d H:i:s')
	                    ]);

						set_flash("Versement enregistrer avec succès.", "success");

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $facture->pf_id;

			            $msg = "Versement enregistrer avec succès.";

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);


						redirect(WURI . '?r=' . $m[1] . '/transaction/' . $ID . '/');

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

    	}


		#	Liste
		require PAGES . $subpage . '_factures.deposit.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'client-transactions')) {

	if(is_numeric($ID)) {

		$exist = cell_count("clients", "id", $ID);

		id_count($exist, "Impossible de trouver ce client dans la base de données.");

		$client = find_one("clients", "id", $ID);

		$statementcounter__ = cell_count("init_payement", "client_id", $client->id);

		$statement__ = find_all("init_payement", "client_id", $client->id);
		

		check_access(array('2'));


		#	Liste
		require PAGES . $subpage . '_factures.client-deposit.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






else {

	$facturescounter__ = count_all("bills");
		
	$nbpages = ceil($facturescounter__/$limit);

	if(!empty($_GET['s']) && is_numeric($_GET['s'])) {

		$page = intval($_GET['s']);

		if($page >= 1 && $page <= $nbpages) { $current = $page; }

		elseif($page < 1) { $current = 1; }

		else { $current = $nbpages; }

	}

	$start = ($current * $limit - $limit);

	$factures__ = find_all("bills", " ORDER BY id DESC LIMIT $start, $limit");


	#	Liste
	require PAGES . $subpage . '_factures.list.php';

}

$__factures = ob_get_clean();



#	Ajout de la vue
require PAGES . '/comptability/factures/factures.php';

?>