<?php
ini_set('display_errors', 1);
define("ROOT", dirname(dirname(__FILE__)));

require ROOT . "/components/title.php";
// require ROOT."/pages/user/home.php";
require ROOT . "/components/header.php";

$page =@$_SERVER["REDIRECT_URL"];
if(empty($page)){
    require ROOT . "/pages/home.php";
}else {
    $script = ROOT . "/pages$page.php";
    if(file_exists($script)){
        require $script;}
        else {
            require ROOT . "/pages/404.php";
        }
}



require ROOT . "/components/footer.php";