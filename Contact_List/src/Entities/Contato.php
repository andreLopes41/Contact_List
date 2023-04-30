<?php

namespace Entities;

use \Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity @ORM\Table(name="contato")
 **/

class Contato{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     **/
    private $id;

    /**
     * @ORM\Column(type="boolean")
     **/
    private $tipo;

    /**
     * @ORM\Column(type="string")
     **/
    private $descricao;

    /**
     * @ORM\ManyToOne(targetEntity="Pessoa")
     * @ORM\JoinColumn(name="idPessoa", referencedColumnName="id")
     **/
    private $pessoa;

     // Getters and setters da classe CONTATO

    public function setId($id){
        $this -> id = $id;

        return $this;
    }

    public function getId(){
        return $this -> id;
    }

    public function setTipo($tipo){
        $this -> tipo = $tipo;

        return $this;
    }

    public function getTipo(){
        return $this -> tipo;
    }

    public function setDescricao($descricao){
        $this -> descricao = $descricao;

        return $this;
    }

    public function getDescricao(){
        return $this -> descricao;
    }

    public function setPessoa($pessoa){
        $this -> pessoa = $pessoa;

        return $this;
    }

    public function getPessoa(){
        return $this -> pessoa;
    }

}