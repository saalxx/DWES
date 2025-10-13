<?php

require_once "..\src\controllers\Controller.php";
require_once "..\src\Models\Model.php";
require_once "..\src\views\View.php";

$Controller = new Controller();
echo $Controller->index();