<?php
    class MAnunciosAM extends CI_Model
    {
        public $anuncioId;
        public $arquivoMultimidiaId;
        public $arquivoPrincipal;
        
        function __construct()
        {
            parent::__construct();
        }
        
        public function getAnuncioId() {
            return $this->anuncioId;
        }

        public function setAnuncioId($anuncioId) {
            $this->anuncioId = $anuncioId;
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