<?php

    // importa o arquivo de inicialização do EntityManager do Doctrine
    include '../bootstrap.php';

    // Importa a classe pessoa
    use Entities\Pessoa;

    // Obtém os valores passados por parâmentro da página lista pessoa
    $id = $_GET['id'];

     // Recupera a pessoa pelo ID
    $pessoa = $entityManager -> getRepository('Entities\Pessoa');
    $pessoa = $pessoa -> find($id);

    if (isset($_POST['submit'])) {

        // obtém os valores dos campos do formulário
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];

        // define os valores dos atributos da pessoa
        $pessoa -> setNome($nome);
        $pessoa -> setCpf($cpf);

        // persiste o contato no banco de dados
        $entityManager -> flush();

        // redireciona para a página de listagem de pessoas passando o parâmetro do ID
        header('Location: showPessoa.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  rel="stylesheet" type="text/css" href="../css/updatePessoaCss.css">
    <title>Update | Pessoa</title>
</head>
<body>

 <!-- Botão de Voltar -->
<a href="showPessoa.php">Voltar</a>

<div class="box">

    <form method="post">
        <h2>Update | Pessoa</h2>
        <!-- campos do formulário -->
        <input type="hidden" name="id" value="<?php echo $pessoa -> getId() ?>">
        <label for="nome">Nome</label>
        <br />
        <input type="text" name="nome" id="nome" maxlength="255" value="<?php echo $pessoa -> getNome() ?>" required>
        <br />      
        <label for="cpf">CPF</label>
        <br />
        <input type="text" name="cpf" id="cpf" minlength="14" maxlength="14" value="<?php echo $pessoa -> getCpf() ?>" required>     
        <br />
        <input type="submit" name="submit" id="submit" value="Update pessoa">
    </form>

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