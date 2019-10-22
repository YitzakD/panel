<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */



if(isset($m) && ($m === 'clients')) {

	$subpage = "/clients/";

	if(isset($con) && ($con != $ID) && ($con === 'details')) {

		if(isset($ID)) {

			$exist = cell_count("clients", "id", $ID);

			id_count($exist, "Impossible de trouver ce client dans la base de données.");
			
			#	Details
			require TEMPLATES . $subpage . 'details.php';

		}

	}


	#	Liste
	include TEMPLATES . $subpage . 'clients.php';

}






elseif(isset($m) && ($m === 'reservations')) {

	$subpage = "/reservations/";

	if(isset($con) && ($con != $ID) && ($con === 'details')) {

		if(isset($ID)) {

			$exist = cell_count("init_rsv", "id", $ID);

			id_count($exist, "Impossible de trouver cette réservation dans la base de données.");

			$rvue = explode("=", $vue);

			$type = $rvue[1];

			if($type === "list") {
		
				#	Liste
				include TEMPLATES . $subpage . 'details.php';

			} else {
			
				#	Liste
				include TEMPLATES . $subpage . 'detailsimg.php';

			}

		}

	}


	#	Liste
	include TEMPLATES . $subpage . 'reservations.php';

}






elseif(isset($m) && ($m === 'campagnes')) {

	$subpage = "/campagnes/";

	if(isset($con) && ($con != $ID) && ($con === 'details')) {

		if(isset($ID)) {

			$exist = cell_count("init_rsv", "id", $ID);

			id_count($exist, "Impossible de trouver cette campagne dans la base de données.");

			$rvue = explode("=", $vue);

			$type = $rvue[1];

			if($type === "list") {
		
				#	Details
				include TEMPLATES . $subpage . 'details.php';

			} else {
			
				#	Details image
				include TEMPLATES . $subpage . 'detailsimg.php';

			}

		}

	}


	#	Liste
	include TEMPLATES . $subpage . 'campagnes.php';

}






elseif(isset($m) && ($m === 'disponibilites')) {

	$subpage = "/disponibilites/";

	if(isset($con) && ($con != $ID) && ($con === 'recherche')) {

		if(isset($vue)) {

			$rvue = explode("=", $vue);

			if($rvue[1] === "0") {

				$zid = $rvue[1];

				if(isset($svue)) {

					$rsvue = explode("=", $svue);

					$exist = cell_count("sizes", "id", $rsvue[1], "AND id>1");

					id_count($exist, "Impossible de trouver ce format dans la base de données.");

					$fid = $rsvue[1];

					$tp = explode("=", $ID);

					$type = $tp[1];



					$d = $parm[6];

					$dbt = explode("=", $d);

					$debut = $dbt[1];

					$f = $parm[7];

					$fn = explode("=", $f);

					$fin = $fn[1];


					if($type === "list") {
						
						#	Recherche liste
						require TEMPLATES . $subpage . 'recherche.php';

					} else {
						
						#	Recherche image
						require TEMPLATES . $subpage . 'rechercheimg.php';

					}
				
				}

			} else {

				$exist = cell_count("zones", "id", $rvue[1], "AND id>1");

				id_count($exist, "Impossible de trouver cette zone dans la base de données.");

				$zid = $rvue[1];

				if(isset($svue)) {

					$rsvue = explode("=", $svue);

					$exist = cell_count("sizes", "id", $rsvue[1], "AND id>1");

					id_count($exist, "Impossible de trouver ce format dans la base de données.");

					$fid = $rsvue[1];

					$tp = explode("=", $ID);

					$type = $tp[1];



					$d = $parm[6];

					$dbt = explode("=", $d);

					$debut = $dbt[1];

					$f = $parm[7];

					$fn = explode("=", $f);

					$fin = $fn[1];


					if($type === "list") {
						
						#	Recherche liste
						require TEMPLATES . $subpage . 'recherche.php';

					} else {
						
						#	Recherche image
						require TEMPLATES . $subpage . 'rechercheimg.php';

					}
				
				}

			}

		}

	}


	#	Liste
	include TEMPLATES . $subpage . 'disponibilites.php';

}






elseif(isset($m) && ($m === 'panneaux')) {

	$subpage = "/panneaux/";

	if(isset($con) && ($con != $ID) && ($con === 'details')) {

		if(isset($ID)) {

			$exist = cell_count("signboards", "id", $ID);

			id_count($exist, "Impossible de trouver ce panneau dans la base de données.");
			
			#	Details
			require TEMPLATES . $subpage . 'details.php';

		}

	} elseif (isset($con) && ($con !== 'details')) {

		$rvue = explode("=", $con);

		$type = $rvue[1];

		if($type === "list") {
		
			#	Liste
			include TEMPLATES . $subpage . 'panneaux.php';

		} else {
		
			#	Liste
			include TEMPLATES . $subpage . 'panneauximg.php';

		}

	}

}






elseif(isset($m) && ($m === 'proformas')) {

	$subpage = "/proformas/";

	if(isset($con) && ($con != $ID) && ($con === 'details')) {

		if(isset($ID)) {

			$exist = cell_count("pformas", "id", $ID);

			id_count($exist, "Impossible de trouver cette facture pro-forma dans la base de données.");
			
			#	Details
			require TEMPLATES . $subpage . 'details.php';

		}

	}


	#	Liste
	include TEMPLATES . $subpage . 'proformas.php';

}






elseif(isset($m) && ($m === 'factures')) {

	$subpage = "/factures/";

	if(isset($con) && ($con != $ID) && ($con === 'details')) {

		if(isset($ID)) {

			$exist = cell_count("bills", "id", $ID);

			id_count($exist, "Impossible de trouver cette facture dans la base de données.");
			
			#	Details
			require TEMPLATES . $subpage . 'details.php';

		}

	} elseif(isset($con) && ($con != $ID) && ($con === 'client-transactions')) {
	
		admin_role(array("1", "2"));

		if(isset($ID)) {

			$exist = cell_count("clients", "id", $ID);

			id_count($exist, "Impossible de trouver ce client dans la base de données.");
			
			#	Details
			require TEMPLATES . $subpage . 'clienttransactions.php';

		}

	} elseif(isset($con) && ($con != $ID) && ($con === 'transaction')) {
	
		admin_role(array("1", "2"));

		if(isset($ID)) {

			$exist = cell_count("bills", "id", $ID);

			id_count($exist, "Impossible de trouver cette facture dans la base de données.");
			
			#	Details
			require TEMPLATES . $subpage . 'transaction.php';

		}

	}

	
	#	Liste
	include TEMPLATES . $subpage . 'factures.php';

}






if(isset($m) && ($m === 'fournisseurs')) {

	admin_role(array("1", "2"));

	$subpage = "/fournisseurs/";

	if(isset($con) && ($con != $ID) && ($con === 'details')) {

		if(isset($ID)) {

			$exist = cell_count("providers", "id", $ID);

			id_count($exist, "Impossible de trouver ce fournisseur dans la base de données.");
			
			#	Details
			require TEMPLATES . $subpage . 'details.php';

		}

	}


	#	Liste
	include TEMPLATES . $subpage . 'fournisseurs.php';

}






if(isset($m) && ($m === 'commandes')) {
	
	admin_role(array("1", "2"));

	$subpage = "/commandes/";

	if(isset($con) && ($con != $ID) && ($con === 'details')) {

		if(isset($ID)) {

			$exist = cell_count("bc", "id", $ID);

			id_count($exist, "Impossible de trouver cette commande dans la base de données.");
			
			#	Details
			require TEMPLATES . $subpage . 'details.php';

		}

	} elseif(isset($con) && ($con != $ID) && ($con === 'transaction')) {

		if(isset($ID)) {

			$exist = cell_count("bc", "id", $ID);

			id_count($exist, "Impossible de trouver cette commande dans la base de données.");
			
			#	Details
			require TEMPLATES . $subpage . 'transaction.php';

		}

	}


	#	Liste
	include TEMPLATES . $subpage . 'commandes.php';

}






if(isset($m) && ($m === 'caisse')) {
	
	admin_role(array("1", "2"));

	$subpage = "/caisse/";

	if(isset($con) && ($con != $ID) && ($con === 'details')) {

		if(isset($ID)) {

			$exist = cell_count("init_caisse", "id", $ID);

			id_count($exist, "Impossible de trouver cette caisse dans la base de données.");
			
			#	Details
			require TEMPLATES . $subpage . 'details.php';

		}

	}


	#	Liste
	include TEMPLATES . $subpage . 'caisse.php';

}






if(isset($m) && ($m === 'banque')) {
	
	admin_role(array("1", "2"));

	$subpage = "/banque/";

	if(isset($con) && ($con != $ID) && ($con === 'details')) {

		if(isset($ID)) {

			$exist = cell_count("bank", "bankhash", $ID);

			id_count($exist, "Impossible de trouver cette liste dans la base de données.");
			
			#	Details
			require TEMPLATES . $subpage . 'details.php';

		}

	} else {

		if(isset($ID)) {

			$exist = cell_count("bank", "bankhash", $ID);

			id_count($exist, "Impossible de trouver cette liste dans la base de données.");

			$bank = find_one("bank", "bankhash", $ID);
		
			#	Liste
			include TEMPLATES . $subpage . 'banque.php';

		}

	}



}






if(isset($m) && ($m === 'employes')) {
	
	admin_role(array("2"));

	$subpage = "/employes/";

	if(isset($con) && ($con != $ID) && ($con === 'details')) {

		if(isset($ID)) {

			$exist = cell_count("employees", "id", $ID);

			id_count($exist, "Impossible de trouver cet employé dans la base de données.");
			
			#	Details
			require TEMPLATES . $subpage . 'details.php';

		}

	}


	#	Liste
	include TEMPLATES . $subpage . 'employes.php';

}






if(isset($m) && ($m === 'zones')) {

	$subpage = "/zones/";

	if(isset($con) && ($con != $ID) && ($con === 'details')) {

		if(isset($ID)) {

			$exist = cell_count("zones", "id", $ID, "AND id>1");

			id_count($exist, "Impossible de trouver cette zone dans la base de données.");
			
			#	Details
			require TEMPLATES . $subpage . 'details.php';

		}

	}


	#	Liste
	include TEMPLATES . $subpage . 'zones.php';

}






elseif(isset($m) && ($m === 'villes')) {

	$subpage = "/villes/";

	if(isset($con) && ($con != $ID) && ($con === 'details')) {

		if(isset($ID)) {

			$exist = cell_count("cities", "id", $ID, "AND id>1");

			id_count($exist, "Impossible de trouver cette ville dans la base de données.");
			
			#	Details
			require TEMPLATES . $subpage . 'details.php';

		}

	}


	#	Liste
	include TEMPLATES . $subpage . 'villes.php';

}






elseif(isset($m) && ($m === 'communes')) {

	$subpage = "/communes/";

	if(isset($con) && ($con != $ID) && ($con === 'details')) {

		if(isset($ID)) {

			$exist = cell_count("cmunes", "id", $ID, "AND id>1");

			id_count($exist, "Impossible de trouver cette commune dans la base de données.");
			
			#	Details
			require TEMPLATES . $subpage . 'details.php';

		}

	}


	#	Liste
	include TEMPLATES . $subpage . 'communes.php';

}






elseif(isset($m) && ($m === 'formats')) {

	$subpage = "/formats/";


	#	Liste
	include TEMPLATES . $subpage . 'formats.php';

}






elseif(isset($m) && ($m === 'utilisateurs')) {
	
	admin_role(array("1"));

	$subpage = "/utilusateurs/";


	#	Liste
	include TEMPLATES . $subpage . 'utilusateurs.php';

}


?>