<?php

include_once 'model/BD.php';
include 'model/Usuario.php';

class UsuarioDao {

    protected $tabela_bd = "usuarios";

    public function listar() {
        $sql = "select * from $this->tabela_bd";
        $result = mysql_query($sql) or die(mysql_error());
        $lista = array();
        while ($dados = mysql_fetch_array($result)) {
            $usuarios = new Usuario($dados['id'], $dados['nome'], $dados['senha'], $dados['cpf'], $dados['email'], $dados['funcao']);
            $usuarios->setId($dados['id']);
            $lista[] = $usuarios;
        }
        return $lista;
    }

    function cadastrar($usuarios) {
        $sql = mysql_query("INSERT INTO $this->tabela_bd(nome,senha,cpf,email, funcao) VALUES('" . $usuarios->getNome() . "','" . $usuarios->getSenha() . "','" . $usuarios->getCpf() . "','" . $usuarios->getEmail() . "','" . $usuarios->getFuncao() . "')");
        if ($sql) {
            echo "Cadastrado com sucesso!!";
        } else {
            echo "Falha ao cadastrar." . mysql_error();
        }
        mysql_close();
    }

    function editar($usuarios) {

        $sql = "UPDATE $this->tabela_bd SET ";
        $sql .= "nome='" . $usuarios->getNome() . "',senha='" . $usuarios->getSenha() . "',cpf='" . $usuarios->getCpf() . "',email='" . $usuarios->getEmail() . "',funcao='" . $usuarios->getFuncao() . "' ";
        $sql .= "where id=" . $usuarios->getId();
        mysql_query($sql) or die($sql);
        echo 'Usuário editado com sucesso!';
    }

    function deletar($usuarios) {

        $sql = "delete from $this->tabela_bd where id =" . $usuarios->getId();
        mysql_query($sql) or die($sql);
        echo 'Usuário deletado com sucesso!';
    }

    public function getUsuario($id) {
        $sql = "select * from $this->tabela_bd where id = $id";
        $result = mysql_query($sql) or die("Erro: " . mysql_error());
        //echo mysql_num_rows($result);
        $objEmpresa = null;
        while ($item = mysql_fetch_array($result)) {
            $usuario = new Usuario($item['id'], $item['nome'], $item['senha'], $item['cpf'], $item['email'], $item['funcao']);
            $usuario->setId($item['id']);
        }
        return $usuario;
    }

}

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

