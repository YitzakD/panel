<?php
/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

require('core/config/db.config.php');

require('core/bootstrap/router.php');

require('global.func.php');

	require('log.func.php');

	require('session.func.php');

	require('regie.func.php');

require('constants.php');

require('classes/ImagesRefactor/images.class.php');

auto_login();