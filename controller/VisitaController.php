<?php

include_once 'dao/EmpresaDao.php';
include_once 'dao/UsuarioDao.php';
include_once 'dao/VisitaDao.php';
include_once 'model/Ipdetails.php';

class VisitaController {

    private $empresaDao;
    private $usuarioDao;
    private $visitaDao;
    private $erro;

    function listar() {
        $_REQUEST['listaVisita'] = $this->visitaDao->listar();
        $_REQUEST['listaEmpresa'] = $this->empresaDao->listar();
        include 'view/web/visita/ListarVisitas.php';
    }

    function getUsuarioLogado() {
        $_REQUEST['usuarioLogado'];
        $usuarioSessao = $_SESSION['user'];
        var_dump($usuarioSessao);
    }

    function VisitaController() {
        $this->empresaDao = new EmpresaDao;
        $this->usuarioDao = new UsuarioDao;
        $this->visitaDao = new VisitaDao;
    }

    function formCadastrarVisita() {
        $_REQUEST['listaEmpresa'] = $this->empresaDao->listar();
        $_REQUEST['listaUsuario'] = $this->usuarioDao->listar();
        $usuarioSessao = $_SESSION['user'];
        $_REQUEST['usuarioLogado'] = $usuarioSessao->getNome();
        include_once 'view/web/visita/CadastrarVisita.php';
    }

    public function formDeletarVisita() {
        $id = $_POST['id'];
        $_REQUEST['visita'] = $this->visitaDao->getVisita($id);
        include_once 'view/web/visita/DeletarVisita.php';
    }

    public function formEdit() {
        $id = $_POST['id'];
        $_REQUEST['visita'] = $this->visitaDao->getVisita($id);
        include_once 'view/web/visita/EditarVisita.php';
    }

    function formCadastrarVisitaMobile() {
        $_REQUEST['listaEmpresa'] = $this->empresaDao->listar();
        $_REQUEST['listaUsuario'] = $this->usuarioDao->listar();
        include_once 'view/mobile/visita/CadastrarVisita.php';
    }

    function getPosition() {

        $ip = $_SERVER['REMOTE_ADDR'];
//        $ip = "187.65.19.208";
        $ipdetails = new ipdetails($ip);
        $ipdetails->scan();
        echo "<b>IP:</b>        " . $ip . "<br />";
        echo "<b>País:</b>      " . $ipdetails->get_country() . "<br />";
        echo "<b>Estado:</b>    " . $ipdetails->get_region() . "<br />";
        echo "<b>Cidade:</b>    " . $ipdetails->get_city() . "<br />";
        echo "<b>Latitude:</b>  " . $ipdetails->get_latitude() . "<br />";
        echo "<b>Longitude:</b> " . $ipdetails->get_longitude() . "<br />";
        echo "<b>Código país:</b> " . $ipdetails->get_countrycode() . "<br />";
        echo "<b>Código continente:</b> " . $ipdetails->get_continentcode() . "<br />";
        echo "<b>Código moeda:</b> " . $ipdetails->get_currencycode() . "<br />";
        echo "<b>Símbolo moeda:</b> " . htmlspecialchars_decode($ipdetails->get_currencysymbol()) . "<br />";
        echo "<b>Cotação moeda (dólar):</b> " . $ipdetails->get_currencyconverter() . "<br />";
        die();
    }

    function converterData($data) {

        $dataForm = strtotime($data);
        $dataFormatada = date("d/m/Y h:i:sa", $dataForm);
        return $dataFormatada;
    }

    function cadastrarVisita() {


        $empresa = $_POST['empresaVisita'];
        $usuario = $_POST['usuarioVisita'];
        $descricao = $_POST['descricaoVisita'];
        $pendencias = $_POST['pendenciasVisita'];
        $corretiva = $_POST['corretivaVisita'];
        $horaDeInicio = $_POST['horaDeInicioVisita'];
        $horaDeTermino = $_POST['horaDeTerminoVisita'];

        $horaDeInicioFormatada = $this->converterData($horaDeInicio);
        $horaDeTerminoForamatada = $this->converterData($horaDeTermino);


        if (empty($_POST['var_escondida'])) {
            $this->erro = "Impossivel cadastrar sem localização";
            echo $this->erro;
            die();
        } else
            $localization = $_POST['var_escondida'];



        date_default_timezone_set('UTC');
        $horaLocal = date('d-m-Y H:i:s');

        $id = "";

        $visita = new Visita($id, $empresa, $usuario, $descricao, $pendencias, $corretiva, $horaDeInicioFormatada, $horaDeTerminoForamatada, $localization, $horaLocal);
        $this->visitaDao->cadastrar($visita);
    }

    function verNoMapa() {
        include_once 'view/web/visita/MostrarMapa.php';
    }

}
