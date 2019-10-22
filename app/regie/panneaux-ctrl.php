<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#	Baseline
$subpage = '/regie/panneaux/parts/';

$compteur = find_all("signboards");

$curr = array_search($ID, array_column($compteur, 'id'));

$next = nextElement($compteur, $curr);

$prev = prevElement($compteur, $curr);


ob_start();

if(isset($con) && ($con === 'nouveau')) {

	#	Informations de base
	$communes = find_all("cmunes", "WHERE id>1");

	$formats = find_all("sizes", "WHERE id>1");

	if(isset($_POST['steponesubmit'])) {

		$error = [];
    	
    	if(not_empty(['nbr','cid','format'])) {

			extract($_POST);

			if(!is_numeric($nbr)) {

	        	$error[1] = "Votre saisie ne correspond pas à un chiffre ou un nombre.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $nbr;

	            $msg = $error[1];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

	        if(($nbr < "0") || ($nbr === "0")) {

	        	$error[1] = "L'identifiant ne peut pas être inférieur ou égal à zéro (0).";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $nbr;

	            $msg = $error[1];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

	        if(is_already_use('signboards', 'nbr', $nbr)) {

	        	$error[1] = "Vous avez déjà un panneau qui porte le même identifiant.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $nbr;

	            $msg = $error[1];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

	        if(cell_count("cmunes", "id", $cid) < 1) {

	        	$error[3] = "Impossible de retrouver cette commune dans la base de données.";

	            
	            $field = $con;

	            $title = $m[1] . ', Atteinte à l\'intégrité de la BDD';

	            $msg = $error[3];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

	        if(cell_count("sizes", "id", $format) < 1) {

	        	$error[2] = "Impossible de retrouver ce format dans la base de données.";

	            
	            $field = $con;

	            $title = $m[1] . ', Atteinte à l\'intégrité de la BDD';

	            $msg = $error[2];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }


 			if (count($error) == 0) {

	            $sbinfos = find_one("cmunes", "id", $cid);

	            $zid = $sbinfos->zid;
	            
	            $vid = $sbinfos->vid;

	            $q = $db->prepare("INSERT INTO signboards(nbr,zone,ville,cmune,size,created) VALUES(:nbr, :zone, :ville, :cmune, :size, :created)");

	            $q->execute([
	                'nbr' => $nbr,
	                'zone' => $zid,
	                'ville' => $vid,
	                'cmune' => $cid,
	                'size' => $format,
	                'created' => date('Y-m-d H:i:s')
	            ]);

				$pid = $db->lastInsertId();

				redirect(WURI . '?r=' . $m[1] . '/edition/etape-2/' . $pid . '/');

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
	require PAGES . $subpage . '_panneaux.new.php';

}






elseif(isset($con) && ($con === 'infos')) {

	if(is_numeric($ID)) {

		$exist = cell_count("signboards", "id", $ID);

		id_count($exist, "Impossible de trouver ce panneau dans la base de données.");

		$signboard = find_one("signboards", "id", $ID);

		$zone = find_one("zones", "id", $signboard->zone);

		$ville = find_one("cities", "id", $signboard->ville);

		$cmune = find_one("cmunes", "id", $signboard->cmune);

		$size = find_one("sizes", "id", $signboard->size);


		######

		$q = $db->prepare("SELECT rsv.*, init_rsv.id, init_rsv.camp_name, init_rsv.debut, init_rsv.fin, init_rsv.client_id, init_rsv.etat, clients.e_name FROM rsv INNER JOIN init_rsv ON init_rsv.id = rsv.init_id LEFT JOIN clients ON clients.id = init_rsv.client_id WHERE rsv.nbr='$signboard->nbr' AND init_rsv.etat!='En attente' ORDER BY init_rsv.id DESC");

		$r = $db->prepare("SELECT rsv.*, init_rsv.id, init_rsv.camp_name, init_rsv.debut, init_rsv.fin, init_rsv.client_id, init_rsv.etat, clients.e_name FROM rsv INNER JOIN init_rsv ON init_rsv.id = rsv.init_id LEFT JOIN clients ON clients.id = init_rsv.client_id WHERE rsv.nbr='$signboard->nbr' AND init_rsv.etat!='En attente' ORDER BY init_rsv.id DESC");

		$q->execute();

		$r->execute();

        $data = $q->fetchAll(PDO::FETCH_OBJ);

        $__data = $r->fetchAll(PDO::FETCH_OBJ);

        $q->closeCursor();

        $r->closeCursor();

        $lastcamps = $data;

        $lastrsv = $__data;

		
		#	Liste
		require PAGES . $subpage . '_panneaux.infos.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'edition')) {

	if(is_numeric($ID)) {

		$exist = cell_count("signboards", "id", $ID);

		id_count($exist, "Impossible de trouver ce panneau dans la base de données.");

		$signboard = find_one("signboards", "id", $ID);

		$communes = find_all("cmunes", "WHERE id>1");

		$sizes = find_all("sizes", "WHERE id>1");


		if(isset($vue) && ($vue != $ID) && ($vue === 'etape-1')) {

			if(isset($_POST['steponesubmit'])) {

				$error = [];
		    	
		    	if(not_empty(['nbr','cid','format'])) {

					extract($_POST);

					if(!is_numeric($nbr)) {

			        	$error[1] = "Votre saisie ne correspond pas à un chiffre ou un nombre.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $nbr;

			            $msg = $error[1];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }

			        if(($nbr < "0") || ($nbr === "0")) {

			        	$error[1] = "L'identifiant ne peut pas être inférieur ou égal à zéro (0).";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $nbr;

			            $msg = $error[1];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }

			        if(is_already_use('signboards', 'nbr', $nbr) && ($nbr !== $signboard->nbr)) {

			            $error[1] = "Il existe déjà un panneau qui porte le même identifiant.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $signboard->nbr;

			            $msg = $error[1];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }

			        if(cell_count("cmunes", "id", $cid) < 1) {

			        	$error[2] = "Impossible de retrouver cette commune dans la base de données.";

			            
			            $field = $con;

			            $title = $m[1] . ', Atteinte à l\'intégrité de la BDD';

			            $msg = $error[2];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }

			        if(cell_count("sizes", "id", $format) < 1) {

			        	$error[2] = "Impossible de retrouver ce format dans la base de données.";

			            
			            $field = $con;

			            $title = $m[1] . ', Atteinte à l\'intégrité de la BDD';

			            $msg = $error[2];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }


			        if(count($error) == 0) {

	                    $sbinfos = find_one("cmunes", "id", $cid);

	                    $zid = $sbinfos->zid;
	                    
	                    $vid = $sbinfos->vid;

			        	$q = $db->prepare("UPDATE signboards SET nbr=:nbr, zone=:zone, ville=:ville, cmune=:cmune, etat=:etat, created=:created WHERE id=:id");

	                    $q->execute([
	                        'nbr' => $nbr,
	                        'zone' => $zid,
	                        'ville' => $vid,
	                        'cmune' => $cid,
	                        'etat' => $etat,
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
		    	
		    	if(not_empty(['geolocalisation'])) {

					extract($_POST);

			        if(mb_strlen($geolocalisation) < 10) {

			        	$error[4] = "La situation géographique doit contenir au moins dix (10) lettres.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $geolocalisation;

			            $msg = $error[4];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }


			        if(count($error) == 0) {

			        	$q = $db->prepare("UPDATE signboards SET geoloc=:geoloc, created=:created WHERE id=:id");

	                    $q->execute([
	                        'geoloc' => $geolocalisation,
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

			if(isset($_POST['stepthreesubmit'])) {

				$error = [];

				extract($_POST);

				if($signboard->file_road_sm === "") {

					if($_FILES['file_road']['name'] == true) {

			        	$realpath = RESSOURCES . '/public/media/uploads/signboards/';

			        	$savedpath = $UPLOAD . '/signboards/';
			        	
			        	$saved_sm_path = $UPLOAD . '/signboards/min/';


			        	$target_file = $realpath . basename($_FILES["file_road"]["name"]);

			            $finalname = basename($_FILES["file_road"]["name"]);

			            $uploadOk = 1;
			            
			            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			            $check = getimagesize($_FILES["file_road"]["tmp_name"]);
			        	
			        	if($check == false) { $uploadOk = 0; }

			        	if(file_exists($target_file)) { $uploadOk = 0; }
			        	
			        	if($_FILES["file_road"]["size"] > 30000000) { $uploadOk = 0; }
			        	#if($_FILES["file_road"]["size"] > 500000) { $uploadOk = 0; }

			       	 	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) { $uploadOk = 0; }

			       	 	if($uploadOk == 1) {

			       	 		if($signboard->file_road === $savedpath.$finalname) {

								set_flash("L'image du panneau n'a été modifier car il est identique à celui déja en place.", "infos");

								redirect(WURI . '?r=' . $m[1] . '/');

			       	 		} elseif(move_uploaded_file($_FILES["file_road"]["tmp_name"], $target_file)) {

			       	 			unlink($realpath.$signboard->filename);

			       	 			unlink($realpath.'min/'.$signboard->filename);

			       	 			if (count($error) == 0) {

			                        $q = $db->prepare("UPDATE signboards SET filename=:filename, file_road=:file_road, file_road_sm=:file_road_sm, created=:created WHERE id=:id");

			                        $q->execute([
			                            'filename' => $finalname,
			                            'file_road' => $savedpath . $finalname,
			                            'file_road_sm' => $saved_sm_path . $finalname,
			                            'created' => date('Y-m-d H:i:s'),
			                            'id' => $ID
			                        ]);

			                        Img::creerMin($target_file, $realpath.'min/', $finalname, 333.3, 125);

									set_flash("L'image du panneau a été modifier avec succès.", "success");

							            
						            $field = $con;

						            $title = $m[1] . ', ' . $signboard->nbr;

						            $msg = "L'image du panneau a été modifier avec succès.";

						            $year = date("Y");

						            set_activity(get_session("uid"), $field, $title, $msg);


									redirect(WURI . '?r=' . $m[1] . '/infos/' . $ID . '/');

			       	 			} else { save_input_data(); }

			       	 		} else {

			                	save_input_data();
			               	 	
			               	 	$error[5] = "Le fichier n'a pu être charger. Vous n'avez pas les accès nécéssaire à l'écriture du fichier dans le dossier. Prière contacter le Webmaster.";

					            
					            $field = $con;

					            $title = $m[1] . ', Accès en écriture défectueux';

					            $msg = $error[5];

					            $year = date("Y");

					            set_activity(get_session("uid"), $field, $title, $msg);

			       	 		}

			       	 	} else {

			            	save_input_data();
			           	 	
			           	 	$error[5] = "Le fichier n'a pu être charger. Vérifiez l'extension ou la taille du fichier.";

				            
				            $field = $con;

				            $title = $m[1] . ', Image non-reconue';

				            $msg = $error[5];

				            $year = date("Y");

				            set_activity(get_session("uid"), $field, $title, $msg);

			        	}

			        } else {

		            	save_input_data();
		           	 	
		           	 	$error[5] = "Le fichier n'a pu être charger. Vous devez impérativement ajouter une image à ce panneau.";

			            
			            $field = $con;

			            $title = $m[1] . ', Image non chargée';

			            $msg = $error[5];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }

				} else {

					if($_FILES['file_road']['name'] == true) {

			        	$realpath = RESSOURCES . '/public/media/uploads/signboards/';

			        	$savedpath = $UPLOAD . '/signboards/';
			        	
			        	$saved_sm_path = $UPLOAD . '/signboards/min/';


			        	$target_file = $realpath . basename($_FILES["file_road"]["name"]);

			            $finalname = basename($_FILES["file_road"]["name"]);

			            $uploadOk = 1;
			            
			            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			            $check = getimagesize($_FILES["file_road"]["tmp_name"]);
			        	
			        	if($check == false) { $uploadOk = 0; }

			        	if(file_exists($target_file)) { $uploadOk = 0; }
			        	
			        	if($_FILES["file_road"]["size"] > 30000000) { $uploadOk = 0; }
			        	#if($_FILES["file_road"]["size"] > 500000) { $uploadOk = 0; }

			       	 	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) { $uploadOk = 0; }

			       	 	if($uploadOk == 1) {

			       	 		if($signboard->file_road === $savedpath.$finalname) {

								set_flash("L'image du panneau n'a été modifier car il est identique à celui déja en place.", "infos");

								redirect(WURI . '?r=' . $m[1] . '/');

			       	 		} elseif(move_uploaded_file($_FILES["file_road"]["tmp_name"], $target_file)) {

			       	 			unlink($realpath.$signboard->filename);

			       	 			unlink($realpath.'min/'.$signboard->filename);

			       	 			if (count($error) == 0) {

			                        $q = $db->prepare("UPDATE signboards SET filename=:filename, file_road=:file_road, file_road_sm=:file_road_sm, created=:created WHERE id=:id");

			                        $q->execute([
			                            'filename' => $finalname,
			                            'file_road' => $savedpath . $finalname,
			                            'file_road_sm' => $saved_sm_path . $finalname,
			                            'created' => date('Y-m-d H:i:s'),
			                            'id' => $ID
			                        ]);

			                        Img::creerMin($target_file, $realpath.'min/', $finalname, 333.3, 125);

									set_flash("Le panneau a été créer avec succès.", "success");

							            
						            $field = $con;

						            $title = $m[1] . ', ' . $signboard->nbr;

						            $msg = "Le panneau $signboard->nbr a été créer avec succès.";

						            $year = date("Y");

						            set_activity(get_session("uid"), $field, $title, $msg);


									redirect(WURI . '?r=' . $m[1] . '/infos/' . $ID . '/');

			       	 			} else { save_input_data(); }

			       	 		} else {

			                	save_input_data();
			               	 	
			               	 	$error[5] = "Le fichier n'a pu être charger. Vous n'avez pas les accès nécéssaire à l'écriture du fichier dans le dossier. Prière contacter le Webmaster.";

					            
					            $field = $con;

					            $title = $m[1] . ', Accès en écriture défectueux';

					            $msg = $error[5];

					            $year = date("Y");

					            set_activity(get_session("uid"), $field, $title, $msg);

			       	 		}

			       	 	} else {

			            	save_input_data();
			           	 	
			           	 	$error[5] = "Le fichier n'a pu être charger. Vérifiez l'extension ou la taille du fichier.";

				            
				            $field = $con;

				            $title = $m[1] . ', Image non-reconue';

				            $msg = $error[5];

				            $year = date("Y");

				            set_activity(get_session("uid"), $field, $title, $msg);

			        	}

			        } else {

			        	set_flash("Le panneau a été créer avec succès.", "success");

						redirect(WURI . '?r=' . $m[1] . '/infos/' . $ID . '/');

					}

				}


			} else { clear_input_data(); }

		}

		
		#	Liste
		require PAGES . $subpage . '_panneaux.edit.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'suppression')) {

	if(is_numeric($ID)) {

		$exist = cell_count("signboards", "id", $ID);

		id_count($exist, "Impossible de trouver ce panneau dans la base de données.");

		$signboard = find_one("signboards", "id", $ID);


		check_access(array('1'));

		
		if(isset($_POST)) {

			extract($_POST);

			set_flash("Le panneau a été supprimer avec succès.", "success");

	            
            $field = $con;

            $title = $m[1] . ', ' . $signboard->nbr;

            $msg = "Le panneau a été supprimer avec succès.";

            $year = date("Y");

            set_activity(get_session("uid"), $field, $title, $msg);
            

        	$realpath = RESSOURCES . '/public/media/uploads/signboards/';

 			unlink($realpath.'min/'.$signboard->filename);

 			unlink($realpath.$signboard->filename);


			delete_one('signboards', 'id', $ID);


			redirect(WURI . '?r=' . $m[1] . '/');

		}

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






else {

	$signboardscounter__ = count_all("signboards", "WHERE zone>1");

	$zonescounter = count_all("zones", "WHERE id>1");
	$zones__ = find_all("zones", "WHERE id>1 ORDER BY zone_title ASC");

	$communescounter = count_all("cmunes", "WHERE id>1");
	$communes__ = find_all("cmunes", "WHERE id>1 ORDER BY cmune_title ASC");


	#	Liste
	require PAGES . $subpage . '_panneaux.list.php';

}

$__panneaux = ob_get_clean();



#	Ajout de la vue
require PAGES . '/regie/panneaux/panneaux.php';

?>