<?php

    // importa o arquivo de inicialização do EntityManager do Doctrine
    include '../bootstrap.php';

    // Importa a classe Contato
    use Entities\Contato;

    // Obtém os valores passados por parâmentro da página lista Contato
    $id = $_GET['id'];
    $idPessoa = $_GET['idPessoa'];

     // Recupera a pessoa pelo ID
    $pessoa = $entityManager->getRepository('Entities\Pessoa');
    $pessoa = $pessoa->find($idPessoa);

    // Recupera o contato pelo ID
    $contato = $entityManager -> getRepository('Entities\Contato');
    $contato = $contato -> find($id);

    if (isset($_POST['submit'])) {

        // obtém os valores dos campos do formulário
        $tipo = $_POST['tipo'];
        $descricao = $_POST['descricao'];

        // define os valores dos atributos do contato
        $contato -> setTipo($tipo);
        $contato -> setDescricao($descricao);

        // persiste o contato no banco de dados
        $entityManager -> flush();

         // redireciona para a página de listagem de pessoas passando o parâmetro do ID
        header("Location: showContato.php?idPessoa=" . $pessoa -> getId() . "");

        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  rel="stylesheet" type="text/css" href="../css/updateContatoCss.css">
    <title>Update | Contato </title>
</head>
<body>

    <?php 
        // Botão de Voltar
        echo "<a href=\"showContato.php?idPessoa=" . $pessoa->getId() . "\">Voltar</a>"; 
    ?>


    <div class="box">
    <form method="post">
        <h2>Update | Contato</h2>

        <!-- campos do formulário -->
        <label for="tipo">Tipo</label>
        <br />
        <select name="tipo" id="tipo" required>
            <option value="" disabled selected>Selecione...</option>
            <option value="0" <?php if ($contato -> getTipo() == 0) echo "selected"; ?>>Telefone</option>
            <option value="1" <?php if ($contato -> getTipo() == 1) echo "selected"; ?>>E-mail</option>
        </select>
        <br />      
        <label for="descricao">Descrição</label>
        <br />
        <input type="text" name="descricao" id="descricao" value="<?php echo $contato -> getDescricao() ?>" required>     
        <br />
        <br />
        <input type="submit" name="submit" id="submit" value="Update Contato">
    </form>
    </div>
</body>
</html>