<?php

    // importa o arquivo de inicialização do EntityManager do Doctrine
    include '../bootstrap.php';

    // Importa a classe Pessoa
    use Entities\Pessoa;

     // Obtém o valor passado por parâmentro da página lista Pessoa
    $id = $_GET['id'];

    // Verifica se o ID foi informado
    if (isset($_GET['id'])) {

        // Recupera a pessoa pelo ID
        $pessoa = $entityManager -> getRepository('Entities\Pessoa');
        $pessoa = $pessoa -> find($id);

        // Verifica cada contato da pessoa e remove um por um  
        foreach ($pessoa -> getContato() as $contato) {
            $entityManager -> remove($contato);
        }
        
        // Remove a pessoa
        $entityManager -> remove($pessoa);
        $entityManager -> flush();
    }

    // Redireciona para a página de listagem de pessoas
    header('Location: showPessoa.php');

?>
