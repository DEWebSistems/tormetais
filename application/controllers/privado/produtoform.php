<?php
    class ProdutoForm extends CI_Controller
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
                
                if(($this->gravar($dadosPost)) == false)
                {
                    $messages['isErrors'] = true;
                    $messages['messagesErrors'] = 'Ocoreu um erro com o banco de dados. Não foi possível gravar os dados do produto.';
                }
                else
                {
                    $messages['isSuccess'] = true;
                    $messages['messagesSuccess'] = 'Os dados do produto foram salvos com sucesso';
                }
            }
            $datasBody = array();
            $datasBody['messages'] = $messages;
            $datasBody['categoriasProduto'] = $this->getCategoriasProdutos();
            $this->load->model('daos/DAOProdutos');
            $this->load->model('producao/MProdutos');
            $this->load->model('daos/DAODadosEmpresa');
            $this->load->model('producao/MDadosEmpresa');
            $datasBody['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $datasBody);
            $this->load->view('privado/producao/produtoform', $datasBody);
            $this->load->view('fragmentos/rodape', $datasBody);              
        }
        
        private function gravar($dadosPost)
        {
            $this->load->model('producao/MProdutos');                        
//            $this->MProduto->setId($dadosPost['itId']);
            $this->MProdutos->setNome($dadosPost['itNome']);
            $this->MProdutos->setDescricao($dadosPost['taDescricao']);            
            $this->MProdutos->setCategoriaProdutoId($dadosPost['seCategoriaProduto']);            
            $this->load->model('daos/DAOProdutos');
            if($this->MProdutos->getId() == null)
            {
                $this->DAOProdutos->inserir($this->MProdutos);
            }
            else
            {
                $this->DAOProdutos->alterar($this->MProdutos);
            }
        }
//        
//        private function alterar($idProduto)
//        {
//            $datasBody['categoriasProduto'] = $this->getCategoriasProdutos();
//            $this->load->model('daos/DAOProduto');
//            $this->load->model('producao/MProduto');
//            $datasBody['produto'] = $this->DAOProduto->getProdutoById($idProduto);
//            $this->load->view('fragmentos/cabecalho');
//            $this->load->view('privado/producao/produtoform', $datasBody);
//            $this->load->view('fragmentos/rodape');
//            
//        }                
//        
//        private function excluir($idProduto)
//        {       
//            $this->DAOProduto->excluir($idProduto);     
//            $this->listar();
//        }
//        
//        private function listar()
//        {            
//            $this->load->model('daos/DAOProduto');
//            $this->load->model('producao/MProduto');
//            $datasBody['produtos'] = $this->DAOProduto->getProdutos();
//            $this->load->view('fragmentos/cabecalho');
//            $this->load->view('privado/producao/produtolista', $datasBody);
//            $this->load->view('fragmentos/rodape');
//        }
//        
//        private function incluir()
//        {           
//            
//            $datasBody['categoriasProduto'] = $this->getCategoriasProdutos();
//            $this->load->model('daos/DAOProduto');
//            $this->load->model('producao/MProduto');
//            $datasBody['produto'] = new MProduto();
//            $this->load->view('fragmentos/cabecalho');
//            $this->load->view('privado/producao/produtoform', $datasBody);
//            $this->load->view('fragmentos/rodape');
//            
//            $this->load->view('fragmentos/cabecalho');
//            $this->load->view('privado/producao/produto-form');
//            $this->load->view('fragmentos/rodape');
//        }

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