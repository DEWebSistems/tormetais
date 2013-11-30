<?php
    class MProdutosAM extends CI_Model
    {
        public $produtoId;
        public $arquivoMultimidiaId;
        public $arquivoPrincipal;
        
        function __construct()
        {
            parent::__construct();
        }
        
        public function getProdutoId() {
            return $this->produtoId;
        }

        public function setProdutoId($produtoId) {
            $this->produtoId = $produtoId;
        }

        public function getArquivoMultimidiaId() {
            return $this->arquivoMultimidiaId;
        }

        public function setArquivoMultimidiaId($arquivoMultimidiaId) {
            $this->arquivoMultimidiaId = $arquivoMultimidiaId;
        }

        public function getArquivoPrincipal() {
            return $this->arquivoPrincipal;
        }

        public function setArquivoPrincipal($arquivoPrincipal) {
            $this->arquivoPrincipal = $arquivoPrincipal;
        }
    }
?>