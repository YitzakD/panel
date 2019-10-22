<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#   bcrypt_hash_password function -> Hashage du mot de passe avec l'algorithme bcrypt.
if(!function_exists('bcrypt_hash_password')) {

    function bcrypt_hash_password($value, $options = array()) {

        #*  coast  #

        $cost = isset($options['rounds']) ? $options['rounds'] : 10;

        $hash = password_hash($value, PASSWORD_BCRYPT, array('cost' => $cost));

        if($hash === false) { throw new Exception("Bcrypt hashing n'est pas supporté."); }

        return $hash;

    }

}



#   bcrypt_verify_password function -> Vérification du mot de passe hashé avec l'algorithme bcrypt.
if(!function_exists('bcrypt_verify_password')) {

    function bcrypt_verify_password($value, $hashedValue) {

        return password_verify($value, $hashedValue);

    }

}



#   remember_me function -> Permet l'enregistrement des différents tokens et selectors de sécurité quand
if(!function_exists('remember_me')) {
    
    function remember_me($user_id) {

        global $db;

        $token = openssl_random_pseudo_bytes(24);

        do {
            
            $selector = openssl_random_pseudo_bytes(9);

        } while(cell_count('auth_tokens', 'selector', $selector) > 0);

        
        $q = $db->prepare("INSERT INTO auth_tokens(expires, selector, uid, token) VALUES(DATE_ADD(NOW(), INTERVAL 365 DAY), :selector, :uid, :token)");

        $q->execute([
            'selector' => $selector,
            'uid' => $user_id,
            'token' => $token
        ]);

        
        #   Créer un cookie 'auth' (14jrs expires) httpOnly => true
        #   Contenu => base64_encode(selector).':'.base64_encode(token)
        setcookie(
            'auth',
            base64_encode($selector).':'.base64_encode($token),
            time()+31536000,
            null,
            null,
            false,
            true
        );

    }

}



#   auto_login function -> verifie le cookie afin de permettre la connection automatique du user
if(!function_exists('auto_login')) {

    #*  quand celui ci coche le champ 'remember me'.  #
    
    function auto_login() {

        global $db;

        if(!empty($_COOKIE['auth'])) {

            $split = explode(':', $_COOKIE['auth']);

            if(count($split) !==  2) { return false; }

            $selector = $split[0];
            
            $token = $split[1];

            $q = $db->prepare("SELECT auth_tokens.token, auth_tokens.uid, users.pseudo, users.email, users.utid, users.id FROM auth_tokens LEFT JOIN users ON auth_tokens.uid = users.id WHERE auth_tokens.selector = ? AND auth_tokens.expires >= CURDATE()");

            $q->execute([$selector]);

            $data = $q->fetch(PDO::FETCH_OBJ);

            if($data) {

                if($data->token === $token) {

                    session_regenerate_id(true);

                    $_SESSION['uid'] = $data->id;

                    $_SESSION['pseudo'] = $data->pseudo;

                    $_SESSION['type'] = $data->utid;

                    $_SESSION['email'] = $data->email;

                    return true;
                    
                }

            }

        }

        return false;

    }

}