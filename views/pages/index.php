<?php
// starting a session
session_start();

$title = 'Home';
require_once ('../../classes/Database.php'); 

include (APPROOT . INC . '/header.php');

include (APPROOT . INC . '/content.php');

include (APPROOT . INC . '/footer.php');