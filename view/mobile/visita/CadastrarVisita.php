<meta name="viewport" content="width=320" charset="utf-8">
<!--<head>

<div class="divtop">
    <p id="demo" > Antes de tudo, CLIQUE EM LOCALIZAR</p>
    <button onclick="getLocation()" class="Buttons" >Localizar</button>
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


</head>-->

<head>

<div class="divtop">
    <p id="demo" >Clique para localizar</p>
    <button class="Buttons" onclick="getLocation()">Localizar</button>
</div>

<script type='text/javascript'>

    var x = document.getElementById("demo");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude +
                "<br>Longitude: " + position.coords.longitude;
        var lat = position.coords.latitude;
        var long = position.coords.longitude;
        envia_form(lat, long);

    }

    function envia_form(lat, long) {
        var strEscondida = lat + " , " + long;
        document.getElementById('var_escondida').value = strEscondida;
    }
</script>  

<style type="text/css">
    select {
        height: 40px;
        width: 200px;
        font-size: 16px;
        font-weight: bold;
    }
    textarea{
        height: 100px;
        min-width: 100%;
    }

    .divtop{
        text-align: center;
        margin-left: 5px;
        margin-right: 5px;
        margin-top: 15px;
    }

    .divPrincipal {
        text-align: center;
        margin-left: 5px;
        margin-right: 5px;

    }
    .forms {
        margin-top: 20px;
        margin-bottom: 20px;
        width: auto;
    }

    .reponsive{
        width: auto;

    }

    .Buttons{
        margin-top: 5px;
        margin-bottom: 10px;
        height: 60px;
        width: 100%
    }



</style>



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

<div class="divPrincipal">
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
            <textarea name="descricaoVisita"  required=""></textarea>
        </div>
        <div style="width: auto;">
            <br>
            <label>Pendencias</label>
            <br>
            <textarea name="pendenciasVisita" ></textarea>
            <br>
            <br>

            <label>Visita Corretiva?</label>
            <input type="radio" name="corretivaVisita" Value="YES"/>Sim
            <input type="radio" name="corretivaVisita" Value="NO" checked=""/>Não

        </div>
        <div style="width: auto;">
            <br>


            <input class="Buttons" type="submit" name="cadastrarVisita" value="Cadastrar Visita"  style="width: 100%; height: 50"/>
        </div>
    </form>
</div>
