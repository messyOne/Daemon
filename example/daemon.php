#!/usr/bin/php

<?php

$daemon = (new \messyOne\ExampleDaemon\DaemonFactory())->getDaemon();
$daemon->run();
