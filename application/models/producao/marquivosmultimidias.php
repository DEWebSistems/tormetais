<?php
    class MArquivosMultimidias extends CI_Model
    {
        public $id;
        public $nomeOriginal;
        public $localizacao;
        public $extensao;
        public $tipoArquivo;
        
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

        public function getNomeOriginal() {
            return $this->nomeOriginal;
        }

        public function setNomeOriginal($nomeOriginal) {
            $this->nomeOriginal = $nomeOriginal;
        }

        public function getLocalizacao() {
            return $this->localizacao;
        }

        public function setLocalizacao($localizacao) {
            $this->localizacao = $localizacao;
        }

        public function getExtensao() {
            return $this->extensao;
        }

        public function setExtensao($extensao) {
            $this->extensao = $extensao;
        }

        public function getTipoArquivo() {
            return $this->tipoArquivo;
        }

        public function setTipoArquivo($tipoArquivo) {
            $this->tipoArquivo = $tipoArquivo;
        }
    }
?>