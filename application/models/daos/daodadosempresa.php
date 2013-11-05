<?php
    class DAODadosEmpresa extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->load->model('producao/MDadosEmpresa');
        }
        
        public function getDadosEmpresa()
        {
            $results = $this->db->get_where('dadosempresa', array('id' => 1), 1);
            $returns = array();
            if($results->num_rows() > 0)
            {
                $results = $results->result_array();
                $results = $results[0];
                foreach($results as $key => $value)
                {
                    $returns[$key] = $value;
                }
                return $returns;
            }
        }
        
        public function existsRegisterIdOne()
        {
            $results = $this->db->get_where('dadosempresa', array('id' => 1), 1);
            if($results->num_rows() == 0)
            {
                return false;
            }
            else if($results->num_rows() > 0)
            {
                return true;
            }
        }
        
        public function inserir($mDadosEmpresa)
        {
            $this->MDadosEmpresa = $mDadosEmpresa;
            $dados = array(
                'nomefantasia' => $this->MDadosEmpresa->getNomeFantasia(),
                'razaosocial' => $this->MDadosEmpresa->getRazaoSocial(),
                'cnpj' => $this->MDadosEmpresa->getCNPJ(),
                'ie' => $this->MDadosEmpresa->getIE(),
                'estado' => $this->MDadosEmpresa->getEstado(),
                'cidade' => $this->MDadosEmpresa->getCidade(),
                'bairro' => $this->MDadosEmpresa->getBairro(),
                'endereco' => $this->MDadosEmpresa->getEndereco(),
                'numero' => $this->MDadosEmpresa->getNumero(),
                'complemento' => $this->MDadosEmpresa->getComplemento(),
                'telefoneprincipal' => $this->MDadosEmpresa->getTelefonePrincipal(),
                'telefonesecundario' => $this->MDadosEmpresa->getTelefoneSecundario(),
                'emailprincipal' => $this->MDadosEmpresa->getEMailPrincipal(),
                'emailsecundario' => $this->MDadosEmpresa->getEMailSecundario()
            );
            $this->db->trans_start();
            $this->db->insert('dadosempresa', $this->MDadosEmpresa);
            $this->db->trans_complete();
        }
        
        public function alterar($mDadosEmpresa)
        {
            $this->MDadosEmpresa = $mDadosEmpresa;
            $this->db->trans_start();
            $this->db->update('dadosempresa', $this->MDadosEmpresa, 'id = ' . $this->MDadosEmpresa->getId());
            $this->db->trans_complete();
        }
    }
?>