<?php

    // importa o arquivo de inicialização do EntityManager do Doctrine
    include '../bootstrap.php';

    // Importa a classe Pessoa
    use Entities\Pessoa;

    if(isset($_POST['submit'])) {

        // Obtém os valores dos campos do formulário de criação de pessoa
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];

        // Cria uma nova instância da classe Pessoa
        $pessoa = new Pessoa();

        // Define os valores dos atributos da pessoa
        $pessoa -> setNome($nome);
        $pessoa -> setCpf($cpf);

        // Adiciona a pessoa ao gerenciador de entidades para persistência no banco de dados
        $entityManager -> persist($pessoa);
        $entityManager -> flush();
           
        // Redireciona para a página de listagem de pessoas
        header('Location: showPessoa.php');
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  rel="stylesheet" type="text/css" href="../css/createPessoaCss.css">
    <title>Create | Pessoa</title>
</head>
<body>

    <a href="showPessoa.php">Listar Pessoas</a>

    <div class="box">
        <form action="createPessoa.php" method="post">
            <h2>Create | Pessoa</h2>

            <!-- campos do formulário -->
            <label for="nome">Nome</label>
            <br />
            <input type="text" name="nome" id="nome" maxlength="255" required>
            <br />      
            <label for="cpf">CPF</label>
            <br />
            <input type="text" name="cpf" id="cpf" minlength="14" maxlength="14" required>     
            <br />
            <input type="submit" name="submit" id="submit" value="Gerar pessoa">
        </form>
    </div><!-- box -->
</body>
</html>

<script>
    // Função para aplicar a máscara de CPF
    function mascaraCPF() {
        var cpf = document.getElementById("cpf");
        if (cpf.value.length == 3 || cpf.value.length == 7) {
            cpf.value += ".";
        } else if (cpf.value.length == 11) {
            cpf.value += "-";
        }
    }

     // Adiciona o evento no campo de CPF
    document.getElementById("cpf").addEventListener("keyup", mascaraCPF);
</script>