<?php
    class DadosEmpresa extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
        }
        
        public function index()
        {
            $dadosPost = $this->input->post();
            $messages = array();
            $messages['isErrors'] = false;
            $messages['messagesErrors'] = '';
            $messages['isSuccess'] = false;
            $messages['messagesSuccess'] = '';
            if(isset($dadosPost['bsGravar']))
            {
                //echo '<pre>';
                //print_r($dadosPost);
                //echo '</pre>';
                $returns = $this->gravar($dadosPost);
                if($returns == false)
                {
                    $messages['isErrors'] = true;
                    $messages['messagesErrors'] = 'Occoreu um erro com o banco de dados. Não foi possível gravar os dados da empresa.';
                }
                else
                {
                    $messages['isSuccess'] = true;
                    $messages['messagesSuccess'] = 'Os dados da empresa foram salvos com sucesso';
                }
            }
            $datasBody = array();
            $datasBody['messages'] = $messages;
            $datasBody['estados'] = $this->getEstados();
            $this->load->model('daos/DAODadosEmpresa');
            $this->load->model('producao/MDadosEmpresa');
            $datasBody['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $datasBody);
            $this->load->view('privado/producao/dadosempresa', $datasBody);
            $this->load->view('fragmentos/rodape', $datasBody);
        }
        
        private function gravar($dadosPost)
        {
            $this->load->model('producao/MDadosEmpresa');
            $this->MDadosEmpresa->setId(1);
            $this->MDadosEmpresa->setNomeFantasia($dadosPost['itNomeFantasia']);
            $this->MDadosEmpresa->setRazaoSocial($dadosPost['itRazaoSocial']);
            $this->MDadosEmpresa->setCNPJ($dadosPost['itCNPJ']);
            $this->MDadosEmpresa->setIE($dadosPost['itIE']);
            $this->MDadosEmpresa->setEstado($dadosPost['seEstado']);
            $this->MDadosEmpresa->setCidade($dadosPost['itCidade']);
            $this->MDadosEmpresa->setBairro($dadosPost['itBairro']);
            $this->MDadosEmpresa->setEndereco($dadosPost['itEndereco']);
            $this->MDadosEmpresa->setNumero($dadosPost['itNumero']);
            $this->MDadosEmpresa->setComplemento($dadosPost['itComplemento']);
            $this->MDadosEmpresa->setTelefonePrincipal($dadosPost['itTelefonePrincipal']);
            $this->MDadosEmpresa->setTelefoneSecundario($dadosPost['itTelefoneSecundario']);
            $this->MDadosEmpresa->setEmailPrincipal($dadosPost['iemEMailPrincipal']);
            $this->MDadosEmpresa->setEmailSecundario($dadosPost['iemEMailSecundario']);
            $this->MDadosEmpresa->setLinkLocalizacaoGoogleMaps($dadosPost['iurlLinkLocalizacaoGoogleMaps']);
            $this->MDadosEmpresa->setDescricaoEmpresa($dadosPost['taDescricaoEmpresa']);
            $this->load->model('daos/DAODadosEmpresa');
            if($this->DAODadosEmpresa->existsRegisterIdOne() == false)
            {
                $returns = $this->DAODadosEmpresa->inserir($this->MDadosEmpresa);
            }
            else if($this->DAODadosEmpresa->existsRegisterIdOne() == true)
            {
                $returns = $this->DAODadosEmpresa->alterar($this->MDadosEmpresa);
            }
            return $returns;
        }
        
        private function getEstados()
        {
            $estados = array(
                'AC' => 'Acre',
                'AL' => 'Alagoas',
                'AP' => 'Amapá',
                'AM' => 'Amazonas',
                'BA' => 'Bahia',
                'CE' => 'Ceará',
                'DF' => 'Distrito Federal',
                'ES' => 'Espírito Santo',
                'GO' => 'Goiás',
                'MA' => 'Maranhão',
                'MT' => 'Mato Grosso',
                'MS' => 'Mato Grosso do Sul',
                'MG' => 'Minas Gerais',
                'PA' => 'Pará',
                'PB' => 'Paraíba',
                'PR' => 'Paraná',
                'PE' => 'Pernambuco',
                'PI' => 'Piauí',
                'RJ' => 'Rio de Janeiro',
                'RN' => 'Rio Grande do Norte ',
                'RS' => 'Rio Grande do Sul',
                'RO' => 'Rondônia',
                'RR' => 'Roraima',
                'SC' => 'Santa Catarina',
                'SP' => 'São Paulo',
                'SE' => 'Sergipe',
                'TO' => 'Tocantins'
            );
            return $estados;
        }
    }
?>