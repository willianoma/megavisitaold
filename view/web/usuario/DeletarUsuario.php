<?php
$usuario = $_REQUEST['usuario'];

$id = $usuario->getId();
$nome = $usuario->getNome();
$senha = $usuario->getSenha();
$email = $usuario->getEmail();
$cpf = $usuario->getCpf();
$funcao = $usuario->getFuncao();
$permicao = $usuario->getPermicao();
?>
<form name='form1' method="post" action="?controller=Usuario&acao=deletarUsuario">
    <label for="id">id:</label>
    <input type="text" name="idUsuario" required  readonly="readonly" value='<?php echo $id; ?>'>
    <br>
    <label for="nome">Nome:</label>
    <input type="text" name="nomeUsuario" required  readonly="readonly" value='<?php echo $nome; ?>'>
    <br>
    <label for="senha">Senha:</label>
    <input type="text" name="senhaUsuario" required  readonly="readonly" value='<?php echo $senha; ?>'>
    <br>
    <label for="cpf">CPF:</label>
    <input type="text" name="cpfUsuario" required  readonly="readonly" value='<?php echo $cpf; ?>'>
    <br>
    <label for="email">E-Mail:</label>
    <input type="text" name="emailUsuario" required  readonly="readonly" value='<?php echo $email; ?>'>
    <br>
    <label for="funcao">Função:</label>
    <input type="text" name="funcaoUsuario" required  readonly="readonly" value='<?php echo $funcao; ?>'>
    <br>
    <label for="permicao">Permição:</label>
    <input type="text" name="permicaoUsuario" required  readonly="readonly" value='<?php echo $permicao; ?>'>
    <br>
    <input type="hidden" name="id" value='<?php echo $id; ?>'>
    <br>
    <input type="submit" value="Deletar" name="Deletar">
</form>
