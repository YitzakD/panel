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

$subpage = '/regie/campagnes/parts/';

$compteur = find_all("init_rsv", "WHERE etat!='En attente' AND etat!='Closed'");

$curr = array_search($ID, array_column($compteur, 'id'));

$next = nextElement($compteur, $curr);

$prev = prevElement($compteur, $curr);


ob_start();

if(isset($con) && ($con === 'infos')) {

	if(is_numeric($ID)) {

		$exist = cell_count("init_rsv", "id", $ID);

		id_count($exist, "Impossible de trouver cette réservation dans la base de données.");

		$campagne = find_one("init_rsv", "id", $ID);

		$client = find_one("clients", "id", $campagne->client_id);

		$rsvd_nbrcounter  = cell_count("rsv", "init_id", $ID);

		$rsvd_nbr  = find_all("rsv", " WHERE init_id='$ID'");


    	#	Liste
		require PAGES . $subpage . '_campagnes.infos.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'edition')) {

	if(is_numeric($ID)) {

		$exist = cell_count("init_camp", "init_rid", $ID);

		id_count($exist, "Impossible de trouver cette réservation dans la base de données.");

		$campagne = find_one("init_camp", "init_rid", $ID);

		$client = find_one("clients", "id", $campagne->client_id);

		$rsvd_nbrcounter  = cell_count("camps", "init_rid", $ID);

		$rsvd_nbr  = find_all("camps", " WHERE init_rid='$ID'");

		$campinfo  = find_one("init_rsv", "id", $ID);
		
		
		#	Verification d'accès
		check_access(array('1'));


		if(isset($vue) && ($vue != $ID) && ($vue === 'etape-1')) {

			if(isset($_POST['steponesubmit'])) {

				$error = [];

				if (not_empty(['camp_name', 'fin'])) {

					extract($_POST);

			        if(mb_strlen($camp_name) < 2) {

			        	$error[1] = "Le libellé doit contenir au moins deux (2) lettres.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $camp_name;

			            $msg = $error[1];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }

					if(is_already_use("init_camp", "camp_name", $camp_name) && $camp_name !== $campagne->camp_name) {

			            $error[1] = "Ce libellé est dejà utilié.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $camp_name;

			            $msg = $error[1];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }

			        if($fin < $campagne->debut) {

			        	$error[2] = "La date de fin d'une campagne ne peut être inférieur à sa date de début.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $campagne->camp_name;

			            $msg = $error[2];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }
			        

			        if(count($error) == 0) {

			        	if($campagne->camp_name !== $camp_name) {

							$field = $con;

				            $title = $m[1] . ', ' . $campagne->camp_name;

				            $msg = "Le libellé de la campagne $campagne->camp_name a été modifier en <b>$camp_name</b> avec succès.";

				            $year = date("Y");


			        		update_one("init_camp", "camp_name", $camp_name, $campagne->id);

			        		update_one("init_rsv", "camp_name", $camp_name, $ID);


				            set_activity(get_session("uid"), $field, $title, $msg);

			        	}


			        	if($campagne->fin !== $fin) {

			        		update_one("init_camp", "fin", $fin, $campagne->id);

			        		update_all("camps", "fin", $fin, "init_rid='$ID'");

			        		update_one("init_rsv", "fin", $fin, $ID);
					            

				            $field = $con;

				            $title = $m[1] . ', ' . $camp_name;

				            $msg = "La date de fin de la campagne $camp_name a été modifier avec succès.";

				            $year = date("Y");

				            set_activity(get_session("uid"), $field, $title, $msg);

			        	}

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

			$state = "ras";
			
			$size = find_one("sizes", "size", "12");

			$fid = $size->id;

			if(isset($_POST['steptwosubmit'])) {

				$error = [];

				if($campagne->fin === "0000-00-00") {

					save_input_data();

					$error[] = "Assurez-vous d'avoir definit la date de fin de l'opération.";

			            
		            $field = $con;

		            $title = $m[1] . ', Régie';

		            $msg = "Assurez-vous d'avoir definit la date de fin de l'opération.";

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		            redirect(WURI . '?r=' . $m[1] . '/edition/etape-1/' . $ID . '/');

				}

			
				extract($_POST);

				if(not_empty__(['sboard'])) {

	    			if(count($sboard) < 1) { $error = "Vous devez choisir un ou plusieurs panneaux."; }

	    			if(count($error) == 0) {

	    				$q = $db->prepare("INSERT INTO rsv(init_id,nbr) VALUES(:init_id, :nbr)");

	    				$r = $db->prepare("INSERT INTO camps(init_id,init_rid,nbr,debut,fin) VALUES(:init_id, :init_rid, :nbr, :debut, :fin)");

		    			foreach ($sboard as $value) {

		    				if(!(f_inarray($value, 'nbr', $rsvd_nbr))) {

				    			$q->execute([
							        'init_id' => $ID,
							        'nbr' => $value
							    ]);

				    			$r->execute([
							        'init_id' => $campagne->id,
							        'init_rid' => $ID,
							        'nbr' => $value,
							        'debut' => $campagne->debut,
							        'fin' => $campagne->fin
							    ]);
					            

					            $field = $con;

					            $title = $m[1] . ', ' . $campagne->camp_name;

					            $msg = "La panneau DEV-$value a été ajouter à la campagne $campagne->camp_name avec succès.";

					            $year = date("Y");

					            set_activity(get_session("uid"), $field, $title, $msg);

		    				}

			    		}

						redirect(WURI . '?r=' . $m[1] . '/edition/etape-3/' . $ID . '/');

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

		elseif(isset($vue) && ($vue != $ID) && ($vue === 'etape-3')) {

			if(isset($_POST['stepthreesubmit'])) {

				set_flash("La campagne a été modifier avec succès.", "success");
		            
	            $field = $con;

	            $title = $m[1] . ', ' . $campagne->camp_name;

	            $msg = "La campagne $campagne->camp_name a été modifier avec succès.";

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);
				

				redirect(WURI . '?r=' . $m[1] . '/infos/' . $ID . '/');

			} else { clear_input_data(); }

		}

		elseif(isset($vue) && ($vue != $ID) && ($vue === 'en-pause')) {

			if(isset($_POST['playcampsubit'])) {

				if($campinfo->etat === "En cours") {

					$q = $db->prepare("UPDATE init_rsv SET etat=:etat, created=:created WHERE id=:id");

					$q->execute([
	                    'etat' => "En pause",
	                    'created' => date('Y-m-d H:i:s'),
	                    'id' => $ID
	                ]);

					set_flash("La campagne est desormais en mode PAUSE.", "success");
		            
		            $field = $con;

		            $title = $m[1] . ', ' . $campagne->camp_name;

		            $msg = "La campagne $campagne->camp_name a été mit en mode PAUSE avec succès.";

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		            delete_all("camps", "init_rid", $ID);

		            redirect(WURI . '?r=' . $m[1] . '/');

				} elseif($campinfo->etat === "En pause") {

					$campreservednbr = find_all("rsv", "WHERE init_id='$ID'");

					$q = $db->prepare("UPDATE init_rsv SET etat=:etat, created=:created WHERE id=:id");

					$r = $db->prepare("INSERT INTO camps(init_id,init_rid,nbr,debut,fin) VALUES(:init_id, :init_rid, :nbr, :debut, :fin)");


					$q->execute([
	                    'etat' => "En cours",
	                    'created' => date('Y-m-d H:i:s'),
	                    'id' => $ID
	                ]);
	                foreach ($campreservednbr as $value) {

	                	$r->execute([
							'init_id' => $campagne->id,
							'init_rid' => $ID,
							'nbr' => $value->nbr,
							'debut' => $campinfo->debut,
							'fin' => $campinfo->fin
						]);
	                	
	                }


					set_flash("La campagne est desormais en mode PLAY.", "success");
		            
		            $field = $con;

		            $title = $m[1] . ', ' . $campagne->camp_name;

		            $msg = "La campagne $campagne->camp_name a été mit en mode PLAY avec succès.";

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);


		            redirect(WURI . '?r=' . $m[1] . '/');

				}

			}

		}

		elseif(isset($vue) && ($vue != $ID) && ($vue === 'soustraire')) {

			if(isset($_POST['delsbsubit'])) {

				extract($_POST);

				$info = find_one("rsv", "init_id", $ID, "AND id='$SBHID'");

				set_flash("Le panneau DEV-$info->nbr a été supprimer de la campagne avec succès.", "success");
		            
	            $field = $con;

	            $title = $m[1] . ', ' . $campagne->camp_name;

	            $msg = "Le panneau DEV-$info->nbr a été supprimer de la campagne $campagne->camp_name avec succès.";

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	            delete_one("rsv", "id", $SBHID, "AND init_id='$ID'");

	            $q = $db->prepare("DELETE FROM camps WHERE init_rid=:init_rid AND nbr=:nbr");

				$q->execute([
		            'init_rid' => $ID,
		            'nbr' => $info->nbr
		        ]);
				

				redirect(WURI . '?r=' . $m[1] . '/infos/' . $ID . '/');

			}

		}
		

    	#	Liste
		require PAGES . $subpage . '_campagnes.edit.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






else {

	$campagnescounter__ = count_all("init_rsv", " WHERE etat!='En attente'");
		
	$nbpages = ceil($campagnescounter__/$limit);

	if(!empty($_GET['s']) && is_numeric($_GET['s'])) {

		$page = intval($_GET['s']);

		if($page >= 1 && $page <= $nbpages) { $current = $page; }

		elseif($page < 1) { $current = 1; }

		else { $current = $nbpages; }

	}

	$start = ($current * $limit - $limit);

    $campagnes__ = find_all("init_rsv", " WHERE etat!='En attente' ORDER BY id DESC LIMIT $start, $limit");


	#	Liste
	require PAGES . $subpage . '_campagnes.list.php';

}

$__campagnes = ob_get_clean();



#	Ajout de la vue
require PAGES . '/regie/campagnes/campagnes.php';

?>