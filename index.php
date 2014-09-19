<meta charset="utf-8">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>

<?php
include_once 'model/verificaBrowser.php';
include_once 'model/Usuario.php';

//session_cache_limiter('private');
//session_cache_expire(1); //Arrumar isso ai...
session_start();
//session_destroy();


if (empty($_SESSION['user'])) {
    $user = NULL;
} else {
    $user = $_SESSION['user'];
}

// INCLUIR PERMICAO NO GET PARA CORRIGIR A FALHA DE SEGURANÇA VIA URL.

if ($user == NULL) {

//    if (empty($_GET['controller'])) {
    $controller = 'Login';
    $controller .= 'Controller';
//    }
//    else {
//        $controller = "Login";
//        $controller .= 'Controller';
//    }

    $arquivo = 'controller/' . $controller . '.php';
    require_once $arquivo;

    if (empty($_GET['acao'])) {
        if ($browser == 'mobile') {
            $acao = "formLoginMobile";
        } else {
            $acao = "formLogin";
        }
    } else {
        $acao = "autenticar";
    }
} else if ($user != NULL) {

    if (empty($_GET['controller'])) {
        $controller = 'Home';
        $controller .= 'Controller';
    } else {
        $controller = $_GET ['controller'];
        $controller .= 'Controller';
    }

    $arquivo = 'controller/' . $controller . '.php';
    require_once $arquivo;


    $permicao = $user->getPermicao();

    if ($permicao == 'admin') {
        if ($browser == 'web') {
            include_once 'view/web/adm/menu.php';
            if (empty($_GET['acao'])) {
                $acao = "homeAdmin";
            } else {
                $acao = $_GET['acao'];
            }
        } else if ($browser == 'mobile') {
            include_once 'view/mobile/adm/menu.php';
            if (empty($_GET['acao'])) {
                $acao = "homeAdminMobile";
            } else {
                $acao = $_GET['acao'];
            }
        }
    }

    if ($permicao == 'user') {
        if ($browser == 'web') {
            include_once 'view/web/user/menu.php';
            if (empty($_GET['acao'])) {
                $acao = "homeUsuario";
            } else {
                $acao = $_GET['acao'];
            }
        } else if ($browser == 'mobile') {
            include_once 'view/mobile/user/menu.php';
            if (empty($_GET['acao'])) {
                $acao = "homeUsuarioMobile";
            } else {
                $acao = $_GET['acao'];
            }
        }
    }
}
?>

<?php
$obj = new $controller(); //Cria o objeto do controller
$obj->$acao(); //executa a a��o
?>
