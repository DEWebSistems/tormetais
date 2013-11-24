<?php
    class Produtos extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            
            parent::__construct();
            $this->load->model('producao/MProdutos');
            $this->load->model('daos/DAOProdutos');            
            
            $this->load->model('daos/DAODadosEmpresa');
            $this->load->model('producao/MDadosEmpresa');   
            
            $this->load->model('daos/DAOCategoriasProdutos');
            $this->load->model('producao/MCategoriasProdutos');   
            
            $this->load->helper('url');      
        }
        
        public function index()
        {            
            $this->lista(1);      
//            $dadosPost = $this->input->post();
//            $messages = array();
//            $messages['isErrors'] = false;
//            $messages['messagesErrors'] = '';
//            $messages['isSuccess'] = false;
//            $messages['messagesSuccess'] = '';
//            if(isset($dadosPost['bsGravar']))
//            {      
//                
//                if(($this->gravar($dadosPost)) == false)
//                {
//                    $messages['isErrors'] = true;
//                    $messages['messagesErrors'] = 'Ocoreu um erro com o banco de dados. Não foi possível gravar os dados do produto.';
//                }
//                else
//                {
//                    $messages['isSuccess'] = true;
//                    $messages['messagesSuccess'] = 'Os dados do produto foram salvos com sucesso';
//                }
//            }
//            $datasBody = array();
//            $datasBody['messages'] = $messages;
//            $datasBody['categoriasProduto'] = $this->getCategoriasProdutos();
//            $this->load->model('daos/DAOProdutos');
//            $this->load->model('producao/MProdutos');
//            $this->load->model('daos/DAODadosEmpresa');
//            $this->load->model('producao/MDadosEmpresa');
//            $datasBody['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
//            $this->load->view('fragmentos/cabecalhoprivado', $datasBody);
//            $this->load->view('privado/producao/produtoform', $datasBody);
//            $this->load->view('fragmentos/rodape', $datasBody);              
        }
        
//        private function gravar($dadosPost)
//        {
//            $this->load->model('producao/MProdutos');                        
////            $this->MProduto->setId($dadosPost['itId']);
//            $this->MProdutos->setNome($dadosPost['itNome']);
//            $this->MProdutos->setDescricao($dadosPost['taDescricao']);            
//            $this->MProdutos->setCategoriaProdutoId($dadosPost['seCategoriaProduto']);            
//            $this->load->model('daos/DAOProdutos');
//            if($this->MProdutos->getId() == null)
//            {
//                $this->DAOProdutos->inserir($this->MProdutos);
//            }
//            else
//            {
//                $this->DAOProdutos->alterar($this->MProdutos);
//            }
//        }

        public function lista($numberPage = 1)
        {
            $dadosPost = $this->input->post();
            
            echo '<pre>';
                print_r($dadosPost);
                echo '</pre>';
            if(isset($dadosPost['bsGravar']))
            {
                if($this->gravar($dadosPost) == true)
                {
                    $messages['isSuccess'] = true;
                    $messages['isErrors'] = false;
                    $messages['messagesSuccess'] = 'Registro salvo com sucesso';
                }
                else
                {
                    $messages['isSuccess'] = false;
                    $messages['isErrors'] = true;
                    $messages['messagesErrors'] = 'Erro ao salvar o registro';
                }
            }            
            else
            {
                $messages['isErrors'] = false;
                $messages['isSuccess'] = false;
            }
            $datasBody = array();
            
            
            $datasBody['messages'] = $messages;
            $returns = $this->DAOProdutos->listPagination($numberPage);            
            $datasBody['produtos'] = $returns->result_array();
            $this->load->library('pagination');
            $config['use_page_numbers'] = TRUE;
            $config['base_url'] = 'produtos/index/';
            $config['total_rows'] = $this->DAOProdutos->getNumberRecords();
            $config['per_page'] = $this->DAOProdutos->getLimitPage();
            $this->pagination->initialize($config);
            $datasBody['paginations'] = $this->pagination->create_links();
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);
            $this->load->view('privado/producao/produtoslist', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        public function adicionar()
        {
            $datasBody = array();
            $dadosProduto = array();
            $dadosProduto['id'] = '';
            $dadosProduto['nome'] = '';
            $dadosProduto['descricao'] = '';            
            $datasBody['operation'] = 'i';
            $datasBody['dadosProduto'] = $dadosProduto;
            $datasBody['categoriasProduto'] = $this->getCategoriasProdutos();
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);            
            $this->load->view('privado/producao/produtosform', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        public function alterar($id)
        {
            $datasBody = array();
            $dadosProduto = array();
            $returns = $this->DAOProdutos->getProdutoById($id);            
            $datasBody['operation'] = 'u';
            $datasBody['dadosProduto'] = $returns;
            $datasBody['categoriasProduto'] = $this->getCategoriasProdutos();
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);
            $this->load->view('privado/producao/produtosform', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        public function gravar($dadosPost)
        {
            $this->MProdutos->setId($dadosPost['itId']);
            $this->MProdutos->setNome($dadosPost['itNome']);
            $this->MProdutos->setDescricao($dadosPost['taDescricao']);
            $this->MProdutos->setCategoriaProdutoId($dadosPost['seCategoriaProduto']);            
            if($dadosPost['bsGravar'] == 'i')
            {
                $results = $this->DAOProdutos->insert($this->MProdutos);
            }
            else if($dadosPost['bsGravar'] == 'u')
            {
                $results = $this->DAOProdutos->update($this->MProdutos);
            }
            else
            {
                $results = false;
            }            
            return $results;
        }
        
        private function getCategoriasProdutos()
        {
            $categoriasProdutos = array(
                1 => 'Categoria Um',
                2 => 'Categoria Dois'                
            );
            return $categoriasProdutos;
        }
    }
?>