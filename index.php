<?php

//define the path and load the site
define('ABSPATH', __DIR__ . '/');
define('FILE_ACCESSS', 'LWFK');

require_once dirname(__FILE__) . '/includes/class-loresite.php';
new loresite;