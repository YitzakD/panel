<?php
/**
 * Copyright: DEV-AFRIKA
 * User: Yitzak DEKPEMOU
 */



#   setType -> permet d'attribuer un type correspondant
if(!function_exists('setAtype')) {

    function setAtype($type){
     
        if($type == "RP") { $typetoset = "Régie Publiciataire"; }

        elseif($type == "AC") { $typetoset = "Agence en Communication"; }

        elseif($type == "IP") { $typetoset = "Institution Publique"; }

        elseif($type == "II") { $typetoset = "Institution Internationale"; }

        elseif($type == "AP") { $typetoset = "Autre / Personne"; }


        return $typetoset;
     
    }

}



#   Panneaux function -> recupère tout les panneaux.
if(!function_exists('find_signboards')) {

    function find_signboards($zid, $cid, $addi = "", $tional = "") {

        global $db;

        $q = $db->prepare("SELECT signboards.*, zones.zone_title, cities.city_title, cmunes.cmune_title, sizes.size FROM signboards
            LEFT JOIN zones ON zones.id=signboards.zone
            LEFT JOIN cities ON cities.id=signboards.ville
            LEFT JOIN cmunes ON cmunes.id=signboards.cmune
            LEFT JOIN sizes ON sizes.id=signboards.size
            WHERE (signboards.zone=? AND signboards.cmune=?) $addi
            ORDER BY cmunes.cmune_title ASC, signboards.nbr ASC, signboards.zone ASC, signboards.cmune ASC $tional");

        $q->execute([$zid, $cid]);

        $data = $q->fetchAll(PDO::FETCH_OBJ);

        $q->closeCursor();

        return $data;

    }


    function find_signboards_nbr($zid, $cid) {

        global $db;

        $q = $db->prepare("SELECT signboards.*, zones.zone_title, cities.city_title, cmunes.cmune_title, sizes.size 
            FROM signboards
            LEFT JOIN zones ON zones.id=signboards.zone
            LEFT JOIN cities ON cities.id=signboards.ville
            LEFT JOIN cmunes ON cmunes.id=signboards.cmune
            LEFT JOIN sizes ON sizes.id=signboards.size
            WHERE (signboards.zone=? AND signboards.cmune=?)
            ORDER BY cmunes.cmune_title ASC, signboards.nbr ASC, signboards.zone ASC, signboards.cmune ASC");

        $q->execute([$zid, $cid]);

        return $q->rowCount();
    
    }

}



#   Disponibilités function -> recupère tout les panneaux disponibles.
if(!function_exists('find_fsignboards')) {

    function find_fsignboards($zid, $cid, $fid, $state) {

        global $db;

        $q = $db->prepare("SELECT signboards.nbr, signboards.zone, signboards.ville, signboards.size, signboards.geoloc, signboards.etat, signboards.file_road, signboards.file_road_sm, cmunes.cmune_title, sizes.size 
            FROM signboards
            RIGHT JOIN cmunes ON cmunes.id=signboards.cmune
            RIGHT JOIN sizes ON sizes.id=signboards.size
            WHERE signboards.zone=? AND signboards.cmune=? AND signboards.size=? AND signboards.etat=? AND signboards.nbr NOT IN (SELECT camps.nbr FROM camps) ORDER BY cmunes.cmune_title ASC, signboards.id ASC");

        $q->execute([$zid, $cid, $fid, $state]);

        $data = $q->fetchAll(PDO::FETCH_OBJ);

        $q->closeCursor();

        return $data;

    }


    function find_fsignboards_nbr($zid, $cid, $fid, $state) {

        global $db;

        $q = $db->prepare("SELECT signboards.nbr, signboards.zone, signboards.ville, signboards.size, signboards.geoloc, signboards.etat, cmunes.cmune_title, sizes.size 
            FROM signboards
            RIGHT JOIN cmunes ON cmunes.id=signboards.cmune
            RIGHT JOIN sizes ON sizes.id=signboards.size
            WHERE signboards.zone=? AND signboards.cmune=? AND signboards.size=? AND signboards.etat=? AND signboards.nbr NOT IN (SELECT camps.nbr FROM camps)");

        $q->execute([$zid, $cid, $fid, $state]);

        return $q->rowCount();

    }


    function find_signboards_tbf($debut, $fin, $zid, $cid, $fid, $state) {

        global $db;
        
        $today = date("Y-m-d");

        $q = $db->prepare("SELECT DISTINCT camps.nbr, signboards.nbr, signboards.zone, signboards.ville, signboards.size, signboards.geoloc, signboards.etat, signboards.file_road, signboards.file_road_sm, cmunes.cmune_title, sizes.size 
            FROM camps
			LEFT JOIN signboards ON signboards.nbr=camps.nbr
			RIGHT JOIN cmunes ON cmunes.id=signboards.cmune
			INNER JOIN sizes ON sizes.id=signboards.size
			WHERE ((camps.fin BETWEEN '$today' AND '$debut') AND (camps.fin BETWEEN '$today' AND '$debut') AND (camps.fin<'$fin') AND (camps.nbr NOT IN(SELECT camps.nbr FROM camps WHERE camps.fin NOT BETWEEN '$today' AND '$debut'))) AND signboards.zone=? AND signboards.cmune=? AND signboards.size=? AND signboards.etat=? ORDER BY cmunes.cmune_title ASC, signboards.id ASC");

        $q->execute([$zid, $cid, $fid, $state]);

        $data = $q->fetchAll(PDO::FETCH_OBJ);

        $q->closeCursor();
        
        return $data;

    }


    function find_signboards_tbf_nbr($debut, $fin, $zid, $cid, $fid, $state) {

        global $db;
        
        $today = date("Y-m-d");

        $q = $db->prepare("SELECT DISTINCT camps.nbr, signboards.nbr, signboards.zone, signboards.ville, signboards.size, signboards.geoloc, signboards.etat, cmunes.cmune_title, sizes.size 
            FROM camps
			LEFT JOIN signboards ON signboards.nbr=camps.nbr
			RIGHT JOIN cmunes ON cmunes.id=signboards.cmune
			INNER JOIN sizes ON sizes.id=signboards.size
			WHERE ((camps.fin BETWEEN '$today' AND '$debut') AND (camps.fin BETWEEN '$today' AND '$debut') AND (camps.fin<'$fin') AND (camps.nbr NOT IN(SELECT camps.nbr FROM camps WHERE camps.fin NOT BETWEEN '$today' AND '$debut'))) AND signboards.zone=? AND signboards.cmune=? AND signboards.size=? AND signboards.etat=?");

        $q->execute([$zid, $cid, $fid, $state]);
        
        return $q->rowCount();

    }


    function __findashdisponbr__($debut, $fin, $fid, $state) {
        
        global $db;
        
        $today = date("Y-m-d");

        $q = $db->prepare("SELECT DISTINCT camps.nbr, signboards.nbr, signboards.zone, signboards.ville, signboards.size, signboards.geoloc, signboards.etat, cmunes.cmune_title, sizes.size 
            FROM camps
			LEFT JOIN signboards ON signboards.nbr=camps.nbr
			RIGHT JOIN cmunes ON cmunes.id=signboards.cmune
			INNER JOIN sizes ON sizes.id=signboards.size
			WHERE ((camps.fin BETWEEN '$today' AND '$debut') AND (camps.fin BETWEEN '$today' AND '$debut') AND (camps.fin<'$fin') AND (camps.nbr NOT IN(SELECT camps.nbr FROM camps WHERE camps.fin NOT BETWEEN '$today' AND '$debut'))) AND signboards.size=? AND signboards.etat=?");

        $q->execute([$fid, $state]);

        return $q->rowCount();
    
    }

    
    function _findashdisponbr_($fid, $state) {
    
        global $db;

        $q = $db->prepare("SELECT signboards.nbr, signboards.zone, signboards.ville, signboards.size, signboards.geoloc, signboards.etat, cmunes.cmune_title, sizes.size 
            FROM signboards
            RIGHT JOIN cmunes ON cmunes.id=signboards.cmune
            RIGHT JOIN sizes ON sizes.id=signboards.size
            WHERE signboards.size=? AND signboards.etat=? AND signboards.nbr NOT IN (SELECT camps.nbr FROM camps)");

        $q->execute([$fid, $state]);

        return $q->rowCount();
    
    }

    
    function find_years($table, $additional="") {
        
        global $db;
        
        $q = $db->prepare("SELECT DISTINCT created_year FROM $table $additional");

        $q->execute();
        
        $data = $q->fetchAll(PDO::FETCH_OBJ);

        $q->closeCursor();
        
        return $data;
    
    }

    
    function find_years_nbr($table, $additional="") {

        global $db;

        $q = $db->prepare("SELECT DISTINCT created_year FROM $table $additional ");

        $q->execute();

        return $q->rowCount();

    }


    function find_distinct($table, $field, $additional="") {

        global $db;
        $q = $db->prepare("SELECT DISTINCT $field FROM $table $additional");


        $q->execute();

        $data = $q->fetchAll(PDO::FETCH_OBJ);


        $q->closeCursor();

        return $data;

    }


    function find_distinct_nbr($table, $field, $additional="") {

        global $db;

        $q = $db->prepare("SELECT DISTINCT $field FROM $table $additional ");


        $q->execute();

        return $q->rowCount();

    }

}



#   closedfinishedrsv -> permet de mettre ajour la table des reservations en fonction des campages qui sont finies.
if(!function_exists('closedfinishedrsv')) {

    function closedfinishedrsv() {

        global $db;

        $today = date("Y-m-d");

        $closedrsvcounter = count_all("init_rsv", " WHERE fin<'$today' AND etat='En cours'");

        if($closedrsvcounter > 0) {

        $allclosedreservations = find_all("init_rsv", " WHERE fin<'$today' AND etat='En cours'");

        $allsbtobfree = find_all("camps", " WHERE fin<'$today'");

            foreach($allclosedreservations as $closedrsvd) {
                    
                delete_all("camps", "init_rid", $closedrsvd->id);

                delete_one("init_camp", "init_rid", $closedrsvd->id);

                update_one("init_rsv", "etat", "Closed", $closedrsvd->id);

            }

        }

    }

}



#   f_inarray -> Recherche l'existence dans un tableaux pluridimensionnel.
if(!function_exists('f_inarray')) {

    function f_inarray($needle, $needle_field, $haystack, $strict = false) {

        if ($strict) {
            
            foreach ($haystack as $item)

                if (isset($item->$needle_field) && $item->$needle_field === $needle)
                    return true;

        }

        else {

            foreach ($haystack as $item)

                if (isset($item->$needle_field) && $item->$needle_field == $needle)
                    return true;
        }

        return false;

    }

}