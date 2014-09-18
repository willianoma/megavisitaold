﻿<meta name="viewport" content="width=320" charset="utf-8">
<head>

<div style="width: auto;">
    <p id="demo" > Antes de tudo, CLIQUE EM LOCALIZAR</p>
    <button onclick="getLocation()" style="width: 100%;height: 50"  >Localizar</button>
    <script type='text/javascript'>

        var x = document.getElementById("demo");


        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
//                x.valueOf("nada")

            }
        }

        function showPosition(position) {
//            x.innerHTML = "Latitude: " + position.coords.latitude +
//                    "<br>Longitude: " + position.coords.longitude;
            x.innerHTML = "Localizado!"
            var lat = position.coords.latitude;
            var long = position.coords.longitude;
            envia_form(lat, long);

        }

        function envia_form(lat, long) {
            var strEscondida = lat + " , " + long;
            document.getElementById('var_escondida').value = strEscondida;
        }
    </script>  
</div>

<!--<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<section>
    <article>
        <p><span id="status">Por favor aguarde enquanto nós tentamos locar você...</span></p>
    </article>
</section>
<script>
    function success(position) {
        var s = document.querySelector('#status');

        if (s.className == 'success') {
            return;
        }

        s.innerHTML = "Você foi localizado!";
        s.className = 'success';

        var mapcanvas = document.createElement('div');
        mapcanvas.id = 'mapcanvas';
        mapcanvas.style.height = '30px';
        mapcanvas.style.width = '30px';

        document.querySelector('article').appendChild(mapcanvas);

        var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

        var myOptions = {
            zoom: 15,
            center: latlng,
            mapTypeControl: false,
            navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById("mapcanvas"), myOptions);
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            title: "Você está aqui!"
        });

    }

    function error(msg) {
        var s = document.querySelector('#status');
        s.innerHTML = typeof msg == 'string' ? msg : "falhou";
        s.className = 'fail';
    }

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(success, error);
    } else {
        error('Seu navegador não suporta <b style="color:black;background-color:#ffff66">Geolocalização</b>!');
    }


</script>-->

</head>



<BR>
<?php
$listaEmpresa = $_REQUEST['listaEmpresa'];
foreach ($listaEmpresa as $empresa) {
    $razao = $empresa->getRazaoSocial();
}

$listaUsuario = $_REQUEST['listaUsuario'];
foreach ($listaUsuario as $usuario) {
    $nome = $usuario->getNome();
}
?>

<form method="POST" action="?controller=Visita&acao=cadastrarVisita">
    <input type="text" name="var_escondida" required id="var_escondida" hidden="" style="width: 100%;" />
    <div style="width: auto;">

      
        <select size="1" name="empresaVisita" required=""  style="width: 100%; height: 40">
            <option selected value="">Empresas</option>

            <?php
            foreach ($listaEmpresa as $empresa) {
                $razao = $empresa->getRazaoSocial();
                echo "<option value='$razao'>$razao</option>";
            }
            ?>

        </select>
        <BR>
        <BR>
        <select size="1" name="usuarioVisita" required="" style="width: 100%; height: 40">
            <option selected value="">Usuários</option>

            <?php
            foreach ($listaUsuario as $usuario) {
                $nome = $usuario->getNome();
                echo "<option value='$nome'>$nome</option>";
            }
            ?>

        </select>
        <BR>
        <BR>

        <label>Hora de Entrada</label>
        <BR>
        <input type="datetime-local" name="horaDeInicioVisita" required="" style="width: 100%; height: 40"/>
        <BR>
        <label>Hora de Saída</label>
        <BR>
        <input type="datetime-local" name="horaDeTerminoVisita" required="" style="width: 100%; height: 40"/>



    </div>

    <br>

    <div style="width: auto;">
        <label>Descrição</label>  
        <br>
        <textarea name="descricaoVisita" style="width: 100%; height: 100" required=""></textarea>
    </div>
    <div style="width: auto;">
        <br>
        <label>Pendencias</label>
        <br>
        <textarea name="pendenciasVisita" style="width: 100%; height: 100"></textarea>
        <br>
        <br>

        <label>Visita Corretiva?</label>
        <input type="radio" name="corretivaVisita" Value="YES"/>Sim
        <input type="radio" name="corretivaVisita" Value="NO" checked=""/>Não

    </div>
    <div style="width: auto;">
        <br>


        <input type="submit" name="cadastrarVisita" value="Cadastrar Visita"  style="width: 100%; height: 50"/>
    </div>
</form>
<br>