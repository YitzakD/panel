<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#	Ferme toute les reservations correspondants à des campagnes finies
closedfinishedrsv();

#	Baseline
$i = 1;
	
$current = 1;

$limit = 10;

$subpage = '/regie/reservations/parts/';

$compteur = find_all("init_rsv", "WHERE etat='En attente'");

$curr = array_search($ID, array_column($compteur, 'id'));

$next = nextElement($compteur, $curr);

$prev = prevElement($compteur, $curr);


ob_start();

if(isset($con) && ($con === 'nouvelle')) {

	if(isset($_POST['newsubmit'])) {

		$error = [];

		if (not_empty(['camp_name'])) {

			extract($_POST);

	        if(cell_count("clients", "id", $client_id) < 1) {

	        	$error[1] = "Impossible de retrouver ce client dans la base de données.";

	            
	            $field = $con;

	            $title = $m[1] . ', Atteinte à l\'intégrité de la BDD';

	            $msg = $error[1];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

	        if(mb_strlen($camp_name) < 2) {

	        	$error[2] = "Le libellé doit contenir au moins deux (2) lettres.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $camp_name;

	            $msg = $error[2];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

			if(is_already_use("init_rsv", "camp_name", $camp_name, " AND client_id='$client_id'")) {

	            $error[2] = "Ce client à déjà une réservation qui porte le même libellé.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $camp_name;

	            $msg = $error[2];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

			if(is_already_use("init_rsv", "client_id", $client_id, " AND etat='En attente'")) {

	            $error[2] = "Ce client n'a pas encore confirmé sa précédente réservation.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $camp_name;

	            $msg = $error[2];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }
	        

	        if(count($error) == 0) {

                $q = $db->prepare("INSERT INTO init_rsv(client_id,camp_name,created) VALUES(:client_id, :camp_name, :created)");

                $q->execute([
                    'client_id' => $client_id,
                    'camp_name' => $camp_name,
                    'created' => date('Y-m-d H:i:s')
                ]);

	            $rsvid = $db->lastInsertId();

				redirect(WURI . '?r=' . $m[1] . '/edition/etape-2/' . $rsvid . '/');

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
	require PAGES . $subpage . '_reservations.new.php';

}






elseif(isset($con) && ($con === 'infos')) {

	if(is_numeric($ID)) {

		$exist = cell_count("init_rsv", "id", $ID);

		id_count($exist, "Impossible de trouver cette réservation dans la base de données.");

		$reservation = find_one("init_rsv", "id", $ID);

		$client = find_one("clients", "id", $reservation->client_id);

		$rsvd_nbrcounter  = cell_count("rsv", "init_id", $ID);

		$rsvd_nbr  = find_all("rsv", " WHERE init_id='$ID'");
		

		if($reservation->etat != "En attente") {

			$campinfo = find_one("init_camp", "init_rid", $ID);

			redirect(WURI . '?r=campagnes/infos/' . $campinfo->id . '/');

		}

		
		#	Liste
		require PAGES . $subpage . '_reservations.infos.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'edition')) {

	if(is_numeric($ID)) {

		$exist = cell_count("init_rsv", "id", $ID);

		id_count($exist, "Impossible de trouver cette réservation dans la base de données.");

		$reservation = find_one("init_rsv", "id", $ID);

		$client = find_one("clients", "id", $reservation->client_id);

		$rsvd_nbr  = find_all("rsv", " WHERE init_id='$ID'");


		if(isset($vue) && ($vue != $ID) && ($vue === 'etape-1')) {

			if(isset($_POST['steponesubmit'])) {

				$error = [];

				if (not_empty(['camp_name'])) {

					extract($_POST);

			        if(cell_count("clients", "id", $reservation->client_id) < 1) {

			        	$error[1] = "Impossible de retrouver ce client dans la base de données.";

			            
			            $field = $con;

			            $title = $m[1] . ', Atteinte à l\'intégrité de la BDD';

			            $msg = $error[1];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }

			        if(mb_strlen($camp_name) < 2) {

			        	$error[2] = "Le libellé doit contenir au moins deux (2) lettres.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $camp_name;

			            $msg = $error[2];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }

					if(is_already_use("init_rsv", "camp_name", $camp_name, " AND client_id='$reservation->client_id'")) {

			            $error[2] = "Ce client à déjà une réservation qui porte le même libellé.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $camp_name;

			            $msg = $error[2];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }
			        

			        if(count($error) == 0) {

		                $q = $db->prepare("UPDATE init_rsv SET camp_name=:camp_name, created=:created WHERE id=:id");

		                $q->execute([
		                    'camp_name' => $camp_name,
		                    'created' => date('Y-m-d H:i:s'),
		                    'id' => $ID
		                ]);

						redirect(WURI . '?r=' . $m[1] . '/edition/etape-2/' . $ID . '/');

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

		}

		elseif(isset($vue) && ($vue != $ID) && ($vue === 'etape-2')) {

			if(isset($_POST['steptwosubmit'])) {

				$error = [];

				if($reservation->camp_name === "") {

					save_input_data();

					$error[] = "Assurez-vous que le libellé n'est pas vide.";

			            
		            $field = $con;

		            $title = $m[1] . ', Régie';

		            $msg = "Assurez-vous que le libellé n'est pas vide.";

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		            redirect(WURI . '?r=' . $m[1] . '/edition/etape-1/' . $ID . '/');

				}


				if (not_empty(['debut', 'fin'])) {

					extract($_POST);

		            if($fin < $debut) { 

		            	$error[1] = "La date de fin d'une réservation ne peut être inférieur à sa date de début.";

			            
			            $field = $con;

			            $title = $m[1] . ', Atteinte à l\'intégrité de la BDD';

			            $msg = $error[1];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);
		            }


					if(count($error) == 0) {

			            $q = $db->prepare("UPDATE init_rsv SET debut=:debut, fin=:fin, created=:created WHERE id=:id");

			            $q->execute([
			                'debut' => $debut,
			                'fin' => $fin,
			                'created' => date('Y-m-d H:i:s'),
			                'id' => $ID
			            ]);

						redirect(WURI . '?r=' . $m[1] . '/edition/etape-3/' . $ID . '/');

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

		}

		elseif(isset($vue) && ($vue != $ID) && ($vue === 'etape-3')) {

			$state = "ras";
			
			$size = find_one("sizes", "size", "12");

			$fid = $size->id;

			if(isset($_POST['stepthreesubmit'])) {

				$error = [];

				if($reservation->debut === "0000-00-00" || $reservation->fin === "0000-00-00") {

					save_input_data();

					$error[] = "Assurez-vous d'avoir definit les dates de debut et de fin de l'opération.";

			            
		            $field = $con;

		            $title = $m[1] . ', Régie';

		            $msg = "Assurez-vous d'avoir definit les dates de debut et de fin de l'opération.";

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		            redirect(WURI . '?r=' . $m[1] . '/edition/etape-2/' . $ID . '/');

				}

			
				extract($_POST);

				if(not_empty__(['sboard'])) {

	    			if(count($sboard) < 1) { $error = "Vous devez choisir un ou plusieurs panneaux."; }

	    			if(count($error) == 0) {

	    				$q = $db->prepare("INSERT INTO rsv(init_id,nbr) VALUES(:init_id, :nbr)");

		    			foreach ($sboard as $value) {

		    				if(!(f_inarray($value, 'nbr', $rsvd_nbr))) {

				    			$q->execute([
							        'init_id' => $ID,
							        'nbr' => $value
							    ]);

		    				}

			    		}

						redirect(WURI . '?r=' . $m[1] . '/edition/etape-4/' . $ID . '/');

	    			} else { save_input_data(); }

				} else {

		        	save_input_data();

		        	$error[] = "Vous n'avez fait aucun choix de panneaux.";

			            
		            $field = $con;

		            $title = $m[1] . ', Régie';

		            $msg = "Vous n'avez fait aucun choix de panneaux.";

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

	        	}

			} else { clear_input_data(); }

		}

		elseif(isset($vue) && ($vue != $ID) && ($vue === 'etape-4')) {

			if(isset($_POST['stepfoursubmit'])) {

				set_flash("La réservation a été créer avec succès.", "success");
		            
	            $field = $con;

	            $title = $m[1] . ', ' . $reservation->camp_name;

	            $msg = "La réservation $reservation->camp_name a été créer avec succès.";

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);
				

				redirect(WURI . '?r=' . $m[1] . '/infos/' . $ID . '/');

			} else { clear_input_data(); }

		}

		
		#	Liste
		require PAGES . $subpage . '_reservations.edit.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'suppression')) {

	if(is_numeric($ID)) {

		$exist = cell_count("init_rsv", "id", $ID);

		id_count($exist, "Impossible de trouver cette réservation dans la base de données.");

		$reservation = find_one("init_rsv", "id", $ID);

		$rsvd_nbrcounter  = cell_count("rsv", "init_id", $ID);

		$rsvd_nbr  = find_all("rsv", " WHERE init_id='$ID'");



		if(isset($vue) && ($vue != $ID) && ($vue === 'vider')) {

			if(isset($_POST)) {

				extract($_POST);


				set_flash("La réservation a été vider avec succès.", "success");
		            
	            $field = $con;

	            $title = $m[1] . ', ' . $reservation->camp_name;

	            $msg = "La réservation $reservation->camp_name a été vider avec succès.";

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	            delete_all("rsv", "init_id", $ID);
				

				redirect(WURI . '?r=' . $m[1] . '/infos/' . $ID . '/');

			} else { clear_input_data(); }

		}

		elseif(isset($vue) && ($vue != $ID) && ($vue === 'soustraire')) {

			if(isset($_POST)) {

				extract($_POST);

				$info = find_one("rsv", "id", $SBHID);

				set_flash("Le panneau DEV-$info->nbr a été supprimer de la réservation avec succès.", "success");
		            
	            $field = $con;

	            $title = $m[1] . ', ' . $reservation->camp_name;

	            $msg = "Le panneau DEV-$info->nbr a été supprimer de la réservation $reservation->camp_name avec succès.";

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	            delete_one("rsv", "id", $SBHID);
				

				redirect(WURI . '?r=' . $m[1] . '/infos/' . $ID . '/');

			} else { clear_input_data(); }

		}

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'validation')) {

	if(is_numeric($ID)) {

		$exist = cell_count("init_rsv", "id", $ID);

		id_count($exist, "Impossible de trouver cette réservation dans la base de données.");

		$reservation = find_one("init_rsv", "id", $ID);

		$rsvd_nbrcounter  = cell_count("rsv", "init_id", $ID);

		$rsvd_nbr  = find_all("rsv", " WHERE init_id='$ID'");
		

    	if(isset($_POST)) {

			$error = [];

			$utype = get_session("type");

			$link = WURI . '?r=' . $m[1] . '/infos/' . $ID . '/';

			if($utype === "1") {

				extract($_POST);

				if($ID === $RHID) {

					$q = $db->prepare("INSERT INTO init_camp(init_rid,client_id,camp_name,debut,fin,created) VALUES(:init_rid, :client_id, :camp_name, :debut, :fin, :created)");

					$r = $db->prepare("INSERT INTO camps(init_id,init_rid,nbr,debut,fin) VALUES(:init_id, :init_rid, :nbr, :debut, :fin)");

					$s = $db->prepare("UPDATE init_rsv SET etat=:etat, created=:created WHERE id=:id");


					$q->execute([
						'init_rid' => $ID,
						'client_id' => $reservation->client_id,
						'camp_name' => $reservation->camp_name,
						'debut' => $reservation->debut,
						'fin' => $reservation->fin,
						'created' => date('Y-m-d H:i:s')
					]);

					$initID = $db->lastInsertId();

					if($initID) {

						foreach ($rsvd_nbr as $value) {

							$r->execute([
								'init_id' => $initID,
								'init_rid' => $ID,
								'nbr' => $value->nbr,
								'debut' => $reservation->debut,
								'fin' => $reservation->fin
							]);

						}

						$s->execute([
							'etat' => "En cours",
							'created' => date('Y-m-d H:i:s'),
							'id' => $ID
						]);


						set_flash("La réservation a été valider avec succès.", "success");
				            
			            $field = $con;

			            $title = $m[1] . ', ' . $reservation->camp_name;

			            $msg = "La réservation $reservation->camp_name a été valider avec succès.";

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			            
			            $ni = find_all("notifications", "WHERE description='La réservation $reservation->camp_name en attente de validation' AND dest='1' AND state='on' AND type='H'");

			            if(count($ni) > 0) {

				            foreach($ni as $value) {

	                			set_notifier("S", "La réservation $reservation->camp_name a été validé", get_session("uid"), $value->starter_id, $link);
				            
				            }

			        	}


			            $managers = find_all("users", "WHERE utid!='1'");

			            foreach($managers as $item) {

			            	$cellcounter = cell_count("notifications", "description", "La réservation $reservation->camp_name a été validé", "AND dest='$item->id' AND type='S' AND state='on'");

			            	if($cellcounter < 1) {

			            		set_notifier("S", "La réservation $reservation->camp_name a été validé", get_session("uid"), $item->id, $link);

			            	}
			            
			            }
						
						redirect(WURI . '?r=campagnes/infos/' . $ID . '/');

					}

				} else {

					save_input_data();

					$error[] = "Impossible de valider cette campagne pour le moment. Les données reccueillies ne correspondent pas.";

			            
		            $field = $con;

		            $title = $m[1] . ', Atteinte à l\'intégrité de la BDD';

		            $msg = "Impossible de valider cette campagne pour le moment. Les données reccueillies ne correspndent pas.";

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);
					

					redirect(WURI . '?r=' . $m[1] . '/infos/' . $ID . '/');

				}

			} else {

	            set_flash("Votre demande de validation a été notifier.", "info");


				$field = $con;

	            $title = $m[1] . ', Notification';

	            $msg = "Votre demande de validation a été notifier.";

	            $year = date("Y");


				$managers = find_all("users", " WHERE utid='1'");
				foreach($managers as $item) {

					set_notifier("H", "La réservation $reservation->camp_name en attente de validation", get_session("uid"), $item->id, $link);

				}

	            set_activity(get_session("uid"), $field, $title, $msg);

				redirect(WURI . '?r=' . $m[1] . '/');

			}

		} else { clear_input_data(); }

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






else {
	
	$reservationscounter__ = count_all("init_rsv");
		
	$nbpages = ceil($reservationscounter__/$limit);

	if(!empty($_GET['s']) && is_numeric($_GET['s'])) {

		$page = intval($_GET['s']);

		if($page >= 1 && $page <= $nbpages) { $current = $page; }

		elseif($page < 1) { $current = 1; }

		else { $current = $nbpages; }

	}

	$start = ($current * $limit - $limit);

    $reservations__ = find_all("init_rsv", " ORDER BY id DESC LIMIT $start, $limit");
    

	#	Liste
	require PAGES . $subpage . '_reservations.list.php';

}

$__reservations = ob_get_clean();



#	Ajout de la vue
require PAGES . '/regie/reservations/reservations.php';

?>