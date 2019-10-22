<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

#	Baseline
$i = 1;
	
$current = 1;

$limit = 10;

$subpage = '/regie/dispos/parts/';


ob_start();

if(isset($con) && ($con === 'recherche')) {

	#	Liste
	require PAGES . $subpage . '_dispos.search.php';

}






else {

	$zonescounter = count_all("zones", "WHERE id>1");
	$zones__ = find_all("zones", "WHERE id>1 ORDER BY zone_title ASC");

	/*$communescounter = count_all("cmunes");*/
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


	#	Liste
	require PAGES . $subpage . '_dispos.list.php';

}

$__dispos = ob_get_clean();



#	Ajout de la vue
require PAGES . '/regie/dispos/dispos.php';

?>