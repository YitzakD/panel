<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#	Ferme toute les reservations correspondants à des campagnes finies
closedfinishedrsv();

#	Baseline
$i = 1;
	
$current = 1;

$limit = 10;

$subpage = '/main/dashboard/parts/';

ob_start();

	$today = date("Y-m-d");

	$uid = get_session("uid");


	#	Nombre de notifications non lues
	$thenotificationscounter = cell_count("notifications", "dest", $uid, "AND state='on'");


	#	Nombre de faces
	$signboardscounter = cell_count("signboards", "etat", "ras");


	#	 Nombre de réservtions en attente
	$reservationscounter = cell_count("init_rsv", "etat", "En attente");


	# ombre de campagnes en cours
	$campagnescounter = cell_count("init_rsv", "etat", "En cours");


	#	Nombre de panneaux dispos
	$_size = find_one("sizes", "size", "12");

	$today = date('Y-m-d');

	list($yr, $mo, $dy) = explode('-', $today);

	$mois = mktime(0, 0, 0, $mo, 1, $yr);

	$n2j = intval(date('t', $mois));

	if($dy >= '12') {

		$debut = "$yr-$mo-16";

	} else {

		$debut = "$yr-$mo-01";

	}

	$fin = "$yr-$mo-$n2j";

	$state = "ras";

	$size = $_size->id;

	$fsbcounter = _findashdisponbr_($size, $state);
							
	$bfsbounter = __findashdisponbr__($debut, $fin, $size, $state);

	$disposcounter = $fsbcounter + $bfsbounter;


	#	Gestion du Graphique
	$a = count_all("init_rsv", "WHERE etat!='En attente' AND year(created)='$yr'");

	$jan =count_all("init_rsv", "WHERE etat!='En attente' AND year(debut)='$yr' AND month(debut)='01'");

	$fev =count_all("init_rsv", "WHERE etat!='En attente' AND year(debut)='$yr' AND month(debut)='02'");

	$mar =count_all("init_rsv", "WHERE etat!='En attente' AND year(debut)='$yr' AND month(debut)='03'");

	$avr =count_all("init_rsv", "WHERE etat!='En attente' AND year(debut)='$yr' AND month(debut)='04'");

	$mai =count_all("init_rsv", "WHERE etat!='En attente' AND year(debut)='$yr' AND month(debut)='05'");

	$juin =count_all("init_rsv", "WHERE etat!='En attente' AND year(debut)='$yr' AND month(debut)='06'");

	$jui =count_all("init_rsv", "WHERE etat!='En attente' AND year(debut)='$yr' AND month(debut)='07'");

	$aou =count_all("init_rsv", "WHERE etat!='En attente' AND year(debut)='$yr' AND month(debut)='08'");

	$sep =count_all("init_rsv", "WHERE etat!='En attente' AND year(debut)='$yr' AND month(debut)='09'");

	$oct =count_all("init_rsv", "WHERE etat!='En attente' AND year(debut)='$yr' AND month(debut)='10'");
	
	$nov =count_all("init_rsv", "WHERE etat!='En attente' AND year(debut)='$yr' AND month(debut)='11'");
	
	$dec =count_all("init_rsv", "WHERE etat!='En attente' AND year(debut)='$yr' AND month(debut)='12'");


	#	Settings
	$upref = find_one("uprefs", "uid", get_session("uid"));

	
	#	Liste
	require PAGES . $subpage . '_dashboard.list.php';

$__dashboard = ob_get_clean();



#	Ajout de la vue
require PAGES . '/main/dashboard/dashboard.php';

?>