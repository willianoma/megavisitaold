<h1>Visitas</h1>
<!--<p><strong> <a href="?controller=Visita&acao=formCadastrarVisita">Cadastrar novo usuario</a>-->
</strong>
</p>





<table border=2 cellspacing=0 >
    <tr><td>id</td><td>Empresa</td><td>Hora Entrada</td><td>Hora Saída</td><td>Descrição</td><td>Pendencias</td><td>Corretiva</td><td>Usuário</td><td>Localização</td><td colspan="2">Ações</td></tr>
    <?php
    $listaVisitas = $_REQUEST['listaVisita'];

    foreach ($listaVisitas as $visita) {
        $id = $visita->getId();
        $empresa = $visita->getEmpresa();
        $horaDeInicio = $visita->getHoraDeInicio();
        $horaDeTermino = $visita->getHoraDeTermino();
        $descricao = $visita->getDescricao();
        $pendencias = $visita->getPendencias();
        $corretiva = $visita->getCorretiva();
        $usuario = $visita->getUsuario();
        $localization = $visita->getLocalization();





        echo "<tr>
            <td>$id</td>
            <td>$empresa</td>
            <td>$horaDeInicio</td>
            <td>$horaDeTermino</td>
            <td>$descricao</td>
            <td>$pendencias</td>
            <td>$corretiva</td>
            <td>$usuario</td>
            <td>$localization</td>
     
                
            <td>
		<form action='?controller=Visita&acao=verNoMapa' method='post'>
		<input type='hidden' value='$localization' name='localization'>
		<input type='hidden' value='$empresa' name='empresa'>
		<input type='hidden' value='$usuario' name='usuario'>
		<input type='submit' value='Ver no mapa'>	
		</form>
	    </td>
				
	 
             ";
    }
    ?>
</table>
