<?php

    // importa o arquivo de inicialização do EntityManager do Doctrine
    include '../bootstrap.php';

    // Importa a classe Contato
    use Entities\Contato;

    // Obtém o ID da pessoa selecionada na página anterior
    $idPessoa = $_GET['idPessoa'];

    // Obtém o objeto da pessoa a partir do ID
    $pessoa = $entityManager->getRepository('Entities\Pessoa');
    $pessoa = $pessoa->find($idPessoa);

    // Obtém todos os contatos associados à pessoa
    $contatos = $entityManager->getRepository('Entities\Contato');
    $contatos = $contatos->findBy(['pessoa' => $pessoa]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  rel="stylesheet" type="text/css" href="../css/showContatoCss.css">
    <title>Lista | Contato</title>
</head>
<body>

    <!-- Botão de Voltar -->
    <a class="voltar" href="showPessoa.php">Voltar</a>
    <br />
    <br />

    <!-- Tabela para exibir os contatos -->
    <table>
        <thead>
            <tr>
                <th>#ID</th>
                <th>Tipo</th>
                <th>Descrição</th>
                <th>Pessoa</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>

        <?php 
        
            // Loop para exibir cada contato
            foreach ($contatos as $contato) { 
                echo "<tr>";
                echo "<td>" . $contato -> getId() . "</td>";
                echo "<td>" . ($contato -> getTipo() == 0 ? "Telefone" : "Email") . "</td>";
                echo "<td>" . $contato -> getDescricao() . "</td>";
                echo "<td>" . $contato -> getPessoa() -> getNome() . "</td>";
                echo "<td>
                    <a href='updateContato.php?id=" . $contato -> getId()  . "&idPessoa=" . $pessoa -> getId() . "'>Update</a>
                    <a href='removeContato.php?id=" . $contato -> getId()  . "&idPessoa=" . $pessoa -> getId() . "'>Remove</a>
                </td>";
                echo  "</tr>";
         } 
     ?>

        </tbody>
    </table>
</body>
</html>