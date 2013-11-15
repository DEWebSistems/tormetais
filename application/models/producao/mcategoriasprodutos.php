<?php
    /**
    *Documentação
    *@name MCategoriasProdutos
    *@package models
    *@subpackage producao
    *@author DanielRL
    **/
    class MCategoriasProdutos extends CI_Model
    {
        public $id;
        public $nome;
        
        function __construct()
        {
            parent::__construct();
        }
        
        public function getId()
        {
            return $this->id;
        }
        
        public function setId($id)
        {
            $this->id = $id;
        }
        
        public function getNome()
        {
            return $this->nome;
        }
        
        public function setNome($nome)
        {
            $this->nome = $nome;
        }
    }
?>