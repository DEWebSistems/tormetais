<?php
    /**
    *Documentação
    *@name DadosEmpresa
    *@package models
    *@subpackage producao
    *@author Everaldo
    **/
    class MNoticias extends CI_Model
    {
        public $id;
        public $nome;
        public $descricao;        
        public $dataPublicacao;
     

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
        
        public function getDataPublicacao() {
            return $this->dataPublicacao;
        }

        public function setDataPublicacao($dataPublicacao) {
            $this->dataPublicacao = $dataPublicacao;
        }
    }
?>