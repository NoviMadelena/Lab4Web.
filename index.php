<?php
$mod = isset($_REQUEST['mod']) ? $_REQUEST['mod'] : 'home';

switch ($mod) {
    case "home":
        require("home.php");
        break;
    case "tambah":
        require("tambah.php");
        break;
    default:
        require("home.php");
}
