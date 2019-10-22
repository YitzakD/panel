<?php

#	Gère les alertes d'erreurs
if(isset($error) && count($error) != 0) {

    foreach($error as $value) {

    echo '<div class="alert alert-danger alert-dismissible fade show dev-content-alert" role="alert" id="js-p-alert">';

    		echo '<div class="content-alert-one"><strong>Erreur!</strong> ' . $value . '</div>';

        echo '<button type="button" class="close p-alert-close" data-dismiss="alert" aria-label="Close" title="Fermer">';

            echo '<span aria-hidden="true">&times;</span>';

        echo '</button>';

    echo '</div>';
    	
    }

}