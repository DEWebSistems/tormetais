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
            $datasBody['imagensproduto']         = $this->getImagensProduto($idProduto);
            
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
        
        private function getImagensProduto($produtoId){
            
            $imagensProduto = array(
                1 => '/tormetais/assets/images/DSC02564.JPG',
                2 => '/tormetais/assets/images/DSC02565.JPG',
                3 => '/tormetais/assets/images/DSC02567.JPG'
            );
            return $imagensProduto;
        }
        
        private function getVideosProduto($produtoId){
            
            $videosProduto = array(
                1 => '//www.youtube.com/embed/1dC7aya_XnM?rel=0',
                2 => '//www.youtube.com/embed/w7WBHph4pbs',
                3 => '//www.youtube.com/embed/Z-4v4I7Gzk0?rel=0'
            );
            return $videosProduto;
        }
    }
?>