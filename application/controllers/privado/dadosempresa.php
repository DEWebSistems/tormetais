<?php
    class DadosEmpresa extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->helper(array('form', 'url'));
            $this->load->model('producao/MDadosEmpresa');
            $this->load->model('daos/DAODadosEmpresa');
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
                else if($returns['messages'] != '')
                {
                    $messages['isErrors'] = true;
                    $messages['messagesErrors'] = $returns['messages'];
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
            //$this->load->model('daos/DAODadosEmpresa');
            //$this->load->model('producao/MDadosEmpresa');
            $datasBody['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $datasBody['dadosEmpresa']);
            $this->load->view('privado/producao/dadosempresa', $datasBody);
            $this->load->view('fragmentos/rodape', $datasBody);
        }
        
        private function gravar($dadosPost)
        {
            $dadosEmpresa = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->MDadosEmpresa->setId(1);
            $this->MDadosEmpresa->setNomeFantasia($dadosPost['itNomeFantasia']);
            $this->MDadosEmpresa->setRazaoSocial($dadosPost['itRazaoSocial']);
            $this->MDadosEmpresa->setCNPJ($dadosPost['itCNPJ']);
            $this->MDadosEmpresa->setIE($dadosPost['itIE']);
            $this->MDadosEmpresa->setCEP($dadosPost['itCEP']);
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
            $this->MDadosEmpresa->setDescricaoProdutos($dadosPost['taDescricaoProdutos']);
            $this->MDadosEmpresa->setDescricaoServicos($dadosPost['taDescricaoServicos']);
            if(($dadosPost['ihUpdateImage'] == 's') and ($_FILES['ifLogoSite']['name'] != ''))
            {
                $configsUploads['upload_path'] = "C:/xampp/htdocs/tormetais/assets/images/";
                $configsUploads['allowed_types'] = 'gif|jpg|png|jpeg';
                $configsUploads['max_size'] = '1000';
                $configsUploads['max_width'] = '2000';
                $configsUploads['max_height'] = '2000';
                $configsUploads['encrypt_name'] = false;
                $this->load->library('upload', $configsUploads);
                if(!$this->upload->do_upload('ifLogoSite'))
                {
                    $errorsUploads = $this->upload->display_errors();
                    //echo '<pre>';
                    //print_r($errorsUploads);
                    //echo '</pre>';
                    $errors['messages'] = 'Erro a gravar a imagem de logo do site.<br/>Detalhes: ' . $errorsUploads;
                    return $errors;
                }
                else
                {
                    $datasUploads = $this->upload->data();
                    //echo '<pre>';
                    //print_r($datasUploads);
                    //echo '</pre>';
                    $this->MDadosEmpresa->setLogoSite('/tormetais/assets/images/' . $datasUploads['file_name']);
                }
            }
            else
            {
                $this->MDadosEmpresa->setLogoSite($dadosEmpresa['logosite']);
            }
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