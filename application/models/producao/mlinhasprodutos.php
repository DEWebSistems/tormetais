<?php
    class MLinhasProdutos extends CI_Model
    {
        public $id;
        public $nome;
        public $descricao;
        public $imagem;
        public $produtoId;
        public $imagemLogo;
        
        function __construct()
        {
            parent::__construct();
        }
        
        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getNome() {
            return $this->nome;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function getDescricao() {
            return $this->descricao;
        }

        public function setDescricao($descricao) {
            $this->descricao = $descricao;
        }

        public function getImagem() {
            return $this->imagem;
        }

        public function setImagem($imagem) {
            $this->imagem = $imagem;
        }

        public function getProdutoId() {
            return $this->produtoId;
        }

        public function setProdutoId($produtoId) {
            $this->produtoId = $produtoId;
        }

        public function getImagemLogo() {
            return $this->imagemLogo;
        }

        public function setImagemLogo($imagemLogo) {
            $this->imagemLogo = $imagemLogo;
        }
    }
?>