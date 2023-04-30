<?php

      // importa o arquivo de inicialização do EntityManager do Doctrine
    include '../bootstrap.php';

     // importa a classe Contato
    use Entities\Contato;

    if(isset($_POST['submit'])) {

          // obtém os valores dos campos do formulário
        $tipo = $_POST['tipo'];
        $descricao = $_POST['descricao'];
        $idPessoa = $_POST['pessoa'];

         // busca a pessoa correspondente ao ID informado
        $pessoa = $entityManager -> getRepository('Entities\Pessoa'); 
        $pessoa = $pessoa -> find($idPessoa);

        // cria uma nova instância da entidade Contato
        $contato = new Contato();

        // define os valores dos atributos do contato
        $contato -> setTipo($tipo);
        $contato -> setDescricao($descricao);
        $contato -> setPessoa($pessoa);

        // persiste o contato no banco de dados
        $entityManager -> persist($contato);
        $entityManager -> flush();

         // redireciona para a página de listagem de pessoas
        header('Location: showPessoa.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  rel="stylesheet" type="text/css" href="../css/createContatoCss.css">
    <title>Create | Contato </title>
</head>
<body>

    <a href="showPessoa.php">Voltar</a>

    <div class="box">
        <form action="createContato.php" method="post">
            <h2>Create | Contato</h2>

            <!-- campos do formulário -->
            <label for="tipo">Tipo</label>
            <br />
            <select name="tipo" id="tipo" required>
                <option value="" disabled selected>Selecione...</option>
                <option value="0">Telefone</option>
                <option value="1">E-mail</option>
            </select>
            <br />      
            <label for="descricao">Descrição</label>
            <br />
            <input type="text" name="descricao" id="descricao" required>     
            <br />
            <label for="pessoa">Pessoa</label>
            <br />
            <select name="pessoa">
                <?php
                    // adiciona a opção de seleção da pessoa
                    echo '<option value="' . $_GET['idPessoa'] . '">' . $_GET['nome'] . '</option>';
                ?>
            </select>
            <br />
            <br />
            <input type="submit" name="submit" id="submit" value="Gerar Contato">
        </form>
    </div><!-- box -->
</body>
</html>
