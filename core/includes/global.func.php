<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#   onlineisok -> permet de vérifier si on est online (Connecté à internet)
if(!function_exists('onlineisok')) {

    function onlineisok() {

        if(!$sock = @fsockopen('https://www.google.fr', 443, $num, $error, 5)) {

            return "0";
        
        } else {

            return "1";

        }

    }

}



#   RandomCouleur -> permet d'attribuer une couleur aléatoire
if(!function_exists('RandomCouleur')) {

    function RandomCouleur(){
     
        return sprintf("%02X%02X%02X", mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
     
    }

}



#   set_title -> permet d'assigner le titre de la page chargée automatiquement
if(!function_exists('set_ptle')) {

    function set_ptle($key) {

        global $m;

        global $get;

        $field = []; 

        $param = [];

        $field = $m;

        $param = $get;

        if($field[1] === $param[0]) { $key = $field[1]; }

        return ucfirst($key);    

    }

}



#   e -> permet d'échaper les valeurs entrées par les users
if(!function_exists('e')) {

    function e($string) {

        if($string) { return htmlspecialchars(strip_tags($string)); }

    }

}



#   redirect -> redirection simple
if(!function_exists('redirect')) {

    function redirect($page) {

        header('Location: ' . $page);

        exit();
    }

}



#   redirect_by_intention -> permet de rédiriger au cas ou une variable $_SESSION['fwu'] existe.
if(!function_exists('redirect_by_intention')) {

    function redirect_by_intention($defaut_url) {

        if($_SESSION['fwu']) { $url = $_SESSION['fwu']; }

        else { $url = $defaut_url; }

        $_SESSION['fwu'] = null;

        redirect($url);

    }

}



#   not_empty -> verifie si un taleau de variables est vide.
if(!function_exists('not_empty')) {

    function not_empty($fields = []) {

        if(count($fields) != 0) {

            foreach($fields as $field) {

                if(empty($_POST[$field]) || trim($_POST[$field]) == "") { return false; }

            }

            return true;
        }
    }

    #*  Version adaptée aux images  #   
    function not_empty__($fields = []) {

        if(count($fields) != 0) {

            foreach($fields as $field) {

                if(empty($_POST[$field])) { return false; }

            }

            return true;
        }
    }

}



#   get_input -> retourne la valeur de la clé sauver dans en SESSION en cas d'erreurs
if(!function_exists('get_input')) {

    function get_input($key) {

        if(!empty($_SESSION['input'][$key])) { return e($_SESSION['input'][$key]); } 

        else { return null; }

    }

}



#   set_flash -> permet la gestion des notifications
if(!function_exists('set_flash')) {

    function set_flash($message, $type = 'info') {

        $_SESSION['ntf']['message'] = $message;

        $_SESSION['ntf']['type'] = $type;

    }

}



#   is_already_use -> verifie l'unicité d'une variable
if(!function_exists('is_already_use')) {

    function is_already_use($table, $field, $key, $additional = "") {

        global $db;

        $q = $db->prepare("SELECT id FROM $table WHERE $field = ? $additional");

        $q->execute([$key]);

        $count = $q->rowCount();

        $q->closeCursor();

        return $count;

    }

}



#   save_input_data -> permet de sauver dans la SESSION les infos saisies par les utilisateurs en cas d'erreurs
if(!function_exists('save_input_data')) {

    function save_input_data() {

        foreach($_POST as $key => $value) {

            if(strpos($key, 'password') === false) { $_SESSION['input'][$key] = $value; }

        }

    }

}



#   clear_input_data -> permet d'effacer les variables saisies par les utilisateurs et sauver dans la SESSION
if(!function_exists('clear_input_data')) {

    function clear_input_data() {

        if(isset($_SESSION['input'])) {$_SESSION['input'] = [];}

    }

}



#   get_curr_locale -> récupère la langue qui est sauvé en session
if(!function_exists('get_curr_locale')) {

    function get_curr_locale() {

        return $_SESSION['local'];

    }

}



#   find_all -> recupère toutes les lignes enregistrées en fonction d'un paramètre donné.
if(!function_exists('find_all')) {
    
    function find_all($table, $additional = "") {

        global $db;

        $q = $db->prepare("SELECT * FROM $table $additional");

        $q->execute();

        $data = $q->fetchAll(PDO::FETCH_OBJ);

        $q->closeCursor();

        return $data;

    }

    #*  Version adaptée à la selection distincte  #
    function find_all_distinct($table, $field, $additional = "") {

        global $db;

        $q = $db->prepare("SELECT DISTINCT $field FROM $table $additional");

        $q->execute();

        $data = $q->fetchAll(PDO::FETCH_OBJ);

        $q->closeCursor();

        return $data;

    }

}



#   find_one -> retourne la ligne enregistrée en fonction d'un paramètre donné.
if(!function_exists('find_one')) {

    function find_one($table, $field, $key, $additional = "") {

        global $db;

        $q = $db->prepare("SELECT * FROM $table WHERE $field = ? $additional");

        $q->execute([$key]);

        $data = $q->fetch(PDO::FETCH_OBJ);

        $q->closeCursor();

        return $data;

    }



    if(!function_exists('find_last')) {

        function find_last($table, $additional = "ORDER BY id DESC LIMIT 1") {

            global $db;

            $q = $db->prepare("SELECT * FROM $table $additional");

            $q->execute();

            $data = $q->fetch(PDO::FETCH_OBJ);

            $q->closeCursor();

            return $data;

        }

    }

}



#   count_all -> retourne le nombre d'enregistrements trouvés.
if(!function_exists('count_all')) {

    function count_all($table, $additional = "") {

        global $db;

        $q = $db->prepare("SELECT * FROM $table $additional");

        $q->execute();

        return $q->rowCount();

    }
}



#   cell_count -> retourne le nombre d'enregistrements trouvés en fonction d'un paramètre donné.
if(!function_exists('cell_count')) {

    function cell_count($table, $field, $key, $additional = "") {

        global $db;

        $q = $db->prepare("SELECT * FROM $table WHERE $field = ? $additional");

        $q->execute([$key]);

        return $q->rowCount();

    }

}



#   id_count -> verifie l'existence d'un indentifiant ou retourne l'erreur 404.
if(!function_exists('id_count')) {

    function id_count($func, $error) {


        if($func < 1) {

            $error = set_flash($error, "danger");

            redirect(WURI . "?r=404/");

        }

        return $func;

    }

}



#   update_one -> mets a jour une ligne donnée.
if(!function_exists('update_one')) {

    function update_one($table, $field, $value, $key) {

        global $db;

        $q = $db->prepare("UPDATE $table SET $field=? WHERE id = ? ");

        $q->execute([$value, $key]);

        $q->closeCursor();

    }

} 



#   update_all -> mets a jour plusieurs lignes en fonction des paramètres définis.
if(!function_exists('update_all')) {

    function update_all($table, $field, $value, $additional = "") {

        global $db;

        $q = $db->prepare("UPDATE $table SET $field = ? $additional");

        $q->execute([$value]);

        $q->closeCursor();

    }

}



#   delete_one -> efface l'enregistrement dont l'id est passé en paramètre.
if(!function_exists('delete_one')) {

    function delete_one($table, $field, $key) {

        global $db;

        $q = $db->prepare("DELETE FROM $table WHERE $field = ? ");

        $q->execute([$key]);

        $q->closeCursor();

    }

    function delete_all($table, $field, $key) {

        global $db;

        $q = $db->prepare("DELETE FROM $table WHERE $field = ? ");

        $q->execute([$key]);

        $q->closeCursor();

    }

}



#   Read_more -> permet de moceler un long texte pour en obtenir un extrait.
if(!function_exists('read_more')) {
    
    function read_more($long_text, $limit = 20){

        $words = explode(" ",$long_text);

        $readmore = implode(" ",array_splice($words,0,$limit));

        if($limit >= 19) {

            $readmore .= "...";

        }

        return $readmore;

    }

}



#   nbrJours -> Determine le nombre de jours
function nbJours($debut, $fin) {

    $nbSecondes= 60*60*24;

    $debut_ts = strtotime($debut);
    
    $fin_ts = strtotime($fin);
    
    $diff = $fin_ts - $debut_ts;
    
    return round($diff / $nbSecondes);
}



#   geraHash -> permet de créer des codes aléatoires de x entités
if(!function_exists('geraHash')) {

    function geraHash($qte) {

        $caracteres = "ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789";

        $quantidadeCaracteres = strlen($caracteres);

        $quantidadeCaracteres--;


        $hash = NULL;

        for ($x = 1; $x <= $qte; $x++) {

            $posicao = rand(0, $quantidadeCaracteres);

            $hash .= substr($caracteres, $posicao, 1);

        }

        return $hash;
    }

}



#   set_activity -> Enregistre l'activité dans le journal.
if(!function_exists('set_activity')) {

    function set_activity($id, $field, $title, $msg) {

        global $db;
        
        $q = $db->prepare("INSERT INTO activities(uid, field, title, activity, created_year, created) VALUES(:uid, :field, :title, :activity, :created_year, :created)");

        $q->execute([
            'uid' => $id,
            'field' => $field,
            'title' => $title,
            'activity' => $msg,
            'created_year' => date('Y'),
            'created' => date('Y-m-d H:i:s')
        ]);

        $q->closeCursor();

    }

    function set_notifier($typeof, $description, $starter_id, $dest, $link) {

        global $db;
        
        $q = $db->prepare("INSERT INTO notifications(type, description, starter_id, dest, link, created) VALUES(:type, :description, :starter_id, :dest, :link, :created)");

        $q->execute([
            'type' => $typeof,
            'description' => $description,
            'starter_id' => $starter_id,
            'dest' => $dest,
            'link' => $link,
            'created' => date('Y-m-d H:i:s')
        ]);

        $q->closeCursor();

    }

}



#   check_access -> Verifie l'accès en fonction du type d'accès d'utilisateur.
if(!function_exists('check_access')) {

    function check_access($avaliabletype = array()) {

        global $m;

        global $con;

        if(!in_array($_SESSION['type'], $avaliabletype)) {

            set_flash("Votre permission actuelle ne vous permet pas d'avoir accès à ce contenu.", "warning");

            #   Activities    
            $field = $con;

            $title = $m[1] . ', ' . $_SESSION["pseudo"];

            $msg = "Tentative d'accès non autorisée.";

            $year = date("Y");

            set_activity($_SESSION['uid'], $field, $title, $msg);


            #   Notifications
            $link = WURI . '?r=' . $m[1] . '/';

            $managers = find_all("users", " WHERE utid='1'");
            foreach($managers as $item) {

                set_notifier("H", "Tentative d'accès non autorisée de " . $_SESSION['pseudo'] . " dans le gestionnaire des " . $m[1], $_SESSION['uid'], $item->id, $link);

            }

            redirect(WURI . '?r=' . $m[1] . '/');

        }

    }

    #   admin_role -> Verifie l'accès en fonction d'un  tableau de type d'accès d'utilisateur donnée.
    function admin_role($avaliabletype = array()) {

        global $m;

        if(!in_array($_SESSION['type'], $avaliabletype)) {

            set_flash("Votre permission actuelle ne vous permet pas d'avoir accès à ce contenu.", "warning");

            #   Notifications
            $link = WURI . '?r=' . $m[1] . '/';

            $managers = find_all("users", " WHERE utid='1'");
            foreach($managers as $item) {

                set_notifier("H", "Tentative d'accès non autorisée de " . $_SESSION['pseudo'] . " dans le gestionnaire des " . $m[1], $_SESSION['uid'], $item->id, $link);

            }
            

            if($_SERVER["HTTP_REFERER"]) {
                
                redirect($_SERVER["HTTP_REFERER"]);

            } else {

                redirect(WURI . "?r=dashboard/");

            }

        }

    }

}



#   slugit -> permet de créer un permalien.
if(!function_exists('slugit')) {

    function slugit($value){

        $value = trim($value);
        $a = preg_replace('%([\']+)%', '-', $value);
        $b = str_replace('à', 'a', $a);
        $c = str_replace('â', 'a', $b);
        $d = str_replace('ô', 'o', $c);
        $e = str_replace('ï', 'i', $d);
        $f = str_replace('î', 'i', $e);
        $g = str_replace('ü', 'u', $f);
        $h = str_replace('û', 'u', $g);
        $i = str_replace('è%', 'e', $h);
        $j = str_replace('é', 'e', $i);
        $k = str_replace('ç', 'c', $j);
        $l = str_replace('ù', 'u', $k);
        $m = preg_replace('%([,\;!\?\.\:]+)%', '', $l);
        $m = trim($m);
        $n = str_replace(' ', '-', $m);

        return strtolower($n);

    }

}



#   weblink_valide -> vérifie si un lien web est valid.
if(!function_exists('weblink_valide')) {

    function weblink_valide($weblink) {

        $param = explode("/", $weblink);
        
        if(!preg_match('%https?:%', $param[0])) {
            
            return true;
            
        } else {

            if(preg_match('%localhost%', $param[2])) {

                if(preg_match('%\.([a-zA-Z0-9-_\.\/\?=&]+)%', $param[3], $matches)) { return false; }
            
            } elseif(preg_match('%\.([a-zA-Z0-9-_\.\/\?=&]+)%', $param[2], $matches)) {
                
                return false;

            } else { return true; }

        }

    }

}



#   date_to_fr -> retourn le format de la date en Francçais
if(!function_exists('date_to_fr')) {

    function date_to_fr($date) {

        #*  Passage des jours de la semaine de l'anglais au français  #
        
        $date = str_replace ("Monday", "Lundi", $date);
        $date = str_replace ("Tuesday", "Mardi", $date);
        $date = str_replace ("Wednesday", "Mercredi", $date);
        $date = str_replace ("Thursday", "Jeudi", $date);
        $date = str_replace ("Friday", "Vendredi", $date);
        $date = str_replace ("Saturday", "Samedi", $date);
        $date = str_replace ("Sunday", "Dimache", $date);

        $date = str_replace ("Mon", "Lun", $date);
        $date = str_replace ("Tue", "Mar", $date);
        $date = str_replace ("Wed", "Mer", $date);
        $date = str_replace ("Thur", "Jeu", $date);
        $date = str_replace ("Fri", "Ven", $date);
        $date = str_replace ("Sat", "Sam", $date);
        $date = str_replace ("Sun", "Dim", $date);



        #*  Passage des mois de l'année de l'anglais au français  #
        
        $date = str_replace ("January", "Janvier", $date);
        $date = str_replace ("February", "Février", $date);
        $date = str_replace ("March", "Mars", $date);
        $date = str_replace ("April", "Avril", $date);
        $date = str_replace ("May", "Mai", $date);
        $date = str_replace ("June", "Juin", $date);
        $date = str_replace ("July", "Juillet", $date);
        $date = str_replace ("August", "Août", $date);
        $date = str_replace ("September", "Septembre", $date);
        $date = str_replace ("October", "Octobre", $date);
        $date = str_replace ("November","Novembre" , $date);
        $date = str_replace ("December", "Décembre", $date);

        $date = str_replace ("Jan", "Jan", $date);
        $date = str_replace ("Feb", "Fév", $date);
        $date = str_replace ("Mar", "Mars", $date);
        $date = str_replace ("Apr", "Avr", $date);
        $date = str_replace ("May", "Mai", $date);
        $date = str_replace ("Jun", "Juin", $date);
        $date = str_replace ("Jul", "Juil", $date);
        $date = str_replace ("Aug", "Août", $date);
        $date = str_replace ("Sep", "Sep", $date);
        $date = str_replace ("Oct", "Oct", $date);
        $date = str_replace ("Nov","Nov" , $date);
        $date = str_replace ("Dec", "Déc", $date);

        return ($date);
    }

}



#   set_time -> les fonctions lié au temps et à la date
if(!function_exists('set_time')) {

    function set_time($created, $lg = "") {

        date('j/n/Y ', strtotime($created));

        $session_time = strtotime($created);

        $time_difference = time() - $session_time;

        $seconds = $time_difference;

        $minutes = round($time_difference / 60 );

        $hours = round($time_difference / 3600 );

        $days = round($time_difference / 86400 );

        $weeks = round($time_difference / 604800 );

        $months = round($time_difference / 2419200 );

        $years = round($time_difference / 29030400 );

        if($seconds <= 60) {

            if($lg == "EN_en") { echo "$seconds sec ago"; }

            echo "Il y a $seconds sec";

        } elseif($minutes <= 60) {

            if($minutes == 1) {

                if($lg == "EN_en") { echo "1 min ago"; }

                echo "Il y a 1 min";

            } else {

                if($lg == "EN_en") { echo "$minutes mins ago"; } 

                echo "Il y a $minutes mins"; 

            }

        } elseif($hours <=  24) {

            if($hours == 1) {

                if($lg == "EN_en") { echo "1h ago"; }

                echo "Il y a 1h";

            } else {

                if($lg == "EN_en") { echo "$hours hours ago"; }

                echo "Il y a $hours heures";

            }
        } elseif($days <= 7) {

            if($days == 1) {

                if($lg == "EN_en") { echo "1 day ago"; }

                echo "Il y a 1 jour";

            } else {

                if($lg == "EN_en") { echo "$days days ago"; }

                echo "Il y a $days jours";

            }

        } elseif($weeks <= 4) {

            if($weeks == 1) {

                if($lg == "EN_en") { echo "1 week ago"; }

                echo "Il y a 1 sem";

            } else {

                if($lg == "EN_en") { echo "$weeks weeks ago"; }

                echo "il y a $weeks semaines";

            }

        } elseif($months <= 12) {

            if($months == 1) {

                if($lg == "EN_en") {  echo "1 month ago"; }

                echo "Il y 1 mois";

            } else {

                if($lg == "EN_en") { echo "$moths months ago"; }

                echo "Il y a $months mois";

            }

        } else {
            
            if($years == 1) {

                if($lg == "EN_en") { echo "1 year ago"; }

                echo "Il y a 1 an";

            } else {

                if($lg == "EN_en") { echo "$years years ago"; }

                echo "Il y a $years ans";

            }

        }

    }

}



#   date_convert -> permet la conversion du temps
if(!function_exists('date_convert')) {

    function date_convert($value) {

        $field = new DateTime($value);

        $field->getTimestamp();

        $field = $field->format('U');

        return set_time($field);

    }

}



#   date_convert -> permet la conversion du temps
if(!function_exists('month_convert')) {

    function month_convert($value) {

        if($value == "1") {

            $month = "Janvier";

        } elseif($value == "2") {

            $month = "Février";

        } elseif($value == "3") {

            $month = "Mars";

        } elseif($value == "4") {

            $month = "Avril";

        } elseif($value == "5") {

            $month = "Mai";

        } elseif($value == "6") {

            $month = "Juin";

        } elseif($value == "7") {

            $month = "Juillet";

        } elseif($value == "8") {

            $month = "Août";

        } elseif($value == "9") {

            $month = "Septembre";

        } elseif($value == "10") {

            $month = "Octobre";

        } elseif($value == "11") {

            $month = "Novembre";

        } else {

            $month = "Décembre";

        }

        return $month;

    }

}



#   paginate -> fonction lié à la pagination
if(!function_exists('paginate')) {

    function nextElement(array $array, $currentKey) {

        if (!isset($array[$currentKey])) { return false; }

        $nextElement = false;

        foreach ($array as $key => $item) {

            $nextElement = next($array);

            if ($key == $currentKey) {
                
                break;

            }

        }

        return $nextElement;

    }

    function prevElement(array $array, $currentKey) {

        if (!isset($array[$currentKey])) { return false; }
        
        end($array);
        do {
            
            $key = array_search(current($array), $array);
            
            $prevElement = prev($array);
        
        }
        
        while($key != $currentKey);

        return $prevElement;

    }
    
    function paginate($url, $link, $total, $current, $adj = 3) {
        
        $prev = $current - 1;
        
        $next = $current + 1;
        
        $penultimate = $total - 1;
        
        $pagination = '';

        if($total > 1) {

            $pagination .= "<nav aria-label=\"Codex pagination\">";

            $pagination .= "<ul class=\"pagination\">";

            if($current == 2) {

                $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}\"><i class=\"fas fa-angle-left\"></i></a>";
            
            } elseif ($current > 2) {
                
                $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$link}{$prev}\"><i class=\"fas fa-angle-left\"></i></a>";

            } else {

                $pagination .= "<li class=\"page-item disabled\"><span class=\"page-link\"><i class=\"fas fa-angle-left\"></i></span></li>";

            }


            if($total < 7 + ($adj * 2)) {

                $pagination .= ($current == 1) ? "<li class=\"page-item active\"><span class=\"page-link\">1</span></li>" : "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}\">1</a></li>";

                for($i = 2; $i <= $total; $i++) {

                    if ($i == $current) {

                        $pagination .= "<li class=\"page-item active\"><span class=\"page-link\">{$i}</span></li>";

                    } else {

                        $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$link}{$i}\">{$i}</a></li>";

                    }

                }

            } else {

                if($current < 2 + ($adj * 2)) {

                    $pagination .= ($current == 1) ? "<li class=\"page-item active\"><span class=\"page-link\">1</span></li>" : "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}\">1</a></li>";

                    for($i = 2; $i < 4 + ($adj * 2); $i++) {

                        if ($i == $current) {

                            $pagination .= "<li class=\"page-item active\"><span class=\"page-link\">{$i}</span></li>";

                        } else {

                            $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$link}{$i}\">{$i}</a></li>";

                        }

                    }

                    $pagination .= "...";
                    
                    $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$link}{$penultimate}\">{$penultimate}</a></li>";
                    
                    $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$link}{$total}\">{$total}</a></li>";

                } elseif((($adj * 2) + 1 < $current) && ($current < $total - ($adj * 2))) {

                    $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}\">1</a></li>";
                    
                    $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$link}2\">2</a></li>";
                    
                    $pagination .= "...";

                    for($i = $current - $adj; $i <= $current + $adj; $i++) {

                        if ($i == $current) {
                            
                            $pagination .= "<li class=\"page-item active\"><span class=\"page-link\">{$i}</span></li>";

                        } else {
                            
                            $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$link}{$i}\">{$i}</a></li>";

                        }

                    }

                    $pagination .= "...";
                    
                    $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$link}{$penultimate}\">{$penultimate}</a></li>";
                    
                    $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$link}{$total}\">{$total}</a></li>";

                } else {

                    $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}\">1</a></li>";

                    $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$link}2\">2</a></li>";

                    $pagination .= "...";

                    for($i = $total - (2 + ($adj * 2)); $i <= $total; $i++) {

                        if ($i == $current) {
                            
                            $pagination .= "<li class=\"page-item active\"><span class=\"page-link\">{$i}</span></li>";

                        } else {
                            
                            $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$link}{$i}\">{$i}</a></li>";

                        }

                    }

                }

            }


            if($current == $total) {

                $pagination .= "<li class=\"page-item disabled\"><span class=\"page-link\"><i class=\"fas fa-angle-right\"></i></span></li>\n";

            } else {

                $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$link}{$next}\"><i class=\"fas fa-angle-right\"></i></a></li>\n";
            
            }

            $pagination .= "</ul>";
            
            $pagination .= "</nav>";

        }

        return ($pagination);
    
    }

}



#   convertfilesize -> permet de convertir la taille du fichier automatiquement
if(!function_exists('convertfilesize')) {

    function convertfilesize($size) {

        if($size < 1024) {
            
            return $size . "&nbsp;Bytes";
        
        } elseif($size < 1048576) {
            
            $kbsize = round($size/1024);

            return $kbsize . "&nbsp;KB";
        
        } else {
            
           $mbsize = round($$size/1048576, 1);

            return $mbsize . "&nbsp;MB";

        }

    }

}
