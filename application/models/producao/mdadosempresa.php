<?php
    /**
    *Documentação
    *@name DadosEmpresa
    *@package models
    *@subpackage producao
    *@author DanielRL
    **/
    class MDadosEmpresa extends CI_Model
    {
        public $id;
        public $nomeFantasia;
        public $razaoSocial;
        public $cnpj;
        public $ie;
        public $estado;
        public $cidade;
        public $bairro;
        public $endereco;
        public $numero;
        public $complemento;
        public $telefonePrincipal;
        public $telefoneSecundario;
        public $emailPrincipal;
        public $emailSecundario;
        public $linkLocalizacaoGoogleMaps;
        public $descricaoEmpresa;

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

        public function getNomeFantasia()
        {
            return $this->nomeFantasia;
        }

        public function setNomeFantasia($nomeFantasia)
        {
            $this->nomeFantasia = $nomeFantasia;
        }

        public function getRazaoSocial()
        {
            return $this->razaoSocial;
        }

        public function setRazaoSocial($razaoSocial)
        {
            $this->razaoSocial = $razaoSocial;
        }

        public function getCnpj()
        {
            return $this->cnpj;
        }

        public function setCnpj($cnpj)
        {
            $this->cnpj = $cnpj;
        }

        public function getIe()
        {
            return $this->ie;
        }

        public function setIe($ie)
        {
            $this->ie = $ie;
        }

        public function getEstado()
        {
            return $this->estado;
        }

        public function setEstado($estado)
        {
            $this->estado = $estado;
        }

        public function getCidade()
        {
            return $this->cidade;
        }

        public function setCidade($cidade)
        {
            $this->cidade = $cidade;
        }

        public function getBairro()
        {
            return $this->bairro;
        }

        public function setBairro($bairro)
        {
            $this->bairro = $bairro;
        }

        public function getEndereco()
        {
            return $this->endereco;
        }

        public function setEndereco($endereco)
        {
            $this->endereco = $endereco;
        }

        public function getNumero()
        {
            return $this->numero;
        }

        public function setNumero($numero)
        {
            $this->numero = $numero;
        }

        public function getComplemento()
        {
            return $this->complemento;
        }

        public function setComplemento($complemento)
        {
            $this->complemento = $complemento;
        }

        public function getTelefonePrincipal()
        {
            return $this->telefonePrincipal;
        }

        public function setTelefonePrincipal($telefonePrincipal)
        {
            $this->telefonePrincipal = $telefonePrincipal;
        }

        public function getTelefoneSecundario()
        {
            return $this->telefoneSecundario;
        }

        public function setTelefoneSecundario($telefoneSecundario)
        {
            $this->telefoneSecundario = $telefoneSecundario;
        }

        public function getEmailPrincipal()
        {
            return $this->emailPrincipal;
        }

        public function setEmailPrincipal($emailPrincipal)
        {
            $this->emailPrincipal = $emailPrincipal;
        }

        public function getEmailSecundario()
        {
            return $this->emailSecundario;
        }

        public function setEmailSecundario($emailSecundario)
        {
            $this->emailSecundario = $emailSecundario;
        }

        public function getLinkLocalizacaoGoogleMaps()
        {
            return $this->linkLocalizacaoGoogleMaps;
        }

        public function setLinkLocalizacaoGoogleMaps($linkLocalizacaoGoogleMaps)
        {
            $this->linkLocalizacaoGoogleMaps = $linkLocalizacaoGoogleMaps;
        }

        public function getDescricaoEmpresa()
        {
            return $this->descricaoEmpresa;
        }

        public function setDescricaoEmpresa($descricaoEmpresa)
        {
            $this->descricaoEmpresa = $descricaoEmpresa;
        }
    }
?>