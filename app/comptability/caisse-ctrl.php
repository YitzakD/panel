<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#	Baseline
$i = 1;
	
$current = 1;

$limit = 10;

$subpage = '/comptability/caisse/parts/';

$compteur = find_all("init_caisse");

$curr = array_search($ID, array_column($compteur, 'id'));

$next = nextElement($compteur, $curr);

$prev = prevElement($compteur, $curr);


ob_start();

if(isset($con) && ($con === 'nouvelle')) {

	check_access(array('2'));

	$today = date('Y-m-d');
    
    list($_year, $_month, $_day) = explode("-", $today);

    if(is_already_use("init_caisse", "month", $_month, " AND year='$_year'")) {

    	if(isset($_POST['newsubmit'])) {

			$error = [];

			if(not_empty(['addingdate', 'amount', 'justif'])) {

				extract($_POST);

				if($addingdate < $today) {

		            $error[1] = "La date de la transaction ne peut pas être antérieur à aujourd'hui.";

		            
		            $field = $con;

		            $title = $m[1] . ', Atteinte à l\'intégrité de la BDD';

		            $msg = $error[1];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }

		        if(!is_numeric($amount)) {

		        	$error[3] = "Votre saisie ne correspond pas à un montant valable.";

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $amount;

		            $msg = $error[3];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }

		        if(mb_strlen($justif) < 3) {

		        	$error[4] = "Le justificatif doit être plus ou moins claire.";

		            
		            $field = $con;

		            $title = $m[1] . ', Manque de détail';

		            $msg = $error[4];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }


        		list($year, $month, $day) = explode("-", $addingdate);

	            $infoscaisse = find_one("init_caisse", "month", $month, "and year='" . $year . "'");

	            $pointcaisse = find_one("point_caisse", "init_id", $infoscaisse->id);

	            if(count($error) == 0) {

		            $q = $db->prepare("INSERT INTO caisse(init_id,month_id,day,typeof,amount,description,created) VALUES(:init_id, :month_id, :day, :typeof, :amount, :description, :created)");
	            	
	            	$r = $db->prepare("UPDATE point_caisse SET mo_in=:mo_in, mo_out=:mo_out, mo_solde=:mo_solde WHERE init_id=:init_id");

		            if ($typeof === "1") {

		                $r->execute([
		                    'mo_in' => ($pointcaisse->mo_in + $amount),
		                    'mo_out' => $pointcaisse->mo_out,
		                    'mo_solde' => ($pointcaisse->mo_solde + $amount),
		                    'init_id' => $infoscaisse->id
		                ]);

		            } else {

		                $r->execute([
		                    'mo_in' => $pointcaisse->mo_in,
		                    'mo_out' => ($pointcaisse->mo_out + $amount),
		                    'mo_solde' => ($pointcaisse->mo_solde - $amount),
		                    'init_id' => $infoscaisse->id
		                ]);

		            }

		            $q->execute([
		                'init_id' => $infoscaisse->id,
		                'month_id' => $infoscaisse->month_id,
		                'day' => $day,
		                'typeof' => $typeof,
		                'amount' => $amount,
		                'description' => $justif,
		                'created' => date('Y-m-d H:i:s')
		            ]);

					set_flash("Mouvement de caisse enregistrer avec succès.", "success");

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $month . ' - ' . $year;

		            $msg = "Mouvement de caisse enregistrer avec succès.";

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

    } else {

    	if(isset($_POST['newsubmit'])) {

			$error = [];

			if(not_empty(['addingdate', 'amount', 'justif'])) {

				extract($_POST);

				if($addingdate < $today) {

		            $error[1] = "La date de la transaction ne peut pas être antérieur à aujourd'hui.";

		            
		            $field = $con;

		            $title = $m[1] . ', Atteinte à l\'intégrité de la BDD';

		            $msg = $error[1];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }

		        if(!is_numeric($amount)) {

		        	$error[3] = "Votre saisie ne correspond pas à un montant valable.";

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $amount;

		            $msg = $error[3];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }

		        if(mb_strlen($justif) < 3) {

		        	$error[4] = "Le justificatif doit être plus ou moins claire.";

		            
		            $field = $con;

		            $title = $m[1] . ', Manque de détail';

		            $msg = $error[4];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }


        		list($year, $month, $day) = explode("-", $addingdate);


	        	if(count($error) == 0) {

					$month_id = geraHash(10);

					$p = $db->prepare("INSERT INTO init_caisse(month_id,month,year) VALUES(:month_id, :month, :year)");
	            
	            	$q = $db->prepare("INSERT INTO caisse(init_id,month_id,day,typeof,amount,description,created) VALUES(:init_id, :month_id, :day, :typeof, :amount, :description, :created)");
	            
	            	$r = $db->prepare("INSERT INTO point_caisse(init_id,mo_new_solde,mo_in,mo_out,mo_solde) VALUES(:init_id, :mo_new_solde, :mo_in, :mo_out, :mo_solde)");
	            
	            	$s = $db->prepare("UPDATE point_caisse SET mo_in=:mo_in, mo_out=:mo_out, mo_solde=:mo_solde WHERE init_id=:init_id");

	            	$pointcount = count_all("point_caisse");


	            	if ($pointcount === 0) {

	            		if ($typeof === "1") {

		                    $p->execute([
		                        'month_id' => $month_id,
		                        'month' => $month,
		                        'year' => $year
		                    ]);

		                    $init_id = $db->lastInsertId();
		                    $r->execute([
		                        'init_id' => $init_id,
		                        'mo_new_solde' => $amount,
		                        'mo_in' => '0',
		                        'mo_out' => '0',
		                        'mo_solde' => $amount
		                    ]);

		                    $infoscaisse = find_one("init_caisse", "id", $init_id);
		                    $q->execute([
		                        'init_id' => $init_id,
		                        'month_id' => $infoscaisse->month_id,
		                        'day' => $day,
		                        'typeof' => $typeof,
		                        'amount' => $amount,
		                        'description' => $justif,
		                        'created' => date('Y-m-d H:i:s')
		                    ]);

		                } else {

							set_flash("Impossible d'effectuer ce mouvement car la caisse est encore vide, vous devez déjà déclarer une entrée.", "warning");

				            
				            $field = $con;

				            $title = $m[1] . ', Atteinte à l\'intégrité de la BDD';

				            $msg = "Impossible d'effectuer ce mouvement car la caisse est encore vide, vous devez déjà déclarer une entrée.";

				            $year = date("Y");

				            set_activity(get_session("uid"), $field, $title, $msg);


							redirect(WURI . '?r=' . $m[1] . '/nouvelle/');

		                }

	            	} else {

	               		$lastpoint = find_last("point_caisse");
	                	
	                	$new_solde = $lastpoint->mo_solde;

	                	$p->execute([
		                    'month_id' => $month_id,
		                    'month' => $month,
		                    'year' => $year
		                ]);

		                $init_id = $db->lastInsertId();
		                $r->execute([
		                    'init_id' => $init_id,
		                    'mo_new_solde' => $new_solde,
		                    'mo_in' => '0',
		                    'mo_out' => '0',
		                    'mo_solde' => $new_solde
		                ]);

		                $infoscaisse = find_one("init_caisse", "id", $init_id);
		                $q->execute([
		                    'init_id' => $init_id,
		                    'month_id' => $infoscaisse->month_id,
		                    'day' => $day,
		                    'typeof' => $typeof,
		                    'amount' => $amount,
		                    'description' => $justif,
		                    'created' => date('Y-m-d H:i:s')
		                ]);

		                if ($typeof === "1") {

		                    $s->execute([
		                        'mo_in' => $amount,
		                        'mo_out' => '0',
		                        'mo_solde' => ($new_solde + $amount),
		                        'init_id' => $init_id
		                    ]);

		                } else {

		                    $s->execute([
		                        'mo_in' => '0',
		                        'mo_out' => $amount,
		                        'mo_solde' => ($new_solde - $amount),
		                        'init_id' => $init_id
		                    ]);

		                }

	            	}

					set_flash("Mouvement de caisse enregistrer avec succès.", "success");

		            
		            $field = $con;

		            $title = $m[1] . ', ' . $month . ' - ' . $year;

		            $msg = "Mouvement de caisse enregistrer avec succès.";

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

    }


	#	Liste
	require PAGES . $subpage . '_caisse.new.php';

}






elseif(isset($con) && ($con === 'infos')) {

	if(is_numeric($ID)) {

		$exist = cell_count("init_caisse", "id", $ID);

		id_count($exist, "Impossible de trouver cette caisse dans la base de données.");

		$caisse = find_one("init_caisse", "id", $ID);

	    $caissecounter = cell_count("caisse", "init_id", $ID);

	    $caisses = find_all("caisse", " WHERE init_id='$ID' ORDER BY day ASC");

	    $point = find_one("point_caisse", "init_id", $ID);



		
		if(isset($vue) && ($vue != $ID) && ($vue === 'caisse-mois')) {
			
			#	Liste
			require PAGES . $subpage . '_caisse.month.php';

		}

		else {

			check_access(array('2'));

		    if(isset($_POST['newsubmit_plus'])) {

				$error = [];

				if(not_empty(['addingdate', 'amount', 'justif'])) {

					extract($_POST);

					if($addingdate < $today) {

			            $error[1] = "La date de la transaction ne peut pas être antérieur à aujourd'hui.";

			            
			            $field = $con;

			            $title = $m[1] . ', Atteinte à l\'intégrité de la BDD';

			            $msg = $error[1];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }

			        if(!is_numeric($amount)) {

			        	$error[3] = "Votre saisie ne correspond pas à un montant valable.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $amount;

			            $msg = $error[3];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }

			        if(mb_strlen($justif) < 3) {

			        	$error[4] = "Le justificatif doit être plus ou moins claire.";

			            
			            $field = $con;

			            $title = $m[1] . ', Manque de détail';

			            $msg = $error[4];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }


	        		list($year, $month, $day) = explode("-", $addingdate);

		            if(count($error) == 0) {

			            $q = $db->prepare("INSERT INTO caisse(init_id,month_id,day,typeof,amount,description,created) VALUES(:init_id, :month_id, :day, :typeof, :amount, :description, :created)");
		            	
		            	$r = $db->prepare("UPDATE point_caisse SET mo_in=:mo_in, mo_out=:mo_out, mo_solde=:mo_solde WHERE init_id=:init_id");

			            if ($typeof === "1") {

			                $r->execute([
			                    'mo_in' => ($point->mo_in + $amount),
			                    'mo_out' => $point->mo_out,
			                    'mo_solde' => ($point->mo_solde + $amount),
			                    'init_id' => $ID
			                ]);

			            } else {

			                $r->execute([
			                    'mo_in' => $point->mo_in,
			                    'mo_out' => ($point->mo_out + $amount),
			                    'mo_solde' => ($point->mo_solde - $amount),
			                    'init_id' => $ID
			                ]);

			            }

			            $q->execute([
			                'init_id' => $ID,
			                'month_id' => $caisse->month_id,
			                'day' => $day,
			                'typeof' => $typeof,
			                'amount' => $amount,
			                'description' => $justif,
			                'created' => date('Y-m-d H:i:s')
			            ]);

						set_flash("Mouvement de caisse enregistrer avec succès.", "success");

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $month . ' - ' . $year;

			            $msg = "Mouvement de caisse enregistrer avec succès.";

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

			
			#	Liste
			require PAGES . $subpage . '_caisse.infos.php';

		}

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'suppression')) {

	if(is_numeric($ID)) {

		$exist = cell_count("init_caisse", "id", $ID);

		id_count($exist, "Impossible de trouver ce client dans la base de données.");

		$caisse = find_one("init_caisse", "id", $ID);

	    $point = find_one("point_caisse", "init_id", $ID);

		
		check_access(array('2'));

		
		if(isset($vue) && ($vue != $ID) && ($vue === 'saisie')) {

			if(isset($_POST)) {

				extract($_POST);

				$fiche = find_one("caisse", "id", $SHID);
            
            	$q = $db->prepare("UPDATE point_caisse SET mo_in=:mo_in, mo_out=:mo_out, mo_solde=:mo_solde WHERE init_id=:init_id");

            	 if($fiche->typeof === "1") {

	                $new_moin = $point->mo_in - $fiche->amount;
	                $new_solde = ($point->mo_new_solde + $new_moin) - $point->mo_out;
	                $q->execute([
	                    'mo_in' => $new_moin,
	                    'mo_out' => $point->mo_out,
	                    'mo_solde' => ($new_solde),
	                    'init_id' => $fiche->init_id
	                ]);

	            } else {

	                $new_moout = $point->mo_out - $fiche->amount;
	                $new_solde = ($point->mo_new_solde + $point->mo_in) - $new_moout;
	                $q->execute([
	                    'mo_in' => $point->mo_in,
	                    'mo_out' => $new_moout,
	                    'mo_solde' => $new_solde,
	                    'init_id' => $fiche->init_id
	                ]);

	            }

				set_flash("La fiche a été supprimer avec succès.", "success");

		            
	            $field = $con;

	            $title = $m[1] . ', Suppression de fiche';

	            $msg = "La fiche : $fiche->description a été supprimer avec succès.";

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

				delete_one('caisse', 'id', $SHID);


				redirect(WURI . '?r=' . $m[1] . '/infos/' . $ID . '/');

			}

		}

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






else {

	$today = date('Y-m-d');
    
    list($_year, $_month, $_day) = explode("-", $today);

	$actualmonth = month_convert($_month);


	$caissescounter__ = count_all("init_caisse");
		
	$nbpages = ceil($caissescounter__/$limit);

	if(!empty($_GET['s']) && is_numeric($_GET['s'])) {

		$page = intval($_GET['s']);

		if($page >= 1 && $page <= $nbpages) { $current = $page; }

		elseif($page < 1) { $current = 1; }

		else { $current = $nbpages; }

	}

	$start = ($current * $limit - $limit);

    $caisse__ = find_all("init_caisse", " ORDER BY id DESC LIMIT $start, $limit");


	#	Liste
	require PAGES . $subpage . '_caisse.list.php';

}

$__caisse = ob_get_clean();



#	Ajout de la vue
require PAGES . '/comptability/caisse/caisse.php';

?>