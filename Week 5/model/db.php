<?php

$ini = parse_ini_file('dbconfig.ini');

$db = new PDO("mysql:host=" . $ini['servername'] . 
              ";port=" . $ini['port'] . 
              ";dbname=" . $ini['dbname'], 
              $ini['username'], 
              $ini['password']);

//Turn of emulation of prepared statements 
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

