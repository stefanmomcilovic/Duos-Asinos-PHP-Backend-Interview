<?php
// Defining the global variabels for our site //
define('DIR', __DIR__);
define('ROOT', str_replace($_SERVER["DOCUMENT_ROOT"], "", str_replace("\\", "/", __DIR__)));
define('PAGE_PATH', '?page=');

// Require important files //
require DIR."/config/config.php";
require DIR."/config/database.php";
require DIR."/controllers/Controller.php";
// The only controller that we be instantiated and used every other controller will depends of this one because this controller is used to define route paths etc.. //
$controller = new Controller();
$controller();