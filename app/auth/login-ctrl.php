<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#	Soumission du formilaire de connexion
if(isset($_POST["loginsubmit"])) {

	$error = [];

	if(not_empty(['identifiant', 'motdepasse'])) {

		extract($_POST);

		if(mb_strlen($identifiant) < 3) {

            $error[1] = "L'identifiant saisi est trop court. Trois (3) caractères min.";

        }

        if(mb_strlen($motdepasse) < 6) {

            $error[2] = "Le mot de passe saisi est trop court. Six (6) caractères min.";

        }


        if(count($error) == 0) {

        	#	Vérifie l'existance d'un SUPER
        	$admincounter = cell_count("users", "utid", "1");

        	#  Au cas ou l'administareur SUPER n'existe pas
        	if($admincounter < 1) {

        		$_SESSION['id'] = $identifiant;

                set_flash("Aucun compte SUPER n'a été trouver. Créez d'abord un.", "info");

				redirect(WURI . '?r=register/');

        	}


        	#	Action sur la BDD
            $q = $db->prepare("SELECT users.id, users.pseudo, users.email, users.utid, users.password AS hashed_password FROM users WHERE (users.pseudo = :identifiant OR users.email = :identifiant) AND users.active = '1' ");
            
            $q->execute(['identifiant' => $identifiant]);


            #   Action et traitement
            $user = $q->fetch(PDO::FETCH_OBJ);

            if($user && bcrypt_verify_password($motdepasse, $user->hashed_password)) {

                $_SESSION['uid'] = $user->id;
                
                $_SESSION['pseudo'] = $user->pseudo;
                
                $_SESSION['type'] = $user->utid;

                $_SESSION['email'] = $user->email;

                $_SESSION['uhash'] = geraHash(3);
                

                if(cell_count("uprefs", "uid", $user->id) < 1) {

                    $r = $db->prepare("INSERT INTO uprefs(uid) VALUES(:uid)");

                    $r->execute(['uid' => $user->id]);

                }


                #   Rédirection
                set_flash("Vous êtes bien connecté(e) sur" . '&nbsp;' . WEBSITE_NAME, "success");

                
                $field = "Authentification";

                $title = $m[1] . ', ' . $user->pseudo;

                $msg = "Vous êtes bien connecté(e).";

                $year = date("Y");

                set_activity($_SESSION['uid'], $field, $title, $msg);

                update_all("uprefs", "onlinemode", "1", "WHERE uid='$user->id'");

                if(isset($_SESSION["fwu"])) {
                    
                    redirect(WURI . $_SESSION["fwu"]);

                } else {

                    redirect(WURI . '?r=dashboard/');

                }

            } else {

                set_flash("La combinaison Identifiant / Mot de passe est incorrecte.", "danger");

                save_input_data();

            }  

		} else {

            set_flash("Assurez-vous de veillez à bien remplir tous les champs.", "danger");

            save_input_data();

        }

	}

} else { clear_input_data(); }



#	Ajout de la vue
require PAGES . '/auth/login.php';	

?>