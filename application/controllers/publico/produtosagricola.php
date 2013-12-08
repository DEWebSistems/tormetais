<?php

    class ProdutosAgricola extends CI_Controller
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
            $produtos                           = $this->DAOProdutos->getProdutos()->result_array();                        
            
            $produtosComImagem = array();                       
            
            foreach ($produtos as $produto) {
                                                                                
                $imagemPrincipal = $this->DAOProdutos->getImagemPrincipal($produto['id']);
                
                $produto['imagemprincipal'] = $imagemPrincipal['localizacao'];
                
                $produtosComImagem[] = $produto;
            }            
            
            $datasBody['produtos']              = $produtosComImagem;
                        
            $this->load->view('fragmentos/cabecalhoagricola',   $dadosEmpresa);
            $this->load->view('publico/produtosagricola',       $datasBody);
            $this->load->view('fragmentos/rodape',      $dadosEmpresa);
        }
        
        public function detalhe($idProduto)
        {            
            $dadosEmpresa['dadosEmpresa']       = $this->DAODadosEmpresa->getDadosEmpresa();
            $datasBody['categoriasProdutos']    = $this->DAOCategoriasProdutos->getCategoriasProdutos()->result_array();
            
            $produto                            = $this->DAOProdutos->getProdutoById($idProduto);            
            $imagemPrincipal                    = $this->DAOProdutos->getImagemPrincipal($produto['id']);                
            $produto['imagemprincipal']         = $imagemPrincipal['localizacao'];
            
            $datasBody['dadosProduto']          = $produto;
            $datasBody['videosproduto']         = $this->DAOProdutos->getVideos($idProduto)->result_array();
            $datasBody['imagensproduto']        = $this->DAOProdutos->getImagens($idProduto)->result_array();            
            
            $this->load->view('fragmentos/cabecalho',   $dadosEmpresa);
            $this->load->view('publico/produtoagricola',        $datasBody);
            $this->load->view('fragmentos/rodape',      $dadosEmpresa);            
        }
                  
        public function filtro($idCategoriaProduto) {
            
            $dadosEmpresa['dadosEmpresa']       = $this->DAODadosEmpresa->getDadosEmpresa();
            $datasBody['categoriasProdutos']    = $this->DAOCategoriasProdutos->getCategoriasProdutos()->result_array();                       
            $produtos                           = $this->DAOProdutos->getProdutosByCategoriaProdutoId($idCategoriaProduto);                   
            
            $produtosComImagem = array();                       
            
            foreach ($produtos as $produto) {
                                                                                
                $imagemPrincipal = $this->DAOProdutos->getImagemPrincipal($produto['id']);
                
                $produto['imagemprincipal'] = $imagemPrincipal['localizacao'];
                
                $produtosComImagem[] = $produto;
            }            
            
            $datasBody['produtos']              = $produtosComImagem;
            
            $this->load->view('fragmentos/cabecalho',   $dadosEmpresa);
            $this->load->view('publico/produtosagricola',       $datasBody);
            $this->load->view('fragmentos/rodape',      $dadosEmpresa);
        }                               
    }
?>