<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#	Baseline
$i = 1;
	
$current = 1;

$limit = 10;

$subpage = '/main/profil/parts/';


ob_start();

if(isset($con) && ($con === 'infos')) {

	$userinfo = find_one("users", "id", get_session("uid"));

	$activitiescounter = cell_count("activities", "uid", $userinfo->id);

    $yearscounter = find_years_nbr("activities", "WHERE uid='$userinfo->id'");
    
    $allyears = find_years("activities", "WHERE uid='$userinfo->id' ORDER BY created_year DESC");

	
	#	Liste
	require PAGES . $subpage . '_profil.infos.php';

}






elseif(isset($con) && ($con === 'edition')) {

	if(isset($ID) && ($ID === get_session('uhash'))) {

		$exist = cell_count("users", "id", get_session('uid'));

		id_count($exist, "Impossible de trouver votre profil dans la base de données.");

		$userinfo = find_one("users", "id", get_session("uid"));


		if(isset($vue) && ($vue != $ID) && ($vue === 'base')) {

			if(isset($_POST['profilbasesubmit'])) {

				$error = [];

				if(not_empty(['pseudo', 'email'])) {

					extract($_POST);

			        if(mb_strlen($pseudo) < 3) {

			        	$error[1] = "Le pseudonyme saisi est trop court, il doit contenir au moins trois (3) lettres.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $userinfo->pseudo;

			            $msg = $error[1];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }

					if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {

			            $error[2] = "L'adresse e-mail saisie n'est pas valide.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $userinfo->pseudo;

			            $msg = $error[2];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }


			        if(count($error) == 0) {

			        	$q = $db->prepare("UPDATE users SET pseudo=:pseudo, email=:email, created=:created WHERE id=:id");

			        	$q->execute([
							'pseudo' => $pseudo,
							'email' => $email,
							'created' => date('Y-m-d H:i:s'),
							'id' => get_session('uid')
						]);

			        	if($pseudo !== get_session('pseudo')) { $_SESSION["pseudo"] = $pseudo; }

			        	if($email !== get_session('email')) { $_SESSION["email"] = $email; }
				

						set_flash("Vos informations de base ont bien été mis à jour.", "success");

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $userinfo->pseudo;

			            $msg = "Vos informations de base ont bien été mis à jour.";

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);


						redirect(WURI . '?r=' . $m[1] . '/edition/base/' . get_session('uhash') . '/');

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

			if(isset($_POST['profilcomptesubmit'])) {

				$error = [];

				if(not_empty(['upassword'])) {

					extract($_POST);

			        if(mb_strlen($upassword) < 6) {

			            $error[1] = "Le mot de passe saisi est trop court. Six (6) caractères min.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $userinfo->pseudo;

			            $msg = $error[1];

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);

			        }

			        if(!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$#', $upassword)) {

			            set_flash("Pour plus de sécurité, votre mot de passe doit :<ul class='m-0'><li>Contenir six (6) caractères minimum,</li><li>Contenir au moins une lettre MAJUSCULE,</li><li>Contenir un ou plusieurs chiffres.</li></ul>", "info");

			            $error[1] = "Le mot de passe saisi est incomplet.";

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $userinfo->pseudo;

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
							'id' => $userinfo->id
						]);
				

						set_flash("Vos informations utilisateur ont bien été mis à jour.", "success");

			            
			            $field = $con;

			            $title = $m[1] . ', ' . $userinfo->pseudo;

			            $msg = "Vos informations utilisateur ont bien été mis à jour.";

			            $year = date("Y");

			            set_activity(get_session("uid"), $field, $title, $msg);


						redirect(WURI . '?r=' . $m[1] . '/edition/compte/' . get_session('uhash') . '/');

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

		
		#	Liste
		require PAGES . $subpage . '_profil.edit.php';

	} else {

		set_flash("L'identifiant est inconnu.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}






elseif(isset($con) && ($con === 'notifications')) {

	$userinfo = find_one("users", "id", get_session("uid"));

	if(isset($vue) && ($vue === 'lire-tout')) {

		update_all("notifications", "state", "off", "WHERE dest='$userinfo->id'");


		set_flash("Toutes les notifications ont été marquer comme lu.", "success");

        
        $field = $con;

        $title = $m[1] . ', ' . $userinfo->pseudo;

        $msg = "Toutes les notifications ont été marquer comme lu.";

        $year = date("Y");

        set_activity(get_session("uid"), $field, $title, $msg);

        if($_SERVER["HTTP_REFERER"]) {
			
			redirect($_SERVER["HTTP_REFERER"]);

		} else {

			redirect(WURI . '?r=' . $m[1] . '/notifications/');

		}	

	}

	else {

		$notificationscounter = count_all("notifications", "WHERE dest='$userinfo->id'");

		$thenotificationscounter = count_all("notifications", "WHERE dest='$userinfo->id' and state='on'");

		$nbpages = ceil($notificationscounter/$limit);

		if(!empty($_GET['s']) && is_numeric($_GET['s'])) {

			$page = intval($_GET['s']);

			if($page >= 1 && $page <= $nbpages) { $current = $page; }

			elseif($page < 1) { $current = 1; }

			else { $current = $nbpages; }

		}

		$start = ($current * $limit - $limit);

		$notifications = find_all("notifications", "WHERE dest='$userinfo->id' ORDER BY state, created DESC LIMIT $start, $limit");

		
		#	Liste
		require PAGES . $subpage . '_profil.notifications.php';
	
	}

}






elseif(isset($con) && ($con === 'activites')) {

	$userinfo = find_one("users", "id", get_session("uid"));

	if(isset($vue) && is_numeric($vue) && (mb_strlen($vue) ===  4)) {

		$cyear = $vue;

		$activitiescounter = cell_count("activities", "uid", $userinfo->id, "AND created_year='$cyear'");

		if($activitiescounter > 0) {

			$nbpages = ceil($activitiescounter/$limit);

			if(!empty($_GET['s']) && is_numeric($_GET['s'])) {

				$page = intval($_GET['s']);

				if($page >= 1 && $page <= $nbpages) { $current = $page; }

				elseif($page < 1) { $current = 1; }

				else { $current = $nbpages; }

			}

			$start = ($current * $limit - $limit);

			$activities = find_all("activities", "WHERE uid='$userinfo->id' AND created_year='$cyear' ORDER BY id DESC LIMIT $start, $limit");


		} else {

			set_flash("Impossible de retrouver les activités de cette année $cyear.", "danger");

			$cyear = date('y');

			$activitiescounter = cell_count("activities", "uid", $userinfo->id, "AND created_year='$cyear'");

			if(!empty($_GET['s']) && is_numeric($_GET['s'])) {

				$page = intval($_GET['s']);

				if($page >= 1 && $page <= $nbpages) { $current = $page; }

				elseif($page < 1) { $current = 1; }

				else { $current = $nbpages; }

			}

			$start = ($current * $limit - $limit);

			$activities = find_all("activities", "WHERE uid='$userinfo->id' AND created_year='$cyear' ORDER BY id DESC LIMIT $start, $limit");


			$field = $con;

	        $title = $m[1] . ', ' . $userinfo->pseudo;

	        $msg = "Impossible de retrouver les activités de cette année $vue.";

	        $year = date("Y");

	        set_activity(get_session("uid"), $field, $title, $msg);

		}



	}

	else {
	
		$activitiescounter = cell_count("activities", "uid", $userinfo->id);

		$nbpages = ceil($activitiescounter/$limit);

		if(!empty($_GET['s']) && is_numeric($_GET['s'])) {

			$page = intval($_GET['s']);

			if($page >= 1 && $page <= $nbpages) { $current = $page; }

			elseif($page < 1) { $current = 1; }

			else { $current = $nbpages; }

		}

		$start = ($current * $limit - $limit);

		$activities = find_all("activities", "WHERE uid='$userinfo->id' ORDER BY id DESC LIMIT $start, $limit");

	}

		
	#	Liste
	require PAGES . $subpage . '_profil.activities.php';

}






elseif(isset($con) && ($con === 'reglages')) {

	$userinfo = find_one("users", "id", get_session("uid"));

	$upref = find_one("uprefs", "uid", get_session("uid"));

		
	#	Liste
	require PAGES . $subpage . '_profil.settings.php';

}






else {

	$userinfo = find_one("users", "id", get_session("uid"));

    $activitiescounter = cell_count("activities", "uid", $userinfo->id);
    
    $yearscounter = find_years_nbr("activities", "WHERE uid='$userinfo->id'");
    
    $allyears = find_years("activities", "WHERE uid='$userinfo->id' ORDER BY created_year DESC");

		
	#	Liste
	require PAGES . $subpage . '_profil.infos.php';

}



$__profil = ob_get_clean();



#	Ajout de la vue
require PAGES . '/main/profil/profil.php';

?>