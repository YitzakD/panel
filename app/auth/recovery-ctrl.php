<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#	Soumission du formilaire de récupération
if(isset($_POST['recoverysubmit'])) {

	$error = [];

    if(not_empty(['identifiant'])) {
	
    	extract($_POST);

		if(mb_strlen($identifiant) < 3) {

            $error[1] = "L'identifiant saisi est trop court. Trois (3) caractères min.";

        }
		
		if(count($error) == 0) {

			#	Action sur la BDD
			$q = $db->prepare("SELECT users.id, users.pseudo, users.email FROM users WHERE (users.pseudo = :identifiant OR users.email = :identifiant) AND users.active = '1' ");
	        
	        $q->execute(['identifiant' => $identifiant]);

	        #	Résultat & Exécution
	        if($q->rowcount() > 0) {
	        
		        $user = $q->fetch(PDO::FETCH_OBJ);

				$_SESSION['pseudo'] = $user->pseudo;
				
				set_flash("Nous avons trouvé votre identifiant.", "success");

				redirect(WURI . '?r=reset/username/' . $_SESSION['pseudo'] . '/');

	        } else {

	        	set_flash("Compte inexistant. Vueillez entrer un pseudonyme ou une adresse e-mail valide.", "danger");

	            save_input_data();

	        }

		}

	} else { save_input_data(); }

} else { clear_input_data(); }



#	Ajout de la vue
require PAGES . '/auth/recovery.php';	

?>