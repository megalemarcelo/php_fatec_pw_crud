<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title>Produto</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Produto</h1>
        <a href="listaProduto.php"> <em> Voltar para a lista </em> </a> </br> </br>

        <form method="post" action="produto.php">
            Codigo: <input type="number" id="codigo" name="codigo"/> </br>
            Titulo: <input type="text" id="titulo" name="titulo"/> </br>
            Descritivo: <input type="text" id="descritivo" name="descritivo"/> </br>
            Valor: <input type="number" id="valor" name="valor"/> </br>
            Qtd: <input type="number" id="qtd" name="qtd"/> </br>
            Categoria: <input type="text" id="categoria" name="categoria"/> </br> </br>

            <button name="bt1">Inserir</button>
            <button name="bt2">Pesquisar</button>
            <button name="bt3">Alterar</button>
            <button name="bt4">Remover</button>
        </form>

        <?php
            if(isset($_POST["bt1"])) inserir();
            if(isset($_POST["bt2"])) pesquisar($_POST["codigo"]);
            if(isset($_POST["bt3"])) alterar();
            if(isset($_POST["bt4"])) remover();
            if(isset($_GET["codigo"])) pesquisar($_GET["codigo"]);
        ?>

    </body>
</html>

<?php

function inserir(){
    $titulo     =   $_POST["titulo"];
    $descritivo =   $_POST["descritivo"];
    $valor      =   $_POST["valor"];
    $qtd        =   $_POST["qtd"];
    $categoria  =   $_POST["categoria"];
    $con        =   new mysqli("localhost","root","12345678", "pw09");
    $sql        = "INSERT INTO produto(titulo, descritivo, valor, qtd, categoria) VALUES ('$titulo', '$descritivo', '$valor', '$qtd', '$categoria')";
    
    mysqli_query($con, $sql);
    mysqli_close($con);
    echo "<h4>Registro inserido com sucesso</h4>";
}

function pesquisar($codigo){

    $con    = new mysqli("localhost","root","12345678", "pw09");
    $sql    = "SELECT * FROM produto WHERE codigo='$codigo'";
    $retorno= mysqli_query($con, $sql);

    if($reg = mysqli_fetch_array($retorno)) {
        echo "<script lang='javascript'>";
            echo "codigo.value='".          $reg["codigo"]      ."';";
            echo "titulo.value='".          $reg["titulo"]      ."';";
            echo "descritivo.value='".      $reg["descritivo"]  ."';";
            echo "valor.value='".           $reg["valor"]       ."';";
            echo "qtd.value='".             $reg["qtd"]         ."';";
            echo "categoria.value='".       $reg["categoria"]   ."';";
        echo "</script>";
    } else {
        echo "<h4>Registro não existe</h4>";
    }

    mysqli_close($con);
}

function alterar(){
    $codigo     =   $_POST["codigo"];
    $titulo     =   $_POST["titulo"];
    $descritivo =   $_POST["descritivo"];
    $valor      =   $_POST["valor"];
    $qtd        =   $_POST["qtd"];
    $categoria  =   $_POST["categoria"];
    $con        =   new mysqli("localhost","root","12345678", "pw09");
    $sql        =   "UPDATE produto SET titulo='$titulo', descritivo='$descritivo', valor='$valor', qtd='$qtd', categoria='$categoria' WHERE codigo='$codigo'";
    
    mysqli_query($con, $sql);
    mysqli_close($con);
}

function remover(){
    $codigo     =   $_POST["codigo"];
    $con        =   new mysqli("localhost","root","12345678", "pw09");
    $sql        =   "DELETE FROM produto WHERE codigo='$codigo'";
    
    mysqli_query($con, $sql);
    mysqli_close($con);
    echo "<h4>Registro removido com sucesso</h4>";
}

?>