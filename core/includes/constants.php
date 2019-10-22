<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */	  

/**Normal constants #*/
define('WEBSITE_NAME', 'Panel');

define('WEBSITE_COPYRIGHT', date('Y') . '&nbsp;©&nbsp;DEV-Afrika - Tous droits réservés');

define('WURI', 'http://panel.devafrika.com/');

define('CDN', 'http://devafrika.com/localcdn/');

define('ROOT', dirname(dirname(dirname(__FILE__))));

define('DS', DIRECTORY_SEPARATOR);

define('APP', ROOT . DS . 'app');

define('AUTH', APP . DS . 'auth');

define('ERR', APP . DS . 'errors');

define('RESSOURCES', ROOT . DS . 'ressources');

define('TEMPLATES', RESSOURCES . DS . 'templates');

define('VIEWS', RESSOURCES . DS . 'views');

define('ERRPAGES', VIEWS . DS . 'errors');

define('LAYOUTS', VIEWS . DS . 'layouts');

define('PAGES', VIEWS . DS . 'pages');

define('PARTIALS', VIEWS . DS . 'partials');



/**HARD constants #*/

$RESSOURCES = WURI . 'ressources';

$NEEDLES = $RESSOURCES . '/public';

	$CSS 	= $NEEDLES . '/css';

	$JS		= $NEEDLES .  '/js';

	$MEDIAS	= $NEEDLES . '/media';

		$UPLOAD = $MEDIAS . '/uploads';

