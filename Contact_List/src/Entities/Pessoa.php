<?php

namespace Entities;

use \Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity @ORM\Table(name="pessoa")
 **/

class Pessoa{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     **/
    private $id;

    /**
     * @ORM\Column(type="string")
     **/
    private $nome;

    /**
     * @ORM\Column(type="string")
     **/
    private $cpf;

    /**
     * @ORM\OneToMany(targetEntity="Entities\Contato", mappedBy="pessoa", cascade={"persist"})
     **/
    private $contato;


    // Getters and setters da classe PESSOA

    public function setId($id){
        $this -> id = $id;

        return $this;
    }

    public function getId(){
        return $this -> id;
    }

    public function setNome($nome){
        $this -> nome = $nome;

        return $this;
    }

    public function getNome(){
        return $this -> nome;
    }

    public function setCpf($cpf){
        $this -> cpf = $cpf;

        return $this;
    }

    public function getCpf(){
        return $this -> cpf;
    }

    public function setContato($contato){
        $this -> contato = $contato;

        return $this;
    }

    public function getContato(){
        return $this -> contato;
    }

}