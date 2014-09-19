<?php

include 'dao/UsuarioDao.php';
include_once 'model/Usuario.php';

class LoginController {

    private $usuarioDao;

    function LoginController() {
        $this->usuarioDao = new UsuarioDao;
    }

    function formLogin() {
        include 'view/web/login/autenticacao.php';
    }

    function formLoginMobile() {
        include 'view/mobile/login/autenticacao.php';
    }

    function autenticar() {

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if ($email == "admin" && $senha == "12310") {
            $usuarioadmin = new Usuario("9999", "administrador", "12310", "000", "admin", "000", "admin");
//            $user = "admin";
            $_SESSION['user'] = $usuarioadmin;
//            $this->logonAdmin();
            header('location:index.php');
        } else
            echo 'usuario ou senha incorreto';


        $user = $this->usuarioDao->getUsuarioLogin($email);

        if ($user->getEmail() == $email && $user->getSenha() == $senha) {
//DAO TA TRANTANDO USUARIO INEXISTENTE

            $_SESSION['user'] = $user;
            header('location:index.php');
        } else
            echo 'usuario ou senha incorreto';
    }

    function logonAdmin() {
        $_SESSION['user'] = $user;
//        include 'view/web/adm/home.php';
    }

    function logonUser() {
        $_SESSION['user'] = $user;
//        include 'view/web/user/home.php';
    }

    function logout() {
        include 'view/web/logout.php';
        header('location:index.php');
    }

}
