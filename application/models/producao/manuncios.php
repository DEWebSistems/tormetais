<?php
    /**    
    *@name Anuncios
    *@package models
    *@subpackage producao
    *@author Everaldo
    **/
    class MAnuncios extends CI_Model
    {
        public $id;
        public $nome;
        public $descricao;
        public $linkProdutoServico;
     

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

        public function getLinkProdutoServico()
        {
            return $this->linkProdutoServico;
        }

        public function setLinkProdutoServico($linkProdutoServico)
        {
            $this->linkProdutoServico = $linkProdutoServico;
        }      
    }
?>