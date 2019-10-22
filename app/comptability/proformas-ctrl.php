<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#	Baseline
$i = 1;
	
$current = 1;

$limit = 10;

$subpage = '/comptability/proformas/parts/';

$compteur = find_all("pformas", "WHERE state='Non'");

$curr = array_search($ID, array_column($compteur, 'id'));

$next = nextElement($compteur, $curr);

$prev = prevElement($compteur, $curr);


ob_start();

if(isset($con) && ($con === 'nouvelle')) {

	if(isset($_POST['newsubmit'])) {

		$error = [];

		if (not_empty(['debut', 'fin'])) {

			extract($_POST);

	        if(cell_count("clients", "id", $client_id) < 1) {

	        	$error[1] = "Impossible de retrouver ce client dans la base de données.";

	            
	            $field = $con;

	            $title = $m[1] . ', Atteinte à l\'intégrité de la BDD';

	            $msg = $error[1];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

	        if(cell_count("sizes", "size", $sb_size) < 1) {

	        	$error[2] = "Impossible de retrouver ce format dans la base de données.";

	            
	            $field = $con;

	            $title = $m[1] . ', Atteinte à l\'intégrité de la BDD';

	            $msg = $error[2];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

	        $screen_type = e($screen_type);

            if($fin < $debut) { 

            	$error[5] = "La date de fin d'une campagne ne peut être inférieur à sa date de début.";

	            
	            $field = $con;

	            $title = $m[1] . ', Atteinte à l\'intégrité de la BDD';

	            $msg = $error[5];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);
            }


			if(count($error) == 0) {

				$pf_id = rand(100, 999999);

				$numeric_time = nbJours($debut, $fin);

           		$endof = substr($numeric_time, -1, 1);

				if($endof === '4' || $endof === '9') { $numeric_time = $numeric_time+1; }
				elseif($endof === '1') { $numeric_time = $numeric_time-1; }

           		$nb_month = round($numeric_time / 30);

	            $q = $db->prepare("INSERT INTO pformas(pf_id,client_id,sb_size,screen_type,numeric_time,nb_month,debut,fin,created) VALUES(:pf_id, :client_id, :sb_size, :screen_type, :numeric_time, :nb_month, :debut, :fin, :created)");

	            $q->execute([
	                'pf_id' => $pf_id,
	                'client_id' => $client_id,
	                'sb_size' => $sb_size,
	                'screen_type' => $screen_type,
	                'numeric_time' => $numeric_time,
	                'nb_month' => $nb_month,
	                'debut' => $debut,
	                'fin' => $fin,
	                'created' => date('Y-m-d H:i:s')
	            ]);

	            $pfid = $db->lastInsertId();

				redirect(WURI . '?r=' . $m[1] . '/edition/etape-2/' . $pfid . '/');

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
	require PAGES . $subpage . '_proformas.new.php';

}






elseif(isset($con) && ($con === 'infos')) {

	if(is_numeric($ID)) {

		$exist = cell_count("pformas", "id", $ID);

		id_count($exist, "Impossible de trouver cette pro-forma dans la base de données.");

		$proforma = find_one("pformas", "id", $ID);

		$client = find_one("clients", "id", $proforma->client_id);
		
		
		if(isset($_POST['releasesubmit'])) {

			$error = [];

			$utype = get_session("type");

			$uid = get_session("uid");

			$link = WURI . '?r=' . $m[1] . '/infos/' . $ID . '/';

			if($utype === "2") {

				if(not_empty(['HID'])) {

					extract($_POST);

					if($HID != $ID) {

						$error[] = "Il semblerait que l'identifiant soit erroné'.";

				            
			            $field = $con;

			            $title = $m[1] . ', Comptabilité';

			            $msg = "Il semblerait que l'identifiant soit erroné'.";

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

					}

					if(count($error) == 0) {

						if($client->cc === "" OR $client->bp === "") {

							$_SESSION['toreturn_URI'] = $link;

							redirect(WURI . '?r=clients/complete/' . $proforma->client_id . '/');

						}

						$q = $db->prepare("INSERT INTO bills(pf_id, p_id, client_id, sb_size, nb_month, debut, fin, agency_remised_ht_price, odp_amount, odp_p_amount, tm_amount, tva, tsp, numeric_ttc_price, created) VALUES(:pf_id, :p_id, :client_id, :sb_size, :nb_month, :debut, :fin, :agency_remised_ht_price, :odp_amount, :odp_p_amount, :tm_amount, :tva, :tsp, :numeric_ttc_price, :created)");

		                $q->execute([
		                    'pf_id' => $proforma->pf_id,
		                    'p_id' => $HID,
		                    'client_id' => $proforma->client_id,
		                    'sb_size' => $proforma->sb_size,
		                    'nb_month' => $proforma->nb_month,
		                    'debut' => $proforma->debut,
		                    'fin' => $proforma->fin,
		                    'agency_remised_ht_price' => $proforma->agency_remised_ht_price,
		                    'odp_amount' => $proforma->odp_amount,
		                    'odp_p_amount' => $proforma->odp_p_amount,
		                    'tm_amount' => $proforma->tm_alcool_amount + $proforma->tm_amount,
		                    'tva' => $proforma->tva,
		                    'tsp' => $proforma->tsp,
		                    'numeric_ttc_price' => $proforma->numeric_ttc_price,
		                    'created' => date('Y-m-d H:i:s')
		                ]);

    					set_flash("La pro-forma PF-$proforma->pf_id a bien été valider.", "success");

                		update_one('pformas', 'state', 'Oui', $HID);

                		$field = $con;

			            $title = $m[1] . ', ' . $proforma->pf_id;

			            $msg = "La pro-forma PF-$proforma->pf_id a bien été valider.";

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			            $nicounter = cell_count("notifications", "description", "Pro-forma PF-$proforma->pf_id en attente de validation", "AND dest='" . get_session("uid") . "' AND type='H'");

			            $ni = find_all("notifications", "WHERE description='Pro-forma PF-$proforma->pf_id en attente de validation' AND dest='$uid' AND type='H'");

			            
			            
			            if($nicounter > 0) {

			          		foreach($ni as $value) {

	                			set_notifier("S", "Pro-forma PF-$proforma->pf_id a été validé", get_session("uid"), $value->starter_id, $link);
				            
				            }

			            }


		            	$managers = find_all("users", "WHERE id!='". get_session("uid") ."'");
			            
			            foreach($managers as $item) {

			            	$cellcounter = cell_count("notifications", "description", "Pro-forma PF-$proforma->pf_id a été validé", "AND dest='$item->id' AND type='S' AND state='on'");

			            	if($cellcounter < 1) {

	                			set_notifier("S", "Pro-forma PF-$proforma->pf_id a été validé", get_session("uid"), $item->id, $link);

			            	}

		            	}

						redirect(WURI . '?r=' . $m[1] . '/');

					} else { save_input_data(); }

				} else {

					save_input_data();

					$error[] = "Impossible d'éffectuer cette opération pour le moment.";

			            
		            $field = $con;

		            $title = $m[1] . ', Atteinte à l\'intégrité de la BDD';

		            $msg = "Impossible d'éffectuer cette opération pour le moment.";

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

				}

			} else {

	            set_flash("Votre demande de validation a été notifier.", "info");


				$field = $con;

	            $title = $m[1] . ', Notification';

	            $msg = "Votre demande de validation a été notifier.";

	            $year = date("Y");


				$managers = find_all("users", " WHERE utid='2'");
				
				foreach($managers as $item) {

					set_notifier("H", "Pro-forma PF-$proforma->pf_id en attente de validation", get_session("uid"), $item->id, $link);

				}

	            set_activity(get_session("uid"), $field, $title, $msg);

				update_one("pformas", "state", "Attente", $ID);

				redirect(WURI . '?r=' . $m[1] . '/');

			}

		}


		#	Liste
		require PAGES . $subpage . '_proformas.infos.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'edition')) {

	if(is_numeric($ID)) {

		$exist = cell_count("pformas", "id", $ID);

		id_count($exist, "Impossible de trouver cette pro-forma dans la base de données.");

		$proforma = find_one("pformas", "id", $ID);

		$client = find_one("clients", "id", $proforma->client_id);


		if(isset($vue) && ($vue != $ID) && ($vue === 'etape-1')) {

			if(isset($_POST['steponesubmit'])) {

				$error = [];

				if (not_empty(['debut', 'fin'])) {

					extract($_POST);

			        if(cell_count("sizes", "size", $sb_size) < 1) {

			        	$error[2] = "Impossible de retrouver ce format dans la base de données.";

			            
			            $field = $con;

			            $title = $m[1] . ', Atteinte à l\'intégrité de la BDD';

			            $msg = $error[2];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }

			        $screen_type = e($screen_type);

		            if($fin < $debut) { 

		            	$error[5] = "La date de fin d'une campagne ne peut être inférieur à sa date de début.";

			            
			            $field = $con;

			            $title = $m[1] . ', Atteinte à l\'intégrité de la BDD';

			            $msg = $error[5];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);
		            }


					if(count($error) == 0) {

						$numeric_time = nbJours($debut, $fin);

		           		$endof = substr($numeric_time, -1, 1);

						if($endof === '4' || $endof === '9') { $numeric_time = $numeric_time+1; }
						elseif($endof === '1') { $numeric_time = $numeric_time-1; }

		           		$nb_month = round($numeric_time / 30);

			            $q = $db->prepare("UPDATE pformas SET sb_size=:sb_size, screen_type=:screen_type, numeric_time=:numeric_time, nb_month=:nb_month, debut=:debut, fin=:fin, created=:created WHERE id=:id");

			            $q->execute([
			                'sb_size' => $sb_size,
			                'screen_type' => $screen_type,
			                'numeric_time' => $numeric_time,
			                'nb_month' => $nb_month,
			                'debut' => $debut,
			                'fin' => $fin,
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

				if($proforma->debut === "0000-00-00" || $proforma->fin === "0000-00-00") {

					save_input_data();

					$error[] = "Assurez-vous d'avoir definit les dates de debut et de fin de l'opération.";

			            
		            $field = $con;

		            $title = $m[1] . ', Comptabilité';

		            $msg = "Assurez-vous d'avoir definit les dates de debut et de fin de l'opération.";

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		            redirect(WURI . '?r=' . $m[1] . '/edition/etape-1/' . $ID . '/');

				}


				if(not_empty(['letter_time'])) {

					extract($_POST);

			        if(mb_strlen($letter_time) < 2) {

			        	$error[1] = "La saisie en lettre doit contenir au moins deux (2) lettres.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $letter_time;

			            $msg = $error[1];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }


					if(count($error) == 0) {

						$q = $db->prepare("UPDATE pformas SET letter_time=:letter_time, created=:created WHERE id=:id");

						$q->execute([
			                'letter_time' => $letter_time,
			                'created' => date('Y-m-d H:i:s'),
			                'id' => $ID
			            ]);

						redirect(WURI . '?r=' . $m[1] . '/edition/etape-3/' . $ID . '/');

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

		elseif(isset($vue) && ($vue != $ID) && ($vue === 'etape-3')) {

			if(isset($_POST['stepthreesubmit'])) {

				$error = [];

				if($proforma->letter_time === "") {

					save_input_data();

					$error[] = "Assurez-vous d'avoir saisie la durée en toute lettre.";

			            
		            $field = $con;

		            $title = $m[1] . ', Comptabilité';

		            $msg = "Assurez-vous d'avoir saisie la durée en toute lettre.";

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		            redirect(WURI . '?r=' . $m[1] . '/edition/etape-2/' . $ID . '/');

				}

				if(not_empty(['sb_count'])) {

					extract($_POST);

					 if(!is_numeric($sb_count)) {

			        	$error[2] = "Votre saisie ne correspond pas à un chiffre.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $proforma->pf_id;

			            $msg = $error[2];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }


					if(count($error) == 0) {

						if($sb_p_count === "0") { $sb_p_count = 0; }

						if($one_ht_price === "0") { $one_ht_price = 150000; }
                
                		if($one_stoped_price === "0") { $one_stoped_price = $ht_price; }

                		$ht_price = (($one_stoped_price * $sb_count) * $proforma->nb_month);

                		if($agency_remised === "Oui"){

		                    $remised_ag = (($ht_price * 15) / 100);

		                    $agency_remised_ht_price = $ht_price - $remised_ag;

		                } else {

		                    $agency_remised_ht_price = $ht_price;

		                }


		                 $q = $db->prepare("UPDATE pformas SET one_ht_price=:one_ht_price, sb_count=:sb_count, sb_p_count=:sb_p_count, remised=:remised, one_stoped_price=:one_stoped_price, ht_price=:ht_price, agency_remised=:agency_remised, agency_remised_ht_price=:agency_remised_ht_price, created=:created WHERE id=:id");

		                $q->execute([
		                    'one_ht_price' => $one_ht_price,
		                    'sb_count' => $sb_count,
		                    'sb_p_count' => $sb_p_count,
		                    'remised' => $remised,
		                    'one_stoped_price' => $one_stoped_price,
		                    'ht_price' => $ht_price,
		                    'agency_remised' => $agency_remised,
		                    'agency_remised_ht_price' => $agency_remised_ht_price,
		                    'created' => date('Y-m-d H:i:s'),
		                    'id' => $ID
		                ]);

						redirect(WURI . '?r=' . $m[1] . '/edition/etape-4/' . $ID . '/');

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

		elseif(isset($vue) && ($vue != $ID) && ($vue === 'etape-4')) {

			if(isset($_POST['stepfoursubmit'])) {

				$error = [];

				if($proforma->sb_count === "0") {

					save_input_data();

					$error[] = "Assurez-vous d'avoir définit le nombre de panneaux.";

			            
		            $field = $con;

		            $title = $m[1] . ', Comptabilité';

		            $msg = "Assurez-vous d'avoir définit le nombre de panneaux.";

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		            redirect(WURI . '?r=' . $m[1] . '/edition/etape-3/' . $ID . '/');

				}

				extract($_POST);

		        if(!is_numeric($int_city_count)) {

		        	$error[1] = "Votre saisie ne correspond pas à un chiffre.";

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $proforma->pf_id;

		            $msg = $error[1];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }


				if(count($error) == 0) {

					$transport_price = ($int_city_count * 75000);

					$q = $db->prepare("UPDATE pformas SET int_city_count=:int_city_count, transport_price=:transport_price, created=:created WHERE id=:id");

					$q->execute([
		                'int_city_count' => $int_city_count,
		                'transport_price' => $transport_price,
		                'created' => date('Y-m-d H:i:s'),
		                'id' => $ID
		            ]);

					redirect(WURI . '?r=' . $m[1] . '/edition/etape-5/' . $ID . '/');

				} else { save_input_data(); }

			} else { clear_input_data(); }

		}

		elseif(isset($vue) && ($vue != $ID) && ($vue === 'etape-5')) {

			if(isset($_POST['stepfivesubmit'])) {

				$error = [];

				extract($_POST);


				if(count($error) == 0) {

					if($alcool_type === "Oui") {

						$tm_alcool_amount = (((2000*$proforma->sb_size) * $proforma->sb_count) * $proforma->nb_month);

            			$tm = "Oui";

            			$tm_amount = 0;

            			$q = $db->prepare("UPDATE pformas SET alcool_type=:alcool_type, tm_alcool_amount=:tm_alcool_amount, tm=:tm, tm_amount=:tm_amount, created=:created WHERE id=:id");

						$q->execute([
			                'alcool_type' => $alcool_type,
			                'tm_alcool_amount' => $tm_alcool_amount,
			                'tm' => $tm,
			                'tm_amount' => $tm_amount,
			                'created' => date('Y-m-d H:i:s'),
			                'id' => $ID
			            ]);

					} else {

						$tm_alcool_amount = 0;

            			$q = $db->prepare("UPDATE pformas SET alcool_type=:alcool_type, tm_alcool_amount=:tm_alcool_amount, created=:created WHERE id=:id");

						$q->execute([
			                'alcool_type' => $alcool_type,
			                'tm_alcool_amount' => $tm_alcool_amount,
			                'created' => date('Y-m-d H:i:s'),
			                'id' => $ID
			            ]);

					}

					redirect(WURI . '?r=' . $m[1] . '/edition/etape-6/' . $ID . '/');

				} else { save_input_data(); }

			} else { clear_input_data(); }

		}

		elseif(isset($vue) && ($vue != $ID) && ($vue === 'etape-6')) {

			if(isset($_POST['stepsixsubmit'])) {

				$error = [];

				extract($_POST);


				if(count($error) == 0) {
        			
        			$others_comunes = $proforma->sb_count - $proforma->sb_p_count;

        			if($odp === "Oui") {

						$odp_amount = (((1000 * $proforma->sb_size) * $others_comunes) * $proforma->nb_month);

			            if($proforma->sb_p_count > 0) {

			            	$odp_p_amount = (((4000 * $proforma->sb_size) * $proforma->sb_p_count) * $proforma->nb_month);

			            } else {

			            	$odp_p_amount = 0;

			            }

			        } else {

			            $odp_amount = 0;

			            $odp_p_amount = 0;

			        }


			        if($proforma->alcool_type === "Non" && $tm === "Oui") {

			            $tm_amount = (((1000 * $proforma->sb_size) * $proforma->sb_count) * $proforma->nb_month);

			        } elseif($proforma->alcool_type === "Oui") {

			            $tm = "Oui";

			            $tm_amount = 0;

			        } else if($proforma->alcool_type === "Non" && $tm === "Non") {

			            $tm = "Non";

			            $tm_amount = 0;

			        }


			        $q = $db->prepare("UPDATE pformas SET odp=:odp, odp_amount=:odp_amount, odp_p_amount=:odp_p_amount, tm=:tm, tm_amount=:tm_amount, created=:created WHERE id=:id");
			        
			        $q->execute([
			            'odp' => $odp,
			            'odp_amount' => $odp_amount,
			            'odp_p_amount' => $odp_p_amount,
			            'tm' => $tm,
			            'tm_amount' => $tm_amount,
			            'created' => date('Y-m-d H:i:s'),
			            'id' => $ID
			        ]);
					

					redirect(WURI . '?r=' . $m[1] . '/edition/etape-7/' . $ID . '/');

				} else { save_input_data(); }

			} else { clear_input_data(); }

		}

		elseif(isset($vue) && ($vue != $ID) && ($vue === 'etape-7')) {

			if(isset($_POST['stepsevensubmit'])) {

				$error = [];

				extract($_POST);


				if(count($error) == 0) {
        			
        			if($agree_tva === "Oui"){

		                $tva = (($proforma->agency_remised_ht_price * 18) / 100);

		                $ht_tva = $proforma->agency_remised_ht_price + $tva;

		                $tsp = (($ht_tva * 3) / 100);

			        } else {

			            $tva = 0;

			            $tsp = 0;

			        }
			        

	                $ht_tva = $proforma->agency_remised_ht_price + $tva;

			        $ht_tva_tsp = $ht_tva + $tsp;

			        $all_odp = $proforma->odp_amount + $proforma->odp_p_amount;

			        $all_tm = $proforma->tm_alcool_amount + $proforma->tm_amount;


			        $numeric_ttc_price = $ht_tva_tsp + $all_odp + $all_tm + $proforma->transport_price;


			        $q = $db->prepare("UPDATE pformas SET agree_tva=:agree_tva, tva=:tva, tsp=:tsp, numeric_ttc_price=:numeric_ttc_price, created=:created WHERE id=:id");
			        
			        $q->execute([
			            'agree_tva' => $agree_tva,
			            'tva' => $tva,
			            'tsp' => $tsp,
			            'numeric_ttc_price' => $numeric_ttc_price,
			            'created' => date('Y-m-d H:i:s'),
			            'id' => $ID
			        ]);
					

					redirect(WURI . '?r=' . $m[1] . '/edition/etape-8/' . $ID . '/');

				} else { save_input_data(); }

			} else { clear_input_data(); }

		}

		elseif(isset($vue) && ($vue != $ID) && ($vue === 'etape-8')) {

			if(isset($_POST['stepeightsubmit'])) {

				$error = [];

				if(not_empty(['letter_ttc_price'])) {

					extract($_POST);


					if(count($error) == 0) {

				        $q = $db->prepare("UPDATE pformas SET letter_ttc_price=:letter_ttc_price, created=:created WHERE id=:id");
				        
				        $q->execute([
				            'letter_ttc_price' => $letter_ttc_price,
				            'created' => date('Y-m-d H:i:s'),
				            'id' => $ID
				        ]);

						set_flash("La pro-forma a été générer avec succès.", "success");
				            
			            $field = $con;

			            $title = $m[1] . ', ' . $proforma->pf_id;

			            $msg = "La pro-forma $proforma->pf_id a été générer avec succès.";

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);
						

						redirect(WURI . '?r=' . $m[1] . '/infos/' . $ID . '/');

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
		require PAGES . $subpage . '_proformas.edit.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






else {

	$_SESSION['toreturn_URI'] = "";

	$proformascounter__ = count_all("pformas");
		
	$nbpages = ceil($proformascounter__/$limit);

	if(!empty($_GET['s']) && is_numeric($_GET['s'])) {

		$page = intval($_GET['s']);

		if($page >= 1 && $page <= $nbpages) { $current = $page; }

		elseif($page < 1) { $current = 1; }

		else { $current = $nbpages; }

	}

	$start = ($current * $limit - $limit);

    $proformas__ = find_all("pformas", " ORDER BY id DESC LIMIT $start, $limit");
    

	#	Liste
	require PAGES . $subpage . '_proformas.list.php';

}

$__proformas = ob_get_clean();



#	Ajout de la vue
require PAGES . '/comptability/proformas/proformas.php';

?>