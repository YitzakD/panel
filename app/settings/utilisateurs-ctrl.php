<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#	Baseline
$i = 1;
	
$current = 1;

$limit = 10;

$subpage = '/settings/utilisateurs/parts/';


ob_start();

if(isset($con) && ($con === 'nouvel')) {

	if(isset($_POST['newsubmit'])) {

		$error = [];

		if(not_empty(['pseudo', 'email', 'password'])) {

			extract($_POST);

	        if(mb_strlen($pseudo) < 3) {

	        	$error[1] = "Le pseudonyme saisi est trop court, il doit contenir au moins trois (3) lettres.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $pseudo;

	            $msg = $error[1];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

			if(is_already_use('users', 'pseudo', $pseudo)) {

	            $error[1] = "Il existe déjà un utilisateur qui a le même pseudonyme.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $pseudo;

	            $msg = $error[1];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

	        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {

	            $error[2] = "L'adresse e-mail saisie n'est pas valide.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $pseudo;

	            $msg = $error[2];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

	        if(mb_strlen($password) < 6) {

	        	$error[3] = "Le mot de passe saisi est trop court, il doit contenir au moins six (6) caractères.";

	            
	            $field = $con;

	            $title = $m[1] . ', ' . $pseudo;

	            $msg = $error[3];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

	        if(!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$#', $password)) {

	            set_flash("Pour plus de sécurité, votre mot de passe doit :<ul class='m-0'><li>Contenir six (6) caractères minimum,</li><li>Contenir au moins une lettre MAJUSCULE,</li><li>Contenir un ou plusieurs chiffres.</li></ul>", "info");

	            $error[3] = "Le mot de passe saisi est incomplet.<br>";
	        
	        }

	        if(cell_count("utypes", "id", $utid) < 1) {

	        	$error[4] = "Impossible de retrouver ce type de rôle dans la base de données.";

	            
	            $field = $con;

	            $title = $m[1] . ', Atteinte à l\'intégrité de la BDD';

	            $msg = $error[4];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

	        if(!is_numeric($active) || $active < 0 || $active > 1) {

	        	$error[5] = "Impossible de retrouver cet etat de compte dans la base de données.";

	            
	            $field = $con;

	            $title = $m[1] . ', Atteinte à l\'intégrité de la BDD';

	            $msg = $error[5];

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	        }

	        if(count($error) == 0) {

	        	$pass = bcrypt_hash_password($password);

	        	$q = $db->prepare("INSERT INTO users(pseudo,email,password,utid,active,created) VALUES(:pseudo, :email, :password, :utid, :active, :created)");
	            
	            $q->execute([
	                'pseudo' => $pseudo,
	                'email' => $email,
	                'password' => $pass,
	                'utid' => $utid,
	                'active' => $active,
	                'created' => date('Y-m-d H:i:s')
	            ]);

				set_flash("L'utilisateur a été ajouter avec succès.", "success");

		            
	            $field = $con;

	            $title = $m[1] . ', ' . $pseudo;

	            $msg = "L'utilisateur a été ajouter avec succès.";

	            $year = date("Y");

	            set_activity(get_session("uid"), $field, $title, $msg);

	    		redirect(WURI . '?r=' . $m[1] . '/');

	        } else { save_input_data(); }

		} else {

			save_input_data();

			$error[] = "Veuillez à remplir tous les champs marqués par un astérisk (*).";

	            
            $field = $con;

            $title = $m[1] . ', Réglages';

            $msg = "Veuillez à remplir tous les champs marqués par un astérisk (*).";

            $year = date("Y");

            set_activity(get_session("uid"), $field, $title, $msg);

		}

	} else { clear_input_data(); }

		
	#	Liste
	require PAGES . $subpage . '_utilisateurs.new.php';

}






elseif(isset($con) && ($con === 'infos')) {

	if(is_numeric($ID)) {

		$exist = cell_count("users", "id", $ID);

		id_count($exist, "Impossible de trouver cet utilisateur dans la base de données.");

		$utilisateur = find_one("users", "id", $ID);

		if($utilisateur->utid > 1) {

			$activitiescounter = cell_count("activities", "uid", $utilisateur->id);

			$activities = find_all("activities", "WHERE uid='$utilisateur->id' ORDER BY id DESC LIMIT 0,25");

		} else {

			redirect(WURI . '?r=profil/infos/' . $utilisateur->id . '/');

		}	

		
		#	Liste
		require PAGES . $subpage . '_utilisateurs.infos.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'edition')) {

	if(is_numeric($ID)) {

		$exist = cell_count("users", "id", $ID);

		id_count($exist, "Impossible de trouver cet utilisateur dans la base de données.");

		$utilisateur = find_one("users", "id", $ID);


		if($utilisateur->utid > 1) {

			$utilisateur->email;

			$info = find_one("employees", "dev_mail", $utilisateur->email);


			if(isset($vue) && ($vue != $ID) && ($vue === 'base')) {

				if(isset($_POST['basesubmit'])) {

					$error = [];

					if(not_empty(['pseudo'])) {

						extract($_POST);

				        if(mb_strlen($pseudo) < 3) {

				        	$error[2] = "Le pseudonyme saisi est trop court, il doit contenir au moins trois (3) lettres.";

				            
				            $field = $con;

				            $title = $m[1] . ', ' . $utilisateur->pseudo;

				            $msg = $error[2];

				            $year = date("Y");

				            set_activity(get_session("uid"), $field, $title, $msg);

				        }


				        if(count($error) == 0) {

				        	$q = $db->prepare("UPDATE users SET pseudo=:pseudo, created=:created WHERE id=:id");

				        	$q->execute([
								'pseudo' => $pseudo,
								'created' => date('Y-m-d H:i:s'),
								'id' => $ID
							]);
					

							set_flash("Les informations de base de l'utilisateur ont bien été mis à jour.", "success");

				            
				            $field = $con;

				            $title = $m[1] . ', ' . $utilisateur->pseudo;

				            $msg = "Les informations de base de l'utilisateur ont bien été mis à jour.";

				            $year = date("Y");

				            set_activity(get_session("uid"), $field, $title, $msg);


							redirect(WURI . '?r=' . $m[1] . '/edition/base/' . $ID . '/');

				        } else { save_input_data(); }

					} else {

						save_input_data();

						$error[] = "Veuillez à remplir tous les champs marqués par un astérisk (*).";

				            
			            $field = $con;

			            $title = $m[1] . ', Réglages';

			            $msg = "Veuillez à remplir tous les champs marqués par un astérisk (*).";

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

					}

				} else { clear_input_data(); }

			}

			elseif(isset($vue) && ($vue != $ID) && ($vue === 'compte')) {

				if(isset($_POST['comptesubmit'])) {

					$error = [];

					extract($_POST);

			        if(cell_count("utypes", "id", $utilisateur->utid) < 1) {

			        	$error[1] = "Impossible de retrouver ce type de rôle dans la base de données.";

			            
			            $field = $con;

			            $title = $m[1] . ', Atteinte à l\'intégrité de la BDD';

			            $msg = $error[1];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }

			        if(!is_numeric($active) || $active < 0 || $active > 1) {

			        	$error[1] = "Impossible de retrouver cet etat de compte dans la base de données.";

			            
			            $field = $con;

			            $title = $m[1] . ', Atteinte à l\'intégrité de la BDD';

			            $msg = $error[1];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }


			        if(count($error) == 0) {

			        	$q = $db->prepare("UPDATE users SET utid=:utid, active=:active, created=:created WHERE id=:id");

			        	$q->execute([
							'utid' => $utid,
							'active' => $active,
							'created' => date('Y-m-d H:i:s'),
							'id' => $ID
						]);
				

						set_flash("Les informations de compte de l'utilisateur ont bien été mis à jour.", "success");

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $utilisateur->pseudo;

			            $msg = "Les informations de compte de l'utilisateur ont bien été mis à jour.";

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);


						redirect(WURI . '?r=' . $m[1] . '/edition/compte/' . $ID . '/');

			        } else { save_input_data(); }

				} else { clear_input_data(); }	

			}

			elseif(isset($vue) && ($vue != $ID) && ($vue === 'utilisateur')) {
				
				if(isset($_POST['usersubmit'])) {

					$error = [];

					if(not_empty(['upassword'])) {

						extract($_POST);

				        if(mb_strlen($upassword) < 6) {

				            $error[1] = "Le mot de passe saisi est trop court. Six (6) caractères min.";

				            
				            $field = $con;

				            $title = $m[1] . ', ' . $utilisateur->pseudo;

				            $msg = $error[1];

				            $year = date("Y");

				            set_activity(get_session("uid"), $field, $title, $msg);

				        }

				        if(!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$#', $upassword)) {

				            set_flash("Pour plus de sécurité, votre mot de passe doit :<ul class='m-0'><li>Contenir six (6) caractères minimum,</li><li>Contenir au moins une lettre MAJUSCULE,</li><li>Contenir un ou plusieurs chiffres.</li></ul>", "info");

				            $error[1] = "Le mot de passe saisi est incomplet.";

				            
				            $field = $con;

				            $title = $m[1] . ', ' . $utilisateur->pseudo;

				            $msg = $error[1];

				            $year = date("Y");

				            set_activity(get_session("uid"), $field, $title, $msg);
				        
				        }



				        if(count($error) == 0) {
        					
        					$pass = bcrypt_hash_password($upassword);

				        	$q = $db->prepare("UPDATE users SET password=:password, created=:created WHERE id=:id");

				        	$q->execute([
								'password' => $pass,
								'created' => date('Y-m-d H:i:s'),
								'id' => $ID
							]);
					

							set_flash("Les informations d'utilisateur de l'utilisateur ont bien été mis à jour.", "success");

				            
				            $field = $con;

				            $title = $m[1] . ', ' . $utilisateur->pseudo;

				            $msg = "Les informations d'utilisateur de l'utilisateur ont bien été mis à jour.";

				            $year = date("Y");

				            set_activity(get_session("uid"), $field, $title, $msg);


							redirect(WURI . '?r=' . $m[1] . '/edition/utilisateur/' . $ID . '/');

				        } else { save_input_data(); }


					} else {

						save_input_data();

						$error[] = "Veuillez à remplir le champs mot de passe pour effectuer une modification.";

				            
			            $field = $con;

			            $title = $m[1] . ', Réglages';

			            $msg = "Veuillez à remplir le champs mot de passe pour effectuer une modification.";

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

					}

				} else { clear_input_data(); }

			}


		} else {

			redirect(WURI . '?r=profil/infos/');

		}	

		
		#	Liste
		require PAGES . $subpage . '_utilisateurs.edit.php';

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'suppression')) {

	if(is_numeric($ID)) {

		$exist = cell_count("users", "id", $ID);

		id_count($exist, "Impossible de trouver cet utilisateur dans la base de données.");

		$utilisateur = find_one("users", "id", $ID);


		if(isset($_POST)) {

			extract($_POST);


			set_flash("L'utilisateur a été supprimer avec succès.", "success");
	            
            $field = $con;

            $title = $m[1] . ', ' . $utilisateur->pseudo;

            $msg = "L'utilisateur $utilisateur->pseudo a été supprimer avec succès.";

            $year = date("Y");

            set_activity(get_session("uid"), $field, $title, $msg);


            delete_one("users", "id", $ID);
			

			redirect(WURI . '?r=' . $m[1] . '/');

		} else { clear_input_data(); }

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






else {

	$utilisateurscounter__ = count_all("users", "WHERE utid>1");
		
	$nbpages = ceil($utilisateurscounter__/$limit);

	if(!empty($_GET['s']) && is_numeric($_GET['s'])) {

		$page = intval($_GET['s']);

		if($page >= 1 && $page <= $nbpages) { $current = $page; }

		elseif($page < 1) { $current = 1; }

		else { $current = $nbpages; }

	}

	$start = ($current * $limit - $limit);

    $utilisateurs__ = find_all("users", "WHERE utid>1 ORDER BY id ASC LIMIT $start, $limit");


	#	Liste
	require PAGES . $subpage . '_utilisateurs.list.php';

}

$__utilisateurs = ob_get_clean();



#	Ajout de la vue
require PAGES . '/settings/utilisateurs/utilisateurs.php';

?>