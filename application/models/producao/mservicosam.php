<?php
    class MServicosAM extends CI_Model
    {
        public $servicoId;
        public $arquivoMultimidiaId;
        public $arquivoPrincipal;
        
        function __construct()
        {
            parent::__construct();
        }
        
        public function getServicoId() {
            return $this->servicoId;
        }

        public function setServicoId($servicoId) {
            $this->servicoId = $servicoId;
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