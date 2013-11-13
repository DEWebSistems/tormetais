<?php
    /**
    *Documentação
    *@name Mensagem Contato
    *@package models
    *@subpackage producao
    *@author Everaldo Boccoli
    **/

    class MMensagemContato extends CI_Model
    {
        public $id;
        public $nome;
        public $telefone;
        public $fromEmail;
        public $toEmail;
        public $assunto;
        public $mensagem;
        public $ipOrigem;
        public $macAddressOrigem;
        public $dataHoraMensagem;
        
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
        
        public function getTelefone()
        {
            return $this->telefone;
        }

        public function setTelefone($telefone)
        {
            $this->telefone = $telefone;
        }
        
        public function getFromEmail()
        {
            return $this->fromEmail;
        }
        
        public function setFromEmail($fromEmail)
        {
            $this->fromEmail = $fromEmail;
        }

        public function getToEmail()
        {
            return $this->toEmail;
        }
        
        public function setToEmail($toEmail)
        {
            $this->toEmail = $toEmail;
        }

        public function getAssunto()
        {
            return $this->assunto;
        }
        
        public function setAssunto($assunto)
        {
            $this->assunto = $assunto;
        }
        
        public function getMensagem() 
        {
            return $this->mensagem;
        }
        
        public function setMensagem($mensagem)
        {
            $this->mensagem = $mensagem;
        }
        
        public function getIpOrigem()
        {
            return $this->ipOrigem;
        }

        public function setIpOrigem($ipOrigem) 
        {    
            $this->ipOrigem = $ipOrigem;
        }

        public function getDataHoraMensagem() 
        {
            return $this->dataHoraMensagem;
        }        

        public function setDataHoraMensagem($dataHoraMensagem) 
        {
            $this->dataHoraMensagem = $dataHoraMensagem;
        }
        
        public function getMacAddressOrigem() {
            return $this->macAddressOrigem;
        }

        public function setMacAddressOrigem($macAddressOrigem) {
            $this->macAddressOrigem = $macAddressOrigem;
        }
    }
?>
