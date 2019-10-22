<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#	Soumission du formilaire de connexion
if(isset($_POST['resetsubmit'])) {

	$error = [];

	if(not_empty(['motdepasse'])) {

		extract($_POST);

		if(mb_strlen($motdepasse) < 6) {

            $error[1] = "Le mot de passe saisi est trop court. Six (6) caractères min.";

        }

        if(!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$#', $motdepasse)) {

            set_flash("Pour plus de sécurité, votre mot de passe doit :<ul class='m-0'><li>Contenir six (6) caractères minimum,</li><li>Contenir au moins une lettre MAJUSCULE,</li><li>Contenir un ou plusieurs chiffres.</li></ul>", "info");

            $error[1] = "Le mot de passe saisi est incomplet.<br>";
        
        }


        if(count($error) == 0) {

        	$user = find_one("users", "id", $ID);

        	if($user && bcrypt_verify_password($motdepasse, $user->password)) {

        		 set_flash("Le mot de passe saisi est identique à l'ancien.", "danger");
        	
        	} else {

        		#	Cryptage du mot de passe
        		$motdepasse = bcrypt_hash_password($motdepasse);

        		#	Action sur la BDD
	            $q = $db->prepare("UPDATE users SET password=:password, created=:created WHERE id=:id AND pseudo=:pseudo");
	            
	            $q->execute([
	                'password' => $motdepasse,
	                'created' => date('Y-m-d H:i:s'),
	                'id' => $user->id,
	                'pseudo' => $user->pseudo
	            ]);

	            #	Rédirection
	            set_flash("Votre mot de passe a été réinitialiser avec succès.", "success");

				redirect(WURI . '?r=login/');

        	}

        }

	}

} else { clear_input_data(); }


#	Ajout de la vue
require PAGES . '/auth/reset.php';	

?>