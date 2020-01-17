<?php

require __DIR__ . '/libraries/autoloader.php';

require __DIR__ . '/libraries/wrappers.php';

$services = require __DIR__ . '/config/services.php';

di($services);
