<?php
    class LinhasProdutos extends CI_Controller
    {
        
        function __construct()
        {
            parent::__construct();
            $this->load->helper(array('url'));
            $this->load->model('daos/DAODadosEmpresa');
            $this->load->model('seguranca/MUsuarios');
            $this->MUsuarios->validateUser();
            $this->load->model('daos/DAOLinhasProdutos');
            $this->load->model('producao/MLinhasProdutos');
            $this->load->model('daos/DAOProdutos');
        }
        
        public function index()
        {
            $this->lista();
        }
        
        public function lista()
        {
            $datasBody = array();
            $postsDatas = $this->input->post();
            if(isset($postsDatas['bsGravar']))
            {
                $recordingResults = $this->gravar($postsDatas);
                if($recordingResults == true)
                {
                    $messages['isSuccess'] = true;
                    $messages['isErrors'] = false;
                    $messages['messagesSuccess'] = 'Registro salvo com sucesso';
                }
                else
                {
                    $messages['isSuccess'] = false;
                    $messages['isErrors'] = true;
                    $messages['messagesErrors'] = 'Erro ao salvar o registro. <br/>Detalhes: ' + $recordingResults;
                }
            }
            else
            {
                $messages['isErrors'] = false;
                $messages['isSuccess'] = false;
            }
            $datasCR['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $datasBody['messages'] = $messages;
            $datasBody['linhasProdutos'] = $this->DAOLinhasProdutos->getAll()->result_array();
            $this->load->view('fragmentos/cabecalhoprivado', $datasCR);
            $this->load->view('privado/producao/linhasprodutoslist', $datasBody);
            $this->load->view('fragmentos/rodape', $datasCR);
        }
        
        public function alterar($id = 0)
        {
            if(($id == null) or (empty($id)) or ($id == 0))
            {
                $this->lista();
            }
            else
            {
                $datasBody = array();
                $datasCR['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
                $dadosLP = $this->DAOLinhasProdutos->getById($id);
                if($dadosLP->num_rows() > 0)
                {
                    $linhaProduto = $dadosLP->result_array()[0];
                    $datasBody['dadosLP'] = $linhaProduto;
                    $datasBody['produtos'] = $this->DAOProdutos->getProdutosByLinhaProdutoId($linhaProduto['id']);
                    $datasBody['operation'] = 'u';
                    $this->load->view('fragmentos/cabecalhoprivado', $datasCR);
                    $this->load->view('privado/producao/linhasprodutosform', $datasBody);
                    $this->load->view('fragmentos/rodape', $datasCR);
                }
                else
                {
                    $this->lista();
                }
            }
        }
        
        public function gravar($postsDatas)
        {
            if($postsDatas['bsGravar'] == 'u')
            {
                $this->MLinhasProdutos->setId($postsDatas['itId']);
                $this->MLinhasProdutos->setNome($postsDatas['itNome']);
                $this->MLinhasProdutos->setDescricao($postsDatas['taDescricao']);
                $this->MLinhasProdutos->setProdutoId($postsDatas['seProdutos']);
                $results = $this->DAOLinhasProdutos->alterar($this->MLinhasProdutos);
                return $results;
            }
            else
            {
                return false;
            }
        }
    }
?>