<?php

    class Produtos extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            
            $this->load->helper('url');
            
            $this->load->model('daos/DAODadosEmpresa');
            $this->load->model('producao/MDadosEmpresa');            
            
            
            $this->load->model('daos/DAOCategoriasProdutos');
            $this->load->model('producao/MCategoriasProdutos'); 
             

            $this->load->model('daos/DAOProdutos');
            $this->load->model('producao/MProdutos');             
        }
        
        public function index()
        {
            $dadosPost = $this->input->post();
            if(isset($dadosPost['bsVoltar']))
            {
                $this->lista();                      
            } else if(isset($dadosPost['bsDetalhes']))
            {
                $this->detalhe($dadosPost['bsDetalhes']);
            } else {
                $this->lista();
            }
        }
        
        public function lista()
        {          
            $dadosEmpresa['dadosEmpresa']       = $this->DAODadosEmpresa->getDadosEmpresa();
            $datasBody['categoriasProdutos']    = $this->DAOCategoriasProdutos->getCategoriasProdutos()->result_array();
            $datasBody['produtos']              = $this->DAOProdutos->getProdutos()->result_array();
            
            $this->load->view('fragmentos/cabecalho',   $dadosEmpresa);
            $this->load->view('publico/produtos',       $datasBody);
            $this->load->view('fragmentos/rodape',      $dadosEmpresa);
        }
        
        public function detalhe($idProduto)
        {            
            $dadosEmpresa['dadosEmpresa']       = $this->DAODadosEmpresa->getDadosEmpresa();
            $datasBody['categoriasProdutos']    = $this->DAOCategoriasProdutos->getCategoriasProdutos()->result_array();
            $datasBody['dadosProduto']          = $this->DAOProdutos->getProdutoById($idProduto);
            $datasBody['videosproduto']         = $this->getVideosProduto($idProduto);
            
            $this->load->view('fragmentos/cabecalho',   $dadosEmpresa);
            $this->load->view('publico/produto',        $datasBody);
            $this->load->view('fragmentos/rodape',      $dadosEmpresa);            
        }
                  
        public function filtro($idCategoriaProduto) {
            
            $dadosEmpresa['dadosEmpresa']       = $this->DAODadosEmpresa->getDadosEmpresa();
            $datasBody['categoriasProdutos']    = $this->DAOCategoriasProdutos->getCategoriasProdutos()->result_array();
            $datasBody['produtos']              = $this->DAOProdutos->getProdutosByCategoriaProdutoId($idCategoriaProduto);
            
            $this->load->view('fragmentos/cabecalho',   $dadosEmpresa);
            $this->load->view('publico/produtos',       $datasBody);
            $this->load->view('fragmentos/rodape',      $dadosEmpresa);
        }
        
        private function getVideosProduto($produtoId){
            
            $videosProduto = array(
                1 => '//www.youtube.com/KnZCc1TdU6Y',
                2 => '//www.youtube.com/embed/w7WBHph4pbs',
                3 => '//www.youtube.com/KnZCc1TdU6Y'
            );
            return $videosProduto;
        }
    }
?>