<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#	Récupération de l'identifiant
$ident  = 	$_SESSION['id'];

if(preg_match('%([a-zA-Z0-9-_]+)(@)([a-zA-Z0-9-_\.?=&]+)%', $ident, $matches)) {

	$savedemail = $matches[0];

	$savedident = "";

} else {

	$savedident = $ident;

	$savedemail = "";

}




#	Soumission du formilaire d'enregistrement
if(isset($_POST["registersubmit"])) {

	$error = [];

	if(not_empty(['pseudo', 'emailaddr', 'motdepasse'])) {

		extract($_POST);

		if(mb_strlen($pseudo) < 3) {

            $error[1] = "Le pseudonyme saisi est trop court. Trois (3) caractères min.";

        }

		if(!filter_var($emailaddr, FILTER_VALIDATE_EMAIL)) {

            $error[2] = "L'adresse e-mail saisie n'est pas valide.";

        }

        if(mb_strlen($motdepasse) < 6) {

            $error[3] = "Le mot de passe saisi est trop court. Six (6) caractères min.";

        }

        if(!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$#', $motdepasse)) {

            set_flash("Pour plus de sécurité, votre mot de passe doit :<ul class='m-0'><li>Contenir six (6) caractères minimum,</li><li>Contenir au moins une lettre MAJUSCULE,</li><li>Contenir un ou plusieurs chiffres.</li></ul>", "info");

            $error[3] = "Le mot de passe saisi est incomplet.<br>";
        
        }

        
        if(count($error) == 0) {

        	#	Cryptage du mot de passe
        	$pass = bcrypt_hash_password($motdepasse);

        	#	Action sur la BDD
        	$q = $db->prepare("INSERT INTO users(pseudo,email,password,utid,active,created) VALUES(:pseudo, :email, :password, :utid, :active, :created)");
            
            $q->execute([
                'pseudo' => $pseudo,
                'email' => $emailaddr,
                'password' => $pass,
                'utid' => "1",
                'active' => "1",
                'created' => date('Y-m-d H:i:s')
            ]);

            #	Rédirection
			set_flash("Votre compte SUPER a été créer avec succès.", "success");

    		redirect(WURI);

        }

	} else { save_input_data(); }

} else { clear_input_data(); }




#	Ajout de la vue
require PAGES . '/auth/register.php';	

?>


