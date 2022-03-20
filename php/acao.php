<!DOCTYPE html>
<?php
    $comando = "";
    if(isset($_POST['comando'])){$comando = $_POST['comando'];}else if(isset($_GET['comando'])){$comando = $_GET['comando'];}
    $tabela = "";
    if(isset($_POST['tabela'])){$tabela = $_POST['tabela'];}else if(isset($_GET['tabela'])){$tabela = $_GET['tabela'];}
    $title = "";
?>
<html>
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    <style>
       body {
            right: 200px;
       } 
    </style>
</head>
<body class="">
<?php
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    acao($comando, $tabela);


    function acao($acao, $tabela){
        if($acao == "insert"){inserir($tabela);}
        else if($acao == "deletar"){deletar($tabela);}
        else if($acao == "update"){atualizar($tabela);}
    }


    function inserir($tabela){
    $pdo = Conexao::getInstance();
    if($tabela == 'cidade'){
        $dados = dados();
        $cidadenome = $dados["CidadeNome"];
        $estadoid = $dados["EstadoID"];
        $stmt = $pdo->prepare("INSERT INTO `auladia15`.`cidade` (`CidadeNome`, `EstadoID`) VALUES ('$cidadenome', '$estadoid');");
        $stmt->execute();
        header('location:tabelacidade.php');
    } else if ($tabela == 'estado'){

    }
    }


    function deletar($tabela){
    $id = $_GET['id'];
    $pdo = Conexao::getInstance();
    if($tabela == 'cidade'){
        $stmt = $pdo->query("DELETE FROM `auladia15`.`cidade` WHERE CidadeID = $id");
        $stmt->execute();
        header('location:tabelacidade.php');
    }
    }


    function atualizar($tabela){
    if(isset($_POST['id'])){$id = $_POST['id'];}
        $pdo = Conexao::getInstance();
    if($tabela == 'cidade'){
        $dados = dados();
        $cidadenome = $dados['CidadeID'];
        $estadoid = $dados['EstadoID'];
        $stmt = $pdo->query("UPDATE `auladia15`.`cidade` SET `CidadeID` = '$cidadenome', `EstadoID` = '$estadoid' WHERE (`CidadeID` = '$id');");
        $stmt->execute();
        header('location:tabelacidade.php');
    } else if($tabela == 'estado'){

    }
    }


    function dados(){
        $dados = array();
        $dados['CidadeID'] = $_POST["CidadeID"];
        $dados['CidadeNome'] = $_POST["CidadeNome"];
        $dados['EstadoID'] = $_POST["EstadoID"];
        $dados['EstadoNome'] = $_POST["EstadoNome"];
        $dados['EstadoSigla'] = $_POST["EstadoSigla"];
        return $dados;
    }


    function buscarDados($id,$tabela){
        $pdo = Conexao::getInstance();
        $dados = array();
    if($tabela == 'cidade'){
        $consulta = $pdo->query("SELECT * FROM cidade, estado WHERE CidadeID = $id");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['CidadeNome'] = $linha['CidadeNome'];
            $dados['EstadoID'] = $linha['EstadoID'];
        }
    } else if($tabela == 'estado'){

    }
        return $dados;
    }
?>
</body>
</html>