<?php
    /**
    *Documentação
    *@name DadosEmpresa
    *@package models
    *@subpackage producao
    *@author Everaldo
    **/
    class MServicos extends CI_Model
    {
        public $id;
        public $nome;
        public $descricao;
        public $categoriaServicoId;    
        public $principal;
                

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

        public function getCategoriaServicoId()
        {
            return $this->categoriaServicoId;
        }

        public function setCategoriaServicoId($categoriaServicoId)
        {
            $this->categoriaServicoId = $categoriaServicoId;
        }    
        
        public function getPrincipal()
        {
            return $this->principal;
        }

        public function setPrincipal($principal)
        {
            $this->principal = $principal;
        }     
    }
?>