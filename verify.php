<?php

require_once("./config/autoload.php");
use ch\comem\DbManagerCRUD;
$dbManager = new DbManagerCRUD();

if(isset($_GET['token'])){
    $dbManager->verifyToken($_GET['token']);
}
?>
