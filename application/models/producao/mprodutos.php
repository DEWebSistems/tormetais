<?php
    /**
    *Documentação
    *@name DadosEmpresa
    *@package models
    *@subpackage producao
    *@author Everaldo
    **/
    class MProdutos extends CI_Model
    {
        public $id;
        public $nome;
        public $descricao;
        public $categoriaProdutoId;
        public $linhaProdutoId;
     

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

        public function getDescricao()
        {
            return $this->descricao;
        }

        public function setDescricao($descricao)
        {
            $this->descricao = $descricao;
        }

        public function getCategoriaProdutoId()
        {
            return $this->categoriaProdutoId;
        }

        public function setCategoriaProdutoId($categoriaProdutoId)
        {
            $this->categoriaProdutoId = $categoriaProdutoId;
        }
        
        public function getLinhaProdutoId() {
            return $this->linhaProdutoId;
        }

        public function setLinhaProdutoId($linhaProdutoId) {
            $this->linhaProdutoId = $linhaProdutoId;
        }
    }
?>