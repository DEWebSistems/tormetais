<?php
    class CategoriasProdutos extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('producao/MCategoriasProdutos');
            $this->load->model('daos/DAOCategoriasProdutos');
            
            $this->load->model('producao/MDadosEmpresa');
            $this->load->model('daos/DAODadosEmpresa');                                                
            
            $this->load->helper(array('url', 'form'));
            $this->load->library('paginationsable');
            
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
                if($this->DAOCategoriasProdutos->excluir($dadosPost['bsExcluir']))
                {
                    $messages['isSuccess'] = true;
                    $messages['isErrors'] = false;
                    $messages['messagesSuccess'] = 'Registro salvo com sucesso.';
                }
                else
                {
                    $messages['isSuccess'] = false;
                    $messages['isErrors'] = true;
                    $messages['messagesErrors'] = 'Erro ao excluir o registro.<br/>Detalhes: ' . $this->DAOCategoriasProdutos->getMessagesErros();
                }
            }
            else
            {
                $messages['isErrors'] = false;
                $messages['isSuccess'] = false;
            }
            $datasBody = array();
            
            
            $datasBody['messages'] = $messages;
            $returns = $this->DAOCategoriasProdutos->listPagination($numberPage);            
            $datasBody['categoriasprodutos'] = $returns->result_array();
            $this->paginationsable->setBaseURL('privado/categoriasprodutos/lista');
            $this->paginationsable->setTotalRows($this->DAOCategoriasProdutos->getNumberRecords());
            $this->paginationsable->setRowsPerPage($this->DAOCategoriasProdutos->getLimitPage());
            $this->paginationsable->setAccessedPage($numberPage);
            if($this->paginationsable->createLinks() == false)
            {
                $datasBody['paginations'] = '';
            }
            else
            {
                $datasBody['paginations'] = $this->paginationsable->getHtmlLinks();
            }
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);
            $this->load->view('privado/producao/categoriasprodutoslist', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        public function adicionar()
        {
            $datasBody = array();
            $dadosCategoriasProduto = array();
            $dadosCategoriasProduto['id'] = '';
            $dadosCategoriasProduto['nome'] = '';            
            $datasBody['operation'] = 'i';
            $datasBody['dadosCategoriasProduto'] = $dadosCategoriasProduto;            
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);            
            $this->load->view('privado/producao/categoriasprodutosform', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        public function alterar($id)
        {
            $datasBody = array();            
            $returns = $this->DAOCategoriasProdutos->getCategoriaProdutoById($id);
            $datasBody['operation'] = 'u';
            $datasBody['dadosCategoriasProduto'] = $returns;            
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();            
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);
            $this->load->view('privado/producao/categoriasprodutosform', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        public function gravar($dadosPost)
        {
            $this->MCategoriasProdutos->setId($dadosPost['itId']);
            $this->MCategoriasProdutos->setNome($dadosPost['itNome']);
            
            if($dadosPost['bsGravar'] == 'i')
            {
                $results = $this->DAOCategoriasProdutos->insert($this->MCategoriasProdutos);
            }
            else if($dadosPost['bsGravar'] == 'u')
            {
                $results = $this->DAOCategoriasProdutos->update($this->MCategoriasProdutos);
            }
            else
            {
                $results = false;
            }            
            return $results;
        }                               
    }
?>