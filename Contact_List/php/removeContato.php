<?php

    // importa o arquivo de inicialização do EntityManager do Doctrine
    include '../bootstrap.php';

     // Importa a classe Contato
    use Entities\Contato;

    // Obtém os valores passados por parâmentro da página lista Contato
    $id = $_GET['id'];
    $idPessoa = $_GET['idPessoa'];

    // Verifica se o ID foi informado
    if (isset($_GET['id'])) {

         // Recupera a pessoa pelo ID
        $pessoa = $entityManager->getRepository('Entities\Pessoa');
        $pessoa = $pessoa->find($idPessoa);
        
        // Recupera o contato pelo ID
        $contato = $entityManager -> getRepository('Entities\Contato');
        $contato = $contato -> find($id);
        
         // Remove o contato
        $entityManager -> remove($contato);
        $entityManager -> flush();
    }

     // Redireciona para a página de listagem de contatos
    header("Location: showContato.php?idPessoa=" . $pessoa -> getId() . "");

?>