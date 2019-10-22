<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */


if(isset($con) && ($con === 'notif')) {

	if(is_numeric($ID)) {

		$exist = cell_count("notifications", "id", $ID);

		id_count($exist, "Impossible de trouver cette notification dans la base de données.");

		$notification = find_one("notifications", "id", $ID);

		
		if($ID === $notification->id) {

			update_one("notifications", "state", "off", $ID);

			if($notification->link !=='') {
				
				redirect($notification->link);

			} else {

				redirect($_SERVER["HTTP_REFERER"]);
					
			}


		} else {

	    	set_flash("Impossible d'éffectuer cette opération pour le moment. Les données reccueillies ne correspndent pas.", "warning");

	    	redirect($_SERVER["HTTP_REFERER"]);

		}

	} else {

		set_flash("L'identifiant doit être un chiffre ou un nombre.", "warning");

		redirect(WURI . '?r=' . $m[1] . '/');

	}

}


?>