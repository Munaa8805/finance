<?php
ini_set('display_errors', 1);
define("ROOT", dirname(dirname(__FILE__)));
require ROOT . "/inc/conf.php";
require ROOT . "/inc/db.php";
// require ROOT . "/components/title.php";
// require ROOT . "/components/header.php";

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
function dd($arr)
{
    echo '<pre>';
    print_r($arr);
    // exit;
}

function redirect($url){
    header("Location: $url");
    exit;
}

function post($name, $length = null)
{
    $value = $_POST[$name];

    $value = addslashes($value);

    if (!is_null($length) && mb_strlen($value) > $length) {
        $value = mb_substr($value, 0, $length);
        // Security alert! DB write, email send
        echo "<br>security alert : $name индекстэй өгөгдөл $length уртаас хэтэрсэн өгөгдөлтэй байна!<br>";
    }

    return $value;
}