<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ListaProduto</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Lista de Produtos</h1>
        <a href="produto.php"> <em> Voltar para o cadastro </em> </a> </br> </br>

        <form method="post" action="listaProduto.php">
            <input type="text" id="busca" name="busca"/>
            <button name="bt1">Ok</button> <br> <br>
        </form>
        <table border="1">
            <tr><td>Codigo</td><td>Titulo</td><td>Descritivo</td><td>Valor</td><td>Qtd</td><td>Categoria</td><td></td></tr>
            <?php listar(); ?>
        <table>
    </body>
</html>

<?php
    function listar(){
        $con = new mysqli("localhost","root","12345678","pw09");
        if(isset($_POST["bt1"])){
            $busca = $_POST["busca"];
            $sql = "select * from produto where titulo
                like '%$busca%' order by titulo";
        } else {
            $sql = "select * from produto order by titulo";
        }
        $retorno = mysqli_query($con, $sql);
        while($reg = mysqli_fetch_array($retorno)){
            echo "<tr><td>". $reg['codigo'] ."</td>";
            echo "<td>". $reg['titulo'] ."</td>";
            echo "<td>". $reg['descritivo'] ."</td>";
            echo "<td>". $reg['valor'] ."</td>";
            echo "<td>". $reg['qtd'] ."</td>";
            echo "<td>". $reg['categoria'] ."</td>";
            echo "<td><a href='produto.php?codigo=".
            $reg['codigo'] ."'>Editar</a></td></tr>";
        }
        mysqli_close($con);
    }

?>