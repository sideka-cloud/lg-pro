<?php

// check whether command and host are set
if (isset($_GET['cmd']) && isset($_GET['host'])) {
    // define available commands
    $cmds = array('host', 'mtr', 'mtr6', 'ping', 'ping6', 'traceroute', 'traceroute6');
    // verify command
    if (in_array($_GET['cmd'], $cmds)) {
        // include required scripts
        $required = array('LookingGlass.php', 'RateLimit.php', 'Config.php');
        foreach ($required as $val) {
            require 'LookingGlass/' . $val;
        }

        // lazy check
        if (!isset($rateLimit)) {
            $rateLimit = 0;
        }

        // instantiate LookingGlass & RateLimit
        $lg = new Telephone\LookingGlass();
        $limit = new Telephone\LookingGlass\RateLimit($rateLimit);

        // check IP against database
        $limit->rateLimit($rateLimit);

        // execute command
        $output = $lg->$_GET['cmd']($_GET['host']);
        if ($output) {
            exit();
        }
    }
}
// report error
exit('Unauthorized request');