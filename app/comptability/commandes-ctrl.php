<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#	Baseline
$i = 1;
	
$current = 1;

$limit = 10;

$subpage = '/comptability/commandes/parts/';

$compteur = find_all("bc");

$curr = array_search($ID, array_column($compteur, 'id'));

$next = nextElement($compteur, $curr);

$prev = prevElement($compteur, $curr);


ob_start();

if(isset($con) && ($con === 'nouvelle')) {

	if(isset($_SESSION['provider'])) {

		$PID = $_SESSION['provider'];

		$provider = find_one("providers", "id", $PID);


		if(isset($_POST['newsubmit'])) {

			$error = [];

			if(not_empty(['dating', 'description'])) {

				extract($_POST);

				if(count($error) == 0) {

					$bc_id = rand(100, 999999);

					$q = $db->prepare("INSERT INTO bc(bc_id, f_id, description, dating, created) VALUES(:bc_id, :f_id, :description, :dating, :created)");

					$q->execute([
		                'bc_id' => $bc_id,
		                'f_id' => $PID,
		                'description' => $description,
		                'dating' => $dating,
		                'created' => date('Y-m-d H:i:s')
		            ]);

		            $bcid = $db->lastInsertId();

					redirect(WURI . '?r=' . $m[1] . '/edition/etape-2/' . $bcid . '/');

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
		require PAGES . $subpage . '_commandes.new.php';

	} else {

		set_flash("L'identifiant du fournisseur nous est inconnu.", "warning");

		redirect(WURI . '?r=fournisseurs/');

	}

}






elseif(isset($con) && ($con === 'infos')) {

	if(is_numeric($ID)) {

		$exist = cell_count("bc", "id", $ID);

		id_count($exist, "Impossible de trouver cette commande dans la base de données.");

		$commande = find_one("bc", "id", $ID);
		
		$provider = find_one("providers", "id", $commande->f_id);


		#	Liste
		require PAGES . $subpage . '_commandes.infos.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'edition')) {

	if(is_numeric($ID)) {

		$exist = cell_count("bc", "id", $ID);

		id_count($exist, "Impossible de trouver cette commande dans la base de données.");

		$commande = find_one("bc", "id", $ID);

		$provider = find_one("providers", "id", $commande->f_id);

		
		if(isset($vue) && ($vue != $ID) && ($vue === 'etape-1')) {

			if(isset($_POST['steponesubmit'])) {

				$error = [];

				if(not_empty(['dating', 'description'])) {

					extract($_POST);

					if(count($error) == 0) {

						$q = $db->prepare("UPDATE bc SET description=:description, dating=:dating, created=:created WHERE id=:id");

						$q->execute([
			                'description' => $description,
			                'dating' => $dating,
			                'created' => date('Y-m-d H:i:s'),
			                'id' => $ID
			            ]);

						redirect(WURI . '?r=' . $m[1] . '/edition/etape-2/' . $ID . '/');

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

		elseif(isset($vue) && ($vue != $ID) && ($vue === 'etape-2')) {

			if(isset($_POST['steptwosubmit'])) {

				$error = [];

				if($commande->dating === "" || $commande->description === "") {

					save_input_data();

					$error[] = "Assurez-vous d'avoir saisie la datation etla description pour le bon.";

			            
		            $field = $con;

		            $title = $m[1] . ', Comptabilité';

		            $msg = "Assurez-vous d'avoir saisie la datation et la description pour le bon.";

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		            redirect(WURI . '?r=' . $m[1] . '/edition/etape-2/' . $ID . '/');

				}

				if(not_empty(['qte', 'pu', 'ht'])) {

					extract($_POST);

			        if(!is_numeric($qte)) {

			        	$error[1] = "Votre saisie ne correspond pas à un chiffre.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $commande->bc_id;

			            $msg = $error[1];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }

			        if(!is_numeric($pu)) {

			        	$error[2] = "Votre saisie ne correspond pas à un montant.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $commande->bc_id;

			            $msg = $error[2];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }

			        if(!is_numeric($ht)) {

			        	$error[3] = "Votre saisie ne correspond pas à un montant.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $commande->bc_id;

			            $msg = $error[3];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }

			        if(!is_numeric($transport)) {

			        	$error[4] = "Votre saisie ne correspond pas à un montant.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $commande->bc_id;

			            $msg = $error[4];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }


			        if(count($errors) == 0) {

						$q = $db->prepare("UPDATE bc SET qte=:qte, pu=:pu, ht=:ht, transport=:transport, created=:created WHERE id=:id");

			            $q->execute([
			                'qte' => $qte,
			                'pu' => $pu,
			                'ht' => $ht,
			                'transport' => $transport,
			                'created' => date('Y-m-d H:i:s'),
			                'id' => $ID
			            ]);

						redirect(WURI . '?r=' . $m[1] . '/edition/etape-3/' . $ID . '/');

					} else {save_input_data();}

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

		elseif(isset($vue) && ($vue != $ID) && ($vue === 'etape-3')) {

			if(isset($_POST['stepthreesubmit'])) {

				$error = [];

				if($commande->qte === "0" || $commande->pu === "0" || $commande->ht === "0") {

					save_input_data();

					$error[] = "Assurez-vous d'avoir saisie la quantité, le prix unitaire, et le montant hors-taxe pour le bon.";

			            
		            $field = $con;

		            $title = $m[1] . ', Comptabilité';

		            $msg = "Assurez-vous d'avoir saisie la quantité, le prix unitaire, et le montant hors-taxe pour le bon.";

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		            redirect(WURI . '?r=' . $m[1] . '/edition/etape-2/' . $ID . '/');

				}

				if(not_empty(['odp', 'tm'])) {

					extract($_POST);

			        if(!is_numeric($odp)) {

			        	$error[1] = "Votre saisie ne correspond pas à un montant.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $commande->bc_id;

			            $msg = $error[1];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }

			        if(!is_numeric($tm)) {

			        	$error[2] = "Votre saisie ne correspond pas à un montant.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $commande->bc_id;

			            $msg = $error[2];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }

			        if(!is_numeric($other_tax_amount)) {

			        	$error[5] = "Votre saisie ne correspond pas à un montant.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $commande->bc_id;

			            $msg = $error[5];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }


			        if (count($errors) == 0) {

						$q = $db->prepare("UPDATE bc SET odp=:odp, tm=:tm, other_tax=:other_tax, other_tax_name=:other_tax_name, other_tax_amount=:other_tax_amount, created=:created WHERE id=:id");

			            $q->execute([
			                'odp' => $odp,
			                'tm' => $tm,
			                'other_tax' => $other_tax,
			                'other_tax_name' => $other_tax_name,
			                'other_tax_amount' => $other_tax_amount,
			                'created' => date('Y-m-d H:i:s'),
			                'id' => $ID
			            ]);

						redirect(WURI . '?r=' . $m[1] . '/edition/etape-4/' . $ID . '/');

					} else {save_input_data();}

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

		elseif(isset($vue) && ($vue != $ID) && ($vue === 'etape-4')) {

			if(isset($_POST['stepfoursubmit'])) {

				$error = [];

				if($commande->odp === "0" || $commande->tm === "0") {

					save_input_data();

					$error[] = "Assurez-vous d'avoir saisie lmontant lié à l'ODP, et à la TM pour le bon.";

			            
		            $field = $con;

		            $title = $m[1] . ', Comptabilité';

		            $msg = "Assurez-vous d'avoir saisie lmontant lié à l'ODP, et à la TM pour le bon.";

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		            redirect(WURI . '?r=' . $m[1] . '/edition/etape-2/' . $ID . '/');

				}

				if(not_empty(['tva', 'tsp', 'ttc'])) {

					extract($_POST);

			        if(!is_numeric($tva)) {

			        	$error[1] = "Votre saisie ne correspond pas à un montant.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $commande->bc_id;

			            $msg = $error[1];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }

			        if(!is_numeric($tsp)) {

			        	$error[2] = "Votre saisie ne correspond pas à un montant.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $commande->bc_id;

			            $msg = $error[2];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }

			        if(!is_numeric($ttc)) {

			        	$error[3] = "Votre saisie ne correspond pas à un montant.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $commande->bc_id;

			            $msg = $error[3];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }


			        if(count($errors) == 0) {

						$q = $db->prepare("UPDATE bc SET tva=:tva, tsp=:tsp, ttc=:ttc, created=:created WHERE id=:id");

			            $q->execute([
			                'tva' => $tva,
			                'tsp' => $tsp,
			                'ttc' => $ttc,
			                'created' => date('Y-m-d H:i:s'),
			                'id' => $ID
			            ]);

						set_flash("Le bon de commande a été générer avec succès.", "success");

						$_SESSION["provider"] = "";

				            
			            $field = $con;

			            $title = $m[1] . ', ' . $provider->p_name;

			            $msg = "Le bon de commande $commande->bc_id a été générer avec succès.";

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

						redirect(WURI . '?r=' . $m[1] . '/infos/' . $ID . '/');

					} else {save_input_data();}

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
		require PAGES . $subpage . '_commandes.edit.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'suppression')) {

	if(is_numeric($ID)) {

		$exist = cell_count("bc", "id", $ID);

		id_count($exist, "Impossible de trouver cette commande dans la base de données.");

		$commande = find_one("bc", "id", $ID);
		
		$provider = find_one("providers", "id", $commande->f_id);

		$statement = find_one("init_deposit", "bc_id", $commande->bc_id);


		check_access(array('2'));


		if(isset($vue) && ($vue != $ID) && ($vue === 'depot')) {
			
			if(isset($_POST)) {

				extract($_POST);

				$deposit = find_one("deposit", "id", $hID);

				$tac = ($statement->tac - $deposit->deposit_amount);
	            
	            $rap = ($statement->rap + $deposit->deposit_amount);

	            $q = $db->prepare("UPDATE init_deposit SET tac=:tac, rap=:rap, created=:created WHERE id=:id");
	            
	            $q->execute([
	                'tac' => $tac,
	                'rap' => $rap,
	                'created' => date('Y-m-d H:i:s'),
	                'id' => $deposit->init_id
	            ]);

				set_flash("Le versement a été supprimer avec succès.", "success");

		            
	            $field = $con;

	            $title = $m[1] . ', ' . $commande->bc_id;

	            $msg = "Le versement a été supprimer avec succès.";

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);


				delete_one('deposit', 'id', $hID);


				redirect(WURI . '?r=' . $m[1] . '/transaction/' . $ID . '/');

			}

		} elseif(isset($vue) && ($vue != $ID) && ($vue === 'bc')) {

			if(isset($_POST)) {

				extract($_POST);

				set_flash("La commande a été supprimer avec succès.", "success");

		            
	            $field = $con;

	            $title = $m[1] . ', ' . $commande->bc_id;

	            $msg = "La commande a été supprimer avec succès.";

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);


				delete_one('bc', 'id', $ID);


				redirect(WURI . '?r=' . $m[1] . '/');

			}

		}

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'transaction')) {

	if(is_numeric($ID)) {

		$exist = cell_count("bc", "id", $ID);

		id_count($exist, "Impossible de trouver cette commande dans la base de données.");

		$commande = find_one("bc", "id", $ID);
		
		$provider = find_one("providers", "id", $commande->f_id);

		$depositcounter = cell_count("deposit", "bc_id", $commande->bc_id);

		$statement = find_one("init_deposit", "bc_id", $commande->bc_id);


		check_access(array('2'));


    	if(is_already_use("init_deposit", "f_id", $commande->f_id, " AND bc_id='$commande->bc_id'")) {

    		$deposit = find_all("deposit", " WHERE init_id='$statement->id' ORDER BY id ASC");

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

		        	 	$q = $db->prepare("UPDATE init_deposit SET tac=:tac, rap=:rap, created=:created WHERE id=:id");

		        	 	$r = $db->prepare("INSERT INTO deposit(init_id, bc_id, deposit_amount, created) VALUES(:init_id, :bc_id, :deposit_amount, :created)");

						$q->execute([
		                    'tac' => $tac,
		                    'rap' => $rap,
                			'created' => date('Y-m-d H:i:s'),
                			'id' => $statement->id
		                ]);


	                    $r->execute([
	                        'init_id' => $statement->id,
	                        'bc_id' => $commande->bc_id,
	                        'deposit_amount' => $amount,
	                        'created' => date('Y-m-d H:i:s')
	                    ]);

						set_flash("Versement enregistrer avec succès.", "success");

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $commande->bc_id;

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

    		update_one("bc", "state", "Oui", $ID);

    		$q = $db->prepare("INSERT INTO init_deposit(f_id, bc_id, ttc, created) VALUES(:f_id, :bc_id, :ttc, :created)");

			$q->execute([
                'f_id' => $commande->f_id,
                'bc_id' => $commande->bc_id,
                'ttc' => $commande->ttc,
                'created' => date('Y-m-d H:i:s')
            ]);

            $init_id = $db->lastInsertId();

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

		        	 	$q = $db->prepare("UPDATE init_deposit SET tac=:tac, rap=:rap, created=:created WHERE bc_id=:bc_id");

		        	 	$r = $db->prepare("INSERT INTO deposit(init_id, bc_id, deposit_amount, created) VALUES(:init_id, :bc_id, :deposit_amount, :created)");

						$q->execute([
		                    'tac' => $amount,
		                    'rap' => $commande->ttc - $amount,
                			'created' => date('Y-m-d H:i:s'),
                			'bc_id' => $commande->bc_id
		                ]);

	                    $r->execute([
	                        'init_id' => $init_id,
	                        'bc_id' => $commande->bc_id,
	                        'deposit_amount' => $pamount,
	                        'created' => date('Y-m-d H:i:s')
	                    ]);

						set_flash("Versement enregistrer avec succès.", "success");

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $commande->bc_id;

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
		require PAGES . $subpage . '_commandes.deposit.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






else {

	$commandescounter__ = count_all("bc");
		
	$nbpages = ceil($commandescounter__/$limit);

	if(!empty($_GET['s']) && is_numeric($_GET['s'])) {

		$page = intval($_GET['s']);

		if($page >= 1 && $page <= $nbpages) { $current = $page; }

		elseif($page < 1) { $current = 1; }

		else { $current = $nbpages; }

	}

	$start = ($current * $limit - $limit);

    $commandes__ = find_all("bc", " ORDER BY id DESC LIMIT $start, $limit");


	#	Liste
	require PAGES . $subpage . '_commandes.list.php';

}

$__commandes = ob_get_clean();



#	Ajout de la vue
require PAGES . '/comptability/commandes/commandes.php';

?>
