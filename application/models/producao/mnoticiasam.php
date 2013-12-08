<?php
    class MNoticiasAM extends CI_Model
    {
        public $noticiaId;
        public $arquivoMultimidiaId;
        public $arquivoPrincipal;
        
        function __construct()
        {
            parent::__construct();
        }
        
        public function getNoticiaId() {
            return $this->noticiaId;
        }

        public function setNoticiaId($noticiaId) {
            $this->noticiaId = $noticiaId;
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