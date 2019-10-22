<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#	Baseline
$i = 1;
	
$current = 1;

$limit = 10;

$subpage = '/comptability/banque/parts/';


ob_start();

if(isset($con) && ($con === 'nouveau-compte')) {

	$banquescounter__ = count_all("bank");

    $banques__ = find_all("bank", " ORDER BY bank_name ASC");

	if(isset($_POST["bankbasesubmit"])) {

		$error = [];

		if(not_empty(['bank_name', 'account_manager', 'am_phone', 'am_mail'])) {

			extract($_POST);

			if(is_already_use('bank', 'bank_name', $bank_name)) {

	            $error[1] = "Vous avez déjà déclarer une banque qui porte la même dénomination.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $bank_name;

	            $msg = $error[1];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

	        if(mb_strlen($account_manager) < 2) {

	        	$error[3] = "Le nom d'une personne ne devrait pas être long que deux (2) lettres?";
	        	

	            $field = $con;

	            $title = $m[1] . ', ' . $bank_name;

	            $msg = $error[3];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

	        if(!is_numeric($am_phone) || (mb_strlen($am_phone) < 8)) {

	        	$error[4] = "votre saisie ne correspond pas à un numéro de téléphone (Le numéro de téléphone doit contenir au moins huit (8) chiffres).";


	            $field = $con;

	            $title = $m[1] . ', ' . $bank_name;

	            $msg = $error[4];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

			if(!filter_var($am_mail, FILTER_VALIDATE_EMAIL)) {

	            $error[5] = "L'adresse e-mail saisie n'est pas valide.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $bank_name;

	            $msg = $error[5];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }


	        if(count($error) == 0) {

	        	$bankhash = geraHash(20);

	        	$am_infos = $am_phone . " " . $am_mail;

	        	$q = $db->prepare("INSERT INTO bank(bankhash,bank_name,bank_number,account_manager,am_infos,prefered) VALUES(:bankhash, :bank_name, :bank_number, :account_manager, :am_infos, :prefered)");

				$q->execute([
					'bankhash' => $bankhash,
					'bank_name' => $bank_name,
					'bank_number' => $bank_number,
					'account_manager' => $account_manager,
					'prefered' => "1",
					'am_infos' => $am_infos
				]);

				$bankID = $db->lastInsertId();

				set_flash("Votre compte a été ajouter avec succès.", "success");

		            
	            $field = $con;

	            $title = $m[1] . ', ' . $bank_name;

	            $msg = "Votre compte $bank_name a été ajouter avec succès.";

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);


				redirect(WURI . '?r=' . $m[1] . '/' . $con . '/initialisation/' . $bankID . '/');


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


	if(isset($vue) && ($vue != $ID) && ($vue === 'initialisation')) {

		if(is_numeric($ID)) {

			$exist = cell_count("bank", "id", $ID);

			id_count($exist, "Impossible de trouver ce compte dans la base de données.");

			$bank = find_one("bank", "id", $ID);

			if(isset($_POST['accountbasesubmit'])) {

				$today = date('Y-m-d');
			    
			    list($year, $month, $day) = explode("-", $today);

				$error = [];

				if(not_empty(['acc_sold'])) {

					extract($_POST);

			        if(!is_numeric($acc_sold)) {

			        	$error[1] = "votre saisie ne correspond pas à un nombre.";


			            $field = $con;

			            $title = $m[1] . ', ' . $bank->bank_name;

			            $msg = $error[1];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }


			        if(count($error) == 0) {

						$month_id = geraHash(10);

			        	$q = $db->prepare("INSERT INTO init_bank(bank_id,bankhash,month_id,month,year) VALUES(:bank_id, :bankhash, :month_id, :month, :year)");

			        	$r = $db->prepare("INSERT INTO bank_moovs(init_id,month_id,day,typeof,amount, description, created) VALUES(:init_id, :month_id, :day, :typeof, :amount, :description, :created)");

			        	$s = $db->prepare("INSERT INTO point_bank(init_id,solde_depart,solde) VALUES(:init_id, :solde_depart, :solde)");

			        	$q->execute([
							'bank_id' => $ID,
							'bankhash' => $bank->bankhash,
							'month_id' => $month_id,
							'month' => $month,
							'year' => $year
						]);

						$init_id = $db->lastInsertId();

						$r->execute([
							'init_id' => $init_id,
							'month_id' => $month_id,
							'day' => $day,
							'typeof' => "1",
							'amount' => $acc_sold,
							'description' => "Initialisation",
	                        'created' => date('Y-m-d H:i:s')
						]);

						$s->execute([
							'init_id' => $init_id,
							'solde_depart' => $acc_sold,
							'solde' => $acc_sold
						]);

						set_flash("Votre compte a été initialiser avec succès.", "success");

				            
			            $field = $con;

			            $title = $m[1] . ', ' . $bank->bank_name;

			            $msg = "Votre compte $bank->bank_name a été initialiser avec succès.";

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


			#	Formulaire
			require PAGES . $subpage . '_banques.new-init.php';

		} else {

			set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

			redirect(WURI . '?r=' . $m[1] . '/');

		}

	} else {

		#	Formulaire
		require PAGES . $subpage . '_banques.new.php';

	}

}






elseif(isset($con) && ($con === 'details')) {

	if(isset($ID)) {

		$exist = cell_count("bank", "bankhash", $ID);

		id_count($exist, "Impossible de trouver ce compte dans la base de données.");

		$banquescounter__ = count_all("bank");

	    $banques__ = find_all("bank", " ORDER BY prefered DESC");


		$bank = find_one("bank", "bankhash", $ID);

	    
	    $split = explode(" ", $bank->am_infos);

	    $am_phone = $split[0];

	    $am_mail = $split[1];


   		$initbank = find_one("init_bank", "bank_id", $bank->id, "AND bankhash='$ID' ORDER BY id DESC");
    
	    $pointbank = find_one("point_bank", "init_id", $initbank->id);

	    $moovsbank = find_all("bank_moovs", "WHERE init_id='$initbank->id' AND description!='Initialisation'");


	    if(isset($_POST['bankmoovsubmit'])) {

			$error = [];

			$today = date('Y-m-d');
		    
		    list($_year, $_month, $_day) = explode("-", $today);

			if(not_empty(['amount', 'about'])) {

				extract($_POST);

		        if(!is_numeric($amount)) {

		        	$error[2] = "Votre saisie ne correspond pas à un montant valable.";

		            
		            $field = "nouvelle transaction bancaire";

		            $title = $m[1] . ', ' . $amount;

		            $msg = $error[2];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }

		        if(mb_strlen($about) < 3) {

		        	$error[3] = "Le justificatif doit être plus ou moins claire.";

		            
		            $field = "nouvelle transaction bancaire";

		            $title = $m[1] . ', Manque de détail';

		            $msg = $error[3];

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);

		        }

				if(is_already_use("init_bank", "bankhash", $ID,  "AND month='$_month' AND year='$_year'")) {

					list($year, $month, $day) = explode("-", $today);

		            $infosaccount = find_one("init_bank", "bank_id", $bank->id, "AND month='$month' AND year='$year'");

		            $pointaccount = find_one("point_bank", "init_id", $infosaccount->id);

		            if(count($error) == 0) {

			            $q = $db->prepare("INSERT INTO bank_moovs(init_id,month_id,day,typeof,amount,description,created) VALUES(:init_id, :month_id, :day, :typeof, :amount, :description, :created)");
		            	
		            	$r = $db->prepare("UPDATE point_bank SET credit=:credit, debit=:debit, solde=:solde WHERE init_id=:init_id");

		            	if ($typeof === "1") {

		            		$newsolde = $pointaccount->solde + $amount;

			                $r->execute([
			                    'credit' => ($pointaccount->credit + $amount),
			                    'debit' => $pointaccount->debit,
			                    'solde' => $newsolde,
			                    'init_id' => $infosaccount->id
			                ]);

			            } else {

		            		$newsolde = $pointaccount->solde - $amount;

			                $r->execute([
			                    'credit' => $pointaccount->credit,
			                    'debit' => ($pointaccount->debit + $amount),
			                    'solde' => $newsolde,
			                    'init_id' => $infosaccount->id
			                ]);

			            }

			            $q->execute([
			                'init_id' => $infosaccount->id,
			                'month_id' => $infosaccount->month_id,
			                'day' => $day,
			                'typeof' => $typeof,
			                'amount' => $amount,
			                'description' => $about,
			                'created' => date('Y-m-d H:i:s')
			            ]);

						set_flash("Mouvement bancaire enregistrer avec succès.", "success");

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $bank->bank_name . ' ' . $month . ' - ' . $year;

			            $msg = "Mouvement bancaire enregistrer avec succès.";

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);


						redirect(WURI . '?r=' . $m[1] . '/details/' . $bank->bankhash . '/');

		            } else { save_input_data(); }

				}  else {

	        		list($year, $month, $day) = explode("-", $today);

		        	if(count($error) == 0) {

		            	$a = $db->prepare("SELECT * FROM point_bank WHERE init_id='$initbank->id' ORDER BY id DESC LIMIT 1");

			            $a->execute();

			            $adata = $a->fetch(PDO::FETCH_OBJ);

			            $a->closeCursor();

			            $lastpoint = $adata;


						$month_id = geraHash(10);


						$p = $db->prepare("INSERT INTO init_bank(bank_id,bankhash,month_id,month,year) VALUES(:bank_id, :bankhash, :month_id, :month, :year)");
		            
		            	$q = $db->prepare("INSERT INTO bank_moovs(init_id,month_id,day,typeof,amount,description,created) VALUES(:init_id, :month_id, :day, :typeof, :amount, :description, :created)");
		            
		            	$r = $db->prepare("INSERT INTO point_bank(init_id,solde_depart,credit,debit,solde) VALUES(:init_id, :solde_depart, :credit, :debit, :solde)");
		            
		            	$s = $db->prepare("UPDATE point_bank SET credit=:credit, debit=:debit, solde=:solde WHERE init_id=:init_id");

		                	
	                	$solde_depart = $lastpoint->solde;

	                	$p->execute([
		                    'bank_id' => $bank->id,
		                    'bankhash' => $bank->bankhash,
		                    'month_id' => $month_id,
		                    'month' => $month,
		                    'year' => $year
		                ]);

		                $init_id = $db->lastInsertId();
		                $r->execute([
		                    'init_id' => $init_id,
		                    'solde_depart' => $solde_depart,
		                    'credit' => '0',
		                    'debit' => '0',
		                    'solde' => $solde_depart
		                ]);

		                $infosaccount = find_one("init_bank", "id", $init_id);
		                $q->execute([
		                    'init_id' => $init_id,
		                    'month_id' => $month_id,
		                    'day' => $day,
		                    'typeof' => $typeof,
		                    'amount' => $amount,
		                    'description' => $about,
		                    'created' => date('Y-m-d H:i:s')
		                ]);

		                if ($typeof === "1") {

		                    $s->execute([
		                        'credit' => $amount,
		                        'debit' => '0',
		                        'solde' => ($solde_depart + $amount),
		                        'init_id' => $init_id
		                    ]);

		                } else {

		                    $s->execute([
		                        'credit' => '0',
		                        'debit' => $amount,
		                        'solde' => ($solde_depart - $amount),
		                        'init_id' => $init_id
		                    ]);

		                }

						set_flash("Mouvement bancaire enregistrer avec succès.", "success");

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $bank->bank_name . ' ' . $month . ' - ' . $year;

			            $msg = "Mouvement bancaire enregistrer avec succès.";

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);


						redirect(WURI . '?r=' . $m[1] . '/details/' . $bank->bankhash . '/');

		            } else { save_input_data(); }

				}


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
		require PAGES . $subpage . '_banques.details.php';

	} else {

		set_flash("L'identifiant ne correspont à aucun compte enregistrer.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}	

}






elseif(isset($con) && ($con === 'liste')) {

	if(isset($ID)) {

		$exist = cell_count("bank", "bankhash", $ID);

		id_count($exist, "Impossible de trouver ce compte dans la base de données.");

		$bank = find_one("bank", "bankhash", $ID);

		$today = date('Y-m-d');
	    
	    list($_year, $_month, $_day) = explode("-", $today);

		$actualmonth = month_convert($_month);


		$banquescounter__ = count_all("init_bank");
			
		$nbpages = ceil($banquescounter__/$limit);

		if(!empty($_GET['s']) && is_numeric($_GET['s'])) {

			$page = intval($_GET['s']);

			if($page >= 1 && $page <= $nbpages) { $current = $page; }

			elseif($page < 1) { $current = 1; }

			else { $current = $nbpages; }

		}

		$start = ($current * $limit - $limit);

	    $banque__ = find_all("init_bank", " ORDER BY id DESC LIMIT $start, $limit");


		#	Liste
		require PAGES . $subpage . '_banques.list.php';

	} else {

		set_flash("L'identifiant ne correspont à aucun compte enregistrer.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'infos')) {

	if(isset($ID)) {

		$exist = cell_count("bank", "bankhash", $ID);

		id_count($exist, "Impossible de trouver ce compte dans la base de données.");

		$bank = find_one("bank", "bankhash", $ID);

		$initbank = find_one("init_bank", "bank_id", $bank->id, "AND bankhash='$ID'");
    
	    $pointbank = find_one("point_bank", "init_id", $initbank->id);

	    $moovscounter = cell_count("bank_moovs", "init_id", $initbank->id);

	    $moovsbank = find_all("bank_moovs", "WHERE init_id='$initbank->id'");



		
		if(isset($vue) && ($vue != $ID) && ($vue === 'rapprochement-mois')) {
			
			#	Liste
			require PAGES . $subpage . '_banques.month.php';

		}

		else {

		    if(isset($_POST['bankmoovsubmit'])) {

				$error = [];

				$today = date('Y-m-d');
			    
			    list($_year, $_month, $_day) = explode("-", $today);

				if(not_empty(['amount', 'about'])) {

					extract($_POST);

			        if(!is_numeric($amount)) {

			        	$error[2] = "Votre saisie ne correspond pas à un montant valable.";

			            
			            $field = "nouvelle transaction bancaire";

			            $title = $m[1] . ', ' . $amount;

			            $msg = $error[2];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }

			        if(mb_strlen($about) < 3) {

			        	$error[3] = "Le justificatif doit être plus ou moins claire.";

			            
			            $field = "nouvelle transaction bancaire";

			            $title = $m[1] . ', Manque de détail';

			            $msg = $error[3];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }

					if(is_already_use("init_bank", "bankhash", $ID,  "AND month='$_month' AND year='$_year'")) {

						list($year, $month, $day) = explode("-", $today);

			            $infosaccount = find_one("init_bank", "bank_id", $bank->id, "AND month='$month' AND year='$year'");

			            $pointaccount = find_one("point_bank", "init_id", $infosaccount->id);

			            if(count($error) == 0) {

				            $q = $db->prepare("INSERT INTO bank_moovs(init_id,month_id,day,typeof,amount,description,created) VALUES(:init_id, :month_id, :day, :typeof, :amount, :description, :created)");
			            	
			            	$r = $db->prepare("UPDATE point_bank SET credit=:credit, debit=:debit, solde=:solde WHERE init_id=:init_id");

			            	if ($typeof === "1") {

			            		$newsolde = $pointaccount->solde + $amount;

				                $r->execute([
				                    'credit' => ($pointaccount->credit + $amount),
				                    'debit' => $pointaccount->debit,
				                    'solde' => $newsolde,
				                    'init_id' => $infosaccount->id
				                ]);

				            } else {

			            		$newsolde = $pointaccount->solde - $amount;

				                $r->execute([
				                    'credit' => $pointaccount->credit,
				                    'debit' => ($pointaccount->debit + $amount),
				                    'solde' => $newsolde,
				                    'init_id' => $infosaccount->id
				                ]);

				            }

				            $q->execute([
				                'init_id' => $infosaccount->id,
				                'month_id' => $infosaccount->month_id,
				                'day' => $day,
				                'typeof' => $typeof,
				                'amount' => $amount,
				                'description' => $about,
				                'created' => date('Y-m-d H:i:s')
				            ]);

							set_flash("Mouvement bancaire enregistrer avec succès.", "success");

				            
				            $field = $con;

				            $title = $m[1] . ', ' . $bank->bank_name . ' ' . $month . ' - ' . $year;

				            $msg = "Mouvement bancaire enregistrer avec succès.";

				            $year = date("Y");

				            set_activity(get_session("uid"), $field, $title, $msg);

							redirect(WURI . '?r=' . $m[1] . '/infos/' . $vue . '/' . $bank->bankhash . '/');

			            } else { save_input_data(); }

					}  else {

		        		list($year, $month, $day) = explode("-", $today);

			        	if(count($error) == 0) {

			            	$a = $db->prepare("SELECT * FROM point_bank WHERE init_id='$initbank->id' ORDER BY id DESC LIMIT 1");

				            $a->execute();

				            $adata = $a->fetch(PDO::FETCH_OBJ);

				            $a->closeCursor();

				            $lastpoint = $adata;


							$month_id = geraHash(10);


							$p = $db->prepare("INSERT INTO init_bank(bank_id,bankhash,month_id,month,year) VALUES(:bank_id, :bankhash, :month_id, :month, :year)");
			            
			            	$q = $db->prepare("INSERT INTO bank_moovs(init_id,month_id,day,typeof,amount,description,created) VALUES(:init_id, :month_id, :day, :typeof, :amount, :description, :created)");
			            
			            	$r = $db->prepare("INSERT INTO point_bank(init_id,solde_depart,credit,debit,solde) VALUES(:init_id, :solde_depart, :credit, :debit, :solde)");
			            
			            	$s = $db->prepare("UPDATE point_bank SET credit=:credit, debit=:debit, solde=:solde WHERE init_id=:init_id");

			                	
		                	$solde_depart = $lastpoint->solde;

		                	$p->execute([
			                    'bank_id' => $bank->id,
			                    'bankhash' => $bank->bankhash,
			                    'month_id' => $month_id,
			                    'month' => $month,
			                    'year' => $year
			                ]);

			                $init_id = $db->lastInsertId();
			                $r->execute([
			                    'init_id' => $init_id,
			                    'solde_depart' => $solde_depart,
			                    'credit' => '0',
			                    'debit' => '0',
			                    'solde' => $solde_depart
			                ]);

			                $infosaccount = find_one("init_bank", "id", $init_id);
			                $q->execute([
			                    'init_id' => $init_id,
			                    'month_id' => $month_id,
			                    'day' => $day,
			                    'typeof' => $typeof,
			                    'amount' => $amount,
			                    'description' => $about,
			                    'created' => date('Y-m-d H:i:s')
			                ]);

			                if ($typeof === "1") {

			                    $s->execute([
			                        'credit' => $amount,
			                        'debit' => '0',
			                        'solde' => ($solde_depart + $amount),
			                        'init_id' => $init_id
			                    ]);

			                } else {

			                    $s->execute([
			                        'credit' => '0',
			                        'debit' => $amount,
			                        'solde' => ($solde_depart - $amount),
			                        'init_id' => $init_id
			                    ]);

			                }

							set_flash("Mouvement bancaire enregistrer avec succès.", "success");

				            
				            $field = $con;

				            $title = $m[1] . ', ' . $bank->bank_name . ' ' . $month . ' - ' . $year;

				            $msg = "Mouvement bancaire enregistrer avec succès.";

				            $year = date("Y");

				            set_activity(get_session("uid"), $field, $title, $msg);


							redirect(WURI . '?r=' . $m[1] . '/infos/' . $vue . '/' . $bank->bankhash . '/');

			            } else { save_input_data(); }

					}


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
			require PAGES . $subpage . '_banques.infos.php';

		}

	} else {

		set_flash("L'identifiant ne correspont à aucun compte enregistrer.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'suppression')) {

	if(isset($ID)) {

		$exist = cell_count("bank", "bankhash", $ID);

		id_count($exist, "Impossible de trouver ce compte dans la base de données.");

		$bank = find_one("bank", "bankhash", $ID);

		
		if(isset($vue) && ($vue != $ID) && ($vue === 'saisie')) {

			if(isset($_POST)) {

				extract($_POST);

				$fiche = find_one("bank_moovs", "id", $SHID);

	    		$point = find_one("point_bank", "init_id", $fiche->init_id);

	    		$init = find_one("init_bank", "id", $fiche->init_id);

            
            	$q = $db->prepare("UPDATE point_bank SET credit=:credit, debit=:debit, solde=:solde WHERE init_id=:init_id");

            	 if($fiche->typeof === "1") {

	                $new_moin = $point->credit - $fiche->amount;
	                $new_solde = ($point->solde_depart + $new_moin) - $point->debit;
	                $q->execute([
	                    'credit' => $new_moin,
	                    'debit' => $point->debit,
	                    'solde' => $new_solde,
	                    'init_id' => $fiche->init_id
	                ]);

	            } else {

	                $new_moout = $point->debit - $fiche->amount;
	                $new_solde = ($point->solde_depart + $point->credit) - $new_moout;
	                $q->execute([
	                    'credit' => $point->credit,
	                    'debit' => $new_moout,
	                    'solde' => $new_solde,
	                    'init_id' => $fiche->init_id
	                ]);

	            }

				set_flash("La transaction a été supprimer avec succès.", "success");

		            
	            $field = $con;

	            $title = $m[1] . ', Suppression de transaction';

	            $msg = "La transaction : $fiche->description a été supprimer avec succès.";

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

				delete_one('bank_moovs', 'id', $SHID);

	    		redirect($_SERVER["HTTP_REFERER"]);

			}

		}

	} else {

		set_flash("L'identifiant ne correspont à aucun compte enregistrer.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}





else {

	$today = date('Y-m-d');
    
    list($year, $month, $day) = explode("-", $today);

	$actualmonth = month_convert($month);


	$banquescounter__ = count_all("bank");

	if($banquescounter__ < 1) {

		redirect(WURI . '?r=' . $m[1] . '/nouveau-compte/');

	}

    $banques__ = find_all("bank", " ORDER BY prefered DESC");

    $q = $db->prepare("SELECT * FROM bank WHERE prefered='1'");

    $q->execute();

    $data = $q->fetch(PDO::FETCH_OBJ);

    $q->closeCursor();

    $bank = $data;

    
    $split = explode(" ", $bank->am_infos);

    $am_phone = $split[0];

    $am_mail = $split[1];


    $initbank = find_one("init_bank", "bank_id", $bank->id, "ORDER BY id DESC");
    
    $pointbank = find_one("point_bank", "init_id", $initbank->id);

    $moovsbank = find_all("bank_moovs", "WHERE init_id='$initbank->id' AND description!='Initialisation'");


    if(isset($_POST['bankmoovsubmit'])) {

		$error = [];

		$today = date('Y-m-d');
	    
	    list($_year, $_month, $_day) = explode("-", $today);

		if(not_empty(['amount', 'about'])) {

			extract($_POST);

	        if(!is_numeric($amount)) {

	        	$error[2] = "Votre saisie ne correspond pas à un montant valable.";

	            
	            $field = "nouvelle transaction bancaire";

	            $title = $m[1] . ', ' . $amount;

	            $msg = $error[2];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

	        if(mb_strlen($about) < 3) {

	        	$error[3] = "Le justificatif doit être plus ou moins claire.";

	            
	            $field = "nouvelle transaction bancaire";

	            $title = $m[1] . ', Manque de détail';

	            $msg = $error[3];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

			if(is_already_use("init_bank", "bank_id", $bank->id,  "AND month='$_month' AND year='$_year'")) {

				list($year, $month, $day) = explode("-", $today);

	            $infosaccount = find_one("init_bank", "bankhash", $bank->bankhash, "AND month='$month' AND year='$year'");

	            $pointaccount = find_one("point_bank", "init_id", $infosaccount->id);

	            if(count($error) == 0) {

		            $q = $db->prepare("INSERT INTO bank_moovs(init_id,month_id,day,typeof,amount,description,created) VALUES(:init_id, :month_id, :day, :typeof, :amount, :description, :created)");
	            	
	            	$r = $db->prepare("UPDATE point_bank SET credit=:credit, debit=:debit, solde=:solde WHERE init_id=:init_id");

	            	if ($typeof === "1") {

	            		$newsolde = $pointaccount->solde + $amount;

		                $r->execute([
		                    'credit' => ($pointaccount->credit + $amount),
		                    'debit' => $pointaccount->debit,
		                    'solde' => $newsolde,
		                    'init_id' => $infosaccount->id
		                ]);

		            } else {

	            		$newsolde = $pointaccount->solde - $amount;

		                $r->execute([
		                    'credit' => $pointaccount->credit,
		                    'debit' => ($pointaccount->debit + $amount),
		                    'solde' => $newsolde,
		                    'init_id' => $infosaccount->id
		                ]);

		            }

		            $q->execute([
		                'init_id' => $infosaccount->id,
		                'month_id' => $infosaccount->month_id,
		                'day' => $day,
		                'typeof' => $typeof,
		                'amount' => $amount,
		                'description' => $about,
		                'created' => date('Y-m-d H:i:s')
		            ]);

					set_flash("Mouvement bancaire enregistrer avec succès.", "success");

		            
		            $field = "nouvelle transaction bancaire";

		            $title = $m[1] . ', ' . $bank->bank_name . ' ' . $month . ' - ' . $year;

		            $msg = "Mouvement bancaire enregistrer avec succès.";

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);


					redirect(WURI . '?r=' . $m[1] . '/');

	            } else { save_input_data(); }

			}  else {

        		list($year, $month, $day) = explode("-", $today);

	        	if(count($error) == 0) {

	            	$a = $db->prepare("SELECT * FROM point_bank WHERE init_id='$initbank->id' ORDER BY id DESC LIMIT 1");

		            $a->execute();

		            $adata = $a->fetch(PDO::FETCH_OBJ);

		            $a->closeCursor();

		            $lastpoint = $adata;


					$month_id = geraHash(10);


					$p = $db->prepare("INSERT INTO init_bank(bank_id,bankhash,month_id,month,year) VALUES(:bank_id, :bankhash, :month_id, :month, :year)");
	            
	            	$q = $db->prepare("INSERT INTO bank_moovs(init_id,month_id,day,typeof,amount,description,created) VALUES(:init_id, :month_id, :day, :typeof, :amount, :description, :created)");
	            
	            	$r = $db->prepare("INSERT INTO point_bank(init_id,solde_depart,credit,debit,solde) VALUES(:init_id, :solde_depart, :credit, :debit, :solde)");
	            
	            	$s = $db->prepare("UPDATE point_bank SET credit=:credit, debit=:debit, solde=:solde WHERE init_id=:init_id");

	                	
                	$solde_depart = $lastpoint->solde;

                	$p->execute([
	                    'bank_id' => $bank->id,
	                    'bankhash' => $bank->bankhash,
	                    'month_id' => $month_id,
	                    'month' => $month,
	                    'year' => $year
	                ]);

	                $init_id = $db->lastInsertId();
	                $r->execute([
	                    'init_id' => $init_id,
	                    'solde_depart' => $solde_depart,
	                    'credit' => '0',
	                    'debit' => '0',
	                    'solde' => $solde_depart
	                ]);

	                $infosaccount = find_one("init_bank", "id", $init_id);
	                $q->execute([
	                    'init_id' => $init_id,
	                    'month_id' => $month_id,
	                    'day' => $day,
	                    'typeof' => $typeof,
	                    'amount' => $amount,
	                    'description' => $about,
	                    'created' => date('Y-m-d H:i:s')
	                ]);

	                if ($typeof === "1") {

	                    $s->execute([
	                        'credit' => $amount,
	                        'debit' => '0',
	                        'solde' => ($solde_depart + $amount),
	                        'init_id' => $init_id
	                    ]);

	                } else {

	                    $s->execute([
	                        'credit' => '0',
	                        'debit' => $amount,
	                        'solde' => ($solde_depart - $amount),
	                        'init_id' => $init_id
	                    ]);

	                }

					set_flash("Mouvement bancaire enregistrer avec succès.", "success");

		            
		            $field = "nouvelle transaction bancaire";

		            $title = $m[1] . ', ' . $bank->bank_name . ' ' . $month . ' - ' . $year;

		            $msg = "Mouvement bancaire enregistrer avec succès.";

		            $year = date("Y");

		            set_activity(get_session("uid"), $field, $title, $msg);


					redirect(WURI . '?r=' . $m[1] . '/');

	            } else { save_input_data(); }

			}


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
	require PAGES . $subpage . '_banques.details.php';

}

$__banque = ob_get_clean();



#	Ajout de la vue
require PAGES . '/comptability/banque/banque.php';

?>