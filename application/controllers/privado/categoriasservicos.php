<?php
    class CategoriasServicos extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('producao/MCategoriasServicos');
            $this->load->model('daos/DAOCategoriasServicos');
            
            $this->load->model('producao/MDadosEmpresa');
            $this->load->model('daos/DAODadosEmpresa');                                                
            
            $this->load->helper(array('url', 'form'));
            
            $this->load->model('seguranca/MUsuarios');
            $this->MUsuarios->validateUser();
        }
        
        public function index()
        {            
            $this->lista(1);
        }
        
        public function lista($numberPage = 1)
        {
            $dadosPost = $this->input->post();            
            if(isset($dadosPost['bsGravar']))
            {
                if($this->gravar($dadosPost) == true)
                {
                    $messages['isSuccess'] = true;
                    $messages['isErrors'] = false;
                    $messages['messagesSuccess'] = 'Registro salvo com sucesso.';
                }
                else
                {
                    $messages['isSuccess'] = false;
                    $messages['isErrors'] = true;
                    $messages['messagesErrors'] = 'Erro ao salvar o registro.';
                }
            }
            else if(isset($dadosPost['bsExcluir']))
            {
                if($this->DAOCategoriasServicos->excluir($dadosPost['bsExcluir']))
                {
                    $messages['isSuccess'] = true;
                    $messages['isErrors'] = false;
                    $messages['messagesSuccess'] = 'Registro salvo com sucesso.';
                }
                else
                {
                    $messages['isSuccess'] = false;
                    $messages['isErrors'] = true;
                    $messages['messagesErrors'] = 'Erro ao excluir o registro.<br/>Detalhes: ' . $this->DAOCategoriasServicos->getMessagesErros();
                }
            }
            else
            {
                $messages['isErrors'] = false;
                $messages['isSuccess'] = false;
            }
            $datasBody = array();
            
            
            $datasBody['messages'] = $messages;
            $returns = $this->DAOCategoriasServicos->listPagination($numberPage);            
            $datasBody['categoriasservicos'] = $returns->result_array();
            $this->load->library('pagination');
            $config['use_page_numbers'] = TRUE;
            $config['base_url'] = 'categoriasservicos/index/';
            $config['total_rows'] = $this->DAOCategoriasServicos->getNumberRecords();
            $config['per_page'] = $this->DAOCategoriasServicos->getLimitPage();
            $this->pagination->initialize($config);
            $datasBody['paginations'] = $this->pagination->create_links();
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);
            $this->load->view('privado/producao/categoriasservicoslist', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        public function adicionar()
        {
            $datasBody = array();
            $dadosCategoriasServico = array();
            $dadosCategoriasServico['id'] = '';
            $dadosCategoriasServico['nome'] = '';            
            $datasBody['operation'] = 'i';
            $datasBody['dadosCategoriasServico'] = $dadosCategoriasServico;            
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);            
            $this->load->view('privado/producao/categoriasservicosform', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        public function alterar($id)
        {
            $datasBody = array();            
            $returns = $this->DAOCategoriasServicos->getCategoriaServicoById($id);
            $datasBody['operation'] = 'u';
            $datasBody['dadosCategoriasServico'] = $returns;            
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();           
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);
            $this->load->view('privado/producao/categoriasservicosform', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        public function gravar($dadosPost)
        {
            $this->MCategoriasServicos->setId($dadosPost['itId']);
            $this->MCategoriasServicos->setNome($dadosPost['itNome']);
            
            if($dadosPost['bsGravar'] == 'i')
            {
                $results = $this->DAOCategoriasServicos->insert($this->MCategoriasServicos);
            }
            else if($dadosPost['bsGravar'] == 'u')
            {
                $results = $this->DAOCategoriasServicos->update($this->MCategoriasServicos);
            }
            else
            {
                $results = false;
            }            
            return $results;
        }                               
    }
?>