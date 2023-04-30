<?php

    // importa o arquivo de inicialização do EntityManager do Doctrine
    include '../bootstrap.php';

    // Importa a classe Pessoa
    use Entities\Pessoa;

    // Verifica se houve algum parâmentro passado pelo search
    $searchTerm = isset($_POST['search']) ? $_POST['search'] : '';

    // Faz a consulta na classe pessoa e busca as correspondências
    $pessoas = $entityManager->getRepository('Entities\Pessoa')->createQueryBuilder('p')
        ->where('p.nome LIKE :search')
        ->setParameter('search', "%{$searchTerm}%")
        ->getQuery()
        ->getResult();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  rel="stylesheet" type="text/css" href="../css/showPessoaCss.css">
    <title>Lista | Pessoa</title>
</head>
<body>

    <!-- Botão de Voltar -->
    <a class="voltar" href="createPessoa.php">Voltar</a>
    <br />
    <br />

    <form method="post">
        <input type="text" name="search" placeholder="P e s q u i s a r . . ." value="<?php echo $searchTerm; ?>">
        <button type="submit">Pesquisar</button>
    </form>
    <br />

    <!-- Tabela para exibir as pessoas -->
    <table>
        <thead>
            <tr>
                <th>#ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Opções</th>
                <th>Contatos</th>
            </tr>
        </thead>
        <tbody>

        <?php 

            // Loop para exibir cada pessoa
            foreach ($pessoas as $pessoa) { 
                echo "<tr>";
                echo "<td>" . $pessoa -> getId() . "</td>";
                echo "<td>" . $pessoa -> getNome() . "</td>";
                echo "<td>" . $pessoa -> getCpf() . "</td>";
                echo "<td>
                    <a href='updatePessoa.php?id=" . $pessoa -> getId() . "'>Update</a>
                    <a href='removePessoa.php?id=" . $pessoa -> getId() . "'>Remove</a>
                </td>";
                echo "<td>
                <a href='createContato.php?idPessoa=" . $pessoa -> getId() ."&nome=" . $pessoa -> getNome() . "'>New Contact</a>
                    <a href='showContato.php?idPessoa=" . $pessoa -> getId() . "'>List Contacts</a>
                </td>";
                echo  "</tr>";
         } 
     ?>

        </tbody>
    </table>
</body>
</html>
