<?php

    class ProdutosReboque extends CI_Controller
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
            
            $this->load->model('daos/DAOLinhasProdutos');
            $this->load->model('producao/MLinhasProdutos');
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
            $datasBody['categoriasProdutos']    = $this->DAOCategoriasProdutos->getCategoriasProdutosNELP(2)->result_array();                      
            $produtos                           = $this->DAOProdutos->getProdutosByLinhaProdutoId(2);
            $datasBody['linhaReboque']          = $this->DAOLinhasProdutos->getLinhaProdutoById(2);                      
            
            
            $produtosComImagem = array();
                                    
            foreach ($produtos as $produto) {
                                                                                
                $imagemPrincipal = $this->DAOProdutos->getImagemPrincipal($produto['id']);
                
                $produto['imagemprincipal'] = $imagemPrincipal['localizacao'];
                
                $produtosComImagem[] = $produto;
            }            
            
            $datasBody['produtos']              = $produtosComImagem;
                        
            $this->load->view('fragmentos/cabecalhoreboque',   $dadosEmpresa);
            $this->load->view('publico/produtosreboque',       $datasBody);
            $this->load->view('fragmentos/rodapereboque',      $dadosEmpresa);
        }
        
        public function detalhe($idProduto)
        {            
            $dadosEmpresa['dadosEmpresa']       = $this->DAODadosEmpresa->getDadosEmpresa();
            $datasBody['categoriasProdutos']    = $this->DAOCategoriasProdutos->getCategoriasProdutosNELP(2)->result_array();
            
            $produto                            = $this->DAOProdutos->getProdutoById($idProduto);            
            $imagemPrincipal                    = $this->DAOProdutos->getImagemPrincipal($produto['id']);                
            $produto['imagemprincipal']         = $imagemPrincipal['localizacao'];
            
            $datasBody['dadosProduto']          = $produto;
            $datasBody['videosproduto']         = $this->DAOProdutos->getVideos($idProduto)->result_array();
            $datasBody['imagensproduto']        = $this->DAOProdutos->getImagens($idProduto)->result_array();            
            
            $this->load->view('fragmentos/cabecalhoreboque',   $dadosEmpresa);
            $this->load->view('publico/produtoreboque',        $datasBody);
            $this->load->view('fragmentos/rodapereboque',      $dadosEmpresa);            
        }
                  
        public function filtro($idCategoriaProduto) {
            
            $dadosEmpresa['dadosEmpresa']       = $this->DAODadosEmpresa->getDadosEmpresa();
            $datasBody['categoriasProdutos']    = $this->DAOCategoriasProdutos->getCategoriasProdutosNELP(2)->result_array();
            
            $produtos                           = $this->DAOProdutos->getProdutosLPCP(2, $idCategoriaProduto);
            $datasBody['linhaReboque']          = $this->DAOLinhasProdutos->getLinhaProdutoById(2);                      
            $produtosComImagem = array();                       
            
            if($produtos != NULL) 
            {   
                foreach ($produtos as $produto) {

                    $imagemPrincipal = $this->DAOProdutos->getImagemPrincipal($produto['id']);

                    $produto['imagemprincipal'] = $imagemPrincipal['localizacao'];

                    $produtosComImagem[] = $produto;
                }            
            }
            
            $datasBody['produtos']              = $produtosComImagem;
            
            $this->load->view('fragmentos/cabecalhoreboque',   $dadosEmpresa);
            $this->load->view('publico/produtosreboque',       $datasBody);
            $this->load->view('fragmentos/rodapereboque',      $dadosEmpresa);
        }                                
    }
?>