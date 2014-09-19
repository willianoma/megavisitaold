<?php

include 'dao/UsuarioDao.php';

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
